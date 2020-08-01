<?php
session_start();
require_once("site-settings.php");

if(isset($_SESSION['tz_organizer']))
{

mysqli_query($con,"UPDATE organizers SET status='offline' WHERE orgid='".$_SESSION['tz_organizer']."'");
unset($_SESSION['tz_organizer']);
}

if(isset($_SESSION['tz_webteam']))
{unset($_SESSION['tz_webteam']);
}
session_destroy();
print "<center><h3>Redirecting to Main Page..</h3></center>";
header("location:index.php");
?>
