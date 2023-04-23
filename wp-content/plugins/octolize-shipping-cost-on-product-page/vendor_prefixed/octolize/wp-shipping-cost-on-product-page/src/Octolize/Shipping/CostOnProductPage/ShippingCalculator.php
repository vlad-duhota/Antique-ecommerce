<?php

/**
 * Class ShippingCalculator
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage;

use Exception;
use WC_Cart;
use WC_Shipping;
use WC_Shipping_Rate;
/**
 * .
 */
class ShippingCalculator
{
    /**
     * @var WC_Cart
     */
    private $cart;
    /**
     * @var WC_Shipping
     */
    private $shipping;
    /**
     * @param WC_Cart     $cart     .
     * @param WC_Shipping $shipping .
     */
    public function __construct(\WC_Cart $cart, \WC_Shipping $shipping)
    {
        $this->cart = $cart;
        $this->shipping = $shipping;
    }
    /**
     * @param array $packages
     *
     * @return void
     * @throws Exception
     * @codeCoverageIgnore
     */
    public function calculate(array $packages) : void
    {
        // Calculate totals before.
        $this->cart->calculate_totals();
        // Calculate current cart.
        $this->shipping->calculate_shipping($packages);
    }
    /**
     * @return WC_Shipping_Rate[]
     */
    public function get_rates() : array
    {
        // Filter packages.
        $packages = \array_values(\array_filter($this->shipping->get_packages(), function (array $package) {
            return \is_array($package['rates'] ?? null) && !empty($package['rates']);
        }));
        $rates = [];
        foreach ($packages as $package) {
            foreach ($package['rates'] as $rate) {
                $rates[] = $rate;
            }
        }
        return $rates;
    }
}
