<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$product_id = get_the_ID();
$product_gallery = get_post_meta( $product_id, 'product_gallery', true );
$product_price = get_post_meta( $product_id, 'product_price', true );
$product_sale_price = get_post_meta( $product_id, 'product_sale_price', true );
$product_on_sale = get_post_meta( $product_id, 'product_on_sale', true );
$product_youtube_video = get_post_meta( $product_id, 'product_youtube_video', true );
$product_categories = get_the_terms( $product_id, 'products_category' ); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	get_template_part( 'template-parts/entry-header' );
    
    if ( ! is_search() ) {
		get_template_part( 'template-parts/featured-image' );
	}

	?>

	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

		<div class="entry-content">

            <?php if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) :
				the_excerpt();
			else : ?>

                <div class="product-price <?php echo $product_on_sale ? 'on-sale' : ''; ?>">
                    <p>
                        <?php _e( 'Price: ', 'twentytwentychild' ); ?>
                        <span class="regular">
                            <?php echo $product_price; ?>
                        </span>
                        <?php if( $product_on_sale ) : ?>
                            <span class="sale">
                                <?php echo !empty( $product_sale_price ) ? $product_sale_price : $product_price; ?>
                            </span>
                        <?php endif; ?>
                    </p>

                </div>

                <?php the_content( __( 'Continue reading', 'twentytwenty' ) ); 
                if ( !empty( $product_youtube_video ) ) : ?>
                    <iframe 
                        class="product-youtube-video"
                        src="https://www.youtube.com/embed/<?php echo $product_youtube_video; ?>" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                <?php endif;
                if( !empty( $product_gallery ) ) :
                    $images = get_posts( array(
                        'post_type' => 'attachment',
                        'post__in' => $product_gallery,
                        'orderby' => 'post__in',
                    ) ); ?>
                    <div class="swiper product-gallery">
                        <div class="swiper-wrapper">
                            <?php foreach ( $images as $image ) : ?>
                                <div class="swiper-slide">
                                    <?php echo wp_get_attachment_image( $image->ID, 'full' ); ?>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                    
                <?php endif;
            endif; ?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php edit_post_link(); ?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) : 
        if( !empty( $product_categories ) ) {

            $product_categories_slugs  = array_map( function ( $e ) {
                return $e->slug;
            }, $product_categories );
            
            $related_products_args = array( 
                'post_type' => 'products',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post__not_in' => array(
                    $product_id
                ),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'products_category',
                        'field'    => 'slug',
                        'terms'    => $product_categories_slugs,
                    ),
                ),

            );

            $related_products_query = new WP_Query( $related_products_args );
            if ( $related_products_query->have_posts() ) :
                $default_image_url = get_stylesheet_directory_uri() . '/assets/img/default-product-image.png'; ?>
                <div class="related-products">
                    <h2><?php _e( 'Related products', 'twentytwentychild' ); ?></h2>
                    <div class="products-list">
                    <?php while ( $related_products_query->have_posts() ) :
                        $related_products_query->the_post();
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
                </div>
            <?php endif;
        } ?>

		

    <?php endif;

	/*
	 * Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
