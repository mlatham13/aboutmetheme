<?php
/*
    Values for global access. For word/phrase translations,
    refer to /languages/amt-translations.php
*/

// Hardcoded contact email address in lieu of admin url
$CONTACT_EMAIL = "";

// Info web servcie base URL
$INFO_WS_URL = get_theme_mod('info_ws_url','');

// Available theme color style options
$THEME_COLOR_OPTIONS = array("sky","sage","flamingo","desert");
$themeColorSelected  = get_theme_mod('theme_style','sky');

// Allowed tweets
$TWEETS = [
    "tOpt1" => "Good day, my fellow tweeters! #goodday #hello",
    "tOpt2" => "Today is a good day to be above ground! #alive #aboveground",
    "tOpt3" => "Strive to maintain an attitude of gratitude. #chinup",
    "tOpt4" => "Stay calm and jam on some code. #maddeveloper",
    "tOpt5" => "Code with passion. #geeksrule",
];

// Post tweet status web service base URL
$TWEET_WS_URL = get_theme_mod('tweet_ws_url','');
?>
