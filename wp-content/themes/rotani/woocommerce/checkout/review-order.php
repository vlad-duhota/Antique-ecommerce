<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="checkout-review">
<div class="shop_table woocommerce-checkout-review-order-table">
	<div class="checkout-products">
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
				<?php $image = get_post_thumbnail_id( $product_id )?>
				<?php echo wp_get_attachment_image($image, 'full')?>
				<div class="checkout__product-right">
					<h4 class="product-name">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
						<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', '', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</h4>
					<p class="product-total">
						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</p>
					</div>
			</div>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</div>
	<div class="checkout-total">

		<div class="checkout-block">
			<h4><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></h4>
			<p><?php wc_cart_totals_subtotal_html(); ?></p>
		</div>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="checkout-block cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<h4><?php wc_cart_totals_coupon_label( $coupon ); ?></h4>
				<p><?php wc_cart_totals_coupon_html( $coupon ); ?></p>
		</div>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="fee checkout-block">
				<h4><?php echo esc_html( $fee->name ); ?></h4>
				<p><?php wc_cart_totals_fee_html( $fee ); ?></p>
		</div>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
					<div class="tax-rate checkout-block tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<h4><?php echo esc_html( $tax->label ); ?></h4>
						<p><?php echo wp_kses_post( $tax->formatted_amount ); ?></p>
				</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="tax-total checkout-block">
					<h4><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></h4>
					<p><?php wc_cart_totals_taxes_total_html(); ?></p>
			</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<div class="checkout-block order-total">
			<h4><?php esc_html_e( 'Total', 'woocommerce' ); ?></h4>
			<p><?php wc_cart_totals_order_total_html(); ?></p>
		</div>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

		</div>
			</div>
