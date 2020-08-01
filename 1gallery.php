<?php 
session_start();
error_reporting(0);
include'connect.php';
if(isset($_SESSION['stuid'])==false){
      $stuid='Unknown';
   }else{
      $stuid=$_SESSION['stuid'];
   }

$ip=$_SERVER['REMOTE_ADDR'];
$today=date('Y-m-d');
$currentDate =  time(); 
$dat=date("Y-m-d H:i:s", $currentDate);
$visits=mysqli_query($con,"SELECT * FROM page_logs where dates='$today' and stuid='$stuid' and page='Gallery'");
$cm=mysqli_num_rows($visits);
  if($cm<=0){
mysqli_query($con,"INSERT INTO page_logs(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Gallery','Cygnus','$stuid')");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Gallery','Cygnus','$stuid')");
   }else{
mysqli_query($con,"UPDATE page_logs SET no_of_times=no_of_times+1 where dates='$today' and page='Gallery' and stuid='$stuid'");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Gallery','Cygnus','$stuid')");        
    }
?>
<!DOCTYPE html>
<html class="index" lang="en" xml:lang="en" >
<head>
<meta charset='utf-8'>
<meta content='true' name='HandheldFriendly'>
<meta content='320' name='MobileOptimized'>
<meta content='initial-scale=1.0' name='viewport'>
<meta content='on' http-equiv='cleartype'>
<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
<meta content='width=device-width, initial-scale=1.0,maximum-scale=1.0,user-scalable=no,shrink-to-fit=no' name='viewport'>
<link href="index.php" rel="canonical">
 <title>Gallery | Cygnus'19</title>
 <?php include_once ('css.php') ?>
</head>
  <body class="index">

    <main class="main" role="main">

   <?php include_once('header.php');?> 




      

 <div class="about-page">

 <div class="slick-arrow-button-snippets">
  <div class="purple-square-arrows">
    <div class="purple-next-arrow-container">
      <div class="next-arrow purple-square solo-vertical-align">
        <div class="inset"></div>
        <svg version="1.1" class="right-arrow-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 11 21" style="enable-background:new 0 0 11 21;" xml:space="preserve">
<g>
  <polygon class="st0" points="1.1,1.5 7.7,10.5 0,19.3 2,21 2,21 11,10.7 11,10.7 3.3,0  "/>
</g>
</svg>

      </div>
    </div>
    <div class="purple-prev-arrow-container">
      <div class="prev-arrow purple-square solo-vertical-align">
        <div class="inset"></div>
        <svg version="1.1" class="right-arrow-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 11 21" style="enable-background:new 0 0 11 21;" xml:space="preserve">
<g>
  <polygon class="st0" points="1.1,1.5 7.7,10.5 0,19.3 2,21 2,21 11,10.7 11,10.7 3.3,0  "/>
</g>
</svg>

      </div>
    </div>
  </div>
</div>


      
     

      

  <div class="tournaments-page">
    <header>
      <ul class="background-images">                                            
      </ul>


      <div class="content-container">        
            
        <div class="crosses">
          <svg version="1.1" class="cross-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 71 65" style="enable-background:new 0 0 71 65;" xml:space="preserve">
<g>
  <g>
    <defs>
      <rect id="cross-icon-SVGID_1_" width="71" height="65"/>
    </defs>
    <clipPath id="cross-icon-SVGID_2_">
      <use xlink:href="#cross-icon-SVGID_1_"  style="overflow:visible;"/>
    </clipPath>
    <g class="st0">
      <rect x="7.5" class="st1" width="2" height="16.9"/>
    </g>
    <g class="st0">
      <rect y="7.4" class="st1" width="16.9" height="2"/>
    </g>
    <g class="st0">
      <rect x="61.5" y="0.2" class="st1" width="2" height="16.9"/>
    </g>
    <g class="st0">
      <rect x="54.1" y="7.7" class="st1" width="16.9" height="2"/>
    </g>
    <g class="st0">
      <rect x="61.5" y="48.1" class="st1" width="2" height="16.9"/>
    </g>
    <g class="st0">
      <rect x="54.1" y="55.6" class="st1" width="16.9" height="2"/>
    </g>
    <g class="st0">
      <rect x="8" y="48.1" class="st1" width="2" height="16.9"/>
    </g>
    <g class="st0">
      <rect x="0.5" y="55.6" class="st1" width="16.9" height="2"/>
    </g>
  </g>
</g>
</svg>

        </div>

      

        <div class="tournament-images-container">

          <div class="arrows-container purple-square-arrows"></div>
          <ul class="tournament-images">
            <?php 
$e=mysqli_query($con,"SELECT * FROM gallery order by id DESC");
$c=mysqli_num_rows($e);

   ?>
             <?php 
while($r=mysqli_fetch_array($e,MYSQLI_BOTH)){ ?>
                <a href="get_gallery.php?id=<?php echo $r['eventid']?>">

                <li class="tournament">
                  <center><h4 class="text" style="z-index:10000 !important;color:white !important"><?php echo $r['event_name'];?></h4></center>
                  <div class="image" style="background-image: url('images/logo.png');opacity:0.5;">
                    

                  </div>
                  
                </li></a>
              
              <?php } ?>
                             
            
          </ul>

        </div>
      </div>
    </header>
<?php include 'title.php' ?>
  </div>
</div>

</div>
<?php include 'login_modal.php' ?>
<?php include 'event_modal.php' ?>
<?php include 'footer.php' ?>
