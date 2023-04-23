<?php

/**
 * Class WooCommerceSettingsPage
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings;

use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\SettingsFields;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;
/**
 * .
 */
class WooCommerceSettingsPage implements \OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    public const SECTION_ID = 'shipping-costs-on-product-page-settings';
    public const OPTION_NAME = 'woocommerce_shipping_costs_product_page';
    /**
     * @var SettingsFields
     */
    private $general_settings_fields;
    /**
     * @param SettingsFields $general_settings_fields
     */
    public function __construct(\OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\SettingsFields $general_settings_fields)
    {
        $this->general_settings_fields = $general_settings_fields;
    }
    /**
     * @return void
     */
    public function hooks() : void
    {
        \add_filter('woocommerce_get_sections_shipping', [$this, 'add_section_to_array']);
        \add_filter('woocommerce_get_settings_shipping', [$this, 'get_section_settings_fields'], 10, 2);
    }
    /**
     * @param array<string, string> $sections .
     *
     * @return array<string, string>
     */
    public function add_section_to_array($sections) : array
    {
        $sections[self::SECTION_ID] = \__('Shipping Cost on Product Page', 'octolize-shipping-cost-on-product-page');
        return $sections;
    }
    /**
     * @param array<string, array<string, array<string, float|string>|float|string>> $settings        .
     * @param string                                                                 $current_section .
     *
     * @return array<string, array<string, array<string, float|string>|float|string>>
     */
    public function get_section_settings_fields($settings, string $current_section) : array
    {
        if (self::SECTION_ID !== $current_section) {
            return $settings;
        }
        $fields = $this->general_settings_fields->get_settings_fields();
        \array_walk($fields, function (array &$field) {
            // @phpstan-ignore-next-line
            $field['id'] = $this->prepare_settings_field_id($field['id'] ?? '');
        });
        return $fields;
    }
    /**
     * @param string $field_name .
     *
     * @return string
     */
    private function prepare_settings_field_id(string $field_name) : string
    {
        return \sprintf('%1$s[%2$s]', self::OPTION_NAME, $field_name);
    }
}
