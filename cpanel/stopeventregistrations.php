<?php
session_start();
if((!isset($_SESSION['tz_organizer'])) && (!isset($_SESSION['tz_webteam'])))
{
	header("location:index");
}
require_once("site-settings.php");
?>
      <?php
      
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($con,$_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);
          
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

	
			<div class="card">
            <div class="card-body">
              <h4 class="card-title"></h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">			
                       <table class="table table-striped table-bordered table-hover" id="example4">
    						<thead>
    							<tr>
    								<td>Eid</td>
    								<td>Branch</td>
    								<td>Event Name</td>    								    							
    								<td>Current Status</td>								
    								<td>Actions</td>
    							</tr>
    						</thead>
    						<tbody>
		
	<?php
			
	  $settings=mysqli_query($con,"SELECT * FROM events");
  while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
	  
	  ?>
			<tr>
				<td><?php echo $branch_cat['eid'];?></td>
				<td><?php echo $branch_cat['branch'];?></td>
				<td><?php echo $branch_cat['eventname'];?></td>
        <?php
        if($branch_cat['areregistrationson']=='on'){

        ?>
				 <td><div class="badge badge-primary"><?php echo $branch_cat['areregistrationson'];?></div></td>
         <?php
       }else{        
        ?>   
        <td><div class="badge badge-warning"><?php echo $branch_cat['areregistrationson'];?></div></td>  
        <?php
      }
        ?>   
				 <td></td>
		    </tr>
			 <?php
		   
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
         $('#example4').dataTable( {
  "ordering": false
} )
   $('#example4').Tabledit({
      url: 'stopeventregistrationstodb.php',
    deleteButton: false,
    saveButton: false,
    autoFocus: false,
    buttons: {
        edit: {
            class: 'btn btn-sm btn-primary',
            html: '<span class="icon-pencil menu-icon"></span> &nbsp EDIT',
            action: 'edit'
        }
    },
    columns: {
       identifier: [0, 'eid'],
        editable: [[4, 'action_org','{"01": "Stop","02":"Re-Open"}']]
    }
});     

    </script>
    </body>

</html>