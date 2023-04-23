<?php
/**
 * Class ShouldDisplayMetabox
 */

namespace Octolize\Shipping\CostOnProductPage\Metabox;

use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\WooCommerceSettingsPage;

/**
 * .
 */
class ShouldDisplayMetabox {

	/**
	 * @return bool
	 */
	public function should_display(): bool {
		$page    = filter_input( INPUT_GET, 'page' );
		$tab     = filter_input( INPUT_GET, 'tab' );
		$section = filter_input( INPUT_GET, 'section' );

		return $page === 'wc-settings' && $tab === 'shipping' && $section === WooCommerceSettingsPage::SECTION_ID;
	}
}

