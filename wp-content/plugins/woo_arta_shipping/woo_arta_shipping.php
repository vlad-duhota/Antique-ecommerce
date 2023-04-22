<?php
/**
 * Plugin Name: woo_arta_shipping
 * Plugin URI: https://woo_arta_shipping/
 * Description: ARTA Shipping method for woocommerce.
 * Version: 1.0.0
 * Author: superpuperlesha@gmail.com
 * Author URI: https://superpuperlesha.com/
 * Text Domain: woo_arta_shipping
 * License: GPLv2
 * Released under the GNU General Public License (GPL)
 * https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}


if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require_once __DIR__ . '/class-shipping.php';
}else{
	add_action( 'admin_notices', function (){
		echo'<div class="error">
                <h3>'.__('Woocommerce plugin is required to use the plugin [woo_arta_shipping] !', 'woo_arta_shipping').'</h3>
             </div>';
	} );
}


/*$ARTA_Shipping_Method = new Arta_Shipping_Method();
$key                  = $ARTA_Shipping_Method->settings['apikey'];
$product_width        = 30;
$product_height       = 40;
$length               = 30;
$product_weight       = 5;
$product_price        = 100;
$quantity             = 1;
$product_country      = 'US';
$product_region       = '';
$product_city         = '';
$product_postal       = '10001';
$product_address      = '';
$dest_country         = 'US';
$dest_region          = '';
$dest_city            = '';
$dest_postal          = '89714';
$dest_addr            = '';
$arta                 = Arta_Shipping_Method::arta_request_cost( $key, $product_width, $product_height, $length,
	$product_weight, $product_price, $quantity, $product_country, $product_region, $product_city, $product_postal,
	$product_address, $dest_country, $dest_region, $dest_city, $dest_postal, $dest_addr );
echo '<pre>';
print_r( $arta );
echo '</pre>';*/


/*
 * Only 1 product in cart
 */
add_filter( 'woocommerce_add_cart_item_data', 'woo_arta_shipping_empty_cart', 10,  3);
function woo_arta_shipping_empty_cart( $cart_item_data, $product_id, $variation_id ){
	global $woocommerce;
	$woocommerce->cart->empty_cart();
	return $cart_item_data;
}


// Display admin product custom setting field(s)
add_action('woocommerce_product_options_general_product_data', 'woo_arta_shipping_woocommerce_product_custom_fields');
function woo_arta_shipping_woocommerce_product_custom_fields() {
	global $product_object;

	//echo '<div class="product_custom_field ">';
	woocommerce_wp_text_input( array(
		'id'          => 'woo_arta_ship_product_country',
		'label'       => __('Arta Country:', 'woocommerce' ),
		'placeholder' => 'US',
		'desc_tip'    => 'true',
		'description' => __('Arta Country format: US', 'woocommerce' ),
		'value'       => get_post_meta( $product_object->get_id(), 'woo_arta_ship_product_country', true ),
	) );

	woocommerce_wp_text_input( array(
		'id'          => 'woo_arta_ship_product_zip',
		'label'       => __('Arta ZIP:', 'woocommerce' ),
		'placeholder' => 'US',
		'desc_tip'    => 'true',
		'description' => __('Arta ZIP format: 10001', 'woocommerce' ),
		'value'       => get_post_meta( $product_object->get_id(), 'woo_arta_ship_product_zip', true ),
	) );
	//echo '</div>';
}

// Save admin product custom setting field(s) values
add_action('woocommerce_admin_process_product_object', 'woo_arta_shipping_woocommerce_product_custom_fields_save');
function  woo_arta_shipping_woocommerce_product_custom_fields_save( $product ) {
	if ( isset( $_POST['woo_arta_ship_product_country'] ) ) {
		update_post_meta( $product->get_id(), 'woo_arta_ship_product_country', htmlspecialchars( $_POST['woo_arta_ship_product_country'] ) );
	}
	if ( isset( $_POST['woo_arta_ship_product_zip'] ) ) {
		update_post_meta( $product->get_id(), 'woo_arta_ship_product_zip', htmlspecialchars( $_POST['woo_arta_ship_product_zip'] ) );
	}
}