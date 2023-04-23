<?php
/**
 * Class MetaboxFeaturesList
 */

namespace Octolize\Shipping\CostOnProductPage\Metabox;

/**
 * .
 */
class MetaboxFeaturesList {

	/**
	 * @var string[]
	 */
	private $features = [];

	/**
	 * @return string[]
	 */
	public function get_features(): array {
		return $this->features;
	}

	/**
	 * @param string $feature
	 *
	 * @return MetaboxFeaturesList
	 */
	public function add_feature( string $feature ): self {
		$this->features[] = $feature;

		return $this;
	}
}
