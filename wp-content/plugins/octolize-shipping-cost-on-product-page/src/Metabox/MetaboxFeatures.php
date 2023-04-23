<?php
/**
 * Class MetaboxFeatures
 */

namespace Octolize\Shipping\CostOnProductPage\Metabox;

/**
 * .
 */
class MetaboxFeatures implements MetaboxInterface {

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var MetaboxButton
	 */
	private $button;

	/**
	 * @var MetaboxFeaturesList
	 */
	private $features;

	/**
	 * @param string              $title    .
	 * @param MetaboxButton       $button   .
	 * @param MetaboxFeaturesList $features .
	 */
	public function __construct( string $title, MetaboxButton $button, MetaboxFeaturesList $features ) {
		$this->title    = $title;
		$this->button   = $button;
		$this->features = $features;
	}

	/**
	 * @return void
	 */
	public function render(): void {
		$title    = $this->title;
		$button   = $this->button;
		$features = $this->features;

		include __DIR__ . '/views/html-metabox-features.php';
	}
}
