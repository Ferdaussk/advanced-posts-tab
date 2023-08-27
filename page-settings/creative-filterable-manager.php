<?php
namespace Creativepostfilterable\PageSettings;

use Elementor\Controls_Manager;
use Elementor\Core\DocumentTypes\PageBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Page_Settings {

	const PANEL_TAB = 'new-tab';

	public function __construct() {
		add_action( 'elementor/init', [ $this, 'apostst_filterable_add_panel_tab' ] );
		add_action( 'elementor/documents/register_controls', [ $this, 'apostst_filterable_register_document_controls' ] );
	}

	public function apostst_filterable_add_panel_tab() {
		Controls_Manager::add_tab( self::PANEL_TAB, esc_html__( 'Advanced Posts Tab', 'advanced-posts-tab' ) );
	}

	public function apostst_filterable_register_document_controls( $document ) {
		if ( ! $document instanceof PageBase || ! $document::get_property( 'has_elements' ) ) {
			return;
		}

		$document->start_controls_section(
			'apostst_filterable_new_section',
			[
				'label' => esc_html__( 'Settings', 'advanced-posts-tab' ),
				'tab' => self::PANEL_TAB,
			]
		);

		$document->add_control(
			'apostst_filterable_text',
			[
				'label' => esc_html__( 'Title', 'advanced-posts-tab' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'advanced-posts-tab' ),
			]
		);

		$document->end_controls_section();
	}
}
