<?php

namespace OctolizeShippingCostOnProductPageVendor\Octolize\Tracker;

use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;
/**
 * Can create and register sender in filter.
 */
class SenderRegistrator implements \OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * @var string
     */
    private $plugin_slug;
    /**
     * @param string $plugin_slug
     */
    public function __construct(string $plugin_slug)
    {
        $this->plugin_slug = $plugin_slug;
    }
    /**
     * @return void
     */
    public function hooks()
    {
        \add_filter('wpdesk/tracker/sender/' . $this->plugin_slug, [$this, 'create_sender']);
    }
    /**
     * @return SenderToOctolize
     */
    public function create_sender()
    {
        return new \OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\SenderToOctolize();
    }
}
