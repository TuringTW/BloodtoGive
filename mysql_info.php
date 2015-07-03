<?php 
$mysql_host="ap-cdbr-azure-east-c.cloudapp.net";
$mysql_user="b273e57d8905e9";
$mysql_password="5f920e1f";
$database = "bloodtogive";
$link=mysqli_connect ($mysql_host,$mysql_user,$mysql_password,$database);
mysqli_query($link,"SET NAMES 'utf8'"); 

// Database=bloodtogive;Data Source=ap-cdbr-azure-east-c.cloudapp.net;User Id=b273e57d8905e9;Password=
?>