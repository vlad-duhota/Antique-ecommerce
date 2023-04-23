<?php

/**
 * Class CalculatorProduct
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\Calculator;

use WC_Product;
/**
 * .
 */
class CalculatorProduct
{
    /**
     * @var WC_Product
     */
    private $product;
    /**
     * @var int
     */
    private $quantity;
    /**
     * @var int
     */
    private $product_id;
    /**
     * @var int
     */
    private $variation_id;
    /**
     * @param WC_Product $product      .
     * @param int        $quantity     .
     * @param int        $product_id   .
     * @param int        $variation_id .
     */
    public function __construct(\WC_Product $product, int $quantity, int $product_id, int $variation_id)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->product_id = $product_id;
        $this->variation_id = $variation_id;
    }
    /**
     * @return WC_Product
     */
    public function get_product() : \WC_Product
    {
        return $this->product;
    }
    /**
     * @return int
     */
    public function get_quantity() : int
    {
        return $this->quantity;
    }
    /**
     * @return int
     */
    public function get_product_id() : int
    {
        return $this->product_id;
    }
    /**
     * @return int
     */
    public function get_variation_id() : int
    {
        return $this->variation_id;
    }
}
