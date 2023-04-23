<?php

/**
 * Class CalculatorAjaxDetector
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage;

/**
 * .
 */
class CalculatorAjaxDetector
{
    /**
     * @var bool
     */
    private $is_calculator = \false;
    /**
     * @return bool
     */
    public function get_calculator_state() : bool
    {
        return $this->is_calculator;
    }
    /**
     * @param bool $state .
     *
     * @return self
     */
    public function set_calculator_state(bool $state) : self
    {
        $this->is_calculator = $state;
        return $this;
    }
}
