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
$visits=mysqli_query($con,"SELECT * FROM page_logs where dates='$today' and stuid='$stuid' and page='Profile'");
$cm=mysqli_num_rows($visits);
  if($cm<=0){
mysqli_query($con,"INSERT INTO page_logs(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Profile','Cygnus','$stuid')");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Profile','Cygnus','$stuid')");
   }else{
mysqli_query($con,"UPDATE page_logs SET no_of_times=no_of_times+1 where dates='$today' and page='Profile' and stuid='$stuid'");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Profile','Cygnus','$stuid')");        
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
 <title>Profile | Cygnus'19</title>
 <?php include_once ('css.php') ?>
  <style type="text/css">
   .hi{
    color:#fff !important;
    background-color:#000 !important;
    width:60% !important;
   }


 </style>
</head>
  <body class="index">

<?php
$stuid=$_SESSION['stuid'];
if(isset($_POST['btn-change'])){  
  if( (!empty($_POST['passwd'])) && (!empty($_POST['cpasswd']))){    
  $new = mysqli_real_escape_string($con,$_POST['passwd']);  
  $cnew = mysqli_real_escape_string($con,$_POST['cpasswd']);
  $n=strlen($new);
  $pass=md5($new);
  if($n>=6){

      if($new==$cnew){
              $r=mysqli_query($con,"UPDATE users set passwd='$pass' WHERE stuid='$stuid'");
              if($r==true){
                    echo"<script>alert('Sucessfully Changed');window.location='logout.php';</script>";
              }else{
                    echo"<script>alert('Fileds are Missing');</script>";
              }
      }else{
          echo"<script>alert('Both Passswords Must be Same');</script>";
      }
  }else{
      echo"<script>alert('Password Length Should be > 6');</script>";
  }
  }else{
      echo"<script>alert('All Fileds are required');</script>";
  }
}

if(isset($_POST['btn-update'])){  
  if(!empty($_POST['mobile'])){    
  $new = mysqli_real_escape_string($con,$_POST['mobile']);
  $e=is_numeric($new);
  $n=strlen($new);

  if($e==true)  {
        if($n==10){
              $r=mysqli_query($con,"UPDATE users set phone='$new' WHERE stuid='$stuid'");
              if($r==true){
                    echo"<script>alert('Sucessfully Updated');window.location='logout.php';</script>";
              }else{
                    echo"<script>alert('Fileds are Missing');</script>";
              }      
        }else{
          echo"<script>alert('Mobile Number Must be 10');</script>";
        }
      }else{
         echo"<script>alert('Mobile Number Must be Numeric');</script>";
      } 
  }else{
      echo"<script>alert('All Fileds are required');</script>";
  }
}
 ?>

   <?php include_once('header.php');?> 


 <div class="tournaments-page">  
<section class="schedule-section">

   <div class="heading" style="margin-left:40%;">
   <center>
      <div class="copy">        
         <h3>Profile</h3>         
      </div>
</center>
   </div>
   
   <ul class="content-tabs">
      <div class="content-tabs-content">
         
         <li>
            <a href="#" class="active">Your Details</a>
         </li>
         <li>
            <a href="#">Update Details</a>
         </li>
         <li>
            <a href="#">Registered Events</a>
         </li>
         <li>
            <a href="#">Change Passsword</a>
         </li>                
      </div>
   </ul>
   <ul class="tab-content-list">
      <li class="active">
         <div class="schedule">
           <?php
   if(isset($_SESSION['stuid'])==true){ 
    ?>
  
              <table class="table table-bordered" style="color:#fff;width:100%">
    <thead>
    <th colspan="5"><center>Your Details</center></th>
      <tr>
        <th style="width:10%;">University ID</th>
        <th style="width:10%;">Cygnus ID</th>
        <th style="width:50%;">Name</th>
        <th style="width:10%;">Year</th>
        <th style="width:10%;">Branch</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $tit=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users WHERE stuid='".$_SESSION['stuid']."'"),MYSQLI_BOTH);
    ?>
      <tr>
      <td><?php echo $tit['stuid'];?></td>
      <td><?php echo $tit['cygnusid'];?></td>
      <td><?php echo $tit['stuname'];?></td>
      <td><?php echo $tit['year'];?></td>
      <td><?php echo $tit['branch'];?></td>
       </tr>
    </tbody>
  </table>    
  <?php  } else{ ?>
   <center><span class=''>Please <a href="#" data-modal="contact-modal" style='cursor:pointer;color:red;'>Login</a> to View the details</span></center>
   <?php } ?>  
         </div>
      </li>
      <li>
         <div class="schedule">
                       <?php
   if(isset($_SESSION['stuid'])==true){ 
    ?>
     <form action="?" method="POST">
    <input type="text" class="hi"  placeholder="Enter Mobile" name="mobile" required=""></td><br>    
    <button class='button purple' type="submit"  name='btn-update'>Update</button>
  </form>
  <?php  } else{ ?>
   <center><span class=''>Please <a href="#" data-modal="contact-modal" style='cursor:pointer;color:red;'>Login</a> to View the details</span></center>
   <?php } ?>
         </div>
      </li>
      <li>
         <div class="schedule">
                     <?php
   if(isset($_SESSION['stuid'])==true){ 
    ?>
             <table class="table table-bordered" style="color:#fff;width:100%;">
    <thead>
    <th colspan="5"><center>Registered Events</center></th>
      <tr>
        <th style="10%">Sno</th>
        <th style="width:20%;">Event Name</th>
        <th style="width:10%;">Team ID</th>
        <th style="width:60%;">Team</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $tit=mysqli_query($con,"SELECT * FROM event_registrations WHERE ids LIKE '%".$_SESSION['stuid']."%'");
    $sno=1;
    while($titf=mysqli_fetch_array($tit,MYSQLI_BOTH)){
    ?>
      <tr>
      <td><?php echo $sno++;?></td>
      <td><?php echo $titf['eventname'];?></td>
      <td><?php echo $titf['teamid'];?></td>
      <td><?php echo $titf['ids'];?></td>
       </tr>
       <?php } ?>
    </tbody>
  </table>
  <?php  } else{ ?>
   <center><span class=''>Please <a href="#" data-modal="contact-modal" style='cursor:pointer;color:red;'>Login</a> to View the details</span></center>
   <?php } ?>
         </div>
      </li>
      <li>
         <div class="schedule">
               <?php
   if(isset($_SESSION['stuid'])==true){ 
    ?>
    <form action="?" method="POST">
    <input type="password" class="hi" id="passwd" placeholder="Enter New Password" name="passwd" required=""></td><br>
    <input type="password" class="hi" id="cpasswd" placeholder="Enter Confirm New Password" name="cpasswd" required=""></td><br>
    <button class='button purple' type="submit"  name='btn-change'>Change</button>
  </form>
  <?php  } else{ ?>
    
   <center><span class=''>Please <a href="#" data-modal="contact-modal" style='cursor:pointer;color:red;'>Login</a> to View the details</span></center>
   <?php } ?>
         </div>
      </li>             
   </ul>
</section>



  </div>

<?php include 'title.php' ?>
</div>
<?php include 'login_modal.php' ?>
<?php include 'event_modal.php' ?>
<?php include 'footer.php' ?>
