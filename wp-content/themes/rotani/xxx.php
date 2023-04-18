<?php
/*
Template Name: xxx
*/
?>

<?php
//$js_request_orig = '{"request":{"additional_services":["origin_condition_check"],"currency":"USD","destination":{"access_restrictions":["stairs_only"],"address_line_1":"11 W 53rd St","address_line_2":"string","address_line_3":"string","city":"New York","region":"NY","postal_code":"10019","country":"US","title":"Gallery","contacts":[{"name":"Mary Quinn Sullivan","email_address":"mary@example.com","phone_number":"(333) 333-3333"}]},"insurance":"arta_transit_insurance","internal_reference":"Purchase Order: 2801","objects":[{"internal_reference":"Accession ID: 823","current_packing":["no_packing"],"depth":"3","details":{"materials":["canvas"],"creation_date":"1980","creator":"Bob Smithson","notes":"Artist signature in the lower left corner","title":"Black Rectangle","is_fragile":false,"is_cites":false},"height":"32","images":["http://example.com/image.jpg"],"public_reference":"Round Smithson work","subtype":"painting_unframed","width":"15","unit_of_measurement":"in","weight":"3.0","weight_unit":"lb","value":"2500","value_currency":"USD"}],"origin":{"access_restrictions":["non_paved"],"address_line_1":"87 Richardson St","address_line_2":"string","address_line_3":"string","city":"Brooklyn","region":"NY","postal_code":"11249","country":"US","title":"Warehouse","contacts":[{"name":"Rachel Egistrar","email_address":"registrar@example.com","phone_number":"(212) 123-4567"}]},"preferred_quote_types":["parcel"],"public_reference":"Order #1437","shipping_notes":"New customer"}}';
//$js_request_orig = json_decode( $js_request_orig );

$prod_id    = 44;
$key        = 'KVAo7YRbeJz5jn3oDeTFD7Gq';
$url        = 'https://api.arta.io/requests';
$js_request = '{"request":{"additional_services":["origin_condition_check"],"currency":"USD","destination":{"access_restrictions":["stairs_only"],"address_line_1":"x_destination_address_line_1","address_line_2":"x_destination_address_line_2","address_line_3":"x_destination_address_line_3","city":"x_destination_city","region":"x_destination_region","postal_code":"x_destination_postal_code","country":"x_destination_country","title":"x_destination_title","contacts":[{"name":"x_destination_contact_name","email_address":"x_destination_contact_email","phone_number":"x_destination_contact_phone"}]},"insurance":"arta_transit_insurance","internal_reference":"x_order_title","objects":[{"internal_reference":"x_objects_title","current_packing":["no_packing"],"depth":"3","details":{"materials":["canvas"],"creation_date":"x_objects_details_creation_date","creator":"x_objects_details_creator","notes":"x_objects_details_notes","title":"x_objects_details_title","is_fragile":false,"is_cites":false},"height":"x_objects_height","images":["x_objects_img"],"public_reference":"Round Smithson work","subtype":"painting_unframed","width":"x_objects_width","unit_of_measurement":"x_objects_dimension_unit","weight":"x_objects_weight_val","weight_unit":"x_objects_weight_unit","value":"x_objects_xvalue","value_currency":"x_objects_currency_xvalue"}],"origin":{"access_restrictions":["non_paved"],"address_line_1":"x_origin_address_line_1","address_line_2":"x_origin_address_line_2","address_line_3":"x_origin_address_line_3","city":"x_origin_city","region":"x_origin_region","postal_code":"x_origin_postal_code","country":"x_origin_country","title":"Warehouse","contacts":[{"name":"x_origin_contacts_name","email_address":"x_origin_contacts_email","phone_number":"x_origin_contacts_phone"}]},"preferred_quote_types":["parcel"],"public_reference":"Order #1437","shipping_notes":"New customer"}}';

$product_orign_product_country      = carbon_get_post_meta( $prod_id, 'product_country' );
$product_orign_product_region       = carbon_get_post_meta( $prod_id, 'product_region' );
$product_orign_product_city         = carbon_get_post_meta( $prod_id, 'product_city' );
$product_orign_product_postal       = carbon_get_post_meta( $prod_id, 'product_postal' );
$product_orign_product_address      = carbon_get_post_meta( $prod_id, 'product_address' );

$_product                 = wc_get_product( $prod_id );
$product_price            = $_product->get_regular_price();
$product_width            = $_product->get_width();
$product_height           = $_product->get_height();
$product_length           = $_product->get_length();
$product_weight           = $_product->get_weight();
$product_weight_unit      = substr( get_option('woocommerce_weight_unit'), 0, 2 );
$product_dimension_unit   = get_option('woocommerce_dimension_unit');
$product_currency_unit    = get_woocommerce_currency();

$product_dest_country = 'DE';
//$product_dest_region  = 'NY';
//$product_dest_city    = 'New York';
$product_dest_postal  = '14199';
//$product_dest_address = '1st avenu';

$js_request = str_replace( 'x_destination_country',              $product_dest_country, $js_request );
$js_request = str_replace( 'x_destination_region',               '',  $js_request ); //$product_dest_region
$js_request = str_replace( 'x_destination_city',                 '',    $js_request ); //$product_dest_city
$js_request = str_replace( 'x_destination_postal_code',          $product_dest_postal,  $js_request );
$js_request = str_replace( 'x_destination_address_line_1',       '', $js_request ); //$product_dest_address
$js_request = str_replace( 'x_destination_address_line_2',                   '', $js_request );
$js_request = str_replace( 'x_destination_address_line_3',                   '', $js_request );
$js_request = str_replace( 'x_destination_title',         'order',               $js_request );

$js_request = str_replace( 'x_destination_contact_name',   'xxx',                $js_request );
$js_request = str_replace( 'x_destination_contact_email',  'xxx',                $js_request );
$js_request = str_replace( 'x_destination_contact_phone',  'xxx',                    $js_request );

$js_request = str_replace( 'x_order_title',                'xxx',                    $js_request );

$js_request = str_replace( 'x_objects_title',              'product',                $js_request );
$js_request = str_replace( 'x_objects_width',                     $product_width,           $js_request );
$js_request = str_replace( 'x_objects_height',                    $product_height,          $js_request );
$js_request = str_replace( 'x_objects_weight_val',                $product_weight,          $js_request );
$js_request = str_replace( 'x_objects_weight_unit',               $product_weight_unit,     $js_request );
$js_request = str_replace( 'x_objects_dimension_unit',            $product_dimension_unit,  $js_request );
$js_request = str_replace( 'x_objects_img',                   '',                    $js_request );
$js_request = str_replace( 'x_objects_details_creation_date', '',                    $js_request );
$js_request = str_replace( 'x_objects_details_creator',       '',                    $js_request );
$js_request = str_replace( 'x_objects_details_notes',         '',                    $js_request );
$js_request = str_replace( 'x_objects_details_title',         '',                    $js_request );
$js_request = str_replace( 'x_objects_xvalue',                    $product_price,           $js_request );
$js_request = str_replace( 'x_objects_currency_xvalue',           $product_currency_unit,   $js_request );

$js_request = str_replace( 'x_origin_country',                    $product_orign_product_country,     $js_request );
$js_request = str_replace( 'x_origin_region',                     '',      $js_request ); //$product_orign_product_region
$js_request = str_replace( 'x_origin_city',                       '',        $js_request ); //$product_orign_product_city
$js_request = str_replace( 'x_origin_postal_code',                $product_orign_product_postal,      $js_request );
$js_request = str_replace( 'x_origin_address_line_1',             '',     $js_request ); //$product_orign_product_address
$js_request = str_replace( 'x_origin_address_line_2',      '',                                 $js_request );
$js_request = str_replace( 'x_origin_address_line_3',      '',                                 $js_request );

$js_request = str_replace( 'x_origin_contacts_email',             get_option('admin_email'),                  $js_request );
$js_request = str_replace( 'x_origin_contacts_name',              get_option('xxx'),                          $js_request );
$js_request = str_replace( 'x_origin_contacts_phone',             get_option('xxx'),                          $js_request );

//$cost = Arta_Shipping_Method::arta_request_cost( $width, $height, $length, $weight, $product_country, $product_region, $product_city, $product_postal, $product_address );
//exit;


$response = wp_remote_post( $url, array(
	'timeout'     => 6000,
	'redirection' => 5,
	'httpversion' => '1.0',
	'blocking'    => true,
	'headers'     => array('content-type'=>'application/json', 'Authorization'=>'ARTA_APIKey '.$key, 'Arta-Quote-Timeout'=>6000, ),
	'body'        => $js_request,
	'cookies'     => array(),
	'method'      => 'POST',
	'data_format' => 'body',
) );
if ( is_wp_error( $response ) ) {
	echo $response->get_error_message();
} else {
	$data = json_decode( $response['body'], true );
}


if( isset( $data['disqualifications'] ) &&
	count( $data['disqualifications'] ) > 0
){
	foreach ( $data['disqualifications'] as $isqualification ){
		echo $isqualification['reason'].'<br/>';
	}
}elseif(  isset( $data['errors'] ) &&
		 count( $data['errors'] ) > 0
){
	foreach ( $data['errors'] as $key=>$errors ){
		echo __( 'Error', 'woo_arta_shipping' ) . ': ' . $key . '<br/>';
	}
}else{
	echo'<pre>';
	print_r( $data );
	//print_r( json_decode( $js_request ) );
	//print_r($data['quotes']);
	foreach( $data['quotes'] as $quote_i ){
		echo $quote_i['quote_type'] . ': ' . $quote_i['total'];
		//foreach( $quote_i['included_services'] as $included_service ){
			//if( $included_service['type'] == 'transport' ){
				//echo $included_service['name'].' '.$included_service['amount'].'<br/>';
				//$cost += $included_service['amount'];
				//print_r($included_service);
			//}
		//}
		echo'<br/><br/>';
		/*foreach( $quote_i['optional_services'] as $included_service ){
			if( $included_service['type'] == 'transport' ){
				echo $included_service['name'].' '.$included_service['amount'].'<br/>';
			}
		}*/
	}
	echo'</pre>';
}



echo'<pre>';
//print_r( json_decode( $js_request ) );
echo'</pre>';

echo'<pre>';
//print_r( $js_request_orig );
echo'</pre>';
?>