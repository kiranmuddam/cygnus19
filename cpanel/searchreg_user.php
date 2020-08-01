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
<script>
function showHint(str) {
    if (str.length >= 3) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txt").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "getreg_user.php?q=" + str, true);
        xmlhttp.send();
        
    } else {
        document.getElementById("txt").innerHTML = "";
        return;
    }
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
                  <h4 class="card-title">Search User  Reg data of <?php echo $title;?></h4>
                 
                     <div class="form-group">
                      <label for="exampleInputParticipants">Username</label>
                      <input type="text" class="form-control" onkeyup="showHint(this.value)"  name='username' minlength="7" placeholder="Username" required="">
                      <div id="txt"></div>
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
                  <h4 class="card-title">Search User  Reg data of <?php echo $title;?></h4>
                 
                     <div class="form-group">
                      <label for="exampleInputParticipants">Username</label>
                      <input type="text" class="form-control" onkeyup="showHint(this.value)"  name='username' minlength="7" placeholder="Username" required="">
                      <div id="txt"></div>
                    </div>                     
 
                   </form>
                </div>
            </div>
        </div>
     
       
                    
        <?php
      }
      ?>
<?php
  $add=($_SESSION['tz_organizer']);
  $w=mysqli_query($con,"SELECT * FROM organizers where orgid='$add'");
  while($t=mysqli_fetch_array($w,MYSQLI_BOTH)){
    $eid=$t['eids'];
  }
?>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
         <table class="table table-bordered table-stripped">
  <thead>
    <tr>
      <th>S.no</th>
      <th>Event Name</th>
      <th>Team Id</th>
      <th>Registered Ids</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $e=(mysqli_query($con,"SELECT * FROM event_registrations order by sno desc"));
    while($r=mysqli_fetch_array($e,MYSQLI_BOTH)){
         echo'
    
<tr>
<td>'.$r['sno'].'</td>
<td>'.$r['eventname'].'</td>
<td>'.$r['teamid'].'</td>
<td>'.$r['ids'].'</td>
</tr>


         ';
     }
    ?>
  </tbody>
</table> 
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

	
