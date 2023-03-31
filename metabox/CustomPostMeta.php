<?php



/**
 * Abstract class for custom post meta.
 */

 namespace TwentyTwentyChild\Metabox;


abstract class CustomPostMeta {

    /**
     * field name
     *
     * @var string
     */
    protected $meta_key;

    /**
     * field title
     *
     * @var string
     */
    protected $field_name;

    /**
     * post types
     *
     * @var array
     */
    protected $post_types;

    /**
     * context
     *
     * @var string
     */
    protected $context;

    /**
     * priority
     *
     * @var string
     */
    protected $priority;

    /**
     * Class constructor.
     *
     * @param string $meta_key    Field name.
     * @param string $field_name  Field title.
     */
    public function __construct( $meta_key, $field_name ) {
        $this->meta_key = $meta_key;
        $this->field_name = $field_name;
        $this->post_types = $this->get_post_types();
        $this->context = $this->get_context();
        $this->priority = $this->get_priority();
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save_meta_data' ) );
    }

    /**
     * Add meta box to the page
     */
    public function add_meta_box() {
        add_meta_box(
            $this->meta_key . '_meta_box',
            $this->field_name,
            array( $this, 'render_meta_box' ),
            $this->post_types,
            $this->context,
            $this->priority
        );
    }

    /**
     * Metabox rendering
     *
     * @param WP_Post $post Post object.
     */
    abstract public function render_meta_box( $post );

    /**
     * Save metabox data on post save
     *
     * @param int $post_id Post ID.
     */
    public function save_meta_data( $post_id ) {
        if ( ! isset( $_POST[ $this->meta_key ] ) ) {
            return;
        }
        $meta_value = sanitize_text_field( $_POST[ $this->meta_key ] );
        update_post_meta( $post_id, $this->meta_key, $meta_value );
    }

    /**
     * Get related post types
     */
    protected function get_post_types() {
        return array( 'post' );
    }

    /**
     * Get context
     */
    protected function get_context() {
        return 'advanced';
    }

    /**
     * Get priority
     */
    protected function get_priority() {
        return 'default';
    }
}