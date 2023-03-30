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
 }