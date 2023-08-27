<?php
/**
 * Plugin Name: Advanced Posts Tab
 * Description: Advanced Posts Tab plugin with 30+ types of Filterable Gallery also responsive gallery for Elementor.
 * Plugin URI:  https://bwdplugins.com/bwd-filterable-gallery
 * Version:     1.0
 * Author:      Best WP Developer
 * Author URI:  https://bestwpdeveloper.com/
 * Text Domain: advanced-posts-tab
 * Elementor tested up to: 3.0.0
 * Elementor Pro tested up to: 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once ( plugin_dir_path(__FILE__) ) . '/includes/plugin-activation-notice.php';
final class FinalBPOSTFGFilterable{

	const VERSION = '1.0';

	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {
		// Load translation
		add_action( 'apostst_init', array( $this, 'apostst_loaded_textdomain' ) );
		// apostst_init Plugin
		add_action( 'plugins_loaded', array( $this, 'apostst_init' ) );
	}

	public function apostst_loaded_textdomain() {
		load_plugin_textdomain( 'advanced-posts-tab', false, basename(dirname(__FILE__)).'/languages' );
	}

	public function apostst_init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', 'apostst_addon_failed_load' );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'apostst_admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'apostst_admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'apostst_boots.php' );
	}

	public function apostst_admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'advanced-posts-tab' ),
			'<strong>' . esc_html__( 'Advanced Posts Tab', 'advanced-posts-tab' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'advanced-posts-tab' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'advanced-posts-tab') . '</p></div>', $message );
	}
}

// Instantiate advanced-posts-tab.
new FinalBPOSTFGFilterable();
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );