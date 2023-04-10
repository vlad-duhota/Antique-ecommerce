<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header(  ); ?>

<section class="shop-sec">
	<div class="container">	
		<div class="shop-sec__banner">
			<?php $bannerImg = carbon_get_theme_option('shop_img')?>
			<?php echo wp_get_attachment_image($bannerImg, 'full', [], ["class" => "shop-sec__banner-img"])?>
			<div class="shop-sec__banner-cols">
				<div class="shop-sec__banner-content">
					<h1 class="h1"><?php echo carbon_get_theme_option('shop_title')?></h1>
					<p><?php echo carbon_get_theme_option('shop_text')?></p>
				</div>
				<div class="shop-sec__time">
					<h3 class="shop-sec__time-title">Sales ends soon!</h3>
				<?php echo str_replace('<style type="text/css">', '', do_shortcode('[ycd_countdown id=16]')) ?>
				</div>
			</div>
		</div>
		<div class="shop__btns">
			<button class="grid active">
			<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 6.03498C1 4.43933 1 3.6415 1.2676 3.01495C1.60289 2.22994 2.22672 1.60447 3.00968 1.2683C3.63459 1 4.43032 1 6.0218 1C7.61327 1 8.409 1 9.03391 1.2683C9.81687 1.60447 10.4407 2.22994 10.776 3.01495C11.0436 3.6415 11.0436 4.43933 11.0436 6.03498C11.0436 7.63063 11.0436 8.42846 10.776 9.05501C10.4407 9.84002 9.81687 10.4655 9.03391 10.8017C8.409 11.07 7.61327 11.07 6.0218 11.07C4.43032 11.07 3.63459 11.07 3.00968 10.8017C2.22672 10.4655 1.60289 9.84002 1.2676 9.05501C1 8.42846 1 7.63063 1 6.03498Z" stroke="#D9D9D9" stroke-width="2"/>
<path d="M14.9564 6.03498C14.9564 4.43933 14.9564 3.6415 15.224 3.01495C15.5593 2.22994 16.1831 1.60447 16.9661 1.2683C17.591 1 18.3867 1 19.9782 1C21.5697 1 22.3654 1 22.9903 1.2683C23.7733 1.60447 24.3971 2.22994 24.7324 3.01495C25 3.6415 25 4.43933 25 6.03498C25 7.63063 25 8.42846 24.7324 9.05501C24.3971 9.84002 23.7733 10.4655 22.9903 10.8017C22.3654 11.07 21.5697 11.07 19.9782 11.07C18.3867 11.07 17.591 11.07 16.9661 10.8017C16.1831 10.4655 15.5593 9.84002 15.224 9.05501C14.9564 8.42846 14.9564 7.63063 14.9564 6.03498Z" stroke="#D9D9D9" stroke-width="2"/>
<path d="M14.9564 19.965C14.9564 18.3694 14.9564 17.5715 15.224 16.945C15.5593 16.16 16.1831 15.5345 16.9661 15.1983C17.591 14.93 18.3867 14.93 19.9782 14.93C21.5697 14.93 22.3654 14.93 22.9903 15.1983C23.7733 15.5345 24.3971 16.16 24.7324 16.945C25 17.5715 25 18.3694 25 19.965C25 21.5607 25 22.3585 24.7324 22.985C24.3971 23.7701 23.7733 24.3955 22.9903 24.7317C22.3654 25 21.5697 25 19.9782 25C18.3867 25 17.591 25 16.9661 24.7317C16.1831 24.3955 15.5593 23.7701 15.224 22.985C14.9564 22.3585 14.9564 21.5607 14.9564 19.965Z" stroke="#D9D9D9" stroke-width="2"/>
<path d="M1 19.965C1 18.3694 1 17.5715 1.2676 16.945C1.60289 16.16 2.22672 15.5345 3.00968 15.1983C3.63459 14.93 4.43032 14.93 6.0218 14.93C7.61327 14.93 8.409 14.93 9.03391 15.1983C9.81687 15.5345 10.4407 16.16 10.776 16.945C11.0436 17.5715 11.0436 18.3694 11.0436 19.965C11.0436 21.5607 11.0436 22.3585 10.776 22.985C10.4407 23.7701 9.81687 24.3955 9.03391 24.7317C8.409 25 7.61327 25 6.0218 25C4.43032 25 3.63459 25 3.00968 24.7317C2.22672 24.3955 1.60289 23.7701 1.2676 22.985C1 22.3585 1 21.5607 1 19.965Z" stroke="#D9D9D9" stroke-width="2"/>
</svg>
	
			</button>
			<button class="line">
			<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect x="1" y="3" width="23" height="1" rx="0.5" stroke="#D9D9D9" stroke-width="2"/>
			<rect x="1" y="13" width="23" height="1" rx="0.5" stroke="#D9D9D9" stroke-width="2"/>
			<rect x="1" y="23" width="23" height="1" rx="0.5" stroke="#D9D9D9" stroke-width="2"/>
			</svg>

			</button>
		</div>
<?php
if ( woocommerce_product_loop() ) {


	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' ); ?>
	</div>
</section>
<section class="pop-up">
	<div class="container">
		
	</div>
</section>

<?php get_footer( );
