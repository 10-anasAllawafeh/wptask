<?php
/**
Template Name:No Sidebar Page
**/
get_header();?>
<section class="wp-full-width-sec ptb-20 bg-color">
	<?php
		while (have_posts()):
			the_post();
			get_template_part('theme-parts/content', 'page');
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()):
				comments_template();
			endif;
		endwhile; // End of the loop.
	?>
</section>
<?php get_footer();?>