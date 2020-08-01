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
$visits=mysqli_query($con,"SELECT * FROM page_logs where dates='$today' and stuid='$stuid' and page='Register'");
$cm=mysqli_num_rows($visits);
  if($cm<=0){
mysqli_query($con,"INSERT INTO page_logs(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Register','Cygnus','$stuid')");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Register','Cygnus','$stuid')");
   }else{
mysqli_query($con,"UPDATE page_logs SET no_of_times=no_of_times+1 where dates='$today' and page='Register' and stuid='$stuid'");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Register','Cygnus','$stuid')");        
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
 <title>Register | Cygnus'19</title>
 <?php include_once ('css.php') ?>
 <style type="text/css">
   .hi{
    color:#fff !important;
    background-color:#000 !important;
   }
 </style>
<script type="text/javascript">
      
function shwfields(num,eid)
{
var str="<table id='customers' width='300px'>";
var f=0;
for(var i=1;i<=num;i++)
{
f++;
var clls=(f>0)?"alt":"";
str=str+"<tr class='"+clls+"'><td><span style='color:#fff;'>University ID"+i+"</span> :</td><td> &nbsp;&nbsp;<input type='text' placeholder='ex : N1XXXXX' id='stuid"+i+"'' class='hi'></td></tr>";  
}
str=str+"<tr><td colspan='2'><center><br><a class='button purple' style='cursor:pointer;' id='btn-reg' onclick=doevereg("+num+","+eid+")>Register</a>&nbsp;&nbsp;&nbsp;&nbsp;<span id='loader' style='display:none;'><img src='img/loading8.gif'></span></center></td></tr></table>";    
document.getElementById("shwinp").innerHTML=str;

}

function shwf(va,eid)
{
if(isNaN(va)==true){

notify("This is Not a Number","error","2000","true"); 
  }
else
{
shwfields(va,eid);  
}
}

function pick1(field){return document.getElementById(field).value;}

function doevereg(part,eid)
{
var ids="",valid=0;
for(var i=1;i<=part;i++)
{
if(pick1("stuid"+i)=="" || pick1("stuid"+i)==undefined)
{
//dofocus("stuid"+i);
$.toast({
            heading: 'Fields are empty',
            text: 'All fields must be filled',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'warning',
            hideAfter: 3500

        });
break;  
}
else
{
if(i==part){
  k=pick1("stuid"+i);
  k=k.toUpperCase();
  ids=ids+k;}
else{
  
  k=pick1("stuid"+i);
  k=k.toUpperCase();
  ids=ids+k+"~";} 
valid++;
} 
}
if(part==valid){

 $(document).ajaxError(function(e, xhr, opt){
     
      if((opt.url=="eventreg-db.php" && xhr.status!="200"))
        {
    $("#loader").hide();
    $.toast({
            heading: 'Connection Error',
            text: 'There is no Connection to server.Please fix Connection problem',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'warning',
            hideAfter: 3500

        });
   

    } 
    });
//confirmation
    if(confirm("Are you sure to Register?")) {
      
          
var datastring="eid="+eid+"&part="+part+"&ids="+ids;
$.ajax({
type:"POST",
url:"eventreg-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){
  $("#btn-reg").html(' Sending ...');  
},
success:function(data){if(data.indexOf("success")!=-1){
  $.toast({
            heading: 'Registered Succesfully',
            text: 'We Will See You At The Event.',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3500

        });
  location.reload();
  $("#btn-reg").html('REGISTER');
}
  else{
    $.toast({
            heading: 'Error Occured',
            text: ''+data+'',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'warning',
            hideAfter: 3500

        });
    $("#btn-reg").html('REGISTER');
  }}
});

          
        } else {
          return false;
        }
    
  
} 
}</script>

</head>
  <body class="index">



   <?php include_once('header.php');?> 

<?php 
if(isset($_GET['eve'])){
$stuid=$_SESSION['stuid'];  
$valid=0;  
$eid=(mysqli_real_escape_string($con,$_GET['eve']));
$query=mysqli_query($con,"SELECT * FROM events WHERE eid='$eid' && visibility='1'");
$c=mysqli_num_rows($query);
if($c>=1){ $valid=1; }
if($valid==1){
  mysqli_query($con,"UPDATE events SET views=views+1 WHERE eid='$eid'");
}
$query_fet=mysqli_fetch_array($query,MYSQLI_BOTH);
$ll=mysqli_query($con,"SELECT * FROM users WHERE stuid='$stuid'");
$user_fet=mysqli_fetch_array($ll,MYSQLI_BOTH);
}
?>
 <div class="tournaments-page">  
<section class="schedule-section">

   <div class="heading" style="margin-left:10vh;">
   <center>
      <div class="copy">        
         <h3><?php echo $query_fet['eventname'];?></h3>
         <h5>Register to participate!</h5>         
      </div>
</center>
   </div>
   
   <ul class="content-tabs">
      <div class="content-tabs-content">
         
         <li>
            <a href="#" class="active">About</a>
         </li>
         <li>
            <a href="#">Rules</a>
         </li>
         <li>
            <a href="#">Organizers</a>
         </li>
         <li>
            <a href="#">Schedule</a>
         </li>        
         <li>
            <a href="#">Winners</span></a>
         </li>
          <li>
            <a href="#">Teams</span></a>
         </li>
          <li>
            <a href="#">Register</span></a>
         </li>
      </div>
   </ul>
   <ul class="tab-content-list">
      <li class="active">
         <div class="schedule">
              <?php echo $query_fet['description'];?>
              <h4>Prizes:</h4>
              <?php echo $query_fet['prizes'];?>        
         </div>
      </li>
      <li>
         <div class="schedule">
               <?php echo $query_fet['instructions'];?>
         </div>
      </li>
      <li>
         <div class="schedule">
               <?php echo $query_fet['organizers'];?>
         </div>
      </li>
      <li>
         <div class="schedule">
               <?php echo $query_fet['schedule'];?>
         </div>
      </li>    
      <li>
         <div class="schedule">
               <?php echo $query_fet['winners'];?>
         </div>
      </li>
      <li>
         <div class="schedule">
               <?php
     
  $kt=mysqli_query($con,"SELECT * FROM event_registrations WHERE eid='$eid'") or die(mysql_error());
  echo "<table  cellpadding='10' style='text-align:center;width:100%;'><tr>";
    
  if(mysqli_num_rows($kt)>0)
  {
      $kkg=0;
  while($fkt=mysqli_fetch_array($kt,MYSQLI_BOTH))
    {
    $mt=array();
    $mt=$fkt['ids'];
    $super=explode("~",$mt);
     $keka=count($super);
      if($keka>1){
     echo'
      <div class="button-container" style="display:inline;">
<a class="button green-border nav-anchor" href="#" style="width:auto;height:auto;padding:auto;">
                      <span class="solo-vertical-align">Team ID :'.$fkt['teamid'].'<br>'; ?>
                       <?php 
                        for($y=0;$y<$keka;$y++)                         
                            echo $super[$y]."<br>";                          
                         ?>
                      </span>
                    </a>
                  </div>
                  <?php     
    }else{
      echo'
       <div class="button-container" style="display:inline;">
<a class="button green-border nav-anchor" href="#" style="width:13.5rem;height:3.625rem;padding:3rem 0rem;">
                      <span class="solo-vertical-align">Team ID :'.$fkt['teamid'].'<br>'; ?>
                      <?php 
                        for($y=0;$y<$keka;$y++)                         
                            echo $super[$y];                          
                         ?>
                      </span>
                    </a>
                  </div>
                  <?php
    }
}
    
    
  }
  else
    echo "<center><span class='' style='color:red;'>No Teams Registered</span></center>";
        echo "</tr></table></center>";?>
         </div>
      </li>
      <li>
         

<div class="schedule">
   <?php
   if(isset($_SESSION['stuid'])==true){ 
      $ev=array();$ev=explode("~",$user_fet['eventids']);
         if(in_array($eid,$ev)){ ?>
   <br><br>
   <center><span class='' style='color:green;'>Already Registered</span></center>
   <?php } else{
        $we=mysqli_query($con,"SELECT * FROM site_settings WHERE function='Event Registrations'");
        $ison=mysqli_fetch_array($we,MYSQLI_BOTH);
          if($ison['value']=="on"){
                if($query_fet['areregistrationson']=="on"){
                    $re=mysqli_query($con,"SELECT * FROM users WHERE stuid='$stuid'");
                    $user_fet=mysqli_fetch_array($re,MYSQLI_BOTH);
                      if(1!=1){?>
                          <br><br>
                              <center><span class='' style='color:red;'>You are not allowed to Register to this event</span></center>
                        <?php
                            } else if($query_fet['participants']==$query_fet['minparticipants']) {
                                    echo "<br><center><table id='customers' width='300px'>";
                                      $fg=0;        
                                      for($i=1;$i<=$query_fet['participants'];$i++){
                                      $fg++;
                                      $cll=($fg<0)?"":"alt";
                                      /*print "<tr class='".$cll."'>
                                      <td><span style='color:#fff;font-weight:bold;font-family:Times New Roman'>University ID ".$i."</span> &nbsp;&nbsp; : &nbsp;&nbsp;</td><td><input type='text' placeholder='University ID' id='stuid".$i."' style='background:#fff;'></td></tr>";*/
                                      print ' <div class="inputs"> <div class=" form-modal input-container contact-last-name ">  
                                                <input type="text" placeholder="University ID" class="hi"  name="password" id="stuid'.$i.'">    
                                      </div></div>';  }

                                      print "<tr><td colspan='2'><br><center><a class='button purple' style='cursor:pointer;' id='btn-reg' 
                                        onclick=doevereg(".$query_fet['participants'].",".$eid.")>Register</a>&nbsp;&nbsp;&nbsp;&nbsp;<span id='loader' style='display:none;'><img src='img/loading8.gif'></span></center></td></tr></table>";    
                                      echo "</center>";
                            } else {
                                    echo "<br><center><span style='color:#fff;font-weight:bold;'>No.of Participants</span> &nbsp;&nbsp;: &nbsp;&nbsp;";
                                    echo "<span style='width:100px;'><select class='selecteve' style='padding:5px;color:white !important;' onchange='shwf(this.value,".$eid.")'>";
                                    echo "<option value='' style='color:white !important;'>Select</option>";
                                    for($i=$query_fet['minparticipants'];$i<=$query_fet['participants'];$i++){
                                            echo "<option value='".$i."' style='color:white !important;'>".$i."</option>";  
                                    }
                                    echo "</select></span><br><br><span id='shwinp'></span></center>";                    
                            }
        } else {?> 
          <br><br>
          <center><span class='' style='color:red;'>Registration for This Event has been Closed</span></center>
      <?php } ?>
<?php } else {?>
    <br><br>
   <center><span class=''  style='color:red;'>Registration for all Events are Closed</span></center>
   <?php  } ?>

  

<?php } } else{ ?>
   <center><span class=''>Please <a href="#" data-modal="contact-modal" style='cursor:pointer;color:red;'>Login</a> to Register to this event</span></center>
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
