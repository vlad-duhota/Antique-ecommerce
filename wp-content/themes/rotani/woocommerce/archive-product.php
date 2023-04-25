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

<section class="hero">
	<div class="container">
		<div class="hero__col_1">
			<p class="hero__uptitle"><?php echo carbon_get_theme_option('shop_uptitle')?></p>
			<h1 class="hero__title"><?php echo carbon_get_theme_option('shop_title')?></h1>
			<p class="hero__subtitle"><?php echo carbon_get_theme_option('shop_subtitle')?></p>
			<div class="hero__tags">
				<p><?php echo carbon_get_theme_option('shop_tag_1')?></p>
				|
				<p><?php echo carbon_get_theme_option('shop_tag_2')?></p>
			</div>
			<div class="hero__text text">
				<?php echo carbon_get_theme_option('shop_text')?>
			</div>
		</div>
		<div class="hero__col_2">
			<?php $heroImg = carbon_get_theme_option('shop_img')?>
			<?php echo wp_get_attachment_image($heroImg, 'full')?>
		</div>
	</div>
</section>


<section class="shop-sec">
	<div class="container">	
		<div>
		<?php if (!carbon_get_theme_option('hp_checkbox')) {?>
		<div class="shop__btns">
			<button class="grid active">
			<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1.03857 6.26709C1.03857 4.61006 1.03857 3.78155 1.31647 3.1309C1.66465 2.3157 2.31247 1.66617 3.12555 1.31708C3.77449 1.03845 4.60083 1.03845 6.25352 1.03845C7.9062 1.03845 8.73254 1.03845 9.38149 1.31708C10.1946 1.66617 10.8424 2.3157 11.1906 3.1309C11.4685 3.78155 11.4685 4.61006 11.4685 6.26709C11.4685 7.92411 11.4685 8.75262 11.1906 9.40327C10.8424 10.2185 10.1946 10.868 9.38149 11.2171C8.73254 11.4957 7.9062 11.4957 6.25352 11.4957C4.60083 11.4957 3.77449 11.4957 3.12555 11.2171C2.31247 10.868 1.66465 10.2185 1.31647 9.40327C1.03857 8.75262 1.03857 7.92411 1.03857 6.26709Z" stroke="#8F8F8F"/>
<path d="M15.5318 6.26709C15.5318 4.61006 15.5318 3.78155 15.8097 3.1309C16.1578 2.3157 16.8057 1.66617 17.6187 1.31708C18.2677 1.03845 19.094 1.03845 20.7467 1.03845C22.3994 1.03845 23.2257 1.03845 23.8747 1.31708C24.6878 1.66617 25.3356 2.3157 25.6838 3.1309C25.9617 3.78155 25.9617 4.61006 25.9617 6.26709C25.9617 7.92411 25.9617 8.75262 25.6838 9.40327C25.3356 10.2185 24.6878 10.868 23.8747 11.2171C23.2257 11.4957 22.3994 11.4957 20.7467 11.4957C19.094 11.4957 18.2677 11.4957 17.6187 11.2171C16.8057 10.868 16.1578 10.2185 15.8097 9.40327C15.5318 8.75262 15.5318 7.92411 15.5318 6.26709Z" stroke="#8F8F8F"/>
<path d="M15.5318 20.7329C15.5318 19.0759 15.5318 18.2474 15.8097 17.5967C16.1578 16.7815 16.8057 16.132 17.6187 15.7829C18.2677 15.5043 19.094 15.5043 20.7467 15.5043C22.3994 15.5043 23.2257 15.5043 23.8747 15.7829C24.6878 16.132 25.3356 16.7815 25.6838 17.5967C25.9617 18.2474 25.9617 19.0759 25.9617 20.7329C25.9617 22.3899 25.9617 23.2184 25.6838 23.8691C25.3356 24.6843 24.6878 25.3338 23.8747 25.6829C23.2257 25.9615 22.3994 25.9615 20.7467 25.9615C19.094 25.9615 18.2677 25.9615 17.6187 25.6829C16.8057 25.3338 16.1578 24.6843 15.8097 23.8691C15.5318 23.2184 15.5318 22.3899 15.5318 20.7329Z" stroke="#8F8F8F"/>
<path d="M1.03857 20.7329C1.03857 19.0759 1.03857 18.2474 1.31647 17.5967C1.66465 16.7815 2.31247 16.132 3.12555 15.7829C3.77449 15.5043 4.60083 15.5043 6.25352 15.5043C7.9062 15.5043 8.73254 15.5043 9.38149 15.7829C10.1946 16.132 10.8424 16.7815 11.1906 17.5967C11.4685 18.2474 11.4685 19.0759 11.4685 20.7329C11.4685 22.3899 11.4685 23.2184 11.1906 23.8691C10.8424 24.6843 10.1946 25.3338 9.38149 25.6829C8.73254 25.9615 7.9062 25.9615 6.25352 25.9615C4.60083 25.9615 3.77449 25.9615 3.12555 25.6829C2.31247 25.3338 1.66465 24.6843 1.31647 23.8691C1.03857 23.2184 1.03857 22.3899 1.03857 20.7329Z" stroke="#8F8F8F"/>
</svg>

	
			</button>
			<button class="line">
			<svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M0 1H27M0 13H27M0 24H27" stroke="#8F8F8F" stroke-linecap="round"/>
			</svg>

			</button>
		</div>
<?php
if ( woocommerce_product_loop()) {


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
			}
		}	
	?>
	</div>
			<div class="shop-sec__time">
					<h3 class="shop-sec__time-title">Sales ends soon!</h3>
				<?php echo str_replace('<style type="text/css">', '', do_shortcode('[ycd_countdown id=16]')) ?>
				</div>
	
<?php

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
