<?php
/**
* Plugin Name: Related Post
* Plugin URI: https://www.sonoracreativa.com
* Description: Plugin personalizado para sonoracreativa.com
* Version: 1.0  
* Author: David Conde
* Author URI: https://twitter.com/DavidCondence
*/ 
if ( ! defined( 'ABSPATH' ) ) {
	die();
}
$sonoracreativa = new Condence_RelatedPost;
class Condence_RelatedPost {
	public static $version = '1.0';

	public function __construct() {
		add_action( 'plugins_loaded', array( __CLASS__, 'text_domain' ), 10, 0 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_css' ), 99, 0 );
		add_action( 'admin_menu',  array( __CLASS__, 'menu' ) );
		add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( __CLASS__, 'add_action_links' ) );
	}

	public static function text_domain() {
		load_plugin_textdomain( 'related-post-condence', false, untrailingslashit( dirname( __FILE__ ) ) . '/languages' );
	}

	public static function load_css() {
		$css_url = apply_filters( 'related-post-condence_css', plugins_url( 'related-post-condence' ) . '/assets/css/admin.css' );
		wp_enqueue_style( 'related-post-condence', $css_url, array(), self::$version );
	}
	public static function menu(){
		global $submenu;
		add_menu_page( 
	        __('Related Post' , 'related-post-condence'),
	        __('Related Post' , 'related-post-condence'),
	        'manage_options',
	        'Condence_RelatedPost',
	        array( __CLASS__, 'sonoracreativa_mailchimp'),
	        plugins_url( 'related-post-condence' ).'/images/post-it.png' ,
	        6
	    ); 
		add_submenu_page( 
			'Condence_RelatedPost',
			__('Examples' , 'related-post-condence'),
			__('Examples' , 'related-post-condence'),
			'manage_options', 
			'Condence_RelatedPost_Examples', 
			array( __CLASS__, 'sonoracreativa_mailchimp') 
		);
	} 
	public static function add_action_links ( $links ) {
		$links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=Condence_RelatedPost') ) .'">'.__('Settings' , 'related-post-condence').'</a>';
   		$links[] = '<a href="#" target="_blank">SonoraCreativa.com</a>';
		return $links;
	}
	public static function sonoracreativa_content(){
		global $post_type_object;
		?>
		<div class="sonoracreativa_content">
			ddd
		</div>
		<?php
	}
	public static function sonoracreativa_mailchimp(){
		global $post_type_object;
		?>
		<div class="wrap">
			<h2><?php echo __('Related Post' , 'sonoracreativa'); ?></h2>
		</div> 
		<?php
	} 
}