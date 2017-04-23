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
//if (!isset($_GET["catlogid"])) exit; // Catlogid is absolutely required to show comments.

?>
<div id="commentContainer">
<!--<h2>评论列表 <span id="commentsTotal"></span></h2>-->

<div id="top_comment_show_box">	
</div>
</div>

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
/*$(document).ready(function () {

getComments();

}); // End of loading document check
*/

var _commentsTotal;

function getComments() {
	$("#top_comment_show_box").empty();
	$.ajax({
		cache: false,
		url: "/livechat/comments_get.php",
		data: { 
			'catalog_id': 0 
		},
		dataType: "json",
		success: function(result) {       	
			if (result.status != 0) {
	        	var commentsTotal = 0;
	        	_commentsTotal = result.length+1;
	        	$.each(result, function(key,value) { 		
	  	        	commentsTotal++;
	        		commentPop(value.user_id, value.user_name, value.avatar, value.datetime, value.content, commentsTotal, value.article_id, value.article_title);
				});
				//$("#commentsTotal").html("("+commentsTotal+")"); // Update total count		
				//_commentsTotal = commentsTotal;						
			}		
		}
	});
}

function commentPop(user_id, user_name, avatar, datetime, content, commentNumber, articleId, articleTitle) {
	var content = filterChat(content);

	var newComment = $('<div class="commentmsg" id="comment'+commentNumber+'"><img class="comment_avatar" src="/uimg/'+user_id+'/'+avatar+'.png" />' +
		'<div class="comment_white"><p><span style="color: #999; font-weight: bold;">'+user_name+'</span> 评论了文章 ' +
		'<a href="/Article/article.php?catlogid='+articleId+'">《'+articleTitle+'》</a>' +
		'&nbsp;&nbsp;<span style="color: #999; float: right; font-weight: normal;"> <span data-livestamp="'+datetime+'"></span>' + 
		'</p>' +
		'<p style="font-weight: normal;">'+content+'</p></div></div>'); 

	$("#top_comment_show_box")		
		.append(newComment.css("opacity", 0))
		.animate({ 
			scrollTop: $('#top_comment_show_box')[0].scrollHeight }, 
			5, 
			function() {
				newComment.transition({ y: '-15px', 'opacity': 1, 'easing': 'in', delay: 200 }, 500, "ease", function() { // Callback
					if (window.location.hash && _commentsTotal == commentNumber) {	// Scroll to hash link if it exists AND this is the last comment;
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

</script>




