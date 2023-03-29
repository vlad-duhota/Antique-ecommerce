<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.4.0
 */

defined( 'ABSPATH' ) || exit;
 ?>
<?php 

// $url = "https://api.arta.io/hosted_sessions";

// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// $headers = array(
//    "Content-Type: application/json",
//    "Authorization: ARTA_APIKey KVAo7YRbeJz5jn3oDeTFD7Gq",
// );
// curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

// $data = <<<DATA
// {
//   "hosted_session": {
//     "additional_services": [
//       "signature_delivery"
//     ],
//     "cancel_url": "http://example.com/cancelled",
//     "insurance": "arta_transit_insurance",
//     "internal_reference": "Purchase Order: 2801",
//     "objects": [
//       {
//         "current_packing": [
//           "no_packing"
//         ],
//         "depth": "3",
//         "details": {
//           "creation_date": "1980",
//           "creator": "Bob Smithson",
//           "notes": "Artist signature in the lower left corner",
//           "title": "Black Rectangle"
//         },
//         "height": "32",
//         "subtype": "painting_unframed",
//         "width": "15",
//         "unit_of_measurement": "in",
//         "weight": "3.0",
//         "weight_unit": "lb",
//         "value": "75000",
//         "value_currency": "USD"
//       }
//     ],
//     "origin": {
//       "address_line_1": "11 W 53rd St",
//       "city": "New York",
//       "contacts": [
//         {
//           "email_address": "mary@example.com",
//           "name": "Mary Quinn Sullivan",
//           "phone_number": "(333) 333-3333"
//         }
//       ],
//       "country": "US",
//       "postal_code": "10019",
//       "region": "NY"
//     },
//     "preferred_quote_types": ["premium", "select", "parcel"],
//     "public_reference": "Order #1437",
//     "shipping_notes": "New customer",
//     "success_url": "http://example.com/success"
//   }
// }
// DATA;

// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

// //for debug only!
// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// $resp = curl_exec($curl);
// curl_close($curl);
// var_dump(json_decode($resp)->url);



// add_filter( 'woocommerce_package_rates', 'custom_shipping_cost', 10, 2 );
// function custom_shipping_cost( $rates, $package ) {
//     $new_rates = array();

//     foreach ( $rates as $rate_id => $rate ) {
//         $new_rates[ $rate_id ] = $rate;
//         $new_rates[ $rate_id ]->cost += 5; // add $5 shipping cost to all rates
//     }

//     return $new_rates;
// }


// $url = "https://api.arta.io/requests";

// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// $headers = array(
//    "Content-Type: application/json",
//    "Authorization: ARTA_APIKey KVAo7YRbeJz5jn3oDeTFD7Gq",
//    "Arta-Quote-Timeout: 6000",
// );
// curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

// $data = '{"request":{"additional_services":["origin_condition_check"],"currency":"USD","destination":{"access_restrictions":["stairs_only"],"address_line_1":"11 W 53rd St","address_line_2":"string","address_line_3":"string","city":"New York","region":"NY","postal_code":"10019","country":"US","title":"Gallery","contacts":[{"name":"Mary Quinn Sullivan","email_address":"mary@example.com","phone_number":"(333) 333-3333"}]},"insurance":"arta_transit_insurance","internal_reference":"Purchase Order: 2801","objects":[{"internal_reference":"Accession ID: 823","current_packing":["no_packing"],"depth":"3","details":{"materials":["canvas"],"creation_date":"1980","creator":"Bob Smithson","notes":"Artist signature in the lower left corner","title":"Black Rectangle","is_fragile":false,"is_cites":false},"height":"32","images":["http://example.com/image.jpg"],"public_reference":"Round Smithson work","subtype":"painting_unframed","width":"15","unit_of_measurement":"in","weight":"3.0","weight_unit":"lb","value":"2500","value_currency":"USD"}],"origin":{"access_restrictions":["non_paved"],"address_line_1":"87 Richardson St","address_line_2":"string","address_line_3":"string","city":"Brooklyn","region":"NY","postal_code":"11249","country":"US","title":"Warehouse","contacts":[{"name":"Rachel Egistrar","email_address":"registrar@example.com","phone_number":"(212) 123-4567"}]},"preferred_quote_types":["parcel"],"public_reference":"Order #1437","shipping_notes":"New customer"}}';

// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

// //for debug only!
// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// $resp = curl_exec($curl);
// curl_close($curl);
// $totalValue = 0;
// foreach(json_decode($resp)->quotes as $item){
// 	print_r($item->total);
// 	$totalValue += $item->total;
// }

// ?>


<?php

// $url = "https://api.arta.io/requests";

// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// $headers = array(
//    "Authorization: ARTA_APIKey KVAo7YRbeJz5jn3oDeTFD7Gq",
// );
// curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
// //for debug only!
// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// $resp = curl_exec($curl);
// curl_close($curl);
// echo json_decode($resp)->metadata->total_count;

?>

<section class="cart-sec wooc-sec">
	<div class="container">
		<h1 class="h2">Your Shopping Cart </h1>
		<?php if ( function_exists('woocommerce_breadcrumb') ) {
    woocommerce_breadcrumb();
}?>
		<div class="cart-sec__cols">
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<div class="cart-top">
				<h3 class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></h3>
				<h3 class="product-total"><?php esc_html_e( 'Total', 'woocommerce' ); ?></h3>
				<h3 class="product-action"><?php esc_html_e( 'Action', 'woocommerce' ); ?></h3>
		</div>
		<div class="cart-list">
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<div class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">


						<div class="product-thumbnail">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
						</div>

						<div class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<h2><?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name() . ' X ' . $cart_item['quantity'], $cart_item, $cart_item_key ) . '&nbsp;' ); ?></h2>
						<?php do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						?>
						<?php $firstAttr = array_shift(get_post_meta( $product_id , '_product_attributes' )[0])?>
						<p class="product__atr"><?php echo $firstAttr['name']?> : <?php echo $firstAttr['value']?></p>
						</div>

						<div class="product-total" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</div>
						<div class="product-remove">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M9.1709 4C9.58273 2.83481 10.694 2 12.0002 2C13.3064 2 14.4177 2.83481 14.8295 4" stroke="#010005" stroke-width="1.5" stroke-linecap="round"/>
										<path d="M20.5001 6H3.5" stroke="#010005" stroke-width="1.5" stroke-linecap="round"/>
										<path d="M18.8332 8.5L18.3732 15.3991C18.1962 18.054 18.1077 19.3815 17.2427 20.1907C16.3777 21 15.0473 21 12.3865 21H11.6132C8.95235 21 7.62195 21 6.75694 20.1907C5.89194 19.3815 5.80344 18.054 5.62644 15.3991L5.1665 8.5" stroke="#010005" stroke-width="1.5" stroke-linecap="round"/>
										<path d="M9.5 11L10 16" stroke="#010005" stroke-width="1.5" stroke-linecap="round"/>
										<path d="M14.5 11L14 16" stroke="#010005" stroke-width="1.5" stroke-linecap="round"/>
										</svg>
										</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</div>
					</div>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>
			<tr>
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</div>
		</div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
</div>
</div>
</section>
