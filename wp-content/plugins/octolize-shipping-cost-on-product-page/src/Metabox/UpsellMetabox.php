<?php
/**
 * Class UpsellMetabox
 */

namespace Octolize\Shipping\CostOnProductPage\Metabox;

use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\HookableParent;

/**
 * .
 */
class UpsellMetabox implements Hookable {
	use HookableParent;

	/**
	 * @var string
	 */
	private $assets_url;

	/**
	 * @var string
	 */
	private $scripts_version;

	/**
	 * @param string $assets_url .
	 */
	public function __construct( string $assets_url, string $scripts_version ) {
		$this->assets_url      = $assets_url;
		$this->scripts_version = $scripts_version;
	}

	/**
	 * @return void
	 */
	public function hooks(): void {
		add_action( 'admin_init', [ $this, 'register_hooks' ] );
	}

	/**
	 * @return void
	 */
	public function register_hooks(): void {
		$metabox_viewer_strategy = new ShouldDisplayMetabox();

		if ( ! $metabox_viewer_strategy->should_display() ) {
			return;
		}

		$metabox_features = new MetaboxFeaturesList();
		$metabox_features->add_feature( __( 'Displaying the available shipping methods automatically based on the saved shipping address or WooCommerce settings', 'octolize-shipping-cost-on-product-page' ) );
		$metabox_features->add_feature( __( 'Selecting the products to calculate the shipping cost for', 'octolize-shipping-cost-on-product-page' ) );
		$metabox_features->add_feature( __( 'Hiding the shipping cost calculator on specific product pages', 'octolize-shipping-cost-on-product-page' ) );
		$metabox_features->add_feature( __( 'Calculator placement management', 'octolize-shipping-cost-on-product-page' ) );
		$metabox_features->add_feature( __( 'Placing the calculator with shortcodes', 'octolize-shipping-cost-on-product-page' ) );

		$metabox = new MetaboxFeatures(
			__( 'Get Shipping Cost on Product Page PRO!', 'octolize-shipping-cost-on-product-page' ),
			new MetaboxButton(
				__( 'Upgrade Now →', 'octolize-shipping-cost-on-product-page' ),
				__( 'https://octol.io/scpp-up-box', 'octolize-shipping-cost-on-product-page' )
			),
			$metabox_features
		);

		$this->add_hookable( new MetaboxAssets( $this->assets_url, $this->scripts_version ) );
		$this->add_hookable( new MetaboxRenderer( 'shipping', $metabox ) );

		$this->hooks_on_hookable_objects();
	}
}

