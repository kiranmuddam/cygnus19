<?php
header('Content-Type: application/json');
$input = filter_input_array(INPUT_POST);
session_start();
if(!isset($_SESSION['tz_webteam']))
{
	header("location:index");
}
require_once("site-settings.php");
if ($input['action'] === 'edit') {
	if($input['action_o']==01){
		mysqli_query($con,"UPDATE site_settings SET value='on' WHERE sno='".$input['sno']."'");	
	}else if($input['action_o']==02){ 
		mysqli_query($con,"UPDATE site_settings SET value='off' WHERE sno='".$input['sno']."'");
    }
}
echo json_encode($input);
?>
