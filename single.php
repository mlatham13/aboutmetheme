<?php
/*
    Single used when...
*/
?>
<?php
    get_header();
    if (get_theme_mod( 'custom_logo' )) {
        the_custom_logo();
    }
?>
<!-- single.php content -->
<div id="single" class="row page">
    <div class="col-9">
        <?php
            the_post();
            the_title('<h2>','</h2>');
            the_content();
            global $post;

            //
            // Add any additional forms or whatever
            // For example, if the post name is "contact", then we
            // can include a contact form by creating a php file
            // named contact-section.php in the /sections directory
            //
            get_template_part( 'sections/'.$post->post_name, 'section' );
        ?>
    </div>
    <div class="col-3">
        <?php get_template_part( 'sidebars/sidebar', 'page' ); ?>
    </div>
</div>
<!-- end single.php content -->

<?php get_footer(); ?>
