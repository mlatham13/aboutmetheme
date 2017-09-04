/*
    aboutmetheme JavaScript functions
*/

// Simply alert the user to a message
function amt_alert(_text) {
    if (_text && _text.length > 0) {
        alert(_text);
    } else {
        alert('HELLO!');
    }
}

// Change cursor to indicate processing
function amt_busy() {
    document.body.style.cursor = 'wait';
}

// Change the cursor back to default after processing
function amt_not_busy() {
    document.body.style.cursor = 'default';
}

// Handler for title selection to load info title and info
// into the detail section (ws-aws.php)
function amt_title_onclick(_title, _info) {
    var titleElem = document.getElementById("infoTitle");
    var textElem  = document.getElementById("infoData");

    if (titleElem) {
        titleElem.setAttribute("value",_title);
    }
    if (textElem) {
        textElem.setAttribute("value",_info);
        textElem.textContent = _info;
    }
}
