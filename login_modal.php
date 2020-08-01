<div class="ui-modal contact-modal form-modal fullscreen">
  <div class="modal">
    <div class="close-container">
      <a href="#" class="close-link close">
        Close
      </a>
    </div>

    <div class="modal-content">

      <h3>Login Here</h3>
      <hr>

         <?php 
        $we=mysqli_query($con,"SELECT * FROM site_settings WHERE function='Site Logins'");
        $ison=mysqli_fetch_array($we,MYSQLI_BOTH);
          if($ison['value']=="on"){
         ?>

      <form id="login-form">
        <div class="inputs">    
          <div class="input-container contact-first-name ">
              <input type="text"  placeholder="University Id" name="user_idno"  id="user_idno">    
          </div>
          <div class="input-container contact-last-name ">  
              <input type="password"  placeholder="Exam Password"  name="password" id="password" >    
          </div>    
      </div>      
      <button type="submit" class="button purple"  id="btn-login" name="btn-login">Submit</button>
      </form>

<?php } else{ ?>
  <center><h4 class='' style='color:red;font-family: '>Login are disabled by admin.</h4></center>
<?php } ?>
    </div>
  </div>
</div>