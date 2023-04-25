<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <?php wp_head() ?>
    
</head>
<body <?php body_class() ?>>

    <?php wp_body_open() ?>
    <div class="wrapper">
        <header class="header">
            <div class="container">
                <?php if (!carbon_get_theme_option('hp_checkbox')) {?>
                    <a href="<?php echo get_home_url(); ?>" class="header__logo">
                        <?php $custom_logo_id = get_theme_mod( 'custom_logo' ); ?>
                        <?php echo wp_get_attachment_image( $custom_logo_id, 'full' ); ?>
                    </a>
                <?php } else {?>
                    <a href="<?php echo get_home_url(); ?>" class="header__logo header__logo_centered">
                        <?php $custom_logo_id = get_theme_mod( 'custom_logo' ); ?>
                        <?php echo wp_get_attachment_image( $custom_logo_id, 'full' ); ?>
                    </a>
                <?php } ?>

                <?php if (!carbon_get_theme_option('hp_checkbox')) {?>
                    <a href="<?php echo get_home_url()?>/wishlist/" class="header__cart">
                        <svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.1027 24.1254L12.4746 23.7912L12.1027 24.1254ZM3.00406 13.9994L2.63214 14.3336L3.00406 13.9994ZM15.8973 24.1254L16.2693 24.4595L15.8973 24.1254ZM12.6805 3.23034L13.0524 2.89616V2.89616L12.6805 3.23034ZM24.9959 13.9994L24.624 13.6652L24.9959 13.9994ZM15.3195 3.23034L15.6914 3.56453L15.3195 3.23034ZM14 4.69885L13.6281 5.03303C13.7229 5.13857 13.8581 5.19885 14 5.19885C14.1419 5.19885 14.2771 5.13857 14.3719 5.03303L14 4.69885ZM12.4746 23.7912L3.37597 13.6652L2.63214 14.3336L11.7307 24.4595L12.4746 23.7912ZM15.5254 23.7912C14.6762 24.7363 13.3238 24.7363 12.4746 23.7912L11.7307 24.4595C12.9773 25.8468 15.0227 25.8468 16.2693 24.4595L15.5254 23.7912ZM3.37597 3.56452C5.84939 0.811825 9.83516 0.811825 12.3086 3.56452L13.0524 2.89616C10.1817 -0.298719 5.50287 -0.29872 2.63214 2.89616L3.37597 3.56452ZM2.63214 2.89616C-0.210713 6.06001 -0.210713 11.1697 2.63214 14.3336L3.37597 13.6652C0.874676 10.8815 0.874676 6.34825 3.37597 3.56452L2.63214 2.89616ZM24.624 13.6652L15.5254 23.7912L16.2693 24.4595L25.3679 14.3336L24.624 13.6652ZM24.624 3.56452C27.1253 6.34825 27.1253 10.8815 24.624 13.6652L25.3679 14.3336C28.2107 11.1697 28.2107 6.06001 25.3679 2.89616L24.624 3.56452ZM15.6914 3.56453C18.1648 0.811826 22.1506 0.811826 24.624 3.56452L25.3679 2.89616C22.4971 -0.298719 17.8183 -0.298719 14.9476 2.89616L15.6914 3.56453ZM14.3719 5.03303L15.6914 3.56453L14.9476 2.89616L13.6281 4.36467L14.3719 5.03303ZM12.3086 3.56452L13.6281 5.03303L14.3719 4.36467L13.0524 2.89616L12.3086 3.56452Z" fill="black"/>
                        </svg>
                        <?php if(count(YITH_WCWL()->get_products( [ 'wishlist_id' => 'all' ] )) !== 0) {?>
                            <span class="header__cart-num">
                                <?php echo count(YITH_WCWL()->get_products( [ 'wishlist_id' => 'all' ] ))?>
                            </span>
                        <?php } else {?>
                            <span class="header__cart-num hidden">
                                <?php echo count(YITH_WCWL()->get_products( [ 'wishlist_id' => 'all' ] ))?>
                            </span>
                        <?php }?>
                    </a>
                <?php } ?>
            </div>
        </header>
        <main class="main">