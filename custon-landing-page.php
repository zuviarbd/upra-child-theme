<?php
/**
 * Template Name: Custome Blog Layout for Homepage
 */

get_header(); ?>
    <div class="home mh-section mh-group">
        <div id="main-content" class="home-columns">
            <?php
            $stickies = get_option( 'sticky_posts' );
            // Make sure we have stickies to avoid unexpected output
            if ( $stickies ) {
                $args = [
                    'post_type'           => 'post',
                    'post__in'            => $stickies,
                    'posts_per_page'      => 1,
                    'ignore_sticky_posts' => 1
                ];
                $the_query = new WP_Query($args);

                if ( $the_query->have_posts() ) {
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();

                        get_template_part('content', 'lead');
                      	echo '<hr class="mh-separator">';
                    }
                    wp_reset_postdata();
                }
            }
            
          dynamic_sidebar('home-1');
                    // above code will show only last sticky post. So avoid putting post large in home-1 sidebar. ?>
            <?php if (is_active_sidebar('home-2') || is_active_sidebar('home-3')) : ?>
                <div class="mh-section mh-group">
                    <?php if (is_active_sidebar('home-2')) { ?>
                        <div class="mh-col mh-1-2 home-2">
                            <?php dynamic_sidebar('home-2'); ?>
                        </div>
                    <?php } ?>
                    <?php if (is_active_sidebar('home-3')) { ?>
                        <div class="mh-col mh-1-2 home-3">
                            <?php dynamic_sidebar('home-3'); ?>
                        </div>
                    <?php } ?>
                </div>
            <?php endif; ?>
            <?php dynamic_sidebar('home-4'); ?>
        </div>
        <aside class="home-sidebar">
            <?php dynamic_sidebar('home-5'); ?>
        </aside>
    </div>
<?php get_footer();