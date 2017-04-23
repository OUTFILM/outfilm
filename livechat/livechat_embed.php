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

//session_start();      	// Remove if already called previously in another script 
//include "config.php";	// DB PDO config only




?>
<!--	
<div id="livechat_update_box">	</div>
<? // only show textbox if we're logged in; if we're not logged in, offer login link 
if (isset($_SESSION["Is_Login"])) { // We're logged, we have session stuff ?>
	<div id="chatToolBar"></div>
	<!--<div id="livechatColorPicker"></div>-->
	<!--<textarea id="livechatbox"></textarea>-->
	<!--<button id="livechatsend"> 发送 </button>-->
<? } else { ?>
	<div style="text-align: center;">
		<!--<a href="/user/login.php" style="text-decoration: none;" class="unicorn">登录加入聊天室</a>-->
		<span style="font-size: 60px; font-family: 'PingFang-Regular';" class="unicorn">聊天室中删除，因为有人想新闻，而不是社会生活。笨狗。</span>
	</div>
<? } ?>

<script type="text/javascript">
var myColor = "";

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
	// ":/": 		'Undecided' ,
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
	"[/b]" : 	'</b>',
	'&lt;span style=&quot;text-decoration: underline;&quot;&gt;' : '<span style="text-decoration: underline">',
	'&lt;/span&gt;' : '</span>',
	'&lt;span style=&quot;font-style: italic;&quot;&gt;' : '<span style="font-style: italic">',
	'&lt;span style=&quot;font-weight: bold;&quot;&gt;' : '<span style="font-weight: bold">',
	'&lt;span style=&quot;color:' : '<span style="color:',
	'&quot;&gt;' : '">',
	'&lt;br&gt;'   : '<br />',
	'&lt;br /&gt;'   : '<br />',
	'&lt;div&gt;'  : '',
	'&lt;/div&gt;' : '',
	'&lt;u&gt'     : '<u>',
	'&lt;/u&gt'     : '</u>', 
	'&lt;em&gt'     : '<em>',
	'&lt;/em&gt'     : '</em>',
	'&lt;b&gt'     : '<b>',
	'&lt;/b&gt'     : '</b>',
	'&lt;strong&gt'     : '<strong>',
	'&lt;/strong&gt'     : '</strong>',
	'&lt;font color=&quot;'     : '<font color="',
	'&lt;/font&gt'     : '</font>',
	'&lt;/span&gt'     : '</span>',
};


// Start loop when page is ready
$(document).ready(function () {

<?php // Get last 10 messages
	$query = "SELECT * FROM (SELECT * FROM livechat ORDER BY message_id DESC LIMIT 10) AS t ORDER BY message_id ASC"; // Get the last ten messages into chat to start
	if ($stmt = $pdo->prepare($query)) {
	    $stmt->execute();
	    $stmt->bindColumn('user_id', $chat_user_id);
	    //stmt->bindColumn('user_name', $chat_user_name);
	    // $stmt->bindColumn('avatar', $chat_avatar);
		$stmt->bindColumn('content', $chat_content);
		$stmt->bindColumn('message_id', $last_id);
		$stmt->bindColumn('datetime', $datetime);
	    while ($stmt->fetch()) {
			$sql = "SELECT Portrait_Id,User_Name FROM users WHERE User_Id=:user_id";
			$stmt_users = $pdo->prepare($sql);
			$stmt_users->bindParam(':user_id', $chat_user_id);
			$stmt_users->execute();
			$stmt_users->bindColumn('Portrait_Id', $chat_avatar);
			$stmt_users->bindColumn('User_Name', $chat_user_name);	
			$stmt_users->fetch();	
			
			// Get proper datetime  ISO 8601
			$dt = new DateTime($datetime);
				
			 ?> chatPop('<?=$chat_user_id?>', '<?=htmlentities($chat_user_name, ENT_QUOTES)?>', '<?=$chat_avatar?>', 
			 		'<?=$dt->format('c');?>',
			 		'<?=preg_replace( "/\r|\n/", "", nl2br(htmlentities($chat_content, ENT_QUOTES)))?>'); 
			 <?
	    }	
		$pdo = null; // Remove connection immediately
		$_SESSION["livechat_last_message_id"] = $last_id; // Last msg - Use session var for security.
	}
?>	
	
livechatLoop();

<? if (isset($_SESSION["Is_Login"])) { // Load chat box editor -- only if we have a session... ?>

//$("#livechatsend").click(sendMsg);
$("#livechatbox").keypress(function(event) {
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13') {
		var temp = $('#livechatbox').val();
		$(this).val('');    
		sendMsg(temp);
		return false;
	}
});

$('#livechatbox').val('');
//$("#livechatbox").empty(); // Clear the editor of any rogue div's
$("#chatToolBar").jqxToolBar({ 
	width: "418px", 
	height: 35, 
	theme: 'metrodark',
	tools: "button | button button button | button",
    initTools: function (type, index, tool, menuToolIninitialization) {
        switch (index) {
            case 0:
            	tool.html("发送");
            	tool.on("click" , function() {
                	sendMsg();
                });
            	break;
            case 1:
                tool.html("<b>B</b>");
                tool.jqxToggleButton({
                	toggled: false,
                	width: '25px'
                });
                tool.on("click" , function() {
                	$("#livechatbox").val("[b]" + $("#livechatbox").val() + "[/b]");
                });
                break;
            case 2:
            	tool.html("<span style=\"font-style: italic; font-family: Sans Serif;\">I</span>");
            	tool.jqxToggleButton({
                	toggled: false,
                	width: '25px'
                });	
                tool.on("click" , function() {
                	$("#livechatbox").val("[i]" + $("#livechatbox").val() + "[/i]");
                });
            	break;
            case 3: 
            	tool.html("<u>U</u>");
            	tool.jqxToggleButton({
                	toggled: false,
                	width: '25px'
                });
                tool.on("click" , function() {
                	$("#livechatbox").val("[u]" + $("#livechatbox").val() + "[/u]");
                });
            	break;
            case 4:
				tool.append("<div style='padding: 3px;'><div></div></div>");
                var colorPicker = tool.children().children();
                function getTextElementByColor(color) {
                    if (color == 'transparent' || color.hex == "") {
                        return $("<div style='text-shadow: none; position: relative; padding-bottom: 16px; margin-top: 0px;'>-</div>");
                    }
                    var element = $("<div style='text-shadow: none; position: relative; padding-bottom: 16px; margin-top: 0px;'> </div>");
                    var nThreshold = 105;
                    var bgDelta = (color.r * 0.299) + (color.g * 0.587) + (color.b * 0.114);
                    var foreColor = (255 - bgDelta < nThreshold) ? ' ' : ' ';
                    element.css('color', foreColor);
                    element.css('background', "#" + color.hex);
                    element.addClass('jqx-rc-all');
                    myColor = color.hex;
                    return element;
                }
                colorPicker.on('colorchange', function (event) {
                    tool.jqxDropDownButton('setContent', getTextElementByColor(event.args.color));
                    $("#shape").css("background-color", "#" + event.args.color.hex);
                });
                colorPicker.jqxColorPicker({ color: "0F2B70", colorMode: 'hue', width: 220, height: 220 });
                tool.jqxDropDownButton({ width: 50, height: 21 });
                tool.jqxDropDownButton('setContent', getTextElementByColor(new $.jqx.color({ hex: "0F2B70" })));
                break;
            case 5:
                //tool.jqxDropDownList({ width: 130, source: ["Affogato", "Breve", "Café Crema"], selectedIndex: 1 });
                break;

        }
    }
});
<? } // end loading jqxEditor ?>
}); // End of loading document check

// Enter a continuous loop that checks live chat at regular intervals
function livechatLoop() {
	$.ajax({
		cache: false,
		url: "/livechat/livechat_loop.php",
		data: { update: 1 },
		dataType: "json",
		success: function(result) { // We may have new chat msgs to add...	(may take up to 1 min)				
			//var result = $.getJSON(msg);        	
			if (result.status != 0) {
	        	$.each(result, function(key,value) { 		
	        		chatPop(value.user_id, value.user_name, value.avatar, value.datetime, value.content);
				});
			}		
			setTimeout(livechatLoop, 200); // Update chat every 200 milliseconds (x 30 seconds long polling script).			
		}
	});
}

function chatPop(user_id, user_name, avatar, datetime, content) {
	var content = filterChat(content);
	
	if (user_id == '<?=$_SESSION["User_Id"]?>') { // Show that the message came from me instead...
		var $new = $('<div class="chatmsg" style="float: right; clear: both;">' + 
		'<div class="livechat_white"><p><strong></strong> ' + 
		'&nbsp;&nbsp;<span style="color: #999; float: right; font-weight: normal;" data-livestamp="'+datetime+'"></span> </p><p style="font-weight: normal;">'+content+'</p></div>' +
		'<img style="float: right;" class="livechat_avatar" src="/uimg/'+user_id+'/'+avatar+'.png" /></div>');	
	} else {	
		var $new = $('<div class="chatmsg" style="float: left; clear: both;">' + 
		'<img class="livechat_avatar" src="/uimg/'+user_id+'/'+avatar+'.png" />' + 
		'<div class="livechat_white"><p><strong>'+user_name+'</strong> ' +
		'&nbsp;&nbsp;<span style="color: #999; float: right; font-weight: normal;" data-livestamp="'+datetime+'"></span> </p><p style="font-weight: normal;">'+content+'</p></div></div>');			
	}
	
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

function sendMsg(myMsg) {
	$('#livechatbox').val('');	
	if (myMsg != "") {
		myMsg = '<span style="color: #'+myColor+';">'+myMsg+'</span>';
		
		$.ajax({
			cache: false,
			method: "GET",
			url: "/livechat/livechat_send.php",
			data: {
				'send' : "1",
				'message' : myMsg }
			})
			.done(function(msg) { // Msg sent successfully				
			});
	}
}

var step = 2, // colorChage step, use negative value to change direction
    ms   = 20,  // loop every
    $uni = $('.unicorn'),
    txt  = $uni.text(),
    len  = txt.length,
    lev  = 360/len,
    newCont = "",
    itv;
//alert(lev+' '+len);

for(var i=0; i<len; i++)newCont += "<span style='color:hsla("+ i*lev +", 80%, 50%, 1)'>"+ txt.charAt(i) +"</span>";

$uni.html(newCont); // Replace with new content
var $ch = $uni.find('span'); // character

function anim(){
  itv = setInterval(function(){
    $ch.each(function(){
      var h = +$(this).attr('style').split(',')[0].split('(')[1]-step % 360;
      $(this).attr({style:"color:hsla("+ h +", 50%, 50%, 1)"});
    });
  }, ms); 
}
function stop(){ clearInterval(itv); }

//$uni.hover(anim,stop);
anim();

</script>


