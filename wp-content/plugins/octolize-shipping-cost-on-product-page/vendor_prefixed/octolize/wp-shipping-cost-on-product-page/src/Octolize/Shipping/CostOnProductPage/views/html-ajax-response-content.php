<?php

namespace OctolizeShippingCostOnProductPageVendor;

/**
 * @var WC_Shipping_Rate[] $methods               .
 * @var string             $formatted_destination .
 * @var string[]           $errors                .
 * @var bool               $include_current_cart  .
 */
\defined('ABSPATH') || exit;
?>

<?php 
if ($errors) {
    ?>
	<div class="scpp-calculator-errors-container js--scpp-calculator-errors-container">
		<p>
			<?php 
    echo \wp_kses_post(\implode('<br />', $errors));
    ?>
		</p>
	</div>
<?php 
} elseif ($methods) {
    ?>
	<p>
		<?php 
    if ($include_current_cart) {
        ?>
			<?php 
        echo \wp_kses_post(\sprintf(
            // translators: open tag, formatted destination, close tag.
            \__('Shipping this product and your current cart contents to %1$s%2$s%3$s costs:', 'octolize-shipping-cost-on-product-page'),
            '<strong>',
            $formatted_destination,
            '</strong>'
        ));
        ?>
		<?php 
    } else {
        ?>
			<?php 
        echo \wp_kses_post(\sprintf(
            // translators: open tag, formatted destination, close tag.
            \__('Shipping this product to %1$s%2$s%3$s costs:', 'octolize-shipping-cost-on-product-page'),
            '<strong>',
            $formatted_destination,
            '</strong>'
        ));
        ?>
		<?php 
    }
    ?>
	</p>

	<ul>
		<?php 
    foreach ($methods as $method) {
        ?>
			<li><?php 
        echo \wp_kses_post(\wc_cart_totals_shipping_method_label($method));
        ?></li>
		<?php 
    }
    ?>
	</ul>
<?php 
} else {
    ?>
	<p>
		<?php 
    echo \wp_kses_post(\apply_filters('woocommerce_cart_no_shipping_available_html', \sprintf(
        // translators: destination address.
        \__('No shipping options were found for %s.', 'octolize-shipping-cost-on-product-page') . ' ',
        '<strong>' . $formatted_destination . '</strong>'
    )));
    ?>
	</p>
<?php 
}
?>

<div class="js--scpp-different-address-container">
	<a href="#0" class="scpp-calculator-open-button js--scpp-calculator-open-button">
		<?php 
\esc_html_e('Enter a different address', 'octolize-shipping-cost-on-product-page');
?>
	</a>
</div>
<?php 
