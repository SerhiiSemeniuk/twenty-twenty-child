<?php 

/**
 * Class for products API router.
 */

 namespace TwentyTwentyChild\Api\Controller;

 class ProductApiController {
    public static function get_products_category_by_id( \WP_REST_Request $request ) {

        $products_args = array(
            'post_type' => 'products',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'products_category',
                    'field'    => 'id',
                    'terms'    => $request['id'],
                ),
            ),
        );
        $products = new \WP_Query( $products_args );
        if( $products->have_posts() ) {
            
            $default_image_url = get_stylesheet_directory_uri() . '/assets/img/default-product-image.png';
            while ( $products->have_posts() ) {
                $products->the_post();
                $product_it = get_the_ID();
                $product['title'] = get_the_title();
                $product['description'] = apply_filters( 'the_content', get_the_content() );
                if( has_post_thumbnail() ) {
                    $product['image'] = get_the_post_thumbnail_url();
                } else {
                    $product['image'] = $default_image_url;
                }
                $product['price'] = get_post_meta( $product_it, 'product_price', true );
                $product['sale_price'] = get_post_meta( $product_it, 'product_sale_price', true );
                $product['is_on_sale'] = get_post_meta( $product_it, 'product_on_sale', true );
                $return[] = $product;
            }
        }
        return new \WP_REST_Response( $return );
    }

    public static function get_products_category_by_slug( \WP_REST_Request $request ) {
        $products_args = array(
            'post_type' => 'products',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'products_category',
                    'field'    => 'slug',
                    'terms'    => $request['slug'],
                ),
            ),
        );
        $products = new \WP_Query( $products_args );
        if( $products->have_posts() ) {
            
            $default_image_url = get_stylesheet_directory_uri() . '/assets/img/default-product-image.png';
            while ( $products->have_posts() ) {
                $products->the_post();
                $product_it = get_the_ID();
                $product['title'] = get_the_title();
                $product['description'] = apply_filters( 'the_content', get_the_content() );
                if( has_post_thumbnail() ) {
                    $product['image'] = get_the_post_thumbnail_url();
                } else {
                    $product['image'] = $default_image_url;
                }
                $product['price'] = get_post_meta( $product_it, 'product_price', true );
                $product['sale_price'] = get_post_meta( $product_it, 'product_sale_price', true );
                $product['is_on_sale'] = get_post_meta( $product_it, 'product_on_sale', true );
                $return[] = $product;
            }
        }
        return new \WP_REST_Response( $return );
    }
    
 }