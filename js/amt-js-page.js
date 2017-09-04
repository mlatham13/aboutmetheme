/*
    JavaScript functions strictly for the JavaScript page
*/
var amt_used_answers = [];
// Setup question #2 from the answer from question #1
function amt_js_answer_from_Q1( _answer ) {
    if (!_answer) {
        console.log("Yikes! Someone called amt_js_answer_from_Q1 without an answer.");
        return;
    }
    // Fade out unselected options
    var nodeListQ1 = document.getElementsByName("Q1");
    for (i = 0; i < nodeListQ1.length; i++) {
        var rBtn = nodeListQ1[i];
        if (_answer != rBtn.value) {
            var labelId = rBtn.id + "-label";
            var rLbl = document.getElementById(labelId);
            if (rLbl) {
                amt_js_hide(rLbl,1);
            }
            amt_js_hide(rBtn,1);
        }
    }

    // Start next question
    var jsPage = document.getElementById('js-page');
    var qBlock = document.getElementById('js-q2');
    if (!qBlock) {
        qBlock = document.createElement("DIV");
        qBlock.id = "js-q2";
        qBlock.setAttribute("class","amt-anim-fade-in-3");
        qBlock.style.marginBottom = "10px";
    }
    var choices = [];
    var idx = 0;
    choices[idx++] = {text:"And your answer is...",value:"none"};
    var msg = amt_js_get_choices(_answer,choices);

    var selLabel = amt_js_label('js-q2-label',msg,'5px');
    var selA2 = amt_js_selection('js-sel','Q2',choices);

    qBlock.appendChild(selLabel);
    qBlock.appendChild(document.createElement('br'));
    qBlock.appendChild(selA2);
    jsPage.appendChild(qBlock);
    document.body.scrollTop = document.body.scrollHeight;
}

// Setup question #3 from the answer from question #2
function amt_js_answer_from_Q2( _answer ) {
    if (!_answer) {
        console.log("Yikes! Someone called amt_js_answer_from_Q1 without an answer.");
        return;
    }
    // Disable the selection, since the user made their choice!
    var nodeListQ1 = document.getElementsByName("Q2");
    if (nodeListQ1[0]) {
        nodeListQ1[0].setAttribute('disabled',true);
    }
    // Start next question
    var jsPage = document.getElementById('js-page');
    var qBlock = document.getElementById('js-q3');
    if (!qBlock) {
        qBlock = document.createElement("DIV");
        qBlock.id = "js-q3";
        qBlock.setAttribute("class","amt-anim-fade-in-3");
        qBlock.style.marginBottom = "10px";
    }
    var choices = [];
    var msg = amt_js_get_choices(_answer,choices);
    var blockMsg = amt_js_label('js-q3-label',msg,'5px');
    qBlock.appendChild(blockMsg);
    qBlock.appendChild(document.createElement('br'));
    for (var i = 0; i < choices.length; i++ ) {
        var id = "btn-" + i;
        var btn = amt_js_button(id, "Q3", choices[i].value, choices[i].text);
        qBlock.appendChild(btn);
    }
    jsPage.appendChild(qBlock);
    document.body.scrollTop = document.body.scrollHeight;
}

function amt_js_answer_from_Q3( _answer ) {
    q3Block = document.getElementById("js-q3");
    amt_js_disable_div(q3Block);
    var choices = [];
    var msg = amt_js_get_choices(_answer,choices);
    if (msg == "restart") {
        return;
    }
    // Start next question
    var jsPage = document.getElementById('js-page');
    var qBlock = document.getElementById('js-q4');
    if (!qBlock) {
        qBlock = document.createElement("DIV");
        qBlock.id = "js-q4";
        qBlock.setAttribute("class","amt-anim-fade-in-3");
        qBlock.style.marginBottom = "10px";
    }
    var blockMsg = amt_js_label('js-q4-label',msg,'5px');
    qBlock.appendChild(blockMsg);
    qBlock.appendChild(document.createElement('br'));
    var blockChk = document.createElement("DIV");
    blockChk.style.margin = '5px';
    for (var i = 0; i < choices.length; i++ ) {
        var id = "chk-" + i;
        var btn = amt_js_checkbox(id, "Q4", choices[i].value, choices[i].text);
        blockChk.appendChild(btn);
        blockChk.appendChild(document.createElement('br'));
    }
    qBlock.appendChild(blockChk);
    jsPage.appendChild(qBlock);
    document.body.scrollTop = document.body.scrollHeight;

}

function amt_js_answer_from_Q4( _answer ) {
    prevBlock = document.getElementById("js-q4");
    amt_js_disable_div(prevBlock);
    var choices = [];
    var msg = amt_js_get_choices(_answer,choices);
    if (msg == "restart") {
        return;
    }
    // Start next question
    var jsPage = document.getElementById('js-page');
    var qBlock = document.getElementById('js-q5');
    if (!qBlock) {
        qBlock = document.createElement("DIV");
        qBlock.id = "js-q5";
        qBlock.setAttribute("class","amt-anim-fade-in-3");
        qBlock.style.marginBottom = "10px";
    }
    var blockMsg = amt_js_label('js-q5-label',msg,'5px');
    qBlock.appendChild(blockMsg);
    qBlock.appendChild(document.createElement('br'));
    var blockOl = document.createElement("DIV");
    blockOl.style.margin = '5px';

    var olElement = document.createElement("OL");
    for (var i = 0; i < choices.length; i++ ) {
        var id = "js-li-q5-" + i;
        var li = amt_js_li(id, "Q5", choices[i].value, choices[i].text);
        olElement.appendChild(li);
    }
    blockOl.appendChild(olElement);
    qBlock.appendChild(blockOl);
    jsPage.appendChild(qBlock);
    document.body.scrollTop = document.body.scrollHeight;
}

function amt_js_answer_from_Q5( _answer ) {
    prevBlock = document.getElementById("js-q5");
    amt_js_disable_div(prevBlock);
    var choices = [];
    var msg = amt_js_get_choices(_answer,choices);
    if (msg == "restart") {
        return;
    }
    // Start next question
    var jsPage = document.getElementById('js-page');
    var qBlock = document.getElementById('js-q6');
    if (!qBlock) {
        qBlock = document.createElement("DIV");
        qBlock.id = "js-q6";
        qBlock.setAttribute("class","amt-anim-fade-in-3");
        qBlock.style.marginBottom = "10px";
    }
    var blockMsg = amt_js_label('js-q6-label',msg,'5px');
    qBlock.appendChild(blockMsg);
    qBlock.appendChild(document.createElement('br'));
    var blockChk = document.createElement("DIV");
    blockChk.style.margin = '5px';
    for (var i = 0; i < choices.length; i++ ) {
        var id = "js-img-q6" + i;
        var img = amt_js_img(id, "Q6", choices[i].value, choices[i].text);
        blockChk.appendChild(img);
    }
    qBlock.appendChild(blockChk);
    jsPage.appendChild(qBlock);
    document.body.scrollTop = document.body.scrollHeight;
}

// Ending answer handler to vary animation
function amt_js_answer_from_Qx( _name, _answer ) {
    var x = _name.replace("Q","");
    prevBlock = document.getElementById("js-q"+x);
    amt_js_disable_div(prevBlock);
    var choices = [];
    var msg = amt_js_get_choices(_answer,choices);
    if (msg == "restart") {
        return;
    }
    var n = parseInt(x) + 1;
    var nAnimation = amt_js_get_animation(n);
    // Start next question
    var jsPage = document.getElementById('js-page');
    var qBlock = document.getElementById('js-q'+n);
    if (!qBlock) {
        qBlock = document.createElement("DIV");
        qBlock.id = "js-q"+n;
        qBlock.setAttribute("class",nAnimation);
        qBlock.style.marginBottom = "10px";
    }
    var blockMsg = amt_js_label('js-q'+n+'-label',msg,'5px');
    qBlock.appendChild(blockMsg);
    qBlock.appendChild(document.createElement('br'));
    var blockChk = document.createElement("DIV");
    blockChk.style.margin = '5px';
    for (var i = 0; i < choices.length; i++ ) {
        var id = "js-img-q"+n+"-" + i;
        var img = amt_js_img(id, "Q"+n, choices[i].value, choices[i].text);
        blockChk.appendChild(img);
    }
    qBlock.appendChild(blockChk);
    jsPage.appendChild(qBlock);
    document.body.scrollTop = document.body.scrollTop + 100;
}

// Create and return a button for the given choice object
function amt_js_button(_id, _name, _value, _text) {
    var btn = document.createElement("BUTTON");
    btn.id = _id;
    btn.innerText = _text;
    btn.setAttribute("type","button");
    btn.setAttribute("class","js-img-button");
    btn.setAttribute("name",_name);
    btn.setAttribute("value",_value);
    btn.setAttribute('onclick', 'amt_js_next_question(this)');

    return btn;
}

// Create and return a checkbox for the given choice object
function amt_js_checkbox(_id, _name, _value, _text) {
    var chk = document.createElement("INPUT");
    chk.id = _id;
    chk.setAttribute("type","checkbox");
    chk.setAttribute("class","js-checkbox");
    chk.setAttribute("name",_name);
    chk.setAttribute("value",_value);
    chk.setAttribute('onclick', 'amt_js_next_question(this)');

    var chkLabel = document.createElement("LABEL");
    chkLabel.id = _id + "-lbl";
    chkLabel.innerText = _text;
    chkLabel.setAttribute("class","js-checkbox-label");
    chkLabel.appendChild(chk);

    return chkLabel;
}

// Disable children and events
// Recursive
function amt_js_disable_div( _div ) {
    var spawn = _div.children;
    if (!spawn) {
        return;
    }
    for (var i = 0; i < spawn.length; i++) {
        var nextGen = spawn[i].children;
        if (nextGen && nextGen.length > 0) {
            amt_js_disable_div(spawn[i]);
        } else {
            if (typeof spawn[i].disabled === "boolean") {
                spawn[i].disabled = true;
            }
            if (spawn[i].hasAttribute("onclick")) {
                spawn[i].removeAttribute("onclick");
            }
        }
    }
}

// Get the name of the animation for the given index
function amt_js_get_animation( _idx ) {
    var name = "";
    switch(_idx) {
        case 7:
            name = "amt-anim-slide-right-3";
            break;
        case 8:
            name = "amt-anim-slide-bottom-3";
            break;
        case 9:
            name = "amt-anim-whirl-3";
            break;
        default:
            name = "amt-anim-fade-in-3";
    }
    return name;
}

// Given an answer, get the next round of choices
function amt_js_get_choices( _answer, _choices ) {
    amt_used_answers.push(_answer);
    var msg;
    var postMsg = " What do you do next?";
    var idx = _choices.length; // below, idx will be returned first, then incremented
    switch(_answer) {
        case "ringbell":
            msg = "You ring the bell and suddenly the meadow begins to swirl. ";
            msg += "The meadow slowly starts to dissipate, your eyelids become ";
            msg += "very heavy. As you slowly blink your eyes, the meadow is replaced ";
            msg += "with your bedroom. The morning alarm continues to ring...";
            postMsg = "";
            _choices[idx++] = {text:"Restart",value:"restart"};
            break;
        case "gotobell":
            msg = "The bell appears to be silver, and is bright and shiny. A little, ";
            msg += "gold, braided rope hangs from the ball.";
            postMsg = "";
            _choices[idx++] = {text:"Ring The Bell",value:"ringbell"};
            if (amt_used_answers.indexOf("exploremeadow") < 0) {
                _choices[idx++] = {text:"Explore",value:"exploremeadow"};
                postMsg = " What do you decide to do now?";
            }
            break;
        case "exploremeadow":
            msg = "The meadow is vibrant with color as wildflowers carpet the floor. ";
            msg += "You see an occasional rabbit hop about, keeping just out of reach. ";
            msg += "A doe and her fawn appear at the edge of the meadow, stop and watch you ";
            msg += "from a safe, but curious distance. Butterflies flit about, and you could ";
            msg += "swear that some twinkle and their bodies seem to have a human appearance.";
            postMsg = "";
            _choices[idx++] = {text:"Go To Bell",value:"gotobell"};
            break;
        case "walkin":
            msg = "The swirling mist moves about you, but gives no sensation - ";
            msg += "not wet, nor hot nor cold. It slowly dissipates and you find yourself ";
            msg += "standing in a forest of pine and oak trees, your back to a tall cliff, and a path stretching ";
            msg += "off into the trees.";
            postMsg = "";
            if (amt_used_answers.indexOf("walkpath") < 0) {_choices[idx++] = {text:"Walk",value:"walkpath"};}
            break;
        case "walkpath":
            msg = "The path winds its way through the trees. The understory is bright with flowers and berry bushes. ";
            msg += " Up ahead, you see an opening in the trees. You arrive at a small meadow, beautiful with wildflowers ";
            msg += " and tall grass. In the middle stands a tripod with a bell attached to it."
            if (amt_used_answers.indexOf("exploremeadow") < 0) {
                _choices[idx++] = {text:"Explore",value:"exploremeadow"};
            }
            if (amt_used_answers.indexOf("gotobell") < 0) {
                _choices[idx++] = {text:"Go To Bell",value:"gotobell"};
            }
            break;
        case "reachin":
            msg = "Your hand disappears into the mist, but gives no sensation - ";
            msg += "not wet, nor hot nor cold.";
            if (amt_used_answers.indexOf("walkin") < 0) {
                _choices[idx++] = {text:"Walk In",value:"walkin"};
            }
            if (amt_used_answers.indexOf("lookbehind") < 0) {
                _choices[idx++] = {text:"Look Behind It",value:"lookbehind"};
            }
            if (amt_used_answers.indexOf("callfunnyfarm") < 0) {
                _choices[idx++] = {text:"Call Mental Hospital",value:"callfunnyfarm"};
            }
            if (amt_used_answers.indexOf("runaway") < 0) {
                _choices[idx++] = {text:"Run Away",value:"runaway"};
            }
            break;
        case "runaway":
            msg = "You spin around and begin running. You feel like you're running through molassas. ";
            msg += "The the image of the impossible door flashes through your mind, but some adventures ";
            msg += "just aren't worth the risk.";
            postMsg = "";
            _choices[idx++] = {text:"Restart",value:"restart"};
            break;
        case "callfunnyfarm":
            msg = "After a few rings, a nurse picks up and says, 'Gentle Adjustments, this is Nurse Betty. ";
            msg += "How may I assist you?'";
            postMsg = "What do you say?";
            if (amt_used_answers.indexOf("vhdoctor") < 0) {
                _choices[idx++] = {text:"Somebody get me a doctor!",value:"vhdoctor"};
            }
            if (amt_used_answers.indexOf("rattinsane") < 0) {
                _choices[idx++] = {text:"I'm insane!",value:"rattinsane"};
            }
            if (amt_used_answers.indexOf("ozzycrazytrain") < 0) {
                _choices[idx++] = {text:"I'm on a crazy train!",value:"ozzycrazytrain"};
            }
            break;
        case "openit":
            msg = "You brave soul! Through the door is not the sandy beach, but a swirling grey mist.";
            msg += " Very tall cone shapes can just faintly be seen.";
            posgMsg = " What do you dare to do now?";
            if (amt_used_answers.indexOf("walkin") < 0) {
                _choices[idx++] = {text:"Walk Through Door",value:"walkin"};
            }
            if (amt_used_answers.indexOf("reachin") < 0) {
                _choices[idx++] = {text:"Reach Through Door",value:"reachin"};
            }
            if (amt_used_answers.indexOf("runaway") < 0) {
                _choices[idx++] = {text:"Run Away",value:"runaway"};
            }
            if (amt_used_answers.indexOf("callfunnyfarm") < 0) {
                _choices[idx++] = {text:"Call Mental Hospital",value:"callfunnyfarm"};
            }
            break;
        case "touchit":
            msg = "Despite the warm sun, the door feels cool to the touch. It seems to ";
            msg += "lightly vibrate and shimmer...but you're not sure."
            if (amt_used_answers.indexOf("openit") < 0) {
                _choices[idx++] = {text:"Open It",value:"openit"};
            } else {
                _choices[idx++] = {text:"Walk Through Door",value:"walkin"};
            }
            if (amt_used_answers.indexOf("lookbehind") < 0) {
                _choices[idx++] = {text:"Look Behind It",value:"lookbehind"};
            }
            if (amt_used_answers.indexOf("callfunnyfarm") < 0) {
                _choices[idx++] = {text:"Call Mental Hospital",value:"callfunnyfarm"};
            }
            if (amt_used_answers.indexOf("runaway") < 0) {
                _choices[idx++] = {text:"Run Away",value:"runaway"};
            }
            break;
        case "lookbehind":
            msg = "Peeking around the door frame, you see the backside of the door and the sandy beach";
            msg += " stretching off into the distance."
            if (amt_used_answers.indexOf("openit") < 0) {
                _choices[idx++] = {text:"Open It",value:"openit"};
            } else {
                _choices[idx++] = {text:"Walk Through Door",value:"walkin"};
            }
            if (amt_used_answers.indexOf("touchit") < 0) {
                _choices[idx++] = {text:"Touch It",value:"touchit"};
            }
            if (amt_used_answers.indexOf("callfunnyfarm") < 0) {
                _choices[idx++] = {text:"Call Mental Hospital",value:"callfunnyfarm"};
            }
            if (amt_used_answers.indexOf("runaway") < 0) {
                _choices[idx++] = {text:"Run Away",value:"runaway"};
            }
            break;
        case "emaildev":
            amt_alert("TODO - Email page or panel.");
            break;
        case "vhdoctor":
        case "rattinsane":
        case "ozzycrazytrain":
            var song = document.getElementById(_answer);
            if (song) {
                song.play();
                song.setAttribute("controls",true);
            }
            msg = "As the song echos out of nowhere, you slowly wake up to find your";
            msg += " hotel clock radio has gone off..."
            postMsg = "";
            _choices[idx++] = {text:"Restart Story",value:"restart"};
            break;
        case "restart":
            location.reload();
            msg = "restart";
            postMsg = "";
            break;
        default:
            msg = "Do what now? Sorry, I don't know what to do with '" + _answer + " '. ";
            postMsg = "Please select from the following.";
            _choices[idx++] = {text:"Restart Story",value:"restart"};
            _choices[idx++] = {text:"Email Developer",value:"emaildev"};
    }
    msg += postMsg;

    return msg;
}

// Get the start of the story
function amt_js_get_text_Q1() {
    var txt = "You find yourself walking along a white, sandy beach. Up ahead, you see what looks like "
            + "a framed door standing up in the sand. As you approach, you find that the door is, "
            + " indeed, standing on its own. You reach the door - what do you do?";

    return txt;
}

// Hide the given field
function amt_js_hide( _field, _fade ) {
    if (_fade) {
        _field.setAttribute('class',_field.getAttribute('class') + ' amt-anim-fade-out-2');
    } else {
        _field.setAttribute('class',_field.getAttribute('class') + ' hidden');
    }
}

// Create an image input
function amt_js_img( _id, _name, _value, _text ) {
    var img = document.createElement("INPUT");
    var src = amt_js_obj.image_url + _value + ".png";
    img.id = _id;
    img.setAttribute("type","image");
    img.setAttribute("class","js-image");
    img.setAttribute("name",_name);
    img.setAttribute("value",_value);
    img.setAttribute("onclick", "amt_js_next_question(this)");
    img.setAttribute("alt",_text);
    img.setAttribute("title",_text);
    img.setAttribute("onerror", "amt_js_img_error(this)");
    img.setAttribute("src",src);
    return img;
}

function amt_js_img_error(_img) {
    var src = amt_js_obj.image_url + "notfound.png";
    _img.setAttribute("src",src);
    return _img;
}

// Create a label element with the given ID and text
function amt_js_label(_id, _text, _margin, _for) {
    if (!_margin) {
        _margin = '0px';
    }
    var lbl = document.createElement("LABEL");
    lbl.id = _id;
    lbl.innerHTML = _text;
    lbl.style.margin = _margin;
    if (_for) {
        lbl.setAttribute("for",_for);
    }
    return lbl;
}

// Create a line item for a list
function amt_js_li(_id, _name, _value, _text) {
    var li = document.createElement("LI");
    li.id = _id;
    li.name = _name;
    li.setAttribute("value",_value);
    li.innerText = _text;
    li.setAttribute("onclick", "amt_js_next_question(this)");
    li.setAttribute("type","circle");
    li.style.cursor = "pointer";
    return li;
}

// Given the component which contains the answer, invoke
// the next question setup function
function amt_js_next_question( _component ) {
    if (!_component) {
        console.log('Yikes! Someone called amt_js_next_question without telling who they are.')
        return;
    }
    if (!_component.type) {
        console.log('Yikes! Someone called amt_js_next_question without telling what they are.')
        return;
    }
    if (_component.type == "select-one") {
        var fnCall = "amt_js_answer_from_"+_component.name + "('"+_component[_component.selectedIndex].value+"')";
        eval(fnCall);
        return;
    }

    // Default function call
    var fnName = "amt_js_answer_from_" + _component.name;
    var fnCall = fnName + "('"+_component.getAttribute("value")+"')";
    if (typeof window[fnName] !== "function") {
        fnCall = "amt_js_answer_from_Qx" + "('"+_component.name+"','"+_component.value+"')";
    }
    eval(fnCall);
    return;
}

// Create a radio button with the given ID and text
function amt_js_radio_button ( _id, _name, _value ) {
    var rBtn = document.createElement("INPUT");
    rBtn.id   = _id;
    rBtn.setAttribute('type','radio');
    rBtn.setAttribute('name',_name);
    rBtn.setAttribute('value',_value);
    rBtn.setAttribute('onclick', 'amt_js_next_question(this)');

    return rBtn;
}

// Create and return a select field with the options given in the
// choices object
function amt_js_selection( _id, _name, _choices ) {
    var sel = document.createElement("SELECT");
    sel.id = _id;
    sel.name = _name;
    for (var i = 0; i < _choices.length; i++) {
        var opt = document.createElement("OPTION");
        opt.id = _id + "-opt-" + i;
        opt.value = _choices[i].value;
        opt.text = _choices[i].text;
        sel.appendChild(opt);
    }

    sel.style.marginTop = '10px';
    sel.style.marginBottom = '10px';
    sel.setAttribute("onchange","amt_js_next_question(this)");

    return sel;
}

// Show the given field
function amt_js_show( _field, _fade ) {
    var fieldClass = "";
    if (_field.getAttribute('class')) {
        fieldClass = _field.getAttribute('class');
    }
    if (_fade) {
        var modClass = fieldClass.replace(' amt-anim-fade-out-2',' amt-anim-fade-in-2');
    } else {
        var modClass = fieldClass.replace(' hidden','');
    }
    _field.setAttribute('class',modClass);
}

// Start button click handler
function amt_js_start() {
    var jsPage = document.getElementById('js-page');
    var jsStart = document.getElementById('js-start');

    // Intro block
    var newBlock = document.getElementById('js-intro');
    if (!newBlock) {
        newBlock = document.createElement("DIV");
        newBlock.id = "js-intro";
        newBlock.setAttribute('class','col-12');
        newBlock.style.marginBottom = "10px";
        var textArea = document.createElement("TEXTAREA");
        textArea.setAttribute('readonly','');
        textArea.setAttribute('class','js-page-field col-12');
        var spiel = "Alrighty, then. Let's have a little fun. You'll be asked a series of questions,";
        spiel += " and your responses will guide the way.";
        textArea.value = spiel;

        var songSrc = ["ozzycrazytrain","rattinsane","vhdoctor"];
        for (var i = 0; i < songSrc.length; i++) {
            var id = songSrc[i];
            var song = document.createElement("AUDIO");
            song.id = id;
            var src = amt_js_obj.audio_url+id+".mp3";
            song.setAttribute("src",src);
            song.setAttribute("type","audio/mp3'");
            song.setAttribute("preload","auto");
            song.setAttribute("class","js-audio");
            newBlock.appendChild(song);
        }

        newBlock.appendChild(textArea);
        jsPage.appendChild(newBlock);
    } else {
        amt_js_show(newBlock);
    }
    amt_js_hide(jsStart);

    // First question
    var qBlock = document.getElementById('js-q1');
    if (!qBlock) {
        qBlock = document.createElement("DIV");
        qBlock.id = "js-q1";
        qBlock.setAttribute("class","amt-anim-fade-in-3");
        qBlock.style.marginBottom = "10px";

        var q1Txt = amt_js_label("js-q1-label", amt_js_get_text_Q1());
        var rOpt1 = amt_js_radio_button("js-rbtn1","Q1","openit");
        var lOpt1 = amt_js_label("js-rbtn1-label","Open it","5px","js-rbtn1");
        var rOpt2 = amt_js_radio_button("js-rbtn2","Q1","lookbehind");
        var lOpt2 = amt_js_label("js-rbtn2-label","Look behind it","5px","js-rbtn2");
        var rOpt3 = amt_js_radio_button("js-rbtn3","Q1","touchit");
        var lOpt3 = amt_js_label("js-rbtn3-label","Touch it","5px","js-rbtn3");
        var rOpt4 = amt_js_radio_button("js-rbtn4","Q1","callfunnyfarm");
        var lOpt4 = amt_js_label("js-rbtn4-label","Call the mental hospital","5px","js-rbtn4");

        qBlock.appendChild(q1Txt);
        qBlock.appendChild(document.createElement('br'));
        qBlock.appendChild(document.createElement('br'));
        qBlock.appendChild(rOpt1);
        qBlock.appendChild(lOpt1);
        qBlock.appendChild(document.createElement('br'));
        qBlock.appendChild(rOpt2);
        qBlock.appendChild(lOpt2);
        qBlock.appendChild(document.createElement('br'));
        qBlock.appendChild(rOpt3);
        qBlock.appendChild(lOpt3);
        qBlock.appendChild(document.createElement('br'));
        qBlock.appendChild(rOpt4);
        qBlock.appendChild(lOpt4);

        jsPage.appendChild(qBlock);
    }
}
