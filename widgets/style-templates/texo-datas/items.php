<?php
/**
 * @===================//// Texo all here
 */
                if('yes' === $apostst_display['apostst_filterable_all_enable_filter']){
                        echo '<div class="apostst-menu-item '.$the_class_one.'" data-filter="*">'.esc_html($apostst_display['apostst_filterable_all_item']).'</div>';
                }
                if ( $apostst_display['apostst_total_box'] ) {
                        foreach (  $apostst_display['apostst_total_box'] as $item_title ) {
                                $apostst_filter_data = esc_html($item_title['apostst_the_cat_columnsdd']);
                                $apostst_show_data = $item_title['apostst_the_cat_type_se'] == 'text'?$item_title['apostst_filterable_text_type']:$apostst_filter_data;
                        echo '<div class="apostst-menu-item elementor-repeater-item-' . esc_attr( $item_title['_id'] ) . '" data-filter="'. esc_attr($apostst_filter_data) .'">'.esc_html($apostst_show_data).'</div>';
                        }
                }