<?php
session_start();
if(!isset($_SESSION['tz_webteam']))
{
	header("location:index");
}
require_once("site-settings.php");
if(isset($_SESSION['tz_webteam'])==false){
$session=$_SESSION['tz_organizer'];	
}else{
$session=$_SESSION['tz_webteam'];
}
$t=mysqli_query($con,"SELECT * FROM organizers WHERE orgid='$session'");
$getuserdata=mysqli_fetch_array($t,MYSQLI_BOTH);


if(isset($_SESSION['tz_webteam']))
{

if(isset($_POST['orgid']) && isset($_POST['orgname'])  && isset($_POST['orgmob']) && isset($_POST['orgbranch']) && isset($_POST['orggender']) && isset($_POST['orgpass']) && isset($_POST['orgeveids']))
	{

	$orgid=(mysqli_real_escape_string($con,$_POST['orgid']));
	$orgpass=(mysqli_real_escape_string($con,$_POST['orgpass']));
	$orgname=(mysqli_real_escape_string($con,$_POST['orgname']));
	$orgbranch=(mysqli_real_escape_string($con,$_POST['orgbranch']));
	$orggender=(mysqli_real_escape_string($con,$_POST['orggender']));
	$orgeveids=(mysqli_real_escape_string($con,$_POST['orgeveids']));
	$orgmob=(mysqli_real_escape_string($con,$_POST['orgmob']));
   $orgpass=md5($orgpass);
   $check_already=mysqli_query($con,"SELECT * FROM organizers WHERE orgid='$orgid'");
   if(mysqli_num_rows($check_already)>=1)
		{
	   echo "<script>alert('AlreadyAdded');window.location='addorganizer.php'</script>";
		}
		else
		{
		if(mysqli_query($con,"INSERT INTO organizers(orgid,name,orgpass,gender,branch,orgmob,eids) VALUES('$orgid','$orgname','$orgpass','$orggender','$orgbranch','$orgmob','$orgeveids')"));
			{
			
			$eve=array();
			$eve=explode("~",$orgeveids);	
			for($i=0;$i<count($eve);$i++)
			{
			mysqli_query($con,"UPDATE events SET orgcount=orgcount+1 WHERE eid='".$eve[$i]."'") or die(mysqli_error());	
			}
				echo "<script>alert('Added');window.location='addorganizer.php'</script>";
				
				
				}
		}
		}

}
?>
