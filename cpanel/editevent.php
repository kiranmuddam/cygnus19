<?php
session_start();
if(!isset($_SESSION['tz_webteam']) && !isset($_SESSION['tz_organizer']))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);
$eventdat=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM events ORDER BY eid DESC LIMIT 1"));
$branch_alloc=$getuserdata['branch'];
$lastid=$eventdat['eid'];
?>
<html lang="en">
   <?php include ("includes/files_include.php") ?>
      <link rel="stylesheet" href="node_modules/summernote/dist/summernote-bs4.css">
         <link rel="stylesheet" href="node_modules/quill/dist/quill.snow.css">
   <link rel="stylesheet" href="node_modules/simplemde/dist/simplemde.min.css">
     <script src="node_modules/jquery/dist/jquery.min.js"></script>
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
if(!isset($_SESSION['tz_webteam']) && !isset($_SESSION['tz_organizer']))
{
?>
<center>
	  	<div class="alert alert-danger">
    				<strong>Sorry!!!  This feature is available for Webteam only</strong>
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
    								<td>E.id</td>
    								<td>event name</td>
    								<td>branch</td>
    								<td>edit</td>
    							</tr>

    						</thead>
    						<tbody>	
                  <?php
		
	  $settings=mysqli_query($con,"SELECT * FROM events  order by eid");
  while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
			  echo "<tr>
			  <td>".$branch_cat['eid']."</td>
			  <td>".$branch_cat['eventname']."</td>			 
			  <td>".$branch_cat['branch']."</td>
			  <td><button class='btn btn-success'";?> onclick="edit(<?php echo $branch_cat['eid'];?>)">edit</button><?php echo "</td>
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

    <script src="js/jquery.tabledit.js" type="text/javascript"></script>
    <script src="js/jquery.tabledit.min.js" type="text/javascript"></script>
   <script type="text/javascript">
   
function  edit(eid) {
	window.location="editeventdb.php?eid="+eid;
}
   </script>
    </body>

</html>