<?php
/**
 * @===================//// Texo all here
 */

        $apostst_description = wp_trim_words(get_the_content(), $apostst_post_description_words, $apostst_blog_word_trim_indi);
        $apostst_description_switcher = ('yes' === $apostst_description_swtcher)?$apostst_description:'';
        echo '<div class="apostst-desc"><p>'.$apostst_description_switcher.'</p></div>';
                $apostst_post_date = get_the_date($apostst_blog_date_format);
                $apostst_date_title = '<span>'.$apostst_post_date.'</span></div>';
                $apostst_date_icon = '<i class="apostst_icons far fa-calendar-alt"></i>';
                $apostst_date_show_icon = ('show' == $apostst_taxo_icon)?$apostst_date_icon:'';
                $apostst_date_wrap_div = '<div class="apostst-date">'.$apostst_date_show_icon;
                $apostst_date_switch = ('yes' === $apostst_date_swtcher)? $apostst_date_wrap_div:'';
                $apostst_date_title_switch = ('yes' === $apostst_date_swtcher)? $apostst_date_title:'';
                echo $apostst_date_switch.$apostst_date_title_switch;
        $apostst_control_icon = $apostst_display['apostst_author_icon']['value'];
        $apostst_author_icon = '<i class="apostst_icons '.$apostst_control_icon.'"></i>';
        $apostst_gravater = get_avatar( get_the_author_meta( 'ID' ), $size = '50', $default = '', $alt = 'Author Image', $args = array( 'class' => 'wt-author-img' ) );
        $apostst_author_indicator_check = ('icon' === $apostst_author_indicator) ? $apostst_author_icon : $apostst_gravater;
        $apostst_total_author = $apostst_author_indicator_check;
        $apostst_author = ('yes' === $apostst_author_swtcher) ? $apostst_total_author : '';
        echo '<div class="apostst-author">'.$apostst_author.'<span>'.get_the_author_meta( 'nickname' ).'</span></div>';
        if('yes' === $apostst_categories_swtcher){
                if('show_main_cat' === $apostst_cat_show_status){ 
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                                echo '<ul class="post-categories"><li><a href="'. esc_url(plugin_dir_url( '../../category/').$categories[0]->name ) .'" class="apostst-cat">'.esc_html( $categories[0]->name ).'</a></li></ul>';	
                        }
                } elseif('show_multiple_cat' === $apostst_cat_show_status){
                the_category();
                }
        }
        $apostst_post_tags = get_the_tags();
        $apostst_main_tag = ($apostst_post_tags) ? $apostst_post_tags[0]->name:'';
        $apostst_tag_title = '<span>'.$apostst_main_tag.'</span></div>';
        $apostst_tag_icon = '<i class="fas fa-tag"></i>';
        $apostst_tag_show_icon = ('show' == $apostst_taxo_icon)?$apostst_tag_icon:'';
        $apostst_wrap_div = '<div class="apostst-tag">'.$apostst_tag_show_icon;
        $apostst_wrap_tag = ('yes' == $apostst_tags_swtcher)?$apostst_wrap_div:'';
        $apostst_wrap_close_div = ('yes' == $apostst_tags_swtcher)?$apostst_tag_title:'';
        echo $apostst_wrap_tag.$apostst_wrap_close_div;
        if('yes' == $apostst_comments_swtcher){
                $apostst_main_comm = (!have_comments())?esc_html__('Comment (') . get_comments_number().')':'';
                $apostst_comm_title = '<span>'.$apostst_main_comm.'</span></div>';
                $apostst_comm_icon = '<i class="fas fa-comments"></i>';
                $apostst_comm_show_icon = ('show' == $apostst_taxo_icon)?$apostst_comm_icon:'';
                $apostst_wrap_comm_div = '<div class="apostst-comment">'.$apostst_comm_show_icon;
                if('yes' == $apostst_comments_swtcher){
                        echo $apostst_wrap_comm_div.$apostst_comm_title;
                }
        }