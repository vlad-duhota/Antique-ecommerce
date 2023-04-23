<?php

/**
 * Class CreatorShippingPackages
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage;

use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\Calculator\CalculatorProduct;
use WC_Cart;
use WC_Customer;
use WC_Product;
use WC_Product_Variation;
/**
 * .
 */
class CreatorShippingPackages
{
    /**
     * @var CalculatorProduct[]
     */
    private $products = [];
    /**
     * @var WC_Cart
     */
    private $cart;
    /**
     * @param WC_Cart $cart .
     */
    public function __construct(\WC_Cart $cart)
    {
        $this->cart = $cart;
    }
    /**
     * @param WC_Product $product  .
     * @param int        $quantity .
     *
     * @return self
     */
    public function add_product(\WC_Product $product, int $quantity = 1) : self
    {
        if (!$product->needs_shipping()) {
            return $this;
        }
        if ($product instanceof \WC_Product_Variation) {
            $product_id = $product->get_parent_id();
            $variation_id = $product->get_id();
        } else {
            $product_id = $product->get_id();
        }
        $this->products[] = $this->get_calculator_product_object($product, $quantity, $product_id, $variation_id ?? 0);
        return $this;
    }
    /**
     * @param bool        $include_current_cart .
     * @param WC_Customer $customer             .
     *
     * @return array
     */
    public function get_shipping_packages(\WC_Customer $customer, bool $include_current_cart = \true) : array
    {
        $packages = $this->get_current_packages($include_current_cart);
        foreach ($this->products as $calculator_product) {
            $packages[0]['contents_cost'] += (float) $calculator_product->get_product()->get_price() * $calculator_product->get_quantity();
            $packages[0]['cart_subtotal'] += (float) $calculator_product->get_product()->get_price() * $calculator_product->get_quantity();
            $packages[0]['contents'][] = $this->get_content_data($calculator_product);
        }
        $packages[0]['destination'] = $this->get_destination_data($customer);
        return $packages;
    }
    /**
     * @param WC_Product $product
     * @param int        $quantity
     * @param int        $product_id
     * @param int        $variation_id
     *
     * @return CalculatorProduct
     * @codeCoverageIgnore
     */
    protected function get_calculator_product_object(\WC_Product $product, int $quantity, int $product_id, int $variation_id) : \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\Calculator\CalculatorProduct
    {
        return new \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\Calculator\CalculatorProduct($product, $quantity, $product_id, $variation_id);
    }
    /**
     * @param CalculatorProduct $calculator_product .
     *
     * @return array
     */
    private function get_content_data(\OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\Calculator\CalculatorProduct $calculator_product) : array
    {
        return ['product_id' => $calculator_product->get_product_id(), 'variation_id' => $calculator_product->get_variation_id(), 'variation' => [], 'quantity' => $calculator_product->get_quantity(), 'data' => $calculator_product->get_product(), 'line_subtotal' => (float) $calculator_product->get_product()->get_price() * $calculator_product->get_quantity(), 'line_total' => (float) $calculator_product->get_product()->get_price() * $calculator_product->get_quantity()];
    }
    /**
     * @param bool $include_current_cart .
     *
     * @return array
     */
    private function get_current_packages(bool $include_current_cart = \true) : array
    {
        if ($include_current_cart) {
            return \array_values($this->cart->get_shipping_packages());
        }
        return $this->get_empty_packages();
    }
    /**
     * @return array[]
     */
    private function get_empty_packages() : array
    {
        return [['contents_cost' => 0, 'cart_subtotal' => 0, 'contents' => [], 'applied_coupons' => [], 'user' => ['ID' => \get_current_user_id()], 'destination' => []]];
    }
    /**
     * @param WC_Customer $customer .
     *
     * @return array
     */
    private function get_destination_data(\WC_Customer $customer) : array
    {
        return ['country' => $customer->get_shipping_country(), 'state' => $customer->get_shipping_state(), 'postcode' => $customer->get_shipping_postcode(), 'city' => $customer->get_shipping_city()];
    }
}
