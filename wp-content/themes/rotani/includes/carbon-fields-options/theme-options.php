<?php
if (!defined('ABSPATH')) {
    exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('theme_options', 'Theme options')
->add_fields( array(
    Field::make( 'checkbox', 'hp_checkbox', 'Home Page Layout' )
    ->set_help_text('If you check this, products on home page will be hidden'),
    Field::make( 'text', 'shop_uptitle', 'Shop uptitle'),
    Field::make( 'text', 'shop_title', 'Shop title'),
    Field::make( 'text', 'shop_subtitle', 'Shop subtitle'),
    Field::make( 'text', 'shop_tag_1', 'Shop tag 1'),
    Field::make( 'text', 'shop_tag_2', 'Shop tag 2'),
    Field::make( 'rich_text', 'shop_text', 'Shop banner text'),
    Field::make( 'image', 'shop_img', 'Shop banner image'),
    Field::make( 'complex', 'footer_socials', __( 'Footer Socials' ) )
    ->add_fields( array(
        Field::make( 'text', 'footer_socials_link', __( 'Social Link' ) ),
        Field::make( 'image', 'footer_socials_img', __( 'Social Icon' ) ),
    ) ),
    Field::make( 'text', 'thank_tel', 'Thank page phone number'),
) );