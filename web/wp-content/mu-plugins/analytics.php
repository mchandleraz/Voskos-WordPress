<?php
/*
Plugin Name: Analytics
Plugin URI: 
Description: Prints out analytics in the footer (easily modified to insert into header). Uses the 'frmwrk_footer' hook from the 'wp-frmwrk' theme.
Version: 1.0
Author: RIESTER
Author URI: http://riester.com
*/

/**
 * footer_analytics_init() 
 */
function footer_analytics_init() {

	global $options;
	$options = get_option('wpanalytics');

	/**
	 * footer_analytics()
	 * Adds analytics tracking to the footer. Prints out AFTER wp_footer().
	 * Add any additional scripts between the EOF tags.
	 */
	function print_footer_analytics() {
		global $options;

		if ( $options['wpanalytics_ga_code'] ) {

			$ga_code = $options['wpanalytics_ga_code'];

			$analytics_scripts = <<<EOF
				<script>
					var _gaq=[['_setAccount','$ga_code'],['_trackPageview']];
					(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
					g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
					s.parentNode.insertBefore(g,s)}(document,'script'));
				</script>
EOF;
			echo $analytics_scripts;

		} else {
			return;
		}
	}

	if ( function_exists( 'frmwrk_setup' ) ) {
		add_action( 'frmwrk_footer', 'print_footer_analytics' );
	} else {
		add_action( 'wp_footer', 'print_footer_analytics' );
	}

	/**
	 * check_for_ga_code()
	 * Checks if there is a ga code option set.
	 * If it's not running - display a notice in the admin area.
	 */
	function check_for_ga_code() {
		global $options;

		if ( !$options['wpanalytics_ga_code'] ) {

			function ga_admin_notice() {
				echo '<div class="updated">
					<p>' . __( 'There is no Google Analytics code set in the \'Analytics Options\' ' ) . sprintf( __( '<a href="%1$s">Add one now</a>' ), "options-general.php?page=wpanalytics" ) . '.</p>
				</div>';
			}

			add_action( 'admin_notices', 'ga_admin_notice' );
		}
	}

	add_action( 'admin_init', 'check_for_ga_code', 10 );

	/**
	 * check_for_footer_analytics()
	 * Checks to see if the print_footer_analytics() function is being fired.
	 * If it's not running - display a notice in the admin area.
	 */
	function check_for_footer_analytics() {
		if ( false == ( $priority = has_filter( 'frmwrk_footer', 'print_footer_analytics' ) || $priority = has_filter( 'wp_footer', 'print_footer_analytics' ) ) ) {

			function analytics_admin_notice() {
				echo '<div class="error">
					<p>Your <strong>print_footer_analytics()</strong> function is not being fired.<br /><strong>Double check and make sure Google Analytics is running before launching the site.</strong></p>
				</div>';
			}

			add_action( 'admin_notices', 'analytics_admin_notice' );
		}
	}

	add_action( 'admin_init', 'check_for_footer_analytics', 12 );

	// Set up the plugin.
	add_action('admin_init','wpanalytics_init');
	add_action('admin_menu','wpanalytics_add_page');

	// register settings and sanitization callback
	function wpanalytics_init() {
		register_setting('wpanalytics_options','wpanalytics','wpanalytics_validate');
	}

	// add admin page to menu
	function wpanalytics_add_page() {
		add_options_page('Options for the footer analytics plugin','Analytics Options','manage_options','wpanalytics','wpanalytics_buildpage');
	}

	// build admin page
	function wpanalytics_buildpage() {
	?>

	<div class="wrap">
		<h2>Options Page</h2>

		<div id="poststuff" class="metabox-holder has-right-sidebar">
			<div id="post-body" class="has-sidebar">

				<div id="post-body-content" class="has-sidebar-content">
					<div id="normal-sortables" class="meta-box-sortables">
						<div class="postbox">
							<div class="inside">
								
								<form method="post" action="options.php">
									<?php settings_fields('wpanalytics_options'); ?>
									<?php $options = get_option('wpanalytics'); ?>

									<table class="form-table">
										<tr valign="top">
											<th scope="row"><?php _e('Google Analytics Code:') ?></th>
											<td><input type="text" name="wpanalytics[wpanalytics_ga_code]" value="<?php echo $options['wpanalytics_ga_code']; ?>" class="regular-text" /><br />
												<?php _e('Example: <strong>UA-XXXXX-X</strong>') ?></td>
										</tr>
									</table>
									
									<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
								</form>

							</div>
						</div>
					</div>
				</div>
			
			</div>
		</div>

	</div>
	<?php
	}

	// sanitize inputs. accepts an array, return a sanitized array.
	function wpanalytics_validate($input) {
		$input['wpanalytics_ga_code'] = wp_filter_nohtml_kses($input['wpanalytics_ga_code']);
		return $input;
	}
}

add_action( 'init', 'footer_analytics_init', 0 );