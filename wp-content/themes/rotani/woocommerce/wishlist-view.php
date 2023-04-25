<?php
/**
 * Wishlist page template - Standard Layout
 *
 * @author YITH
 * @package YITH\Wishlist\Templates\Wishlist\View
 * @version 3.0.0
 */

/**
 * Template variables:
 *
 * @var $wishlist                      \YITH_WCWL_Wishlist Current wishlist
 * @var $wishlist_items                array Array of items to show for current page
 * @var $wishlist_token                string Current wishlist token
 * @var $wishlist_id                   int Current wishlist id
 * @var $users_wishlists               array Array of current user wishlists
 * @var $pagination                    string yes/no
 * @var $per_page                      int Items per page
 * @var $current_page                  int Current page
 * @var $page_links                    array Array of page links
 * @var $is_user_owner                 bool Whether current user is wishlist owner
 * @var $show_price                    bool Whether to show price column
 * @var $show_dateadded                bool Whether to show item date of addition
 * @var $show_stock_status             bool Whether to show product stock status
 * @var $show_add_to_cart              bool Whether to show Add to Cart button
 * @var $show_remove_product           bool Whether to show Remove button
 * @var $show_price_variations         bool Whether to show price variation over time
 * @var $show_variation                bool Whether to show variation attributes when possible
 * @var $show_cb                       bool Whether to show checkbox column
 * @var $show_quantity                 bool Whether to show input quantity or not
 * @var $show_ask_estimate_button      bool Whether to show Ask an Estimate form
 * @var $show_last_column              bool Whether to show last column (calculated basing on previous flags)
 * @var $move_to_another_wishlist      bool Whether to show Move to another wishlist select
 * @var $move_to_another_wishlist_type string Whether to show a select or a popup for wishlist change
 * @var $additional_info               bool Whether to show Additional info textarea in Ask an estimate form
 * @var $price_excl_tax                bool Whether to show price excluding taxes
 * @var $enable_drag_n_drop            bool Whether to enable drag n drop feature
 * @var $repeat_remove_button          bool Whether to repeat remove button in last column
 * @var $available_multi_wishlist      bool Whether multi wishlist is enabled and available
 * @var $no_interactions               bool
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly
?>

<!-- WISHLIST TABLE -->

<div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<div class="cart-top">
				<h3 class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></h3>
				<h3 class="product-total"><?php esc_html_e( 'Total', 'woocommerce' ); ?></h3>
				<h3 class="product-action"><?php esc_html_e( 'Action', 'woocommerce' ); ?></h3>
				<h3 class="product-add"><?php esc_html_e( 'Add a product ', 'woocommerce' ); ?></h3>
		</div>
		<div class="cart-list">
	<?php
	if ( $wishlist && $wishlist->has_items() ) :
		foreach ( $wishlist_items as $item ) :
			/**
			 * Each of the wishlist items
			 *
			 * @var $item \YITH_WCWL_Wishlist_Item
			 */
			global $product;

			$product = $item->get_product();

			if ( $product && $product->exists() ) :
				?>
			<div class="woocommerce-cart-form__cart-item">
				

					<div class="product-thumbnail">
						<?php
						/**
						 * DO_ACTION: yith_wcwl_table_before_product_thumbnail
						 *
						 * Allows to render some content or fire some action before the product thumbnail in the wishlist table.
						 *
						 * @param YITH_WCWL_Wishlist_Item $item     Wishlist item object
						 * @param YITH_WCWL_Wishlist      $wishlist Wishlist object
						 */
						do_action( 'yith_wcwl_table_before_product_thumbnail', $item, $wishlist );
						?>

<a class="product__learn-btn" data-id="<?php echo $product -> get_ID()?>" href="#">
							<?php echo wp_kses_post( $product->get_image() ); ?>
						</a>

						<?php
						/**
						 * DO_ACTION: yith_wcwl_table_after_product_thumbnail
						 *
						 * Allows to render some content or fire some action after the product thumbnail in the wishlist table.
						 *
						 * @param YITH_WCWL_Wishlist_Item $item     Wishlist item object
						 * @param YITH_WCWL_Wishlist      $wishlist Wishlist object
						 */
						do_action( 'yith_wcwl_table_after_product_thumbnail', $item, $wishlist );
						?>
					</div>
					<div class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<h2><a class="product__learn-btn" data-id="<?php echo $product -> get_ID()?>" href="#"><?php echo wp_kses_post( apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ); ?></a></h2>
						<?php if(get_post_meta( $product -> get_ID(), '_product_attributes' )) : ?>
						<?php $firstAttr = array_shift(get_post_meta( $product -> get_ID(), '_product_attributes' )[0])?>
						<p class="product__atr"><?php echo $firstAttr['name']?> : <?php echo $firstAttr['value']?></p>
						<?php endif;?>
						</div>
				
					<?php if ( $show_price || $show_price_variations ) : ?>
						<div class="product-total">
							<?php
							/**
							 * DO_ACTION: yith_wcwl_table_before_product_price
							 *
							 * Allows to render some content or fire some action before the product price in the wishlist table.
							 *
							 * @param YITH_WCWL_Wishlist_Item $item     Wishlist item object
							 * @param YITH_WCWL_Wishlist      $wishlist Wishlist object
							 */
							do_action( 'yith_wcwl_table_before_product_price', $item, $wishlist );
							?>

							<?php
							if ( $show_price ) {
								echo wp_kses_post( $item->get_formatted_product_price() );
							}

							if ( $show_price_variations ) {
								echo wp_kses_post( $item->get_price_variation() );
							}
							?>

							<?php
							/**
							 * DO_ACTION: yith_wcwl_table_after_product_price
							 *
							 * Allows to render some content or fire some action after the product price in the wishlist table.
							 *
							 * @param YITH_WCWL_Wishlist_Item $item     Wishlist item object
							 * @param YITH_WCWL_Wishlist      $wishlist Wishlist object
							 */
							do_action( 'yith_wcwl_table_after_product_price', $item, $wishlist );
							?>
						</div>
					<?php endif ?>

					<?php if ( $show_remove_product ) : ?>
						<div class="product-remove">
							<div>
								<?php
								/**
								 * APPLY_FILTERS: yith_wcwl_remove_product_wishlist_message_title
								 *
								 * Filter the title of the icon to remove the product from the wishlist.
								 *
								 * @param string $title Icon title
								 *
								 * @return string
								 */
								?>
								<a href="<?php echo esc_url( $item->get_remove_url() ); ?>" class="remove remove_from_wishlist" title="<?php echo esc_html( apply_filters( 'yith_wcwl_remove_product_wishlist_message_title', __( 'Remove this product', 'yith-woocommerce-wishlist' ) ) ); ?>">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M9.1709 4C9.58273 2.83481 10.694 2 12.0002 2C13.3064 2 14.4177 2.83481 14.8295 4" stroke="#010005" stroke-width="1.5" stroke-linecap="round"/>
										<path d="M20.5001 6H3.5" stroke="#010005" stroke-width="1.5" stroke-linecap="round"/>
										<path d="M18.8332 8.5L18.3732 15.3991C18.1962 18.054 18.1077 19.3815 17.2427 20.1907C16.3777 21 15.0473 21 12.3865 21H11.6132C8.95235 21 7.62195 21 6.75694 20.1907C5.89194 19.3815 5.80344 18.054 5.62644 15.3991L5.1665 8.5" stroke="#010005" stroke-width="1.5" stroke-linecap="round"/>
										<path d="M9.5 11L10 16" stroke="#010005" stroke-width="1.5" stroke-linecap="round"/>
										<path d="M14.5 11L14 16" stroke="#010005" stroke-width="1.5" stroke-linecap="round"/>
										</svg>
							</a>
							</div>
					</div>
					<?php endif; ?>

						<div class="product-check">
							<a href="<?php echo get_home_url() . '/checkout/?add-to-cart=' . $product -> get_ID()?>">Purchase</a>
						</div>

					<?php if ( $enable_drag_n_drop ) : ?>
						<td class="product-arrange ">
							<i class="fa fa-arrows"></i>
							<input type="hidden" name="items[<?php echo esc_attr( $item->get_product_id() ); ?>][position]" value="<?php echo esc_attr( $item->get_position() ); ?>"/>
						</td>
					<?php endif; ?>
					</div>
				<?php
			endif;
		endforeach;
	else :
		?>
		<div class="woocommerce-cart-form__cart-item">
			<?php
			/**
			 * APPLY_FILTERS: yith_wcwl_no_product_to_remove_message
			 *
			 * Filter the message shown when there are no products in the wishlist.
			 *
			 * @param string             $message  Message
			 * @param YITH_WCWL_Wishlist $wishlist Wishlist object
			 *
			 * @return string
			 */
			?>
			<div colspan="<?php echo esc_attr( $column_count ); ?>" class="wishlist-empty"><?php echo esc_html( apply_filters( 'yith_wcwl_no_product_to_remove_message', __( 'No products added to the favourites', 'yith-woocommerce-wishlist' ), $wishlist ) ); ?></div>
	</div>
		<?php
	endif;

	if ( ! empty( $page_links ) ) :
		?>
		<tr class="pagination-row wishlist-pagination">
			<td colspan="<?php echo esc_attr( $column_count ); ?>">
				<?php echo wp_kses_post( $page_links ); ?>
			</td>
		</tr>
	<?php endif ?>
	</tbody>

</table>
