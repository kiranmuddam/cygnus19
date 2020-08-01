<?php
session_start();
if((!isset($_SESSION['tz_organizer'])) && (!isset($_SESSION['tz_webteam'])))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($con,$_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);
$sitesettingsdat=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM site_settings WHERE function='Get Uploads Data'"),MYSQLI_BOTH);

?>
<html lang="en">
   <?php include ("includes/files_include.php") ?>
     <link rel="stylesheet" href="node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css" />
     <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css" />
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
													
if($sitesettingsdat['value']=="off")
{
?><center>
	  	<div class="alert alert-danger">
    				<strong">Sorry!!!  Webteam Stopped Get uploads Data Page...Please Contact webteam</strong>
    			</div>
				</center>
				<?php
}
else
{
	?>
		<div class="card">
            <div class="card-body">
              <h4 class="card-title"></h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">			
                       <table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
    						<thead>
    							<tr>
    								<td><div>Sno</div></td>
    								<td><div>Teamid</div></td>
    								<td><div>EventName</div></td>
    								<td><div>Filepath</div></td>
									<td><div>Upload by</div></td>									
    							</tr>
    						</thead>
    						<tbody>	<?php
										
	
	     $sno=0;
	  $settings=mysqli_query($con,"SELECT * FROM abstract_uploads WHERE eid='".$getuserdata['eid']."' ");
   if(mysqli_num_rows($settings)>=1)
   {
   while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
			   $sno++; echo "<tr>
			   <td>".$branch_cat['sno']."</td>
			   <td>".$branch_cat['teamid']."</div></td>
			   <td>".$branch_cat['eventname']."</div></td>
			   <td>".$branch_cat['filepath']."</div></td>
			   <td>".$branch_cat['stuid']."</div></td>
			   </tr>";
   }
}
   ?>
		
	
									</tbody>
							</table>
							</form>
							</div>
						</div>
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
  <script src="node_modules/datatables.net/js/jquery.dataTables.js"></script>
  <script src="node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
<script src="js/data-table.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>

<script type="text/javascript">
         $('#example4').dataTable( {
  "ordering": false
} )
        
    </script>
    </body>

</html>