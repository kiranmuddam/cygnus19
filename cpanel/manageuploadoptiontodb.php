<?php
header('Content-Type: application/json');

$input = filter_input_array(INPUT_POST);
session_start();
if((!isset($_SESSION['tz_organizer'])) && (!isset($_SESSION['tz_webteam'])))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($con,$_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);
if(isset($_POST['eid']))
{
   
		$eved=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM events WHERE eid='".mysqli_real_escape_string($_POST['eid'])."'"),MYSQLI_BOTH);
		
		//creating folder to store abstract files
		if(is_dir("../tzabstractsubmissions/"))
		{
		
       //creating branch folders
      if(is_dir("../tzabstractsubmissions/".$eved['branch']))
		{
		  //creating event folders
		  if(is_dir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']))
		{
		}
		else
			{

      mkdir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']);
			}
		}
		else
			{
			mkdir("../tzabstractsubmissions/".$eved['branch']);
			  //creating event folders
		  if(is_dir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']))
		{
		}
		else
			{

      mkdir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']);
			}
			}

		}
        else
		{
			//creating main folder
			mkdir("../tzabstractsubmissions/");
			    //creating branch folders
      if(is_dir("../tzabstractsubmissions/".$eved['branch']))
		{
		  //creating event folders
		  if(is_dir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']))
		{
		}
		else
			{

      mkdir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']);
			}
		}
		else
			{
			mkdir("../tzabstractsubmissions/".$eved['branch']);
			  //creating event folders
		  if(is_dir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']))
		{
		}
		else
			{

      mkdir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']);
			}
			}
 
		}
    $uplpath="tzabstractsubmissions/".$eved['branch']."/".$eved['eventname'];

        $org=$_SESSION['tz_organizer'];
		$orgname=$getuserdata['name'];
  	$eid_1=mysqli_real_escape_string($con,$_POST['eid']);
	$eid_2=mysqli_real_escape_string($con,$input['eid']);
if ($input['action'] === 'edit') {
	if($input['action_org']==01){
		mysqli_query($con,"INSERT INTO abstract_uploads_settings(eid,branch,eventname,uploadsfolderpath,added_by_id,added_by_name,added_by_ip,time) VALUES('".mysqli_real_escape_string($con,$_POST['eid'])."','".$eved['branch']."','".$eved['eventname']."','$uplpath','".$_SESSION['tz_organizer']."','".$getuserdata['name']."','$ip','$time')") or die(mysqli_error());		
	}else if($input['action_org']==02){ 
		mysqli_query($con,"UPDATE abstract_uploads_settings SET added_by_id='$org',added_by_name='$orgname',
			added_by_ip='$ip',time='$time',uploadsopen='opened' WHERE eid='$eid_1'");
    }
} else if ($input['action'] === 'delete') {
    mysqli_query($con,"UPDATE abstract_uploads_settings SET added_by_id='$org',added_by_name='$orgname',
			added_by_ip='$ip',time='$time',uploadsopen='closed' WHERE eid='$eid_1'");
} else if ($input['action'] === 'restore') {
   mysqli_query($con,"UPDATE abstract_uploads_settings SET dded_by_id='$org',added_by_name='$orgname',
			added_by_ip='$ip',time='$time',uploadsopen='Opened' WHERE eid='$eid_1'");
}
echo json_encode($input);
}
?>
