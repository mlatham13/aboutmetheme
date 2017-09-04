<?php
/*
    Contact form
*/
?>
<!-- contact-section.php content -->
<?php
    global $CONTACT_EMAIL;
    global $TXT_SEND;
    global $TXT_SUBJECT;
    $message = "";
    $subject = "";
    if (isset($_POST['submit_email'])) {
        $message = esc_html( sanitize_text_field($_POST['contact-text']) );
        $subject = esc_html( sanitize_text_field($_POST['contact-subject']) );
        $email = get_option('admin_email');
        if (!empty($CONTACT_EMAIL)) {
            $email = $CONTACT_EMAIL;
        }
        if (isset($message)) {
            wp_mail($email,$subject,$message);
        }
    }
?>
<form class="contact-form" method="post">
    <label class="contact-subject-label" for="contact-subject">
        <?php echo $TXT_SUBJECT; ?>
    </label>
    <input class="contact-subject" name="contact-subject" type="text">
    <br>
    <textarea class="contact-text" name="contact-text">
        <?php echo $message; ?>
    </textarea>
    <br>
    <input type="checkbox" class="contact-validate" id="contact-validate" name="contact-validate">
    I am legit
    <label id="contact-answer-label" style="display:none;margin-left:5px;">What is six plus eight?</label>
    <input id="contact-answer" style="display:none" type="number" name="contact-answer" min="0" max="100">
    <br>
    <input id="submit_email" class="contact-submit" type="submit" name="submit_email" value="<?php echo $TXT_SEND;?>" disabled>
</form>

<!-- end contact-section.php content -->
