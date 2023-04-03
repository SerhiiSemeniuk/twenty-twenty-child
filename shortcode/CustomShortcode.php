<?php

/**
 * Abstract class for custom shortcode.
 */

 namespace TwentyTwentyChild\Shortcode;


abstract class CustomShortcode {

    /**
     * shortcode name
     *
     * @var string
     */
    protected $shortcode;

    /**
     * shortcode default attributes
     *
     * @var array
     */
    protected $default_attributes;

    /**
     * Class constructor.
     *
     * @param string $shortcode    Shortcode name.
     */
    
    public function __construct( $shortcode ) {
        $this->shortcode = $shortcode;
        $this->default_attributes = $this->get_default_attributes();
        add_shortcode( $this->shortcode, array( $this, 'render_shortcode' ) );
    }

    /**
     * Shortcode rendering
     *
     * @param array $atts
     */
    abstract public function render_shortcode( $atts, $content );

    /**
     * Getting default attributes
     *
     */
    protected function get_default_attributes() {
        return array();
    }

}