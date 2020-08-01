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
$visits=mysqli_query($con,"SELECT * FROM page_logs where dates='$today' and stuid='$stuid' and page='Notices'");
$cm=mysqli_num_rows($visits);
  if($cm<=0){
mysqli_query($con,"INSERT INTO page_logs(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Notices','Cygnus','$stuid')");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Notices','Cygnus','$stuid')");
   }else{
mysqli_query($con,"UPDATE page_logs SET no_of_times=no_of_times+1 where dates='$today' and page='Notices' and stuid='$stuid'");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Notices','Cygnus','$stuid')");        
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
 <title>Notices | Cygnus'19</title>
 <?php include_once ('css.php') ?>
  <style type="text/css">
   .hi{
    color:#fff !important;
    background-color:#000 !important;
    width:60% !important;
   }
.notice-modal .modal{background:rgba(2,4,8,0.95)}.notice-modal .modal-content{margin:9rem 1.5rem 3rem;text-align:center}.notice-modal h3{line-height:3rem;margin-bottom:3rem;text-transform:none;font-family:gilroyextrabold,lato,"Helvetica Neue",Helvetica,Helvetica,Arial,sans-serif;letter-spacing:0;color:#fff}
th{
  font-size:20px;
  font-family:Malgun Gothic;
  /*font-style: italic;*/
}
@media screen and (max-width: 720px) {
  .hide {
    display:none;
  }
  .auto{
    width:100% !important;
    height:auto !important;
  }
}
@media screen and (min-width: 1500px) {
 
  .auto{
    width:100% !important;
  }
}

 </style>
 <script src="assets/js/jquery.min.js"></script>   
 <script>
$(document).ready(function(){
  
  $(document).on('click', '#getnotice', function(e){
    
    e.preventDefault();
    
    var uid = $(this).data('id');  
    $('#dynamic-content').html('');
      $('#modal-loader').show();
    
    $.ajax({
      url: 'getnotice.php',
      type: 'POST',
      data: 'id='+uid,
      dataType: 'html'
    })
    .done(function(data){
       
      $('#dynamic-content').html('');    
      $('#dynamic-content').html(data); 
        $('#modal-loader').hide();  
    })
    .fail(function(){
      $('#dynamic-content').html('<i class="fa fa-info-sign"></i> Something went wrong, Please try again...');
      $('#modal-loader').hide();
    });
    
  });
  
});
function updatecount(cou){
    $.ajax({
        url : "updatecount.php",
        type: "POST",
        data:"cou="+cou,
        success:function(data){},
        cache:false
    });
}
</script>       
</head>
  <body class="index">


   <?php include_once('header.php');?> 

<?php include 'notice_modal.php' ?>
 <div class="tournaments-page">  
<section class="schedule-section">

   <div class="heading" style="margin-left:40%;">
   <center>
      <div class="copy">        
         <h3>Notices</h3>         
      </div>
</center>
   </div>
   <table class="table table-bordered table-stripped" style="width:100% !important;">
    <thead>
      <tr>
        <th style="width:10%;" class="hide">Sno</th>
        <th style="width:70%;">Title</th>
        <th style="width:15%;" class="hide">Posted</th>
        <th style="width:5%;" class="hide">Visits</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $qu=mysqli_query($con,"SELECT * FROM notifications WHERE visibility='1' ORDER BY nid DESC limit 20");
    while ($quf=mysqli_fetch_array($qu,MYSQLI_BOTH)) {
      ?>
 
      <tr>
        <td class="hide"> <a class="button green-border nav-anchor" style="width:25vh;height:10vh;padding:0rem 0rem;">
                      <span class="solo-vertical-align">
                        <?php echo $quf['nid'];?>
                      </span>                      
                    </a></td>
        <td class="auto">
        <a data-modal="notice-modal" href="#" class="button green-border nav-anchor auto" style="width:110vh;height:10vh;padding:auto;"
         data-id="<?php echo $quf['nid']; ?>" id="getnotice" onclick='updatecount("<?php echo $quf['nid'];?>")'> 
          <span class="solo-vertical-align"><?php echo $quf['title'];?>
          <?php
          $today=date('m-d-Y');
          $not=$quf['added_date'];
          if($not==$today){
            echo'<img src="images/new1.gif" style="width:50px;height:30px;">' ;
          }
          ?>
           </span>
        </a>
     </td>
        <td class="hide"><a class="button green-border nav-anchor" style="width:35vh;height:10vh;padding:0rem 0rem;">
                      <span class="solo-vertical-align">
                        <?php echo $quf['time'];?>
                      </span>                      
                    </a></td>
        <td class="hide"><a class="button green-border nav-anchor" style="width:25vh;height:10vh;padding:0rem 0rem;">
                      <span class="solo-vertical-align">
                        <?php echo $quf['views'];?>
                      </span>                      
                    </a></td>
      </tr>
      
    <?php } ?>
    </tbody>
  </table>
</section>   
  </div>

<?php include 'title.php' ?>
</div>

<?php include 'login_modal.php' ?>
<?php include 'event_modal.php' ?>
<?php include 'footer.php' ?>
