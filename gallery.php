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
<link rel="stylesheet" type="text/css" href="assets/css/base.css">
<link rel="stylesheet" type="text/css" href="assets/css/slider.css">
<script>document.documentElement.className="js";var supportsCssVars=function(){var e,t=document.createElement("style");return t.innerHTML="root: { --tmp-var: bold; }",document.head.appendChild(t),e=!!(window.CSS&&window.CSS.supports&&window.CSS.supports("font-weight","var(--tmp-var)")),t.parentNode.removeChild(t),e};supportsCssVars()||alert("Please view this demo in a modern browser that supports CSS Variables.");</script>
</head>

  <body class="index">

    <main class="main" role="main">

   <?php include_once('header.php');?> 




        <div class="pieces-slider">
          <!-- Each slide with corresponding image and text -->
           <?php
$r=mysqli_query($con,"SELECT * FROM gallery_events order by id");
$rows=mysqli_num_rows($r);
while($k=mysqli_fetch_array($r,MYSQLI_BOTH)){
      
        echo'
           <div class="pieces-slider__slide">
            <img class="pieces-slider__image" src="gallery_images/Posters_2159.jpg" alt="">
            <h2 class="pieces-slider__text">Poster</h2>
          </div>';         
        }
          ?>
       <!--   <div class="pieces-slider__slide">
            <img class="pieces-slider__image" src="gallery_images/Posters_2159.jpg" alt="">
            <h2 class="pieces-slider__text">Poster</h2>
          </div>

            <div class="pieces-slider__slide">
            <img class="pieces-slider__image" src="gallery_images/Posters_2327.jpg" alt="">
            <h2 class="pieces-slider__text">Poster</h2>
          </div>
 -->
          <!-- Canvas to draw the pieces -->
          <canvas class="pieces-slider__canvas"></canvas>
          <!-- Slider buttons: prev and next -->
          <button class="pieces-slider__button pieces-slider__button--prev">Prev</button>
          <button class="pieces-slider__button pieces-slider__button--next">Next</button>
        </div> 
<?php include 'title.php' ?>
<?php include 'login_modal.php' ?>
<?php include 'event_modal.php' ?>
    <script src='assets/js/anime.min.js'></script>
    <script src='assets/js/pieces.min.js'></script>
    <script src='assets/js/demo.js'></script>
<?php include 'footer.php' ?>
