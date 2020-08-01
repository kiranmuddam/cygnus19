<?php
header('Content-Type: application/json');

$input = filter_input_array(INPUT_POST);
session_start();
if((!isset($_SESSION['tz_organizer'])) && (!isset($_SESSION['tz_webteam'])))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);
if(isset($_POST['eid']))
{   		
    $org=$_SESSION['tz_organizer'];
	$orgname=$getuserdata['name'];
  	$eid_1=mysqli_real_escape_string($con,$_POST['eid']);
	$eid_2=mysqli_real_escape_string($con,$input['eid']);
if ($input['action'] === 'edit') {
	if($input['action_org']==01){
		mysqli_query($con,"UPDATE events SET reg_stoppedby='$org',ipstopped='$ip',timestopped='$time',areregistrationson='off' WHERE eid='$eid_1'");
	}else if($input['action_org']==02){ 
		mysqli_query($con,"UPDATE events SET areregistrationson='on' WHERE eid='$eid_1'");
    }
}
}
echo json_encode($input);
?>
