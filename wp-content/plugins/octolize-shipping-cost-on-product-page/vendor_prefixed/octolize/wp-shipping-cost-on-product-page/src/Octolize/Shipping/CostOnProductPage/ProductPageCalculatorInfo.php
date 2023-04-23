<?php

/**
 * Class ProductPageCalculatorInfo
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage;

use WC_Countries;
use WC_Customer;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;
/**
 * Add calculator
 */
class ProductPageCalculatorInfo implements \OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * @var PluginSettings
     */
    private $plugin_settings;
    /**
     * @var CalculatorVisibility
     */
    private $calculator_visibility;
    /**
     * @var CalculatorRenderer
     */
    private $calculator_renderer;
    /**
     * @param CalculatorVisibility $calculator_visibility .
     * @param PluginSettings       $plugin_settings       .
     * @param CalculatorRenderer   $calculator_renderer   .
     */
    public function __construct(\OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CalculatorVisibility $calculator_visibility, \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\PluginSettings $plugin_settings, \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CalculatorRenderer $calculator_renderer)
    {
        $this->plugin_settings = $plugin_settings;
        $this->calculator_visibility = $calculator_visibility;
        $this->calculator_renderer = $calculator_renderer;
    }
    /**
     * @return void
     */
    public function hooks() : void
    {
        \add_action($this->plugin_settings->get_calculator_location(), [$this, 'render_container']);
    }
    /**
     * @return void
     */
    public function render_container() : void
    {
        if (!$this->calculator_visibility->is_visible()) {
            return;
        }
        $this->calculator_renderer->render();
    }
}
