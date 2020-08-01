<?php
require("connect.php");
if(isset($_POST['cou'])){
	$nid=mysqli_real_escape_string($con,$_POST['cou']);		
mysqli_query($con,"UPDATE notifications SET views=views+1 WHERE nid='$nid'");
}
?> 
