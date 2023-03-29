<?php
/*
* Plugin Name: Quick Buy Now Button for WooCommerce
* Plugin URI: https://wordpress.org/plugins/quick-buy-now-button-for-woocommerce/
* Description: Makes your customers' checkout process easier and faster and allows you to redirect customers directly to the checkout, cart or any external link for quick purchase.
* Author: Tanvirul Haque
* Version: 1.0.6
* Author URI: http://wpxpress.net
* Text Domain: woo-buy-now-button
* Domain Path: /languages
* Requires PHP: 5.6
* Requires at least: 4.8
* Tested up to: 6.1
* WC tested up to: 7.3
* WC requires at least: 4.6
* License: GPLv2+
*/

// Don't call the file directly
defined( 'ABSPATH' ) or die( 'Keep Silent' );

if ( ! defined( 'WOO_BUY_NOW_BUTTON_PLUGIN_FILE' ) ) {
	define( 'WOO_BUY_NOW_BUTTON_PLUGIN_FILE', __FILE__ );
}

/**
 * Include plugin main class.
 */
if ( ! class_exists( 'Woo_Buy_Now_Button', false ) ) {
	require_once dirname( __FILE__ ) . '/includes/class-woo_buy_now_button.php';
}

/**
 * Require WooCommerce admin message
 */
function woo_buy_now_button_wc_requirement_notice() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		$text = esc_html__( 'WooCommerce', 'woo-buy-now-button' );
		$link = esc_url( add_query_arg(
			array(
				'tab'       => 'plugin-information',
				'plugin'    => 'woocommerce',
				'TB_iframe' => 'true',
				'width'     => '640',
				'height'    => '500',
			),
			admin_url( 'plugin-install.php' )
		) );

		$message = wp_kses( __( "<strong>Quick Buy Now Button for WooCommerce</strong> is an add-on of ", 'woo-buy-now-button' ), array( 'strong' => array() ) );

		printf( '<div class="%1$s"><p>%2$s <a class="thickbox open-plugin-details-modal" href="%3$s"><strong>%4$s</strong></a></p></div>', 'notice notice-error', $message, $link, $text );
	}
}

add_action( 'admin_notices', 'woo_buy_now_button_wc_requirement_notice' );

/**
 * Returns the main instance.
 */
function woo_buy_now_button() {
	if ( ! class_exists( 'WooCommerce', false ) ) {
		return false;
	}

	if ( function_exists( 'woo_buy_now_button_pro' ) ) {
		return woo_buy_now_button_pro();
	}

	return Woo_Buy_Now_Button::instance();
}

add_action( 'plugins_loaded', 'woo_buy_now_button' );