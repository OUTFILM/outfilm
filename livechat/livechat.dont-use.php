<?php
//
// Livechat by Doug Lee (c) 2015
//

// livechat db
// - message_id
// - user_id : user must be registered and logged in
// - content : UTF-8 content of the message (filtered and encoded). Can accept [bbcode] tags and emojis.
// - datetime
// - status : can have different messages, such as content-type. If status is 'normal', then it is text.

// livechat_stat db
// - chat_id : can have more than one chat, possibly.
// - chat_name 
// - num_users : keeps count of the number of people ENGAGED in chat (activity within past 5 minutes)
// - num_views : keeps count of number of people watching the chat, or people on the page itself (including guests)
// - user_list : list of user_ids currently ENGAGED in chat separated by pipe char |
// - ...other vars to come up with...

session_start();      	// Remove if already called previously in another script 
include "../config.php";	// DB PDO config only

?>
<html>
	<head>
	<meta charset="UTF-8">
	<title>LiveChat</title>
	
	<!--<link rel="stylesheet" type="text/css" href="/scripts/jquery-ui-themes-1.11.4/themes/dark-hive/jquery-ui.css">-->	
	<script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>
	<!--<script type="text/javascript" src="/scripts/jquery-ui-1.11.4/jquery-ui.js"></script>-->
	<script type="text/javascript" src="/scripts/jquery.transit.min.js"></script>
	
	<link rel="stylesheet" href="/scripts/jqwidgets/styles/jqx.base.css" type="text/css" />
	<link rel="stylesheet" href="/scripts/jqwidgets/styles/jqx.metrodark.css" type="text/css" />
    <script type="text/javascript" src="/scripts/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqxdropdownbutton.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqxcolorpicker.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqxwindow.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqxeditor.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqxtooltip.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqxcheckbox.js"></script>
	
	<link rel="stylesheet" href="/img/icon/silk-icons/jquery-silk-icons.css" type="text/css" />
	
	<link rel="stylesheet" href="livechat.css" type="text/css" />
</head>
<body>

<div id="livechat_update_box">	
</div>

<textarea id="livechatbox">
	
</textarea>
<button id="livechatsend"> 发送 </button>



<script>

var emoji = '/livechat/emoji/riceball/';

var emojiGroup = { 
	 "&gt;:)" : 'Naughty' ,
	 'o:)': 	'Angel' ,
	 '&gt;:(':  'VeryAngry' ,
	 ':)': 		'Smile' ,
	 ':(': 		'Frown' ,
	 ':x': 		'Kiss' ,
	 '-_-': 	'Ambivalent' ,
	 ':$': 		'Blush' ,
	 ':s': 		'Confused' ,
	 '@_@': 	'Confused' ,
	 '&gt;:|':	'Angry' ,
	 ':@': 		'Crazy' ,
	 ":'(": 	'Crying' ,
	 "T_T": 	'Crying' ,
	 ":E": 		'Foot In Mouth' ,
	 "o.o": 	'Gasp' ,
	 ":]": 		'Grin' ,
	 "8)": 		'Halo' ,
	 "&lt;3": 	'Heart' ,
	 "B)": 		'Hot' ,
	 ":o": 		'LargeGasp' ,
	 "&gt;.&lt;": 	'ohnoes' ,
	 "o_o": 	'Sarcastic' ,
	 ":p": 		'Sticking Out Tongue' ,
	 ":/": 		'Undecided' ,
	 ":\\": 	'Undecided' ,
	 ";)": 		'Wink' ,
	 ":3": 		'Yum' ,
	 ":D":  	'Laugh'
};

var htmlTagGroup = {
	"[u]" : 	'<span style="text-decoration: underline">',
	"[/u]" : 	'</span>',	
	"[i]" : 	'<em>',
	"[/i]" : 	'</em>',
	"[b]" : 	'<b>',
	"[/b]" : 	'</b>'
};


// Start loop when page is ready
$(document).ready(function () {

<?php // Get last 10 messages
	$query = "SELECT * FROM (SELECT * FROM livechat ORDER BY message_id DESC LIMIT 10) AS t ORDER BY message_id ASC"; // Get the last ten messages into chat to start
	if ($stmt = $pdo->prepare($query)) {
	    $stmt->execute();
	    $stmt->bindColumn('user_id', $chat_user_id);
		$stmt->bindColumn('content', $chat_content);
		$stmt->bindColumn('message_id', $last_id);
	    while ($stmt->fetch()) {
			 ?> chatPop('<?=$chat_user_id?>', '<?=htmlentities($chat_content)?>'); <?
	    }	
		$pdo = null; // Remove connection immediately
		$_SESSION["livechat_last_message_id"] = $last_id; // Last msg - Use session var for security.
	}
?>	
	
livechatLoop();

// Load chat box editor
$("#livechatbox").jqxEditor({
	height: 100,
	theme: 'metrodark',
	tools: 'bold italic underline | color | emoji',
	localization: {
        "bold": "粗体",
        "italic": "斜体",
        "underline": "强调",
        "color": "字体颜色"
    },	
	createCommand: function (name) {
		switch (name) {
			case "emoji":
				return {
					type: 'list',
					tooltip: '背景颜色',
					init: function (widget) {
                        widget.jqxDropDownButton({ width: 44 });
                        widget.jqxDropDownButton('setContent', '<span style="line-height: 24px;"><img style="margin-top: 3px;" src="/livechat/emoji/riceball/Grin.png" /></span>');
                    	/* widget.jqxDropDownButton({ source: ['A', 'B' , 'C']}); */
                    },
                    refresh: function (widget, style) {
	                    // do something here when the selection is changed.
                    },
	                action: function (widget, editor) {
	                    // return nothing and perform a custom action.
	                    //var color = widget.val();
	                    //editor.transition({backgroundColor: color}, 'slow');
	                }
				}
		}
	} 
});

$("#livechatbox").val(""); // Clear the editor of any rogue div's

}); // End of loading document check

// Enter a continuous loop that checks live chat at regular intervals
function livechatLoop() {
	$.ajax({
		cache: false,
		url: "livechat_loop.php",
		data: { update: 1 },
		dataType: "json",
		success: function(result) { // We may have new chat msgs to add...	(may take up to 1 min)				
			//var result = $.getJSON(msg);        	
			if (result.status != 0) {
	        	$.each(result, function(key,value) { 		
	        		chatPop(value.user_id, value.content);
				});
			}		
			setTimeout(livechatLoop, 200); // Update chat every 200 milliseconds (x 30 seconds long polling script).			
		}
	});
}

function chatPop(user_id, content) {
	var content = filterChat(content);
	var $new = $('<div class="chatmsg"><img class="livechat_avatar" src="/scripts/img.php?src=../img/avatar/cat.jpg&amp;w=100&amp;h=100" /><div><p><strong>User '+user_id+'</strong></p><p>'+content+'</p></div></div>');		
	$("#livechat_update_box")			
		.append($new.css("opacity", 0))
		.animate({ 
			scrollTop: $('#livechat_update_box')[0].scrollHeight }, 
			5, 
			function() {
				$new.transition({ y: '-15px', 'opacity': 1, 'easing': 'in' }, 500);	
			}
		);			
}

function escapeRegExp(str) {
	return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
}

function filterChat(content) {	
	// Convert emojis to images
	$.each(emojiGroup, function(a, b) {
		a = escapeRegExp(a);
		var re = new RegExp(a, "gi");
		content = content.replace(re, '<img src="'+emoji+b+'.png" />' );
	});

	// Convert allowable formatting to html tags
	$.each(htmlTagGroup, function(a, b) {
		a = escapeRegExp(a);
		var re = new RegExp(a, "gi");
		content = content.replace(re, b);
	});
	
	return content;
}

$("#livechatsend").click(sendMsg);
$("#livechatbox").keypress(function(e) {
	if(e.which == 13) {
		sendMsg();
	}
});

function sendMsg() {
	var myMsg = $('#livechatbox').val();
	
	$.ajax({
		cache: false,
		method: "GET",
		url: "livechat_send.php",
		data: {
			'send' : "1",
			'message' : myMsg }
		})
		.done(function(msg) { // Msg sent successfully
			$("#livechatbox").val("");
		});
}

</script>
</body></html>