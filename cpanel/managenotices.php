<?php
session_start();
if((!isset($_SESSION['tz_organizer'])) && (!isset($_SESSION['tz_webteam'])))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($con,$_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);
$sitesettingsdat=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM site_settings WHERE function='Editing Notices'"),MYSQLI_BOTH);

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
													
	if($getuserdata['role']!="Webteam")
				{
if($sitesettingsdat['value']=="off")
{
?><center>
	  	<div class="alert alert-danger">
    				<strong>Sorry!!!  Webteam Stopped Editing Notices...Please Contact webteam</strong>
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
    								<td>S.no</td>
    								<td>Title</td>
    								<td>Description</td>
    								<td>Attachments</td>
									<td>views</td>									
    							</tr>
    						</thead>
    						<tbody>	<?php
										
	if($getuserdata['role']!="Webteam")
				{
	     $sno=0;
	  $settings=mysqli_query($con,"SELECT * FROM notifications WHERE added_by='".$_SESSION['tz_organizer']."' && visibility='1'");
  while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
			  $sno++; echo "<tr>
			  <td>".$branch_cat['nid']."</td>
			  <td>".$branch_cat['title']."</td>
			  <td>".$branch_cat['description']."</td>
			  <td>".$branch_cat['attachments']."</td>
			  <td>".$branch_cat['views']."</td>
			  </tr>"; 
		   }
		   
				}
				else
	{
			$sno=0; 
	  $settings=mysqli_query($con,"SELECT * FROM notifications WHERE visibility='1'");
	
		
		  while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
			   $sno++; echo "<tr>
         <td>".$branch_cat['nid']."</td>
        <td>".$branch_cat['title']."</td>
        <td>".$branch_cat['description']."</td>
        <td>".$branch_cat['attachments']."</td>
        <td>".$branch_cat['views']."</td>
        </tr>"; 
		   }
		   
	}?>
		
	
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
                    <td>S.no</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Attachments</td>
                  <td>views</td>                  
                  </tr>
                </thead>
                <tbody> <?php
                    
  if($getuserdata['role']!="Webteam")
        {
       $sno=0;
    $settings=mysqli_query($con,"SELECT * FROM notifications WHERE added_by='".$_SESSION['tz_organizer']."' && visibility='1'");
  while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
        $sno++; echo "<tr>
        <td>".$branch_cat['nid']."</td>
        <td>".$branch_cat['title']."</td>
        <td>".$branch_cat['description']."</td>
        <td>".$branch_cat['attachments']."</td>
        <td>".$branch_cat['views']."</td>
        </tr>"; 
       }
       
        }
        else
  {
      $sno=0; 
    $settings=mysqli_query($con,"SELECT * FROM notifications WHERE visibility='1'");
  
    
      while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
         $sno++; echo "<tr>
         <td>".$branch_cat['nid']."</td>
        <td>".$branch_cat['title']."</td>
        <td>".$branch_cat['description']."</td>
        <td>".$branch_cat['attachments']."</td>
        <td>".$branch_cat['views']."</td>
        </tr>"; 
       }
       
  }?>
    
  
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

    <script src="js/jquery.tabledit.js" type="text/javascript"></script>
    <script src="js/jquery.tabledit.min.js" type="text/javascript"></script>
<script type="text/javascript">
         $('#example4').dataTable( {
  "ordering": false
} )
        $('#example4').Tabledit({
    url: 'managenoticetodb.php',
    columns: {
        identifier: [0, 'nid'],
        editable: [[1, 'title'], [2, 'description']]
    },
    onDraw: function() {
        console.log('onDraw()');
    },
    onSuccess: function(data, textStatus, jqXHR) {
        console.log('onSuccess(data, textStatus, jqXHR)');
        console.log(data);
        console.log(textStatus);
        console.log(jqXHR);
    },
    onFail: function(jqXHR, textStatus, errorThrown) {
        console.log('onFail(jqXHR, textStatus, errorThrown)');
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    },
    onAlways: function() {
        console.log('onAlways()');
    },
    onAjax: function(action, serialize) {
        console.log('onAjax(action, serialize)');
        console.log(action);
        console.log(serialize);
    }
});
    </script>
    </body>

</html>