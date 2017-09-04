/*
    aboutmetheme jQuery actions
*/
jQuery(document).ready(function($){

    // Send mail validate answer
    $("#contact-answer")
        .on('keyup change', function() {
            var btn = document.getElementById("submit_email");
            if (this.value == 14) {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        });
    // Send mail validation checkbox handler
    $("#contact-validate")
        .change(function() {
            var lbl = document.getElementById("contact-answer-label");
            var ans = document.getElementById("contact-answer");
            if (this.checked) {
                lbl.style.display = "inline-block";
                ans.style.display = "inline-block";
            } else {
                lbl.style.display = "none";
                ans.style.display = "none";
                ans.value = "";
            }
            var btn = document.getElementById("submit_email");
            btn.disabled = true;
        });
    // Tweet It button handlers
    $("#send-tweet-btn")
        .click(function() {
            $.post(
                amt_ajax_obj.ajax_url,
                {
                    'ajax_nonce': amt_ajax_obj.nonce,
                    'action': 'amt_do_tweet',
                    'data':   $("#select-tweet").val()
                },
                function(response){
                    var msg = 'Response:\nStatus = ' + response.status + '\nMessage = ' + response.message;
                    $("#tweet-result").val(msg);
                }
            );
        });

    // Theme color style selection handler
    $("#theme-select-color")
        .on('change afterupdate', function() {
            var cssLink = document.getElementById("color-scheme-style-css");
            var newStyle = this[this.selectedIndex].text;
            if (cssLink && newStyle) {
                var newUrl = amt_ajax_obj.theme_css_url + newStyle + ".css";
                cssLink.setAttribute('href',newUrl);

                $.post(
                    amt_ajax_obj.ajax_url,
                    {
                        'action': 'amt_set_theme',
                        'theme': newStyle,
                    },
                    function(response,status) {
                        console.log('Status: ' . status);
                        if (response.message) {
                            console.log('Message: ' + response.message);
                        }
                    }
                );
            }
        });
});
