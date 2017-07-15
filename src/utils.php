<?php 
namespace Utils;

/**
 * https://wordpress.stackexchange.com/questions/176804/passing-a-variable-to-get-template-part
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the tempalte as $template_args array
 * @param string filepart
 * @param mixed wp_args style argument list
 */
function mj_get_template_part( $file, $template_args = array(), $cache_args = array() ) {
    $template_args = wp_parse_args( $template_args );
    $cache_args = wp_parse_args( $cache_args );
    if ( $cache_args ) {
        foreach ( $template_args as $key => $value ) {
            if ( is_scalar( $value ) || is_array( $value ) ) {
                $cache_args[$key] = $value;
            } else if ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
                $cache_args[$key] = call_user_method( 'get_id', $value );
            }
        }
        if ( ( $cache = wp_cache_get( $file, serialize( $cache_args ) ) ) !== false ) {
            if ( ! empty( $template_args['return'] ) )
                return $cache;
            echo $cache;
            return;
        }
    }
    $file_handle = $file;
    do_action( 'mj_acf_fields_start_operation', 'hm_template_part::' . $file_handle );

    // Check if you find a template inside child theme
    if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) )
        $file = get_stylesheet_directory() . '/' . $file . '.php';

    // Check if you find it in the parent theme
    elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) )
        $file = get_template_directory() . '/' . $file . '.php';

    // use it from plugin templates
    else
        $file = plugin_dir_path( __FILE__ ) . '/templates/' . $file;

    ob_start();
    $return = require( $file );
    $data = ob_get_clean();
    do_action( 'mj_acf_fields_end_operation', $file );
    if ( $cache_args ) {
        wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
    }
    if ( ! empty( $template_args['return'] ) )
        if ( $return === false )
            return false;
        else
            return $data;
    echo $data;
}
