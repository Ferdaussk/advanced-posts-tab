<?php
namespace Creativepostfilterable;

use Creativepostfilterable\PageSettings\Page_Settings;
define( "BPOSTFG_ASFSK_ASSETS_PUBLIC_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/public" );
define( "BPOSTFG_ASFSK_ASSETS_ADMIN_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/admin" );
class ClassBWDPostFGfilterable {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function apostst_admin_editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'apostst_admin_editor_scripts_as_a_module' ], 10, 2 );
	}

	public function apostst_admin_editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'apostst_the_filterable_editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/apostst-filterable-main.php' );
	}

	public function apostst_register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\BWDPostFGfilterable() );
	}

	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/creative-filterable-manager.php' );
		new Page_Settings();
	}

	// Register Category
	function apostst_add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'advanced-posts-tab-category',
			[
				'title' => esc_html__( 'Advanced Posts Tab', 'advanced-posts-tab' ),
				'icon' => 'eicon-person',
			]
		);
	}
	public function apostst_all_assets_for_the_public(){
		$all_css_js_file = array(
			'apostst-filterable-bootstrap-style' => array('apostst_path_define'=>BPOSTFG_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/css/bootstrap.min.css'),
			'apostst-filterable-font-awesome-style' => array('apostst_path_define'=>BPOSTFG_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/css/plugins/font-awesome/css/all.min.css'),
			'apostst-filterable-style-style' => array('apostst_path_define'=>BPOSTFG_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/css/style.css'),

			'apostst-filterable-bootstrap-script' => array('apostst_path_define'=>BPOSTFG_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/js/bootstrap.bundle.min.js'),
			'apostst-filterable-main-script' => array('apostst_path_define'=>BPOSTFG_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/js/main.js'),
			'apostst-filterable-load-more-script' => array('apostst_path_define'=>BPOSTFG_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/js/load-more.js'),
		);
		foreach($all_css_js_file as $handle => $fileinfo){
			wp_enqueue_style( $handle, $fileinfo['apostst_path_define'], null, '1.0', 'all');
			wp_enqueue_script( $handle, $fileinfo['apostst_path_define'], ['jquery'], '1.0', true);
		}
	}
	public function apostst_all_assets_for_elementor_editor_admin(){
		$all_css_js_file = array(
            'apostst_filterable_admin_icon_css' => array('apostst_path_admin_define'=>BPOSTFG_ASFSK_ASSETS_ADMIN_DIR_FILE . '/icon.css'),
        );
        foreach($all_css_js_file as $handle => $fileinfo){
            wp_enqueue_style( $handle, $fileinfo['apostst_path_admin_define'], null, '1.0', 'all');
        }
	}

	public function __construct() {
		// For public assets
		add_action('wp_enqueue_scripts', [$this, 'apostst_all_assets_for_the_public']);

		// For Elementor Editor
		add_action('elementor/editor/before_enqueue_scripts', [$this, 'apostst_all_assets_for_elementor_editor_admin']);
		
		// Register Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'apostst_add_elementor_widget_categories' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'apostst_register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'apostst_admin_editor_scripts' ] );
		
		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
ClassBWDPostFGfilterable::instance();