<?php



/**
 * Class for product youtube video meta.
 */

 namespace TwentyTwentyChild\Metabox;

 use TwentyTwentyChild\Metabox\CustomPostMeta;

class ProductYoutubeVideo extends CustomPostMeta {

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
        $youtube_id = get_post_meta( $post->ID, $this->meta_key, true );
        $this->nonce_field(); ?>
        <input class="youtube-video" type="text" name="<?php echo $this->meta_key; ?>" value="<?php echo $youtube_id; ?>" id="<?php echo $this->meta_key; ?>">
        <div class="youtube-video-preview">
            <?php if( !empty( $youtube_id ) ) : ?>
                <iframe 
                    src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" 
                    title="YouTube video player" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
                </iframe>
            <?php endif; ?>
        </div>
    <?php }

    /**
     * Get related post types
     */
    protected function get_post_types() {
        return array( 'products' );
    }

    public function admin_enqueue_scripts( $hook ) {
        $screen = get_current_screen(); 
        if( 'post.php' == $hook && in_array( $screen->post_type, $this->post_types ) ) {
            wp_enqueue_script( 'twentytwenty-' . $this->meta_key . 'script', get_stylesheet_directory_uri() . '/assets/js/product-youtube-video.js', array( 'jquery' ) );
            wp_enqueue_style( 'twentytwenty-' . $this->meta_key . 'css', get_stylesheet_directory_uri() . '/assets/css/product-youtube-video.css' );
        }
    }
}

