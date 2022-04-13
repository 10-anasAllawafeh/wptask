<?php get_header(); ?>
	<div class="logbook-wp-wp-blog-section ptb-20 bg-color text-center">
	<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
	?> 
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
		$grid='gridlayout';
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
					while ( have_posts() ) :
						the_post();
						get_template_part( 'theme-parts/content', get_post_type() );

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
				<?php
        if (($sidebar_position == 'has-left-sidebar') || ($sidebar_position == 'has-right-sidebar')) { ?>
					<div class="col-lg-4">
						<?php get_sidebar();?>
					</div>
					<?php }?>
			</div>
		</div>
	</section>
	<?php
	}
get_footer(); ?>