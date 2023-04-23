<?php
/**
 * Class TextPetitionDisplayDecision
 */

namespace Octolize\Shipping\CostOnProductPage\Plugin;

use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\WooCommerceSettingsPage;
use OctolizeShippingCostOnProductPageVendor\WPDesk\RepositoryRating\DisplayStrategy\DisplayDecision;

/**
 * Text Petition Display Decision.
 *
 * @codeCoverageIgnore
 */
class TextPetitionDisplayDecision implements DisplayDecision {
	/**
	 * @return bool
	 */
	public function should_display(): bool {
		return isset( $_GET['page'], $_GET['tab'], $_GET['section'] ) && $_GET['section'] === WooCommerceSettingsPage::SECTION_ID;
	}
}
