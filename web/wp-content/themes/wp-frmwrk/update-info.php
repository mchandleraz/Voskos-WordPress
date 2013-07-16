<?php
/**
 * Template Name: Theme Update - JSON
 *
 * @package WordPress
 * @subpackage frmwrk
 */

the_post();

header('Content-Type: application/json');
?>

{
	"version" : "<?php echo FRMWRK_VERSION; ?>",
	"details_url" : "<?php echo get_site_url(); ?>/<?php echo FRMWRK_DIR_NAME; ?>/details",
	"download_url" : "<?php echo get_template_directory_uri(); ?>/<?php echo FRMWRK_DIR_NAME; ?>.zip"
}