<?php
/*
    This file displays and handles the AWS section of the Web Services page
*/
?>
<div class="intro-text">
<p>
The following two sections communicate with an AWS web service I developed.
Having already used the 'puts' method to add various facts about myself, the first
section will retrieve a list of fact titles, and the second will retrieve
the fact text. Naturally, making two round trips to get titles and then the details
is inefficient. So, clicking on any returned title will show the fact that goes
with it. However, I wanted to have two GETS from a single AWS serverless project.
</p>
</div>

<?php
//
// Handle form submits - Page display continues afterwards
//
global $TXT_SUBMIT;
global $INFO_WS_URL;
global $TXT_WS_URL_NOT_SET;
global $TXT_CONTACT_ADMIN;

if ($INFO_WS_URL == "") {
    $msg = "Info " . $TXT_WS_URL_NOT_SET;
    if ( ! is_admin() ) {
        $msg = $msg . " " . $TXT_CONTACT_ADMIN;
    }
    echo "<h3>" . $msg . "</h3>";
    return;
}

$infoFilter = "";
$infoList  = "<ol class='list-box-ol'></ol>";
$infoTitle = "";
$infoText  = "";
$taColor   = "ta-bg-lightgrey";

// Handle submit for Get Titles
if (isset($_POST['submit_list'])) {
    $infoFilter = sanitize_text_field($_POST['infoFilter']);
    $infoUrl = $INFO_WS_URL . '/titles/?title=' . $infoFilter;
    $taColor = "ta-bg-black";
    $opts = array('http' =>
        array(
            'method' => 'GET',
            'max_redirects' => '0',
            'ignore_errors' => '0'
        )
    );

    try {
        //echo "<script type='text/javascript'>amt_busy();</script>";
        $context = stream_context_create($opts);
        $stream = fopen($infoUrl, 'r', false, $context);
        $itemListJson = stream_get_contents($stream);
        fclose($stream);
        $infoListArray = json_decode($itemListJson,1);
        if (isset($infoListArray["items"])) {
            $infoArrayObj = new ArrayObject( $infoListArray["items"] );
            $itr = $infoArrayObj->getIterator();
            if ($itr->count() == 0) {
                $infoList = "<p>" . __('No information was found.','aboutmetheme') . "</p>";
            } else {
                $infoList = "<ol class='list-box-ol'>";
                while ($itr->valid()) {
                    $infoData = $itr->current();
                    $title = $infoData["title"];
                    $info  = $infoData["info"];
                    $liTag = "<li";
                    $liTag = $liTag . " class='list-box-li'";
                    $liTag = $liTag . " onclick='amt_title_onclick(\"".$title."\",\"".$info."\")'";
                    $liTag = $liTag . ">";
                    $infoList = $infoList . $liTag . $title . "</li>";

                    $itr->next();
                }
                $infoList = $infoList . "</ol>";
            }
        } else {
            $infoList = "<p>" . __('No information was returned.','aboutmetheme') . "</p>";
        }
    } catch (Exception $ex) {
        $infoList = "<p>" . __('Error calling info web service: ','aboutmetheme') . $ex->getMessage() . "</p>";
    }

    echo "<script type='text/javascript'>amt_not_busy();</script>";

}
// Handle submit to get info text by title
if (isset($_POST['submit_info'])) {
    $infoTitle = esc_html( sanitize_text_field($_POST['infoTitle']) );
    $infoTitleToId = strtolower( str_replace(" ","",$infoTitle) );
    $infoText = "";
    $taColor = "ta-bg-black";
    $infoUrl = $INFO_WS_URL . '/?id=' . $infoTitleToId;
    $opts = array('http' =>
        array(
            'method' => 'GET',
            'max_redirects' => '0',
            'ignore_errors' => '0'
        )
    );

    try {
        $context = stream_context_create($opts);
        $stream = @fopen($infoUrl, 'r', false, $context);
        if (!$stream) {
            throw new Exception("Did not find an entry for title ".$infoTitle);
        }
        $infoJsonStr = stream_get_contents($stream);
        $infoArray = json_decode($infoJsonStr,true);
        $infoTitle = $infoArray["title"];
        $infoText  = $infoArray["info"];
        fclose($stream);
    } catch(Exception $ex) {
        $infoText = $ex->getMessage();
    }
    echo "<script type='text/javascript'>amt_not_busy();</script>";
}

// Get Titles form
?>
<form method="post" width="90%">
<?php echo __('Title Filter','aboutmetheme'); ?>:
<input type="text" name="infoFilter"
       value="<?php echo $infoFilter;?>"
       placeholder="<?php echo __('Full or partial title or empty for all'); ?>"
       size="40">
<input type="submit" name="submit_list" value="<?php echo __('Get Titles','aboutmetheme');?>"
       onclick="amt_busy()"><br><br>
</form>
<div class="list-box">
<?php
    echo $infoList
?>
</div>
<br><br>

<?php // Get Info Text form ?>
<form method="post" width="90%">
<?php echo __('Title','aboutmetheme'); ?>:
<input type="text" id="infoTitle" name="infoTitle"
     value="<?php echo $infoTitle;?>"
     placeholder="<?php echo __('Enter full title'); ?>"
     size="40">
<input type="submit" name="submit_info" value="<?php echo $TXT_SUBMIT;?>" onclick="amt_busy()"><br><br>
</form>
<div>
<?php $taClass = "'info-textarea " . $taColor . "'";?>
<textarea class=<?php echo $taClass;?> id='infoData' rows=10 readonly><?php echo $infoText;?></textarea>
</div>

<div class="hline"></div>
