<?php
/**
 * The fron page template file
 */

get_header(); ?>

<main id="site-content">


	<?php $products_args = array(
        'post_type' => 'products',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $products_query = new WP_Query( $products_args );
    if ( $products_query->have_posts() ) :
        $default_image_url = get_stylesheet_directory_uri() . '/assets/img/default-product-image.png' ?>
        <div class="products-list">
            <?php while ( $products_query->have_posts() ) :
                $products_query->the_post();
                $is_on_sale = get_post_meta( get_the_ID(), 'product_on_sale', true ); ?>
                <div class="products-list-item">
                    <a href="<?php the_permalink(); ?>" class="products-list-item-link">
                        <?php if( $is_on_sale ) : ?>
                            <div class="sale-label">
                                <span class="label-content">
                                    <?php _e( 'On Sale', 'twentytwentychild' ); ?>
                                </span>
                            </div>
                            <div class="sale-label-ribbon">
                                <span class="label-content">
                                    <?php _e( 'On Sale', 'twentytwentychild' ); ?>
                                </span>
                                <span class="left-corner"></span>
                                <span class="right-corner"></span>
                            </div>
                        <?php endif;
                        if( has_post_thumbnail() ) :
                            the_post_thumbnail();
                        else: ?>
                            <img src="<?php echo $default_image_url; ?>" alt="">
                        <?php endif;
                        the_title( '<h2 class="product-title">', '</h2>' ); ?>
    
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
	<?php else : ?>

		

		
    <?php endif;
    
    get_template_part( 'template-parts/pagination' ); ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();

?>