<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
    session_start(); 
	include $_SERVER["DOCUMENT_ROOT"]."/includes/log.php"; // Log every visit of every user and visitor.   
?>
<!DOCTYPE HTML>
<html><!-- Note: not having "DOCTYPE" above this can break the page and layout! Esp. with Jquery and centering windows.-->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
	

    
	<script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>
	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>-->
	<script type="text/javascript" src="/scripts/jquery.transit.min.js"></script>
	<!--<script type="text/javascript" src="/scripts/jquery-timeago/jquery.timeago.js"></script>-->
	<script type="text/javascript" src="/scripts/moment/moment-with-locales.js"></script>
	<script type="text/javascript" src="/scripts/livestamp.min.js"></script>
	<link href="/main.css" rel="stylesheet" type="text/css" />	
	<link href="/Front.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href="/Article/article.css" rel="stylesheet" type="text/css" />
	
	<!--
	<link href="/scripts/metro/build/css/metro.css" rel="stylesheet">
	<link href="/scripts/metro/build/css/metro-icons.css" rel="stylesheet">
	<link href="/scripts/metro/build/css/metro-responsive.css" rel="stylesheet">
	<link href="/scripts/metro/build/css/metro-schemes.css" rel="stylesheet">
	<script src="/scripts/metro/build/js/metro.js"></script> 
	-->
	<link rel="stylesheet" href="/scripts/k/styles/kendo.metroblack.min.css" />	
	<link rel="stylesheet" href="/scripts/k/styles/kendo.common.min.css" />
	<!--<link ref="stylesheet" href="/scripts/k/styles/kendo.mobile.all.min.css" />-->

	<script src="/scripts/k/js/kendo.all.min.js"></script>
	<script src="/scripts/k/js/cultures/kendo.culture.zh-CHS.min.js"></script>
	<script src="/scripts/k/js/messages/kendo.messages.zh-CN.min.js"></script>
	
<script type="text/javascript">
$(document).ready(function() {
	moment.locale('zh-cn');
});
</script>


