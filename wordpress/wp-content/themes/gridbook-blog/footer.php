<?php
$show_copyright = get_theme_mod('logbook_wp_footer_copyright_display', true);
$copyright = get_theme_mod('logbook_wp_copyright',esc_html__('Proudly Powered By WordPress', 'gridbook-blog'));
?>
    <footer class="footer-section">
        <?php
            if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4'))
        {
             $count = 0;
            for ($i = 1;$i <= 4;$i++)
            {
                if (is_active_sidebar('footer-' . $i))
                {
                    $count++;
                }
            }

            $footer_col = 4;
            if ($count == 4)
            {
                $footer_col = 3;
            }
            elseif ($count == 3)
            {
                $footer_col = 4;
            }
            elseif ($count == 2)
            {
                $footer_col = 6;
            }
            elseif ($count == 1)
            {
                $footer_col = 12;
            }
        ?>
            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <?php
        for ($i = 1;$i <= 4;$i++)
        {
            if (is_active_sidebar('footer-' . $i))
            {
        ?>
                            <div class="col-md-<?php echo esc_html($footer_col); ?>">
                                <div class="footer-top-box wow fadeInUp">
                                    <?php dynamic_sidebar('footer-' . $i); ?>
                                </div>
                            </div>
                            <?php
            }
        }
        ?>
                    </div>
                </div>
            </div>
            <?php
            }
            if ($show_copyright && $copyright!='') { ?>
                <div class="copyright-footer">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 text-lg-center align-self-center">
                                <p><?php echo wp_kses_post($copyright); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                } 
            ?>
    </footer>
    <button onclick="topFunction()" id="myBtn" title="<?php echo esc_attr("Go to top", 'gridbook-blog') ?>">
        <i class="fa fa-angle-up"></i>
    </button> 
</div><!-- #page -->
<?php wp_footer(); ?>
    </body>
</html>