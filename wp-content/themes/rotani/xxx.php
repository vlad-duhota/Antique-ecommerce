<?php
/*
Template Name: xxx
*/
?>

<?php
// ORIGIN-REQUEST '{"request":{"additional_services":["origin_condition_check"],"currency":"USD","destination":{"access_restrictions":["stairs_only"],"address_line_1":"11 W 53rd St","address_line_2":"string","address_line_3":"string","city":"New York","region":"NY","postal_code":"10019","country":"US","title":"Gallery","contacts":[{"name":"Mary Quinn Sullivan","email_address":"mary@example.com","phone_number":"(333) 333-3333"}]},"insurance":"arta_transit_insurance","internal_reference":"Purchase Order: 2801","objects":[{"internal_reference":"Accession ID: 823","current_packing":["no_packing"],"depth":"3","details":{"materials":["canvas"],"creation_date":"1980","creator":"Bob Smithson","notes":"Artist signature in the lower left corner","title":"Black Rectangle","is_fragile":false,"is_cites":false},"height":"32","images":["http://example.com/image.jpg"],"public_reference":"Round Smithson work","subtype":"painting_unframed","width":"15","unit_of_measurement":"in","weight":"3.0","weight_unit":"lb","value":"2500","value_currency":"USD"}],"origin":{"access_restrictions":["non_paved"],"address_line_1":"87 Richardson St","address_line_2":"string","address_line_3":"string","city":"Brooklyn","region":"NY","postal_code":"11249","country":"US","title":"Warehouse","contacts":[{"name":"Rachel Egistrar","email_address":"registrar@example.com","phone_number":"(212) 123-4567"}]},"preferred_quote_types":["parcel"],"public_reference":"Order #1437","shipping_notes":"New customer"}}'

$key        = 'KVAo7YRbeJz5jn3oDeTFD7Gq';
$url        = 'https://api.arta.io/requests';
$js_request = '{"request":{"additional_services":["origin_condition_check"],"currency":"USD","destination":{"access_restrictions":["stairs_only"],"address_line_1":"x_destination_address_line_1","address_line_2":"x_destination_address_line_2","address_line_3":"x_destination_address_line_3","city":"x_destination_city","region":"x_destination_region","postal_code":"x_destination_postal_code","country":"x_destination_country","title":"x_destination_title","contacts":[{"name":"x_destination_contact_name","email_address":"x_destination_contact_email","phone_number":"x_destination_contact_phone"}]},"insurance":"arta_transit_insurance","internal_reference":"x_order_title","objects":[{"internal_reference":"x_objects_title","current_packing":["no_packing"],"depth":"3","details":{"materials":["canvas"],"creation_date":"1980","creator":"Bob Smithson","notes":"Artist signature in the lower left corner","title":"Black Rectangle","is_fragile":false,"is_cites":false},"height":"x_objects_height","images":["x_objects_img"],"public_reference":"Round Smithson work","subtype":"painting_unframed","width":"x_objects_width","unit_of_measurement":"x_objects_dimension_unit","weight":"x_objects_weight","weight_unit":"x_objects_weight_unit","value":"2500","value_currency":"x_objects_value_currency"}],"origin":{"access_restrictions":["non_paved"],"address_line_1":"x_origin_address_line_1","address_line_2":"x_origin_address_line_2","address_line_3":"x_origin_address_line_3","city":"x_origin_city","region":"x_origin_region","postal_code":"x_origin_postal_code","country":"x_origin_country","title":"Warehouse","contacts":[{"name":"x_origin_contacts_name","email_address":"x_origin_contacts_email","phone_number":"x_origin_contacts_phone"}]},"preferred_quote_types":["parcel"],"public_reference":"Order #1437","shipping_notes":"New customer"}}';

$width                = 2;
$height               = 3;
$length               = 4;
$weight               = 5;
$product_country      = carbon_get_post_meta( 44, 'product_country' );
$product_region       = carbon_get_post_meta( 44, 'product_region' );
$product_city         = carbon_get_post_meta( 44, 'product_city' );
$product_postal       = carbon_get_post_meta( 44, 'product_postal' );
$product_address      = carbon_get_post_meta( 44, 'product_address' );
$woo_weight_unit      = get_option('woocommerce_weight_unit');
$woo_dimension_unit   = get_option('woocommerce_dimension_unit');
$woo_currency_unit    = get_woocommerce_currency();
$product_dest_country = '';
$product_dest_region  = '';
$product_dest_city    = '';
$product_dest_postal  = '';
$product_dest_address = '';

$js_request = str_replace( 'x_destination_country',              $product_dest_country, $js_request );
$js_request = str_replace( 'x_destination_region',               $product_dest_region,  $js_request );
$js_request = str_replace( 'x_destination_city',                 $product_dest_city,    $js_request );
$js_request = str_replace( 'x_destination_postal_code',          $product_dest_postal,  $js_request );
$js_request = str_replace( 'x_destination_address_line_1',       $product_dest_address, $js_request );

$js_request = str_replace( 'x_destination_title',         'order',               $js_request );

$js_request = str_replace( 'x_destination_contact_name',   'xxx',                $js_request );
$js_request = str_replace( 'x_destination_contact_email',  'xxx',                $js_request );
$js_request = str_replace( 'x_destination_contact_phone',  'xxx',                $js_request );

$js_request = str_replace( 'x_order_title',                'xxx',                $js_request );

$js_request = str_replace( 'x_objects_title',              'product',            $js_request );
$js_request = str_replace( 'x_objects_width',                     $width,               $js_request );
$js_request = str_replace( 'x_objects_weight',                    $weight,              $js_request );
$js_request = str_replace( 'x_objects_weight_unit',               $woo_weight_unit,     $js_request );
$js_request = str_replace( 'x_objects_dimension_unit',            $woo_dimension_unit,  $js_request );
$js_request = str_replace( 'x_objects_value_currency',            $woo_currency_unit,   $js_request );

$js_request = str_replace( 'x_origin_country',                    $product_country,     $js_request );
$js_request = str_replace( 'x_origin_region',                     $product_region,      $js_request );
$js_request = str_replace( 'x_origin_city',                       $product_city,        $js_request );
$js_request = str_replace( 'x_origin_postal_code',                $product_postal,      $js_request );
$js_request = str_replace( 'x_origin_address_line_1',             $product_address,     $js_request );

echo'<pre>';
print_r( json_decode( $js_request ) );
echo'</pre>';

//$cost = Arta_Shipping_Method::arta_request_cost( $width, $height, $length, $weight, $product_country, $product_region, $product_city, $product_postal, $product_address );
exit;




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
	// $response->get_error_message();
} else {
	$data = json_decode( $response['body'] );
}

echo'<pre>';
print_r( $data );
echo'</pre>';

?>