<?php
/**
 * Plugin main class.
 */

namespace Octolize\Shipping\CostOnProductPage;

use Octolize\Shipping\CostOnProductPage\Metabox\UpsellMetabox;
use Octolize\Shipping\CostOnProductPage\Plugin\TextPetitionDisplayDecision;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\Plugin\Tracker;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\WooCommerceSettingsPage;
use OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\SenderRegistrator;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\AbstractPlugin;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\HookableCollection;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\HookableParent;
use OctolizeShippingCostOnProductPageVendor\WPDesk\RepositoryRating\RepositoryRatingPetitionText;
use OctolizeShippingCostOnProductPageVendor\WPDesk\RepositoryRating\TextPetitionDisplayer;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * Main plugin class. The most important flow decisions are made here.
 *
 * @codeCoverageIgnore
 */
class Plugin extends AbstractPlugin implements LoggerAwareInterface, HookableCollection {

	use LoggerAwareTrait;
	use HookableParent;

	private const SCRIPT_VERSION = OCTOLIZE_SHIPPING_COST_ON_PRODUCT_PAGE_VERSION . OCTOLIZE_SHIPPING_COST_ON_PRODUCT_PAGE_SCRIPT_VERSION;

	/**
	 * Init hooks.
	 *
	 * @return void
	 * @codeCoverageIgnore
	 */
	public function hooks(): void {
		parent::hooks();

		$this->add_hookable(
			new ShippingCostOnProductPageInitHooks(
				$this->get_plugin_url() . '/vendor_prefixed/octolize/wp-shipping-cost-on-product-page/assets/',
				self::SCRIPT_VERSION
			)
		);

		// Trackers.
		$this->add_hookable( new SenderRegistrator( $this->plugin_info->get_plugin_slug() ) );
		$this->add_hookable( new Tracker( $this->plugin_info ) );

		( new TextPetitionDisplayer(
			'woocommerce_after_settings_shipping',
			new TextPetitionDisplayDecision(),
			new RepositoryRatingPetitionText(
				'Octolize',
				__( 'Shipping Cost on Product Page', 'octolize-shipping-cost-on-product-page' ),
				'https://octol.io/rate-scpp',
				'center'
			)
		) )->hooks();

		$this->add_hookable( new UpsellMetabox( $this->get_plugin_assets_url(), self::SCRIPT_VERSION ) );

		$this->hooks_on_hookable_objects();
	}

	/**
	 * Quick links on plugins page.
	 *
	 * @param string[] $links .
	 *
	 * @return string[]
	 */
	public function links_filter( $links ): array {
		$docs_link    = __( 'https://octol.io/scpp-docs', 'octolize-shipping-cost-on-product-page' );
		$upgrade_link = __( 'https://octol.io/scpp-upgrade', 'octolize-shipping-cost-on-product-page' );
		$support_link = __( 'https://octol.io/scpp-support', 'octolize-shipping-cost-on-product-page' );
		$settings_url = admin_url( 'admin.php?page=wc-settings&tab=shipping&section=' . WooCommerceSettingsPage::SECTION_ID );

		$external_attributes = ' target="_blank" ';

		$plugin_links = [
			'<a href="' . esc_url( $settings_url ) . '">' . __( 'Settings', 'octolize-shipping-cost-on-product-page' ) . '</a>',
			'<a href="' . esc_url( $docs_link ) . '"' . $external_attributes . '>' . __( 'Docs', 'octolize-shipping-cost-on-product-page' ) . '</a>',
			'<a href="' . esc_url( $support_link ) . '"' . $external_attributes . '>' . __( 'Support', 'octolize-shipping-cost-on-product-page' ) . '</a>',
			'<a href="' . esc_url( $upgrade_link ) . '"' . $external_attributes . ' style="color:#d64e07;font-weight:bold;">' . __( 'Upgrade', 'octolize-shipping-cost-on-product-page' ) . '</a>',
		];

		return array_merge( $plugin_links, $links );
	}
}
