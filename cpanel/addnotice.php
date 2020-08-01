<?php
session_start();
if((!isset($_SESSION['tz_organizer'])) && (!isset($_SESSION['tz_webteam'])))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM organizers WHERE orgid='".mysqli_real_escape_string($con,$_SESSION['tz_organizer'])."'"),MYSQLI_BOTH);
$sitesettingsdat=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM site_settings WHERE function='Adding Notices'"),MYSQLI_BOTH);

?>
<html lang="en">
   <?php include ("includes/files_include.php") ?>
          <link rel="stylesheet" href="node_modules/summernote/dist/summernote-bs4.css">
         <link rel="stylesheet" href="node_modules/quill/dist/quill.snow.css">
   <link rel="stylesheet" href="node_modules/simplemde/dist/simplemde.min.css">
     <script src="node_modules/jquery/dist/jquery.min.js"></script>
 <script>    
  $(document).ready(function() {
  $('#summernote').summernote();     
});
    $(document).ready(function() {
  $('#sum_description').summernote();     
});
    $(document).ready(function() {
  $('#summernote1').summernote();
});
    $(document).ready(function() {
  $('#summernote2').summernote();
});
    $(document).ready(function() {
  $('#summernote3').summernote();
});
function no(){
  document.getElementById('div1').style.display ='none';
}
function yes(){
  document.getElementById('div1').style.display = 'block';
} 
</script>
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
	  	<div class="alert alert-warning">
    				<strong>Sorry!!!  Webteam Stopped Adding Notice....Please Contact webteam</strong>
    			</div>	
    			</center>			
				<?php
        }else{
	
		?>



        <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Notice to Event of <?php echo $title;?></h4>
                  <form  action="addnoticetodb.php" method="post"  enctype="multipart/form-data">
                   <div class="form-group">
                      <label for="exampleInputbranch">Event Name</label>
                      <select name='evename' class="form-control" required="">
    							<option value="">Choose</option>
    		<?php										
	if($getuserdata['role']!="Webteam")
				{
	        $user_eve_data=array();
            $user_eve_data=explode("~",$getuserdata['eids']);
			$sno=0; 
			for($i=0;$i<count($user_eve_data);$i++)
	{
				
	  $settings=mysqli_query($con,"SELECT * FROM events WHERE eid='".$user_eve_data[$i]."'");
  while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
			 echo "<option value='".$branch_cat['eid']."'>".$branch_cat['branch']."~".$branch_cat['eventname']."</option>"; 
		   }
		   }
				}
				else
	{
			$sno=0; 
	  $settings=mysqli_query($con,"SELECT * FROM events");
	
		  while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
			  $fg=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM branch_categories WHERE branch='".$branch_cat['branch']."'"),MYSQLI_BOTH);
			 echo "<option value='".$branch_cat['eid']."'>".$fg['displayname']."~".$branch_cat['eventname']."</option>"; 
		   }
		   
	}
	?>
    		         </select>
                    </div>

                     <div class="form-group">
                      <label for="exampleInputParticipants">Notice Title</label>
                      <input type="text" class="form-control" name='notetitle' placeholder="Title" required="">
                      <span id="participants_error"></span>
                    </div> 

                      <div class="form-group">
                      <label for="exampleInputCity1">Description</label>
                      <textarea id="sum_description" name="description">
                       Type Description here...</textarea>                                       
                </div>

                      <div class="form-group">
                      <label for="exampleInputParticipants">Sd/-</label>
                      <input type="text" class="form-control" name='notesd' value="Event Organizer" placeholder="Sd/-" required="" readonly="">
                      <span id="participants_error"></span>
                    </div>

                    <div class="form-group">
                      <label>Choose File (Only zip,doc,pdf,ppt are allowed)</label>
                      <input type="file" class="form-control" id="file" name="file">                      
                    </div>
                    <div class="forn-group">                    
                    <button type="submit" name="add_notice" class="btn btn-success mr-2"><i class="fa fa-bell" ></i> Add Notice</button>
                    <button type="reset" class="btn btn-light">Reset</button>
                   </div>
                   </form>
                </div>
            </div>
        </div>

							<?php
}
        }
        else
        {          
          ?>
          <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Notice to Event of <?php echo $title;?></h4>
                  <form  action="addnoticetodb.php" method="post"  enctype="multipart/form-data">
                   <div class="form-group">
                      <label for="exampleInputbranch">Event Name</label>
                      <select name='evename' class="form-control" required="">
                  <option value="">Choose</option>
        <?php                   
  if($getuserdata['role']!="Webteam")
        {
          $user_eve_data=array();
            $user_eve_data=explode("~",$getuserdata['eids']);
      $sno=0; 
      for($i=0;$i<count($user_eve_data);$i++)
  {
        
    $settings=mysqli_query($con,"SELECT * FROM events WHERE eid='".$user_eve_data[$i]."'");
  while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
       echo "<option value='".$branch_cat['eid']."'>".$branch_cat['branch']."~".$branch_cat['eventname']."</option>"; 
       }
       }
        }
        else
  {
      $sno=0; 
    $settings=mysqli_query($con,"SELECT * FROM events");
      while($branch_cat=mysqli_fetch_array($settings,MYSQLI_BOTH)){
        $fg=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM branch_categories WHERE branch='".$branch_cat['branch']."'"),MYSQLI_BOTH);
       echo "<option value='".$branch_cat['eid']."'>".$fg['displayname']."~".$branch_cat['eventname']."</option>"; 
       }
       
  }
  ?>
                 </select>
                    </div>

                     <div class="form-group">
                      <label for="exampleInputParticipants">Notice Title</label>
                      <input type="text" class="form-control" name='notetitle' placeholder="Title" required="">
                      <span id="participants_error"></span>
                    </div> 

                      <div class="form-group">
                      <label for="exampleInputCity1">Notice</label>                                      
                           <textarea id="sum_description" name="description">
                       Type Description here...</textarea>               
                      </div>

                      <div class="form-group">
                      <label for="exampleInputParticipants">Sd/-</label>
                      <input type="text" class="form-control" name='notesd' placeholder="Sd/-" required="" >
                      <span id="participants_error"></span>
                    </div>

                    <div class="form-group">
                      <label>Choose File (Only zip,doc,pdf,ppt are allowed)</label>
                      <input type="file" class="form-control" id="file" name="file">                      
                    </div>
                    <div class="forn-group">                    
                    <button type="submit" name="add_notice" class="btn btn-success mr-2"><i class="fa fa-bell" ></i> Add Notice</button>
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
    <script src="node_modules/summernote/dist/summernote-bs4.min.js"></script>
  <script src="node_modules/tinymce/tinymce.min.js"></script>
  <script src="node_modules/quill/dist/quill.min.js"></script>
  <script src="node_modules/simplemde/dist/simplemde.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->

  <script src="js/off-canvas.js"></script>
  <script src="js/editorDemo.js"></script>
   <script src="js/nicEdit.js"></script>
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

	
