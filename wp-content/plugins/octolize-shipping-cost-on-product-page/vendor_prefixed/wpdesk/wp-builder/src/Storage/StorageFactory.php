<?php

namespace OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Storage;

class StorageFactory
{
    /**
     * @return PluginStorage
     */
    public function create_storage()
    {
        return new \OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Storage\WordpressFilterStorage();
    }
}
