<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
session_start();
$post = get_post($_SESSION['postID']);
global $product;
$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>
<div class="product-details">
	<div class="woocommerce-product-details__short-description">
		<h3 class="product-details__title">Details </h3>
		<?php echo $short_description; // WPCS: XSS ok. ?>
	</div>

	<div class="product-details__attrs">
		<h3 class="product-details__title">Dimensions </h3>
		<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
	</div>
</div>