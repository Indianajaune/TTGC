<?php

add_action('admin_menu', 'magazine_news_admin_menu');

function magazine_news_admin_menu() {

global $magazinenews_settings_page;

   $magazinenews_settings_page = add_theme_page('Seos Blue', 'Premium Theme ', 'edit_theme_options',  'my-unique-identifier', 'seos_blue_settings_page');

	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {

}

function seos_blue_settings_page() {
?>
<div class="wrap">

	<form class="theme-options" method="post" action="options.php" accept-charset="ISO-8859-1">
		<?php settings_fields( 'seos-settings-group' ); ?>
		<?php do_settings_sections( 'seos-settings-group' ); ?>
		
		<div class="seos-blue">
			<a target="_blank" href="http://seosthemes.info/seos-blue-free-wordpress-theme/">
				<div class="btn s-red">
					 <?php _e('Buy', 'seos-blue'); ?> <img class="ss-logo" src="<?php echo get_template_directory_uri() . '/img/logo.png'; ?>"/><?php _e(' Now', 'seos-blue'); ?>
				</div>
			</a>
		</div>
		
		<div class="cb-center">	
			<img class="sb-demo" src="<?php echo get_template_directory_uri() . '/img/seos-blue-options.jpg'; ?>"/>			
		</div>
		
	</form>
	
</div>
<?php } ?>