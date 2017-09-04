<?php
    /*
     * Template for displaying the page sidebar
     *
     *
     */
 ?>

<div id="secondary-footer" class="sidebar-footer col-12">
	<?php
        //
        // Dynamic sidebar allows configuration via
        // the Wordpress admin widgets configuration page.
        //
        // Refer to functions.php register_sidebar
        //
        global $categoryPageIndex;
        dynamic_sidebar( 'sidebar-footer' );
    ?>
</div><!-- .sidebar .widget-area -->
