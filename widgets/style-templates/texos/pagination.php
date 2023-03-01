                <div class="apostst_pagination_item <?php echo esc_attr__($apostst_pagination_position); ?>">
                <?php
                $total_pages = $all_posts->max_num_pages;
                if ($total_pages > 1){
                    $current_page = max(1, get_query_var('paged'));
                    if('none' === $apostst_the_pagination_type){
                        echo paginate_links(array(
                            'show_all' => false,
                        ));
                    } elseif('number-and-text' === $apostst_the_pagination_type){
                        echo paginate_links(array(
                            'current' => $current_page,
                            'total' => $total_pages,
                            'prev_text'    => $apostst_blog_prev_format,
                            'next_text'    => $apostst_blog_next_format,
                        ));
                    } elseif('number' === $apostst_the_pagination_type){
                        echo paginate_links(array(
                            'current' => $current_page,
                            'total' => $total_pages,
                            'prev_next'          => false,
                        ));
                    }
                }
                ?> </div>