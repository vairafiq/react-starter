<?php
/**
 * ReactStarter
 *
 * @package           ReactStarter
 * @author            Exlac
 * @copyright         2022 Exlac
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       React Stater
 * Plugin URI:        https://github.com/vairafiq/react-starter
 * Description:       React Starter plugin to develop basic app
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Exlac
 * Author URI:        https://exlac.com
 * Text Domain:       react-starter
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://github.com/vairafiq/react-starter
 */

if( ! defined( 'ABSPATH' ) ) {
    wp_die( 'Be human!' );
}

class Rafiq_React_Starter {
	/**
	*  Instantiator
	*/

	public static function get_instance() {
		static $instance = null;
		if ( null === $instance ) {
			$instance = new self();
			$instance->init();
		}
		return $instance;
	}
	
	/**
	 * Construct and initialize the main plugin class
	 */
	
	public function __construct() {}
	
	function init() {

        add_action( 'admin_menu', array( self::class, 'register_admin_menu' ) );
        add_action( 'admin_enqueue_scripts', array( self::class, 'add_assets' ) );
    }

    public function add_assets( $screen ) {
        wp_register_script( 'rrs_admin_js_assets',  plugins_url( basename( plugin_dir_path( __FILE__ ) ) ) . '/assets/js/main.js', array( 'jquery' ), time(), true );
        wp_register_style( 'rrs_admin_css_assets',  plugins_url( basename( plugin_dir_path( __FILE__ ) ) ) . '/assets/css/main.css', array() );

        if ( 'toplevel_page_react-starter' === $screen ) {
            wp_enqueue_script( 'rrs_admin_assets' );
            wp_enqueue_style( 'rrs_admin_css_assets' );
        }
    }

    public function register_admin_menu() {
        add_menu_page( 'React Starter', 'React Starter', 'manage_options', 'react-starter', array( self::class, 'menu_page' ) );
    }

    public function menu_page() {
        echo 'Hello React!';
    }

}

Rafiq_React_Starter::get_instance();

