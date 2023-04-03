<?php

/**
 * Theme setup.
 */

 namespace TwentyTwentyChild;

 use TwentyTwentyChild\Custom\Filters, 
    TwentyTwentyChild\CPT\Products,
    TwentyTwentyChild\Taxonomy\ProductsCategory,
    TwentyTwentyChild\Metabox,
    TwentyTwentyChild\Shortcode;

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
        $this->register_meta_boxes();
        $this->register_shortcodes();
    }

    /**
     * Enqueue styles and scripts on the frontend
     */

    public function enqueue_scripts() {
        // enqueue parent style
        wp_enqueue_style( 'twentytwenty-style', get_template_directory_uri() . '/style.css', array(), $this->theme->parent()->get( 'Version' ) );
        wp_enqueue_style( 'twentytwentychild-style', get_stylesheet_directory_uri() . '/style.css', array(), $this->theme->get( 'Version' ) );
        wp_enqueue_style( 'twentytwentychild-swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css' );

        wp_enqueue_script( 'twentytwentychild-swiper-script', '//cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js', array(), false, true);
        wp_enqueue_script( 'twentytwentychild-script', get_stylesheet_directory_uri() . '/assets/js/script.js', array( 'twentytwentychild-swiper-script' ), false, true );
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

    /**
     * Register Meta Boxes
     */

     private function register_meta_boxes() {
        new Metabox\ProductGalery( 'product_gallery', __( 'Product Gallery', 'twentytwentychild' ) );
        new Metabox\ProductPrice( 'product_price', __( 'Price', 'twentytwentychild' ) );
        new Metabox\ProductSalePrice( 'product_sale_price', __( 'Sale Price', 'twentytwentychild' ) );
        new Metabox\ProductOnSale( 'product_on_sale', __( 'Is on sale?', 'twentytwentychild' ) );
        new Metabox\ProductYoutubeVideo( 'product_youtube_video', __( 'YouTube video', 'twentytwentychild' ) );
        
    }

    /**
     * Register Shortcodes
     */

     private function register_shortcodes() {
        new Shortcode\ProductBox( 'product_box' );
    }
    
}