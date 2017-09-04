<?php
    /*
     * Template for displaying the page sidebar
     *
     *
     */
 ?>

<aside id="sidebar-page" class="sidebar-page">
	<?php
        //
        // Dynamic sidebar allows configuration via
        // the Wordpress admin widgets configuration page.
        //
        // Refer to functions.php register_sidebar
        //
        dynamic_sidebar( 'sidebar-page' );
    ?>
</aside><!-- .sidebar .widget-area -->
