<?php
    /*
     * Template for displaying the sidebar on the index page
     *
     *
     */
 ?>

<aside id="sidebar-header" class="sidebar-header">
	<?php
        //
        // Dynamic sidebar allows configuration via
        // the Wordpress admin widgets configuration page.
        //
        // Refer to functions.php register_sidebar
        //
        dynamic_sidebar( 'sidebar-index' );
    ?>
</aside><!-- .sidebar .widget-area -->
