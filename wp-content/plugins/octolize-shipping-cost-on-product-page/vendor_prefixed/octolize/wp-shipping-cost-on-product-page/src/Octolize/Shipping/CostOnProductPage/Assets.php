<?php

/**
 * Class Assets
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage;

use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;
/**
 * .
 */
class Assets implements \OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    public const HANDLE = 'octolize-shipping-cost-on-product-page';
    /**
     * @var string
     */
    private $assets_url;
    /**
     * @var string
     */
    protected $scripts_version;
    /**
     * @param string $assets_url .
     */
    public function __construct(string $assets_url, string $scripts_version)
    {
        $this->assets_url = $assets_url;
        $this->scripts_version = $scripts_version;
    }
    /**
     * @return void
     */
    public function hooks() : void
    {
        \add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }
    /**
     * @return void
     */
    public function enqueue_scripts() : void
    {
        $this->register_styles();
        $this->register_scripts();
    }
    /**
     * @return void
     */
    protected function register_styles() : void
    {
        \wp_register_style(self::HANDLE, $this->assets_url . 'dist/app.css', [], $this->scripts_version);
    }
    /**
     * @return void
     */
    protected function register_scripts() : void
    {
        \wp_register_script(self::HANDLE, $this->assets_url . 'dist/app.js', ['jquery', 'jquery-blockui', 'wc-country-select'], $this->scripts_version, \true);
        $this->localize_scripts();
    }
    protected function localize_scripts() : void
    {
        \wp_localize_script(self::HANDLE, '__jsOctolizeCostOnProductPage', $this->get_localize_script_vars());
    }
    /**
     * @return string[]
     */
    protected function get_localize_script_vars() : array
    {
        return ['ajax_url' => \add_query_arg('action', \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CalculatorAjaxAction::ACTION, \admin_url('admin-ajax.php'))];
    }
}
