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

global $product;

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

		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?><svg width="22" height="15" viewBox="0 0 22 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1.35559 1.22066L1.60435 0.513118V0.513118L1.35559 1.22066ZM1.33225 0.417455C0.941488 0.28007 0.513337 0.485476 0.375951 0.876242C0.238566 1.26701 0.443972 1.69516 0.834738 1.83254L1.33225 0.417455ZM3.77708 2.50311L4.39631 2.07995L4.39631 2.07995L3.77708 2.50311ZM5.1332 13.1939L4.58894 13.7099L4.58894 13.7099L5.1332 13.1939ZM20.5187 8.29453L21.2532 8.44594L21.2542 8.44134L20.5187 8.29453ZM19.9981 10.8203L20.7327 10.9717L19.9981 10.8203ZM20.5986 4.97613L20.0042 5.43343L20.5986 4.97613ZM18.931 13.6775L18.4572 13.0961L18.931 13.6775ZM4.91483 8.16667V5.33162H3.41483V8.16667H4.91483ZM1.60435 0.513118L1.33225 0.417455L0.834738 1.83254L1.10683 1.92821L1.60435 0.513118ZM10.3934 14.8958H15.9172V13.3958H10.3934V14.8958ZM4.91483 5.33162C4.91483 4.59432 4.91585 3.9816 4.862 3.48416C4.80634 2.96987 4.68604 2.50394 4.39631 2.07995L3.15785 2.92626C3.25587 3.06969 3.32945 3.26432 3.37072 3.64559C3.41381 4.0437 3.41483 4.56153 3.41483 5.33162H4.91483ZM1.10683 1.92821C1.80156 2.17246 2.26065 2.33516 2.59899 2.50117C2.91771 2.65756 3.06204 2.78605 3.15785 2.92626L4.39631 2.07995C4.10437 1.65274 3.71586 1.37835 3.25974 1.15454C2.82323 0.940358 2.26545 0.745547 1.60435 0.513118L1.10683 1.92821ZM3.41483 8.16667C3.41483 9.68047 3.42911 10.7686 3.57134 11.599C3.72284 12.4835 4.02465 13.1148 4.58894 13.7099L5.67747 12.6779C5.33925 12.3212 5.15688 11.9709 5.04981 11.3458C4.93348 10.6666 4.91483 9.71699 4.91483 8.16667H3.41483ZM10.3934 13.3958C8.91848 13.3958 7.89184 13.3941 7.11761 13.2843C6.36923 13.1781 5.96806 12.9844 5.67747 12.6779L4.58894 13.7099C5.20085 14.3554 5.9772 14.6376 6.907 14.7694C7.81095 14.8976 8.96314 14.8958 10.3934 14.8958V13.3958ZM4.16483 5.125H16.801V3.625H4.16483V5.125ZM19.7841 8.14313L19.2635 10.6689L20.7327 10.9717L21.2532 8.44593L19.7841 8.14313ZM16.801 5.125C17.6925 5.125 18.4796 5.126 19.1013 5.1955C19.4103 5.23004 19.6433 5.2782 19.8083 5.33619C19.9794 5.39629 20.0125 5.4443 20.0042 5.43343L21.1931 4.51882C20.9535 4.20739 20.6157 4.02998 20.3056 3.92101C19.9895 3.80994 19.6311 3.74538 19.2679 3.70478C18.5452 3.624 17.6647 3.625 16.801 3.625V5.125ZM21.2542 8.44134C21.4306 7.55722 21.5797 6.81862 21.6162 6.22764C21.6537 5.62032 21.5842 5.02723 21.1931 4.51882L20.0042 5.43343C20.0755 5.52615 20.1468 5.68651 20.1191 6.13523C20.0904 6.60029 19.9683 7.22033 19.7832 8.14773L21.2542 8.44134ZM15.9172 14.8958C16.7115 14.8958 17.375 14.8971 17.9095 14.8317C18.4643 14.7638 18.9668 14.6158 19.4048 14.2589L18.4572 13.0961C18.3205 13.2075 18.1291 13.2937 17.7273 13.3428C17.305 13.3945 16.749 13.3958 15.9172 13.3958V14.8958ZM19.2635 10.6689C19.0956 11.4836 18.9821 12.0278 18.8462 12.431C18.717 12.8146 18.5939 12.9847 18.4572 13.0961L19.4048 14.2589C19.8428 13.902 20.0892 13.4397 20.2677 12.91C20.4396 12.3998 20.5723 11.7496 20.7327 10.9717L19.2635 10.6689Z" fill="#010005"/>
</svg>
</button>
	
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

<?php endif; ?>
