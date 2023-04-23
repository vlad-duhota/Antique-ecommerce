<?php

namespace OctolizeShippingCostOnProductPageVendor;

/**
 * @var string       $id                .
 * @var string       $title             .
 * @var string       $description       .
 * @var string       $customer_country  .
 * @var string       $customer_state    .
 * @var string       $customer_postcode .
 * @var string       $customer_city     .
 * @var WC_Countries $countries         .
 * @var string[]     $states            .
 * @var array        $fields            .
 */
\defined('ABSPATH') || exit;
?>

<div id="<?php 
echo \esc_attr($id);
?>" class="woocommerce-shipping-calculator scpp-shipping-calculator-container js--scpp-shipping-calculator-container">
	<a href="#0" class="scpp-calculator-open-button js--scpp-calculator-open-button">
		<?php 
echo \wp_kses_post($title);
?>
	</a>

	<div class="scpp-results-container js--scpp-results-container"></div>

	<div class="scpp-calculator-container js--scpp-calculator-container">

		<?php 
foreach ($fields as $field_name => $field_value) {
    ?>
			<input type="hidden" name="<?php 
    echo \esc_attr($field_name);
    ?>" value="<?php 
    echo \esc_attr($field_value);
    ?>"/>
		<?php 
}
?>

		<p><?php 
echo \wp_kses_post($description);
?></p>

		<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state country_select" rel="calc_shipping_state">
			<option value="default"><?php 
\esc_html_e('Select a country / region…', 'octolize-shipping-cost-on-product-page');
?></option>
			<?php 
foreach ($countries->get_shipping_countries() as $key => $value) {
    echo '<option value="' . \esc_attr($key) . '"' . \selected($customer_country, \esc_attr($key), \false) . '>' . \esc_html($value) . '</option>';
}
?>
		</select>

		<?php 
if (\is_array($states) && empty($states)) {
    ?>
			<input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php 
    \esc_attr_e('State / County', 'octolize-shipping-cost-on-product-page');
    ?>"/>
		<?php 
} elseif (\is_array($states)) {
    ?>
			<select name="calc_shipping_state" class="state_select" id="calc_shipping_state" data-placeholder="<?php 
    \esc_attr_e('State / County', 'octolize-shipping-cost-on-product-page');
    ?>">
				<option value=""><?php 
    \esc_html_e('Select an option…', 'octolize-shipping-cost-on-product-page');
    ?></option>
				<?php 
    foreach ($states as $state_code => $state_name) {
        echo '<option value="' . \esc_attr($state_code) . '" ' . \selected($customer_state, $state_code, \false) . '>' . \esc_html($state_name) . '</option>';
    }
    ?>
			</select>
		<?php 
} else {
    // @phpstan-ignore-line
    ?>
			<input type="text" class="input-text" value="<?php 
    echo \esc_attr($customer_state);
    ?>" placeholder="<?php 
    \esc_attr_e('State / County', 'octolize-shipping-cost-on-product-page');
    ?>" name="calc_shipping_state" id="calc_shipping_state"/>
		<?php 
}
?>

		<input type="text" class="input-text" value="<?php 
echo \esc_attr($customer_city);
?>" placeholder="<?php 
\esc_attr_e('City', 'octolize-shipping-cost-on-product-page');
?>" name="calc_shipping_city" id="calc_shipping_city"/>

		<input type="text" class="input-text" value="<?php 
echo \esc_attr($customer_postcode);
?>" placeholder="<?php 
\esc_attr_e('Postcode / ZIP', 'octolize-shipping-cost-on-product-page');
?>" name="calc_shipping_postcode" id="calc_shipping_postcode"/>

		<div>
			<a href="#0" class="scpp-calculate-button js--scpp-calculate-button"><?php 
\esc_html_e('Calculate', 'octolize-shipping-cost-on-product-page');
?></a>
		</div>
	</div>
</div>
<?php 
