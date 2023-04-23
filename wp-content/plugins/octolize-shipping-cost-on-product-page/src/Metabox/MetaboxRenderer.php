<?php
/**
 * Class MetaboxRenderer
 */

namespace Octolize\Shipping\CostOnProductPage\Metabox;

use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;

/**
 * .
 */
class MetaboxRenderer implements Hookable {

	/**
	 * @var MetaboxInterface
	 */
	private $metabox;

	/**
	 * @var string
	 */
	private $tab;

	/**
	 * @param string           $tab     .
	 * @param MetaboxInterface $metabox .
	 */
	public function __construct( string $tab, MetaboxInterface $metabox ) {
		$this->tab     = $tab;
		$this->metabox = $metabox;
	}

	/**
	 * @return void
	 */
	public function hooks(): void {
		add_action( 'woocommerce_settings_' . $this->tab, [ $this, 'render_before_settings_fields' ], 0 );
		add_action( 'woocommerce_settings_tabs_' . $this->tab, [ $this, 'render_after_settings_fields' ], PHP_INT_MAX );
	}

	/**
	 * @return void
	 */
	public function render_before_settings_fields(): void {
		echo '<div class="octolize-settings-container"><div class="octolize-settings-form-container">';
	}

	/**
	 * @return void
	 */
	public function render_after_settings_fields(): void {
		echo '</div>';

		$this->metabox->render();

		echo '</div>';
	}
}

