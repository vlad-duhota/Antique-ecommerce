<?php

/**
 * Class CalculatorVisibility
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage;

use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\ProductPageCalculator\CalculatorVisibilityInterface;
/**
 * Calculator Visibility.
 */
class CalculatorVisibility
{
    /**
     * @var CalculatorVisibilityInterface[]
     */
    private $visibilities = [];
    /**
     * @param CalculatorVisibilityInterface $visibility
     *
     * @return $this
     */
    public function register(\OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\ProductPageCalculator\CalculatorVisibilityInterface $visibility) : \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CalculatorVisibility
    {
        $this->visibilities[] = $visibility;
        return $this;
    }
    /**
     * @return bool
     */
    public function is_visible() : bool
    {
        foreach ($this->visibilities as $visibility) {
            if (!$visibility->is_visible()) {
                return \false;
            }
        }
        return \true;
    }
}
