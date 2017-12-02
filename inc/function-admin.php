<?php

/*

@package mytheme
	===========================
		ADMIN PAGE
	===========================
*/

function mytheme_add_admin_page(){
	// Menu principal
	add_menu_page('Opções do tema', wp_get_theme(), 'manage_options', 'mytheme_menu', 'mytheme_settings_func', 'dashicons-admin-site', 110);

	// Submenu 1 (substitui o submenu do menu principal)
	//add_submenu_page( string $parent_slug, string $page_title, string $menu_title,string $ capability, string $menu_slug, callable $function = '' )
	add_submenu_page('mytheme_menu', 'Opções do tema', 'Configurações', 'manage_options', 'mytheme_menu', 'mytheme_settings_func');
	// Submenu 2
	add_submenu_page('mytheme_menu', 'Mytheme Custom CSS', 'CSS Pesonalizado', 'manage_options', 'mytheme_menu_customcss_page', 'mytheme_customcss_func');

}
add_action( 'admin_menu', 'mytheme_add_admin_page');



function mytheme_settings_func(){
	require_once( get_template_directory() . '/inc/templates/mytheme-settings.php');
}
function mytheme_customcss_func(){
	require_once( get_template_directory() . '/inc/templates/mytheme-customcss.php');
}


//Ativa os campos (custom settings) das paginas
add_action('admin_init',function() {

	//adiciona a secao
	// section_id -- Titulo da secao -- funcao_calback -- pagina
	add_settings_section( 'mytheme-menu-section', 'Dados pessoais', 'mytheme_menu_section1', 'mytheme_menu' );

	//adiciona um campo
	// id -- title -- callback -- where to show/page -- section
 	add_settings_field( 'mytheme_profile_picture', 'Foto do perfil', 'mytheme_profile_picture_display', 'mytheme_menu', 'mytheme-menu-section' );
 	add_settings_field( 'mytheme_name', 'Nome completo', 'mytheme_menu_nome_display', 'mytheme_menu', 'mytheme-menu-section' );
 	add_settings_field( 'mytheme_description', 'Descrição', 'mytheme_menu_description_display', 'mytheme_menu', 'mytheme-menu-section' );
 	add_settings_field( 'mytheme_twitter', 'Twitter', 'mytheme_menu_twitter_display', 'mytheme_menu', 'mytheme-menu-section' );
 	add_settings_field( 'mytheme_github', 'Github', 'mytheme_menu_github_display', 'mytheme_menu', 'mytheme-menu-section' );
 	add_settings_field( 'mytheme_personal_page', 'Página pessoal', 'mytheme_menu_personal_page_display', 'mytheme_menu', 'mytheme-menu-section' );
 	
 	//adiciona um registrador no banco
 	// option_group_id -- option_name -- sanitize_function
 	register_setting( 'mytheme-settings-group', 'mytheme_profile_picture' );
 	register_setting( 'mytheme-settings-group', 'mytheme_first_name', 'sanitize_text_field' );
 	register_setting( 'mytheme-settings-group', 'mytheme_last_name', 'sanitize_text_field' );
 	register_setting( 'mytheme-settings-group', 'mytheme_description', 'sanitize_text_field' );
 	register_setting( 'mytheme-settings-group', 'mytheme_twitter', 'mytheme_sanitize_twitter' );
 	register_setting( 'mytheme-settings-group', 'mytheme_github', 'sanitize_text_field' );
 	register_setting( 'mytheme-settings-group', 'mytheme_personal_page', 'sanitize_text_field' );
 
});

function mytheme_menu_section1() {
	echo 'Personalize a exibição de seus dados';
}




function mytheme_profile_picture_display(){
	//Função realizada no arquivo mytheme.admin.js
	$profile_picture = esc_attr( get_option( 'mytheme_profile_picture' ) );
	echo '<input type="button" class="button button-secondary" value="Upload" id="upload-button">
	<input type="hidden" name="mytheme_profile_picture" id="profile-picture" value="'.$profile_picture.'">';
}
function mytheme_menu_nome_display(){
	$firstName = esc_attr( get_option( 'mytheme_first_name' ) );
	$lastName = esc_attr( get_option( 'mytheme_last_name' ) );
	echo '<input type="text" name="mytheme_first_name" id="mytheme_first_name" value="'.$firstName.'" placeholder="Nome">
	<input type="text" name="mytheme_last_name" id="mytheme_last_name" value="'.$lastName.'" placeholder="Sobrenome">';
}
function mytheme_menu_description_display(){
	$mytheme_description = esc_attr( get_option( 'mytheme_description' ) );
	echo '<input type="text" name="mytheme_description" id="mytheme_description" value="'.$mytheme_description.'" placeholder="Descrição">
	<p class="description">Escreva algo inteligente.</p>';
}
function mytheme_menu_twitter_display(){
	$mytheme_twitter = esc_attr( get_option( 'mytheme_twitter' ) );
	echo '<input type="text" name="mytheme_twitter" id="mytheme_twitter" value="'.$mytheme_twitter.'" placeholder="Twitter">
	<p class="description">Insira seu usuário Twitter sem o @.</p>';
}
function mytheme_menu_github_display(){
	$mytheme_github = esc_attr( get_option( 'mytheme_github' ) );
	echo '<input type="text" name="mytheme_github" id="mytheme_github" value="'.$mytheme_github.'" placeholder="Github">';
}
function mytheme_menu_personal_page_display(){
	$mytheme_personal_page = esc_attr( get_option( 'mytheme_personal_page' ) );
	echo '<input type="text" name="mytheme_personal_page" id="mytheme_personal_page" value="'.$mytheme_personal_page.'" placeholder="Página pessoal">';
}



function mytheme_sanitize_twitter( $input ){
 	$output = sanitize_text_field( $input );
 	$output = str_replace('@', '', $output);
 	return $output;
}