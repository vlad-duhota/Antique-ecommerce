<?php
/**
 * Class MetaboxButton
 */

namespace Octolize\Shipping\CostOnProductPage\Metabox;

/**
 * .
 */
class MetaboxButton {

	/**
	 * @var string
	 */
	private $label;

	/**
	 * @var string
	 */
	private $url;

	/**
	 * @var string
	 */
	private $target;

	/**
	 * @param string $label  .
	 * @param string $url    .
	 * @param string $target .
	 */
	public function __construct( string $label, string $url, string $target = '_blank' ) {
		$this->label  = $label;
		$this->url    = $url;
		$this->target = $target;
	}

	/**
	 * @return string
	 */
	public function get_label(): string {
		return $this->label;
	}

	/**
	 * @return string
	 */
	public function get_url(): string {
		return $this->url;
	}

	/**
	 * @return string
	 */
	public function get_target(): string {
		return $this->target;
	}
}
