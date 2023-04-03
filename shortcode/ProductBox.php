<?php

/**
 * Class for product in box shortcode.
 */

 namespace TwentyTwentyChild\Shortcode;

 use TwentyTwentyChild\Shortcode\CustomShortcode;

class ProductBox extends CustomShortcode {

    /**
     * Shortcode rendering
     *
     * @param array $atts
     */
    public function render_shortcode( $atts, $content ) {
        $atts = shortcode_atts( $this->default_attributes, $atts, $this->shortcode );
        $atts = apply_filters( $this->shortcode . '_atts', $atts );
        $product = get_post( $atts['id'] );
        $return = '';
        if( !empty( $product ) && 'products' == $product->post_type ) { 
            $product_price = get_post_meta( $atts['id'], 'product_price', true );
            $product_sale_price = get_post_meta( $atts['id'], 'product_sale_price', true );
            $product_on_sale = get_post_meta( $atts['id'], 'product_on_sale', true );

            $inner_styles = array(
                'background-color' => $atts['bg_color'],
            );

            $inner_styles_string = implode( 
                '; ', 
                array_map(
                    function ( $key, $value ) {
                        return $key . ': ' . $value;
                    },
                    array_keys( $inner_styles ),
                    $inner_styles
                ) );

            $rendered_inner_styles = 'style="' . $inner_styles_string . '"';


            $return .=  '<div class="product-box">';
            $return .=      '<a href="' . get_the_permalink( $atts['id'] ) . '" class="product-box-inner" ' . $rendered_inner_styles . '>';
            if( has_post_thumbnail( $atts['id'] ) ) :
                $return .= get_the_post_thumbnail( $atts['id'] );
            endif;
            $return .=          '<h2 class="title">';
            $return .=              get_the_title( $atts['id'] );
            $return .=          '</h2>';
            $return .=          '<div class="product-price">';
            $return .=              '<p class="price">';
            $return .=                  __( 'Price: ', 'twentytwentychild' );
            if( $product_on_sale && !empty( $product_sale_price ) ) :
                $return .=             $product_sale_price;
            else :
                $return .=             $product_price;
            endif;
            $return .=              '</p>';

            $return .=          '</div>';
            $return .=      '</a>';
            $return .=  '</div>';
        }
        return $return;
    }

    /**
     * Getting default attributes
     *
     */
    protected function get_default_attributes() {
        return array(
            'id' => -1,
            'bg_color' => '#fff'
        );
    }

}