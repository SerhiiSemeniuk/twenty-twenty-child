<?php



/**
 * Class for product price meta.
 */

 namespace TwentyTwentyChild\Metabox;

 use TwentyTwentyChild\Metabox\CustomPostMeta;

class ProductPrice extends CustomPostMeta {

    /**
     * Metabox rendering
     *
     * @param WP_Post $post Post object.
     */
    public function render_meta_box( $post ) {
        $price = get_post_meta( $post->ID, $this->meta_key, true );
        $this->nonce_field(); ?>
        <input type="number" name="<?php echo $this->meta_key; ?>" value="<?php echo $price; ?>" id="<?php echo $this->meta_key; ?>" required min="0" step="0.01">
    <?php }

    /**
     * Get related post types
     */
    protected function get_post_types() {
        return array( 'products' );
    }
}