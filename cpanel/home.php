<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
  header("location:index.php");
}
require_once("site-settings.php");
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($con,$_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);
?>

<!DOCTYPE html>
<html lang="en">
   <?php include ("includes/files_include.php") ?>
<body>
  <div class="container-scroller">
   <?php include ("includes/topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        
          </div>
        </div>
        <!-- partial -->
       <?php include ("includes/sidebar.php") ?>
       <?php
       $reg_users=mysqli_num_rows(mysqli_query($con,"SELECT * FROM users "));
       $events=mysqli_num_rows(mysqli_query($con,"SELECT * FROM events "));
       $not=mysqli_num_rows(mysqli_query($con,"SELECT * FROM notifications "));  
       $org=mysqli_num_rows(mysqli_query($con,"SELECT * FROM organizers ")); 
          
       ?>
        <div class="content-wrapper">
          <?php
          if($getuserdata['role']=="Webteam")
          { 
        ?>
          <div class="row">
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-md-center">
                    <i class="fa fa-users icon-lg text-success"></i>
                    <div class="ml-3">
                      <p class="mb-0">Total Reg Users</p>
                      <h6><?php echo $reg_users ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-md-center">
                    <i class="fa fa-graduation-cap icon-lg text-warning"></i>
                    <div class="ml-3">
                      <p class="mb-0">Total Events</p>
                      <h6><?php echo $events ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-md-center">
                    <i class="fa fa-bell-o icon-lg text-info"></i>
                    <div class="ml-3">
                      <p class="mb-0">Total Notices</p>
                      <h6><?php echo $not ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-md-center">
                    <i class="fa fa-users icon-lg text-danger"></i>
                    <div class="ml-3">
                      <p class="mb-0">Total Organizers</p>
                      <h6><?php echo $org ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php
}
?>

          <div id="content">
<div id="loadingcontent">
      <?php
      if($getuserdata['role']!="Webteam")
      {
      $user_eve_data=array();
      $user_eve_data=explode("~",$getuserdata['eids']);
      $evedataemp="";
      $eventfields=array();
      $eventfields=array("participants","minparticipants","description","organizers","schedule","winners");
       for($i=0;$i<count($user_eve_data);$i++)
      {      
      $evedataemp=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM events WHERE eid='".$user_eve_data[$i]."'"),MYSQLI_BOTH);
      if($evedataemp['participants'] == 0 || $evedataemp['minparticipants'] == 0 || $evedataemp['description'] == "" || $evedataemp['organizers'] == "" || $evedataemp['schedule'] == "" || $evedataemp['winners'] == "")
        {
          $error="yes";
        }
        else
        {
          $error="no";

        }
        ?>

        <?php
        if($error=="yes")
        {
      ?>
      
<div class="alert alert-danger">
  Dear  <?php echo $getuserdata['name'];?> Following Fields are missing for the event <?php echo $evedataemp['displayname']."~".$evedataemp['eventname'] ;?>   
</div>
<?php } else {?>

<div class="alert alert-success" >
Required data for the event <?php echo $evedataemp['eventname'] ;?> has been provided...Thank You>
</div>      
<?php
}
?>




  <table class="table table-stripped table-bordered">
<tr>
<?php
if($evedataemp['participants'] == 0){echo "<td><div class='badge badge-danger'> <strong>Participants</strong></div></td>";}
if($evedataemp['minparticipants'] == 0){echo "<td><div class='badge badge-danger'> <strong>Minimumm Participants</strong></div></td>";}
if($evedataemp['description'] == ""){echo "<td><div class='badge badge-danger'> <strong>Description</strong></div></td>";}
if($evedataemp['organizers'] == ""){echo "<td><div class='badge badge-danger'> <strong>Organizers</strong></div></td>";}
if($evedataemp['schedule'] == ""){echo "<td><div class='badge badge-danger'> <strong>Schedule</strong></div></td>";}
if($evedataemp['winners'] == ""){echo "<td><div class='badge badge-danger'> <strong>Winners</strong></div></td>";}
?>
</tr> 
 </table>

  <?php
  } 
} 
if($getuserdata['role']=="Webteam")
      { 
    $branches=mysqli_query($con,"SELECT * FROM branch_categories");
     $branches_count=mysqli_num_rows($branches);
        ?>
    <Br>

    <center>
    <table class="table table-stripped table-bordered">
      <tbody>
        <tr>
    <th colspan="<?php echo $branches_count;?>">Branches</th>
  </tr>
  <tbody>
    <tr><?php while($branch_cat=mysqli_fetch_array($branches,MYSQLI_BOTH)){ echo "<td><div class='badge badge-primary'>".$branch_cat['displayname']."</div></td>"; }?></tr>
    </tbody>
    </table>
   <br>
    

    <table class="table table-stripped table-bordered">
      <tr>
    <th colspan="<?php echo $branches_count;?>">Events</th>
  </tr>
  <tbody>
    <tr><?php
      $branches=mysqli_query($con,"SELECT * FROM branch_categories");
    while( $branch_fet=mysqli_fetch_array($branches,MYSQLI_BOTH))
        {
     
             
    echo "<td><div class='badge badge-info'>".$branch_fet['displayname']."</div></td>";
        
        }
echo "</tr><tr>";
              $branches=mysqli_query($con,"SELECT * FROM branch_categories");
          while( $event_fet=mysqli_fetch_array($branches,MYSQLI_BOTH))
        {
             
    echo "<td><div class='badge badge-info'>".mysqli_num_rows(mysqli_query($con,"SELECT * FROM events WHERE visibility='1' && branch='".$event_fet['branch']."'"))."
    </div></td>";
        
        }
     
    ?></tr>
    </tbody>
    </table>
    <br>

     <table class="table table-stripped table-bordered">
      <tr>
    <th colspan="<?php echo $branches_count;?>">Organizers</th>
  </tr>
  <tbody>
    <tr><?php
      $branches=mysqli_query($con,"SELECT * FROM branch_categories");
    while( $branch_fet=mysqli_fetch_array($branches,MYSQLI_BOTH))
        {
     
             
    echo "<td><div class='badge badge-danger'>".$branch_fet['displayname']."</div></td>";
        
        }
echo "</tr><tr>";
              $branches=mysqli_query($con,"SELECT * FROM branch_categories");
          while( $event_fet=mysqli_fetch_array($branches,MYSQLI_BOTH))
        {
             
    echo "<td><div class='badge badge-danger'>".mysqli_num_rows(mysqli_query($con,"SELECT * FROM organizers WHERE role='Organizer' && branch='".$event_fet['branch']."'"))."</div></td>";
        
        }
     
    ?></tr>
    </table>
    <br>


<?php
        $settings=mysqli_query($con,"SELECT * FROM site_settings");
     $settings_count=mysqli_num_rows($settings);     
     ?>
    
      <table class="table table-stripped table-bordered">
        <tr>
    <th colspan="<?php echo $settings_count;?>">Website Settings</th>
  </tr>
  <tbody>
    <tr><?php while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){ echo "<td><div class='badge badge-success'>".$branch_cat['function']."</div></td>"; }?></tr>
    
    <tr><?php 
      $settings=mysqli_query($con,"SELECT * FROM site_settings"); 
    while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){ echo "<td><div class='badge badge-success'>".$branch_cat['value']."</div></td>"; }?></tr>
    </tbody>
    </table>
    <br>

      <table class="table table-stripped table-bordered">
        <tr>
    <th colspan="<?php echo $branches_count;?>">User Registraions</th>
  </tr>
  <tbody>
    <tr><?php
      $branches=mysqli_query($con,"SELECT * FROM year_categories");
    while( $branch_fet=mysqli_fetch_array($branches,MYSQLI_BOTH))
        {
     
             
    echo "<td><div class='badge badge-warning'>".$branch_fet['year']."</div></td>";
        
        }
echo "</tr><tr>";
              $branches=mysqli_query($con,"SELECT * FROM year_categories");
          while( $event_fet=mysqli_fetch_array($branches,MYSQLI_BOTH))
        {
             
    echo "<td><div class='badge badge-warning'>".mysqli_num_rows(mysqli_query($con,"SELECT * FROM users WHERE year='".$event_fet['year']."'"))."</div></td>";
        
        }
     
    ?></tr>
    </tbody>
    </table>  
    <br>



      <table class="table table-stripped table-bordered">
        <tr>
    <th colspan="<?php echo $branches_count;?>">Users Paid</th>
  </tr>
  <tbody>
    <tr>
      <?php
      $branches=mysqli_query($con,"SELECT * FROM year_categories");
    while( $branch_fet=mysqli_fetch_array($branches,MYSQLI_BOTH))
        {                  
       echo "<td><div class='badge badge-primary'>".$branch_fet['year']."</div></td>";        
        }
     echo "</tr><tr>";
     $branches=mysqli_query($con,"SELECT * FROM year_categories");
      while( $event_fet=mysqli_fetch_array($branches,MYSQLI_BOTH))
        {            
    echo "<td><div class='badge badge-primary'>".mysqli_num_rows(mysqli_query($con,"SELECT * FROM users WHERE year='".$event_fet['year']."' && paid='yes'"))."</div></td>";
        
        }
     
    ?>
      
    </tr>  
    </tbody>  
    </table>
    <br>


  <table class="table table-stripped table-bordered">
    <tr>
    <th colspan="<?php echo $branches_count;?>">Notifications</th>
  </tr>
  <tbody>
    <tr>
      <td><div class='badge badge-success'>Total Notices</div></td>
      <td><div class='badge badge-success'>Active Notices</div></td>
      <td><div class='badge badge-success'>Deleted Notices</div></td>
      <td><div class='badge badge-success'>Webteam Posted(Active)</div></td>
      <td><div class='badge badge-success'>Organizers Posted(Active)</div></td>
      <td><div class='badge badge-success'>Webteam Posted(Deleted)</div></td>
      <td><div class='badge badge-success'>Organizers Posted(Deleted)</div></td>
    </tr>

    <tr>
    <td><div class='badge badge-success'><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * FROM notifications"));?></div></td>
    <td><div class='badge badge-success'><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * FROM notifications WHERE visibility='1'"));?></div></td>
    <td><div class='badge badge-success'><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * FROM notifications WHERE visibility='0'"));?></div></td>
    <td><div class='badge badge-success'><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * FROM notifications WHERE visibility='1' && role='Webteam'"));?></div></td>
    <td><div class='badge badge-success'><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * FROM notifications WHERE visibility='1' && role='Organizer'"));?></div></td>
    <td><div class='badge badge-success'><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * FROM notifications WHERE visibility='0' && role='Webteam'"));?></div></td>
    <td><div class='badge badge-success'><?php echo mysqli_num_rows(mysqli_query($con,"SELECT * FROM notifications WHERE visibility='0' && role='Organizer'"));?></div></td>
    </tr>                  
    </table>
  </tbody>
    <br>


<table class="table table-stripped table-bordered">
  <tr>
    <th colspan="<?php echo $branches_count;?>">Events having Upload option</th>
  </tr>
  <tbody>
    <tr>
      <td style='font-weight:bold;'><div class='badge badge-info'>Event</div></td>
      <td style='font-weight:bold;'><div class='badge badge-info'>Uploads state</div></td>
      <td style='font-weight:bold;'><div class='badge badge-info'>Uploads</div></td>
      <td style='font-weight:bold;'><div class='badge badge-info'>Activity By</div></td>
      <td style='font-weight:bold;'><div class='badge badge-info'>Activity time</div></td>
    </tr>
  <?php $upls=mysqli_query($con,"SELECT * FROM abstract_uploads_settings WHERE visibility='1'");
  while($upl_cat=mysqli_fetch_array($upls,MYSQLI_BOTH)){ echo "  <tr>
    <td><div class='badge badge-info'>".$upl_cat['branch']." ~ ".$upl_cat['eventname']."</div></td>
  <td><div class='badge badge-info'> <i>".$upl_cat['uploadsopen']."</i></div></td>
  <td><div class='badge badge-info'>".$upl_cat['uploads']."</div></td>
  <td title='".$upl_cat['added_by_name']."'><div class='badge badge-info'>".$upl_cat['added_by_id']."</div></td>
  <td><div class='badge badge-info'>".$upl_cat['added_by_time']."</div></td>
  </tr>"; }?>
    </tbody>
    </table>
    <br>





    <?php
      } 
           
      ?>
        
        
    </div><!-- end div #content -->
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
    
<?php include ("includes/footer.php") ?>
        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="node_modules/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
  <script src="node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="node_modules/raphael/raphael.min.js"></script>
  <script src="node_modules/morris.js/morris.min.js"></script>
  <script src="node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
