<?php
session_start();
if((!isset($_SESSION['tz_organizer'])) || (!isset($_SESSION['tz_webteam'])))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($con,$_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);



if(isset($_POST['add_file']))
	{
$evename=mysqli_real_escape_string(($con,$_POST['evename']));
$catego=mysqli_real_escape_string(($con,$_POST['catego']));
$eve_hat=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM events WHERE eid='".$evename."'"),MYSQLI_BOTH);
$valid_folder=0;
$valid_extension=0;
if(($_FILES['file']['name'])=="")
{
	echo "<script>alert('Invalid file');window.history.back();</scropt>";
}
else
{
	$extension=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
	$allowed=array("zip","doc","pdf","ppt");
	$filename=$_FILES['file']['name'];
	$filename="".$eve_hat['branch']."_".$eve_hat['eventname']."_".$catego.".".$extension."";
	$filpath="event_files/".$eve_hat['branch']."/".$filename;
	
}

if(!in_array($extension,$allowed))
		{
     echo "<script>alert('File is not allowed to upload...');window.history.back();</script>";
		}
		else
		{
			$valid_extension=1;
		}
 if(is_dir("../event_files"))
		{
        if(is_dir("../event_files/".$eve_hat['branch'].""))
			{
			$valid_folder=1;
			}
			else
			{
				mkdir("../event_files/".$eve_hat['branch']."");
				$valid_folder=1;
			}
		}
		else
		{

		mkdir("../event_files");
		
        if(is_dir("../event_files/".$eve_hat['branch'].""))
			{
			$valid_folder=1;
			}
			else
			{
				mkdir("../event_files/".$eve_hat['branch']."");
				$valid_folder=1;
			}
		}
$new_set_vari=$eve_hat[$catego];
$add_set_vari=$new_set_vari."<br><br><br><a href=".$filpath." target=_blank style=cursor:pointer;color:blue;>Click here to view file</a>";

if($valid_folder==1 && $valid_extension==1)
		{
		if(move_uploaded_file($_FILES['file']['tmp_name'],"../event_files/".$eve_hat['branch']."/".$filename))
	{
 if(mysqli_query($con,"UPDATE events SET $catego='$add_set_vari'
 WHERE eid='$evename'") or die(mysqli_error()))
		{
	echo "<script>alert('File has been added to ".$eve_hat['branch']." ".$eve_hat['eventname']." ".$catego."');window.location='index.php';</script>";
		}
		else
		{
echo "<script>alert('Some error Occured....');window.location='addfilestoeventdetails.php';</script>";
		}
	}
		}


}
?>