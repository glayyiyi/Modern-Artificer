<?php 
/**
 * Sidebar Template
 *
 * If a `primary` widget area is active and has widgets, display the sidebar.
 *
 * @package WooFramework
 * @subpackage Template
 */
	global $woo_options;
	
	if ( isset( $woo_options['woo_layout'] ) && ( $woo_options['woo_layout'] != 'layout-full' ) ) {
?>	
<aside id="sidebar" class="col-right">

	<?php woo_sidebar_inside_before(); ?>

	
			<?php 
				if( is_woocommerce_activated() && is_product() || is_shop() || is_product_tag() || is_product_category()) {
					if ( woo_active_sidebar( 'shop-sidebar' ) ) { woo_sidebar( 'shop-sidebar' ); } 
				} else {
			?>
		
		
	<?php if ( woo_active_sidebar( 'primary' ) ) { ?>	
		
		<?php woo_sidebar( 'primary' ); ?>	
		
	<?php } }  // End else Statement ?>   
	
	<?php woo_sidebar_inside_after(); ?> 
	
</aside><!-- /#sidebar -->
<?php } // End IF Statement ?>