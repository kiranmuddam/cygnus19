    <div class="modal-content">
           <?php   
           include'connect.php'; 
error_reporting(0);
 if(isset($_SESSION['stuid'])==false){
      $stuid='Unknown';
   }else{
      $stuid=$_SESSION['stuid'];
   }

$ip=$_SERVER['REMOTE_ADDR'];
$today=date('Y-m-d');
$currentDate =  time(); 
$dat=date("Y-m-d H:i:s", $currentDate);
$visits=mysqli_query($con,"SELECT * FROM page_logs where dates='$today' and stuid='$stuid' and page='Get Notice'");
$cm=mysqli_num_rows($visits);
  if($cm<=0){
mysqli_query($con,"INSERT INTO page_logs(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Cygnus','Get Notice','$stuid')");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Cygnus','Get Notice','$stuid')");
   }else{
mysqli_query($con,"UPDATE page_logs SET no_of_times=no_of_times+1 where dates='$today' and page='Cygnus' and stuid='$stuid'");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Cygnus','Get Notice','$stuid')");        
    }
  if (isset($_REQUEST['id'])) {  
    $id = mysqli_real_escape_string($con,$_REQUEST['id']);
  $eve=mysqli_query($con,"SELECT * FROM notifications where visibility=1 and nid='$id'");
  $c=mysqli_num_rows($eve);
 $eve_fet=mysqli_fetch_array($eve,MYSQLI_BOTH);
?>
        <h3><?php echo $eve_fet['title'];?></h3>
   
                           
                <div class="button-container" style="display:inline;">
                      <a class="button green-border nav-anchor" style="width:100.3125rem;height:auto;padding:5rem 1rem;">
                      <span class="solo-vertical-align">
                        <?php echo $eve_fet['description'];?>
                      </span>
                      <?php 
                      $f=$eve_fet['attachments'];
                      if($f==""){
                        #echo"<a href='#' class='button purple'>No attachments</a>";
                      }else{
                      echo $f; 
                      }
                      ?>
                    </a>
                  </div>
                  <?php }else{ ?>

                    <div class="button-container" style="display:inline;">
                      <a class="button green-border nav-anchor" style="width:100.3125rem;height:auto;padding:5rem 1rem;">
                      <span class="solo-vertical-align">
                       Something error
                      </span>
                      
                    </a>
                  </div>
            <?php      } ?>                                                     
    </div>
