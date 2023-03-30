<?php 

/**
 * Abstract class for custom pot types.
 */

namespace TwentyTwentyChild\CPT;

use TwentyTwentyChild\CPT\CustomPostType;

class Products extends CustomPostType {

    /**
     * Get post type arguments
     * 
     * @return array
     */

    public function get_args() {
        return array(
            'label' => __( 'Products', 'twentytwentychild' ),
            'description' => __( 'Custom Products', 'twentytwentychild' ),
            'labels' => $this->get_labels(),
            'menu_icon' => 'dashicons-cart',
            'supports' => array(
                'title',
                'editor',
                'thumbnail'
            ),
            'taxonomies' => array(
                'product_category'
            ),
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
            'show_in_rest' => false,
        );
    }
    
    /**
     * Get post type labels
     * 
     * @return array
     */

    public function get_labels() {
        return array(
            'name' => _x( 'Products', 'Post Type General Name', 'twentytwentychild' ),
            'singular_name' => _x( 'Product', 'Post Type Singular Name', 'twentytwentychild' ),
            'menu_name' => _x( 'Products', 'Admin Menu text', 'twentytwentychild' ),
            'name_admin_bar' => _x( 'Product', 'Add New on Toolbar', 'twentytwentychild' ),
            'archives' => __( 'Product', 'twentytwentychild' ),
            'attributes' => __( 'Product', 'twentytwentychild' ),
            'parent_item_colon' => __( 'Product', 'twentytwentychild' ),
            'all_items' => __( 'All Products', 'twentytwentychild' ),
            'add_new_item' => __( 'Add New Product', 'twentytwentychild' ),
            'add_new' => __( 'Add New', 'twentytwentychild' ),
            'new_item' => __( 'New Product', 'twentytwentychild' ),
            'edit_item' => __( 'Edit Product', 'twentytwentychild' ),
            'update_item' => __( 'Update Product', 'twentytwentychild' ),
            'view_item' => __( 'View Product', 'twentytwentychild' ),
            'view_items' => __( 'View Products', 'twentytwentychild' ),
            'search_items' => __( 'Search Product', 'twentytwentychild' ),
            'not_found' => __( 'Not found', 'twentytwentychild' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'twentytwentychild' ),
            'featured_image' => __( 'Featured Image', 'twentytwentychild' ),
            'set_featured_image' => __( 'Set featured image', 'twentytwentychild' ),
            'remove_featured_image' => __( 'Remove featured image', 'twentytwentychild' ),
            'use_featured_image' => __( 'Use as featured image', 'twentytwentychild' ),
            'insert_into_item' => __( 'Insert into Product', 'twentytwentychild' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Product', 'twentytwentychild' ),
            'items_list' => __( 'Products list', 'twentytwentychild' ),
            'items_list_navigation' => __( 'Products list navigation', 'twentytwentychild' ),
            'filter_items_list' => __( 'Filter Products list', 'twentytwentychild' ),
        );
    }
}