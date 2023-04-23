<?php

/**
 * Class CheckboxField
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\Field;

use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;
/**
 * .
 */
class CheckboxField implements \OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    public const FIELD_ID = 'scopp_checkbox';
    /**
     * @return void
     */
    public function hooks() : void
    {
        \add_action('woocommerce_admin_field_' . self::FIELD_ID, [$this, 'render_field']);
        \add_filter('woocommerce_admin_settings_sanitize_option', [$this, 'save_field'], 10, 3);
    }
    /**
     * @param array $value
     *
     * @return void
     */
    public function render_field(array $value) : void
    {
        $description = $value['desc'] ?? '';
        $tooltip_html = \wc_help_tip($value['desc_tip'] ?? '');
        include __DIR__ . '/views/html-checkbox-field.php';
    }
    /**
     * @param mixed $value     .
     * @param array $option    .
     * @param mixed $raw_value .
     *
     * @return mixed
     */
    public function save_field($value, array $option, $raw_value)
    {
        if ($option['type'] !== self::FIELD_ID) {
            return $value;
        }
        return \wc_bool_to_string($raw_value);
    }
}
