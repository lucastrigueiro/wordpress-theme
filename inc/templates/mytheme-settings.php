<h1><h1>Configurações do tema</h1></h1>
<?php settings_errors(); ?>
<?php 
	
	$picture = esc_attr( get_option( 'mytheme_profile_picture' ) );
	$firstName = esc_attr( get_option( 'mytheme_first_name' ) );
	$lastName = esc_attr( get_option( 'mytheme_last_name' ) );
	$fullName = $firstName . ' ' . $lastName;
	$description = esc_attr( get_option( 'mytheme_description' ) );
	
	$twitter_icon = esc_attr( get_option( 'mytheme_twitter' ) );
	$github_icon = esc_attr( get_option( 'mytheme_github' ) );
	$gplus_icon = esc_attr( get_option( 'mytheme_personal_page' ) );
	
?>
<div class="sunset-sidebar-preview">
	<div class="sunset-sidebar">
		<div class="image-container">
			<div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);"></div>
		</div>
		<h1 class="sunset-username"><?php print $fullName; ?></h1>
		<h2 class="sunset-description"><?php print $description; ?></h2>
		<div class="icons-wrapper">
			<?php if( !empty( $twitter_icon ) ): ?>
				<span class="sunset-icon-sidebar dashicons-before dashicons-twitter"></span>
			<?php endif; 
			if( !empty( $gplus_icon ) ): ?>
				<span class="sunset-icon-sidebar sunset-icon-sidebar--gplus dashicons-before dashicons-googleplus"></span>
			<?php endif; 
			if( !empty( $github_icon ) ): ?>
				<span class="sunset-icon-sidebar dashicons-before dashicons-facebook-alt"></span>
			<?php endif; ?>
		</div>
	</div>
</div>

<form id="submitForm" method="post" action="options.php" class="sunset-general-form">
	<?php settings_fields( 'mytheme-settings-group' ); ?>
	<?php do_settings_sections( 'mytheme_menu' ); ?>
	<?php submit_button( 'Salvar alterações', 'primary', 'btnSubmit' ); ?>
</form>