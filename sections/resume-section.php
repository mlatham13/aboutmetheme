<?php
/*
    Display Resume PDF
*/
$resumeFile = trailingslashit( get_template_directory_uri() ) . 'media/documents/Resume.pdf';
?>
<!-- resume-section.php content -->
<div class="resume">
    <object id="resume-file" class="resume-file"
            data=<?php echo $resumeFile; ?> type="application/pdf">
    <?php
        GLOBAL $TXT_NOT_SUPPORTED;
        echo $TXT_NOT_SUPPORTED;
    ?>
    </object>
</div>
<!-- end resume-section.php content -->
