<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;
$product = wc_get_product($_SESSION['postID']);

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);

	
		?>
		<?php 	do_action( 'woocommerce_after_add_to_cart_quantity' );?>
		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?><svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.4 11.3534C15.4 11.3534 15.4 10.6763 15.4 5.18586C15.4 -0.304628 6.46798 -0.485199 6.46798 5.18587V11.3534M4 7.01981H17.5984C19.2193 7.01981 20.5471 8.30728 20.597 9.92737L20.8093 16.8151C20.9137 20.1997 18.1983 23 14.8122 23H7C3.68629 23 1 20.3137 1 17V10.0198C1 8.36296 2.34315 7.01981 4 7.01981Z" stroke="black" stroke-linecap="round"/>
</svg>

</button>
	<div class="pop-up__wishlist">
		
	</div>
	<div class="shipping-widget">
		<div>
			<h3>Shipping</h3>
			<a href="">Calculate Shipping </a> 
		</div>
		<div class="shipping-widget-icon">

		</div>
	</div>
<!-- <button type="button" onClick="Arta.open()">Estimate Shipping</button> -->
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>
	<?php
    // Availability
    $availability = $product->get_availability();
    if ($availability['availability']) :
        echo apply_filters( 'woocommerce_stock_html', '<p class="' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
    endif;
?>
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
	<div class="delivery-variants"></div>
<?php endif; ?>
