<?php
if (post_password_required())
{
    return;
}
?>
<div id="comments" class="comments-area">
	<?php
if (have_comments()):
?>
		<h2 class="comments-title">
			<?php
    $logbook_wp_comment_count = get_comments_number();
    if ('1' === $logbook_wp_comment_count)
    {
        printf(
        esc_html__('Comments', 'logbook-wp') , '<span>' . wp_kses_post(get_the_title()) . '</span>');
    }
    else
    {
        printf(
        esc_html(_nx('%1$s Comments', '%1$s Comments', $logbook_wp_comment_count, 'comments title', 'logbook-wp')) , number_format_i18n($logbook_wp_comment_count) , // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        '<span>' . wp_kses_post(get_the_title()) . '</span>');
    }
?>
		</h2> 

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
    wp_list_comments(array(
        'style' => 'ol',
        'short_ping' => true,
    ));
?>
		</ol> 

		<?php
    the_comments_navigation();

    if (!comments_open()):
?>
			<p class="no-comments"><?php esc_html__('Comments are closed.', 'logbook-wp'); ?></p>
			<?php
    endif;

endif;  
comment_form();
?>
</div> 