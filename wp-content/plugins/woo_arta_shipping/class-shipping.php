<?php
/*
 * ARTA shipping method
 */
function start_arta_shipping_method() {
	if ( ! class_exists( 'Arta_Shipping_Method' ) ) {
		class Arta_Shipping_Method extends WC_Shipping_Method {
			/**
			 * Constructor for your shipping class
			 *
			 * @access public
			 * @return void
			 */
			public function __construct() {
				$this->id                 = 'woo_arta_shipping';
				$this->method_title       = __( 'ARTA Shipping settings', 'woo_arta_shipping' );
				$this->method_description = __( 'Shipping from:', 'woo_arta_shipping' ).' <a href="https://arta.io/" target="_blank">ARTA</a>.';

				$this->init();
				$this->enabled = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : 'yes';
				$this->title   = isset( $this->settings['title']   ) ? $this->settings['title']   : __( 'ARTA Shipping', 'woo_arta_shipping' );
			}

			/**
			 * Init your settings
			 *
			 * @access public
			 * @return void
			 */
			function init() {
				// Load the settings API
				$this->init_form_fields();
				$this->init_settings();

				// Save settings in admin if you have any defined
				add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
			}

			/**
			 * Define settings field for this shipping
			 * @return void
			 */
			function init_form_fields() {

				$this->form_fields = array(

					'enabled' => array(
						'title'       => __( 'Enable', 'woo_arta_shipping' ),
						'type'        => 'checkbox',
						'description' => __( 'Enable this shipping.', 'woo_arta_shipping' ),
						'default'     => 'yes'
					),

					'title' => array(
						'title'       => __( 'Title', 'woo_arta_shipping' ),
						'type'        => 'text',
						'description' => __( 'Title to be display on site', 'woo_arta_shipping' ),
						'default'     => __( 'ARTA Shipping', 'woo_arta_shipping' )
					),

					'weight' => array(
						'title'       => __( 'Max Weight (kg)', 'woo_arta_shipping' ),
						'type'        => 'number',
						'description' => __( 'Maximum allowed weight', 'woo_arta_shipping' ),
						'default'     => 100
					),

					'apikey' => array(
						'title'       => __( 'ARTA API key', 'woo_arta_shipping' ),
						'type'        => 'text',
						'description' => __( 'ARTA API key service', 'woo_arta_shipping' ),
						'default'     => ''
					),

				);
			}

			/**
			 * This function is used to calculate the shipping cost. Within this function we can check for weights, dimensions and other parameters.
			 *
			 * @access public
			 * @param mixed $package
			 * @return void
			 */
			public function calculate_shipping( $package = array() ) {
				$txt = '';
				$cost   = 0;

				foreach ( $package['contents'] as $item_id => $values ){
					$_product = $values['data'];
					//$weight   = $weight + $_product->get_weight() * $values['quantity'];
					//$cost     += $this->arta_request_cost( 1, 1, $_product->get_weight() ) * $values['quantity'];

					$width           = $_product->get_width();
					$height          = $_product->get_height();
					$length          = $_product->get_length();
					$weight          = $_product->get_weight();
					$product_country = carbon_get_post_meta( 44, 'product_country' );
					$product_region  = carbon_get_post_meta( 44, 'product_region' );
					$product_city    = carbon_get_post_meta( 44, 'product_city' );
					$product_postal  = carbon_get_post_meta( 44, 'product_postal' );
					$product_address = carbon_get_post_meta( 44, 'product_address' );

					$cost += self::arta_request_cost( $width, $height, $length, $weight, $product_country, $product_region, $product_city, $product_postal, $product_address );
				}
				//$weight = wc_get_weight( $weight, 'kg' );

				$rate = array(
					'id'    => $this->id,
					'label' => $this->title,
					'cost'  => $cost,
				);

				$this->add_rate( $rate );
			}

			public static function arta_request_cost( $width=0, $height=0, $length=0, $weight=0, $product_country='', $product_region='', $product_city='', $product_postal='', $product_address='' ){
				$js_request = '';
				$ARTA_Shipping_Method = new Arta_Shipping_Method();
				$arta_api_url = 'https://api.arta.io/requests';
				$width        = (float)$width;
				$height       = (float)$height;
				$length       = (float)$length;
				$weight       = (float)$weight;
				$arta_apikey  = $ARTA_Shipping_Method->settings['apikey'];

				$response = wp_remote_post( $arta_api_url, array(
					'timeout'     => 6000,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking'    => true,
					'headers'     => array('content-type'=>'application/json', 'Authorization'=>'ARTA_APIKey '.$arta_apikey, 'Arta-Quote-Timeout'=>6000, ),
					'body'        => $js_request,
					'cookies'     => array(),
					'method'      => 'POST',
					'data_format' => 'body',
				) );
				if ( is_wp_error( $response ) ) {
					// $response->get_error_message();
				} else {
					$data = json_decode( $response['body'] );
				}

				return (float)10;
			}
		}
	}
}
add_action( 'woocommerce_shipping_init', 'start_arta_shipping_method' );

function add_arta_shipping_method( $methods ) {
	$methods[] = 'Arta_Shipping_Method';
	return $methods;
}
add_filter( 'woocommerce_shipping_methods', 'add_arta_shipping_method' );

function arta_validate_order( $posted )   {
	$packages       = WC()->shipping->get_packages();
	$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );

	if( is_array( $chosen_methods ) && in_array( 'woo_arta_shipping', $chosen_methods ) ) {

		foreach ( $packages as $i => $package ) {
			if ( $chosen_methods[ $i ] != "woo_arta_shipping" ) {
				continue;
			}

			$ARTA_Shipping_Method = new Arta_Shipping_Method();
			$weightLimit = (int) $ARTA_Shipping_Method->settings['weight'];
			$weight = 0;

			foreach ( $package['contents'] as $item_id => $values ){
				$_product = $values['data'];
				$weight   = $weight + $_product->get_weight() * $values['quantity'];
			}

			$weight = wc_get_weight( $weight, 'kg' );

			if( $weight > $weightLimit ) {
				$message = sprintf( __( 'Sorry, %d kg exceeds the maximum weight of %d kg for %s', 'woo_arta_shipping' ), $weight, $weightLimit, $ARTA_Shipping_Method->title );
				$messageType = "error";

				if( ! wc_has_notice( $message, $messageType ) ) {
					wc_add_notice( $message, $messageType );
				}
			}
		}
	}
}

add_action( 'woocommerce_review_order_before_cart_contents', 'arta_validate_order' , 10 );
add_action( 'woocommerce_after_checkout_validation',         'arta_validate_order' , 10 );
