<?php

/**
 * Class CalculatorRenderer
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage;

use WC_Countries;
use WC_Customer;
/**
 * Calculator Renderer
 */
class CalculatorRenderer
{
    /**
     * @var WC_Customer
     */
    private $customer;
    /**
     * @var WC_Countries
     */
    private $countries;
    /**
     * @var array
     */
    private $fields = [];
    /**
     * @param WC_Customer  $customer  .
     * @param WC_Countries $countries .
     */
    public function __construct(\WC_Customer $customer, \WC_Countries $countries)
    {
        $this->customer = $customer;
        $this->countries = $countries;
    }
    /**
     * @param string $key   .
     * @param mixed  $value .
     *
     * @return $this
     */
    public function add_field(string $key, $value) : self
    {
        $this->fields[$key] = $value;
        return $this;
    }
    /**
     * @param string $title       .
     * @param string $description .
     *
     * @return void
     */
    public function render(string $title = '', string $description = '') : void
    {
        \wp_enqueue_style(\OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\Assets::HANDLE);
        \wp_enqueue_script(\OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\Assets::HANDLE);
        $customer = $this->customer;
        $countries = $this->countries;
        if (empty($title)) {
            $title = \__('Calculate shipping price', 'octolize-shipping-cost-on-product-page');
        }
        if (empty($description)) {
            $description = \__('Please fill in the fields below with the shipping destination details in order to calculate the shipping cost.', 'octolize-shipping-cost-on-product-page');
        }
        $customer_country = $customer->get_shipping_country();
        $customer_state = $customer->get_shipping_state();
        $customer_postcode = $customer->get_shipping_postcode();
        $customer_city = $customer->get_shipping_city();
        $states = $countries->get_states($customer_country);
        $fields = $this->fields;
        $id = 'scopp_' . \wp_generate_uuid4();
        include __DIR__ . '/views/html-shipping-calculator.php';
    }
}
