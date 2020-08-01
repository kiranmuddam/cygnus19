<?php 
   session_start();
   error_reporting(0);
   include'connect.php';
   if(isset($_SESSION['stuid'])==false){
      $stuid='Unknown';
   }else{
      $stuid=$_SESSION['stuid'];
   }
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$ip = $_SERVER['REMOTE_ADDR'];
$today=date('Y-m-d');
$currentDate =  time(); 
$dat=date("Y-m-d H:i:s", $currentDate);
$visits=mysqli_query($con,"SELECT * FROM page_logs where dates='$today' and stuid='$stuid' and page='Marathon'");
$cm=mysqli_num_rows($visits);
  if($cm<=0){
mysqli_query($con,"INSERT INTO page_logs(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Marathon','Cygnus','$stuid')");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Marathon','Cygnus','$stuid')");
   }else{
mysqli_query($con,"UPDATE page_logs SET no_of_times=no_of_times+1 where dates='$today' and page='Marathon' and stuid='$stuid'");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Marathon','Cygnus','$stuid')");        
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
      <title>Marathon | Cygnus'19</title>
      <?php include_once ('css.php') ?>
      <link rel="icon" href="images/logo.png"  />
      <link rel="stylesheet" type="text/css" href="assets/css/about.css">
      <style type="text/css">
         .container1 img {
    display: block;
    max-width: 81.875rem !important;
    max-height: 33.875rem !important;
 }
      </style>
   </head>
   <body class="index">
      <main class="main" role="main">
      <?php include_once('header.php');?> 
      <div class="slick-arrow-button-snippets">
         <div class="purple-square-arrows">
            <div class="purple-next-arrow-container">
               <div class="next-arrow purple-square solo-vertical-align">
                  <div class="inset"></div>
                  <svg version="1.1" class="right-arrow-2" xmlns="" xmlns:xlink="" x="0px" y="0px"
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
      <div class="about-page">
         <header>
            <div class="content-container">
               <h1 class="text2">Marathon</h1>
               <img src="sites/5ab40c30afc5b335e7b6fa8c/theme/images/gradient-rectangle986f.png?1521749519" class="gradient-rectangle" >
            </div>
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
         </header>
         <section class="info-section ">
            <div class="content-container">
               <div class="titles-container">
                  <h3 class="text1"></h3>
                  
               </div>
               <div class="copy-container">
                  <div class="left">
                     <div class="customizable-text" >
                        <p style="font-size:20px !important;">The marathon is a long-distance race, completed by running, walking, or a run/walk strategy. </p>
                         <p style="font-size:20px !important;">There are also  wheelchair divisions. The marathon has an official dista-nce of  kilometres , usually run as a road race.</p>
                          <p style="font-size:20px !important;"> The event was instituted in commemoration of the fabled run of the Greek soldier Pheidippides, a messenger from the Battle of Marathon to Athens, who reported the victory.</p>
                           <p style="font-size:20px !important;">The marathon was one of the original modern Olympic events in 1896, though the distance did not become standardized until 1921. More than 800 marathons are held throughout the world each year, with the vast majority of competitors being recreational athletes as larger marathons can have tens of thousands of participants</p>
       </div>
                 </div>
<div class="right">
    <div class="image-container container1">
   <img src="images/marathan21.jpg">
</div>
</div>
               </div>
               <p style="font-size:20px !important;" >For this Cygnus, We are planing to conduct MARATHON on 4 Topics </p>
              <hr>
            </div>

         </section>
         <section class="list-section">
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
            <div class="content-container">
               <div class="left">
                  <div class="image-container">
                     
                  </div>
                  <div class="copy">
                     <h3>Topics </h3>
                     <hr>
                      <h5>1.Right to Vote</h5>
                  <h5>2.Organ Donation</h5>
                  <h5>3.Alzheimer and Breast Cancer</h5>
                  <h5>4.Go Green</h5>
                  </div>
               </div>

               <div class="right">                  
                  <h4>Marathon on</h4>
                  <ul>
                     <li>
                        <div class="image-container">
                           <img src="images/rtvote.jpg" title="Right to Vote">                           
                        </div>
                     </li>
                     <li>
                        <div class="image-container">
                           <img src="images/organ-donation.jpg"  title="Organ Donation" >
                        </div>
                     </li>
                     <li>
                        <div class="image-container">
                           <img src="images/alz.jpg"  title="Alzheimer and Breast Cancer">
                        </div>
                     </li>
                      <li>
                        <div class="image-container">
                           <img src="images/gogreen.png"  title="Go Green" >
                        </div>
                     </li>
                  </ul>
               </div>
            </div> 
         </section>
      </div>
      <?php include 'title.php' ?>
      </div>
      <?php include 'login_modal.php' ?>
      <?php include 'event_modal.php' ?>
      <?php include 'footer.php' ?>
      <script type="text/javascript" src="assets/js/marathon.js"></script>

