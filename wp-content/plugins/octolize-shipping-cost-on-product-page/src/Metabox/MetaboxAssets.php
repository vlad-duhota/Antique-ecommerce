<?php
/**
 * Class MetaboxAssets
 */

namespace Octolize\Shipping\CostOnProductPage\Metabox;

use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;

/**
 * .
 */
class MetaboxAssets implements Hookable {
	public const HANDLE = 'octolize-upsell-metabox';

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
		add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ], 0 );
	}

	/**
	 * @return void
	 */
	public function register_scripts(): void {
		wp_enqueue_style( self::HANDLE, $this->assets_url . 'dist/upsell-metabox.css', [], $this->scripts_version );
	}
}

