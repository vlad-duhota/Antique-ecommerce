<?php

/**
 * Class Tracker
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\Plugin;

use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\WooCommerceSettingsPage;
use OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\OptInNotice\ShouldDisplayAndConditions;
use OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\OptInNotice\ShouldDisplayGetParameterValue;
use OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\TrackerInitializer;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\HookableParent;
use OctolizeShippingCostOnProductPageVendor\WPDesk_Plugin_Info;
/**
 * Register tracker.
 *
 * @codeCoverageIgnore
 */
class Tracker implements \OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    use HookableParent;
    /**
     * @var WPDesk_Plugin_Info
     */
    private $plugin_info;
    /**
     * @param WPDesk_Plugin_Info $plugin_info .
     */
    public function __construct(\OctolizeShippingCostOnProductPageVendor\WPDesk_Plugin_Info $plugin_info)
    {
        $this->plugin_info = $plugin_info;
    }
    /**
     * @return void
     */
    public function hooks() : void
    {
        $visibility = new \OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\OptInNotice\ShouldDisplayAndConditions();
        $visibility->add_should_diaplay_condition(new \OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\OptInNotice\ShouldDisplayGetParameterValue('page', 'wc-settings'));
        $visibility->add_should_diaplay_condition(new \OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\OptInNotice\ShouldDisplayGetParameterValue('tab', 'shipping'));
        $visibility->add_should_diaplay_condition(new \OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\OptInNotice\ShouldDisplayGetParameterValue('section', \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\WooCommerceSettingsPage::SECTION_ID));
        $this->add_hookable(\OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\TrackerInitializer::create_from_plugin_info($this->plugin_info, $visibility));
        $this->hooks_on_hookable_objects();
    }
}
