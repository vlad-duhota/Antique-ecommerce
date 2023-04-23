<?php

namespace OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\BuildDirector;

use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Builder\AbstractBuilder;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\AbstractPlugin;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Storage\StorageFactory;
class LegacyBuildDirector
{
    /** @var AbstractBuilder */
    private $builder;
    public function __construct(\OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Builder\AbstractBuilder $builder)
    {
        $this->builder = $builder;
    }
    /**
     * Builds plugin
     */
    public function build_plugin()
    {
        $this->builder->build_plugin();
        $this->builder->init_plugin();
        $storage = new \OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Storage\StorageFactory();
        $this->builder->store_plugin($storage->create_storage());
    }
    /**
     * Returns built plugin
     *
     * @return AbstractPlugin
     */
    public function get_plugin()
    {
        return $this->builder->get_plugin();
    }
}
