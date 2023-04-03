<?php 

/**
 * Abstract class for API router.
 */

namespace TwentyTwentyChild\Api\Router;



abstract class CustomApiRouter {

    /**
     * Route namespace.
     * 
     * @var string
     */

     protected $namespace = 'twentytwentychild';

    public function __construct() {
        add_action( 'rest_api_init', array( $this, 'registerRoutes' ) );
    }

    abstract public function registerRoutes();
}
