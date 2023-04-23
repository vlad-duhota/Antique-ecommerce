<?php

namespace OctolizeShippingCostOnProductPageVendor;

/**
 * @var array  $value        .
 * @var string $description  .
 * @var string $tooltip_html .
 */
\defined('ABSPATH') || exit;
?>

<tr valign="top">
	<th scope="row" class="titledesc">
		<label for="<?php 
echo \esc_attr($value['id']);
?>">
			<?php 
echo \esc_html($value['title']);
?>
			<?php 
echo $tooltip_html;
// WPCS: XSS ok.
?>
		</label>
	</th>
	<td class="forminp forminp-checkbox">
		<fieldset>
			<label for="<?php 
echo \esc_attr($value['id']);
?>">
				<input
					name="<?php 
echo \esc_attr($value['id']);
?>"
					id="<?php 
echo \esc_attr($value['id']);
?>"
					type="checkbox"
					class="<?php 
echo \esc_attr($value['class'] ?? '');
?>"
					value="1"
					<?php 
\checked($value['value'], 'yes');
?>
				/> <?php 
echo $description;
// WPCS: XSS ok.
?>
			</label>
		</fieldset>
	</td>
</tr>
<?php 
