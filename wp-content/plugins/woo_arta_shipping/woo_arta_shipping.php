<?php
/**
 * Plugin Name: woo_arta_shipping
 * Plugin URI: https://woo_arta_shipping/
 * Description: ARTA Shipping method for woocommerce.
 * Version: 1.0.0
 * Author: superpuperlesha
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
	require_once __DIR__.'/class-shipping.php';
}else{
	add_action( 'admin_notices', function (){
		echo'<div class="error">
                <h3>'.__('Woocommerce plugin is required to use the plugin [woo_arta_shipping] !', 'woo_arta_shipping').'</h3>
             </div>';
	} );
}