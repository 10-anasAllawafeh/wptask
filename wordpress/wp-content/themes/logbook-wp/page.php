<?php get_header(); ?>
	<section class="logbook-wp-wp-blog-section ptb-20 bg-color" id="primary">
		<div class="container">
			<?php
                $sidebar_position = get_theme_mod('logbook_wp_sidebar_position', esc_html__( 'right', 'logbook-wp' ));
                if ($sidebar_position == 'left') {
                    $sidebar_position = 'has-left-sidebar';
                } elseif ($sidebar_position == 'right') {
                    $sidebar_position = 'has-right-sidebar';
                } elseif ($sidebar_position == 'no') {
                    $sidebar_position = 'no-sidebar';
                } 
            ?>
			<div class="row <?php echo esc_html($sidebar_position);?>">
				<?php if(is_active_sidebar( 'sidebar-1' )) { ?>
				<div class="col-lg-8 page_link">
					<?php
				}
				else{
					?>
					<div class="col-lg-12 page_link">
					<?php
				}
				while ( have_posts() ) :
					the_post();

					get_template_part( 'theme-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile; // End of the loop.
				?>
				</div>
				<?php
		            if (($sidebar_position == 'has-left-sidebar') || ($sidebar_position == 'has-right-sidebar') || ($sidebar_position == 'grid')) { ?>
							<div class="col-lg-4">
								<?php get_sidebar();?>
							</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<?php
get_footer();