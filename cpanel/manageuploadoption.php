<?php
session_start();
if((!isset($_SESSION['tz_organizer'])) && (!isset($_SESSION['tz_webteam'])))
{
	header("location:index");
}
require_once("site-settings.php");
      
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($con,$_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);
$sitesettingsdat=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM site_settings WHERE function='Adding Upload Option'"),MYSQLI_BOTH);
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
?>
<center>
	  	<div class="alert alert-danger">
    				<strong>Sorry!!!  Webteam Stopped Adding Upload Option....Please Contact webteam</strong>  
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
			
	  $settings=mysqli_query($con,"SELECT * FROM events WHERE visibility='1'");
  while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){

	   $uploads_sett=mysqli_query($con,"SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'");
	  
       $curstatus="";
	   $proopt="";
	if(mysqli_num_rows($uploads_sett)>=1)
	{
	   $upl_set=mysqli_fetch_array($uploads_sett,MYSQLI_BOTH);

	      /* if($upl_set['uploadsopen']=="opened")
		    {
		       $color="blue";
		    }
		    else
		    {
			   $color="red";
		    }*/
//color block close
	    if($upl_set['uploadsopen']=="opened")
		  {
			 $exis=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"),MYSQLI_BOTH);
           if($exis['visibility']=="1")
		        {
	       $curstatus="<div class='badge badge-success'>Upload Option is provided by <i><u>".$upl_set['added_by_name']."</u></i><br><br>Uploads are ".$upl_set['uploadsopen']."</div>";
		         }
		  }
		  else
		  {
			   $exis=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"),MYSQLI_BOTH);
              if($exis['visibility']=="1")
		        {
			       $curstatus="<div class='badge badge-primary'>Upload Option is closed by <i><u>".$upl_set['added_by_name']."</u></i><br><br>Uploads are ".$upl_set['uploadsopen']."</div>";
			    } 
		  }

//uploadoption opened and visibillity==1 block closed		  

	    if($upl_set['uploadsopen']=="opened")
		{
		    $exis=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"),MYSQLI_BOTH);
            if($exis['visibility']=="1")
		      {
		       $option="closed";
		       $proopt="<input type='submit' style='cursor:pointer;color:green;' value='Close Uploads' onclick=\"manageuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."','".$option."','".$upl_set['added_by_name']."','".$_SESSION['tz_organizer']."')\"  name='submit'/>";
		      }
		       else
		      {
			 
                 $curstatus="<div class='badge badge-danger'>Upload Option Provided but Cancelled</div>";
		         $proopt="<input type='submit' style='cursor:pointer;color:green;' value='Activate Upload Option' onclick=\"activateuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>";
			  }
		}
		else
		{
		   $exis=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"),MYSQLI_BOTH);
              if($exis['visibility']=="1")
		        {
	              $option="opened";
		          $proopt="<input type='submit' style='cursor:pointer;color:green;' value='Open Uploads' onclick=\"manageuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."','".$option."','".$upl_set['added_by_name']."','".$_SESSION['tz_organizer']."')\"  name='submit'/>";
		        }
		        else
			    {
			 
               $curstatus="<div class='badge badge-danger'>Upload Option Provided but Cancelled</div>";
		        $proopt  ="<input type='submit' style='cursor:pointer;color:green;' value='Activate Upload Option' onclick=\"activateuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>";
			    }
		}

//uploadseetings is >1 block is closed


	}
	else
	{
          $exis=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM abstract_uploads_settings WHERE eid='".$branch_cat['eid']."'"),MYSQLI_BOTH);
            if($exis['visibility']=="0")
		     {		   
               $curstatus="Upload Option Provided but Cancelled";
		       $proopt="<input type='submit' style='cursor:pointer;color:green;' value='Activate Upload Option' onclick=\"activateuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>";
             }
             else
		     {	  
               $curstatus="<div class='badge badge-warning'>Upload Option Not Provided</div>";
		       $proopt="<input type='submit' class='btn btn-success' value='Add Upload Option' onclick=\"appuploption('".$branch_cat['eid']."','".$branch_cat['branch']."','".$branch_cat['eventname']."')\"  name='submit'/>";		 
		     }

    }
	  
	  ?>
			<tr>
				<td><?php echo $branch_cat['eid'];?></td>
				<td><?php echo $branch_cat['branch'];?></td>
				<td><?php echo $branch_cat['eventname'];?></td>
				 <td><?php echo $curstatus;?></td>
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


<?php
}
				}
else
	{
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
    url: 'manageuploadoptiontodb.php',
    columns: {
        identifier: [0, 'eid'],
        editable: [[4, 'action_org','{"01": "Add","02":"Re-add"}']]
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