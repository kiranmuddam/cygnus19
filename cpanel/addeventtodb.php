<?php

session_start();
if(!isset($_SESSION['tz_webteam']))
{
	header("location:index.php");
}
require_once("site-settings.php");
if(isset($_SESSION['tz_webteam'])==false){
$session=$_SESSION['tz_organizer'];	
}else{
$session=$_SESSION['tz_webteam'];
}
$t=mysqli_query($con,"SELECT * FROM organizers WHERE orgid='$session'");
$getuserdata=mysqli_fetch_array($t,MYSQLI_BOTH);
$eventdat=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM events ORDER BY eid DESC LIMIT 1"),MYSQLI_BOTH);
$lastid=$eventdat['eid'];
$curid=$lastid+1;

if(isset($_SESSION['tz_webteam']))
{

if(isset($_POST['event_add']))
	{
$branch=mysqli_real_escape_string($con,$_POST['branch']);
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

if(($_FILES['file']['name'])=="")
{
	echo "<script>alert('Invalid file');</script>";
}
else
{
	$extension=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
	$allowed=array("jpg","png","jpeg","gif","JPG","JPEG","PNG","GIF");
	$filename=$_FILES['file']['name'];
	$filename="".$branch."_".$eventname."_".$curid.".".$extension."";
	
}
if(!in_array($extension,$allowed))
		{
     echo "<script>alert('File is not allowed to upload...');</script>";
		}
		else
		{
			$valid_extension=1;
		}

     if(is_dir("../event_images"))
		{
        if(is_dir("../event_images/".$branch.""))
			{
			$valid_folder=1;
			}
			else
			{
				mkdir("../event_images/".$branch."");
				$valid_folder=1;
			}
		}
		else
		{

		mkdir("../event_images");
		
        if(is_dir("../event_images/".$branch.""))
			{
			$valid_folder=1;
			}
			else
			{
				mkdir("../event_images/".$branch."");
				$valid_folder=1;
			}
		}


		if($valid_folder==1 && $valid_extension==1)
		{
			if(move_uploaded_file($_FILES['file']['tmp_name'],"../event_images/".$branch."/".$filename))	
	{
	if($yearrestrictions=="no")
		{
       mysqli_query($con,"INSERT INTO events(eid,eventname,imagename,branch,participants,minparticipants,isyearrestrictions,description,instructions,organizers,schedule,prizes)
        VALUES('$curid','$eventname','$filename','$branch','$participants','$minparticipants','$yearrestrictions','$description','$instructions','$organizers','$schedule','$prizes')") ;
       $session=$_SESSION['tz_webteam'];
       $ip=$_SERVER['REMOTE_ADDR'];
       mysqli_query($con,"INSERT INTO gallery (eventid,event_name,event_img,upload_by,upload_ip) values ('$eid','$eventname','$filename','$session','$ip')");
       mysqli_query($con,"INSERT INTO gallery_events (eventid,event_name,event_img,upload_by,upload_ip) values ('$eid','$eventname','logo.png','$session','$ip')");
		}
		else
		{
  mysqli_query($con,"INSERT INTO events(eid,eventname,imagename,branch,participants,minparticipants,isyearrestrictions,description,instructions,organizers,schedule,prizes) VALUES('$curid','$eventname','$filename','$branch','$participants','$minparticipants','$yearrestrictions','$description','$instructions','$organizers','$schedule','$prizes')");

  mysqli_query($con,"INSERT INTO isyearrestrictions(eid,eventname,branch,P1,P2,E1,E2,E3,E4) VALUES('$curid','$eventname','$branch','$resarP1','$resarP2','$resarE1','$resarE2','$resarE3','$resarE4')" );
		}
		echo "<script>alert('Event successfully added');window.location='addevent.php';</script>";
	}
	else
	{
    echo "<script>alert('File not uploaded and event not added...');</script>";
	}

		}

}
}
?>
