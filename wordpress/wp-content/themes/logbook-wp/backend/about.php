<?php
/**
 * Alchemist Theme page
 *
 * @package Chique
 */

function logbook_wp_about_admin_style( $hook ) {
	if ( 'appearance_page_logbook-wp-about' === $hook ) {
		wp_enqueue_style( 'logbook-wp-about-admin', get_theme_file_uri( 'styles/css/about-admin.css' ), null, '1.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'logbook_wp_about_admin_style' );

/**
 * Add theme page
 */
function logbook_wp_menu() {
	add_theme_page( esc_html__( 'About Theme', 'logbook-wp' ), esc_html__( 'About Theme', 'logbook-wp' ), 'edit_theme_options', 'logbook-wp-about', 'logbook_wp_about_display' );
}
add_action( 'admin_menu', 'logbook_wp_menu' );

/**
 * Display About page
 */
function logbook_wp_about_display() {
	$theme = wp_get_theme();
	?>
	<div class="wrap about-wrap full-width-layout">
		<h1><?php echo esc_html( $theme ); ?></h1>
		<div class="about-theme">
			<div class="theme-description">
				<p class="about-text">
					<?php
					// Remove last sentence of description.
					$description = explode( '. ', $theme->get( 'Description' ) );

					array_pop( $description );

					$description = implode( '. ', $description );

					echo esc_html( $description . '.' );
				?></p>
				<p class="actions">
					<a href="http://blogwpthemes.com/logbook-wp-theme/" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'logbook-wp' ); ?></a>

					<a href="http://blogwpthemes.com/demo/logbook-wp/" class="button button-secondary" target="_blank"><?php esc_html_e( 'View Demo', 'logbook-wp' ); ?></a>

					<a href="http://blogwpthemes.com/demo/theme-docs/docs/logbook-wp-documentation/" class="button button-primary" target="_blank"><?php esc_html_e( 'Theme Instructions', 'logbook-wp' ); ?></a>

					<a href="http://wordpress.org/support/theme/logbook/#new-post" class="button button-secondary" target="_blank"><?php esc_html_e( 'Rate this theme', 'logbook-wp' ); ?></a>

					<a href="http://blogwpthemes.com/product/logbook-pro-blog-wordpress-theme/" class="green button button-secondary" target="_blank"><?php esc_html_e( 'Upgrade to pro', 'logbook-wp' ); ?></a>
				</p>
			</div>

			<div class="theme-screenshot">
				<img src="<?php echo esc_url( $theme->get_screenshot() ); ?>" />
			</div>

		</div>

		<nav class="nav-tab-wrapper wp-clearfix" aria-label="<?php esc_attr_e( 'Secondary menu', 'logbook-wp' ); ?>">
			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'logbook-wp-about' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['page'] ) && 'logbook-wp-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'About', 'logbook-wp' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'logbook-wp-about', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Free Vs Pro', 'logbook-wp' ); ?></a>
		</nav>

		<?php
			logbook_wp_main_screen();

			logbook_wp_free_vs_pro_screen();

		?>

		<div class="return-to-dashboard">
			<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
				<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
					<?php is_multisite() ? esc_html_e( 'Return to Updates', 'logbook-wp' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'logbook-wp' ); ?>
				</a> |
			<?php endif; ?>
			<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'logbook-wp' ) : esc_html_e( 'Go to Dashboard', 'logbook-wp' ); ?></a>
		</div>
	</div>
	<?php
}

/**
 * Output the main about screen.
 */
function logbook_wp_main_screen() {
	if ( isset( $_GET['page'] ) && 'logbook-wp-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) {
	?>
		<div class="feature-section two-col">
			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Theme Customizer', 'logbook-wp' ); ?></h2>
				<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'logbook-wp' ) ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Customize', 'logbook-wp' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Got theme support question?', 'logbook-wp' ); ?></h2>
				<p><?php esc_html_e( 'Get genuine support from genuine people. Whether it\'s customization or compatibility, our seasoned developers deliver tailored solutions to your queries.', 'logbook-wp' ) ?></p>
				<p><a href="http://blogwpthemes.com/forums/forum/theme-support/" class="button button-primary"><?php esc_html_e( 'Support Forum', 'logbook-wp' ); ?></a></p>
			</div>
		</div>
	<?php
	}
}

/**
 * Output the changelog screen.
 */
function logbook_wp_free_vs_pro_screen() {
	if ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) {
	?>
		<div class="wrap about-wrap vs-theme-table">
			<div id="compare" aria-labelledby="ui-id-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" style="display: block;" aria-hidden="false">
			   <div class="tab-containter">
			      <div class="wrapper">
			         <div class="tab-header">
			            <h2 class="entry-title">Free Vs Pro (Premium)</h2>
			         </div>
			         <div class="compare-table">
			            <div class="hentry">
			            	<table>
							    <thead>
							        <tr>
							            <th>Free</th>
							            <th>Features</th>
							            <th>Pro (Premium)</th>
							        </tr>
							    </thead>
							    <tbody>
							        <tr>
							            <td><i class="dashicons dashicons-yes"></i></td>
							            <td>Responsive Design</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        <tr>
							            <td><i class="dashicons dashicons-yes"></i></td>
							            <td>Super Easy Setup</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
									<tr>
							            <td><i class="dashicons dashicons-yes"></i></td>
							            <td>Woocommerce Compatible</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        <tr>
							            <td><i class="dashicons dashicons-yes"></i></td>
							            <td>Premium Support</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
									<tr>
							            <td><i class="dashicons dashicons-yes"></i></td>
							            <td>Excerpt Options</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        <tr>
							            <td><i class="dashicons dashicons-no"></i></td>
							            <td>Multiple Home Pages</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        <tr>
							            <td><i class="dashicons dashicons-no"></i></td>
							            <td>Unlimites Color Scheme</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        <tr>
							            <td><i class="dashicons dashicons-no"></i></td>
							            <td>Multiple Header Layouts</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        <tr>
							            <td><i class="dashicons dashicons-no"></i></td>
							            <td>Multiple Footer Layouts</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        <tr>
							            <td><i class="dashicons dashicons-no"></i></td>
							            <td>Footer Menu</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        <tr>
							            <td><i class="dashicons dashicons-no"></i></td>
							            <td>Premium Widgets</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        <tr>
							            <td><i class="dashicons dashicons-no"></i></td>
							            <td>Contact Form</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        <tr>
							            <td><i class="dashicons dashicons-no"></i></td>
							            <td>Social Shares</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        
							        <tr>
							            <td><i class="dashicons dashicons-no"></i></td>
							            <td>Premium Plugins</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        <tr>
							            <td><i class="dashicons dashicons-no"></i></td>
							            <td>Page Customiztion</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        
							        <tr>
							            <td><i class="dashicons dashicons-no"></i></td>
							            <td>Multiple Sidebar</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        <tr>
							            <td><i class="dashicons dashicons-no"></i></td>
							            <td>Multiple Page Layout</td>
							            <td><i class="dashicons dashicons-yes"></i></td>
							        </tr>
							        
							    </tbody>
							</table>
			            </div>
			         </div>
			      </div>
			   </div>
			</div>
		</div>
	<?php
	}
} 