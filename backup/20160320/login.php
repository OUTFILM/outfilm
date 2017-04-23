<?php
    include $_SERVER["DOCUMENT_ROOT"]."/config.php";
    session_start();    
?>
<meta charset="UTF-8">
<link href="Login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/scripts/jquery.transit.min.js"></script>   

<link href="/scripts/metro/build/css/metro.css" rel="stylesheet">
<link href="/scripts/metro/build/css/metro-icons.css" rel="stylesheet">
<link href="/scripts/metro/build/css/metro-responsive.css" rel="stylesheet">
<link href="/scripts/metro/build/css/metro-schemes.css" rel="stylesheet">
<script src="/scripts/metro/build/js/metro.js"></script>

<title>QAF登录</title>

<!--
<script>
$(document).ready(function() {
    $("#loginLink").click(function( event ){
           event.preventDefault();
           $(".overlay").fadeToggle("fast");
     });
    
    
    $(".close").click(function(){
        $(".overlay").fadeToggle("fast");
    });
    
    $(document).keyup(function(e) {
        if(e.keyCode == 27 && $(".overlay").css("display") != "none" ) { 
            event.preventDefault();
            $(".overlay").fadeToggle("fast");
        }
    });
});
</script> -->
<script type="text/javascript">
$(document).ready(function () {	
		
	function checkComplete(id) {
		id = "#"+id;
		$(id).focusout(function() { 
			if ($(id).val() != "") {
				$(id).parent().addClass("success");
			}	
		});		
	}
	
	//checkComplete("code");
	//checkComplete("fullname");
	checkComplete("email");
	checkComplete("username");
	checkComplete("password");
	//checkComplete("birthmonth");
	//checkComplete("birthyear");
	//checkComplete("birthday");
	//checkComplete("gender");
	//checkComplete("phone");

	$("#code").focusout(function() {
		console.log("Checking... " + $("#code").val());
		if ($("#code").val() != "") {
		$.ajax({
			url: "/user/register/reg.php",
			method: "post",
			data: { 'checkCode': $("#code").val() },
		    cache : false,
		    success: function(result) {
			        console.log(result);
			        res_code = result;
			        if(res_code == "Valid") { // Success
						$("#code").parent().removeClass("error");
						$("#code").parent().addClass("success");										
			        } else if(res_code == "Invalid")  {			        	       	
						$("#code").parent().removeClass("success");	
						$("#code").parent().addClass("error");
			        } else {
			        	$("#code").parent().removeClass("success");	
						$("#code").parent().addClass("error");
			           	$("#errorMessageTitle").html("Please try again later");
						$("#errorMessage").html(result);
						showDialog('dialog-error');				        	
			        }
			 },            
			 error: function(jqXHR, textStatus, errorThrown) {
		           // alert(errorThrown);
		           console.log(textStatus + " " + errorThrown);
		          	$("#errorMessageTitle").html("Critical Error: " + textStatus);
					$("#errorMessage").html(errorThrown);
					showDialog('dialog-error');			     
			 }
		});					
		}
	});

	$("#username").focusout(function() {
		// Check if username is valid and not taken
	});

	$("#repassword").focusout(function() { 
		if ($("#repassword").val() != "") {
			if ($("#repassword").val() != $("#password").val()) {
				$("#repassword").parent().addClass("error");
				$("#password").parent().addClass("error");
				$("#repassword").parent().removeClass("success");
				$("#password").parent().removeClass("success");
			} else {
				$("#repassword").parent().addClass("success");
				$("#password").parent().addClass("success");
				$("#repassword").parent().removeClass("error");
				$("#password").parent().removeClass("error");
			}
		}
	});			

	$("#register_form").validator({
		onSubmit: function(form) {

			if ($("#repassword").val() != $("#password").val()) {
				$("#repassword").parent().addClass("error");
				$("#password").parent().addClass("error");
				$("#repassword").parent().removeClass("success");
				$("#password").parent().removeClass("success");
				return false;
			} else {
				$("#repassword").parent().addClass("success");
				$("#password").parent().addClass("success");
				$("#repassword").parent().removeClass("error");
				$("#password").parent().removeClass("error");
			}

			var code = $('#code').val();
			var fullname = $('#fullname').val();
			var email = $('#email').val();
			var username = $('#username').val();
			var password = $('#password').val();
			var repassword = $('#repassword').val();
			//var birthmonth = $('#birthmonth').val();
			//var birthyear = $('#birthyear').val();
			//var birthday = $('#birthday').val();
			//var gender = $('#gender').val();
			//var phone = $('#phone').val();			
			/*
			// Check birthday
			if (birthday > 31 || birthday < 1) {
				$('#birthday').parent().removeClass("success");
				$('#birthday').parent().addClass("error");
				return false;
			}
			if (birthyear > 2015 || birthyear < 1850) {
				$('#birthyear').parent().removeClass("success");
				$('#birthyear').parent().addClass("error");
				return false;
			}
			if (birthmonth == "Month") {
				$('#birthmonth').parent().removeClass("success");
				$('#birthmonth').parent().addClass("error");	
				return false;			
			}
			//var birthdate = birthyear + "-"  + birthmonth + "-" + birthday; // compile neat birthday		
			*/
			$.ajax({
			    url: "/user/register/reg.php",
			    method: "post",
			    data: { 
			    	'username': username, 
			    	'password': password,
			    	'code': code,
			    	//'fullname': fullname,
			    	'email': email
			    	//'birthdate': birthdate,
			    	//'gender': gender,
			    	//'phone': phone
			    	},
			    cache : false,
			    success: function(result) {
			        res_code = result;
			        if(res_code == 200) { // Success
						// Hide form
						showDialog('dialog-form');
						showDialog('dialog-success');					
			        } else {
			        	console.log(result);			        	
						$("#errorMessageTitle").html("There was a problem...");
						$("#errorMessage").html(result);
						//showDialog('dialog-form');
						showDialog('dialog-error');	        	
			        
			        }
			      },            
			    error: function(jqXHR, textStatus, errorThrown) {
			           // alert(errorThrown);
			           console.log(textStatus + " " + errorThrown);
			           	$("#errorMessageTitle").html("Critical Error: " + textStatus);
						$("#errorMessage").html(errorThrown);
						//showDialog('dialog-form');
						showDialog('dialog-error');	       	
			     
			    }
			   });			
			//console.log("valid");			
			return false;
		}
	});
	
}); // End of doc ready		

function showDialog(id){
    var dialog = $("#"+id).data('dialog');
    if (!dialog.element.data('opened')) {
        dialog.open();
        $("#"+id).css({ opacity: 0, y: -150 });
        $("#"+id).transition({ opacity: 95, y: 0 }, 800, "ease");
    } else {
        $("#"+id).transition({ opacity: 0, y: 150 }, 800, "ease", function() {
			dialog.close();        	
        });
    }
}  
  
</script>
<link href="/user/register/Signup.css" rel="stylesheet" type="text/css" />	
</head>
<body>    

<div id="logo">QAFONE</div>
<div id="signup" onclick="showDialog('dialog-form')"><span>注册</span></div>
<div id="top_bar">    
    <div id="tright_bar">        
    </div>
</div>

<div id="page_container" >
    <div id="Login">    
    <div style="perspective: 1000px; width: 350px;">
       <form onsubmit="return submitLogin();">
        <div id="box" class="Login_part" style="transform-origin: 50% 50% -340px; transform-style: preserve-3d;
        margin-right: auto; margin-left: auto; width: 350px; height: 350px; ">
            <div id="Login_Logo">登录 QAF门户站</div>
            <div id="wrong_name">
                <div id="wrong_info"></div>
            </div>
            <!--<div class="login_info">账号</div>
            <input name="login_username" id="login_username" placeholder="请输入账号" class="ur"/></br>
                        <div class="login_info">密码</div>
            <input name="login_password" id="login_password" type="password" placeholder="请输入密码" class="pw" />
            -->
            <div style="font-family: 'PingFang-Regular'; margin-left: 17px; height: 150px;">
	            <div class="input-control modern text iconic" data-role="input">
	            	<span class="icon mif-user"></span>
	            	<input type="text" name="login_username" id="login_username" class="fg-white padding2" style="font-size: 15pt;">
	            	<span class="label fg-white">账号</span>
	            	<span class="informer fg-white">请输入账号</span>
	            	<span class="placeholder fg-white">账号</span>
	            </div>
	            <div class="input-control modern password iconic" data-role="input">
	            	<span class="icon mif-lock"></span>
	            	<input type="password" name="login_password" id="login_password" class="fg-white padding2" style="font-size: 15pt;">
	            	<span class="label fg-white">密码</span>
	            	<span class="informer fg-white">请输入密码</span>
	            	<span class="placeholder fg-white">密码</span>
	            	<!--<button class="button helper-button reveal"><span class="mif-looks"></span></button>-->
	            </div>
            </div>            

            <div id="Login_part_foget">
                <div id="Login_part_fogepw"><a href="#">忘记密码?</a></div>
                <div id="Login_part_new"><a href="#register" onclick="showDialog('dialog-form')">注册用户</a></div>
            </div>              
            <div id="Login_Footer">
                <div id="login_but" class="button1">登录</div>
            </div>    
       </div>
       </form>
    </div>
    </div>
</div>
<div id="Footer">
    <div id="Footer_menu">
        <div class="Footer_menu_part" style="text-align: center">
            <h4 style="color: white;">合作</h4>
            <h5>关于我们</h5>
        </div>
        <div class="Footer_menu_part_line"></div>
        <div class="Footer_menu_part" style="text-align: center">
            <h4 style="color: white;">官方网站</h4>
            <a href="http://www.qafone.net/index.php"><h5>QAF中文站</h5></a>
        </div>
        <div class="Footer_menu_part_line"></div>
        <div class="Footer_menu_part"></div>
        <div class="Footer_menu_part_line"></div>
        <div id="logo1"><img src="/uploads/lo5.png"/></div>
        <div class="Footer_menu_part"></div>
        <div class="Footer_menu_part_line"></div>
        
    </div>
</div>

	
<div data-role="dialog,draggable" 
	data-close-button="true" id="dialog-form" class="padding10">
	<div style="font-family: 'PingFang-Regular';">
		
	<h1 style="margin-bottom: 1em; font-size: 20pt;">注册</h1>	
	<form 
		novalidate="novalidate"
		data-show-success-state="true"
		data-show-error-state="true"
		data-hint-mode="line"
		data-hint-background="bg-red"
		data-hint-color="fg-white"
		date-hide-error="0"
		id="register_form">
		
		<div class="grid condensed">
			
		<div class="row">
			<div class="cell">
			
			<p style="margin-top: -5px; margin-bottom: 0;"><label class="block" for="code">邀请码/Membership Code</label></p> 
			<div class="input-control text" style="width: 340px;">
			<span class="mif-key prepend-icon mif-ani-heartbeat"></span>
			<input id="code" name="code" placeholder="Enter the code given by an administrator"				
				tabindex="1" type="text"> 
				<span class="input-state-error mif-cancel mif-ani-shuttle"></span>
				<span class="input-state-success mif-checkmark"></span>
			</div>
			<!--
			<p style="margin-bottom: 0;"><label class="block" for="fullname">姓名/Name</label></p>
			<div class="input-control text">
			<input id="fullname" name="fullname" placeholder="Full name"
				data-validate-func="required" required="required"
				tabindex="2" type="text"> 
				<span class="input-state-error mif-warning mif-ani-horizontal"></span>
				<span class="input-state-success mif-checkmark"></span>
			</div>-->
	
			<p style="margin-bottom: 0; margin-top: 10px;"><label class="block" for="email">邮箱/Email</label></p>
			<div class="input-control text" style="width: 240px;">
			<span class="mif-paper-plane mif-ani-float prepend-icon"></span>
			<input id="email" name="email" placeholder="example@domain.com"
				data-validate-func="email" required="required"
				data-validate-hint="Please enter a correct email" data-validate-hint-position="top"
				tabindex="2" type="email"> 
				<span class="input-state-error mif-warning mif-ani-horizontal"></span>
				<span class="input-state-success mif-checkmark"></span>
			</div>
	
			<p style="margin-bottom: 0; margin-top: 10px;"><label class="block" for="username">用户名/Create a username</label></p>
			<div class="input-control text" style="width: 240px;">
			<span class="mif-user mif-ani-heartbeat prepend-icon"></span>
			<input id="username" name="username" placeholder="Username"
				data-validate-func="minlength" data-validate-arg="2" required="required"
				data-validate-hint="Username must be at least 2 characters long" data-validate-hint-position="top"
				tabindex="2" type="text"> 
				<span class="input-state-error mif-warning mif-ani-horizontal"></span>
				<span class="input-state-success mif-checkmark"></span>
			</div>

			<p style="margin-bottom: 0; margin-top: 10px;"><label class="block" for="password">建立密码/Create a password</label></p>
			<div class="input-control password" style="width: 240px;">
			<span class="mif-lock mif-ani-heartbeat prepend-icon"></span>
			<input id="password" name="password" placeholder="Password"
				data-validate-func="minlength" data-validate-arg="4" required="required"
				data-validate-hint="Password must be at least 4 characters long" data-validate-hint-position="top"
				tabindex="2" type="password"> 
				<span class="input-state-error mif-warning mif-ani-horizontal"></span>
				<span class="input-state-success mif-checkmark"></span>				
			</div>
			
			<p style="margin-bottom: 0; margin-top: 10px;"><label class="block" for="repassword">确认密码/Confirm your password</label></p>
			<div class="input-control password" style="width: 240px;">
			<span class="mif-lock mif-ani-heartbeat prepend-icon"></span>
			<input id="repassword" name="repassword" placeholder="Confirm Password"
				data-validate-func="minlength" data-validate-arg="4" required="required"
				data-validate-hint="Passwords don't match!" data-validate-hint-position="top"
				tabindex="2" type="password"> 
				<span class="input-state-error mif-warning mif-ani-horizontal"></span>
				<span class="input-state-success mif-checkmark"></span>				
			</div>
			
			</div>
		</div>

	<!--
	   	<div class="row cells3">
	   		<div class="cell" style="width: 150px;">
	   			<label for="birthday">Birthday</label>
	   			<div class="input-control text" data-role="keypad" data-length="2" style="width: 50px;">
	   				<input type="text" maxlength="2" name="birthday" id="birthday"
	   					placeholder="Day" required="required" data-validate-func="minlength" data-validate-arg="1">
	   				<span class="input-state-error mif-warning mif-ani-horizontal"></span>
					<span class="input-state-success mif-checkmark"></span>	
	   			</div> 
	   		</div>
	   		<div class="cell" style="width: 220px;">
	      	  <label>Month</label>
		      <div class="input-control select" style="width: 150px;">	
		      	<select class="select-style" name="BirthMonth" id="birthmonth">
			      <option value="">Month</option>
			      <option  value="01">January</option>
			      <option value="02">February</option>
			      <option value="03">March</option>
			      <option value="04">April</option>
			      <option value="05">May</option>
			      <option value="06">June</option>
			      <option value="07">July</option>
			      <option value="08">August</option>
			      <option value="09">September</option>
			      <option value="10">October</option>
			      <option value="11">November</option>
			      <option value="12">December</option>
		      </select> 
		      </div>	   			
	   		</div>
	   		<div class="cell" style="width: 150px;">
	   			<label for="birthyear">Year</label>
	   			<div class="input-control text" data-role="keypad" data-length="4" style="width: 90px;">
	   				<input type="text" maxlength="4" name="birthyear" id="birthyear"
	   					placeholder="Year" required="required" data-validate-func="minlength" data-validate-arg="4">
	   				<span class="input-state-error mif-warning mif-ani-horizontal"></span>
					<span class="input-state-success mif-checkmark"></span>	
	   			</div>   			
	   		</div>
	   	</div>-->

	  
		 <div class="row">
		 	<!--<div class="cell">
		 		<div class="input-control select">				
				<select class="select-style gender" name="gender" id="gender">
					<option value="select">我是/i am...</option>
					<option value="m">男性/Male</option>
					<option value="f">女性/Female</option>
					<option value="other">其它/Other</option>
				</select>	
				</div>
				<p style="style=margin-bottom: 0; margin-top: 10px;"><label class="block" for="phone">电话号码/Mobile phone</label></p>
				<div class="input-control text" style="width: 240px;">
				<span class="mif-phone mif-ani-heartbeat prepend-icon"></span>
				<input id="phone" name="phone" placeholder="Phone number"
					data-validate-func="minlength" data-validate-arg="7" required="required"
					data-validate-hint="Mobile number must be at least 7 digits" data-validate-hint-position="top"
					tabindex="2" type="text"> 
					<span class="input-state-error mif-warning mif-ani-horizontal"></span>
					<span class="input-state-success mif-checkmark"></span>
				</div>-->
	
				<div><button class="button primary">提交表格</button></div>		 
			</div>
		</div>
	</div><!-- end of grid -->
	
	</form>		
	</div> 
</div><!-- end of form dialog  -->
  
<div data-role="dialog,draggable" data-overlay="true" data-overlay-color="op-dark" data-easing="easeInCubic"
	class="padding20 dialog warning" data-close-button="true" id="dialog-error" style="z-index: 1070">
	<h3 id="errorMessageTitle">Error</h3>
	<div id="errorMessage">None</div>	
	<button class="button" onclick="showDialog('dialog-error');"> OK </button>
</div>

<div data-role="dialog" data-overlay="true" data-overlay-color="op-light"
	class="padding20 dialog success" data-close-button="true" id="dialog-success" style="z-index: 1090">
	<h1 id="errorMessageTitle" style="font-family: 'PingFang'">欢迎登机, 朋友！</h1>
	<div id="errorMessage">请系紧安全带，我们将马上起飞。。。请检查您的电子邮件机票验证你的会员资格!</div>	
	<button class="button" onclick="showDialog('dialog-success');"> OK.... </button>
</div>    
    
<script>
    //if only options specified
    //start the floating animation with specified settings


	function submitLogin() {
		$('#login_but').click();
	}

$('#login_password').keypress(function(event) {
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13') {
		$('#login_but').click();
		//alert("entered press");
	}
});
    var tmp_path;
    var res_code = 0;
    /*Login Check In*/
    $('#login_but').click(function() {
       // load_user(); 
        //function load_user() {
            /*Ajax: communicate with check*/
            var username = $('#login_username').val();
            var password = $('#login_password').val();
            $.ajax({
                url: "/user/CheckLogin.php",
                method: "post",
                data: { 'username': username , 'password': password  },
                cache : false,
                success: function(result) {
                    res_code = result;
                    if(res_code==100) {
                        $('#wrong_info').html('用户名不存在');
                        $('#wrong_info').transition({ width:"180px"},100);
                    }
                        
                    else if(res_code==300) {
                        $('#wrong_info').html('用户名或者密码不正确'); 
                        $('#wrong_info').transition({ width:"180px"},100);
                                                    
                    }
                    
                    else if(res_code==400) {
                        $('#wrong_info').html('你的账户尚未激活，请查看邮箱'); 
                        $('#wrong_info').transition({ width:"300px"},100);
                                                    
                    }
                    
                    else if(res_code==200) {
                         $.ajax({
                                url: "/user/getuserid.php",
                                type: "POST",
                                data: {'username': username},
                                }).done(function( data ) {
                                console.log("PHP Output:");
                                tmp_path = data;
                                }); 
                        transition(username);
                        window.setTimeout(function(){

                         <?php
                         if (isset($_SESSION["redirectAfterLogin"])) {
						 	?> window.location.replace("<?=$_SESSION["redirectAfterLogin"]?>"); <?
						 } else {
						     // Just redirect home
						    ?> window.location.replace("/"); <?	
						 } 
						 ?>                       
                        
                        }, 5000);
                    
                    }
                },            
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
           })       
        //}
        
        
        function transition(username) {
            $('#box').transition({
            opacity: 0.1,
            rotateY: 180
            }, 780, 'ease-in', function() {
                $('#box').html('');
                console.log(tmp_path);
                $('#box').append('<div class="portmove1"><img src="' + tmp_path + '"/></div>');
                $('#box').append('<div class="welcome"><h4>'+ username +'</h4>欢迎回来！</div>');
                $('#box').transition({
                    opacity: 1,
                    rotateY: 360
                },  780, 'ease-out');
                });
        }
        
    }    
    );
    
    //$("input").focus(function() {
    //    $('#wrong_info').animate({ width:""},500);//After Give a wrong user or pw error,everytime you start to refill the box, the error disappear
    //});
    
    $("#login_password").focusout(function() {
        if($(this).val()=='') {//if pw is empty,inform to user.
            $('#emp_name2').html('忘记输入了密码了?');// info
            $('#emp_name2').transition({ width:"150px"},500);//appear it
        } else $('#emp_name2').transition({ width:""},200); // when user jump to another box,if it is filled, disappeared
    });
    
    $("#login_username").focusout(function() {
        if($(this).val()=='') {//same as above
            $('#emp_name1').html('忘记输入用户名了?');
            $('#emp_name1').transition({ width:"150px"},500);
        } else $('#emp_name1').transition({ width:""},200);
    });
</script>
    
</body>
</html>