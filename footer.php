<?php
/*
    The footer template.  Close the site wrapper, body, and html

    @package aboutmetheme
*/
?>
<!-- start footer.php -->
<footer>
    <?php
    if ( has_nav_menu( 'footer' ) ) {
        wp_nav_menu(
            array( 'theme_location' => 'footer',
                   'container_class' => 'menu-footer'
            )
        );
    }
    ?>
</footer>

</div> <!-- close site-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
<!-- end footer.php -->
