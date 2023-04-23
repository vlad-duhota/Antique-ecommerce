<?php

/**
 * Class GeneralSettingsFields
 */
namespace OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings;

use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\SettingsFields;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\Field\CheckboxField;
/**
 * .
 */
class GeneralSettingsFields implements \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\SettingsFields
{
    public const ENABLED_FIELD = 'enabled';
    public const VIRTUAL_PRODUCTS_STATUS_FIELD = 'virtual_products';
    /**
     * @return array[]
     * @phpstan-ignore-next-line
     */
    public function get_settings_fields() : array
    {
        return [['title' => \__('Shipping Cost on Product Page', 'octolize-shipping-cost-on-product-page'), 'type' => 'title', 'id' => \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\WooCommerceSettingsPage::SECTION_ID, 'desc' => \sprintf(
            // translators: open tag, close tag.
            \__('These are the Shipping Cost on Product Page plugin general settings. In order to learn more about its configuration please refer to its %1$sdedicated documentation →%2$s', 'octolize-shipping-cost-on-product-page'),
            '<a target="_blank" href="' . \esc_url(\__('https://octol.io/scpp-docs', 'octolize-shipping-cost-on-product-page')) . '">',
            '</a>'
        )], ['type' => 'checkbox', 'id' => self::ENABLED_FIELD, 'title' => \__('Enable/Disable', 'octolize-shipping-cost-on-product-page'), 'desc' => \__('Turn on / off the shipping cost calculator on the product page', 'octolize-shipping-cost-on-product-page')], ['type' => \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\Field\CheckboxField::FIELD_ID, 'id' => self::VIRTUAL_PRODUCTS_STATUS_FIELD, 'title' => \__('Virtual products', 'octolize-shipping-cost-on-product-page'), 'desc' => \__('Turn off displaying the shipping cost calculator on the virtual products\' product pages', 'octolize-shipping-cost-on-product-page'), 'desc_tip' => \__('Tick this checkbox if you want the shipping cost calculator to remain hidden on the product pages of the virtual products which do not require to be shipped.', 'octolize-shipping-cost-on-product-page')], ['type' => 'sectionend', 'id' => \OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\WooCommerceSettingsPage::SECTION_ID]];
    }
}
