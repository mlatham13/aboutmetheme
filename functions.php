<?php
/*
    Wordpress configuration functions.
    Add work functions not specific to Wordpress configuration to
    @see php/amt-functions.php
*/


// Put text translations in this special file
include_once get_template_directory() . "/languages/amt-translations.php";
// Other general constants
include_once get_template_directory() . "/php/amt-globals.php";
// Other general functions
include_once get_template_directory() . "/php/amt-functions.php";

/*
    Initial Theme Setup
*/
if ( ! function_exists( 'aboutmetheme_setup' ) ) :
    function aboutmetheme_setup() {
        load_theme_textdomain( 'aboutmetheme' );
        add_theme_support( 'title-tag' );

        // Localization
        load_theme_textdomain( 'aboutmetheme', get_template_directory() . '/languages' );

        // Navigation menus
        register_nav_menus( array(
            'header' => __( 'Header Menu', 'aboutmetheme' ),
            'footer'  => __( 'Footer Menu', 'aboutmetheme' ),
        ) );

        // Start a PHP session, if needed
        if (session_id() == "") {
            session_start();
        }

        if ( !current_user_can('administrator') ) {
            show_admin_bar( false );
        }
    }
endif;
add_action( 'after_setup_theme', 'aboutmetheme_setup' );

/*
    Enqueue Styles and Scripts
*/
function aboutmetheme_scripts() {
    // Include custom scripts
    wp_enqueue_script('amt-js', get_template_directory_uri() . '/js/amt-functions.js');
    wp_enqueue_script('amt-js-page', get_template_directory_uri() . '/js/amt-js-page.js');
    wp_enqueue_script('amt-jquery', get_template_directory_uri() . '/js/amt-jquery.js', array('jquery'));
    $amt_ajax_nonce = wp_create_nonce( 'ajax_action' );
    wp_localize_script( 'amt-jquery', 'amt_ajax_obj', array(
           'ajax_url' => admin_url( 'admin-ajax.php' ),
           'nonce'    => $amt_ajax_nonce,
           'theme_css_url' => get_template_directory_uri() . '/css/color-schemes/',
        )
    );

    wp_localize_script( 'amt-js-page', 'amt_js_obj', array(
        'audio_url' => get_template_directory_uri() . '/media/audio/',
        'image_url' => get_template_directory_uri() . '/media/images/',
        )
    );
}
add_action( 'wp_enqueue_scripts', 'aboutmetheme_scripts', 1);

function aboutmetheme_styles() {
    // Theme stylesheet.
    wp_enqueue_style( 'aboutmetheme-style', get_stylesheet_uri() );
    wp_enqueue_style( 'aboutmetheme-animation', get_template_directory_uri() . '/css/animations.css' );

    // Load theme color scheme stylesheet
    global $themeColorSelected;
    $user_id = get_current_user_id();
    $user_scheme_name = get_user_meta($user_id, 'theme_style', true);
    if ($user_scheme_name) {
        $themeColorSelected = $user_scheme_name;
    } elseif (isset($_SESSION['theme_style'])) {
        $themeColorSelected = $_SESSION['theme_style'];
    }
    $style_file = $themeColorSelected . '.css';
    $style_path = trailingslashit( get_template_directory_uri() ) . 'css/color-schemes/' . $style_file;
    wp_enqueue_style( 'color-scheme-style', $style_path );

}
add_action( 'wp_enqueue_scripts', 'aboutmetheme_styles', 5 );

function login_style() {
    wp_enqueue_style( 'aboutmetheme-login-style', get_template_directory_uri() . '/css/login-style.css' );
}
add_action( 'login_enqueue_scripts', 'login_style' );
/**
 * Registers a sidebar area. Rather than code fixed sidebar content, this site
 * uses dynamic sidebars. This allows the admin to change the sidebar content
 * without having to update client or server files.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 */
function aboutmetheme_widgets_init() {
    /*
     *  The page sidebar.  As admin, go to Appearance->Widgets to configure sidebar widgets
     */
    register_sidebar( array(
        'name'          => __( 'Page Sidebar', 'aboutmetheme' ),
        'id'            => 'sidebar-page',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'aboutmetheme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    /*
     *  The index sidebar.  As admin, go to Appearance->Widgets to configure sidebar widgets
     */
    register_sidebar( array(
        'name'          => __( 'Index Sidebar', 'aboutmetheme' ),
        'id'            => 'sidebar-index',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'aboutmetheme' ),
        'before_widget' => '<section id="%1$s" style="float:left">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'aboutmetheme_widgets_init' );


/*
    Add Customizations
*/
function aboutmetheme_register( $wp_customize ) {
    // Add the settings
    $wp_customize->add_setting( 'color_scheme', array(
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'default' => 'sky',
      'transport' => 'refresh', // or postMessage
      'sanitize_callback' => 'sanitize_text_field',
      )
    );
    $wp_customize->add_setting( 'info_ws_url', array(
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'default' => '',
      'transport' => 'refresh', // or postMessage
      'sanitize_callback' => 'sanitize_text_field',
      )
    );
    $wp_customize->add_setting( 'tweet_ws_url', array(
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'default' => '',
      'transport' => 'refresh', // or postMessage
      'sanitize_callback' => 'sanitize_text_field',
      )
    );

    // Add the setting controls
    global $THEME_COLOR_OPTIONS;
    $wp_customize->add_control( 'color_scheme', array(
      'type' => 'select',
      'priority' => 10,
      'section' => 'aboutmetheme_custom_settings',
      'label' => __( 'Color Scheme' ),
      'description' => __( 'Choose default color scheme' ),
      'choices' => $THEME_COLOR_OPTIONS,
    ) );
    $wp_customize->add_control( 'info_ws_url', array(
      'type' => 'url',
      'priority' => 10,
      'section' => 'aboutmetheme_custom_settings',
      'label' => __( 'Info WS URL' ),
      'description' => __( 'Enter Info web service URL' ),
    ) );
    $wp_customize->add_control( 'tweet_ws_url', array(
      'type' => 'url',
      'priority' => 10,
      'section' => 'aboutmetheme_custom_settings',
      'label' => __( 'Tweet WS URL' ),
      'description' => __( 'Enter Twitter web service URL' ),
    ) );

    // Add aboutmetheme custom settings section
    $wp_customize->add_section( 'aboutmetheme_custom_settings', array(
      'title' => __( 'About Me Settings' ),
      'description' => __( 'Set custom settings' ),
      'priority' => 160,
      'capability' => 'edit_theme_options',
    ) );
}
add_action('customize_register','aboutmetheme_register');

/*
    User profile fields
*/
function show_custom_profile_fields( $user ) {
    $title = "<h3>" . "Additional Properties" . "</h3>";

    // Start the table of custom profile options
    $table = "<table class='form-table'>";

    // Theme color/style option
    $span = "<span class='description'>Select a theme color</span>";
    $prePostTags = array (
        'preLabelTag' => '<tr><th>',
        'postLabelTag' => '</th>',
        'preSelectTag' => '<td>',
        'postSelectTag' => '<br>' . $span . '</td></tr>'
    );
    global $themeColorSelected;
    $themeColorSelected = get_user_meta($user->ID, 'theme_style', true);
    $themeSelect = amt_get_theme_color_select(false, $prePostTags);
    $table = $table . $themeSelect;

    // End table of custom profile options
    $table = $table . "</table>";
    echo $title;
    echo $table;
}
add_action( 'show_user_profile', 'show_custom_profile_fields' );
add_action( 'edit_user_profile', 'show_custom_profile_fields' );

function save_custom_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    global $themeColorSelected;
    global $THEME_COLOR_OPTIONS;
    $themeColorIdx = $_POST['theme-select-color'];
    $themeColorSelected = $THEME_COLOR_OPTIONS[$themeColorIdx];
    update_usermeta( $user_id, 'theme_style', $themeColorSelected );
}
add_action( 'personal_options_update', 'save_custom_profile_fields' );
add_action( 'edit_user_profile_update', 'save_custom_profile_fields' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function login_logo_url_title() {
    return 'www.MichaelLatham.info';
}
add_filter( 'login_headertitle', 'login_logo_url_title' );

/*
    Removal of wp emojis since there are errors
*/
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

/*
    Add AJAX calls.
    @see php/amt-functions.php
*/
add_action( 'wp_ajax_amt_do_tweet', 'amt_do_tweet' );
add_action( 'wp_ajax_nopriv_amt_do_tweet', 'amt_do_tweet' );
add_action( 'wp_ajax_amt_set_theme', 'amt_set_theme' );
add_action( 'wp_ajax_nopriv_amt_set_theme', 'amt_set_theme' );
