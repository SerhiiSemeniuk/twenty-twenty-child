<?php 

/**
 * Class for products API router.
 */

 namespace TwentyTwentyChild\Api\Router;

 use TwentyTwentyChild\Api\Router\CustomApiRouter,
 TwentyTwentyChild\Api\Controller\ProductApiController as Controller;

 class ProductRouter extends CustomApiRouter {

    public function registerRoutes() {
        register_rest_route(
            $this->namespace, 
            '/products/category/(?P<id>\d+)', 
            array(
                'methods'  => \WP_REST_Server::READABLE,
                'callback' => array( Controller::class, 'get_products_category_by_id' ),
                'permission_callback' => '__return_true'
            )
        );
        register_rest_route(
            $this->namespace, 
            '/products/category/(?P<slug>[a-zA-Z0-9-]+)', 
            array(
                'methods'  => \WP_REST_Server::READABLE,
                'callback' => array( Controller::class, 'get_products_category_by_slug' ),
                'permission_callback' => '__return_true'
            )
        );

    }

 }