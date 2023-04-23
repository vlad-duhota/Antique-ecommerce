<?php
/**
 * Plugin Name: Shipping Cost on Product Page
 * Plugin URI: https://wordpress.org/plugins/octolize-shipping-cost-on-product-page/
 * Description: Let your customers calculate and see the shipping cost on product pages based on the entered shipping destination and cart contents.
 * Version: 1.3.4
 * Author: Octolize
 * Author URI: https://octol.io/scpp-author
 * Text Domain: octolize-shipping-cost-on-product-page
 * Domain Path: /lang/
 * Requires at least: 5.8
 * Tested up to: 6.2
 * WC requires at least: 7.2
 * WC tested up to: 7.6
 * Requires PHP: 7.4
 * ​
 * ​
 * Copyright 2022 Octolize Ltd.
 * ​
 * ​
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

use Octolize\Shipping\CostOnProductPage\Plugin;

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/vendor/autoload.php';

/* THIS VARIABLE CAN BE CHANGED AUTOMATICALLY */
$plugin_version = '1.3.4';

$plugin_name        = 'Shipping Cost on Product Page';
$plugin_class_name  = Plugin::class;
$plugin_text_domain = 'octolize-shipping-cost-on-product-page';
$product_id         = 'Shipping Cost on Product Page';
$plugin_file        = __FILE__;
$plugin_dir         = __DIR__;

/* Constants */
define( 'OCTOLIZE_SHIPPING_COST_ON_PRODUCT_PAGE_VERSION', $plugin_version );
define( 'OCTOLIZE_SHIPPING_COST_ON_PRODUCT_PAGE_SCRIPT_VERSION', 4 );

$requirements = [
	'php'          => '7.4',
	'wp'           => '5.7',
	'repo_plugins' => [
		[
			'name'      => 'woocommerce/woocommerce.php',
			'nice_name' => 'WooCommerce',
			'version'   => '6.6',
		],
	],
];

require __DIR__ . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/plugin-init-php52-free.php';
