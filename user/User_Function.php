<?php
    session_start();
    function Create_Session($name, $id, $myrank) {
        include "../config.php";
        $_SESSION["User_Name"] = $name;//Set session
        $_SESSION["User_Id"] = $id;
        $_SESSION["Is_Login"] = 1;
        $_SESSION["myrank"] = $myrank;
        
        $ip = getRealIpAddr();//Get ip
        $_SESSION["User_Ip"] = $ip;
        
        $recen_time = date('Y-m-d-G:i:s');// Get last login date
        $query_log = "UPDATE users SET Last_Login_Date = :Recent_Time, Last_Ip = :Last_IpAd WHERE User_Id = :User_Id";
        $result_r = $pdo->prepare($query_log);
        $result_r->bindParam(':User_Id', $id);
        $result_r->bindParam(':Recent_Time', $recen_time);
        $result_r->bindParam(':Last_IpAd', $ip);
        $result_r->execute();
    } 
    
    function getRealIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
	
	// Function to get the client IP address
	function get_client_ip() {
    	$ipaddress = '';
   		 if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    	else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    		else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    		else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    		else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
   			 else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
   			 else
        $ipaddress = 'UNKNOWN';
    	return $ipaddress;
	}
?>