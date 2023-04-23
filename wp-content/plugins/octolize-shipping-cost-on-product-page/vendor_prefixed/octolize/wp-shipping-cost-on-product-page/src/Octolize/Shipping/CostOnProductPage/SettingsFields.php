<?php

/**
 * Interface SettingsFields
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage;

/**
 * Interface for Method Settings.
 */
interface SettingsFields
{
    /**
     * @return array<string, array<string, string|array<string, string>>>
     */
    public function get_settings_fields() : array;
}
