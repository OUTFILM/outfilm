<?
//session_state();

// If a user is already logged in... they shouldn't be here...
if (!isset($_SESSION["User_Id"]) and !isset($_SESSION["Is_Login"])) { // User must NOT be logged in, otherwise return error to client
}

if ($_POST["username"] != "") { // Actually do AJAX functions here. That's right; this script is kinda recursive.
	//echo "\"You're not supposed to be here...\" - TheOverlord";
	
	$code = $_POST["code"];
	$username = $_POST["username"];
	$email = $_POST["email"];
	$fullname = $_POST["fullname"];
	$password = $_POST["password"];
	$birthyear = $_POST["birthyear"];
	$birthmonth = $_POST["birthmonth"];
	$birthday = $_POST["birthday"];
	$gender = $_POST["gender"];
	$phone = $_POST["phone"];

	// Server-side validation (Remember: Client-side program is just the spoon, Server is the ricefield itself)
	if (strlen($username) < 2 and strlen($username) > 20 ) $error = "Username must be 2-20 characters.";		
	if (strlen($password) < 4 and strlen($password) > 20) $error = "Password must be 4-20 characters.";
	if (strlen($code) < 4) $error = "Verification code must be at least 4 characters.";
	if (strlen($email) < 4) $error = "Must enter a valid email.";	
	
	// Merge the birthday into one field, otherwise it is invalid
	if (!is_numeric($birthday) and $birthday <= 0 and $birthday > 31) $error = "Invalid birthday.";
	if (!is_numeric($birthyear)) $error = "Invalid birthyear.";
	if (strlen($birthyear) < 4) $error = "Birthyear too short. Or, you're a really old vampire -- please join special QAFone Vampire VIP Club instead!";
	$birthdate = $birthday . " " . $birthmonth . " " . $birthyear;
	
	if ("" != $error) die($error);

	// Perform database validation
	include $_SERVER["DOCUMENT_ROOT"]."/config.php";	// DB PDO config only
	
	//TODO: Check the MEMBERSHIP CODE against the database...
	
	// Check the database to make sure both the email and username don't already exist.
	$stmt = $pdo->prepare("SELECT `User_Name` FROM `users` WHERE `User_Name`=:username");
	$stmt->bindParam(':username', $username);
	$stmt->execute();
	if ($stmt->rowCount() > 0) die("Username already exists. Please try another one."); 
	$stmt = $pdo->prepare("SELECT `E-mail` FROM `users` WHERE `E-mail`=:email");
	$stmt->bindParam(':email', $email);
	$stmt->execute();
	if ($stmt->rowCount() > 0) die("An account with that email already exists."); 

	// Password Salt, used for locking and unlocking passwords
	$password = crypt($password, "2a$07$laersiitanimulliehT$");
	die($password);
	
	// Later, just use: if (hash_equals($hashed_password, crypt($user_input, $hashed_password))) { "Password verified!" }
	 
	// Input: Message to send into chat
	$stmt = $pdo->prepare("INSERT INTO livechat(user_id, user_name, content, datetime, status) VALUES (:user, :user_name, :content, NOW(), :status)");
	$stmt->bindParam(":user", $user_id, PDO::PARAM_INT); 
	$stmt->bindParam(":content", $content); 
	$stmt->bindParam(":user_name", $user_name);
	$stmt->bindParam(":status", $status); //TODO: Switch if needed. 
	$stmt->execute();	
	$lastInsertId = $pdo->lastInsertId();
	
	// Update stats
	$stmt = $pdo->prepare("UPDATE livechat_stat SET current_message_id = :current_message_id WHERE chat_id=1 ");
	$stmt->bindParam(":current_message_id", $lastInsertId); // Update this value for the world to see that you made a new message
	$stmt->execute();

	$pdo = null; 
		
	
	
	
	die;	
}
/*
include $_SERVER['DOCUMENT_ROOT']."/includes/header.php"; 
?>
    <link type="text/css" rel="Stylesheet" href="/scripts/jqwidgets/styles/jqx.base.css" />
    <link type="text/css" rel="Stylesheet" href="/scripts/jqwidgets/styles/jqx.arctic.css" />
    <script type="text/javascript" src="/scripts/jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqwidgets/jqxpopover.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="/scripts/jqwidgets/jqwidgets/jqxexpander.js"></script> 
    <script type="text/javascript" src="/scripts/jqwidgets/jqwidgets/jqxvalidator.js"></script> 
    <script type="text/javascript" src="/scripts/jqwidgets/jqwidgets/jqxcheckbox.js"></script> 
    <script type="text/javascript" src="/scripts/jqwidgets/jqwidgets/globalization/globalize.js"></script> 
    <script type="text/javascript" src="/scripts/jqwidgets/jqwidgets/jqxcalendar.js"></script> 
    <script type="text/javascript" src="/scripts/jqwidgets/jqwidgets/jqxdatetimeinput.js"></script> 
    <script type="text/javascript" src="/scripts/jqwidgets/jqwidgets/jqxmaskedinput.js"></script> 
    <script type="text/javascript" src="/scripts/jqwidgets/jqwidgets/jqxinput.js"></script> 

    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />
	<title>QAFone - 注册</title>

<script type="text/javascript">
$(document).ready(function () {

	$('#submit').on('click', function () {
        $('#register_form').jqxValidator('validate');
    });

	$('#register_form').jqxValidator({        
        rules: [
        	{ input: '#code', message: 'You must have a valid code to register.', action: 'keyup, blur', rule: 'required' },
            { input: '#username', message: 'Your username must be between 3 and 12 characters!', action: 'keyup, blur', rule: 'length=4,20' },
            { input: '#fullname', message: 'Real Name is required!', action: 'keyup, blur', rule: 'required' },
			{ input: '#password', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
            { input: '#password', message: 'Your password must be between 4 and 12 characters!', action: 'keyup, blur', rule: 'length=4,20' }, 
 			{
               input: '#repassword', message: 'Passwords don\'t match!', action: 'keyup, focus', rule: function (input, commit) {
                   // call commit with false, when you are doing server validation and you want to display a validation error on this field. 
                   if (input.val() === $('#password').val()) {
                       return true;
                   }
                   return false;
               }
            }],     
        onSuccess: function() {
			var code = $('#code').val();
			var fullname = $('#fullname').val();
			var email = $('#email').val();
			var username = $('#username').val();
			var password = $('#password').val();
			var repassword = $('#repassword').val();
			var birthmonth = $('#birthmonth').val();
			var birthyear = $('#birthyear').val();
			var birthday = $('#birthday').val();
			var gender = $('#gender').val();
			var phone = $('#phone').val();				
			
			/*
			$.ajax({
			    url: "index.php",
			    method: "post",
			    data: { 
			    	'username': username, 
			    	'password': password,
			    	'code': code,
			    	'fullname': fullname,
			    	'email': email,
			    	'birthdate': birthdate,
			    	'gender': gender,
			    	'phone': phone
			    	},
			    cache : false,
			    success: function(result) {
			        res_code = result;
			        if(res_code==100) {
			           // $('#wrong_info').html('用户名不存在');
			           // $('#wrong_info').animate({ width:"180px"},1000);
			        }
			            
			        else if(res_code==300) {
			        	//$('#wrong_info').html('用户名或者密码不正确'); 
			        	//$('#wrong_info').animate({ width:"180px"},1000);
			        	     	                 	
			        }
			
			        else if(res_code==200) {
			            transition();
			            window.setTimeout(function(){
			
			             // Move to a new location or you can do something else
			             window.location.replace("/");
			
			                }, 5000);
			            
			            }
			        },            
			        error: function(jqXHR, textStatus, errorThrown) {
			            alert(errorThrown);
			        }
			   });
			   
			  
			   alert("AJ");       
		} // End of onSuccess	
		           	
    });

}); // End of doc ready
		
</script>

</head>
<body>	
<? include $_SERVER['DOCUMENT_ROOT']."/includes/menu.php"; ?>
<div id="popover"></div>

<div class="form">
<h1 style="margin-bottom: 1em; font-size: 20pt;">注册</h1>	
<form id="register_form" method="post" onsubmit="return register();">
	
	<p class="contact"><label for="name">邀请码/Membership Code</label></p> 
	<input id="code" name="code" placeholder="Enter the code given by an administrator" required="" tabindex="1" type="text"> 
	 
	<p class="contact"><label for="name">姓名/Name</label></p> 
	<input id="fullname" name="fullname" placeholder="First and last name" required="" tabindex="1" type="text"> 
	 
	<p class="contact"><label for="email">邮箱/Email</label></p> 
	<input id="email" name="email" placeholder="example@domain.com" required="" type="email"> 
    
    <p class="contact"><label for="username">用户名/Create a username</label></p> 
	<input id="username" name="username" placeholder="username" required="" tabindex="2" type="text"> 
	 
    <p class="contact"><label for="password">建立密码/Create a password</label></p> 
	<input type="password" id="password" name="password" required=""> 
    <p class="contact"><label for="repassword">确认密码/Confirm your password</label></p> 
	<input type="password" id="repassword" name="repassword" required=""> 

   <fieldset>
     <label>生日/Birthday</label>
      <label class="month"> 
      <select class="select-style" name="BirthMonth" id="birthmonth">
      <option value="">Month</option>
      <option  value="01">January</option>
      <option value="02">February</option>
      <option value="03" >March</option>
      <option value="04">April</option>
      <option value="05">May</option>
      <option value="06">June</option>
      <option value="07">July</option>
      <option value="08">August</option>
      <option value="09">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12" >December</option>
      </label>
     </select>    
    <label>日/Day<input class="birthday" maxlength="2" name="BirthDay" id="birthday"  placeholder="Day" required=""></label>
    <label>年份/Year <input class="birthyear" maxlength="4" name="BirthYear" id="birthyear" placeholder="Year" required=""></label>
  </fieldset>
  
<select class="select-style gender" name="gender" id="gender">
<option value="select">我是/i am...</option>
<option value="m">男性/Male</option>
<option value="f">女性/Female</option>
<option value="other">其它/Other</option>
</select><br><br>

<p class="contact"><label for="phone">电话号码/Mobile phone</label></p> 
<input id="phone" name="phone" placeholder="phone number" required="" type="text"> <br /><br />
<input class="buttom" name="submit" id="submit" tabindex="5" value="提交表格" type="button" /> 	 
</form> 
</div>      

</body>
</html>
<?
*/