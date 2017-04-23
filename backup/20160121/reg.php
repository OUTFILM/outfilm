<?
// If a user is already logged in... they shouldn't be here...
if (isset($_SESSION["User_Id"]) or isset($_SESSION["Is_Login"])) { // User must NOT be logged in, otherwise return error to client
	die("Cannot register. You are logged in.");
}

if (isset($_POST["checkCode"])) { // Check visitor database. Nobody can check a code more than 10 times in 3 hours. 
	//die("Valid");
	if (!isset($_SESSION["visitor_id"])) session_start(); 
	
	if ("" == $_SESSION["visitor_id"]) { // Must obtain a visitor's ID badge -- send them to log.php just in case
		include $_SERVER["DOCUMENT_ROOT"]."/includes/log.php";
	} 
	
	if (!isset($pdo)) include $_SERVER["DOCUMENT_ROOT"]."/config.php";	// DB PDO config only
	
	// Check if we can check the code. If not, return error message. 
	$sql = "SELECT membership_code_tries,membership_code_lock_time FROM visitors WHERE visitor_id=:visitor_id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":visitor_id", $_SESSION["visitor_id"], PDO::PARAM_INT);
	$stmt->execute();
	$stmt->bindColumn("membership_code_tries", $membership_code_tries);
	$stmt->bindColumn("membership_code_lock_time", $membership_code_lock_time);
	
	if ($membership_code_tries > 12 and strtotime($membership_code_lock_time) < time()) { // Will unlock at preset time
		die("Sorry, you have attempted to register too many times with a wrong code. You will not be able to register for a day.");
	}
	
	if ($membership_code_tries > 12) {
		$membership_code_tries = 0; // Reset to 0; if we reached this point, then we were banned yesterday and are ready to try again! 
	}
	
	$sql = "UPDATE visitors SET membership_code_tries=:membership_code_tries, membership_code_lock_time=:tomorrow WHERE visitor_id=:visitor_id";
	$stmt = $pdo->prepare($sql);
	$tomorrow = time() + (24 * 60 * 60); // Ban for 1 day	
	$membership_code_tries = $membership_code_tries + 1;
	$stmt->bindParam(":tomorrow", $tomorrow);
	$stmt->bindParam(":visitor_id", $_SESSION["visitor_id"], PDO::PARAM_INT);
	$stmt->bindParam(":membership_code_tries", $membership_code_tries, PDO::PARAM_INT);
	$stmt->execute(); // ++1 every time for checking. 
	
	//usleep(10000); // Drumroll: Make someone wait in anticipation; gives you time to show off your new fancy ajax spinning icon animations!
	//Check the MEMBERSHIP CODE against the database...
	$code = $_POST["checkCode"];
	$stmt = $pdo->prepare("SELECT code,used FROM code WHERE code=:code AND used=1");
	$stmt->bindParam(':code', $code);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		die("Valid");
	} else {
		die("Invalid");
	}		
	exit;
}

if (isset($_POST["username"])) { // Actually do AJAX functions here. That's right; this script is kinda recursive.
	//echo "\"You're not supposed to be here...\" - TheOverlord";
	
	//die("200"); // Testing only, or disable registrations altogether.
	
	$code = $_POST["code"];
	$username = $_POST["username"];
	$email = $_POST["email"];
	//$fullname = $_POST["fullname"];
	$password = $_POST["password"];
	//$birthyear = $_POST["birthyear"];
	//$birthmonth = $_POST["birthmonth"];
	$birthdate = $_POST["birthdate"];
	$gender = $_POST["gender"];
	$phone = $_POST["phone"];
	$portrait = "default_portrait"; // Consider changing?

	// Server-side validation (Remember: Client-side program is just the spoon, Server is the ricefield itself)
	$username = trim($username); // Trimming UTF-8 strings is supposedly safe (spaces are ASCII after all?)
	if (mb_strlen($username, 'UTF-8') < 2 and mb_strlen($username, 'UTF-8') > 20 ) $error = "Username must be 2-20 characters.";		
	if (mb_strlen($password, 'UTF-8') < 4 and mb_strlen($password, 'UTF-8') > 20) $error = "Password must be 4-20 characters.";
	if (strlen($code) < 4) $error = "Verification code must be at least 4 characters.";
	if (strlen($email) < 4) $error = "Must enter a valid email.";	
	
	// Merge the birthday into one field, otherwise it is invalid
	//if (!is_numeric($birthday) and $birthday <= 0 and $birthday > 31) $error = "Invalid birthday.";
	//if (!is_numeric($birthyear)) $error = "Invalid birthyear.";
	//if (strlen($birthyear) < 4) $error = "Birthyear too short. Or, you're a really old vampire -- please join special QAFone Vampire VIP Club instead!";
	//$birthdate = $birthday . " " . $birthmonth . " " . $birthyear;
	
	if ("" != $error) die($error);

	// Perform database validation
	include $_SERVER["DOCUMENT_ROOT"]."/config.php";	// DB PDO config only
	
	//Check the MEMBERSHIP CODE against the database...
	$stmt = $pdo->prepare("SELECT code,used FROM code WHERE code=:code AND used=1");
	$stmt->bindParam(':code', $code);
	$stmt->execute();
	if ($stmt->rowCount() < 1) die("Membership code is invalid. Please re-enter or check with an administrator.");
	
	// Check the database to make sure both the email and username don't already exist.
	$stmt = $pdo->prepare("SELECT `User_Name` FROM `users` WHERE `User_Name`=:username");
	$stmt->bindParam(':username', $username);
	$stmt->execute();
	if ($stmt->rowCount() > 0) die("Username already exists. Please try another one."); 
	$stmt = $pdo->prepare("SELECT `E-mail` FROM `users` WHERE `E-mail`=:email");
	$stmt->bindParam(':email', $email);
	$stmt->execute();
	if ($stmt->rowCount() > 0) die("An account with that email already exists."); 
    
    $orig_pw = $password;
	// Password Salt, used for locking and unlocking passwords
	$password = crypt($password, '2a$07$laersiitanimulliehT$');
	//die($password);	
	// Later, just use: if (hash_equals($hashed_password, crypt($user_input, $hashed_password))) { "Password verified!" }
    // Inser one hash to verify e-mail later
    $hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
    // Example output: f4552671f8909587cf485ea990207f3b
    $Verified = '0';
    $rank = 10;
    $por_d = 'default_portrait';
    $new_mem = "INSERT INTO users (User_Name,User_Password,Gender,Birthdate,`E-mail`,First_Ip,Signup_Date,MobilePhone,Portrait_Id,Signuphash,Verified,Class_Rank) 
                VALUES (:user_name,:password,:gender,:birthdate,:email,:first_ip,now(),:phone,:portrait,:hash,:Verified,:rank)";
	/*$stmt = $pdo->prepare("INSERT INTO users SET User_Name=:user_name, User_Password=:password, 
                             Gender=:gender, Birthdate=:birthdate, `E-mail`=:email,
                             First_Ip=:first_ip, Signup_Date=now(), Nickname=:user_name,
                             MobilePhone=:phone, Portrait_Id=:portrait, `Signuphash`=:hash, `Verified`=:Verified");*/
    $stmt = $pdo->prepare($new_mem);
	$stmt->bindParam(":user_name", $username);
	$stmt->bindParam(":password", $password);
	$stmt->bindParam(":gender", $gender);  
	$stmt->bindParam(":birthdate", $birthdate);
	$stmt->bindParam(":email", $email);
	$stmt->bindParam(":first_ip", $_SERVER["REMOTE_ADDR"]);   
	$stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":portrait", $por_d); 
	$stmt->bindParam(":hash", $hash);
    $stmt->bindParam(":Verified", $Verified);
    $stmt->bindParam(":rank", $rank);  
	
	$stmt->execute();	
	$lastInsertId = $pdo->lastInsertId();
	// Claim the generated code as used...
	$stmt = $pdo->prepare("UPDATE code SET id=:user_id,used=2 WHERE code=:code ");
	$stmt->bindParam(":user_id", $lastInsertId); 
	$stmt->bindParam(":code", $code); 
	$stmt->execute();
	
	
	/*set default portrait and default uploads/id/ folder
	$query_NUM = "SELECT `User_Id` FROM users WHERE User_Name =:name";
    $result_n = $pdo->prepare($query_NUM);
    $result_n->bindParam(":name", $username); 
    $result_n->execute();
    $number_id = intval($result_n->fetchColumn()); 
	mkdir('uploads/'.$number_id, 0777, true);
	copy('/uploads/default_portrait.png', '/uploads/'.$number_id.'/default_portrait.png');
    */
    
	//echo $lastInsertId;
	echo "200";
	$pdo = null; 
	
	//TODO: Send email?
    /* Daniel Lee edited
     * 11/09/2015 10:54AM
     * Sending a E-mail to account what people signup*/
    $to      = $email; // Send email to our user
    $subject = 'Signup  | Verification '; // Give the email a subject 
    $message = '
 
    Thanks for signing up!
    感谢您的注册！
    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
    您的账号已经注册成功，又可以通过点击下面的链接来激活你的账号，以下是你的账号！
    ------------------------
    Username: '.$username.'
    Password: '.$orig_pw.'
    ------------------------
    点击下面链接激活：
    Please click this link to activate your account:
    http://qafone.sweetgreen.org/user/verify.php?email='.$email.'&hash='.$hash.'
    
    '; // Our message above including the link
                     
    $headers = 'From:noreply@http://qafone.sweetgreen.org' . "\r\n"; // Set from headers
    mail($to, $subject, $message, $headers); // Send our email
    /*------------E-mail compose---------------------*/	
	die;	
}

exit;

include $_SERVER['DOCUMENT_ROOT']."/includes/header.php"; 
?>
<link href='http://fonts.googleapis.com/css?family=Varela+Round|Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link href="/user/register/Signup.css" rel="stylesheet" type="text/css" />	

<title>QAFone - 注册</title>
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
</script>
<script type="text/javascript">
$(document).ready(function () {
	/*
	$('#submit').on('click', function () {
		return false;
   }); */


	var code = $('#code').val();
	//var fullname = $('#fullname').val();
	var email = $('#email').val();
	var username = $('#username').val();
	var password = $('#password').val();
	var repassword = $('#repassword').val();
	var birthmonth = $('#birthmonth').val();
	var birthyear = $('#birthyear').val();
	var birthday = $('#birthday').val();
	var gender = $('#gender').val();
	var phone = $('#phone').val();				
		
	function checkComplete(id) {
		id = "#"+id;
		$(id).focusout(function() { 
			if ($(id).val() != "") {
				$(id).parent().addClass("success");
			}	
		});		
	}
	
	checkComplete("code");
	//checkComplete("fullname");
	checkComplete("email");
	checkComplete("username");
	checkComplete("password");
	checkComplete("birthmonth");
	checkComplete("birthyear");
	checkComplete("birthday");
	checkComplete("gender");
	checkComplete("phone");

	$("#repassword").focusout(function() { 
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
	});			

	
	//$('#name').focusout(function() {  $("#register_form").submit(); });
	//$('#email').focusout(function() { $("#register_form").submit(); });
	//$('#username').focusout(function() { $("#register_form").submit(); });
	//$('#password').focusout(function() { $("#register_form").submit(); });

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
			//var fullname = $('#fullname').val();
			var email = $('#email').val();
			var username = $('#username').val();
			var password = $('#password').val();
			var repassword = $('#repassword').val();
			var birthmonth = $('#birthmonth').val();
			var birthyear = $('#birthyear').val();
			var birthday = $('#birthday').val();
			var gender = $('#gender').val();
			var phone = $('#phone').val();			
			
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
			var birthdate = birthyear + "-"  + birthmonth + "-" + birthday; // compile neat birthday
			

			$.ajax({
			    url: "reg.php",
			    method: "post",
			    data: { 
			    	'username': username, 
			    	'password': password,
			    	'code': code,
			    	//'fullname': fullname,
			    	'email': email,
			    	'birthdate': birthdate,
			    	'gender': gender,
			    	'phone': phone
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


</script>

<script>
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

</head>
<body>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/top.php"; ?>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/menu.php"; ?>
<div class="test"></div>
<p>Here's some content.</p>

<!--<a href="login.php" id="loginLink">Login</a>-->
<!--<div class="overlay" style="display: none;">
    <div class="login-wrapper">
        <div class="login-content" id="loginTarget">
            <a class="close">x</a>
            
            -->
<button class="button" onclick="showDialog('dialog-form')"> 注册 </button>
<button class="button" onclick="showDialog('dialog-error')"> Error </button>


	
<div data-role="dialog,draggable" 
	data-close-button="true" id="dialog-form" class="padding10">
	<div>
		
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
			
			<p style="margin: 0;"><label class="block" for="code">邀请码/Membership Code</label></p> 
			<div class="input-control text" style="width: 340px;">
			<span class="mif-key prepend-icon mif-ani-heartbeat"></span>
			<input id="code" name="code" placeholder="Enter the code given by an administrator"
				data-validate-func="required" required="required"
				tabindex="1" type="text"> 
				<span class="input-state-error mif-warning mif-ani-horizontal"></span>
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
	
			<p style="margin-bottom: 0;"><label class="block" for="email">邮箱/Email</label></p>
			<div class="input-control text" style="width: 240px;">
			<span class="mif-paper-plane mif-ani-float prepend-icon"></span>
			<input id="email" name="email" placeholder="example@domain.com"
				data-validate-func="email" required="required"
				data-validate-hint="Please enter a correct email" data-validate-hint-position="top"
				tabindex="2" type="email"> 
				<span class="input-state-error mif-warning mif-ani-horizontal"></span>
				<span class="input-state-success mif-checkmark"></span>
			</div>
	
			<p style="margin-bottom: 0;"><label class="block" for="username">用户名/Create a username</label></p>
			<div class="input-control text" style="width: 240px;">
			<span class="mif-user mif-ani-heartbeat prepend-icon"></span>
			<input id="username" name="username" placeholder="Username"
				data-validate-func="minlength" data-validate-arg="4" required="required"
				data-validate-hint="Username must be at least 4 characters long" data-validate-hint-position="top"
				tabindex="2" type="text"> 
				<span class="input-state-error mif-warning mif-ani-horizontal"></span>
				<span class="input-state-success mif-checkmark"></span>
			</div>

			<p style="margin-bottom: 0;"><label class="block" for="password">建立密码/Create a password</label></p>
			<div class="input-control password" style="width: 240px;">
			<span class="mif-lock mif-ani-heartbeat prepend-icon"></span>
			<input id="password" name="password" placeholder="Password"
				data-validate-func="minlength" data-validate-arg="4" required="required"
				data-validate-hint="Password must be at least 4 characters long" data-validate-hint-position="top"
				tabindex="2" type="password"> 
				<span class="input-state-error mif-warning mif-ani-horizontal"></span>
				<span class="input-state-success mif-checkmark"></span>				
			</div>
			
			<p style="margin-bottom: 0;"><label class="block" for="repassword">确认密码/Confirm your password</label></p>
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
	   	</div>

	  
		 <div class="row">
		 	<div class="cell">
		 		<div class="input-control select">				
				<select class="select-style gender" name="gender" id="gender">
					<option value="select">我是/i am...</option>
					<option value="m">男性/Male</option>
					<option value="f">女性/Female</option>
					<option value="other">其它/Other</option>
				</select>	
				</div>
				<p style="margin-bottom: 0;"><label class="block" for="phone">电话号码/Mobile phone</label></p>
				<div class="input-control text" style="width: 240px;">
				<span class="mif-phone mif-ani-heartbeat prepend-icon"></span>
				<input id="phone" name="phone" placeholder="Phone number"
					data-validate-func="minlength" data-validate-arg="7" required="required"
					data-validate-hint="Mobile number must be at least 7 digits" data-validate-hint-position="top"
					tabindex="2" type="text"> 
					<span class="input-state-error mif-warning mif-ani-horizontal"></span>
					<span class="input-state-success mif-checkmark"></span>
				</div>
	
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
	<div id="errorMessage">紧安全带，我们将起飞不久。。。请检查您的开销电子邮件车厢来验证你的会员资格!</div>	
	<button class="button" onclick="showDialog('dialog-success');"> OK.... </button>
</div>


</body>
</html>