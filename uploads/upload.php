<?php

//error_reporting(0);
date_default_timezone_set("Asia/Calcutta");
setlocale(LC_ALL,"hu_HU.UTF8");
$time=(strftime("%Y, %B %d, %A."))." ".date("h:i:s a");
$ip=$_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
ini_set('max_execution_time', 6000);
$status="NO";

if($_SERVER['REQUEST_METHOD']=="POST")
{

//database variables
$database_name="uploads19";
//database connection
$conn=mysqli_connect("localhost","","","uploads19");
if(isset($_POST['stuid']) && !empty($_POST['stuid']) && isset($_POST['stuname']) && !empty($_POST['stuname']) && isset($_POST['projname']) && !empty($_POST['projname']) && isset($_FILES['file']) && !empty($_FILES['file']))
{
$stuid=mysqli_real_escape_string($conn,$_POST['stuid']);
$stuname=mysqli_real_escape_string($conn,$_POST['stuname']);
$projname=mysqli_real_escape_string($conn,$_POST['projname']);
if($projname=="Hidden Photography" || $projname=="Maded" || $projname=="Dubsmash" || $projname=="10yrschallenge" || $projname=="Articles"){
	$filename=$_FILES['file']['name'];
$filezie=$_FILES['file']['size'];
if($filename=="")
{

echo "<script>alert('Please Enter file Name');</script>";	
header("location:index.php");	
exit();
}

if($filesize>51024)
{

echo "<script>alert('Please Reduce file size to 50MB');</script>";	
header("location:index.php");	
exit();
}

$qu=mysqli_query($conn,"SELECT * FROM users WHERE stuid='$stuid'");
if(mysqli_num_rows($qu)>=1)
{
$mainp="Cygnus19_Uploads";
if(!is_dir($mainp)){mkdir($mainp);}
$quu=mysqli_fetch_array($qu,MYSQLI_BOTH);
if(!is_dir($mainp."/".$projname)){mkdir($mainp."/".$projname);}
if(!is_dir($mainp."/".$projname)){mkdir($mainp."/".$projname);}
$random = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 5);

$isal=mysqli_query($conn,"SELECT * FROM submits WHERE stuid='$stuid'");
$ext=pathinfo($filename,PATHINFO_EXTENSION);
$allowed=array("pdf","doc","ppt","odt","jpg","jpeg","zip","rar","PDF","DOC","PPT","ODT","JPG","ZIP","RAR","mp4","mkv");
if(in_array($ext,$allowed))
{
$newf=$stuid."_".$projname.".".$ext;
if(move_uploaded_file($_FILES['file']['tmp_name'],$mainp."/".$projname."/".$newf))
{
if(mysqli_query($conn,"INSERT INTO submits(stuid,name,year,branch,filename,ip) VALUES('$stuid','".$quu['stuname']."','".$quu['year']."','".$quu['branch']."','$projname','$ip')"))
{
$status="YES";

mysqli_query($conn,"INSERT INTO tries(stuid,msg,status,ip) VALUES('$stuid',Uploaded','$status','$ip')");
echo "<script>alert('Uploaded Successfully...');window.location='index.php';</script>";
}
else
{
mysqli_query($conn,"INSERT INTO tries(stuid,msg,status,ip) VALUES('$stuid','Problem in inserting into db','$status','$ip')");
echo "<script>alert('Problem in Inserting');window.location='index.php';</script>";	
}
}
else
{
	
mysqli_query($conn,"INSERT INTO tries(stuid,msg,status,ip) VALUES('$stuid','Problem in file moving','$status','$ip')");
echo "<script>alert('Problem in Moving');window.location='index.php';</script>";
}
}
else
{
mysqli_query($conn,"INSERT INTO tries(stuid,msg,status,ip) VALUES('$stuid','Not a valid file','$status','$ip')");;
echo "<script>alert('Invalid File format');window.location='index.php';</script>";	
}
}
else
{
mysqli_query($conn,"INSERT INTO tries(stuid,msg,status,ip) VALUES('$stuid','Not a valid Student ID','$status','$ip')");
echo "<script>alert('Invalid University ID');window.location='index.php';</script>";
}
}
else{
echo "<script>alert('Please Select A Valid Event Option');window.location='index.php';</script>";
}

}

else
{
mysqli_query($conn,"INSERT INTO tries(stuid,msg,status,ip) VALUES('$stuid','Not All parametres are passing','$status','$ip')");
header("location:index.php");	
}

}
else
{
mysqli_query($conn,"INSERT INTO tries(stuid,msg,status,ip) VALUES('$stuid','Not a Request Method','$status','$ip')");
header("location:index.php");	
}
?>
