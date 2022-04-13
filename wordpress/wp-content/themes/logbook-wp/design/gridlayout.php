<?php get_header();
$readmore=get_theme_mod('logbook_wp_read_more_label', esc_html__('continue reading', 'logbook-wp'));
$showauthor=get_theme_mod('logbook_wp_archive_co_post_author',true);
$showdate=get_theme_mod('logbook_wp_archive_co_post_date',true);
$showimage=get_theme_mod('logbook_wp_archive_co_featured_image',true);
?>
    <section class="wp-index-blog-section ptb-20 bg-color" id="primary">
        <?php
    if ( have_posts() ) :

        if ( is_home() && ! is_front_page() ) :
        ?>
            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            <?php
        endif;

        /* Start the Loop */
        while ( have_posts() ) :
            the_post();

            ?>
            <div class="post">
            <?php if($showimage){
                if(has_post_thumbnail()) {
                    logbook_wp_post_thumbnail(); 
                }    
            } 
            ?>
                <div class="post-content">
                <?php
                if ( is_singular() ) :
                the_title( '<h1 class="post-title">', '</h1>' );
                else :
                the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif;
                ?>
                    <div class="post-sub-link after-title">
                        <ul>
                            <?php if($showauthor){ ?>
                                <li class="post-auther-detail"> <span class="post-text"><?php esc_html__('Posted by','logbook-wp');?></span>
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
                    <div class="post-description">
                        <?php
                            if (is_singular()) {
                                the_content();
                            } 
                            else {
                                the_excerpt();
                            }
                            wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'logbook-wp'),
                            'after' => '</div>',
                            ));
                        ?> 
                    </div>
                    <div class="post-readmore">
                        <?php if($readmore!='') { ?>
                            <a class="read-more" href="<?php the_permalink();?>">
                                <?php echo esc_html($readmore);?>
                            </a>
                        <?php } ?>
                        <div class="post-comment">
                            <a href="<?php comments_link(); ?>">
                                <?php comments_number();?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endwhile;

    else :

    get_template_part( 'theme-parts/content', 'none' );

    endif;
    ?>
    </section>
    <section class="logbook-wp-wp-blog-section pb-4 bg-color">
        <div class="container">
            <div class="pagination">
                <nav class="Page navigation">
                    <?php
            echo paginate_links();
            ?>
                </nav>
            </div>
        </div>
    </section>
<?php get_footer();?>