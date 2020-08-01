<?php
session_start();
if(!isset($_SESSION['tz_organizer']))
{
	header("location:login.php");
}
require_once("site-settings.php");
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($con,$_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);
$sitesettingsdat=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM site_settings WHERE function='Adding Files to Events'"),MYSQLI_BOTH);

?>
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
        <div class="content-wrapper">

			<?php
		//if($getuserdata['role']!="Webteam"){
                  if($sitesettingsdat['value']=="off"){
           ?>
        <center>
	  	<div class="alert alert-warning">
    				<strong>Sorry!!!  Webteam Stopped Adding files to events...Please Contact webteam</strong>
    			</div>	
    	 </center>			
       <?php
     }else{
	
		?>
          <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Files to Event of <?php echo $title;?></h4>

                   <form  action="addeventsfiletodb.php" method="post"  enctype="multipart/form-data">
                      <div class="form-group">
                      <label for="exampleInputbranch">Event Name</label>
                      <select name='evename' class="form-control" required="">
    							<option value="">Choose</option>
    		<?php
		   if($getuserdata['role']!="Webteam"){
	        $user_eve_data=array();
            $user_eve_data=explode("~",$getuserdata['eids']);
			$sno=0; 
			for($i=0;$i<count($user_eve_data);$i++){				
	            $settings=mysqli_query($con,"SELECT * FROM events WHERE eid='".$user_eve_data[$i]."'");
                     while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
			             echo "<option value='".$branch_cat['eid']."'>".$branch_cat['displayname']."~".$branch_cat['eventname']."</option>"; 
		              }
		              }
		   }else{
			  $sno=0; 
	           $settings=mysqli_query($con,"SELECT * FROM events");		
		       while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
			     echo "<option value='".$branch_cat['eid']."'>".$branch_cat['branch']."~".$branch_cat['eventname']."</option>"; 
		          }
		   
	     }
         ?>
    		         </select>
    		         <span id="branch_error"></span>
                    </div>
                  <div class="form-group">
                      <label for="exampleInputbranch">Where You Want to add</label>
                   <select  class='form-control' name='catego'>
                   	<option value=''>Choose</option>
                   	<option value='description'>Description</option>
                   	<option value='organizers'>Organizers</option>
                   	<option value='schedule'>Schedule</option>
                   	<option value='prizes'>Prizes</option>
                   	<option value='winners'>Winners</option>
                   </select>    		       
                    </div>
                     <div class="form-group">
                      <label>Choose File (Only zip,doc,pdf,ppt are allowed)</label>
                      <input type="file" class="form-control" id="file" name="file" required="">                      
                    </div>
                    <div class="forn-group">                    
                    <button type="submit" name="add_file" class="btn btn-success mr-2"><i class="fa fa-cloud-upload" ></i> Add File</button>
                    <button type="reset" class="btn btn-light">Reset</button>
                   </div>
                   </form>

               </div>
           </div>
       </div>

		
							<?php
              }				
					?>
		

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
