<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<h2><?php esc_html_e( 'Order Summary', 'woocommerce' ); ?></h2>

	<div cellspacing="0" class="shop_table shop_table_responsive">

		<div class="cart-subtotal cart-block">
			<h4><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></h4>
			<p data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></p>
		</div>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="cart-discount cart-block coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<h4><?php wc_cart_totals_coupon_label( $coupon ); ?></h4>
				<p data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></p>
		</div>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<div class="cart-block shipping">
				<h4><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></h4>
				<p data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></p>
		</div>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="cart-block fee">
				<h4><?php echo esc_html( $fee->name ); ?></h4>
				<p data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></p>
			</div>
		<?php endforeach; ?>

		<?php
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
				/* translators: %s location. */
				$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
			}

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					?>
					<div class="cart-block tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<h4><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h4>
						<p data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></p>
				</div>
					<?php
				}
			} else {
				?>
				<div class="cart-block tax-total">
					<h4><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h4>
					<p data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></p>
			</div>
				<?php
			}
		}
		?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<div class="cart-block order-total">
			<h4><?php esc_html_e( 'Total', 'woocommerce' ); ?></h4>
			<p data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></p>
	</div>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</div>

	<!-- <div class="wc-proceed-to-checkout"> -->
	<!-- do_action('woocommerce_proceed_to_checkout') -->
	<!-- </div> -->
	<?php
		$objects = "objects:[";
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>

						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						if ($product_permalink )
						$objects .= '   {
							"current_packing": [
							  "no_packing"
							],
							"depth": "3",
							"details": {
							  "creation_date": "1980",
							  "creator": "Bob Smithson",
							  "notes": "Artist signature in the lower left corner",
							  "title":' . "'" . wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name())) . "'" . '
							},
							"height": "32",
							"subtype": "painting_unframed",
							"width": "15",
							"unit_of_measurement": "in",
							"weight": "3.0",
							"weight_unit": "lb",
							"value": "75000",
							"value_currency": "USD"
						  }'
						?>

					
					

					<?php
				}
			}
			?>


<?php
	$objects .= "]";

$url = "https://api.arta.io/hosted_sessions";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/json",
   "Authorization: ARTA_APIKey KVAo7YRbeJz5jn3oDeTFD7Gq",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = <<<DATA
{
  "hosted_session": {
    "additional_services": [
      "signature_delivery"
    ],
    "cancel_url": "http://example.com/cancelled",
    "insurance": "arta_transit_insurance",
    "internal_reference": "Purchase Order: 2801",
    "objects": [
      {
        "current_packing": [
          "no_packing"
        ],
        "depth": "3",
        "details": {
          "creation_date": "1980",
          "creator": "Bob Smithson",
          "notes": "Artist signature in the lower left corner",
          "title": "Black Rectangle"
        },
        "height": "32",
        "subtype": "painting_unframed",
        "width": "15",
        "unit_of_measurement": "in",
        "weight": "3.0",
        "weight_unit": "lb",
        "value": "75000",
        "value_currency": "USD"
      }
    ],
    "origin": {
      "address_line_1": "11 W 53rd St",
      "city": "New York",
      "contacts": [
        {
          "email_address": "mary@example.com",
          "name": "Mary Quinn Sullivan",
          "phone_number": "(333) 333-3333"
        }
      ],
      "country": "US",
      "postal_code": "10019",
      "region": "NY"
    },
    "preferred_quote_types": ["premium", "select", "parcel"],
    "public_reference": "Order #1437",
    "shipping_notes": "New customer",
    "success_url": "http://example.com/success"
  }
}
DATA;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);

?>
<a class="checkout-btn" href="<?php echo json_decode($resp)->url?>">Checkout</a>



	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
