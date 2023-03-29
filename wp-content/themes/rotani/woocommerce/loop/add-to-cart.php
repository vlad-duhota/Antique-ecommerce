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
<?php echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>Buy<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M2.35559 3.22066L2.60435 2.51312V2.51312L2.35559 3.22066ZM2.33225 2.41746C1.94149 2.28007 1.51334 2.48548 1.37595 2.87624C1.23857 3.26701 1.44397 3.69516 1.83474 3.83254L2.33225 2.41746ZM4.77708 4.50311L5.39631 4.07995L5.39631 4.07995L4.77708 4.50311ZM6.1332 15.1939L5.58894 15.7099L5.58894 15.7099L6.1332 15.1939ZM21.5187 10.2945L22.2532 10.4459L22.2542 10.4413L21.5187 10.2945ZM20.9981 12.8203L21.7327 12.9717L20.9981 12.8203ZM21.5986 6.97613L21.0042 7.43343L21.5986 6.97613ZM19.931 15.6775L19.4572 15.0961L19.931 15.6775ZM5.91483 10.1667V7.33162H4.41483V10.1667H5.91483ZM2.60435 2.51312L2.33225 2.41746L1.83474 3.83254L2.10683 3.92821L2.60435 2.51312ZM11.3934 16.8958H16.9172V15.3958H11.3934V16.8958ZM5.91483 7.33162C5.91483 6.59432 5.91585 5.9816 5.862 5.48416C5.80634 4.96987 5.68604 4.50394 5.39631 4.07995L4.15785 4.92626C4.25587 5.06969 4.32945 5.26432 4.37072 5.64559C4.41381 6.0437 4.41483 6.56153 4.41483 7.33162H5.91483ZM2.10683 3.92821C2.80156 4.17246 3.26065 4.33516 3.59899 4.50117C3.91771 4.65756 4.06204 4.78605 4.15785 4.92626L5.39631 4.07995C5.10437 3.65274 4.71586 3.37835 4.25974 3.15454C3.82323 2.94036 3.26545 2.74555 2.60435 2.51312L2.10683 3.92821ZM4.41483 10.1667C4.41483 11.6805 4.42911 12.7686 4.57134 13.599C4.72284 14.4835 5.02465 15.1148 5.58894 15.7099L6.67747 14.6779C6.33925 14.3212 6.15688 13.9709 6.04981 13.3458C5.93348 12.6666 5.91483 11.717 5.91483 10.1667H4.41483ZM11.3934 15.3958C9.91848 15.3958 8.89184 15.3941 8.11761 15.2843C7.36923 15.1781 6.96806 14.9844 6.67747 14.6779L5.58894 15.7099C6.20085 16.3554 6.9772 16.6376 7.907 16.7694C8.81095 16.8976 9.96314 16.8958 11.3934 16.8958V15.3958ZM5.16483 7.125H17.801V5.625H5.16483V7.125ZM20.7841 10.1431L20.2635 12.6689L21.7327 12.9717L22.2532 10.4459L20.7841 10.1431ZM17.801 7.125C18.6925 7.125 19.4796 7.126 20.1013 7.1955C20.4103 7.23004 20.6433 7.2782 20.8083 7.33619C20.9794 7.39629 21.0125 7.4443 21.0042 7.43343L22.1931 6.51882C21.9535 6.20739 21.6157 6.02998 21.3056 5.92101C20.9895 5.80994 20.6311 5.74538 20.2679 5.70478C19.5452 5.624 18.6647 5.625 17.801 5.625V7.125ZM22.2542 10.4413C22.4306 9.55722 22.5797 8.81862 22.6162 8.22764C22.6537 7.62032 22.5842 7.02723 22.1931 6.51882L21.0042 7.43343C21.0755 7.52615 21.1468 7.68651 21.1191 8.13523C21.0904 8.60029 20.9683 9.22033 20.7832 10.1477L22.2542 10.4413ZM16.9172 16.8958C17.7115 16.8958 18.375 16.8971 18.9095 16.8317C19.4643 16.7638 19.9668 16.6158 20.4048 16.2589L19.4572 15.0961C19.3205 15.2075 19.1291 15.2937 18.7273 15.3428C18.305 15.3945 17.749 15.3958 16.9172 15.3958V16.8958ZM20.2635 12.6689C20.0956 13.4836 19.9821 14.0278 19.8462 14.431C19.717 14.8146 19.5939 14.9847 19.4572 15.0961L20.4048 16.2589C20.8428 15.902 21.0892 15.4397 21.2677 14.91C21.4396 14.3998 21.5723 13.7496 21.7327 12.9717L20.2635 12.6689Z" fill="white"/>
		<circle cx="7.5" cy="20.5" r="1.5" fill="white"/>
		<circle cx="17.5" cy="20.5" r="1.5" fill="white"/>
		</svg>
		</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_html( $product->add_to_cart_text() )
	),
	$product,
	$args
);?> 

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