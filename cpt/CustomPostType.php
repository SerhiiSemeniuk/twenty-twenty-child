<?php 

/**
 * Abstract class for custom pot types.
 */

namespace TwentyTwentyChild\CPT;

abstract class CustomPostType {


    /**
     * Post type.
     * 
     * @var string
     */

    private $post_type;

    /**
     * Class constructor
     */

    public function __construct( $post_type ) {
        $this->post_type = $post_type;
        add_action('init', [$this, 'register_post_type'], 1, 0);
    }

    /**
     * Register a post type
     */

    public function register_post_type() {
        $args = $this->get_args();
        
        register_post_type( $this->post_type, $args );
    }

    /**
     * Get post type arguments
     * 
     * @return array
     */

    public function get_args() {
        return array(
            'label' => __( 'Custom Post', 'twentytwentychild' ),
            'description' => __( 'description', 'twentytwentychild' ),
            'labels' => $this->get_labels(),
            'menu_icon' => 'dashicons-admin-appearance',
            'supports' => array(),
            'taxonomies' => array(),
            'hierarchical' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'has_archive' => true,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'can_export' => true,
            'show_in_nav_menus' => true,
            'menu_position' => 5,
            'capability_type' => 'post',
            'show_in_rest' => true,
        );
    }

    /**
     * Get post type labels
     * 
     * @return array
     */
    
    public function get_labels() {
        return array(
            'name' => _x( 'Custom Posts', 'Post Type General Name', 'twentytwentychild' ),
            'singular_name' => _x( 'Custom Post', 'Post Type Singular Name', 'twentytwentychild' ),
            'menu_name' => _x( 'Custom Posts', 'Admin Menu text', 'twentytwentychild' ),
            'name_admin_bar' => _x( 'Custom Post', 'Add New on Toolbar', 'twentytwentychild' ),
            'archives' => __( 'Custom Post', 'twentytwentychild' ),
            'attributes' => __( 'Custom Post', 'twentytwentychild' ),
            'parent_item_colon' => __( 'Custom Post', 'twentytwentychild' ),
            'all_items' => __( 'All Custom Posts', 'twentytwentychild' ),
            'add_new_item' => __( 'Add New Custom Post', 'twentytwentychild' ),
            'add_new' => __( 'Add New', 'twentytwentychild' ),
            'new_item' => __( 'New Custom Post', 'twentytwentychild' ),
            'edit_item' => __( 'Edit Custom Post', 'twentytwentychild' ),
            'update_item' => __( 'Update Custom Post', 'twentytwentychild' ),
            'view_item' => __( 'View Custom Post', 'twentytwentychild' ),
            'view_items' => __( 'View Custom Posts', 'twentytwentychild' ),
            'search_items' => __( 'Search Custom Post', 'twentytwentychild' ),
            'not_found' => __( 'Not found', 'twentytwentychild' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'twentytwentychild' ),
            'featured_image' => __( 'Featured Image', 'twentytwentychild' ),
            'set_featured_image' => __( 'Set featured image', 'twentytwentychild' ),
            'remove_featured_image' => __( 'Remove featured image', 'twentytwentychild' ),
            'use_featured_image' => __( 'Use as featured image', 'twentytwentychild' ),
            'insert_into_item' => __( 'Insert into Custom Post', 'twentytwentychild' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Custom Post', 'twentytwentychild' ),
            'items_list' => __( 'Custom Posts list', 'twentytwentychild' ),
            'items_list_navigation' => __( 'Custom Posts list navigation', 'twentytwentychild' ),
            'filter_items_list' => __( 'Filter Custom Posts list', 'twentytwentychild' ),
        );
    }
}