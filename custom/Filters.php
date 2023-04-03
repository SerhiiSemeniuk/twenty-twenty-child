<?php

/**
 * Custom Filters.
 */

 namespace TwentyTwentyChild\Custom;

 class Filters {

    /**
     * Class constructor
     */

    public function __construct() {
        add_filter( 'show_admin_bar', array( $this, 'show_admin_bar' ) );
        add_filter( 'product_box_atts', array( $this, 'add_custom_color_for_mobile_browsers' ) );
    }

    /**
     * Disable admin bar for user with 'wp-test' username
     * 
     * @param bool $show
     * 
     * @return bool
     */

    public function show_admin_bar( $show ) {
        if( is_user_logged_in() ) {
            $current_user = wp_get_current_user();
            if( 'wp-test' == $current_user->user_login ) {
                return false;
            }
        }
        return $show;
    }

    public function add_custom_color_for_mobile_browsers( $atts ) {
        if(  preg_match( "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i" , $_SERVER["HTTP_USER_AGENT"] ) ) {
            $atts['bg_color'] = 'rgb(255 255 255 / 50%)';
        }
        return $atts;
    }
 }