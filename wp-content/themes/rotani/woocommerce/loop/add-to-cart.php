<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$availability = $product->get_availability();
$price_html = $product->get_price_html()
?>
<div class="product__right">
<?php if ( $price_html && ($availability['availability'] !== 'Sold')) : ?>
	<p class="price"><?php echo $price_html; ?></p>
<?php endif; ?>
<?php
// if( in_array( $product->get_ID(), array_column( WC()->cart->get_cart(), 'product_id' ) ) ) { ?>
	<!-- <a class="add_to_cart_button" href="<?php echo get_home_url()?>/cart">View Cart</a> -->
<?php 
// 
	// echo apply_filters(
	// 	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	// 	sprintf(
	// 		'<a href="%s" data-quantity="%s" class="%s" %s>Add to cart<svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
	// 		<path d="M15.4 11.3534C15.4 11.3534 15.4 10.6763 15.4 5.18586C15.4 -0.304628 6.46798 -0.485199 6.46798 5.18587V11.3534M4 7.01981H17.5984C19.2193 7.01981 20.5471 8.30728 20.597 9.92737L20.8093 16.8151C20.9137 20.1997 18.1983 23 14.8122 23H7C3.68629 23 1 20.3137 1 17V10.0198C1 8.36296 2.34315 7.01981 4 7.01981Z" stroke="black" stroke-linecap="round"/>
	// 		</svg>
	// 		</a>',
	// 		esc_url( $product->add_to_cart_url() ),
	// 		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
	// 		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
	// 		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
	// 		esc_html( $product->add_to_cart_text() )
	// 	),
	// 	$product,
	// 	$args
	// );

// }
 ?>
<?php if (($availability['availability'] !== 'Sold')) : ?>
	<?php 	echo do_shortcode('[yith_wcwl_add_to_wishlist]');?>
<?php endif; ?>
	<?php
    // Availability
    if ($availability['availability']) :
        echo apply_filters( 'woocommerce_stock_html', '<p class="' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
    endif;
?>


	<a href="#" data-id="<?php echo get_the_ID()?>" class="product__learn product__learn-btn">Learn More</a>
	<!-- <div class="info" style="display: none"
	data-address="<?php echo carbon_get_post_meta(get_the_ID(), 'product_address')?>"
	data-city="<?php echo carbon_get_post_meta(get_the_ID(), 'product_city')?>"
	data-region="<?php echo carbon_get_post_meta(get_the_ID(), 'product_region')?>"
	data-country="<?php echo carbon_get_post_meta(get_the_ID(), 'product_country')?>"
	data-postal="<?php echo carbon_get_post_meta(get_the_ID(), 'product_postal')?>"
	data-length="<?php echo $product->get_dimensions(false)['length']?>"
	data-width="<?php echo $product->get_dimensions(false)['width']?>"
	data-height="<?php echo $product->get_dimensions(false)['height']?>"
	data-weight="<?php echo $product->get_weight();?>">
	</div> -->

</div>