<?php
if (!defined('ABSPATH')) {
    exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('theme_options', 'Theme options')
->add_fields( array(
    Field::make( 'image', 'shop_img', 'Shop banner image'),
    Field::make( 'text', 'shop_title', 'Shop banner title'),
    Field::make( 'text', 'shop_text', 'Shop banner text'),
    Field::make( 'complex', 'footer_socials', __( 'Footer Socials' ) )
    ->add_fields( array(
        Field::make( 'text', 'footer_socials_link', __( 'Social Link' ) ),
        Field::make( 'image', 'footer_socials_img', __( 'Social Icon' ) ),
    ) )
) );