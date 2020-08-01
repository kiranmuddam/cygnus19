<style type="text/css">
  nav.top-bar-container{
    height:8% !important;
  }
.button.glitch .text{
  height: 10px;
  padding:20px;
  margin-top:-7%;
}  
</style>
<script>
document.addEventListener('contextmenu', event => event.preventDefault());

document.onkeydown = function(e) {
    if(e.keyCode == 123) {
     return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
     return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
     return false;
    }
    if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
     return false;
    }

    if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
     return false;
    }      
 }


</script>
<nav class="top-bar-container">

  <div class="title">    
      <h4 style="margin-top:-17%;">CYGNUS'19</h4>
  </div>

  <div class="right">
    <div class="desktop">
      <ul class="links">
       <li>
      <a href="index.php">
        Home
      </a>
    </li>

<li class="drop-down">
          <a>About</a>

          <div class="drop-down-list">
            <ul>
              <li>
                <a href="marathon.php" class="">Marathon</a>
              </li>
              <li>
                <a href="about.php" class="">Cygnus'19</a>
              </li>
              <li>
                <a href="team.php" class="">Team</a>
              </li>
              </ul>
        <li>
            <?php
            $today=date('m-d-Y');          
    $qu=mysqli_query($con,"SELECT * FROM notifications WHERE visibility='1' and added_date='$today' ORDER BY nid DESC limit 20");
    $c=mysqli_num_rows($qu);    
      ?>
      
            
          <a href="notices.php">
            Notices <?php if($c>0) { echo '('.$c.')'; } ?>
          </a>
        </li>
  

      <li>
      <a href="contact.php">
        Contact
      </a>
    </li>
    <li>
      <a href="team.php">
        Team
      </a>
    </li>
     

        <li>
          <a href="gallery.php" class="">
            Gallery
          </a>
        </li>

       

        <svg style="position: absolute; width: 0; height: 0;" width="0" height="0" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="glitch-sprite">
  <defs>
    <filter id="glitchfilter">
      <feTurbulence type="fractalNoise" baseFrequency="0.000001 0.000001" numOctaves="1" result="warp" seed="1"></feTurbulence>
      <feDisplacementMap xChannelSelector="R" yChannelSelector="G" scale="30" in="SourceGraphic" in2="warp"></feDisplacementMap>
    </filter>
  </defs>
</svg>

        <?php 
              if(isset($_SESSION['stuid'])==true){
                $session=$_SESSION['stuid'];              
                echo'
                <li class="drop-down">
                <a href="#">Welcome '.$session.'<span class="caret"></span></a>
                <div class="drop-down-list">
            <ul>              
              <li><a href="profile.php" class="">Profile</a></li>
              <li><a href="logout.php" class="">Logout</a></li>
            </ul>
          </div>
              </li>
                                        ';
              }else{
              ?>
              
<li> <a href="#"  class="button glitch video-button" data-modal="contact-modal"> 
    <span class="text">Login Now</span>
  </a></li>

            <?php } ?> 
      </ul>
    </div>

    <div class="mobile">
      <a href="#" class="menu-button">
        <svg class="hamburger-icon" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="35" height="21" viewBox="0 0 35 21"><title>hamburger-icon</title><rect id="Rounded_Rectangle_1_copy_4" data-name="Rounded Rectangle 1 copy 4" class="cls-1" width="35" height="2.19" rx="1.09" ry="1.09"/><rect id="Rounded_Rectangle_1_copy_4-2" data-name="Rounded Rectangle 1 copy 4-2" class="cls-1" y="9.41" width="35" height="2.19" rx="1.09" ry="1.09"/><rect id="Rounded_Rectangle_1_copy_4-3" data-name="Rounded Rectangle 1 copy 4-3" class="cls-1" y="18.81" width="35" height="2.19" rx="1.09" ry="1.09"/></svg>

      </a>
    </div>
  </div>

</nav>

      <nav class="menu">

  <a href="#" class="close">
    <svg class="exit-icon" height="23px" space="preserve" style="enable-background:new 0 0 23 23;" version="1.1" viewbox="0 0 23 23" width="23px" x="0px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" y="0px">
  <line class="st1" x1="0.4" x2="22.6" y1="0.4" y2="22.6"></line>
  <line class="st1" x1="0.4" x2="22.6" y1="22.6" y2="0.4"></line>
</svg>

  </a>

  <ul class="links">
    <li>
      <a href="index.php">
        Home
      </a>
    </li>

 <li>
      <a href="about.php">
        About
      </a>
    </li>
 <li>
      <a href="marathon.php">
        Marathon
      </a>
    </li>
   <li>
          <a href="notices.php">
            Notices
          </a>
        </li>

      <li>
      <a href="contact.php">
        Contact
      </a>
    </li>
    <li>
      <a href="team.php">
        Team
      </a>
    </li>

    
    <li>
      <a href="gallery.php" class="">
        Gallery
      </a>
    </li>

   

     <?php 
              if(isset($_SESSION['stuid'])==true){
                $session=$_SESSION['stuid'];              
                echo'
                <li class="drop-down">
                <a href="#">Welcome '.$session.'<span class="caret"></span></a>
                <div class="drop-down-list">
            <ul>              
              <li><a href="profile.php" class="">Profile</a></li>
              <li><a href="logout.php" class="">Logout</a></li>
            </ul>
          </div>
              </li>
                                        ';
              }else{
              ?>
              
<li> <a href="#"  class="button glitch video-button" data-modal="contact-modal"> 
    <span class="text">Login Now</span>
  </a></li>

            <?php } ?> 
  </ul>

</nav>