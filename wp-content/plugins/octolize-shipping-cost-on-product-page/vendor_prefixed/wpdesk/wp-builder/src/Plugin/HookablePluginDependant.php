<?php

namespace OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin;

interface HookablePluginDependant extends \OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * Set Plugin.
     *
     * @param AbstractPlugin $plugin Plugin.
     *
     * @return null
     */
    public function set_plugin(\OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\AbstractPlugin $plugin);
    /**
     * Get plugin.
     *
     * @return AbstractPlugin.
     */
    public function get_plugin();
}
