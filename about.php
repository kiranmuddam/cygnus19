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
$visits=mysqli_query($con,"SELECT * FROM page_logs where dates='$today' and stuid='$stuid' and page='About'");
$cm=mysqli_num_rows($visits);
  if($cm<=0){
mysqli_query($con,"INSERT INTO page_logs(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','About','Cygnus','$stuid')");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','About','Cygnus','$stuid')");
   }else{
mysqli_query($con,"UPDATE page_logs SET no_of_times=no_of_times+1 where dates='$today' and page='About' and stuid='$stuid'");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','About','Cygnus','$stuid')");        
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
      <title>About | Cygnus'19</title>
      <?php include_once ('css.php') ?>
      <link rel="icon" href="images/logo.png"  />
      <link rel="stylesheet" type="text/css" href="assets/css/about.css">
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
               <h1 class="text2">Info</h1>
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
                     <div class="customizable-text" style="font-size:30px !important;">
                        <p  id="text">Cygnus2K19 is an Annual cultural extravaganza of IIIT Nuzvid. During the three-day event, students going to present a harmonious ensemble of the epic that sculpted morals and rich legacy of Indian traditions</p>
                     </div>
                  </div>
                  <div class="right">
                     <div class="customizable-text">
                     </div>
                     <div class="links">
                        <div>
                           <h5 class="link-title">Visit Us:</h5>
                           <a href="http://intranet.rguktn.ac.in/cygnus" class="reset-anchor-styles site-link" target="_blank">
                              <h5 class="link-text-strip">http://intranet.rguktn.ac.in/cygnus</h5>
                           </a>
                        </div>
                        <div>
                           <h5 class="link-title">Follow Us On:</h5>
                           <div class="social-links">
                              <a href="https://www.facebook.com/" target="_blank">
                                 <svg class="facebook-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="35" viewBox="0 0 18 35">
                                    <path id="fa-facebook" class="cls-1" d="M1850.25,998.01a7.85,7.85,0,0,0-5.77,2.15,8.2,8.2,0,0,0-2.16,6.07v4.58h-5.31v6.23h5.31v15.95h6.37v-15.95h5.29l0.81-6.23h-6.1v-3.97a3.533,3.533,0,0,1,.62-2.27,3.044,3.044,0,0,1,2.42-.76H1855v-5.548a34.26,34.26,0,0,0-4.75-.252h0Z" transform="translate(-1837 -998)"/>
                                 </svg>
                              </a>
                              <a href="https://www.instagram.com/" target="_blank">
                                 <svg class="instagram-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="19.97" viewBox="0 0 20 19.97">
                                    <path id="fa-instagram" class="cls-1" d="M837.508,2511.46a0.78,0.78,0,0,1-.561.22H823.022a0.773,0.773,0,0,1-.567-0.22,0.782,0.782,0,0,1-.227-0.57v-8.42h1.836a5.524,5.524,0,0,0-.26,1.7,5.722,5.722,0,0,0,1.823,4.26,6.11,6.11,0,0,0,4.39,1.76,6.243,6.243,0,0,0,3.126-.81,5.954,5.954,0,0,0,2.267-2.19,5.739,5.739,0,0,0,.834-3.02,5.524,5.524,0,0,0-.261-1.7h1.759v8.42A0.773,0.773,0,0,1,837.508,2511.46Zm-7.491-3.61a3.93,3.93,0,0,1-2.833-1.14,3.8,3.8,0,0,1,0-5.5,4.134,4.134,0,0,1,5.68,0,3.8,3.8,0,0,1,0,5.5,3.947,3.947,0,0,1-2.847,1.14h0Zm7.465-7.93a0.884,0.884,0,0,1-.639.26h-2.266a0.884,0.884,0,0,1-.639-0.26,0.867,0.867,0,0,1-.26-0.64v-2.14a0.845,0.845,0,0,1,.26-0.63,0.854,0.854,0,0,1,.639-0.27h2.266a0.9,0.9,0,0,1,.9.9v2.14A0.871,0.871,0,0,1,837.482,2499.92Zm1.771-5.15a2.479,2.479,0,0,0-1.81-.75H822.566a2.571,2.571,0,0,0-2.566,2.56v14.84a2.451,2.451,0,0,0,.756,1.81,2.477,2.477,0,0,0,1.81.75h14.877a2.569,2.569,0,0,0,2.565-2.56v-14.84A2.47,2.47,0,0,0,839.253,2494.77Z" transform="translate(-820 -2494.03)"/>
                                 </svg>
                              </a>
                              <a href="https://dribbble.com/" target="_blank">
                                 <svg class="dribble-icon" xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27">
                                    <path id="fa-dribbble" class="cls-1" d="M1624.51,997.026a11.346,11.346,0,0,1-7.36-2.635l0.27,0.193a9.344,9.344,0,0,1,1.81-2.6,15.818,15.818,0,0,1,2.3-2.011,23.432,23.432,0,0,1,2.41-1.441c0.87-.45,1.46-0.737,1.78-0.86s0.57-.22.76-0.29l0.03-.018h0.04a47.952,47.952,0,0,1,2.46,8.748,11.585,11.585,0,0,1-4.5.914h0Zm1.02-11.5c-0.11.029-.19,0.049-0.23,0.061l-0.65.228a13.24,13.24,0,0,0-1.75.844c-0.72.4-1.49,0.872-2.3,1.422a15.633,15.633,0,0,0-2.5,2.187,14.619,14.619,0,0,0-2.18,2.925,11.766,11.766,0,0,1-2.18-3.539,11.417,11.417,0,0,1-.77-4.155,3.073,3.073,0,0,1,.02-0.369,41.139,41.139,0,0,0,11.83-1.633q0.57,1.089.93,1.95A1.286,1.286,0,0,1,1625.53,985.529Zm-12.31-2.4a11.576,11.576,0,0,1,6.36-8.046,58.6,58.6,0,0,1,4.29,6.641,41.738,41.738,0,0,1-10.65,1.4h0Zm20.99,8.6a11.423,11.423,0,0,1-3.25,3.329,49.379,49.379,0,0,0-2.25-8.238,16.619,16.619,0,0,1,7.19.509A11.341,11.341,0,0,1,1634.21,991.729Zm-12.5-17.4a0.043,0.043,0,0,1,.03-0.017,0.043,0.043,0,0,0-.03.017h0Zm10.19,2.837a8.234,8.234,0,0,1-.66.711,10.727,10.727,0,0,1-1.15,1,15.436,15.436,0,0,1-1.7,1.08,16,16,0,0,1-2.28,1.063,49.89,49.89,0,0,0-4.33-6.71,11.62,11.62,0,0,1,2.73-.334,11.125,11.125,0,0,1,7.61,2.881C1632.06,976.942,1631.99,977.044,1631.9,977.167Zm3.97,8.177c-0.12-.023-0.27-0.05-0.44-0.079l-0.65-.105q-0.375-.061-0.84-0.114t-0.99-.1c-0.35-.029-0.73-0.053-1.13-0.07s-0.8-.027-1.21-0.027-0.84.012-1.29,0.035-0.89.065-1.31,0.123a2.2,2.2,0,0,1-.14-0.289c-0.05-.135-0.09-0.238-0.11-0.308-0.22-.492-0.48-1.048-0.77-1.669a19.543,19.543,0,0,0,4.07-2.275,15.5,15.5,0,0,0,1.25-1.062,10.756,10.756,0,0,0,.76-0.782c0.12-.146.23-0.29,0.33-0.43l0.02-.018a11.244,11.244,0,0,1,2.62,7.2Zm-4.58-11.523a13.6,13.6,0,0,0-13.56,0,13.462,13.462,0,0,0-4.92,4.91,13.572,13.572,0,0,0,0,13.543,13.462,13.462,0,0,0,4.92,4.91,13.61,13.61,0,0,0,13.56,0,13.511,13.511,0,0,0,4.91-4.91,13.572,13.572,0,0,0,0-13.543A13.511,13.511,0,0,0,1631.29,973.821Z" transform="translate(-1611 -972)"/>
                                 </svg>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
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
           <!--  <div class="content-container">
               <div class="left">
                  <div class="image-container">
                     <img src="sites/5ab40c30afc5b335e7b6fa8c/content_entry5ab40c8dafc5b335e7b6fae4/5ab40ce3afc5b335e7b6fc60/files/ctb-side-image9075.jpg?1521749219" class="main-image" >
                     <img src="sites/5ab40c30afc5b335e7b6fa8c/content_entry5ab40c8dafc5b335e7b6fae4/5ab40ce3afc5b335e7b6fc60/files/ctb-white-logo9075.png?1521749219" class="logo-image" >
                  </div>
                  <div class="copy">
                     <h3>CYGNUS'19 IS SPONSORED BY </h3>
                     <hr>
                  </div>
               </div>
               <div class="right">
                  <h4>Our Sponsors</h4>
                  <ul>
                     <li>
                        <div class="image-container">
                           <img src="" >
                        </div>
                     </li>
                     <li>
                        <div class="image-container">
                           <img src="" >
                        </div>
                     </li>
                     <li>
                        <div class="image-container">
                           <img src="" >
                        </div>
                     </li>
                  </ul>
               </div>
            </div> -->
         </section>
      </div>
      <?php include 'title.php' ?>
      </div>
      <?php include 'login_modal.php' ?>
      <?php include 'event_modal.php' ?>
      <?php include 'footer.php' ?>
      <script type="text/javascript" src="assets/js/about.js"></script>

