<?php

/**
 * Class PluginSettings
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage;

use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\GeneralSettingsFields;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\WooCommerceSettingsPage;
/**
 * Plugin settings.
 */
class PluginSettings
{
    /**
     * @return bool
     */
    public function is_enabled() : bool
    {
        return \wc_string_to_bool($this->get_options()[\OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\GeneralSettingsFields::ENABLED_FIELD] ?? 'no');
    }
    /**
     * @return string
     */
    public function get_calculator_location() : string
    {
        return 'woocommerce_after_add_to_cart_form';
    }
    /**
     * @return bool
     */
    public function is_disabled_virtual_products() : bool
    {
        return \wc_string_to_bool($this->get_options()[\OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\GeneralSettingsFields::VIRTUAL_PRODUCTS_STATUS_FIELD] ?? 'no');
    }
    /**
     * @return string[]
     */
    protected function get_options() : array
    {
        // @phpstan-ignore-next-line
        return (array) \get_option(\OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\WooCommerceSettingsPage::OPTION_NAME, []);
    }
}
