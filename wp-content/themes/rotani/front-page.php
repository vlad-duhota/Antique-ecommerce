<?php /* Template Name: Home page */ ?>

<?php get_header(); ?>
<?php $pageId = get_the_ID() ?>
<section class="hero">
    <?php $bg = carbon_get_post_meta($pageId, 'hero_video')[0]?>
    <video class="hero__img" src="<?php echo wp_get_attachment_url($bg, 'full')?>" autoplay muted></video>
    <div class="container">
        <?php echo do_shortcode('[contact-form-7 id="64" title="Hero form"]')?>
    <!-- <iframe 
          src="https://api.leadconnectorhq.com/widget/form/NKl3vRmNz98C39QgoQec" 
          style="width:100%;height:100%;border:none;border-radius:4px"
          id="inline-NKl3vRmNz98C39QgoQec" 
        data-layout="{'id':'INLINE'}"
        data-trigger-type="alwaysShow"
        data-trigger-value=""
        data-activation-type="alwaysActivated"
        data-activation-value=""
        data-deactivation-type="neverDeactivate"
        data-deactivation-value=""
        data-form-name="Billy Cox List"
        data-height="450"
        data-layout-iframe-id="inline-NKl3vRmNz98C39QgoQec"
        data-form-id="NKl3vRmNz98C39QgoQec"
      >
        </iframe> -->
        <!-- <script src="https://link.msgsndr.com/js/form_embed.js"></script> -->
                    <p class="hero__text"><?php echo carbon_get_post_meta($pageId, 'hero_text')?></p>
                </div>
            </section>
            <section class="make-money" id="money">
                <h2 class="section-title center"><?php echo carbon_get_post_meta($pageId, 'make_title')?></h2>
                <div class="container">
                    <div class="make-money__btns">
                        <a href="#school" class="btn"><?php echo carbon_get_post_meta($pageId, 'make_btn_1')?></a>
                        <a href="#training" class="btn"><?php echo carbon_get_post_meta($pageId, 'make_btn_2')?></a>
                        <a href="#podcasts" class="btn"><?php echo carbon_get_post_meta($pageId, 'make_btn_3')?></a>
                        <a href="#reviews" class="btn"><?php echo carbon_get_post_meta($pageId, 'make_btn_4')?></a>
                    </div>
                </div>
            </section>
            <section class="about" id="about">
                <div class="container">
                    <a target="_blank" class="about__img" >
                    <iframe width="560" height="315" src="<?php echo str_replace('?v=', '/', str_replace('watch', 'embed', carbon_get_post_meta($pageId, 'about_video_url')))?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g filter="url(#filter0_b_161_2807)">
                                <rect width="60" height="60" rx="30" fill="white" fill-opacity="0.21" />
                                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5"
                                    stroke="url(#paint0_linear_161_2807)" />
                            </g>
                            <path
                                d="M37.7436 28.2497C39.4188 29.2305 39.4188 31.7695 37.7436 32.7503L27.6289 38.6723C26.0008 39.6256 24 38.3849 24 36.422L24 24.578C24 22.6151 26.0008 21.3744 27.6289 22.3277L37.7436 28.2497Z"
                                stroke="white" stroke-width="1.5" />
                            <defs>
                                <filter id="filter0_b_161_2807" x="-10" y="-10" width="80" height="80"
                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                    <feGaussianBlur in="BackgroundImageFix" stdDeviation="5" />
                                    <feComposite in2="SourceAlpha" operator="in"
                                        result="effect1_backgroundBlur_161_2807" />
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_161_2807"
                                        result="shape" />
                                </filter>
                                <linearGradient id="paint0_linear_161_2807" x1="3" y1="23.5" x2="59.9647" y2="22.4956"
                                    gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" stop-opacity="0.68" />
                                    <stop offset="1" stop-color="white" stop-opacity="0.39" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </a>
                    <div class="about__right">
                        <p class="about__uptitle"><?php echo carbon_get_post_meta($pageId, 'about_uptitle')?></p>
                        <h2 class="section-title"><?php echo carbon_get_post_meta($pageId, 'about_title')?></h2>
                        <div class="text">
                            <p>
                                <?php echo carbon_get_post_meta($pageId, 'about_text_1')?>
                            </p>
                            <p>
                                <?php echo carbon_get_post_meta($pageId, 'about_text_2')?>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="logos">
                <div class="container">
                    <?php foreach(carbon_get_post_meta($pageId, 'logos_list') as $logo) : ?>
                        <a href="<?php echo $logo['logos_url']?>" class="logos__item">
                            <?php $logoImg = $logo['logos_img']?>
                            <?php echo wp_get_attachment_image($logoImg, 'full')?>
                        </a>
                    <?php endforeach;?>
                    <div class="logos__swiper swiper">
                        <div class="swiper-wrapper">
                            <?php foreach(carbon_get_post_meta($pageId, 'logos_list') as $logo) : ?>
                                <div href="<?php echo $logo['logos_url']?>" class="swiper-slide logos__item">
                                    <?php $logoImg = $logo['logos_img']?>
                                    <?php echo wp_get_attachment_image($logoImg, 'full')?>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </section>
            <section class="banner banner_1">
            <?php $bannerBg_1 = carbon_get_post_meta($pageId, 'banner_1_video')[0]?>
                <video src="<?php echo wp_get_attachment_url($bannerBg_1, 'full')?>" class="banner__video" autoplay muted></video>
                <div class="container">
                    <a href="#training" class="btn"><?php echo carbon_get_post_meta($pageId, 'banner_1_text')?></a>
                </div>
            </section>
            <section class="study" id="school">
                <div class="container">
                    <div class="study__left">
                        <p class="study__uptitle"> <?php echo carbon_get_post_meta($pageId, 'study_uptitle')?></p>
                        <h2 class="section-title white"><?php echo carbon_get_post_meta($pageId, 'study_title')?></h2>
                        <div class="text">
                            <p>
                                <?php echo carbon_get_post_meta($pageId, 'study_text_1')?>
                            </p>
                            <p>
                                <?php echo carbon_get_post_meta($pageId, 'study_text_2')?>
                            </p>
                        </div>
                        <ul class="study__list">
                            <?php foreach(carbon_get_post_meta($pageId, 'study_list') as $studyItem) : ?>
                                <li class="study__item"><?php echo $studyItem['study_item']?></li> 
                            <?php endforeach;?>
                        </ul>
                        <a href="<?php echo carbon_get_post_meta($pageId, 'study_btn_url')?>" class="btn dark"><?php echo carbon_get_post_meta($pageId, 'study_btn')?></a>
                    </div>
                    <a target="_blank" class="study__img">
                        <iframe width="560" height="315" src="<?php echo str_replace('?v=', '/', str_replace('watch', 'embed', carbon_get_post_meta($pageId, 'study_video_url')))?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g filter="url(#filter0_b_161_2807)">
                                <rect width="60" height="60" rx="30" fill="white" fill-opacity="0.21" />
                                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5"
                                    stroke="url(#paint0_linear_161_2807)" />
                            </g>
                            <path
                                d="M37.7436 28.2497C39.4188 29.2305 39.4188 31.7695 37.7436 32.7503L27.6289 38.6723C26.0008 39.6256 24 38.3849 24 36.422L24 24.578C24 22.6151 26.0008 21.3744 27.6289 22.3277L37.7436 28.2497Z"
                                stroke="white" stroke-width="1.5" />
                            <defs>
                                <filter id="filter0_b_161_2807" x="-10" y="-10" width="80" height="80"
                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                    <feGaussianBlur in="BackgroundImageFix" stdDeviation="5" />
                                    <feComposite in2="SourceAlpha" operator="in"
                                        result="effect1_backgroundBlur_161_2807" />
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_161_2807"
                                        result="shape" />
                                </filter>
                                <linearGradient id="paint0_linear_161_2807" x1="3" y1="23.5" x2="59.9647" y2="22.4956"
                                    gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" stop-opacity="0.68" />
                                    <stop offset="1" stop-color="white" stop-opacity="0.39" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </a>
                </div>
            </section>
            <section class="banner banner_2">
                <?php $bannerBg_2 = carbon_get_post_meta($pageId, 'banner_2_video')[0]?>
                <video src="<?php echo wp_get_attachment_url($bannerBg_2, 'full')?>" class="banner__video" autoplay muted></video>
                <div class="container">
                    <?php $custom_logo_id = get_theme_mod( 'custom_logo' ); ?>
                    <?php echo wp_get_attachment_image( $custom_logo_id, 'full' ); ?>
                </div>
            </section>
            <section class="cards" id="training">
                <div class="container">
                    <p class="cards__uptitle"><?php echo carbon_get_post_meta($pageId, 'sat_uptitle')?></p>
                    <h2 class="section-title"><?php echo carbon_get_post_meta($pageId, 'sat_title')?></h2>
                    <div class="cards__item">
                        <?php $cardImg_1 =  carbon_get_post_meta($pageId, 'sat_img_1')?>
                        <?php echo wp_get_attachment_image($cardImg_1, 'full', [], ["class" => "cards__img"])?>
                        <div class="cards__item-right">
                            <h3 class="cards__item-title"><?php echo carbon_get_post_meta($pageId, 'sat_title_1')?></h3>
                            <p class="cards__item-text">
                                <?php echo carbon_get_post_meta($pageId, 'sat_text_1')?>
                            </p>
                            <a href="<?php echo get_home_url()?>/speaking" class="btn"><?php echo carbon_get_post_meta($pageId, 'sat_btn_1')?></a>
                        </div>
                    </div>
                    <div class="cards__item reverse">
                        <?php $cardImg_2 =  carbon_get_post_meta($pageId, 'sat_img_2')?>
                        <?php echo wp_get_attachment_image($cardImg_2, 'full', [], ["class" => "cards__img"])?>
                        <div class="cards__item-right">
                            <h3 class="cards__item-title"><?php echo carbon_get_post_meta($pageId, 'sat_title_2')?></h3>
                            <p class="cards__item-text">
                                <?php echo carbon_get_post_meta($pageId, 'sat_text_2')?>
                            </p>
                            <a href="<?php echo get_home_url()?>/<?php echo carbon_get_post_meta($pageId, 'sat_btn_url_2')?>" class="btn"><?php echo carbon_get_post_meta($pageId, 'sat_btn_2')?></a>
                        </div>
                    </div>
                    <div class="cards__item">
                        <?php $cardImg_3 =  carbon_get_post_meta($pageId, 'sat_img_3')?>
                        <?php echo wp_get_attachment_image($cardImg_3, 'full', [], ["class" => "cards__img"])?>
                        <div class="cards__item-right">
                            <h3 class="cards__item-title"><?php echo carbon_get_post_meta($pageId, 'sat_title_3')?></h3>
                            <p class="cards__item-text">
                                <?php echo carbon_get_post_meta($pageId, 'sat_text_3')?>
                            </p>
                            <a href="<?php echo carbon_get_post_meta($pageId, 'sat_btn_url_3')?>" class="btn"><?php echo carbon_get_post_meta($pageId, 'sat_btn_3')?></a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="banner">
                <?php $bannerBg_3 = carbon_get_post_meta($pageId, 'banner_3_video')[0]?>
                <video src="<?php echo wp_get_attachment_url($bannerBg_3, 'full')?>" class="banner__video" autoplay muted></video>
            </section>
            <section class="about about_2">
            <div class="container">
                    <a target="_blank" class="about__img">
                    <iframe width="560" height="315" src="<?php echo str_replace('?v=', '/', str_replace('watch', 'embed', carbon_get_post_meta($pageId, 'training_video_url')))?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g filter="url(#filter0_b_161_2807)">
                                <rect width="60" height="60" rx="30" fill="white" fill-opacity="0.21" />
                                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5"
                                    stroke="url(#paint0_linear_161_2807)" />
                            </g>
                            <path
                                d="M37.7436 28.2497C39.4188 29.2305 39.4188 31.7695 37.7436 32.7503L27.6289 38.6723C26.0008 39.6256 24 38.3849 24 36.422L24 24.578C24 22.6151 26.0008 21.3744 27.6289 22.3277L37.7436 28.2497Z"
                                stroke="white" stroke-width="1.5" />
                            <defs>
                                <filter id="filter0_b_161_2807" x="-10" y="-10" width="80" height="80"
                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                    <feGaussianBlur in="BackgroundImageFix" stdDeviation="5" />
                                    <feComposite in2="SourceAlpha" operator="in"
                                        result="effect1_backgroundBlur_161_2807" />
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_161_2807"
                                        result="shape" />
                                </filter>
                                <linearGradient id="paint0_linear_161_2807" x1="3" y1="23.5" x2="59.9647" y2="22.4956"
                                    gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" stop-opacity="0.68" />
                                    <stop offset="1" stop-color="white" stop-opacity="0.39" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </a>
                    <div class="about__right">
                        <p class="about__uptitle"><?php echo carbon_get_post_meta($pageId, 'training_uptitle')?></p>
                        <h2 class="section-title"><?php echo carbon_get_post_meta($pageId, 'training_title')?></h2>
                        <div class="text">
                            <p>
                                <?php echo carbon_get_post_meta($pageId, 'training_text_1')?>
                            </p>
                            <p>
                                <?php echo carbon_get_post_meta($pageId, 'training_text_2')?>
                            </p>
                        </div>
                        <a href="<?php echo carbon_get_post_meta($pageId, 'training_btn_url')?>" class="btn"> <?php echo carbon_get_post_meta($pageId, 'training_btn')?></a>
                    </div>
                </div>
            </section>
            <section class="logos logos_2">
                <h2><?php echo carbon_get_post_meta($pageId, 'logos_title')?></h2>
                <div class="container">
                    <?php foreach(carbon_get_post_meta($pageId, 'logos_list_2') as $logo) : ?>
                        <a href="<?php echo $logo['logos_url']?>" class="logos__item">
                            <?php $logoImg = $logo['logos_img']?>
                            <?php echo wp_get_attachment_image($logoImg, 'full')?>
                        </a>
                    <?php endforeach;?>
                    <div class="logos__swiper swiper">
                        <div class="swiper-wrapper">
                            <?php foreach(carbon_get_post_meta($pageId, 'logos_list_2') as $logo) : ?>
                                <div href="<?php echo $logo['logos_url']?>" class="swiper-slide logos__item">
                                    <?php $logoImg = $logo['logos_img']?>
                                    <?php echo wp_get_attachment_image($logoImg, 'full')?>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </section>
            <section class="article" id="reviews">
                <?php $articleBg = carbon_get_post_meta($pageId, 'article_bg')?>
                <?php echo wp_get_attachment_image($articleBg, 'full', [], ["class" => "article__img"])?>
                <div class="container">
                    <h2><?php echo carbon_get_post_meta($pageId, 'article_title')?></h2>
                    <p class="article__author"><?php echo carbon_get_post_meta($pageId, 'article_author')?></p>
                </div>
            </section>
            <section class="banner">
                <?php $bannerBg_4 = carbon_get_post_meta($pageId, 'banner_4_video')[0]?>
                <video src="<?php echo wp_get_attachment_url($bannerBg_4, 'full')?>" class="banner__video" autoplay muted></video>
            </section>
            <section class="about about-dif">
            <div class="container">
                    <p class="about__uptitle"><?php echo carbon_get_post_meta($pageId, 'facebook_uptitle')?></p>
                    <h2 class="section-title"><?php echo carbon_get_post_meta($pageId, 'facebook_title')?></h2>
                    <a target="_blank" class="about__img">
                    <iframe width="560" height="315" src="<?php echo str_replace('?v=', '/', str_replace('watch', 'embed', carbon_get_post_meta($pageId, 'facebook_video_url')))?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g filter="url(#filter0_b_161_2807)">
                                <rect width="60" height="60" rx="30" fill="white" fill-opacity="0.21" />
                                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5"
                                    stroke="url(#paint0_linear_161_2807)" />
                            </g>
                            <path
                                d="M37.7436 28.2497C39.4188 29.2305 39.4188 31.7695 37.7436 32.7503L27.6289 38.6723C26.0008 39.6256 24 38.3849 24 36.422L24 24.578C24 22.6151 26.0008 21.3744 27.6289 22.3277L37.7436 28.2497Z"
                                stroke="white" stroke-width="1.5" />
                            <defs>
                                <filter id="filter0_b_161_2807" x="-10" y="-10" width="80" height="80"
                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                    <feGaussianBlur in="BackgroundImageFix" stdDeviation="5" />
                                    <feComposite in2="SourceAlpha" operator="in"
                                        result="effect1_backgroundBlur_161_2807" />
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_161_2807"
                                        result="shape" />
                                </filter>
                                <linearGradient id="paint0_linear_161_2807" x1="3" y1="23.5" x2="59.9647" y2="22.4956"
                                    gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" stop-opacity="0.68" />
                                    <stop offset="1" stop-color="white" stop-opacity="0.39" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </a>
                    <div class="about__right">
                        <?php $custom_logo_id = get_theme_mod( 'custom_logo' ); ?>
                        <?php echo wp_get_attachment_image( $custom_logo_id, 'full' ); ?>
                        <div class="text">
                            <p>
                                <?php echo carbon_get_post_meta($pageId, 'facebook_text_1')?>
                            </p>
                            <p>
                                <?php echo carbon_get_post_meta($pageId, 'facebook_text_2')?>
                            </p>
                        </div>
                        <a href="<?php echo carbon_get_post_meta($pageId, 'facebook_btn_url')?>" class="btn"><?php echo carbon_get_post_meta($pageId, 'facebook_btn')?></a>
                    </div>
                </div>
            </section>
            <section class="about about-dif">
            <div class="container">
                    <p class="about__uptitle"><?php echo carbon_get_post_meta($pageId, 'podcast_uptitle')?></p>
                    <h2 class="section-title"><?php echo carbon_get_post_meta($pageId, 'podcast_title')?></h2>
                    <a target="_blank" class="about__img">
                    <iframe width="560" height="315" src="<?php echo str_replace('?v=', '/', str_replace('watch', 'embed', carbon_get_post_meta($pageId, 'podcast_video_url')))?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g filter="url(#filter0_b_161_2807)">
                                <rect width="60" height="60" rx="30" fill="white" fill-opacity="0.21" />
                                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5"
                                    stroke="url(#paint0_linear_161_2807)" />
                            </g>
                            <path
                                d="M37.7436 28.2497C39.4188 29.2305 39.4188 31.7695 37.7436 32.7503L27.6289 38.6723C26.0008 39.6256 24 38.3849 24 36.422L24 24.578C24 22.6151 26.0008 21.3744 27.6289 22.3277L37.7436 28.2497Z"
                                stroke="white" stroke-width="1.5" />
                            <defs>
                                <filter id="filter0_b_161_2807" x="-10" y="-10" width="80" height="80"
                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                    <feGaussianBlur in="BackgroundImageFix" stdDeviation="5" />
                                    <feComposite in2="SourceAlpha" operator="in"
                                        result="effect1_backgroundBlur_161_2807" />
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_161_2807"
                                        result="shape" />
                                </filter>
                                <linearGradient id="paint0_linear_161_2807" x1="3" y1="23.5" x2="59.9647" y2="22.4956"
                                    gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" stop-opacity="0.68" />
                                    <stop offset="1" stop-color="white" stop-opacity="0.39" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </a>
                    <div class="about__right">
                        <?php $custom_logo_id = get_theme_mod( 'custom_logo' ); ?>
                        <?php echo wp_get_attachment_image( $custom_logo_id, 'full' ); ?>
                        <div class="text">
                            <p>
                                <?php echo carbon_get_post_meta($pageId, 'podcast_text_1')?>
                            </p>
                            <p>
                                <?php echo carbon_get_post_meta($pageId, 'podcast_text_2')?>
                            </p>
                        </div>
                        <a href="<?php echo carbon_get_post_meta($pageId, 'podcast_btn_url')?>" class="btn"><?php echo carbon_get_post_meta($pageId, 'podcast_btn')?></a>
                    </div>
                </div>
            </section>
            <section class="banner">
                <?php $bannerBg_5 = carbon_get_post_meta($pageId, 'banner_5_video')[0]?>
                <video src="<?php echo wp_get_attachment_url($bannerBg_5, 'full')?>" class="banner__video" autoplay muted></video>
            </section>
            <section class="socials">
                <div class="container">
                    <ul class="socials__list">
                        <?php foreach(carbon_get_theme_option('socials') as $social) : ?>
                            <li>
                                <a href="<?php echo $social['socials_link']?>" target="_blank">
                                    <?php $socialImg = $social['socials_img']?>
                                    <?php echo wp_get_attachment_image($socialImg, 'full')?>
                                </a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                    <div class="socials__right">
                        <p class="socials__uptitle"><?php echo carbon_get_post_meta($pageId, 'social_uptitle')?></p>
                        <h2 class="section-title"><?php echo carbon_get_post_meta($pageId, 'social_title')?></h2>
                    </div>
                </div>
            </section>
            <section class="youtube">
                <div class="container">
                    <p class="youtube__uptitle"><?php echo carbon_get_post_meta($pageId, 'youtube_uptitle')?></p>
                    <h2 class="section-title"><?php echo carbon_get_post_meta($pageId, 'youtube_title')?></h2>
                    <div class="youtube__list">
                        <?php foreach(carbon_get_post_meta($pageId, 'youtube_list') as $youtubeItem) : ?>
                        <a class="youtube__item">
                        <iframe width="560" height="315" src="<?php echo str_replace('?v=', '/', str_replace('watch', 'embed', $youtubeItem['youtube_url']))?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            <svg width="37" height="37" viewBox="0 0 37 37" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_b_161_2669)">
                                    <rect width="37" height="37" rx="18.5" fill="white" fill-opacity="0.21" />
                                    <rect x="0.5" y="0.5" width="36" height="36" rx="18"
                                        stroke="url(#paint0_linear_161_2669)" />
                                </g>
                                <path
                                    d="M23.2751 17.4205C24.3082 18.0253 24.3082 19.5909 23.2752 20.1957L17.0378 23.8475C16.0338 24.4353 14.7999 23.6702 14.7999 22.4599L14.7999 15.1563C14.7999 13.946 16.0338 13.1809 17.0378 13.7687L23.2751 17.4205Z"
                                    stroke="white" stroke-width="1.5" />
                                <defs>
                                    <filter id="filter0_b_161_2669" x="-10" y="-10" width="57" height="57"
                                        filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                        <feGaussianBlur in="BackgroundImageFix" stdDeviation="5" />
                                        <feComposite in2="SourceAlpha" operator="in"
                                            result="effect1_backgroundBlur_161_2669" />
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_161_2669"
                                            result="shape" />
                                    </filter>
                                    <linearGradient id="paint0_linear_161_2669" x1="1.85" y1="14.4917" x2="36.9782"
                                        y2="13.8723" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" stop-opacity="0.68" />
                                        <stop offset="1" stop-color="white" stop-opacity="0.39" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </a>
                        <?php endforeach;?>
                    </div>
                </div>
            </section>
            <section class="podcast" id="podcasts">
                <div class="container">
                    <div class="podcast__left">
                        <h2 class="section-title"><?php echo carbon_get_post_meta($pageId, 'be_podcast_title')?></h2>
                        <p class="podcast__text">
                            <?php echo carbon_get_post_meta($pageId, 'be_podcast_text')?>
                        </p>
                    </div>
                    <?php echo do_shortcode('[contact-form-7 id="103" title="Podcast form"]')?>
                    <!-- <form action="#" class="podcast__form">
                        <input type="text" class="podcast__form-input" placeholder="First Name">
                        <input type="text" class="podcast__form-input" placeholder="Last Name">
                        <input type="email" class="podcast__form-input" placeholder="Email">
                        <input type="url" class="podcast__form-input" placeholder="Website URL">
                        <input type="text" class="podcast__form-input" placeholder="Instagram Username">
                        <input type="tel" class="podcast__form-input tel-input">
                        <textarea name="" id="" cols=" 30" rows="10" placeholder="Your Story">

                        </textarea>
                        <input type="submit" value="Submit" class="btn">
                    </form> -->
                </div>
            </section>
            <section class="banner">
                <?php $bannerBg_6 = carbon_get_post_meta($pageId, 'banner_6_video')[0]?>
                <video src="<?php echo wp_get_attachment_url($bannerBg_6, 'full')?>" class="banner__video" autoplay muted></video>
            </section>
            <section class="book" id="book">
                <div class="container">
                    <div class="book__left">
                        <?php $bookImg = carbon_get_post_meta($pageId, 'book_img')?>
                        <?php echo wp_get_attachment_image($bookImg, 'full', [], ["class" => "book__img"])?>
                        <div class="book__swiper swiper">
                            <div class="book__pagination">
                                <button class="book__pagination-btn book__pagination-prev"><svg width="11" height="17"
                                        viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 1L1.88191 8.59008C1.42396 9.01825 1.4684 9.75736 1.97435 10.1276L10 16"
                                            stroke="white" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <button class="book__pagination-btn book__pagination-next"><svg width="11" height="17"
                                        viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1 16L9.11809 8.40992C9.57604 7.98175 9.5316 7.24264 9.02565 6.87242L1 1"
                                            stroke="white" stroke-width="2" stroke-linecap="round" />
                                    </svg>

                                </button>
                            </div>
                            <div class="swiper-wrapper">
                                <?php foreach(carbon_get_post_meta($pageId, 'book_slider') as $bookSlide) : ?>
                                    <div class="swiper-slide">
                                        <h3><?php echo $bookSlide['book_slider_text']?></h3>
                                        <p><?php echo $bookSlide['book_slider_author']?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="book__right">
                        <p class="book__uptitle">
                            <?php echo carbon_get_post_meta($pageId, 'book_uptitle')?>
                        </p>
                        <h2 class="section-title"><?php echo carbon_get_post_meta($pageId, 'book_title')?></h2>
                        <div class="text">
                            <p><?php echo carbon_get_post_meta($pageId, 'book_text_1')?></p>
                            <p><?php echo carbon_get_post_meta($pageId, 'book_text_2')?></p>
                        </div>
                        <!-- <a href="<?php echo carbon_get_post_meta($pageId, 'book_btn_url')?>" class="btn"><?php echo carbon_get_post_meta($pageId, 'book_btn')?></a> -->
                           <a href="<?php echo get_home_url()?>/coming-soon" class="btn"><?php echo carbon_get_post_meta($pageId, 'book_btn')?></a>
                    </div>
                </div>
            </section>
<?php get_footer(); ?>