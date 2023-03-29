<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'XT_Framework_Base_Hooks' ) ) {

    /**
     * Class that takes care plugin base hooks, activate, deactivate and uninstall
     *
     * @since      1.0.0
     * @package    XT_Framework
     * @subpackage XT_Framework/includes
     * @author     XplodedThemes
     */
    class XT_Framework_Base_Hooks {

        /**
         * Core class reference.
         *
         * @since    1.0.0
         * @access   private
         * @var      XT_Framework $core Core Class
         */
        private $core;

        public function __construct( $core ) {

            $this->core = $core;

            register_activation_hook( $this->core->plugin()->file, array( $this, 'pre_activate' ) );
            add_action('xtfw_plugins_loaded', array($this, 'check_activation'));
            register_deactivation_hook( $this->core->plugin()->file, array( $this, 'deactivate' ) );

            if($this->core->access_manager()) {
                $this->core->access_manager()->add_action('after_uninstall', array($this, 'uninstall'));
            }
        }

        /**
         * The code that runs during plugin pre-activation.
         */
        function pre_activate() {
            add_option($this->core->plugin_short_prefix('loaded'), true);
        }

        /**
         * The code that check if plugin is activating.
         */
        function check_activation() {

            if(get_option($this->core->plugin_short_prefix('loaded')) === '1') {

                $this->activate();

                delete_option($this->core->plugin_short_prefix('loaded'));
            }
        }

        /**
         * The code that runs during plugin activation.
         * This action is documented in includes/class-activator.php
         */
        function activate() {

            if ( file_exists( plugin_dir_path( $this->core->plugin()->file ) . 'base/class-activator.php' ) ) {
                require_once plugin_dir_path( $this->core->plugin()->file ) . 'base/class-activator.php';
            }
        }

        /**
         * The code that runs during plugin deactivation.
         * This action is documented in includes/class-deactivator.php
         */
        function deactivate() {

            if ( file_exists( plugin_dir_path( $this->core->plugin()->file ) . 'base/class-deactivator.php' ) ) {
                require_once plugin_dir_path( $this->core->plugin()->file ) . 'base/class-deactivator.php';
            }
        }


        /**
         * The code that runs after plugin uninstall.
         * This action is documented in includes/class-uninstall.php
         */
        function uninstall() {

            if ( file_exists( plugin_dir_path( $this->core->plugin()->file ) . 'base/class-uninstaller.php' ) ) {
                require_once plugin_dir_path( $this->core->plugin()->file ) . 'base/class-uninstaller.php';
            }
        }
    }
}