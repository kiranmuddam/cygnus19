<?php
session_start();
if((!isset($_SESSION['tz_webteam'])) && (!isset($_SESSION['tz_organizer'])))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($con,$_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);

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
if(!isset($_SESSION['tz_webteam']))
{
?><center>
	  	<div class="alert alert-danger">
    		Sorry!!!  This feature is available for Webteam only
    	</div>
    		</center>
				<?php
}
else
{
	?>
           <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add a New Organiser to <?php echo $title;?></h4>
                           
                  	<form class="forms-sample" action="addorganizertodb.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Organizer id</label>
                      <input type="text" class="form-control" name="orgid" placeholder="Organizer id" required="" maxlength="7">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Organizer name</label>
                      <input type="text" class="form-control"  name='orgname' placeholder="Organizer Name" required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputbranch">Organizer Branch</label>
                      <select id="orgbranch" name="orgbranch" class="form-control" required="">
    							<option value="">Choose</option>
    							<?php
		                             $branch_categories=mysqli_query($con,"SELECT * FROM branch_categories");
		                                while($branch=mysqli_fetch_array($branch_categories,MYSQLI_BOTH))
	                                     { 
		                                 echo "<option value='".$branch['branch']."'>".$branch['branch']."</option>";
	                                      }
	                             ?>
    		         </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Organizer Password</label>
                      <input type="password" class="form-control" name='orgpass'  placeholder="Password" required="">
                    </div>       
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-4">
                            <div class="form-radio">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="orggender" value="M" checked>
                                Male
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-radio">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="orggender" value="F">
                                Female
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
           
                    <div class="form-group">
                      <label for="exampleInputCity1">Organizer Mobile</label>
                      <input type="text" class="form-control"  name='orgmob' placeholder="Mobile" maxlength="10" required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Event Id</label>
                      <input class="form-control" name='orgeveids' placeholder="Event Id" required="">
                    </div>
                    <button type="submit" name="orgsubbut" class="btn btn-success mr-2"><i class="fa fa-user-plus" ></i> Add Organizer</button>
                    <button type="reset" class="btn btn-light">Reset</button>
                  </form>
                </div>
              </div>
            </div>			
<?php
}
?>

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

