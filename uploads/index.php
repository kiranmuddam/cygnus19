<!DOCTYPE html>
<html class="not-ie no-js" lang="en"><!--<![endif]--><head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<title>Cygnus'19 Non-Schedule Events Files Upload</title>	
	   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
       <link rel="stylesheet" href="Forms_files/tmm_form_wizard_style_demo.css">
<script>
function valid()
{
var stuid=document.getElementById("stuid").value;	
var stuname=document.getElementById("stuname").value;	
var file=document.getElementById("file").value;
if(stuid.length==7 && stuname.length>4 && file!="" && stuid!=undefined && stuname!=undefined && file!=undefined)
{
return true;
}
else
{
alert('Please Check form!!');
return false;	
}	
}
</script>
	<body>


		<!-- - - - - - - - - - - - - Content - - - - - - - - - - - - -  -->


		<div id="content">

			<div class="form-container">

				<div id="tmm-form-wizard" class="container substrate">

					<div class="row">

						<div class="col-xs-12">
							<h2 class="form-login-heading"><span>Cygnus'19</span> NON-Schedule Events Files Upload</h2>
						</div>

					</div><!--/ .row-->

					<div class="row stage-container">
        <center><img src="banner.jpg" width="100%"></center>
					</div><!--/ .row-->

					<div class="row">

						<div class="col-xs-12">

							<div class="form-header">
								
								<div class="form-title form-icon title-icon-user">
									Uploader
								</div>
								<div class="steps">
									CYGNUS'19
								</div>
								
							</div><!--/ .form-header-->

						</div>

					</div><!--/ .row-->

					<form action="upload.php" role="form" method="post" enctype="multipart/form-data" onsubmit="return valid()">

						<div class="form-wizard">
							
							<div class="row">

								<div class="col-md-8 col-sm-7">

									<div class="row">
										
										<div class="col-md-6 col-sm-6">
											<fieldset class="input-block">
												<label for="stuid">University ID</label>
												<input id="stuid" name="stuid" placeholder="ex : N15XXXX" type="text">
												</fieldset><!--/ .input-first-name-->
										</div>
										
										<div class="col-md-6 col-sm-6">
											<fieldset class="input-block">
												<label for="stuname">Student Name</label>
												<input id="stuname" placeholder="ex : kiran"  name="stuname" type="text">
												
											</fieldset><!--/ .input-first-name-->
										</div>
										<div class="col-md-6 col-sm-6">
											<fieldset class="input-block">
												<label for="stuname">Select Your Event:</label><br>
												
												<select  name="projname" id="stuname">
													<option>Select</option>
													<option value="Hidden Photography">Hidden Photography</option>
													<option value="Maded">MADED</option>
													<option value="Dubsmash">Dubsmash</option>
													<option value="10yrschallenge">10 Years Challenge</option>
													<option value="Articles">Article On Trending Tech</option>

												</select>
												
											</fieldset><!--/ .input-first-name-->
										</div>
										
									</div><!--/ .row-->

								
<br>
									<div class="row">

										<div class="col-md-12 col-sm-12">
											<fieldset class="input-block">
												<label for="file">File</label>
												<input id="file" name="file" type="file">
											
											</fieldset><!--/ .input-phone-->
										</div>
										
									</div><!--/ .row-->

								
								</div>

							</div><!--/ .row-->
							
						</div><!--/ .form-wizard-->

						
				<center>		<div class="next">
							<input class="button button-control" type="submit" value="Upload" style="padding:10px;" name="submit">
						</center>	
						</div><br>
						<a href="http://intranet.rguktn.ac.in/cygnus/team.php"><center>For any queries/problems contact Cygnus'19 Webteam</center></a>
				
	</form><!--/ form-->
				</div><!--/ .container-->
				
			</div><!--/ .form-container-->

		</div><!--/ #content-->


		<!-- - - - - - - - - - - - end Content - - - - - - - - - - - - - -->


		<script src="Forms_files/jquery.js"></script>

		<!--[if lt IE 9]>
				<script src="js/respond.min.js"></script>
		<![endif]-->
		
	
</body></html>
