    </main>
    <footer class="footer">
        <div class="container">
                <ul class="footer__socials">
                    <?php foreach(carbon_get_theme_option('footer_socials') as $item) : ?>
                        <li>
                            <a target="_blank" href="<?php echo $item['footer_socials_link']?>">
                                <?php $socialIcon = $item['footer_socials_img']?>
                                <?php echo wp_get_attachment_image($socialIcon, 'full')?>
                            </a>
                        </li>
                    <?php endforeach;?>
                </ul>
                <div class="footer-center">
                <a href="<?php echo get_home_url(); ?>" class="header__logo">
                    <?php $custom_logo_id = get_theme_mod( 'custom_logo' ); ?>
                    <?php echo wp_get_attachment_image( $custom_logo_id, 'full' ); ?>
                </a>
                <div class="footer-center__info">
                <p>©<?php the_date('Y')?> Ronati Antiques. All Rights Reserved </p>
                    <a href="<?php echo get_home_url()?>/terms">Terms and conditions</a>
                </div>
                  
                </div>
                <!-- <a href="<?php echo get_home_url(); ?>" class="footer__logo">
                    <?php $custom_logo_id = get_theme_mod( 'custom_logo' ); ?>
                    <?php echo wp_get_attachment_image( $custom_logo_id, 'full' ); ?>
                </a> -->
                <div class="footer__form">
                    <h3>Join our mailing list</h3>
                    <?php echo do_shortcode('[contact-form-7 id="25" title="Footer form"]')?>
                </div>
            </div>
    </footer>
</div>

    <?php wp_footer() ?>
</body>
</html>