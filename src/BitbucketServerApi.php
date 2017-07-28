<?php
/**
 * This is an extension Class which works with Bitbucket Server.
 * See here https://github.com/YahnisElsts/plugin-update-checker/issues/119#issuecomment-318436920
 */

if ( !class_exists('BitbucketServerApi', false) ):

  class BitbucketServerApi extends Puc_v4p2_Vcs_Api {

    /**
     * @var string
     */
    private $repository;

    /**
     * @var string
     */
    private $restApiUrl;

    private $pluginName;

    public function __construct($repositoryUrl, $restApiUrl, $credentials = array()) {
      $this->repository = $repositoryUrl;
      $this->restApiUrl = $restApiUrl;
      $this->pluginName = basename($repositoryUrl);

      parent::__construct($repositoryUrl, $credentials);
    }

    /**
     * Figure out which reference (i.e tag or branch) contains the latest version.
     *
     * @param string $configBranch Start looking in this branch.
     * @return null|Puc_v4p2_Vcs_Reference
     */
    public function chooseReference($configBranch) {
      $updateSource = null;

      //Look for version-like tags.
      if ( !$updateSource && ($configBranch === 'master') ) {
        $updateSource = $this->getLatestTag();
      }
      //If all else fails, use the specified branch itself.
      if ( !$updateSource ) {
        $updateSource = $this->getBranch($configBranch);
      }

      return $updateSource;
    }


    /**
     * @TODO this doesn't seem to work but isn't needed in my case.
     * @param  [type] $branchName [description]
     * @return [type]             [description]
     */
    public function getBranch($branchName) {
      $branch = $this->api('branches?base=' . $branchName);
      exit;
      if ( is_wp_error($branch) || empty($branch) ) {
        return null;
      }

      return new Puc_v4p2_Vcs_Reference(array(
        'name' => $branch->name,
        'updated' => $branch->target->date,
        'downloadUrl' => $this->getDownloadUrl($branch->name),
      ));
    }

    /**
     * Get a specific tag.
     *
     * @param string $tagName
     * @return Puc_v4p2_Vcs_Reference|null
     */
    public function getTag($tagName) {
      $tag = $this->api('tags/' . $tagName);
      if ( is_wp_error($tag) || empty($tag) ) {
        return null;
      }

      return new Puc_v4p2_Vcs_Reference(array(
        'name' => $tag->displayId,
        'version' => ltrim($tag->displayId, 'v'),
        'updated' => null,
        'downloadUrl' => $this->getDownloadUrl($tag->displayId),
      ));
    }

    /**
     * Get the tag that looks like the highest version number.
     *
     * @return Puc_v4p2_Vcs_Reference|null
     */
    public function getLatestTag() {
      $tags = $this->api('tags');

      if ( !isset($tags, $tags->values) || !is_array($tags->values) ) {
        return null;
      }

      //Filter and sort the list of tags.
      $versionTags = $tags->values;

      //usort($versionTags, array($this, 'compareTagNames')); // sort does wrong?

      //Return the first result.
      if ( !empty($versionTags) ) {
        $tag = $versionTags[0];
        return new Puc_v4p2_Vcs_Reference(array(
          'name' => $tag->displayId,
          'version' => ltrim($tag->displayId, 'v'),
          'updated' => null,
          'downloadUrl' => $this->getDownloadUrl($tag->displayId),
        ));
      }
      return null;
    }

    protected function compareTagNames($tag1, $tag2) {
      $property = $this->tagNameProperty;
      if ( !isset($tag1->$property) ) {
        return 1;
      }
      if ( !isset($tag2->$property) ) {
        return -1;
      }
      return -version_compare(ltrim($tag1->$property, 'v'), ltrim($tag2->$property, 'v'));
    }

    /**
     * @param string $ref
     * @return string
     */
    protected function getDownloadUrl($ref) {
      return $this->repository."archive?at=refs%2Ftags%2F{$ref}&format=zip";
    }

    /**
     * Get the contents of a file from a specific branch or tag.
     *
     * @param string $path File name.
     * @param string $ref
     * @return null|string Either the contents of the file, or null if the file doesn't exist or there's an error.
     */
    public function getRemoteFile($path, $ref = 'master') {

      if($ref === "master") {
        $ref_path = "?at=refs%2Fheads%2F{$ref}";
      } else {  // tags
        $ref_path = "?at=refs%2Ftags%2F{$ref}";
      }

      // no rest url here
      $response = $this->api("raw/$path$ref_path", false);

      if ( is_wp_error($response) || !isset($response, $response->data) ) {
        return null;
      }
      return $response->data;
    }

    /**
     * Get the timestamp of the latest commit that changed the specified branch or tag.
     *
     * @param string $ref Reference name (e.g. branch or tag).
     * @return string|null
     */
    public function getLatestCommitTime($ref) {
      $response = $this->api('commits/' . $ref);
      if ( isset($response->values, $response->values[0], $response->values[0]->date) ) {
        return $response->values[0]->date;
      }
      return null;
    }

    /**
     * Perform a BitBucket Server API request.
     *
     * @param string $url
     * @return mixed|WP_Error
     */
    public function api($url, $rest = true) {
      $options = array('timeout' => 10);

      if(!$rest)
        $url = $this->restApiUrl.$url;
      else
        $url = $this->repository.$url;

      $response = wp_remote_get($url, $options);
      if ( is_wp_error($response) ) {
        return $response;
      }

      $code = wp_remote_retrieve_response_code($response);
      $body = wp_remote_retrieve_body($response);
      if ( $code === 200 ) {
        $document = json_decode($body);
        return $document;
      }

      return new WP_Error(
        'puc-bitbucket-http-error',
        'BitBucket Server API error. HTTP status: ' . $code
      );
    }
  }

endif;
