<?php
/*
Plugin Name:  WP Add UserMeta
Plugin URI:   yutaron.tokyo
Description:  Add Usermeta Github and Qiita
Version:      0.1
Author:       yutaron
Author URI:   yutaron.tokyo
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wporg
Domain Path:  /wp_add_usermeta
*/

class WP_Add_UserMeta {

	function __construct() {
		register_activation_hook( __FILE__, 'activate' );
		register_deactivation_hook( __FILE__, 'deactivate' );
	}

	function activate() {
		add_filter( 'user_contactmethods', 'modify_user_contact_methods' );
	}

	function deactivate() {
		add_filter( 'user_contactmethods', 'remove_usermeta_contacts' );
	}

	function add_usermeta_contacts( $user_contact ) {
		$user_contact['qiita']  = __( 'Qiita URL' );
		$user_contact['github'] = __( 'GitHub URL' );

		return $user_contact;
	}

	function remove_usermeta_contacts( $user_contact ) {
		unset( $user_contact['qiita'] );
		unset( $user_contact['github'] );

		return $user_contact;
	}

}

new WP_Add_UserMeta();