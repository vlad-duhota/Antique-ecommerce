<?php
/**
 * Class ShippingCostOnProductPageInitHooks
 */

namespace Octolize\Shipping\CostOnProductPage;

use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\Assets;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CalculatorAjaxAction;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CalculatorAjaxDetector;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CalculatorRenderer;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CalculatorVisibility;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\CreatorShippingPackages;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\Integration\ShippingNotices;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\PluginSettings;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\ProductPageCalculator\PluginEnabledVisibility;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\ProductPageCalculator\VirtualProductDisabledVisibility;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\ProductPageCalculatorInfo;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\ShippingCalculator;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\Field\CheckboxField;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\GeneralSettingsFields;
use OctolizeShippingCostOnProductPageVendor\Octolize\Shipping\CostOnProductPage\WooCommerceSettings\WooCommerceSettingsPage;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\HookableParent;
use WC_Cart;
use WC_Countries;
use WC_Customer;
use WC_Shipping;

/**
 * Register woocommerce hooks.
 *
 * @codeCoverageIgnore
 */
class ShippingCostOnProductPageInitHooks implements Hookable {

	use HookableParent;

	/**
	 * @var string
	 */
	private $scripts_version;

	/**
	 * @var string
	 */
	private $plugin_assets_url;

	/**
	 * @param string $plugin_assets_url
	 * @param string $scripts_version
	 */
	public function __construct( string $plugin_assets_url, string $scripts_version ) {
		$this->scripts_version   = $scripts_version;
		$this->plugin_assets_url = $plugin_assets_url;
	}

	/**
	 * @return void
	 */
	public function hooks(): void {
		add_action( 'woocommerce_init', [ $this, 'init' ] );
	}

	/**
	 * @return void
	 */
	public function init(): void {
		$cart      = WC()->cart;
		$customer  = WC()->customer;
		$countries = WC()->countries;
		$shipping  = WC()->shipping();

		$plugin_settings     = new PluginSettings();
		$calculator_detector = new CalculatorAjaxDetector();

		$this->add_hookable( new WooCommerceSettingsPage( new GeneralSettingsFields() ) );
		$this->add_hookable( new Assets( $this->plugin_assets_url, $this->scripts_version ) );
		$this->add_hookable( new ShippingNotices( $calculator_detector ) );

		// Setting Fields.
		$this->add_hookable( new CheckboxField() );

		// @phpstan-ignore-next-line
		if ( $cart instanceof WC_Cart && $customer instanceof WC_Customer && $countries instanceof WC_Countries && $shipping instanceof WC_Shipping ) {
			$calculator_visibility = new CalculatorVisibility();
			$calculator_visibility->register( new PluginEnabledVisibility( $plugin_settings ) );
			$calculator_visibility->register( new VirtualProductDisabledVisibility( $plugin_settings ) );

			$calculator_renderer = new CalculatorRenderer( $customer, $countries );

			$this->add_hookable(
				new ProductPageCalculatorInfo(
					$calculator_visibility,
					$plugin_settings,
					$calculator_renderer
				)
			);

			$this->add_hookable(
				new CalculatorAjaxAction(
					new CreatorShippingPackages( $cart ),
					new ShippingCalculator( $cart, $shipping ),
					$countries,
					$calculator_detector,
					$customer
				)
			);
		}

		$this->hooks_on_hookable_objects();
	}
}
