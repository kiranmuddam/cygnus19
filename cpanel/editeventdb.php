<?php
session_start();
if(!isset($_SESSION['tz_webteam']) && !isset($_SESSION['tz_organizer']))
{
	header("location:index");
}
require_once("site-settings.php");
if(!isset($_GET['eid']) || empty($_GET['eid'])){exit;}
$eid=$_GET['eid'];
$eid=strip_tags(trim(stripslashes(htmlentities($_GET['eid']))));
$eventdat=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM events where eid='$eid' "),MYSQLI_BOTH);

if(isset($_SESSION['tz_webteam'])==false){
$session=$_SESSION['tz_organizer']; 
}else{
$session=$_SESSION['tz_webteam'];
}

$t=mysqli_query($con,"SELECT * FROM organizers WHERE orgid='$session'");

if(mysqli_num_rows($t)<1){echo exit;}

$getuserdata=mysqli_fetch_array($t,MYSQLI_BOTH);
$orgbranch=$getuserdata['branch'];
$orgrole=$getuserdata['role'];
$eventbranch=$eventdat['branch'];
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

  if(1==1){
	?>
	<script>
	$(document).ready(function(){
		new nicEditor({fullPanel : true}).panelInstance('description');
		new nicEditor({fullPanel : true}).panelInstance('instructions');
		new nicEditor({fullPanel : true}).panelInstance('organizers');
		new nicEditor({fullPanel : true}).panelInstance('schedule');
		new nicEditor({fullPanel : true}).panelInstance('prizes');
		});
	</script>

<div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Event to <?php echo $title;?></h4>
                           <?php
                                 $edit_event=mysqli_query($con,"SELECT * FROM events where eid='$eid' ");
                                    while($edit=mysqli_fetch_array($edit_event,MYSQLI_BOTH))
                                       { 
                                        
                                       
                               ?>
                  <form action="editeventupdate.php" method="post"  enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Event id</label>
                      <input type="text" value="<?php echo $eid;?>" class="form-control" name="uid"  readonly disabled />
                    </div>
                    <div class="form-group">
                      
                      <input type="hidden" value="<?php echo $eid;?>" class="form-control" name="uhid"  />
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Event name</label>
                      <input type="text" class="form-control" value="<?php echo $edit['eventname'] ?>"  name="eventname" placeholder="Event Name" required="">
                      <span id="eventname_error"></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputbranch">Branch</label>
                      <select id="orgbranch" name="branch" class="form-control" required="">
    							<option value="">Choose</option>
    							<?php
		                             $branch_categories=mysqli_query($con,"SELECT * FROM branch_categories ");
		                                while($branch=mysqli_fetch_array($branch_categories,MYSQLI_BOTH))
	                                     { 
		                                 		echo "<option value='".$branch['branch']."'>".$branch['displayname']."</option>";
	                                      }
	                             ?>
    		         </select>
    		         <span id="branch_error"></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputParticipants">Participants</label>
                      <input type="text" class="form-control" name="participants" placeholder="Participants" value="<?php echo $edit['participants'] ?>" required="">
                      <span id="participants_error"></span>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputParticipants">Min Participants</label>
                      <input type="text" class="form-control" name="minparticipants" value="<?php echo $edit['minparticipants'] ?>"  placeholder="Participants" required="">
                      <span id="minparticipants_error"></span>
                    </div>       
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Year Restrictions</label>
                          <div class="col-sm-4">
                            <div class="form-radio">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="yearrestrictions" value="yes" onclick="yes()">
                                Yes
                              </label>
                            </div>
                          </div>

                          <div class="col-sm-5">
                            <div class="form-radio">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input"  name="yearrestrictions" value="no" onclick="no()" checked>
                                No
                              </label>
                            </div>
                          </div>
                        </div>                       
                      </div> 
           <div id="div1" style="display:none;">
           	<div class="row">
               <div class="col-md-2">           
                     <div class="form-group">
                      <label for="exampleInputbranch">PUC1</label>
                        <select  name="resarP1" class="form-control" >  
                        <option value="1">Yes</option>  							
                        <option value="0">No</option>
    		            </select>    		
                    </div>                        		          
                </div>
                 <div class="col-md-2">           
                     <div class="form-group">
                      <label for="exampleInputbranch">PUC2</label>
                        <select  name="resarP2" class="form-control" >  
                        <option value="1">Yes</option>  							
                        <option value="0">No</option>
    		            </select>    		
                    </div>                        		          
                </div>
                 <div class="col-md-2">           
                     <div class="form-group">
                      <label for="exampleInputbranch">E1</label>
                        <select  name="resarE1" class="form-control" >  
                        <option value="1">Yes</option>  							
                        <option value="0">No</option>
    		            </select>    		
                    </div>                        		          
                </div>
                 <div class="col-md-2">           
                     <div class="form-group">
                      <label for="exampleInputbranch">E2</label>
                        <select  name="resarE2" class="form-control" >  
                        <option value="1">Yes</option>  							
                        <option value="0">No</option>
    		            </select>    		
                    </div>                        		          
                </div>
                 <div class="col-md-2">           
                     <div class="form-group">
                      <label for="exampleInputbranch">E3</label>
                        <select  name="resarE3" class="form-control" >  
                        <option value="1">Yes</option>  							
                        <option value="0">No</option>
    		            </select>    		
                    </div>                        		          
                </div>
                 <div class="col-md-2">           
                     <div class="form-group">
                      <label for="exampleInputbranch">E4</label>
                        <select  name="resarE4" class="form-control" >  
                        <option value="1">Yes</option>  							
                        <option value="0">No</option>
    		            </select>    		
                    </div>                        		          
                </div>
            </div>
        </div>


                    <div class="form-group">
                      <label for="exampleInputCity1">Description</label>
                      <textarea id="sum_description" name="description" >
                       <?php echo $edit['description'] ?></textarea>                                       
                </div>
                         <div class="form-group">
                      <label for="exampleInputCity1">Instructions</label>                     
                 <textarea id="summernote" name="instructions" ><?php echo $edit['instructions'] ?></textarea>
                </div>

                            <div class="form-group">
                      <label for="exampleInputCity1">Organizers</label>
               <textarea id="summernote1" name="organizers"><?php echo $edit['organizers'] ?>
            </textarea>
                    </div>

                            <div class="form-group">
                      <label for="exampleInputCity1">Schedule</label>
                  <textarea id="summernote2" name="schedule"><?php echo $edit['schedule'] ?></textarea>
                    </div>
                            <div class="form-group">
                      <label for="exampleInputCity1">Prizes</label>
                <textarea id="summernote3" name="prizes"><?php echo $edit['prizes'] ?></textarea>
              </div>

                   
                    <div class="form-group">                    
                    <button type="submit" name="event_add" class="btn btn-success mr-2" onclick="submit(<?php echo $eid ;?>)"><i class="fa fa-plus" ></i>Submit Event</button>
                    <button type="reset" class="btn btn-light">Reset</button>
                  </form>
                </div>
              </div>
            </div>	
            </form>
            </div>
            </div>
            </div>
            </div>
            </div>

            
<?php } 

?>

 <?php
             }
            else {
              ?>
              <center>
      <div class="alert alert-danger">
            <strong>Sorry!!! you are not authorized to access this</strong>
          </div>
        </center>
        <?php
}
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
  <script src="node_modules/summernote/dist/summernote-bs4.min.js"></script>
  <script src="node_modules/tinymce/tinymce.min.js"></script>
  <script src="node_modules/quill/dist/quill.min.js"></script>
  <script src="node_modules/simplemde/dist/simplemde.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
    <script src="js/editorDemo.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <script src="js/nicEdit.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
  <script type="text/javascript">
  function  submit(eid) {
  window.location="editeventupdate.php?eid="+<?php echo $eid ?>;
}</script>
  
  
</body>

</html>
