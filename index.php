<?php
/*
    Index shown when the "Front page displays" parameter is set to "Your latest posts"
*/
?>
<?php
    get_header();
    if (get_theme_mod( 'custom_logo' )) {
        the_custom_logo();
    }
?>
<!-- index.php content -->
<div class="row page">
    <div class="col-9">
        <?php
            // For the index page, get the post named 'index' and display
            // its content. This will allow the page text to be changed simply
            // by editing the post, rather than editing client or server files.
            $the_query = new WP_Query( array( 'name' => 'index' ) );
            // The Loop
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    the_title('<h2>','</h2>');
                    the_content();
                }
            } else {
                echo "<h3>Create a post with a post slug of 'index'</h3>";
            }
            /* Restore original Post Data */
            wp_reset_postdata();
        ?>
    </div>
    <div class="col-3">
        <?php get_template_part( 'sidebars/sidebar', 'index' ); ?>
    </div>
</div>
<!-- end index.php content -->

<?php get_footer(); ?>
