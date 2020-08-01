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
$visits=mysqli_query($con,"SELECT * FROM page_logs where dates='$today' and stuid='$stuid' and page='Home'");
$cm=mysqli_num_rows($visits);
  if($cm<=0){
mysqli_query($con,"INSERT INTO page_logs(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Home','Cygnus','$stuid')");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Home','Cygnus','$stuid')");
   }else{
mysqli_query($con,"UPDATE page_logs SET no_of_times=no_of_times+1 where dates='$today' and page='Home' and stuid='$stuid'");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Home','Cygnus','$stuid')");        
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
 <title>Home | Cygnus'19</title>
 <?php include_once ('css.php') ?>

 <link rel="stylesheet" type="text/css" href="css/home.css">

 <script src="assets/js/shims.min.js" type="text/javascript" ></script>

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
	<polygon class="st0" points="1.1,1.5 7.7,10.5 0,19.3 2,21 2,21 11,10.7 11,10.7 3.3,0 	"/>
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
	<polygon class="st0" points="1.1,1.5 7.7,10.5 0,19.3 2,21 2,21 11,10.7 11,10.7 3.3,0 	"/>
</g>
</svg>

      </div>
    </div>
  </div>
</div>


      

      

      
        

        <div class="home-page">

          
            <header>

              
<div class="social-links-grid">
  <div class="row">
    <a href="#" class="activator">
      <svg version="1.1" class="x-icon" xmlns="" xmlns:xlink="" x="0px" y="0px"
	 viewBox="0 0 75 75" style="enable-background:new 0 0 75 75;" xml:space="preserve">
<g>
	<g>
		<polygon class="cls-1" points="47.1,48.5 24.4,28.4 26,26.6 48.7,46.7 		"/>
	</g>
	<g>
		<polygon class="cls-1" points="26,48.5 24.4,46.7 47.1,26.6 48.7,28.4 		"/>
	</g>
</g>
</svg>

      <img src="sites/5ab40c30afc5b335e7b6fa8c/theme/images/header-social986f.gif?1521749519" >
    </a>
  </div>
  <div class="row from-top">
    <a href="https://www.facebook.com/" target="_blank">
      <svg class="facebook-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="35" viewBox="0 0 18 35">
  <path id="fa-facebook" class="cls-1" d="M1850.25,998.01a7.85,7.85,0,0,0-5.77,2.15,8.2,8.2,0,0,0-2.16,6.07v4.58h-5.31v6.23h5.31v15.95h6.37v-15.95h5.29l0.81-6.23h-6.1v-3.97a3.533,3.533,0,0,1,.62-2.27,3.044,3.044,0,0,1,2.42-.76H1855v-5.548a34.26,34.26,0,0,0-4.75-.252h0Z" transform="translate(-1837 -998)"/>
</svg>

    </a>
  </div>
  <div class="row from-left">
    <a href="https://twitter.com/" target="_blank">
      <svg class="twitter-icon" xmlns="http://www.w3.org/2000/svg" width="15.969" height="13" viewBox="0 0 15.969 13">
  <path id="fa-twitter" class="cls-1" d="M532.12,2906.04a3.194,3.194,0,0,0,1.44-1.81,6.273,6.273,0,0,1-2.079.79,3.28,3.28,0,0,0-5.67,2.25,3.614,3.614,0,0,0,.081.75,8.95,8.95,0,0,1-3.769-1.01,9.331,9.331,0,0,1-2.987-2.42,3.3,3.3,0,0,0-.051,3.22,3.31,3.31,0,0,0,1.065,1.17,3.209,3.209,0,0,1-1.48-.42v0.04a3.166,3.166,0,0,0,.745,2.09,3.251,3.251,0,0,0,1.882,1.14,3.6,3.6,0,0,1-.863.11,4.714,4.714,0,0,1-.618-0.05,3.264,3.264,0,0,0,1.156,1.62,3.184,3.184,0,0,0,1.907.65,6.384,6.384,0,0,1-4.067,1.41c-0.291,0-.555-0.02-0.792-0.04a9.1,9.1,0,0,0,5.031,1.47,9.542,9.542,0,0,0,3.277-.55,8.348,8.348,0,0,0,2.617-1.49,9.855,9.855,0,0,0,1.872-2.14,9.525,9.525,0,0,0,1.171-2.52,9.378,9.378,0,0,0,.386-2.64c0-.19,0-0.34-0.011-0.43a6.816,6.816,0,0,0,1.644-1.7,6.63,6.63,0,0,1-1.887.51h0Z" transform="translate(-518.031 -2904)"/>
</svg>

    </a>
  </div>
  <div class="row from-left">
    <a href="https://www.instagram.com/" target="_blank">
      <svg class="instagram-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="19.97" viewBox="0 0 20 19.97">
  <path id="fa-instagram" class="cls-1" d="M837.508,2511.46a0.78,0.78,0,0,1-.561.22H823.022a0.773,0.773,0,0,1-.567-0.22,0.782,0.782,0,0,1-.227-0.57v-8.42h1.836a5.524,5.524,0,0,0-.26,1.7,5.722,5.722,0,0,0,1.823,4.26,6.11,6.11,0,0,0,4.39,1.76,6.243,6.243,0,0,0,3.126-.81,5.954,5.954,0,0,0,2.267-2.19,5.739,5.739,0,0,0,.834-3.02,5.524,5.524,0,0,0-.261-1.7h1.759v8.42A0.773,0.773,0,0,1,837.508,2511.46Zm-7.491-3.61a3.93,3.93,0,0,1-2.833-1.14,3.8,3.8,0,0,1,0-5.5,4.134,4.134,0,0,1,5.68,0,3.8,3.8,0,0,1,0,5.5,3.947,3.947,0,0,1-2.847,1.14h0Zm7.465-7.93a0.884,0.884,0,0,1-.639.26h-2.266a0.884,0.884,0,0,1-.639-0.26,0.867,0.867,0,0,1-.26-0.64v-2.14a0.845,0.845,0,0,1,.26-0.63,0.854,0.854,0,0,1,.639-0.27h2.266a0.9,0.9,0,0,1,.9.9v2.14A0.871,0.871,0,0,1,837.482,2499.92Zm1.771-5.15a2.479,2.479,0,0,0-1.81-.75H822.566a2.571,2.571,0,0,0-2.566,2.56v14.84a2.451,2.451,0,0,0,.756,1.81,2.477,2.477,0,0,0,1.81.75h14.877a2.569,2.569,0,0,0,2.565-2.56v-14.84A2.47,2.47,0,0,0,839.253,2494.77Z" transform="translate(-820 -2494.03)"/>
</svg>

    </a>
  </div>
</div>


<?php include 'slideshow.php';?>



              <div class="dots-container dots"></div>

              <div class="header-bottom-slides-container">
                <ul class="header-bottom-slides">
                  <li>
                    <a href="#" class="reset-font-styles" style="background-image: url(sites/5ab40c30afc5b335e7b6fa8c/theme/images/home/competitive-image986f.jpg?1521749519)">
                      <div class="content-container">
                        <h2 data-content="Cultural">Cultural</h2>

                        <div class="button scan-glitch">
                          <span class="background-container">
                            <span class="scan-lines"></span>
                            <span class="background"></span>
                            <span class="scan-glitch"></span>
                          </span>
                          <span class="text">Learn More</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="reset-font-styles" style="background-image: url(sites/5ab40c30afc5b335e7b6fa8c/theme/images/home/attractions-image986f.jpg?1521749519)">
                      <div class="content-container">
                        <h2 data-content="Creative">Creative</h2>

                        <div class="button scan-glitch">
                          <span class="background-container">
                            <span class="scan-lines"></span>
                            <span class="background"></span>
                            <span class="scan-glitch"></span>
                          </span>
                          <span class="text">Learn More</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="reset-font-styles" style="background-image: url(sites/5ab40c30afc5b335e7b6fa8c/theme/images/home/kids-image986f.jpg?1521749519)">
                      <div class="content-container">
                        <h2 data-content="Competitive">Competitive</h2>

                        <div class="button scan-glitch">
                          <span class="background-container">
                            <span class="scan-lines"></span>
                            <span class="background"></span>
                            <span class="scan-glitch"></span>
                          </span>
                          <span class="text">Learn More</span>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>

            </header>
          


          <div class="header-padding"></div>

          
            <div class="tournaments">

              <div class="heading">
                <div class="left">
                  <h3>Competitions</h3>
                  <h5>Become a cygnus star</h5>
                </div>
<?php   
  $eve=mysqli_query($con,"SELECT * FROM events where visibility=1");
  $c=mysqli_num_rows($eve);
?>
                <div class="right">
                  <h6>
                    <span class="current-slide">03</span>/<span class="total"><?php echo $c ?></span>
                  </h6>
                  <div class="arrows-container purple-square-arrows"></div>
                </div>
              </div>

              <div class="tournament-list-container">
                <ul class="tournament-list">
                  
        <?php      
        while($eve_fet=mysqli_fetch_array($eve,MYSQLI_BOTH)){
          ?>
                      <li class="tournament">

                        <a href="register.php?eve=<?php echo $eve_fet['eid'];?>" target="_blank" class="reset-font-styles skewed-container">
                          <div class="unskewed-container unskewed-image-container">
                            <div class="unskewed image-container">
                              <div class="image" style="background-image: url('images/ss.png')"></div>
                              <div class="image" style="background-image: url('images/ss.png')"></div>
                              <div class="image" style="background-image: url('images/ss.png')"></div>
                              <div class="image" style="background-image: url('images/ss.png')"></div>
                            </div>
                          </div>

                          <div class="unskewed-container unskewed-info-container">
                            <div class="unskewed info-container">
                              

                              <div class="">
                                <span class="button glitch register-button col-white"><?php echo $eve_fet['eventname'];?></span>
                              </div>
                            </div>
                          </div>
                        </a>
                      </li>
                    
                     <?php } ?>
                  
                </ul>

                <a href="#" class="button scan-glitch" data-modal="tournament-modal">
                  <span class="background-container">
                    <span class="scan-lines"></span>
                    <span class="background"></span>
                    <span class="scan-glitch"></span>
                  </span>
                  <span class="text">View all events</span>
                  <svg version="1.1" class="new-right-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 31 13" style="enable-background:new 0 0 31 13;" xml:space="preserve">
<g>
	<g>
		<polygon class="st0" points="26.4,0 25.1,0.9 29,6.5 24.4,12 25.6,13 31,6.6 		"/>
	</g>
	<g>
		<g>
			<rect y="5.5" class="st0" width="29" height="2"/>
		</g>
	</g>
</g>
</svg>

                </a>
              </div>
            </div>
          
<?php include 'event_map.php' ?>                              
<?php include 'special_events.php' ?>
      </div>    
<?php include 'title.php' ?>
</div>
<?php include 'login_modal.php' ?>
<?php include 'event_modal.php' ?>
<?php include 'footer.php' ?>
 
