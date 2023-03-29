<?php
/**
 * Customizer Controls Init.
 *
 * @package     Xirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2019, XplodedThemes (@XplodedThemes)
 * @license     https://opensource.org/licenses/MIT
 * @since       3.0.17
 */

/**
 * Controls.
 */
class Xirki_Controls {

	/**
	 * An array of templates to load.
	 *
	 * @access private
	 * @since 3.0.17
	 * @var array
	 */
	private $templates = array(
		'code',
		'color',
		'generic',
		'image',
		'number',
		'radio',
		'select',
		'textarea',
	);

	/**
	 * Path to controls views.
	 *
	 * @access private
	 * @since 3.0.17
	 * @var string
	 */
	private $views_path;

	/**
	 * Constructor.
	 *
	 * @access public
	 * @since 3.0.17
	 */
	public function __construct() {
		if ( ! $this->views_path ) {
			$this->views_path = wp_normalize_path( dirname( XIRKI_PLUGIN_FILE ) . '/controls/views/' );
		}
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'underscore_templates' ) );
	}

	/**
	 * Adds underscore.js templates to the footer.
	 *
	 * @access public
	 * @since 3.0.17
	 */
	public function underscore_templates() {
		foreach ( $this->templates as $template ) {
			if ( file_exists( $this->views_path . $template . '.php' ) ) {
				echo '<script type="text/html" id="tmpl-xirki-input-' . esc_attr( $template ) . '">';
				include $this->views_path . $template . '.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude
				echo '</script>';
			}
		}
	}
}
