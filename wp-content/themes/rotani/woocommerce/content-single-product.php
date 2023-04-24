<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
session_start();
setup_postdata($_SESSION['postID']);
$product = wc_get_product($_SESSION['postID']);


/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php echo $_SESSION['postID']; ?>" <?php wc_product_class( '', $product ); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>
	      

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	// do_action( 'woocommerce_after_single_product_summary' );
	?> 
	<div class="product-description">
		<h3 class="info-title">Description</h3>
		<?php echo get_post_field('post_content', $_SESSION['postID']); ?>
	</div>
	<div class="product-stars">
		<h3 class="info-title">Condition</h3>
		<ul class="product-stars__list">
		<?php $stars = array(
			0 => "Revive",
			1 => "Fair",
			2 => "Good",
			3 => "Very Good",
			4 => "Like New"
		)?>
		<?php for($i = 0; $i < 5; $i++) : ?>
			<?php if($i !== carbon_get_post_meta($_SESSION['postID'], 'product_stars')) { ?>
			<li>
				<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="8.5" cy="8.5" r="8.5" fill="#D9D9D9"/>
				</svg>
			</li>
			<?php } else {?>
			<li>
				<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M11.3077 1.68656C12.0922 0.441165 13.9078 0.441164 14.6923 1.68656L17.6346 6.35774C17.9082 6.79211 18.3384 7.10463 18.836 7.23062L24.1878 8.5855C25.6147 8.94673 26.1757 10.6734 25.2337 11.8044L21.7004 16.0462C21.3718 16.4406 21.2075 16.9463 21.2415 17.4586L21.6067 22.9671C21.7041 24.4357 20.2353 25.5029 18.8686 24.9565L13.7425 22.9069C13.2659 22.7163 12.7341 22.7163 12.2575 22.9069L7.13141 24.9565C5.76473 25.5029 4.2959 24.4357 4.39327 22.9671L4.7585 17.4586C4.79246 16.9463 4.62816 16.4406 4.2996 16.0462L0.766287 11.8044C-0.17574 10.6734 0.385302 8.94673 1.81216 8.5855L7.16396 7.23062C7.66161 7.10463 8.09177 6.79211 8.36537 6.35774L11.3077 1.68656Z" fill="#A0872A"/>
				</svg>
			</li>
			<?php }?>
		<?php endfor;?>
		</ul>
		<?php $i = -1 ?>
		<ul class="product-stars__text">
			<?php foreach($stars as $star) : $i++;?>
			<?php if($i !== carbon_get_post_meta($_SESSION['postID'], 'product_stars')) { ?>
				<li><?php echo $star?></li>
			<?php } else {?>
				<li class="active"><?php echo $star?></li>
			<?php } ?>
			<?php endforeach;?>
		</ul>
	
		
		<!-- <p>Wear consistent with age and use. <br> 
Please be advised that not all lighting is in working condition unless otherwise stated.  If electrical components are not in working condition upon receipt, we recommend that a qualified electrician reconnect all electrical products.</p> -->
	</div>
	<div class="product-atrrs">
	<h3 class="info-title">Dimensions </h3>
	<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
