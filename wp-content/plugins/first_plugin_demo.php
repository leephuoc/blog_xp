<?php 
/**
 * Template Name: 
 * Plugin URI: http://localhost
 *  
 */
?>

<?php
	function register_mysettings() {
		register_setting('mfpd-settings-group', 'mfpd_option_name');
	}

	function mfpd_create_menu() {
		add_menu_page('My first Plugin Settings', 
			'MFPD Settings', 
			'administrator', 
			__FILE__,
			'mfpd_settings_page',
			plugins_url('/images/icon.png')
		);
		add_action('admin_init', 'register_mysettings');
	}
	add_action('action_menu', 'mfpd_create_menu');

	function mfpd_setting_pages() {  ?>
		<div class="wrap">
		<h2>Create setting page for plugin</h2>
		<?php if(isset($_GET['settings_updated'])) { ?>
 			<div id="message" clas="updated">
				<p><strong><?php _e('Settings saved') ?></strong></p>
			</div>
		<?php } ?>
		<form method="post" action="options.php">
			<?php settings_fields('mfpd-settings-group'); ?>
		</form>
	<?php }