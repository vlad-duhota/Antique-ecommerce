<?php

if (!defined('ABSPATH')) {
   exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// =========== ABOUT PAGE ===========


Container::make('post meta', 'Product settings')
->where( 'post_type', '=', 'product' )
->add_fields( array(
   Field::make( "multiselect", "product_stars", "Condition Report" )
   ->add_options( array(
      "0" => "Revive", 
      "1" => "Fair",
      "2" => "Good",
      "3" => "Very good",
      "4" => "Like New" 
   ) ),
) );

