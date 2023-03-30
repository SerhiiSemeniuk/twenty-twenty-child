<?php

/**
 * Theme setup.
 */

 namespace TwentyTwentyChild;

 use TwentyTwentyChild\Custom\Filters, 
    TwentyTwentyChild\CPT\Products,
    TwentyTwentyChild\Taxonomy\ProductsCategory;

 class Setup {

    /**
     * WP_Theme object.
     * 
     * @var object WP_Theme
     */
    
    private $theme;
    
    /**
     * Class constructor
     */

    public function __construct() {
        $this->theme = \wp_get_theme();

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );

        $this->register_custom_hooks();
        $this->register_custom_post_types();
        $this->register_custom_taxonomies();
    }

    /**
     * Enqueue styles and scripts on the frontend
     */

    public function enqueue_scripts() {
        // enqueue parent style
        wp_enqueue_style( 'twentytwenty-style', get_template_directory_uri() . '/style.css', array(), $this->theme->parent()->get( 'Version' ) );
    }


    /**
     * Basic Theme setup
     */

    public function after_setup_theme() {
        // Loads the theme's translated strings
        load_child_theme_textdomain( 'twentytwentychild', get_stylesheet_directory() . '/languages' );
    }

    /**
     * Custom filters and actions
     */

    private function register_custom_hooks() {
        new Filters();
    }

    /**
     * Register Custom Post Types
     */

    private function register_custom_post_types() {
        new Products( 'products' );
    }

    /**
     * Register Custom Taxonomies
     */

     private function register_custom_taxonomies() {
        new ProductsCategory( 'products_category' );
    }
}