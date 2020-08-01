<?php
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
setlocale(LC_ALL,"hu_HU.UTF8");
$time=(strftime("%Y, %B %d, %A."))." ".date("h:i:s a");
//$ip=$_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
ini_set('max_execution_time', 0);

//database variables
$sessionweb="csergu@123session";  //variable for preventing SESSION HIJACKING
//database connection
$con=mysqli_connect("localhost","",'','cygnus2k19') or die(mysql_error());

/*mysql_query('SET character_set_results=utf8');
mysql_query('SET NAMES utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_connection=utf8');
mysql_query('SET collation_connection=utf8_general_ci');*/
//$endat="2016-04-01 05:00:00";

//site variables
$title="Cygnus'19";
$contact_dis="0000000000";
$email_dis="cygnus19.web@gmail.com";
$web_dis="intranet.rguktn.ac.in/cygnus";
function isloggedin(){
if(isset($_SESSION['stuid']) && !empty($_SESSION['stuid']) && isset($_SESSION['web']) && !empty($_SESSION['web']))
{
return true;
}
else
{
return false;
}
}

//include_once("../projsec/project-security.php");

?>
<head>
<link rel="icon" type="text/css" href="Cygnus_files/logo.png"  />
</head>
