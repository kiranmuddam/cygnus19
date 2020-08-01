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
$visits=mysqli_query($con,"SELECT * FROM page_logs where dates='$today' and stuid='$stuid' and page='Contact'");
$cm=mysqli_num_rows($visits);
  if($cm<=0){
mysqli_query($con,"INSERT INTO page_logs(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Contact','Cygnus','$stuid')");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Contact','Cygnus','$stuid')");
   }else{
mysqli_query($con,"UPDATE page_logs SET no_of_times=no_of_times+1 where dates='$today' and page='Contact' and stuid='$stuid'");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Contact','Cygnus','$stuid')");        
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
 <title>Contact | Cygnus'19</title>
 <?php include_once ('css.php') ?>
  <body class="contact">


   <?php include_once('header.php');?> 
  
    

        
<div class="contact-page">
  
    

    <div class="page-content">
      <div class="content-container">
        <div class="title-container">
    

       
        </div>

       

        <ul class="locations">
                      
              <li><a href="#" class="location-info-link"></a>

                <div class="location-content">
                  <h6>Event Location</h6>

                  <div class="image-and-copy">
                    <div class="image-container">
                      <img src="sites/5ab40c30afc5b335e7b6fa8c/theme/images/contact/location-icon986f.png?1521749519" alt="" class="location-icon">
                    </div>

                    <div class="copy-container">
                      <a href="https://www.google.com/maps/place/IIIT+Nuzvid+Campus,+Nuzividu,+Andhra+Pradesh+521202/@16.7927036,80.8200512,16z/data=!3m1!4b1!4m5!3m4!1s0x3a3675e5f312c661:0xab7189f421622491!8m2!3d16.7911193!4d80.8225538" target="_blank" class="reset-font-styles">
                        <p>
                          APIIIT NUZVID,RGUKT
                          <br>
                          K2 GROUND -521202
                        </p>
                      </a>
                    </div>
                  </div>

                  
                    <div class="image-and-copy">
                      <div class="image-container">
                        <img src="sites/5ab40c30afc5b335e7b6fa8c/theme/images/contact/mobile-icon986f.png?1521749519" alt="" class="mobile-icon">
                      </div>

                      <div class="copy-container">
                        <a href="#"  class="reset-font-styles">
                          <p>
                            0000000000
                          </p>
                        </a>
                      </div>
                    </div>
                  

                  

                  
                    <div class="image-and-copy">
                      <div class="image-container">
                        <img src="sites/5ab40c30afc5b335e7b6fa8c/theme/images/contact/mouse-icon986f.png?1521749519" alt="" class="mouse-icon">
                      </div>

                      <div class="copy-container">
                        <a href="mailto:cygnus19.web@gmail.com" target="_blank" class="reset-font-styles">
                          <p class="link-text-strip">cygnus19.web@gmail.com</p>
                        </a>
                      </div>
                    </div>
                  
                </div>
              </li>
            
              <li>
                <a href="#" class="location-info-link"></a>

                <div class="location-content">
                  <h6>Contact WebTeam</h6>

                  <div class="image-and-copy">
                    <div class="image-container">
                      <img src="sites/5ab40c30afc5b335e7b6fa8c/theme/images/contact/location-icon986f.png?1521749519" alt="" class="location-icon">
                    </div>

                    <div class="copy-container">
                      <a href="https://www.google.com/maps/place/IIIT+Nuzvid+Campus,+Nuzividu,+Andhra+Pradesh+521202/@16.7927036,80.8200512,16z/data=!3m1!4b1!4m5!3m4!1s0x3a3675e5f312c661:0xab7189f421622491!8m2!3d16.7911193!4d80.8225538" target="_blank" class="reset-font-styles">
                        <p>
                          I3 F-81
                          <br>
                          
                        </p>
                      </a>
                    </div>
                  </div>

                  
                    <div class="image-and-copy">
                      <div class="image-container">
                        <img src="sites/5ab40c30afc5b335e7b6fa8c/theme/images/contact/mobile-icon986f.png?1521749519" alt="" class="mobile-icon">
                      </div>

                      <div class="copy-container">
                        <a href="#" data-phone="#" class="reset-font-styles">
                          <p>
                            000000000
                          </p>
                        </a>
                      </div>
                    </div>
                  

                  

                  
                    <div class="image-and-copy">
                      <div class="image-container">
                        <img src="sites/5ab40c30afc5b335e7b6fa8c/theme/images/contact/mouse-icon986f.png?1521749519" alt="" class="mouse-icon">
                      </div>

                      <div class="copy-container">
                        <a href="mailto:cygnus19.web@gmail.com" target="_blank" class="reset-font-styles">
                          <p class="link-text-strip">cygnus19.web@gmail.com/</p>
                        </a>
                      </div>
                    </div>
                  
                </div>
              </li>
            
          
        </ul>
      </div>

    <div class="cta-button-bar ">
  <a class="cta solo-vertical-align" href="mailto:cygnus19.web@gmail.com">    
               <span class="nav-anchor-styles">Send a Message</span>
  </a>
  <a class="cta solo-vertical-align" href="https://www.google.com/maps/place/IIIT+Nuzvid+Campus,+Nuzividu,+Andhra+Pradesh+521202/@16.7927036,80.8200512,16z/data=!3m1!4b1!4m5!3m4!1s0x3a3675e5f312c661:0xab7189f421622491!8m2!3d16.7911193!4d80.8225538" target="_blank">
    <span class="nav-anchor-styles">Get Directions</span>
  </a>
  
    <a class="cta solo-vertical-align">
      <span class="nav-anchor-styles">Call Now</span>
    </a>
  
</div>
    </div>

    
    
    


    

  </div>

  
<?php include 'title.php' ?>
</div>
<?php include 'login_modal.php' ?>
<?php include 'event_modal.php' ?>
<?php include 'footer.php' ?>
