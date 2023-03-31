<?php



/**
 * Class for custom product gallery post meta.
 */

 namespace TwentyTwentyChild\Metabox;

 use TwentyTwentyChild\Metabox\CustomPostMeta;

class ProductGalery extends CustomPostMeta {

    /**
     * Class constructor.
     *
     * @param string $meta_key    Field name.
     * @param string $field_name  Field title.
     */
    public function __construct( $meta_key, $field_name ) {
        parent::__construct( $meta_key, $field_name );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
    }

    /**
     * Metabox rendering
     *
     * @param WP_Post $post Post object.
     */
    public function render_meta_box( $post ) {
        $images = array();
        $meta_value = get_post_meta( $post->ID, $this->meta_key, true );
        if( !empty( $meta_value ) ) {
            $images = get_posts( array(
                'post_type' => 'attachment',
                'post__in' => $meta_value,
                'orderby' => 'post__in',
            ) );
        } ?>
        <ul class="image-gallery" data-metabox-name="<?php echo esc_attr( $this->meta_key ); ?>">
            <?php foreach ( $images as $image ) : ?>
                <li id="image-<?php echo esc_attr( $image->ID ); ?>" class="image-gallery-item">
                    <?php echo wp_get_attachment_image( $image->ID, 'thumbnail' ); ?>
                    <div class="image-gallery-actions">
                        <a class="image-gallery-action-move" href="#"><span class="dashicons dashicons-move"></span></a>
                        <a class="image-gallery-action-delete" href="#">&#x2715;</span></a>
                    </div>
                    <input type="hidden" name="<?php echo esc_attr( $this->meta_key ); ?>[]" value="<?php echo esc_attr( $image->ID ); ?>">
                </li>
            <?php endforeach ?>
        </ul>
        <button class="button image-gallery-add-button" data-uploader-title="<?php _e( 'Choose Images', 'twentytwentychild' ) ?>" data-uploader-button-text="<?php _e( 'Add Image', 'twentytwentychild' ) ?>"><?php _e( 'Add Image', 'twentytwentychild' ) ?></button>

    <?php }

    /**
     * Save metabox data on post save
     *
     * @param int $post_id Post ID.
     */
    public function save_meta_data( $post_id ) {
        if( ! in_array( get_post_type( $post_id ), $this->post_types ) ) {
            return;
        }
        
        if ( isset( $_POST[ $this->meta_key ] ) ) {
            $meta_value = array_map( 'intval', $_POST[ $this->meta_key ] );
            update_post_meta( $post_id, $this->meta_key, $meta_value );
        } else {
            delete_post_meta( $post_id, $this->meta_key );
        }
    }

    /**
     * Get related post types
     */
    protected function get_post_types() {
        return array( 'products' );
    }

    /**
     * Get context
     */
    protected function get_context() {
        return 'side';
    }

    /**
     * Get priority
     */
    protected function get_priority() {
        return 'low';
    }

    /**
     * Enqueue scripts and styles for metabox
     */
    public function admin_enqueue_scripts( $hook ) {
        $screen = get_current_screen(); 
        if( 'post.php' == $hook && in_array( $screen->post_type, $this->post_types ) ) {
            wp_enqueue_media();
            wp_enqueue_script( 'twentytwenty-' . $this->meta_key . 'script', get_stylesheet_directory_uri() . '/assets/js/product-gallery.js', array( 'jquery' ) );
            wp_enqueue_style( 'twentytwenty-' . $this->meta_key . 'css', get_stylesheet_directory_uri() . '/assets/css/product-gallery.css' );
        }
    }
}