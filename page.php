<?php
/*
    Template for displaying a page
*/
get_header();
?>
<!-- page.php content -->
<article id="post-<?php the_ID(); ?>">
	<div class="post row">
		<?php
            the_post();
            echo "<div class='col-9'>";
                the_content();
                global $post;
                $post_slug=$post->post_name;
                get_template_part( 'templates/'.$post_slug, 'template' );
            echo "</div>";
            if ($post_slug != "login") {
                echo "<div class='col-3'>";
                    get_template_part( 'sidebars/sidebar', 'page' );
                echo "</div>";
            }
		?>
	</div>
</article>
<!-- end page.php content -->

<?php get_footer(); ?>
