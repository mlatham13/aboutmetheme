<?php
/*
    Additional functions not specifically related to Wordpress customization
*/


/*
    Debug Helpers
*/
function amt_php_debug( $outString ) {
  PhpConsole\Connector::getInstance()->getDebugDispatcher()->dispatchDebug($outString);
}
function var_dump_pre($mixed = null) {
  echo '<pre>';
  var_dump($mixed);
  echo '</pre>';
}
/*
    AJAX functions
 */
function amt_do_tweet() {
    try {
        check_ajax_referer( 'ajax_action', 'ajax_nonce' );
        global $TWEETS;
        global $TWEET_WS_URL;
        if ($TWEET_WS_URL == "") {
            $msg = "Twitter " . $TXT_WS_URL_NOT_SET;
            if ( ! is_admin() ) {
                $msg = $msg . " " . $TXT_CONTACT_ADMIN;
            }
            throw new Exception($msg);
        }
        $tweetIdx = htmlspecialchars($_POST["data"]);
        $tweetTxt = "It seems an unauthorized tweet has being attempted. Tsk, tsk";
        if (isset($TWEETS[$tweetIdx])) {
            $tweetTxt = $TWEETS[$tweetIdx];
        }
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'max_redirects' => '0',
                'ignore_errors' => '0',
                'content' => '{"message":"'.$tweetTxt.'"}',
            )
        );
        $response = array();
        $context = stream_context_create($opts);
        $stream = fopen($TWEET_WS_URL, 'r', false, $context);
        if ($stream == null) {
            throw new Exception('Failed to open stream. Check the URL.');
        }
        $itemListJson = stream_get_contents($stream);
        fclose($stream);
        $response['status'] = '200';
        $response['message'] = 'Thanks for tweeting for me!';
    } catch (Exception $ex) {
        $response['status'] = '500';
        $response['message'] = 'Something went wrong: ' . $ex->getMessage();
    }
    wp_send_json($response);
}
function amt_set_theme() {
    global $themeColorSelected;
    $themeColorSelected = $_POST["theme"];
    $_SESSION['theme_style'] = $themeColorSelected;
    $response = array();
    $response['status']  = '200';
    $response['message'] = 'Theme set';
    wp_send_json($response);
}
/*
    Return a label and selector to set the color scheme for this session
*/
function amt_get_theme_color_select($doEcho = true, $prePostTags = array()) {
    global $TXT_THEME;
    global $THEME_COLOR_OPTIONS;
    global $themeColorSelected;

    $preLabelTag = "";
    $postLabelTag = "";
    if (isset($prePostTags['preLabelTag']) && isset($prePostTags['postLabelTag'])) {
        $preLabelTag  = $prePostTags['preLabelTag'];
        $postLabelTag = $prePostTags['postLabelTag'];
    }
    $themeLabel = $preLabelTag . "<label class='theme-select-label'>".$TXT_THEME."</label>".$postLabelTag;

    $preSelectTag = "";
    $postSelectTag = "";
    if (isset($prePostTags['preSelectTag']) && isset($prePostTags['postSelectTag'])) {
        $preSelectTag  = $prePostTags['preSelectTag'];
        $postSelectTag = $prePostTags['postSelectTag'];
    }
    $themeSelect = $preSelectTag . "<select name='theme-select-color' id='theme-select-color' class='theme-select-value'>";
    $infoArrayObj = new ArrayObject( $THEME_COLOR_OPTIONS );
    $itr = $infoArrayObj->getIterator();
    while ($itr->valid()) {
        $selStr = "";
        if ($themeColorSelected == $itr->current()) {
            $selStr = " selected";
        }
        $themeSelect = $themeSelect . "<option value=".$itr->key().$selStr.">".$itr->current()."</option>";
        $itr->next();
    }
    $themeSelect = $themeSelect . "</select>" . $postSelectTag;

    $themeDiv = "<div class='theme-select-div'>".$themeLabel.$themeSelect."</div>";
    if ($doEcho) {
        echo $themeDiv;
    } else {
        return $themeDiv;
    }
}

?>
