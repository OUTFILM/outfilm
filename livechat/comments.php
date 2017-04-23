<?php
// Comments board, based on Livechat - by Doug Lee 2015
/*
 * Goals:
 * - Comments are stored in comments table, instead of livechat table
 * - Comments are sent to comment_send.php instead
 * - Comment boxes need to have timestamps
 * - Allow users to delete their own comments. Admins can delete any comment.
 * -  
 * 
 * 
 */
//if (!isset($_SESSION)) session_start();
//include $_SERVER["DOCUMENT_ROOT"]."/config.php";	// DB PDO config only

if (!isset($_GET["catlogid"])) exit; // Catlogid is absolutely required to show comments.

?>
<div id="commentContainer">
<h2>评论列表 <span id="commentsTotal"></span></h2>

<? // only show textbox if we're logged in; if we're not logged in, offer login link 
if (isset($_SESSION["Is_Login"])) { // We're logged, we have session stuff ?>
	<!--<div id="chatToolBar"></div>-->
	<!--<div id="livechatColorPicker"></div>-->
	<textarea id="commentbox" title="Add comment" style="resize: none;">	
	</textarea>
	<div style="width: 750px; clear: both; margin-bottom: 10px;">
	<button id="sendComment" type="button" style="float: right; border-radius: 4px; clear: both;">
    	<span class="k-icon"></span> 添加评论
        </button>
	</div>
<? } else { ?>
	<div style="text-align: center; background-color: #FCF8E3; border: 1px solid #FAEBCC; padding: 7px 0; border-radius: 4px; width: 750px;">
		您尚未登录，请先行[<a href="/user/login.php" style="text-decoration: none;">登录/注册</a>]
	</div>
<? } ?>

<div id="comment_show_box">
	
</div>
</div>

<script type="text/javascript">

$("#sendComment").kendoButton({
	icon: 'pencil',
	click: function (e) {
		sendMsg();
	}
});

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

getComments();

<? if (isset($_SESSION["Is_Login"])) { // Load chat box editor -- only if we have a session... ?>

$("#commentbox").val(""); // Clear the editor of any rogue div's

/*
$("#commentbox").kendoEditor({ 
	tools: [
		"bold",
		"italic",
		"underline",
		"fontSize",
		
		{ 
			name: "fontName",
			items: [
				{ text: "PingFang", value: "'PingFang-Regular'" },
				{ text: "司马笋", value: "imsun" },
				{ text: "YouYuan", value: "'YouYuan'" },
				{ text: "YaHei", value: "'Microsoft YaHei'" }
			]
		},
		
		"foreColor"
	],
	stylesheets: [
		"/livechat/comments.css"
	]
}); */

/*
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
                	$("#commentbox").val("[b]" + $("#commentbox").val() + "[/b]");
                });
                break;
            case 2:
            	tool.html("<span style=\"font-style: italic; font-family: Sans Serif;\">I</span>");
            	tool.jqxToggleButton({
                	toggled: false,
                	width: '25px'
                });	
                tool.on("click" , function() {
                	$("#commentbox").val("[i]" + $("#commentbox").val() + "[/i]");
                });
            	break;
            case 3: 
            	tool.html("<u>U</u>");
            	tool.jqxToggleButton({
                	toggled: false,
                	width: '25px'
                });
                tool.on("click" , function() {
                	$("#commentbox").val("[u]" + $("#commentbox").val() + "[/u]");
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
}); */



<? } // end loading Editor ?>



}); // End of loading document check


var _commentsTotal;

function getComments() {
	$("#comment_show_box").empty();
	$.ajax({
		cache: false,
		url: "/livechat/comments_get.php",
		data: { 
			'catalog_id': '<?=$_GET["catlogid"]?>' 
		},
		dataType: "json",
		success: function(result) {       	
			if (result.status != 0) {
	        	var commentsTotal = 0;
	        	_commentsTotal = result.length+1;
	        	$.each(result, function(key,value) { 		
	  	        	commentsTotal++;
	        		commentPop(value.user_id, value.user_name, value.avatar, value.datetime, value.content, commentsTotal);
				});
				$("#commentsTotal").html("("+commentsTotal+")"); // Update total count		
				//_commentsTotal = commentsTotal;						
			}		
		}
	});
}

function commentPop(user_id, user_name, avatar, datetime, content, commentNumber) {
	var content = filterChat(content);
	
	/*
	if (user_id == '<?=$_SESSION["User_Id"]?>') { // Show that the message came from me instead...
		var $new = $('<div class="commentmsg" style="float: right; clear: both;">' + 
		'<div class="comment_white"><p><strong></strong> ' + 
		'&nbsp;&nbsp;<span style="color: #999; float: right; font-weight: normal;" data-livestamp="'+datetime+'"></span> </p><p style="font-weight: normal;">'+content+'</p></div>' +
		'<img style="float: right;" class="comment_avatar" src="/uimg/'+user_id+'/'+avatar+'.png" /></div>');	
	} else {	
		var $new = $('<div class="commentmsg" style="float: left; clear: both;">' + 
		'<img class="comment_avatar" src="/uimg/'+user_id+'/'+avatar+'.png" />' + 
		'<div class="comment_white"><p><strong>'+user_name+'</strong> ' +
		'&nbsp;&nbsp;<span style="color: #999; float: right; font-weight: normal;" data-livestamp="'+datetime+'"></span> </p><p style="font-weight: normal;">'+content+'</p></div></div>');			
	} */
	
	var newComment = $('<div class="commentmsg" id="comment'+commentNumber+'"><img class="comment_avatar" src="/uimg/'+user_id+'/'+avatar+'.png" />' +
		'<div class="comment_white"><p><span style="color: #999; font-weight: bold;">'+user_name+'</span>' +
		'&nbsp;&nbsp;<span style="color: #999; float: right; font-weight: normal;"> <span data-livestamp="'+datetime+'"></span>' + 
		'&nbsp;-&nbsp;<a name="comment'+commentNumber+'" style="color: #999;" href="#comment'+commentNumber+'">#'+commentNumber+'</a></span> </p>' +
		'<p style="font-weight: normal;">'+content+'</p></div></div>'); 

	$("#comment_show_box")		
		.append(newComment.css("opacity", 0))
		.animate({ 
			scrollTop: $('#comment_show_box')[0].scrollHeight }, 
			5, 
			function() {
				newComment.transition({ y: '-15px', 'opacity': 1, 'easing': 'in', delay: 200 }, 500, "ease", function() { // Callback
					if (window.location.hash && _commentsTotal == commentNumber) {	// Scroll to hash link if it exists AND this is the last comment
						console.log("Scrolling... NOW!");
						var hash = window.location.hash.substring(1);
						var scrollTo = $("#"+hash);
						$('html,body').transition({ scrollTop: scrollTo.offset().top }, 1900, "ease" );						
					}	
				});
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

function sendMsg() {
	var myMsg = $('#commentbox').val();
	$("#commentbox").val(""); // Immediately empty comment box
	if (myMsg != "") {
		myMsg = '<span style="color: #'+myColor+';">'+myMsg+'</span>';
		
		$.ajax({
			cache: false,
			method: "GET",
			url: "/livechat/comment_send.php",
			data: {
				'send' : "1",
				'catid' : "<?=$_GET["catlogid"];?>",
				'commentNumber' : _commentsTotal + 1,
				'message' : myMsg 
				}
			})
			.done(function(msg) { // Msg sent successfully
				console.log(msg);
				getComments();
			});
	}
}

/*
// add animation-delay properties to span elements
var animTime = 4,   // time for the animation in seconds
    hueChange = 2,   // the hue change from one span element to the next
    prefixes = ["","-webkit-","-moz-","-o-"],
    numPrefixes = prefixes.length;

$('.unicorn').find('span').each(function (i) {
    for (var j=0;j<numPrefixes;j++) {
        $(this).css(prefixes[j]+'animation-delay', (animTime * ((i * hueChange) % 360) / 360) - animTime + 's');
    }
});


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
*/

</script>




