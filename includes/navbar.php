<?php 
session_start();
error_reporting(0);
?>
<noscript>
  <i class="fa fa-warning"></i> Please enable Javascript in your browser.<i class="fa fa-smile-o"></i> Don't Act Smart..
</noscript>
<!-- Static navbar -->
      <nav class="navbar navbar-default" style="color:#fff !important;">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            
            <a class="navbar-brand" href="index.php"><i class="fa fa-desktop"></i> Laptop Survey</a>          
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>               
              <li><a href="slist.php"><i class="fa fa-users"></i> Selected List</a></li>                      
                <?php 
              if(isset($_SESSION['user_session'])==true){
                $session=$_SESSION['user_session'];              
                echo'
                <li class="dropdown">
                <a href="#"  class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  '.$session.'<span class="caret"></span></a>
                <ul class="dropdown-menu" style="margin-left:15% !important;">                                                        
                  <li><a href="logout.php"><i class="fa fa-lock"> </i> Logout</a></li>                  
                </ul>
              </li>
                                        ';
              }else{
              ?>
              <li><a href="index.php"><i class="fa fa-unlock"></i> Login</a></li>         
             <li><a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Contact</a>
                    <ul class="dropdown-menu">                    
                      <li style="width:100%;padding:11px;color:black !important;">Any Technical Problem Contact 8790042337</li>                      
                    </ul>
            </li>
            </ul>                            
            <?php } ?>                      
            </ul>                                 
            </ul>            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>



