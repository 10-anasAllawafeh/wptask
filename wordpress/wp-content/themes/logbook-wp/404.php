<?php get_header();?>
    <div class="error-page-section">
        <div class="container">
            <div class="error-page-inner">
                <h1><?php echo esc_html__('404','logbook-wp');?></h1>
                <h3><i class="fa fa-exclamation-triangle"></i><?php echo esc_html__('Sorry! Page Not Found','logbook-wp');?></h3>
                <p>
                    <?php echo esc_html__('Your searched terms not found please try another keyword.','logbook-wp');?>
                </p>
                <div class="btn-group">
                    <a href="<?php echo esc_url(home_url());?>" class="btn">
                        <?php echo esc_html__('Home Page','logbook-wp');?>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>