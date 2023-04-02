<?php



/**
 * Class for product sale status meta.
 */

 namespace TwentyTwentyChild\Metabox;

 use TwentyTwentyChild\Metabox\CustomPostMeta;

class ProductOnSale extends CustomPostMeta {

    /**
     * Metabox rendering
     *
     * @param WP_Post $post Post object.
     */
    public function render_meta_box( $post ) {
        $on_sale = get_post_meta( $post->ID, $this->meta_key, true ); ?>
        <label for="$this->meta_key"><?php _e( 'Is Product on Sale' ) ?></label>
        <input type="checkbox" name="<?php echo $this->meta_key; ?>" <?php checked( true, $on_sale ); ?> value="1" id="<?php echo $this->meta_key; ?>">
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
        
        if ( !empty( $_POST[ $this->meta_key ] ) ) {
            update_post_meta( $post_id, $this->meta_key, true );
        } else {
            update_post_meta( $post_id, $this->meta_key, false );
        }
    }

    /**
     * Get related post types
     */
    protected function get_post_types() {
        return array( 'products' );
    }
}