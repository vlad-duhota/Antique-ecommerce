<?php

/**
 * Class PluginEnabledVisibility
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\ProductPageCalculator;

use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\PluginSettings;
/**
 * .
 */
class PluginEnabledVisibility implements \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\ProductPageCalculator\CalculatorVisibilityInterface
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
        return $this->plugin_settings->is_enabled();
    }
}
