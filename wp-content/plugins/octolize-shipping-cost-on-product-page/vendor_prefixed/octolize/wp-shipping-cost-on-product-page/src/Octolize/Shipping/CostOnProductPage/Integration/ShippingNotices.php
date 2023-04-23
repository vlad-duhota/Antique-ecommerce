<?php

/**
 * Class ShippingNotices
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\Integration;

use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CalculatorAjaxDetector;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;
/**
 * .
 */
class ShippingNotices implements \OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    private const LOCATION_KEY = 'product_page';
    /**
     * @var CalculatorAjaxDetector
     */
    private $calculator_detector;
    /**
     * @param CalculatorAjaxDetector $calculator_detector
     */
    public function __construct(\OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CalculatorAjaxDetector $calculator_detector)
    {
        $this->calculator_detector = $calculator_detector;
    }
    /**
     * @return void
     */
    public function hooks() : void
    {
        \add_filter('shipping-notices/pages', [$this, 'add_new_location']);
        \add_filter('shipping-notices/location', [$this, 'support_for_custom_location']);
    }
    /**
     * @param mixed $locations .
     *
     * @return array
     */
    public function add_new_location($locations) : array
    {
        if (!\is_array($locations)) {
            $locations = [];
        }
        $locations[self::LOCATION_KEY] = \_x('Product Page', 'Shipping Notices - location option', 'octolize-shipping-cost-on-product-page');
        return $locations;
    }
    /**
     * @param string|null $location
     *
     * @return string|null
     */
    public function support_for_custom_location(?string $location) : ?string
    {
        if ($this->calculator_detector->get_calculator_state()) {
            return self::LOCATION_KEY;
        }
        return $location;
    }
}
