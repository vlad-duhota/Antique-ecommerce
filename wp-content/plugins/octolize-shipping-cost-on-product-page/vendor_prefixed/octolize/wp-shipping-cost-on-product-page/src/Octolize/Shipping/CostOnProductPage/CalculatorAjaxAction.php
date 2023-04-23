<?php

/**
 * Class CalculatorAjaxAction
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage;

use Exception;
use WC_Countries;
use WC_Customer;
use WC_Product;
use WC_Shortcode_Cart;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;
/**
 * .
 */
class CalculatorAjaxAction implements \OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    public const ACTION = 'octolize_calculate';
    /**
     * @var WC_Countries
     */
    private $countries;
    /**
     * @var ShippingCalculator
     */
    private $shipping_calculator;
    /**
     * @var CreatorShippingPackages
     */
    private $creator_shipping_packages;
    /**
     * @var CalculatorAjaxDetector
     */
    private $calculator_detector;
    /**
     * @var bool
     */
    private $include_current_cart;
    /**
     * @var array
     */
    private $packages = [];
    /**
     * @var WC_Customer
     */
    private $customer;
    /**
     * @param CreatorShippingPackages $creator_shipping_packages .
     * @param ShippingCalculator      $shipping_calculator       .
     * @param WC_Countries            $countries                 .
     * @param CalculatorAjaxDetector  $calculator_detector       .
     * @param WC_Customer             $customer                  .
     * @param bool                    $include_current_cart      .
     */
    public function __construct(\OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CreatorShippingPackages $creator_shipping_packages, \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\ShippingCalculator $shipping_calculator, \WC_Countries $countries, \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CalculatorAjaxDetector $calculator_detector, \WC_Customer $customer, bool $include_current_cart = \true)
    {
        $this->countries = $countries;
        $this->shipping_calculator = $shipping_calculator;
        $this->creator_shipping_packages = $creator_shipping_packages;
        $this->calculator_detector = $calculator_detector;
        $this->include_current_cart = $include_current_cart;
        $this->customer = $customer;
    }
    /**
     * @return void
     */
    public function hooks() : void
    {
        \add_action('wp_ajax_' . self::ACTION, [$this, 'handle_calculate']);
        \add_action('wp_ajax_nopriv_' . self::ACTION, [$this, 'handle_calculate']);
    }
    /**
     * @return void
     */
    public function handle_calculate() : void
    {
        $this->calculator_detector->set_calculator_state(\true);
        $product_ids = \wp_parse_id_list(\wc_clean(\wp_unslash($_REQUEST['product_id'] ?? '0')));
        //phpcs:ignore
        $variation_id = (int) \wc_clean(\wp_unslash($_REQUEST['variation_id'] ?? '0'));
        //phpcs:ignore
        $quantity = (int) \wc_clean(\wp_unslash($_REQUEST['quantity'] ?? '1'));
        //phpcs:ignore
        try {
            foreach ($product_ids as $product_id) {
                $product = $this->get_product($variation_id, $product_id);
                $this->creator_shipping_packages->add_product($product, $quantity);
            }
            $this->set_customer_data();
            $this->packages = $this->creator_shipping_packages->get_shipping_packages($this->customer, $this->include_current_cart);
            \add_filter('flexible-shipping/cart/cart-contents', [$this, 'filter_cart_contents']);
            $this->shipping_calculator->calculate($this->packages);
        } catch (\Exception $e) {
            \wc_add_notice($e->getMessage(), 'error');
        }
        $errors = \wp_list_pluck(\wc_get_notices('error'), 'notice');
        \wc_clear_notices();
        $formatted_destination = $this->get_formatted_address();
        $methods = $this->shipping_calculator->get_rates();
        $include_current_cart = $this->include_current_cart;
        \ob_start();
        include __DIR__ . '/views/html-ajax-response-content.php';
        echo \ob_get_clean();
        //phpcs:ignore
        $this->end_request();
    }
    /**
     * @param mixed $cart_contents .
     *
     * @return array
     */
    public function filter_cart_contents($cart_contents) : array
    {
        return $this->packages[0]['contents'];
    }
    /**
     * @return string
     */
    private function get_formatted_address() : string
    {
        $format_address_args = ['city' => $this->customer->get_shipping_city(), 'state' => $this->customer->get_shipping_state(), 'postcode' => $this->customer->get_shipping_postcode(), 'country' => $this->customer->get_shipping_country()];
        return $this->countries->get_formatted_address($format_address_args, ', ');
    }
    /**
     * @param int $variation_id
     * @param int $product_id
     *
     * @return WC_Product
     * @throws Exception
     */
    private function get_product(int $variation_id, int $product_id) : \WC_Product
    {
        if ($variation_id) {
            $product = \wc_get_product($variation_id);
        } else {
            $product = \wc_get_product($product_id);
        }
        if ($product instanceof \WC_Product) {
            return $product;
        }
        throw new \Exception(\_x('Product not found', 'Error message when user try to calculate cost for unknown products. Protection from cheaters.', 'octolize-shipping-cost-on-product-page'));
    }
    /**
     * @return void
     * @codeCoverageIgnore
     */
    protected function end_request() : void
    {
        die;
    }
    /**
     * @return void
     * @throws Exception
     * @codeCoverageIgnore
     */
    protected function set_customer_data() : void
    {
        \WC_Shortcode_Cart::calculate_shipping();
    }
}
