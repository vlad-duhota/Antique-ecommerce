<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500&family=Poppins:wght@400;500&display=swap" rel="stylesheet"> -->
    <?php wp_head() ?>
    
</head>
<body <?php body_class() ?>>


    <?php wp_body_open() ?>
    <div class="wrapper">
        <header class="header">
            <div class="container">
                <a href="<?php echo get_home_url(); ?>" class="header__logo">
                    <?php $custom_logo_id = get_theme_mod( 'custom_logo' ); ?>
                    <?php echo wp_get_attachment_image( $custom_logo_id, 'full' ); ?>
                </a>
                <a href="<?php echo get_home_url()?>/cart" class="header__cart">
                <svg width="26" height="31" viewBox="0 0 26 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.28 14.6477C18.28 14.6477 18.28 13.7552 18.28 6.51772C18.28 -0.719737 7.56158 -0.957762 7.56158 6.51774V14.6477M4 8.93521H21.4919C23.116 8.93521 24.4451 10.2276 24.4907 11.8511L24.8269 23.8317C24.9217 27.21 22.2089 30 18.8293 30H7C3.68629 30 1 27.3137 1 24V11.9352C1 10.2784 2.34315 8.93521 4 8.93521Z" stroke="#323232" stroke-linecap="round"/>
                </svg>
                    <?php if(count(WC()->cart->get_cart()) !== 0) {?>
                        <span class="header__cart-num">
                            <?php echo count(WC()->cart->get_cart())?>
                        </span>
                    <?php } else {?>
                        <span class="header__cart-num hidden">
                            <?php echo count(WC()->cart->get_cart())?>
                        </span>
                    <?php }?>
                </a>
            </div>
        </header>
        <main class="main">