<?php 

/**
 * Abstract class for custom pot types.
 */

 namespace TwentyTwentyChild\Taxonomy;

abstract class CustomTaxonomy {

    /**
     * Taxonomy.
     * 
     * @var string
     */

    private $taxonomy;

    /**
     * Class constructor
     */

    public function __construct( $taxonomy ) {
        $this->taxonomy = $taxonomy;
        add_action('init', [$this, 'register_taxonomy'], 1, 0);
    }

    /**
     * Register taxonomy
     */

    public function register_taxonomy() {
        $args = $this->get_args();
        $post_types = $this->get_post_types();
        register_taxonomy( $this->taxonomy, $post_types, $args );

    }

    /**
     * Get taxonomy arguments
     * 
     * @return array
     */

    public function get_args() {
        return array(
            'labels'                     => $this->get_labels(),
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
    }

    /**
     * Get taxonomy labels
     * 
     * @return array
     */
    
    public function get_labels() {
        return array(
            'name'                       => _x( 'Taxonomies', 'Taxonomy General Name', 'twentytwentychild' ),
            'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'twentytwentychild' ),
            'menu_name'                  => __( 'Taxonomy', 'twentytwentychild' ),
            'all_items'                  => __( 'All Items', 'twentytwentychild' ),
            'parent_item'                => __( 'Parent Item', 'twentytwentychild' ),
            'parent_item_colon'          => __( 'Parent Item:', 'twentytwentychild' ),
            'new_item_name'              => __( 'New Item Name', 'twentytwentychild' ),
            'add_new_item'               => __( 'Add New Item', 'twentytwentychild' ),
            'edit_item'                  => __( 'Edit Item', 'twentytwentychild' ),
            'update_item'                => __( 'Update Item', 'twentytwentychild' ),
            'view_item'                  => __( 'View Item', 'twentytwentychild' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'twentytwentychild' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'twentytwentychild' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'twentytwentychild' ),
            'popular_items'              => __( 'Popular Items', 'twentytwentychild' ),
            'search_items'               => __( 'Search Items', 'twentytwentychild' ),
            'not_found'                  => __( 'Not Found', 'twentytwentychild' ),
            'no_terms'                   => __( 'No items', 'twentytwentychild' ),
            'items_list'                 => __( 'Items list', 'twentytwentychild' ),
            'items_list_navigation'      => __( 'Items list navigation', 'twentytwentychild' ),
        );
    }

    /**
     * Get related post types
     * 
     * @return array
     */

    public function get_post_types() {
        return array('post');
    }
}