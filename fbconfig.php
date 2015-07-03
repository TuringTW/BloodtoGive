<?php
session_start();
require_once('src/facebook.php');  // Include facebook SDK file
require_once('mysql_info.php');
function checkuser($fuid,$ffname,$femail){
    $currtimestr=date("Y-m-d H:i:s");
    global $link;
    $check = mysqli_query($link,"select * from `user` where `fb_id`='$fuid'");
    $check = mysqli_num_rows($check);
    
    if ($check==0) {
        $today = date('Y-m-d');
        $sql = "INSERT INTO user (fb_id,email,name,license_date,donate_date,donate_place,donate_times,donate_volume,donate_divide_times,next_donate_date,health,role) 
        VALUES ('$fuid','$femail','$ffname','$currtimestr','0000-00-00','',0,0,0,'0000-00-00','',0)";
        $result = mysqli_query($link,$sql);
    }
    $_SESSION['MM_UserID'] = $fuid;

}

$facebook = new Facebook(array(
  'appId'  => '1580242192219989',   // Facebook App ID 
  'secret' => '38e8c37ef3960de4fcd15ee7b56fc19f',  // Facebook App Secret
  'cookie' => true,	
  'version' => 'v2.1'
));
// // 
$user = $facebook->getUser();
if ($user) {
  try {
    
      $user_profile = $facebook->api('/me');
      print_r($user_profile);
  	  $fbid = $user_profile['id'];                 // To Get Facebook ID
      echo "$fbid<br>";
 	    //$fbuname = $user_profile['username'];  // To Get Facebook Username

 	    $fbfullname = $user_profile['name']; // To Get Facebook full name
	    echo "$fbfullname<br>";
      $femail = $user_profile['email'];    // To Get Facebook email ID
      echo "$femail<br>";
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
      $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
      $_SESSION['MM_Username'] =  $fbid;
      print_r($_SESSION);
      // $_SESSION['USERNAME'] = $fbuname;
      //$username=$fbuname;


      //echo "hahahahahahahahahahahahahahahahahahahahahaha-";
      checkuser($fbid,$fbfullname,$femail);    // To update local DB
      //echo "-hahahahahahahahahahahahahahahahahahahahahaha";

  } catch (FacebookApiException $e) {
    echo $e;
    error_log($e);
    die();
    // $user = null;
  }
}

if ($user) {
  // die();
	header("Location: diary.php");
} else {
 $loginUrl = $facebook->getLoginUrl(array(
        'scope' => 'email','redirect_uri' => 'http://bloodtogive.azurewebsites.net/fbconfig.php' // Permissions to request from the user
        ));
 header("Location:".$loginUrl);
}
?>







<?php 



 ?>