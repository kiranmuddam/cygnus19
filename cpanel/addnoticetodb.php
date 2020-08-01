<?php
session_start();
if((!isset($_SESSION['tz_organizer'])) && (!isset($_SESSION['tz_webteam'])))
{
	header("location:index.php");
}
if(isset($_SESSION['tz_webteam'])==false){
$session=$_SESSION['tz_organizer'];	
}else{
$session=$_SESSION['tz_webteam'];
}
require_once("site-settings.php");
$t=mysqli_query($con,"SELECT * FROM organizers WHERE orgid='$session'");
$getuserdata=mysqli_fetch_array($t,MYSQLI_BOTH);
$role=$getuserdata['role'];
$ip=$_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);

if(isset($_POST['add_notice']))
	
	{
$evename=mysqli_real_escape_string($con,$_POST['evename']);
$catego=mysqli_real_escape_string($con,$_POST['description']);
$notetitle=mysqli_real_escape_string($con,$_POST['notetitle']);
$notesd=mysqli_real_escape_string($con,$_POST['notesd']);
$valid_folder=0;
$valid_extension=0;
$fileyes=0;
$today=date("m-d-Y");
if(($_FILES['file']['name'])=="")
{
	$fileyes=0;
}
else
{
	$fileyes=1;
	$extension=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
	$allowed=array("zip","doc","pdf","odt","docx","png","jpg","jpeg","mp4","gif");
	$filename=$_FILES['file']['name'];
	$filename="".$filename."_".$evename.".".$extension."";
	
	$filepat="<a href=notice_files/".$filename." target=_blank class=button purple>Click here to View attachment</a>";
	
if(!in_array($extension,$allowed))
		{
     echo "<script>alert('File is not allowed to upload...');</script>";
		}
		else
		{
			$valid_extension=1;
		}
 if(is_dir("../notice_files"))
		{
      
			$valid_folder=1;
			
		}
		else
		{

		mkdir("../notice_files");
		
       
			$valid_folder=1;
			
		}

}

if($fileyes==1)
		{
	//adding notice with attachment
if($valid_folder==1 && $valid_extension==1)
		{
		if(move_uploaded_file($_FILES['file']['tmp_name'],"../notice_files/".$filename))
	{
	
	
	
 if(mysqli_query($con,"INSERT INTO notifications(eid,title,description,attachments,sd,added_by,role,added_date,ip) VALUES
 			 ('$evename','$notetitle','$catego','$filepat','$notesd','$session','$role','$today','$ip')"));
		{
	mysqli_query($con,"INSERT INTO notifications_log(eid,title,description,attachments,sd,added_by,role,added_date,ip,status) VALUES
 			 ('$evename','$notetitle','$catego','$filepat','$notesd','$session','$role','$today','$ip','Success')");
	echo "<script>alert('Notice has been added".$role.",".$session."');window.history.back();</script>";
		}
		
	}
		}
		}
		else
		{
			//adding notice without attachment
			 if(mysqli_query($con,"INSERT INTO notifications(eid,title,description,sd,added_by,role,added_date,ip) VALUES 
			 	('$evename','$notetitle','$catego','$notesd','$session','$role','$today','$ip')") );
		{
	echo "<script>alert('Notice has been added');window.history.back();</script>";
		}
		

		}


}
?>
