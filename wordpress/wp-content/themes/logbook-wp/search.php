<?php get_header(); ?>
	<div class="logbook-wp-wp-blog-section ptb-20 bg-color text-center">
		<h1 class="page-title">
			<?php
			printf( esc_html__( 'Search Results for: %s', 'logbook-wp' ), '<span>' . get_search_query() . '</span>' );
			?>
		</h1>
	</div>
	<?php
		$sidebar_position = get_theme_mod('logbook_wp_sidebar_position', esc_html__( 'grid', 'logbook-wp' ));
		$grid='';
		if ($sidebar_position == 'left') {
		    $sidebar_position = 'has-left-sidebar';
		} elseif ($sidebar_position == 'right') {
		    $sidebar_position = 'has-right-sidebar';
		} elseif ($sidebar_position == 'no') {
		    $sidebar_position = 'no-sidebar';
		}
		elseif ($sidebar_position == 'grid'){
		    $grid = 'gridlayout';
		}
        if($grid=='gridlayout'){
            require get_template_directory() . '/design/gridlayout.php';    
        }
        else{
    ?>
		<section class="logbook-wp-wp-blog-section ptb-20 bg-color" id="primary">
			<div class="container">
				<div class="row <?php echo esc_attr($sidebar_position); ?>">
					<?php if(is_active_sidebar( 'sidebar-1' )) { ?>
					<div class="col-lg-8">
						<?php 
					}
					else{
						?>
					<div class="col-lg-12">
						<?php
					}
					if ( have_posts() ) :
			
					/* Start the Loop */
					while ( have_posts() ) :
					the_post();
						get_template_part( 'theme-parts/content', 'search' );
					endwhile;
					?>
							<div class="pagination pt-5">
								<nav class="Page navigation">
									<?php
					             echo paginate_links();
					            ?>
								</nav>
							</div>
							<?php
					else :
					get_template_part( 'theme-parts/content', 'none' );

					endif;
					?>
					</div>
					<div class="col-lg-4">
						<?php get_sidebar();?>
					</div>
				</div>
			</div>
		</section>
		<?php
        }
get_footer(); ?>