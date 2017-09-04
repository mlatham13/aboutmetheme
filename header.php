<?php
/*
    The template for displaying the header
*/
?>
<!-- start header.php -->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php wp_head(); ?>
</head>

<!-- Start the body of the site. The body tag be closed in footer.php -->
<body>
    <div id="site-wrapper" class="site-wrapper">
        <div class='menu-header'>
            <?php
            if (has_nav_menu( 'header' )) {
                wp_nav_menu(
                    array( 'theme_location' => 'header',
                    )
                );
            }
            if (is_user_logged_in()) {
                ?>
                <div class='menu-header-user'>
                    <ul>
                        <li>
                            <a href="<?php echo get_edit_user_link(); ?>" title="Profile">Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a>
                        </li>
                    </ul>
                </div>
                <?php
            } else {
                ?>
                <div class='menu-header-user'>
                    <?php amt_get_theme_color_select(); ?>
                    <ul>
                        <li>
                            <a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login">Login</a>
                        </li>
                        <li>
                            <a href="<?php echo wp_registration_url( get_permalink() ); ?>" title="Register">Register</a>
                        </li>
                    </ul>
                </div>
                <?php
            }
            ?>
        </div>
<!-- end header.php -->
