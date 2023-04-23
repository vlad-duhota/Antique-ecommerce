<?php

/**
 * Class PluginEnabledVisibility
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\ProductPageCalculator;

use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\PluginSettings;
/**
 * .
 */
class VirtualProductDisabledVisibility implements \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\ProductPageCalculator\CalculatorVisibilityInterface
{
    /**
     * @var PluginSettings
     */
    private $plugin_settings;
    /**
     * @param PluginSettings $plugin_settings .
     */
    public function __construct(\OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\PluginSettings $plugin_settings)
    {
        $this->plugin_settings = $plugin_settings;
    }
    /**
     * @return bool
     */
    public function is_visible() : bool
    {
        if (!$this->plugin_settings->is_disabled_virtual_products()) {
            return \true;
        }
        $product = \wc_get_product();
        return !$product->is_virtual();
    }
}
