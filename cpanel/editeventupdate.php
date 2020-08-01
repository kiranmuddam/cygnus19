<?php

session_start();
if(!isset($_SESSION['tz_webteam']) && !isset($_SESSION['tz_organizer']))
{
	header("location:index.php");
}
require_once("site-settings.php");
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($con,$_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);
$orgbranch=$getuserdata['branch'];
$eventdat=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM events ORDER BY eid DESC LIMIT 1"),MYSQLI_BOTH);
$lastid=$eventdat['eid'];


if(isset($_SESSION['tz_webteam']) || isset($_SESSION['tz_organizer']))
{

if(isset($_POST['event_add']))
	{
$eid=mysqli_real_escape_string($con,$_POST['uhid']);
$eventname=mysqli_real_escape_string($con,$_POST['eventname']);
$participants=mysqli_real_escape_string($con,$_POST['participants']);
$minparticipants=mysqli_real_escape_string($con,$_POST['minparticipants']);
$yearrestrictions=mysqli_real_escape_string($con,$_POST['yearrestrictions']);
$resarP1=0;
$resarP2=0;
$resarE1=0;
$resarE2=0;
$resarE3=0;
$resarE4=0;
if($yearrestrictions=="yes")
		{
$resarP1=mysqli_real_escape_string($con,$_POST['resarP1']);
$resarP2=mysqli_real_escape_string($con,$_POST['resarP2']);
$resarE1=mysqli_real_escape_string($con,$_POST['resarE1']);
$resarE2=mysqli_real_escape_string($con,$_POST['resarE2']);
$resarE3=mysqli_real_escape_string($con,$_POST['resarE3']);
$resarE4=mysqli_real_escape_string($con,$_POST['resarE4']);
		}
$description=mysqli_real_escape_string($con,$_POST['description']);
$instructions=mysqli_real_escape_string($con,$_POST['instructions']);
$organizers=mysqli_real_escape_string($con,$_POST['organizers']);
$schedule=mysqli_real_escape_string($con,$_POST['schedule']);
$prizes=mysqli_real_escape_string($con,$_POST['prizes']);
$valid_folder=0;
$valid_extension=0;

		
	if($yearrestrictions=="no")
		{
       mysqli_query($con,"UPDATE events SET eventname='$eventname',participants='$participants',minparticipants='$minparticipants',isyearrestrictions='$yearrestrictions',description='$description',instructions='$instructions',organizers='$organizers',schedule='$schedule',prizes='$prizes' WHERE eid='$eid'  ");
		}
		else
		{
  mysqli_query($con,"UPDATE events SET eventname='$eventname',participants='$participants',minparticipants='$minparticipants',isyearrestrictions='$yearrestrictions',description='$description',instructions='$instructions',organizers='$organizers',schedule='$schedule',prizes='$prizes' WHERE eid='$eid' ");

  mysqli_query($con,"UPDATE isyearrestrictions SET eventname='$eventname',P1='$resarP1',P2='$resarP2',E1='$resarE1',E2='$resarE2',E3='$resarE3',E4='$resarE4' WHERE eid='$eid' " );
		}
		echo "<script>alert('Event successfully updated');window.location='editevent.php';</script>";
	}
	

		}



?>
