<?php
namespace Creativepostfilterable\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BWDPostFGfilterable extends Widget_Base {

	public function get_name() {
		return esc_html__( 'AdvancedPostsTab', 'advanced-posts-tab' );
	}

	public function get_title() {
		return esc_html__( 'Advanced Posts Tab', 'advanced-posts-tab' );
	}

	public function get_icon() {
		return 'apostst-filterable-icon eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'advanced-posts-tab-category' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'apostst_filterable_content_basic_presets',
			[
				'label' => esc_html__( 'Presets', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'apostst_style_selection',
			[
				'label' => esc_html__( 'Styles', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__( 'Style 1', 'advanced-posts-tab' ),
					'style2' => esc_html__( 'Style 2', 'advanced-posts-tab' ),
					'style3' => esc_html__( 'Style 3 Masking', 'advanced-posts-tab' ),
					'style4' => esc_html__( 'Style 4 Masking', 'advanced-posts-tab' ),
					'style5' => esc_html__( 'Style 5 Masking', 'advanced-posts-tab' ),
					'style6' => esc_html__( 'Style 6 Masking', 'advanced-posts-tab' ),
					'style7' => esc_html__( 'Style 7 Masking', 'advanced-posts-tab' ),
					'style8' => esc_html__( 'Style 8 Masking', 'advanced-posts-tab' ),
					'style9' => esc_html__( 'Style 9 Masking', 'advanced-posts-tab' ),
					'style10' => esc_html__( 'Style 10 Masking', 'advanced-posts-tab' ),
					'style11' => esc_html__( 'Style 11 Masking', 'advanced-posts-tab' ),
					'style12' => esc_html__( 'Style 12 Masking', 'advanced-posts-tab' ),
					'style13' => esc_html__( 'Style 13', 'advanced-posts-tab' ),
					'style14' => esc_html__( 'Style 14', 'advanced-posts-tab' ),
					'style15' => esc_html__( 'Style 15', 'advanced-posts-tab' ),
					'style16' => esc_html__( 'Style 16', 'advanced-posts-tab' ),
					'style17' => esc_html__( 'Style 17', 'advanced-posts-tab' ),
					'style18' => esc_html__( 'Style 18', 'advanced-posts-tab' ),
					'style19' => esc_html__( 'Style 19', 'advanced-posts-tab' ),
					'style20' => esc_html__( 'Style 20', 'advanced-posts-tab' ),
					'style21' => esc_html__( 'Style 21', 'advanced-posts-tab' ),
					'style22' => esc_html__( 'Style 22', 'advanced-posts-tab' ),
					'style23' => esc_html__( 'Style 23', 'advanced-posts-tab' ),
					'style24' => esc_html__( 'Style 24', 'advanced-posts-tab' ),
					'style25' => esc_html__( 'Style 25', 'advanced-posts-tab' ),
					'style26' => esc_html__( 'Style 26', 'advanced-posts-tab' ),
					'style27' => esc_html__( 'Style 27', 'advanced-posts-tab' ),
					'style28' => esc_html__( 'Style 28', 'advanced-posts-tab' ),
					'style29' => esc_html__( 'Style 29', 'advanced-posts-tab' ),
					'style30' => esc_html__( 'Style 30', 'advanced-posts-tab' ),
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_filterable_content_section',
			[
				'label' => esc_html__( 'Category Items', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'apostst_filterable_all_enable_filter' => 'yes',
				]
			]
		);
		$this->add_control(
			'apostst_filterable_all_item',
			[
				'label' => esc_html__( 'All Item', 'advanced-posts-tab' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('All', 'advanced-posts-tab'),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'apostst_the_cat_type_se',
			[
				'label' => esc_html__( 'Cat Text Type', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'dynamic',
				'options' => [
					'text' => esc_html__( 'Custom Text', 'advanced-posts-tab' ),
					'dynamic' => esc_html__( 'Dynamic Text', 'advanced-posts-tab' ),
				],
			]
		);
		$repeater->add_control(
			'apostst_filterable_text_type',
			[
				'label' => esc_html__( 'Text', 'advanced-posts-tab' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Filterable', 'advanced-posts-tab'),
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'apostst_the_cat_type_se' => 'text'
				],
				'label_block' => true,
			]
		);
		// For Category Filter
		$apostst_idObj = get_category_by_slug('category-slug');
		$apostst_order_options = array($apostst_idObj => 'All Categories');
		$apostst_categories = get_categories('orderby=name&hide_empty=0');
		foreach ($apostst_categories as $category):
			$apostst_catids = $category->slug;
			$apostst_catname = $category->name;
			$apostst_order_options[$apostst_catids] = $apostst_catname;
		endforeach;
		$repeater->add_control(
			'apostst_the_cat_columnsdd',
			[
				'label' => esc_html__( 'Select Category', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SELECT,
				'default' => esc_html__( 'Select Category'),
				'options' => $apostst_order_options,
			]
		);
		$this->add_control(
			'apostst_total_box',
			[
				'label' => esc_html__( 'Category Items', 'advanced-posts-tab' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'apostst_total_box_title' => esc_html__( 'Category Item #1', 'advanced-posts-tab' ),
					],
					[
						'apostst_total_box_title' => esc_html__( 'Category Item #2', 'advanced-posts-tab' ),
					],
					[
						'apostst_total_box_title' => esc_html__( 'Category Item #3', 'advanced-posts-tab' ),
					],
					[
						'apostst_total_box_title' => esc_html__( 'Category Item #4', 'advanced-posts-tab' ),
					],
				],
				'title_field' => `{{{ apostst_total_box_title }}}`,
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_filterable_content_basic_query',
			[
				'label' => esc_html__( 'Query', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'apostst_the_post_per_page',
			[
				'label' => esc_html__( 'Post Per Item', 'advanced-posts-tab' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
				'placeholder' => esc_html__( '00', 'advanced-posts-tab' ),
			]
		);
		$this->add_control(
			'apostst_blog_pst_exclude',
			[
				'label' => esc_html__( 'Exclude', 'advanced-posts-tab' ),
				'type' => Controls_Manager::TEXT,
				'description' => '<span class="pro-feature">Exclude post using post ID and separate with using comma. <strong>(Ex:- 10,11,12)</strong>.</span>',
			]
		);
		$this->add_control(
			'apostst_the_order_by',
			[
				'label' => esc_html__( 'Order By', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all' => esc_html__( 'All', 'advanced-posts-tab' ),
					'author' => esc_html__( 'Author', 'advanced-posts-tab' ),
					'title' => esc_html__( 'Title', 'advanced-posts-tab' ),
					'id' => esc_html__( 'ID', 'advanced-posts-tab' ),
					'date' => esc_html__( 'Date', 'advanced-posts-tab' ),
				],
			]
		);
		$this->add_responsive_control(
			'apostst_blog_order',
			[
				'label' => esc_html__( 'Order', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => esc_html__( 'Descending', 'advanced-posts-tab' ),
					'ASC' => esc_html__( 'Ascending', 'advanced-posts-tab' ),
				],
			]
		);
		// For Author Filter
		$apostst_array = get_users();
		foreach ($apostst_array as $apostst_author){
			$apostst_id = $apostst_author->ID;
			$apostst_name = $apostst_author->display_name;
			$apostst_get_array[$apostst_id] = $apostst_name;
		}
		$this->add_control(
			'apostst_the_all_author',
			[
				'label' => esc_html__( 'Choose Author', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SELECT,
				'options' => ['' => esc_html__( 'All Author')]+$apostst_get_array,
			]
		);
		$this->add_control(
			'apostst_categories_show_switcher',
			[
				'label' => esc_html__( 'Category', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'advanced-posts-tab' ),
				'label_off' => esc_html__( 'Hide', 'advanced-posts-tab' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'apostst_the_cat_show_status',
			[
				'label' => esc_html__( 'Show Status', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'show_main_cat',
				'options' => [
					'show_multiple_cat' => esc_html__( 'Show Multiple Category', 'advanced-posts-tab' ),
					'show_main_cat' => esc_html__( 'Show Main Category', 'advanced-posts-tab' ),
				],
				'condition' => [
					'apostst_categories_show_switcher' => 'yes',
				],
			]
		);
		$this->add_control(
			'apostst_tags_show_switcher',
			[
				'label' => esc_html__( 'Tag', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'advanced-posts-tab' ),
				'label_off' => esc_html__( 'Hide', 'advanced-posts-tab' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_filterable_content_basic_settings',
			[
				'label' => esc_html__( 'Settings', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'apostst_filterable_all_enable_filter',
			[
				'label' => __( 'Show Filter', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'advanced-posts-tab' ),
				'label_off' => __( 'Hide', 'advanced-posts-tab' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'apostst_title_show_switcher',
			[
				'label' => esc_html__( 'Title', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'advanced-posts-tab' ),
				'label_off' => esc_html__( 'Hide', 'advanced-posts-tab' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'apostst_title_link_show_switcher',
			[
				'label' => esc_html__( 'Title Link', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'advanced-posts-tab' ),
				'label_off' => esc_html__( 'Hide', 'advanced-posts-tab' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'apostst_title_show_switcher' => 'yes',
				],
			]
		);
		$this->add_control(
			'apostst_title_tags',
			[
				'label' => esc_html__( 'Title HTML Tag', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'div'  => esc_html__( 'Div', 'advanced-posts-tab' ),
					'h1' => esc_html__( 'H1', 'advanced-posts-tab' ),
					'h2' => esc_html__( 'H2', 'advanced-posts-tab' ),
					'h3' => esc_html__( 'H3', 'advanced-posts-tab' ),
					'h4' => esc_html__( 'H4', 'advanced-posts-tab' ),
					'h5' => esc_html__( 'H5', 'advanced-posts-tab' ),
					'h6' => esc_html__( 'H6', 'advanced-posts-tab' ),
					'p' => esc_html__( 'p', 'advanced-posts-tab' ),
				],
			]
		);
		$this->add_control(
			'apostst_comments_show_switcher',
			[
				'label' => esc_html__( 'Comment', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'advanced-posts-tab' ),
				'label_off' => esc_html__( 'Hide', 'advanced-posts-tab' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'apostst_description_show_switcher',
			[
				'label' => esc_html__( 'Description', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'advanced-posts-tab' ),
				'label_off' => esc_html__( 'Hide', 'advanced-posts-tab' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_responsive_control(
			'apostst_the_post_description_words',
			[
				'label' => esc_html__( 'Word Length', 'advanced-posts-tab' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
				'condition' => [
					'apostst_description_show_switcher' => 'yes',
				],
			]
		);
		$this->add_control(
			'apostst_blog_word_trim_indi',
			[
				'label' => esc_html__( 'Word Trim Indicator', 'advanced-posts-tab' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '...', 'advanced-posts-tab' ),
				'label_block' => true,
				'condition' => [
					'apostst_description_show_switcher' => 'yes',
				],
			]
		);
		$this->add_control(
			'apostst_taxo_icon',
			[
				'label' => esc_html__( 'All Taxo Icons', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'before',
				'default' => 'show',
				'options' => [
					'none' => esc_html__( 'None', 'advanced-posts-tab' ),
					'show' => esc_html__( 'Show', 'advanced-posts-tab' ),
				],
			]
		);
		$this->add_control(
			'apostst_date_show_switcher',
			[
				'label' => esc_html__( 'Publish Date', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'advanced-posts-tab' ),
				'label_off' => esc_html__( 'Hide', 'advanced-posts-tab' ),
				'separator' => 'before',
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'apostst_blog_date_format',
			[
				'label' => esc_html__( 'Date Format', 'advanced-posts-tab' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'j M y', 'advanced-posts-tab' ),
				'placeholder' => esc_html__( 'j M y', 'advanced-posts-tab' ),
				'label_block' => true,
				'condition' => [
					'apostst_date_show_switcher' => 'yes',
				],
				'description' => '<span class="pro-feature">Use WordPress date format. <a href="https://wordpress.org/support/article/formatting-date-and-time/" target="_blank">More...</a></span>',
			]
		);
		$this->add_control(
			'apostst_author_show_switcher',
			[
				'label' => esc_html__( 'Author', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'advanced-posts-tab' ),
				'label_off' => esc_html__( 'Hide', 'advanced-posts-tab' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'apostst_author_indicator',
			[
				'label' => esc_html__( 'Author Indicator', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'gravatar' => esc_html__( 'Gravatar', 'advanced-posts-tab' ),
					'icon' => esc_html__( 'Author Icon', 'advanced-posts-tab' ),
				],
				'condition' => [
					'apostst_author_show_switcher' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'apostst_blog_gravader_height',
			[
				'label' => esc_html__( 'Gravader Size', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .apostst_author-img img' => 'height: {{SIZE}}{{UNIT}} !important; width: {{SIZE}}{{UNIT}} !important;',
				],
				'condition' => [
					'apostst_author_show_switcher' => 'yes',
					'apostst_author_indicator' => 'gravatar',
				],
			]
		);
		$this->add_control(
			'apostst_author_icon',
			[
				'label' => esc_html__( 'Icon', 'advanced-posts-tab' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-user-alt',
					'library' => 'solid',
				],
				'condition' => [
					'apostst_author_show_switcher' => 'yes',
					'apostst_author_indicator' => 'icon',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_gallery_item_style_section',
			[
				'label' => esc_html__( 'Category Items', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'apostst_filterable_all_items_align',
			[
				'label' => esc_html__( 'Items Alignment', 'advanced-posts-tab' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'advanced-posts-tab' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'advanced-posts-tab' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'advanced-posts-tab' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .apostst-my-commonsk-class' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'apostst_filterable_gap',
			[
				'label' => esc_html__( 'Item Gap', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .apostst-my-commonsk-class' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apostst_filterable_item_spacing',
			[
				'label' => esc_html__( 'Item Bottom Spacing', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .apostst-my-commonsk-class' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// Hover
		$this->start_controls_tabs(
			'apostst_filterable_all_item_title_style_tabsxs'
		);

		$this->start_controls_tab(
			'apostst_filterable_all_item_title_style_normal_tabxx',
			[
				'label' => esc_html__( 'Normal', 'advanced-posts-tab' ),
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_filterable_all_item_typography',
				'selector' => '{{WRAPPER}} .apostst-menu-item',
			]
		);
		$this->add_control(
			'apostst_filterable_all_item_content_quote_right_color',
			[
				'label' => esc_html__( 'Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-menu-item' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'apostst_filterable_all_item_div_hoveraaaa_sssssbackground',
				'label' => esc_html__( 'Background Type', 'advanced-posts-tab' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .apostst-menu-item',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'apostst_filterable_item_border',
				'selector' => '{{WRAPPER}} .apostst-menu-item',
			]
		);
		$this->add_responsive_control(
			'apostst_filterable_all_item_hover_border_radius',
			[
				'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem', 'vh', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'apostst_filterable_all_item_box_shadow',
				'selector' => '{{WRAPPER}} .apostst-menu-item',
			]
		);
		$this->add_responsive_control(
			'apostst_filterable_all_item_hover_padding',
			[
				'label' => esc_html__('Padding', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem', 'vh', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apostst_filterable_all_item_hover_margin',
			[
				'label' => esc_html__('Margin', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem', 'vh', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'apostst_filterable_all_item_title_style_active_tab',
			[
				'label' => esc_html__( 'Active', 'advanced-posts-tab' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_filterable_all_item_active_typography',
				'selector' => '{{WRAPPER}} .apostst-menu-item.active',
			]
		);
		$this->add_control(
			'apostst_filterable_all_item_content_active_right_colorss',
			[
				'label' => esc_html__( 'Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-menu-item.active' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'apostst_filterable_item_active_border',
				'selector' => '{{WRAPPER}} .apostst-menu-item.active',
			]
		);
		$this->add_responsive_control(
			'apostst_filterable_all_item_active_border_radius',
			[
				'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem', 'vh', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-menu-item.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'apostst_filterable_all_item_div_hover_active_background',
				'label' => esc_html__( 'Background Type', 'advanced-posts-tab' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .apostst-menu-item.active',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'apostst_filterable_all_item_title_style_hover_tabaa',
			[
				'label' => esc_html__( 'Hover', 'advanced-posts-tab' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_filterable_all_item_hover_typography',
				'selector' => '{{WRAPPER}} .apostst-menu-item:hover',
			]
		);
		$this->add_control(
			'apostst_filterable_all_item_content_quote_right_colorss',
			[
				'label' => esc_html__( 'Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-menu-item:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'apostst_filterable_all_item_div_hoveraaaa_background',
				'label' => esc_html__( 'Background Type', 'advanced-posts-tab' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .apostst-menu-item:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'apostst_filterable_item_hover_border',
				'selector' => '{{WRAPPER}} .apostst-menu-item:hover',
			]
		);
		$this->add_responsive_control(
			'apostst_filterable_item_hover_border_radius',
			[
				'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem', 'vh', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-menu-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// Hover end
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_blog_title_options',
			[
				'label' => esc_html__( 'Title', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'apostst_title_show_switcher' => 'yes',
				],
			]
		);
		// Hover control start for title
		$this->start_controls_tabs(
			'apostst_blog_title_style_post'
		);
		$this->start_controls_tab(
			'apostst_blog_title_normal_post',
			[
				'label' => esc_html__( 'Normal', 'advanced-posts-tab' ),
			]
		);
		// Normal Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_title_typography',
				'selector' => '{{WRAPPER}} .apostst-title .apostst-h2-title',
			]
		);
		$this->add_control(
			'apostst_blog_title_color',
			[
				'label' => esc_html__( 'Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-title .apostst-h2-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_title_bg_color',
			[
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-title .apostst-h2-title' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'apostst_blog_title_border',
				'label' => esc_html__( 'Border', 'advanced-posts-tab' ),
				'selector' => '{{WRAPPER}} .apostst-gallery-wrapper .apostst-title .apostst-h2-title',
			]
		);
		$this->add_responsive_control(
			'apostst_blog_title_bg_border_radius',
			[
				'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper .apostst-title .apostst-h2-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'apostst_blog_title_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'advanced-posts-tab' ),
			]
		);
		// Hover Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_title_hover_typography',
				'selector' => '{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-title .apostst-h2-title',
			]
		);
		$this->add_control(
			'apostst_blog_title_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-title .apostst-h2-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_title_hover_bg_color',
			[
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-title .apostst-h2-title' => 'background-image: linear-gradient(to bottom,{{VALUE}} 0%,{{VALUE}} 98%)',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'apostst_blog_title_hover_border',
				'label' => esc_html__( 'Border', 'advanced-posts-tab' ),
				'selector' => '{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-title .apostst-h2-title',
			]
		);
		$this->add_responsive_control(
			'apostst_blog_title_hover_bg_border_radius',
			[
				'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-title .apostst-h2-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// Hover Control End

		$this->add_responsive_control(
			'apostst_blog_title_padding',
			[
				'label' => esc_html__('Padding', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-title .apostst-h2-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apostst_blog_title_margin',
			[
				'label' => esc_html__('Margin', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-title .apostst-h2-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_blog_description_options',
			[
				'label' => esc_html__( 'Description', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'apostst_description_show_switcher' => 'yes'
				],
			]
		);
		// Hover control start for description
		$this->start_controls_tabs(
			'apostst_blog_description_style_post'
		);
		$this->start_controls_tab(
			'apostst_blog_description_normal_post',
			[
				'label' => esc_html__( 'Normal', 'advanced-posts-tab' ),
			]
		);
		// Normal Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_description_typography',
				'selector' => '{{WRAPPER}} .apostst-desc p',
			]
		);
		$this->add_control(
			'apostst_blog_description_color',
			[
				'label' => esc_html__( 'Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-desc p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_description_bg_color',
			[
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-desc p' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'apostst_blog_description_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'advanced-posts-tab' ),
			]
		);
		// Hover Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_description_hover_typography',
				'selector' => '{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-desc p',
			]
		);
		$this->add_control(
			'apostst_blog_description_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-desc p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_description_hover_bg_color',
			[
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-desc p' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// Hover Control End
		
		$this->add_responsive_control(
			'apostst_blog_desc_padding',
			[
				'label' => esc_html__('Padding', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-desc p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apostst_blog_desc_margin',
			[
				'label' => esc_html__('Margin', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-desc p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_gallery_info_style_section',
			[
				'label' => esc_html__( 'Thumbnail Image', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'apostst_filterable_all_info_u_border_radius',
			[
				'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-thumb img, {{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-content-box::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apostst_filterable__the_social_icon_size',
			[
				'label' => esc_html__( 'Image Height', 'advanced-posts-tab' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'laptop', 'tablet', 'tablet_extra', 'mobile', 'mobile_extra' ],
				'selectors' => [
					'{{WRAPPER}} img, {{WRAPPER}} .apostst-single-gallery img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'apostst_filterable_all_info_u_sk',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'apostst_filterable_all_info_u_align',
			[
				'label' => esc_html__( 'Items Alignment', 'advanced-posts-tab' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'filter_left' => [
						'title' => esc_html__( 'Left', 'advanced-posts-tab' ),
						'icon' => 'eicon-text-align-left',
					],
					'filter_center' => [
						'title' => esc_html__( 'Center', 'advanced-posts-tab' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'advanced-posts-tab' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'right',
				'toggle' => true,
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_blog_date_style_section',
			[
				'label' => esc_html__( 'Date', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'apostst_date_show_switcher' => 'yes'
				],
			]
		);
		// Hover control start for taxonomy date
		$this->start_controls_tabs(
			'apostst_blog_taxonomy_date_style_post'
		);
		$this->start_controls_tab(
			'apostst_blog_taxonomy_date_normal_post',
			[
				'label' => esc_html__( 'Normal', 'advanced-posts-tab' ),
			]
		);
		// Normal Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_taxonomy_date_typography',
				'selector' => '{{WRAPPER}} .apostst-gallery-thumb .apostst-date span, {{WRAPPER}} .apostst-gallery-thumb .apostst-date .apostst_icons, {{WRAPPER}} .apostst-date span, {{WRAPPER}} .apostst-date .apostst_icons',
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_date_color',
			[
				'label' => esc_html__( 'Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-thumb .apostst-date span, {{WRAPPER}} .apostst-gallery-thumb .apostst-date .apostst_icons, {{WRAPPER}} .apostst-date span, {{WRAPPER}} .apostst-date .apostst_icons' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_date_bg_color',
			[
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-thumb .apostst-date, {{WRAPPER}} .apostst-date' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'apostst_blog_taxonomy_date_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'advanced-posts-tab' ),
			]
		);
		// Hover Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_taxonomy_date_hover_typography',
				'selector' => '{{WRAPPER}} .apostst-gallery-thumb:hover .apostst-date span, {{WRAPPER}} .apostst-gallery-thumb:hover .apostst-date .apostst_icons',
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_date_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-thumb:hover .apostst-date span, {{WRAPPER}} .apostst-gallery-thumb:hover .apostst-date .apostst_icons' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_date_hover_bg_color',
			[
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-thumb:hover .apostst-date' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// Hover Control End
		
		$this->add_responsive_control(
			'apostst_blog_taxonomy_date_border_radius',
			[
				'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-thumb .apostst-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apostst_blog_date_padding',
			[
				'label' => esc_html__('Padding', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-thumb .apostst-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apostst_blog_date_margin',
			[
				'label' => esc_html__('Margin', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'rem', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-thumb .apostst-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_blog_author_options',
			[
				'label' => esc_html__( 'Author', 'blog-post-tiles' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'apostst_author_show_switcher' => 'yes'
				],
			]
		);
		// Hover control start for taxonomy author
		$this->start_controls_tabs(
			'apostst_blog_taxonomy_author_style_post'
		);
		$this->start_controls_tab(
			'apostst_blog_taxonomy_author_normal_post',
			[
				'label' => esc_html__( 'Normal', 'blog-post-tiles' ),
			]
		);
		// Normal Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_taxonomy_author_typography',
				'selector' => '{{WRAPPER}} .apostst-gallery-wrapper .apostst-author span, {{WRAPPER}} .apostst-gallery-wrapper .apostst-author .apostst_icons',
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_author_color',
			[
				'label' => esc_html__( 'Color', 'blog-post-tiles' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper .apostst-author span, {{WRAPPER}} .apostst-gallery-wrapper .apostst-author .apostst_icons' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_author_bg_color',
			[
				'label' => esc_html__( 'Background', 'blog-post-tiles' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper .apostst-author' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
            'apostst_blog_taxonomy_author_border_radius',
            [
                'label' => esc_html__('Border Radius', 'blog-post-tiles'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst-gallery-wrapper .apostst-author' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'apostst_blog_taxonomy_author_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'blog-post-tiles' ),
			]
		);
		// Hover Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_taxonomy_author_hover_typography',
				'selector' => '{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-author span, {{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-author .apostst_icons',
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_author_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'blog-post-tiles' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-author span, {{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-author .apostst_icons' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_author_hover_bg_color',
			[
				'label' => esc_html__( 'Background', 'blog-post-tiles' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-author' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
            'apostst_blog_taxonomy_author_hover_border_radius',
            [
                'label' => esc_html__('Border Radius', 'blog-post-tiles'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-author' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// Hover Control End
		$this->add_responsive_control(
            'apostst_blog_author_padding',
            [
                'label' => esc_html__('Padding', 'blog-post-tiles'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst-gallery-wrapper .apostst-author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'apostst_blog_author_margin',
            [
                'label' => esc_html__('Margin', 'blog-post-tiles'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst-gallery-wrapper .apostst-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_blog_comment_style_section',
			[
				'label' => esc_html__( 'Comment', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'apostst_comments_show_switcher' => 'yes',
				],
			]
		);
		// Hover control start for taxonomy comment
		$this->start_controls_tabs(
			'apostst_blog_taxonomy_comment_style_post'
		);
		$this->start_controls_tab(
			'apostst_blog_taxonomy_comment_normal_post',
			[
				'label' => esc_html__( 'Normal', 'advanced-posts-tab' ),
			]
		);
		// Normal Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_taxonomy_comment_typography',
				'selector' => '{{WRAPPER}} .apostst-gallery-wrapper .apostst-comment span, {{WRAPPER}} .apostst-gallery-wrapper .apostst-comment .apostst_icons',
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_comment_color',
			[
				'label' => esc_html__( 'Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper .apostst-comment span, {{WRAPPER}} .apostst-gallery-wrapper .apostst-comment .apostst_icons' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_comment_bg_color',
			[
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper .apostst-comment' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'apostst_blog_taxonomy_comment_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'advanced-posts-tab' ),
			]
		);
		// Hover Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_taxonomy_comment_hover_typography',
				'selector' => '{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-comment span, {{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-comment .apostst_icons',
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_comment_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-comment span, {{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-comment .apostst_icons' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_comment_hover_bg_color',
			[
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-comment' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// Hover Control End
		
		$this->add_responsive_control(
            'apostst_blog_taxonomy_comment_border_radius',
            [
                'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst-gallery-wrapper .apostst-comment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'apostst_blog_comment_padding',
            [
                'label' => esc_html__('Padding', 'advanced-posts-tab'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst-gallery-wrapper .apostst-comment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'apostst_blog_comment_margin',
            [
                'label' => esc_html__('Margin', 'advanced-posts-tab'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst-gallery-wrapper .apostst-comment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_blog_category_style_section',
			[
				'label' => esc_html__( 'Category', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'apostst_categories_show_switcher' => 'yes',
				],
			]
		);
		// Hover control start for taxonomy categories
		$this->start_controls_tabs(
			'apostst_blog_taxonomy_categories_style_post'
		);
		$this->start_controls_tab(
			'apostst_blog_taxonomy_categories_normal_post',
			[
				'label' => esc_html__( 'Normal', 'advanced-posts-tab' ),
			]
		);
		// Normal Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_taxonomy_categories_typography',
				'selector' => '{{WRAPPER}} .apostst-gallery-wrapper .apostst-cat',
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_categories_color',
			[
				'label' => esc_html__( 'Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper .apostst-cat' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_categories_bg_color',
			[
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper .apostst-cat' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
            'apostst_blog_taxonomy_categories_border_radius',
            [
                'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst-gallery-wrapper .apostst-cat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'apostst_blog_taxonomy_categories_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'advanced-posts-tab' ),
			]
		);
		// Hover Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_taxonomy_categories_hover_typography',
				'selector' => '{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-cat',
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_categories_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-cat' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_categories_hover_bg_color',
			[
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-cat' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
            'apostst_blog_taxonomy_categories_hover_border_radius',
            [
                'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst-gallery-wrapper:hover .apostst-cat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// Hover Control End
		$this->add_responsive_control(
            'apostst_blog_cat_margin',
            [
                'label' => esc_html__('Margin', 'advanced-posts-tab'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst-gallery-wrapper .apostst-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'apostst_taxonomy_cat_padding',
            [
                'label' => esc_html__('Padding', 'advanced-posts-tab'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst-gallery-wrapper .apostst-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_blog_tags_style_section',
			[
				'label' => esc_html__( 'Tags', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'apostst_tags_show_switcher' => 'yes',
				],
			]
		);
		// Hover control start for taxonomy tags
		$this->start_controls_tabs(
			'apostst_blog_taxonomy_tags_style_post'
		);
		$this->start_controls_tab(
			'apostst_blog_taxonomy_tags_normal_post',
			[
				'label' => esc_html__( 'Normal', 'advanced-posts-tab' ),
			]
		);
		// Normal Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_taxonomy_tags_typography',
				'selector' => '{{WRAPPER}} .apostst_blog_tag, {{WRAPPER}} .apostst_blog_tag a, {{WRAPPER}} .apostst_blog_tag .apostst_icons',
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_tags_color',
			[
				'label' => esc_html__( 'Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst_blog_tag, {{WRAPPER}} .apostst_blog_tag a, {{WRAPPER}} .apostst_blog_tag .apostst_icons' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_tags_bg_color',
			[
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst_blog_tag, {{WRAPPER}} .apostst_blog_tag::before, {{WRAPPER}} .apostst_blog_tag::after' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'apostst_blog_taxonomy_tags_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'advanced-posts-tab' ),
			]
		);
		// Hover Controls
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'apostst_blog_taxonomy_tags_hover_typography',
				'selector' => '{{WRAPPER}} .apostst_blog_box:hover .apostst_blog_tag, {{WRAPPER}} .apostst_blog_box:hover .apostst_blog_tag a, {{WRAPPER}} .apostst_blog_box:hover .apostst_blog_tag .apostst_icons',
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_tags_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst_blog_box:hover .apostst_blog_tag, {{WRAPPER}} .apostst_blog_box:hover .apostst_blog_tag a, {{WRAPPER}} .apostst_blog_box:hover .apostst_blog_tag .apostst_icons' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'apostst_blog_taxonomy_tags_hover_bg_color',
			[
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apostst_blog_box:hover .apostst_blog_tag, {{WRAPPER}} .apostst_blog_box:hover .apostst_blog_tag::before' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		// Hover Control End
	
		$this->add_responsive_control(
            'apostst_blog_taxonomy_tags_border_radius',
            [
                'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst_blog_tag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'apostst_taxonomy_tags_padding',
            [
                'label' => esc_html__('Padding', 'advanced-posts-tab'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst_blog_tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'apostst_blog_tag_margin',
            [
                'label' => esc_html__('Margin', 'advanced-posts-tab'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .apostst_blog_tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'apostst_gallery_style_section',
			[
				'label' => esc_html__( 'Box Style', 'advanced-posts-tab' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'apostst_gallery_box_background',
				'label' => esc_html__( 'Background', 'advanced-posts-tab' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .apostst-grid-item',
			]
		);
		$this->add_responsive_control(
			'apostst_gallery_the_box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-grid-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apostst_gallery_the_box_margin',
			[
				'label' => esc_html__('Margin', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apostst_gallery_the_box_padding',
			[
				'label' => esc_html__('Padding', 'advanced-posts-tab'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .apostst-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
					'apostst_loadmore_gallery_item_style_section',
					[
						'label' => esc_html__( 'Load More', 'advanced-posts-tab' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);
				$this->add_responsive_control(
					'apostst_loadmore_filterable_all_items_align',
					[
						'label' => esc_html__( 'Button Alignment', 'advanced-posts-tab' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'start' => [
								'title' => esc_html__( 'Left', 'advanced-posts-tab' ),
								'icon' => 'eicon-text-align-left',
							],
							'center' => [
								'title' => esc_html__( 'Center', 'advanced-posts-tab' ),
								'icon' => 'eicon-text-align-center',
							],
							'end' => [
								'title' => esc_html__( 'Right', 'advanced-posts-tab' ),
								'icon' => 'eicon-text-align-right',
							],
						],
						'toggle' => true,
						'selectors' => [
							'{{WRAPPER}} .load-more-btn' => 'justify-content: {{VALUE}};',
						],
					]
				);
				$this->add_responsive_control(
					'apostst_loadmore_filterable_item_spacing',
					[
						'label' => esc_html__( 'Button Bottom Spacing', 'advanced-posts-tab' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 200,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .load-more-btn' => 'padding-top: {{SIZE}}{{UNIT}};',
						],
					]
				);
				// Hover
				$this->start_controls_tabs(
					'apostst_loadmore_filterable_all_item_title_style_tabsxs'
				);
		
				$this->start_controls_tab(
					'apostst_loadmore_filterable_all_item_title_style_normal_tabxx',
					[
						'label' => esc_html__( 'Normal', 'advanced-posts-tab' ),
					]
				);
				
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'apostst_loadmore_filterable_all_item_typography',
						'selector' => '{{WRAPPER}} .load-more-btn .load-more',
					]
				);
				$this->add_control(
					'apostst_loadmore_filterable_all_item_content_quote_right_color',
					[
						'label' => esc_html__( 'Color', 'advanced-posts-tab' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .load-more-btn .load-more' => 'color: {{VALUE}}',
						],
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'apostst_loadmore_filterable_all_item_div_hoveraaaa_sssssbackground',
						'label' => esc_html__( 'Background Type', 'advanced-posts-tab' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .load-more-btn .load-more',
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'apostst_loadmore_filterable_item_border',
						'selector' => '{{WRAPPER}} .load-more-btn .load-more',
					]
				);
				$this->add_responsive_control(
					'apostst_loadmore_filterable_all_item_hover_border_radius',
					[
						'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => ['px', 'em', 'rem', 'vh', '%'],
						'selectors' => [
							'{{WRAPPER}} .load-more-btn .load-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'apostst_loadmore_filterable_all_item_box_shadow',
						'selector' => '{{WRAPPER}} .load-more-btn .load-more',
					]
				);
				$this->add_responsive_control(
					'apostst_loadmore_filterable_all_item_hover_padding',
					[
						'label' => esc_html__('Padding', 'advanced-posts-tab'),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => ['px', 'em', 'rem', 'vh', '%'],
						'selectors' => [
							'{{WRAPPER}} .load-more-btn .load-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'apostst_loadmore_filterable_all_item_hover_margin',
					[
						'label' => esc_html__('Margin', 'advanced-posts-tab'),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => ['px', 'em', 'rem', 'vh', '%'],
						'selectors' => [
							'{{WRAPPER}} .load-more-btn .load-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->end_controls_tab();
		
				$this->start_controls_tab(
					'apostst_loadmore_filterable_all_item_title_style_hover_tabaa',
					[
						'label' => esc_html__( 'Hover', 'advanced-posts-tab' ),
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'apostst_loadmore_filterable_all_item_hover_typography',
						'selector' => '{{WRAPPER}} .load-more-btn .load-more:hover',
					]
				);
				$this->add_control(
					'apostst_loadmore_filterable_all_item_content_quote_right_colorss',
					[
						'label' => esc_html__( 'Color', 'advanced-posts-tab' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .load-more-btn .load-more:hover' => 'color: {{VALUE}}',
						],
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'apostst_loadmore_filterable_all_item_div_hoveraaaa_background',
						'label' => esc_html__( 'Background Type', 'advanced-posts-tab' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .load-more-btn .load-more:hover',
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'apostst_loadmore_filterable_item_hover_border',
						'selector' => '{{WRAPPER}} .load-more-btn .load-more:hover',
					]
				);
				$this->add_responsive_control(
					'apostst_loadmore_filterable_item_hover_border_radius',
					[
						'label' => esc_html__('Border Radius', 'advanced-posts-tab'),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => ['px', 'em', 'rem', 'vh', '%'],
						'selectors' => [
							'{{WRAPPER}} .load-more-btn .load-more:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->end_controls_tab();
				$this->end_controls_tabs();
				// Hover end
				$this->end_controls_section();
	}
	protected function render() {
		$apostst_display = $this->get_settings_for_display();
		$apostst_style_selection = $apostst_display['apostst_style_selection'];
		$apostst_tab_item_align = $apostst_display['apostst_filterable_all_items_align'];
		$apostst_post_description_words = $apostst_display['apostst_the_post_description_words'];
		$apostst_blog_word_trim_indi = $apostst_display['apostst_blog_word_trim_indi'];
		$apostst_blog_date_format = $apostst_display['apostst_blog_date_format'];
		$apostst_author_indicator = $apostst_display['apostst_author_indicator'];
		$apostst_taxo_icon = $apostst_display['apostst_taxo_icon'];
		$apostst_title_swtcher = $apostst_display['apostst_title_show_switcher'];
		$apostst_title_link_show = $apostst_display['apostst_title_link_show_switcher'];
		$apostst_title_tags = $apostst_display['apostst_title_tags'];
		$apostst_description_swtcher = $apostst_display['apostst_description_show_switcher'];
		$apostst_date_swtcher = $apostst_display['apostst_date_show_switcher'];
		$apostst_author_swtcher = $apostst_display['apostst_author_show_switcher'];
		$apostst_comments_swtcher = $apostst_display['apostst_comments_show_switcher'];
		$apostst_categories_swtcher = $apostst_display['apostst_categories_show_switcher'];
		$apostst_tags_swtcher = $apostst_display['apostst_tags_show_switcher'];
		$apostst_cat_show_status = $apostst_display['apostst_the_cat_show_status'];
		$the_class_one = esc_attr('active');
		$apostst_blog_order = $apostst_display['apostst_blog_order'];
		$apostst_author = $apostst_display['apostst_the_all_author'];
		$apostst_order_by = $apostst_display['apostst_the_order_by'];
		$apostst_blog_pst_exclude = $apostst_display['apostst_blog_pst_exclude'];
		$apostst_blog_pst_explode = explode(',', $apostst_blog_pst_exclude);

		$all_tst_args = array('post_type' => 'post', 'author__in' => $apostst_author, 'orderby' => $apostst_order_by, 'order' => $apostst_blog_order, 'post__not_in' => $apostst_blog_pst_explode);
		include( __DIR__ . '/style-templates/'.$apostst_style_selection.'.php' );
	}
}
