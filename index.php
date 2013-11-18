<?php
/**
 * Index Template
 *
 * Here we setup all logic and XHTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header();
	global $woo_options;

?>

    <div id="content" class="col-full">

    	<?php woo_main_before(); ?>

    	<div class="home-intro">

		<?php if ( is_woocommerce_activated() ) { ?>		
		
		
		
		
    	<ul class="featured-products">
    	<!-- The first 3 -->
    	<?php
		$args = array( 'post_type' => 'product', 'posts_per_page' => 5, 'meta_query' => array( array('key' => '_visibility','value' => array('catalog', 'visible'),'compare' => 'IN'),array('key' => '_featured','value' => 'yes')) );
		$loop = new WP_Query( $args );

		while ( $loop->have_posts() ) : $loop->the_post(); $_product;

		if ( function_exists( 'get_product' ) ) {
			$_product = get_product( $loop->post->ID );
		} else {
			$_product = new WC_Product( $loop->post->ID );
		}

		?><li class="featured">

					<?php //woocommerce_show_product_sale_flash( $post, $_product ); ?>
					<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
						<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" />'; ?>


					<h3><?php the_title(); ?> <span class="price"><?php echo $_product->get_price_html(); ?></span></h3>

					</a>

			</li><?php endwhile; ?>
		</ul>

		<?php } ?>

		</div><!--/.home-intro-->

		<section id="main" class="<?php if ( $woo_options[ 'woo_homepage_tweet' ] == "false" && $woo_options[ 'woo_display_store_info' ] == "false" ) echo 'fullwidth'; else echo 'col-left'; ?>">

		<?php woo_loop_before(); ?>

			
			
			<h2><?php _e('Latest Products', 'woothemes'); ?></h2>	
			
			<div class="custom-recent-product">
			
			<?php echo do_shortcode( '[recent_products per_page="6" columns="4"]' );  ?>	
			
			
			</div>
			
			

        <?php woo_loop_after(); ?>

		</section><!-- /#main -->
		
		

		<?php woo_main_after(); ?>

		<?php if ( $woo_options[ 'woo_homepage_tweet' ] == "true" || $woo_options[ 'woo_display_store_info' ] == "true" ) { ?>
		<aside id="sidebar" class="col-right">
		<?php } ?>
		
		
			<?php if ( $woo_options[ 'woo_display_store_info' ] == "true" ) {
			$email = get_option('woo_store_email_address');
			$phone = get_option('woo_store_phone_number');
			$twitterID = get_option('woo_contact_twitter');
			?>
				<ul class="store-info">

		
					<li class="shop-about">
						<div class="inner">
							<span><?php _e('About us:','woothemes'); ?></span>

							<?php if( isset( $woo_options['woo_stand_first'] ) ) {
								echo '<p>';
								echo stripslashes( $woo_options['woo_stand_first'] );
								echo '</p>';
							} ?>						
							
						</div>
					</li>
					

					<li class="phone">
						<div class="inner">
							<span><?php _e('Call us:','woothemes'); ?></span>
							<a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
						</div>
					</li>

					<li class="email">
						<div class="inner">
							<span><?php _e('Send us an email:','woothemes'); ?></span>
							<a href="mailto:<?php echo $email; ?>" title="<?php _e('Send us an email', 'woothemes')?>"><?php echo $email; ?></a>
						</div>
					</li>
					
					
					<?php if ( woo_active_sidebar( 'home' ) ) { ?>
						<?php woo_sidebar( 'home' ); ?>		           
					<?php } // End IF Statement ?>  					
					

				</ul><!--/.store-info-->
			<?php } ?>
		<?php if ( $woo_options[ 'woo_homepage_tweet' ] == "true" || $woo_options[ 'woo_display_store_info' ] == "true" ) { ?>
		</aside>
		<?php } ?>

        <?php //get_sidebar(); ?>

    </div><!-- /#content -->

<?php get_footer(); ?>