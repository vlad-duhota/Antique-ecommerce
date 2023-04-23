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
				//$this->enabled = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : 'yes';
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

					/*'enabled' => array(
						'title'       => __( 'Enable', 'woo_arta_shipping' ),
						'type'        => 'checkbox',
						'description' => __( 'Enable this shipping.', 'woo_arta_shipping' ),
						'default'     => 'yes'
					),*/

					'title' => array(
						'title'       => __( 'Title', 'woo_arta_shipping' ),
						'type'        => 'text',
						'description' => __( 'Title to be display on site', 'woo_arta_shipping' ),
						'default'     => __( 'ARTA Shipping', 'woo_arta_shipping' )
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
				foreach ( $package['contents'] as $item_id => $values ){
					$_product         = $values['data'];
					$width            = $_product->get_width();
					$height           = $_product->get_height();
					$length           = $_product->get_length();
					$weight           = $_product->get_weight();
					$product_quantity = $values['quantity'];
					$product_price    = $_product->get_regular_price();
					$product_country  = get_post_meta( $_product->get_id(), 'woo_arta_ship_product_country', true );
					$product_postal   = get_post_meta( $_product->get_id(), 'woo_arta_ship_product_zip',  true );
					$product_region   = '';//get_post_meta( $_product->get_id(), 'product_region',  true );
					$product_city     = '';//get_post_meta( $_product->get_id(), 'product_city',    true );
					$product_address  = '';//get_post_meta( $_product->get_id(), 'product_address', true );
					$dest_country     = $package[ 'destination' ]['country'];
					$dest_region      = $package[ 'destination' ]['state'];
					$dest_city        = $package[ 'destination' ]['city'];
					$dest_postal      = $package[ 'destination' ]['postcode'];
					$dest_addr        = $package[ 'destination' ]['address'];
					$key              = $this->settings['apikey'];

					$arr = self::arta_request_cost( $key, $width, $height, $length, $weight, $product_price, $product_quantity, $product_country, $product_region, $product_city, $product_postal, $product_address, $dest_country, $dest_region, $dest_city, $dest_postal, $dest_addr );

					//file_put_contents( '/var/www/arr_res.txt', '<pre>'.print_r( $arr, true ).'</pre>' );

					if( $arr['err'] ){
						$this->add_rate( array(
							'id'    => $this->id,
							'label' => $this->title.' ('.$arr['err'].')',
							'cost'  => 0,
						) );
					}else{
						foreach( $arr['data'] as $arr_i ){
							$this->add_rate( array(
								'id'    => $arr_i['id'].'_'.$this->id,
								'label' => $this->title.' ('.$arr_i['quote_type'].')',
								'cost'  => $arr_i['total'],
							) );
						}
					}
				}
			}

			public static function arta_request_cost( $key, $product_width=0, $product_height=0, $length=0, $product_weight=0, $product_price=0, $quantity=1, $product_country='', $product_region='', $product_city='', $product_postal='', $product_address='', $dest_country='', $dest_region='', $dest_city='', $dest_postal='', $dest_addr='' ){
				$res                      = array('err'=>'', 'data'=>array() );
				//$js_request               = '{"request":{"additional_services":["origin_condition_check"],"currency":"USD","destination":{"access_restrictions":["stairs_only"],"address_line_1":"x_destination_address_line_1","address_line_2":"x_destination_address_line_2","address_line_3":"x_destination_address_line_3","city":"x_destination_city","region":"x_destination_region","postal_code":"x_destination_postal_code","country":"x_destination_country","title":"x_destination_title","contacts":[{"name":"x_destination_contact_name","email_address":"x_destination_contact_email","phone_number":"x_destination_contact_phone"}]},"insurance":"arta_transit_insurance","internal_reference":"x_order_title","objects":[{"internal_reference":"x_objects_title","current_packing":["no_packing"],"depth":"3","details":{"materials":["canvas"],"creation_date":"x_objects_details_creation_date","creator":"x_objects_details_creator","notes":"x_objects_details_notes","title":"x_objects_details_title","is_fragile":false,"is_cites":false},"height":"x_objects_height","images":["x_objects_img"],"public_reference":"Round Smithson work","subtype":"painting_unframed","width":"x_objects_width","unit_of_measurement":"x_objects_dimension_unit","weight":"x_objects_weight_val","weight_unit":"x_objects_weight_unit","value":"x_objects_xvalue","value_currency":"x_objects_currency_xvalue"}],"origin":{"access_restrictions":["non_paved"],"address_line_1":"x_origin_address_line_1","address_line_2":"x_origin_address_line_2","address_line_3":"x_origin_address_line_3","city":"x_origin_city","region":"x_origin_region","postal_code":"x_origin_postal_code","country":"x_origin_country","title":"Warehouse","contacts":[{"name":"x_origin_contacts_name","email_address":"x_origin_contacts_email","phone_number":"x_origin_contacts_phone"}]},"preferred_quote_types":["parcel"],"public_reference":"Order #1437","shipping_notes":"New customer"}}';

				$url                      = 'https://api.arta.io/requests';
				$product_width            = (float)$product_width;
				$product_height           = (float)$product_height;
				$length                   = (float)$length;
				$product_weight           = (float)$product_weight;
				$product_price            = (float)$product_price;
				$quantity                 = (int)$quantity;
				$product_country          = (string)$product_country;
				$product_city             = (string)$product_city;
				$product_postal           = (string)$product_postal;
				$product_address          = (string)$product_address;

				$dest_country             = (string)$dest_country;
				$dest_region              = (string)$dest_region;
				$dest_city                = (string)$dest_city;
				$dest_postal              = (string)$dest_postal;
				$dest_addr                = (string)$dest_addr;

				$product_weight_unit      = substr( get_option('woocommerce_weight_unit'), 0, 2 );
				$product_dimension_unit   = get_option('woocommerce_dimension_unit');
				$product_currency_unit    = get_woocommerce_currency();

				if( $js_request = file( __DIR__ . '/js_arta_request_object.js' ) ){
					$js_request = implode( '', $js_request );
					$js_request = json_decode( $js_request );
				} else {
					$js_request = array();
				}

				if( $js_request_product = file( __DIR__ . '/js_arta_request_object_product.js' ) ){
					$js_request_product = implode( '', $js_request_product );
					$js_request_product = json_decode( $js_request_product );
				} else {
					$js_request_product = array();
				}

				// data to request
				$js_request->request->origin->country        = $product_country;
				$js_request->request->origin->postal_code    = $product_postal;

				$js_request_product->internal_reference  = 'product';
				$js_request_product->creation_date        = time();
				$js_request_product->creator             = 'user';
				$js_request_product->notes               = 'excerpt';
				$js_request_product->title               = 'product';
				$js_request_product->width               = $product_width;
				$js_request_product->height              = $product_height;
				$js_request_product->unit_of_measurement = $product_dimension_unit;
				$js_request_product->weight              = $product_weight;
				$js_request_product->weight_unit         = $product_weight_unit;
				$js_request_product->value               = $product_price;
				$js_request_product->value_currency      = $product_currency_unit;
				$js_request_product->images              = array();

				for( $ii=0; $ii<$quantity; $ii++ ){
					$js_request->request->objects[] = $js_request_product;
				}

				$js_request->request->destination->country        = $dest_country;
				$js_request->request->destination->postal_code    = $dest_postal;
				// // data to request

				$response = wp_remote_post( $url, array(
					'timeout'     => 6000,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking'    => true,
					'headers'     => array('content-type'=>'application/json', 'Authorization'=>'ARTA_APIKey '.$key, 'Arta-Quote-Timeout'=>6000, ),
					'body'        => json_encode( $js_request ),
					'cookies'     => array(),
					'method'      => 'POST',
					'data_format' => 'body',
				) );
				if ( is_wp_error( $response ) ) {
					echo $response->get_error_message();
				} else {
					$data = json_decode( $response['body'], true );
				}

				//$txt1 = print_r( json_decode( $js_request ), true );
				//$txt2 = print_r( $data, true );
				//file_put_contents( '/var/www/arr_request.html', '<pre>'.$txt1.'</pre>' );
				//file_put_contents( '/var/www/arr_response.html', '<pre>'.$txt2.'</pre>' );

				if( isset( $data['disqualifications'] ) &&
					count( $data['disqualifications'] ) > 0
				){
					foreach ( $data['disqualifications'] as $isqualification ){
						$res['err'] .= $isqualification['reason'].'<br/>';
					}
				}elseif(  isset( $data['errors'] ) &&
					count( $data['errors'] ) > 0
				){
					foreach ( $data['errors'] as $key=>$errors ){
						$res['err'] .=  __( 'Error', 'woo_arta_shipping' ) . ': ' . $key . '<br/>';
					}
				}else{
					foreach( $data['quotes'] as $quote_i ){
						$res['data'][] = array( 'id'=>$quote_i['id'], 'quote_type'=>$quote_i['quote_type'],  'total'=>$quote_i['total'] );
					}
				}

				return $res;
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
