<?php
$readmore=get_theme_mod('logbook_wp_read_more_label', esc_html__('continue reading', 'logbook-wp'));
$showauthor=get_theme_mod('logbook_wp_archive_co_post_author',true);
$showdate=get_theme_mod('logbook_wp_archive_co_post_date',true);
$showimage=get_theme_mod('logbook_wp_archive_co_featured_image',true);
?>
    <div class="blog-wrap mb-25" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if($showimage){
                if(has_post_thumbnail()) { ?>
                <div class="image-part ">
                    <?php logbook_wp_post_thumbnail(); ?>
                </div>
                <?php }
        } ?>
        <div class="content-part content">
            <?php
                if ( is_singular() ) :
                the_title( '<h1 class="title mb-20">', '</h1>' );
                else :
                the_title( '<h2 class="title mb-20"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif;

                if ( 'post' === get_post_type() ) :
            ?>
                <div class="post-sub-link mb-25">
                    <ul>
                        <?php if($showauthor){?>
                            <li class="post-auther-detail">
                                <span class="post-text"><?php esc_html__('Posted by','logbook-wp');?></span>
                                <?php logbook_wp_posted_by();?>
                            </li>
                            <?php }
                                if($showdate){?>
                                <li class="post-date">
                                    <time>
                                        <?php logbook_wp_posted_on();?>
                                    </time>
                                </li>
                            <?php } ?>
                    </ul>
                </div>
                <?php endif; ?>
                    <p class="descriptison">
                        <?php
                            if (is_singular()) {
                                the_content();
                            } else {
                                    the_excerpt();
                            }
                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'logbook-wp'),
                                'after' => '</div>',
                            ));
                        ?>
                    </p>
                    <a class="read-more" href="<?php the_permalink();?>">
                        <?php echo esc_html($readmore);?>
                    </a>
        </div>
    </div>