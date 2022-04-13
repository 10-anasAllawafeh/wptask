<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary">
            <?php echo esc_html__( 'Skip to content', 'logbook-wp' ); ?>
        </a>
        <?php
            $logbook_wp_enable_sticky=get_theme_mod('logbook_wp_sticky_menu_enable',true);
            $logbook_wp_nav_class='';
            $has_header_image = has_header_image();
        ?>
            <header id="masthead" class="wp-main-header">
                <?php if($logbook_wp_enable_sticky==true){
                        $logbook_wp_nav_class .= 'logbook-wp-sticky';
                 }?>
                    <!-- Start Navbar Area -->
                    <div class="navbar-area">
                        <!-- Menu For Desktop Device -->
                        <div class="main-nav">
                            <nav id="site-navigation" class="logbook-wp-main-navigation" role="navigation" aria-label="<?php esc_html__('Main Menu', 'logbook-wp')?>">
                                <div class="wrapper <?php echo esc_html($logbook_wp_nav_class);?>">
                                    <button type="button" class="logbook-wp-menu-toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                    <?php
                                        wp_nav_menu( array(
                                            'theme_location' => 'menu-1',
                                            'menu_id'        => 'logbook-wp-primary-menu',
                                            'menu_class'     => 'logbook-wp-nav-menu',
                                            ) );
                                    ?>
                                </div>
                                <!-- .wrapper -->
                            </nav>
                            <!-- #site-navigation -->
                            <a class="skip-link-menu-end-skip" href="javascript:void(0)"></a>
                        </div>
                    </div>
                    <div class="nav-brand" <?php if (!empty($has_header_image)) { ?> style="background-image: url(
                        <?php echo esc_url(header_image()); ?>); background-size: cover;"
                            <?php } ?>>
                        <div class="container">
                            <div class="row">
                                <div class="logo-area text-center">
                                    <?php
                                        the_custom_logo();
                                        if ( is_front_page() && is_home() ) :
                                            ?>
                                                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                                                    <?php
                                        else :
                                     ?>
                                            <p class="site-title">
                                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                                    <?php bloginfo( 'name' ); ?>
                                                </a>
                                            </p>
                                    <?php
                                        endif;
                                        $logbook_wp_description = get_bloginfo( 'description', 'display' );
                                        if ( $logbook_wp_description || is_customize_preview() ) :
                                    ?>
                                    <p class="site-description">
                                        <?php echo esc_html($logbook_wp_description); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
            </header>