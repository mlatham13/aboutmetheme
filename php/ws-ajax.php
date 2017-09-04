<?php
/*
    This file displays and handles the AJAX section of the Web Services page
*/
?>
<div class="intro-text">
<p>
    The following section communicates with a web service via Wordpress AJAX hooks.
    Select a status message and tweet on my behalf.
    To see if the tweet really happened, just look me up
    <a href="https://twitter.com/ThatLathamDude" target="_blank">@ThatLathamDude</a> on Twitter.
</p>
</div>
<div class="hline"></div>

<?php // Tweet on twitter
    global $TWEET_WS_URL;
    global $TXT_WS_URL_NOT_SET;
    global $TXT_CONTACT_ADMIN;
    if ($TWEET_WS_URL == "") {
        $msg = "Twitter " . $TXT_WS_URL_NOT_SET;
        if ( ! is_admin() ) {
            $msg = $msg . " " . $TXT_CONTACT_ADMIN;
        }
        echo "<h3>" . $msg . "</h3>";
        return;
    }
?>
<div class="tweet-div">
    <?php echo __('Select a tweet on my behalf','aboutmetheme'); ?>:
    <?php // This is not in a form since we don't want any submit action. ?>
    <select id="select-tweet" class="tweet-select">
        <?php
            global $TWEETS;
            $infoArrayObj = new ArrayObject( $TWEETS );
            $itr = $infoArrayObj->getIterator();
            while ($itr->valid()) {
                echo "<option value=".$itr->key().">".$itr->current()."</option>";
                $itr->next();
            }
        ?>
    </select>
    <?php // Action is handled in amt-jquery.js ?>
    <button id="send-tweet-btn" class="tweet-send-btn">
        <?php echo __('Tweet It','aboutmetheme'); ?>
    </button>
    <br><br>
    <?php
        $taColor = "ta-bg-lightgrey";
        $taClass = "'info-textarea " . $taColor . "'";
    ?>
    <textarea class=<?php echo $taClass;?> id='tweet-result' rows=5 readonly></textarea>
</div>
