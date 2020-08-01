<div class="ui-modal tournament-modal fullscreen">
    <div class="overlay"></div>
      <div class="modal">
          <a href="#" class="close">
                <svg version="1.1" class="close-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	                           viewBox="0 0 75 75" style="enable-background:new 0 0 75 75;" xml:space="preserve">
                <g>
	               <g>
		                <polygon class="st0" points="47.1,48.5 24.4,28.4 26,26.6 48.7,46.7 		"/>
	               </g>
	               <g>
		                <polygon class="st0" points="26,48.5 24.4,46.7 47.1,26.6 48.7,28.4 		"/>
	               </g>
	               <g>
		              <defs>
			               <rect id="close-icon-SVGID_1_" y="0" width="75.2" height="75"/>
		              </defs>
		               <clipPath id="close-icon-SVGID_2_">
			                   <use xlink:href="#close-icon-SVGID_1_"  style="overflow:visible;"/>
		                </clipPath>
		              <g class="st1">
			                 <path class="st2" d="M75.2,75H0V0h75.2V75z M2.3,72.6h70.5V2.4H2.3V72.6z"/>
		              </g>
	               </g>
                </g>
              </svg>
        </a>

    <div class="modal-content">
        <h3>Register Now And Experience Cygnus</h3>
     <ul class="logos">  
     <?php   
  $eve=mysqli_query($con,"SELECT * FROM events where visibility=1");
  $c=mysqli_num_rows($eve);
  while($eve_fet=mysqli_fetch_array($eve,MYSQLI_BOTH)){
?>
                           
                <div class="button-container" style="display:inline;">
<a class="button green-border nav-anchor" href="register.php?eve=<?php echo $eve_fet['eid'];?>" target="_blank" style="width:18.3125rem;height: 5.625rem;padding:5rem 1rem;">
                      <span class="solo-vertical-align">
                        <?php echo $eve_fet['eventname'];?>
                      </span>
                    </a>
                  </div>  
                    <?php } ?>            
            
          </ul>
         

              

    </div>

  </div>
</div>     