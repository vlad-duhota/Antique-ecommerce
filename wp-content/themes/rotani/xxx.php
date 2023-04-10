<?php
/*
Template Name: xxx
*/
?>

<?php
$key        = 'KVAo7YRbeJz5jn3oDeTFD7Gq';
//$url      = 'https://api.arta.io/shipments'; // list my delivery
$url        = 'https://api.arta.io/requests';
// ORIGIN-REQUEST '{"request":{"additional_services":["origin_condition_check"],"currency":"USD","destination":{"access_restrictions":["stairs_only"],"address_line_1":"11 W 53rd St","address_line_2":"string","address_line_3":"string","city":"New York","region":"NY","postal_code":"10019","country":"US","title":"Gallery","contacts":[{"name":"Mary Quinn Sullivan","email_address":"mary@example.com","phone_number":"(333) 333-3333"}]},"insurance":"arta_transit_insurance","internal_reference":"Purchase Order: 2801","objects":[{"internal_reference":"Accession ID: 823","current_packing":["no_packing"],"depth":"3","details":{"materials":["canvas"],"creation_date":"1980","creator":"Bob Smithson","notes":"Artist signature in the lower left corner","title":"Black Rectangle","is_fragile":false,"is_cites":false},"height":"32","images":["http://example.com/image.jpg"],"public_reference":"Round Smithson work","subtype":"painting_unframed","width":"15","unit_of_measurement":"in","weight":"3.0","weight_unit":"lb","value":"2500","value_currency":"USD"}],"origin":{"access_restrictions":["non_paved"],"address_line_1":"87 Richardson St","address_line_2":"string","address_line_3":"string","city":"Brooklyn","region":"NY","postal_code":"11249","country":"US","title":"Warehouse","contacts":[{"name":"Rachel Egistrar","email_address":"registrar@example.com","phone_number":"(212) 123-4567"}]},"preferred_quote_types":["parcel"],"public_reference":"Order #1437","shipping_notes":"New customer"}}'
$js_request = '{"request":{"additional_services":["origin_condition_check"],"currency":"USD","destination":{"access_restrictions":["stairs_only"],"address_line_1":"x_destination_address_line_1","address_line_2":"x_destination_address_line_2","address_line_3":"x_destination_address_line_3","city":"x_destination_city","region":"x_destination_region","postal_code":"x_destination_postal_code","country":"x_destination_country","title":"x_destination_title","contacts":[{"name":"x_destination_contact_name","email_address":"x_destination_contact_email","phone_number":"x_destination_contact_phone"}]},"insurance":"arta_transit_insurance","internal_reference":"x_order_title","objects":[{"internal_reference":"x_objects_title","current_packing":["no_packing"],"depth":"3","details":{"materials":["canvas"],"creation_date":"1980","creator":"Bob Smithson","notes":"Artist signature in the lower left corner","title":"Black Rectangle","is_fragile":false,"is_cites":false},"height":"x_objects_height","images":["x_objects_img"],"public_reference":"Round Smithson work","subtype":"painting_unframed","width":"x_objects_width","unit_of_measurement":"in","weight":"x_objects_weight","weight_unit":"lb","value":"2500","value_currency":"USD"}],"origin":{"access_restrictions":["non_paved"],"address_line_1":"x_origin_address_line_1","address_line_2":"x_origin_address_line_2","address_line_3":"x_origin_address_line_3","city":"x_origin_city","region":"x_origin_region","postal_code":"x_origin_postal_code","country":"x_origin_country","title":"Warehouse","contacts":[{"name":"x_origin_contacts_name","email_address":"x_origin_contacts_email","phone_number":"x_origin_contacts_phone"}]},"preferred_quote_types":["parcel"],"public_reference":"Order #1437","shipping_notes":"New customer"}}';

$curl    = curl_init();

$headr[] = 'Content-Type: application/json';
$headr[] = 'Authorization: ARTA_APIKey ' . $key;
$headr[] = 'Arta-Quote-Timeout: 6000';
curl_setopt( $curl, CURLOPT_HTTPHEADER,           $headr );
curl_setopt( $curl, CURLOPT_URL,                  $url );
curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $curl, CURLOPT_HEADER,         false );
curl_setopt( $curl, CURLOPT_POSTFIELDS,           $js_request );

$data = curl_exec( $curl );
curl_close( $curl );
$data = json_decode( $data );


echo'<pre>';
print_r( json_decode( $js_request ) );
echo'</pre>';

echo'<pre>';
//print_r( $data );
echo'</pre>';

?>