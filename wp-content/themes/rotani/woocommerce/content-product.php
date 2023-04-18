<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
<div class="product__left">
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );?>
	<div class="product__title">
	<?php
	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );?>
	<?php if(get_post_meta( get_the_ID() , '_product_attributes' )) : ?>
	<?php $firstAttr = array_shift(get_post_meta( get_the_ID() , '_product_attributes' )[0])?>
	<p class="product__atr"><?php echo $firstAttr['name']?> : <?php echo $firstAttr['value']?></p>
		<?php endif;?>
<?php
$tags = get_the_terms( $post->ID, 'product_tag' );
if($tags){
foreach($tags as $tag){
	if($tag->to_array()['name'] === 'Popular'){?>
	<p class="popular-tag">
	<svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17 12.9162C17 17.3658 14.2183 19.3183 12.0687 19.9768C11.6103 20.1172 11.3091 19.5912 11.5833 19.2033C12.5187 17.8801 13.6 15.8612 13.6 13.962C13.6 11.922 11.8532 9.51347 10.4891 8.02794C10.1773 7.68832 9.63333 7.91304 9.61632 8.37053C9.55998 9.88618 9.317 11.914 8.26925 13.5033C8.1006 13.7591 7.7426 13.7803 7.55045 13.5411C7.22308 13.1335 6.89571 12.6301 6.56834 12.2324C6.392 12.0182 6.07329 12.0152 5.8699 12.2048C5.07689 12.9439 3.96667 14.0965 3.96667 15.5308C3.96667 16.5033 4.34945 17.5229 4.78132 18.3433C5.01891 18.7946 4.59645 19.3378 4.13921 19.1016C2.24513 18.1232 0 16.1412 0 12.9162C0 9.62543 4.57968 5.06681 6.32831 0.760056C6.60423 0.0804652 7.45459 -0.238873 8.04604 0.204612C11.6279 2.89044 17 8.08233 17 12.9162Z" fill="#DF2828"/>
</svg>
Popular
	</p>
	<?php } }
	}?>
</div>
	<?php
	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
	</div>
	<?php
	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
