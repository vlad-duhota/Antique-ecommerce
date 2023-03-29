<?php get_header(); 
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
?>
    <section class="blog-sec">
        <div class="container">
            <h1 class="other-page__title section-title"><span>Blog</span> Billy </h1>
            <?php
            $i = 0;
            // The Query
            $the_query = new WP_Query( [
                'posts_per_page' => 7,
                'paged' => $paged,
            ]);
                if ( $the_query->have_posts() ) : ?>
                    <ul class="blog__list">
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); $i++ ?>
                            <?php if($i > 1) { ?>
                            <li class="blog__item">
                                <?php $postImg = get_post_thumbnail_id($post -> ID)?>
                                <a href="<?php echo the_permalink($post->ID)?>" class="blog__item-img">
                                    <?php echo wp_get_attachment_image($postImg, 'full')?>
                                </a>
                                    <p class="blog__item-date"><?php echo get_the_date()?></p>
                                    <h3 class="blog__item-title h2"><a href="<?php echo the_permalink($post->ID)?>"><?php the_title()?></a></h3>
                                    <div class="blog__item-text"><?php the_excerpt($post -> ID)?></p>
                                    <a href="<?php echo the_permalink($post->ID)?>" class="blog__learn-more">
                                        Learn more
                                        <svg width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 1L8.9375 6.48765C9.47543 6.85956 9.51748 7.63921 9.02268 8.06682L1 15" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                            </li>
                            <?php } else {?>
                                <li class="blog__item blog__item-big">
                                <?php $postImg = get_post_thumbnail_id($post -> ID)?>
                                <a href="<?php echo the_permalink($post->ID)?>" class="blog__item-img">
                                <?php echo wp_get_attachment_image($postImg, 'full')?>
                                </a>
                                <div class="blog__item-right">
                                    <p class="blog__item-date"><?php echo get_the_date()?></p>
                                    <h3 class="blog__item-title h2"><a href="<?php echo the_permalink($post->ID)?>"><?php the_title()?></a></h3>
                                    <div class="blog__item-content text">
                                        <?php echo wp_custom_trim_words(get_the_content(), 95, '')?>
                                    </div>
                                    <a href="<?php echo the_permalink($post->ID)?>" class="blog__learn-more">
                                        Learn more
                                        <svg width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 1L8.9375 6.48765C9.47543 6.85956 9.51748 7.63921 9.02268 8.06682L1 15" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </li>
                            <?php }?>
                        <?php endwhile;?>
                    </ul>
                    <?php endif;
                    wp_reset_postdata();?>
                    <?php echo siteDefPaging($the_query)?>
        </div>
    </section>


<?php get_footer(); ?>