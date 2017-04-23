<?

    include 'config.php';
    session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link href="register_code.css" rel="stylesheet" type="text/css" />	
<script type="text/javascript" src="/scripts/jquery-1.11.2.min.js"></script>

<script type="text/javascript" src="lib/hashids.js"></script>
<script type="text/javascript" src="lib/hashids.min.js"></script>
	
</head>
<body>

	
	<h2>邀请码发放</h2>
    <table id="input" style="width:800px">
    <tr>
    <th>秘钥</th>
    <th>邀请码</th>
    <th>状态</th>
    </tr>
    
    </table>
	<input type="button" id="generate_code" onclick="check_key();" value="随机产生邀请码">	    
	  
	  <script>	
       var iscode_used;	

		function check_key() {
		    /*
		var key1 =  Number(document.getElementById('number1').value);
	    var key2 =  Number(document.getElementById('number2').value);
	    var key3 =  Number(document.getElementById('number3').value);*/
	    
	    var key1 = Math.floor((Math.random() * 100) + 1);
	    var key2 = Math.floor((Math.random() * 100) + 1);
	    var key3 = Math.floor((Math.random() * 100) + 1);
	    console.log(key1);
	    console.log(key2);
			if ((0<key1<1000)&&(0<key2<1000)&&(0<key3<1000)) {

			    console.log(key3);
                var hashids = new Hashids("this is my salt"),
                id = hashids.encode(key1,key2,key3),
                numbers = hashids.decode(id);
                console.log('decode:'+id);
                //$("#output").append('<li>'+id+'</li>');
			    /* store the content in database */
			    var comb_key = "["+numbers.join(", ")+"]";
			    console.log(comb_key);
                $.ajax({
                    url: "/Management/register_code.php",
                    method: "post",
                    data: { 'id': id , 'comb_key' : comb_key},
                    cache : false,
                    success: function(result) {
                        alert("新的邀请码！successfully!");
                        if(Number(result) == 1) {
                            iscode_used = "还未用";
                        } else if (Number(result) == 2) {
                            iscode_used = "已使用";
                        } else {
                            iscode_used = "未使用";
                        }
                        $("#input").append('<tr><td>'+"["+numbers.join(", ")+"]"+'</td><td>'+id+'</td><td>'+iscode_used+'</td></tr>');
                    },            
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                    });
                /*-------------------------------*/		
			} else {
				alert("!!");
			}
		 	  
		}
	  </script>
	  
</ul>
</body>
</html>