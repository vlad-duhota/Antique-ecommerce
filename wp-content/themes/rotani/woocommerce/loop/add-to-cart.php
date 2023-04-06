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
?>
<div class="product__right">
<?php if ( $price_html = $product->get_price_html() ) : ?>
	<p class="price"><?php echo $price_html; ?></p>
<?php endif; ?>
<?php

if( in_array( $product->get_ID(), array_column( WC()->cart->get_cart(), 'product_id' ) ) ) { ?>
	<a class="add_to_cart_button" href="<?php echo get_home_url()?>/cart">View Cart</a>
<?php } else{
	echo apply_filters(
		'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
		sprintf(
			'<a href="%s" data-quantity="%s" class="%s" %s>Add to cart</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			esc_html( $product->add_to_cart_text() )
		),
		$product,
		$args
	);
}
?>
	<?php
    // Availability
    $availability = $product->get_availability();
    if ($availability['availability']) :
        echo apply_filters( 'woocommerce_stock_html', '<p class="add_to_cart_button ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
    endif;
?>

<a href="#" data-subtype="<?php echo carbon_get_post_meta(get_the_ID(), 'product_subtype')[0]?>" data-id="<?php echo get_the_ID()?>" class="product__learn product__learn-btn">Learn More</a>
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