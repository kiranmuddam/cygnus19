<?php
session_start();
require_once("connect.php");

//reading blocked ips
if (1 == 1) {
if(isset($_SESSION['stuid'])==false){
      $stuid='Unknown';
   }else{
      $stuid=$_SESSION['stuid'];
   }

$ip=$_SERVER['REMOTE_ADDR'];
$today=date('Y-m-d');
$currentDate =  time(); 
$dat=date("Y-m-d H:i:s", $currentDate);
$visits=mysqli_query($con,"SELECT * FROM page_logs where dates='$today' and stuid='$stuid' and page='Register DB'");
$cm=mysqli_num_rows($visits);
  if($cm<=0){
mysqli_query($con,"INSERT INTO page_logs(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Register DB','Cygnus','$stuid')");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Register DB','Cygnus','$stuid')");
   }else{
mysqli_query($con,"UPDATE page_logs SET no_of_times=no_of_times+1 where dates='$today' and page='Register DB' and stuid='$stuid'");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Register DB','Cygnus','$stuid')");        
    }
    //checking whether loggedin or not       
    if (isset($_SESSION['stuid']) && !empty($_SESSION['stuid'])) {
        $stuid      = ($_SESSION['stuid']);
        $isloggedin = true;
        if (isset($_POST['eid']) && !empty($_POST['eid']) && isset($_POST['part']) && !empty($_POST['part']) && isset($_POST['ids']) && !empty($_POST['ids'])) {
            //function for sanitizing variable values
            function check_field($field)
            {
                
                $fi = mysqli_real_escape_string($con, $_POST[$field]);
                return $fi;
            }
            
            $eid         = mysqli_real_escape_string($con,$_POST['eid']);
            $part        = mysqli_real_escape_string($con,$_POST['part']);
            $ids         = mysqli_real_escape_string($con,$_POST['ids']);
            $query       = mysqli_query($con, "SELECT * FROM events WHERE eid='$eid'");
            $query_fetch = mysqli_fetch_array($query, MYSQLI_BOTH);
            $tt          = mysqli_query($con, "SELECT * FROM site_settings WHERE function='Event Registrations'");
            $ison        = mysqli_fetch_array($tt, MYSQLI_BOTH);
            if (mysqli_num_rows($query) >= 1) {
                        $query       = mysqli_query($con, "SELECT * FROM events WHERE eid='$eid'");
                        $query_fetch = mysqli_fetch_array($query, MYSQLI_BOTH);
                        $branch      = $query_fetch['branch'];
                        $eventname   = $query_fetch['eventname'];
                if ($ison['value'] == "off") {
                     mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','Registration for All Events has been Closed')");
                    echo "Registration for All Events has been Closed";
                   
                } elseif ($query_fetch['areregistrationson'] == "off") {
                  mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','Registration for this Event has been Closed')");
                    echo "Registration for this Event has been Closed";

                } else {
                    
                    $tids = array();
                    $tids = explode("~", $ids);
                    if (!in_array($stuid, $tids)) {
                        print "Please Include Yourself.";
        mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','Please Include Yourself')");
                        exit;
                    }
                    //getting max team id
                    $teamid = 0;
                    $dd     = mysqli_query($con, "SELECT * FROM event_registrations WHERE eid='$eid' ORDER BY sno DESC");
                    $t      = mysqli_fetch_array($dd, MYSQLI_BOTH);
                    $teamid = $t['teamid'];
                    $teamid = (int) $teamid;
                    $teamid++;
                    
                    
                    //function for duplicate checking
                    function showDups($array)
                    {
                        $array_temp = array();
                        
                        foreach ($array as $val) {
                            if (!in_array($val, $array_temp)) {
                                $array_temp[] = $val;
                            } else {
                                echo 'Following are Repeating ' . $val . '<br />';
                                $lo='Following are Repeating ' . $val . '<br />';
                                 mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','$lo')");
                                exit;
                            }
                        }
                    }
                    
                    /*//allow only female reg for 2048
                    if($eid=="22"){
                    $err="";
                    $valid=0;
                    $regco=0;
                    for($i=0;$i<count($tids);$i++)
                    {
                    if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='".$tids[$i]."' and gender='Female'"))<1){$err=$err.$tids[$i].", ";$regco++;}
                    else{$valid++;}    
                    }
                    if($regco!=0){$ty=($regco==1)?"is":"are";$err=$err." $ty not girls and this is only for Girls";echo $err;exit;}
                    }*/
                    
                    
                    /*//allow only male reg for counter strike
                    if($eid=="23"){
                    $err="";
                    $valid=0;
                    $regco=0;
                    for($i=0;$i<count($tids);$i++)
                    {
                    if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='".$tids[$i]."' and gender='Male'"))<1){$err=$err.$tids[$i].", ";$regco++;}
                    else{$valid++;}    
                    }
                    if($regco!=0){$ty=($regco==1)?"is":"are";$err=$err." $ty not boys and this is only for Boys";echo $err;exit;}
                    }
                    */
                    
                    /*//dont allow male and female reg for moto gp and sherlock homes
                    if($eid=="24"){
                    $err="";
                    $valid=0;
                    $v=0;
                    $regco=0;
                    for($i=0;$i<count($tids);$i++)
                    {
                    if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='".$tids[$i]."' and gender='Male'"))<1){$regco++;}
                    else{$v++;}    
                    }
                    if($regco!=0 and $v!=0){$err=$err." Participants should be from same gender.";echo $err;exit;}
                    }*/
                    
                    
                    //checking duplicates
                    showDups($tids);
                    
                    //checking whether user is registered to event
                    $err   = "";
                    $valid = 0;
                    $regco = 0;
                    for ($i = 0; $i < count($tids); $i++) {
                        if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE stuid='" . $tids[$i] . "'")) < 1) {
                            $err = $err . $tids[$i] . ", ";
                            $regco++;
                        } else {
                            $valid++;
                        }
                    }
                    if ($regco != 0) {
                        $ty  = ($regco == 1) ? "is" : "are";
                        $err = $err . " $ty not Exists";
                        echo $err;
                        mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','$err')");
                        exit;
                    }
                    
                    
                    /*
                    //checking E4 member is in team or not
                    $err="";
                    $valid=0;
                    $regco=0;
                    for($i=0;$i<count($tids);$i++)
                    {
                    $money=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='".$tids[$i]."'"));
                    if($money['year']=="E4"){$err=$err.$tids[$i].", ";$regco++;}
                    else{$valid++;}    
                    }
                    if($regco!=0){$err=$err." are(is) not allowed to register as they are E4 students";echo $err;exit;}
                    */
                    
                    if ($query_fetch['isyearrestrictions'] == "yes") {
                        //checking year restrictions
                        $err = "";
                        $que = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM isyearrestrictions WHERE eid='$eid'"), MYSQLI_BOTH);
                        $OP1 = $que['P1'];
                        $OP2 = $que['P2'];
                        $OE1 = $que['E1'];
                        $OE2 = $que['E2'];
                        $OE3 = $que['E3'];
                        $OP4 = $que['E4'];
                        
                        $P1 = 0;
                        $P2 = 0;
                        $E1 = 0;
                        $E2 = 0;
                        $E3 = 0;
                        $P4 = 0;
                        
                        
                        for ($i = 0; $i < count($tids); $i++) {
                            $m = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE stuid='" . $tids[$i] . "'"), MYSQLI_BOTH);
                            if ($m['year'] == "P1") {
                                $P1++;
                            }
                            if ($m['year'] == "P2") {
                                $P2++;
                            }
                            if ($m['year'] == "E1") {
                                $E1++;
                            }
                            if ($m['year'] == "E2") {
                                $E2++;
                            }
                            if ($m['year'] == "E3") {
                                $E3++;
                            }
                            if ($m['year'] == "E4") {
                                $E4++;
                            }
                        }
                        
                        if ($P1 < $OP1) {
                            echo "Team Should Contain " . $OP1 . " P1 Students";
                            $lo= "Team Should Contain " . $OP1 . " P1 Students";
                            mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','$lo')");
                            exit;
                        } else if ($P2 < $OP2) {
                            $lo="Team Should Contain <span style='color:yellow;'>" . $OP2 . "</span> P2 Students";
                            mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','$lo')");
                            echo "Team Should Contain <span style='color:yellow;'>" . $OP2 . "</span> P2 Students";
                            exit;
                        } else if ($E1 < $OE1) {
                            $lo="Team Should Contain <span style='color:yellow;'>" . $OE1 . "</span> E1 Students";
                            mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','$lo')");
                            echo "Team Should Contain <span style='color:yellow;'>" . $OE1 . "</span> E1 Students";
                            exit;
                        } else if ($E2 < $OE2) {
                            $lo="Team Should Contain <span style='color:yellow;'>" . $OE2 . "</span> E2 Students";
                            mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','$lo')");
                            echo "Team Should Contain <span style='color:yellow;'>" . $OE2 . "</span> E2 Students";
                            exit;
                        } else if ($E3 < $OE3) {
                            $lo="Team Should Contain <span style='color:yellow;'>" . $OE3 . "</span> E3 Students";
                            mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','$lo')");
                            echo "Team Should Contain <span style='color:yellow;'>" . $OE3 . "</span> E3 Students";
                            exit;
                        } else if ($E4 < $OE4) {
                            $lo="Team Should Contain <span style='color:yellow;'>" . $OE4 . "</span> E4 Students";
                            mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','$lo')");
                            echo "Team Should Contain <span style='color:yellow;'>" . $OE4 . "</span> E4 Students";
                            exit;
                        }
                        
                    }
                    
                    
                    //checking whether already registered
                    $err   = "";
                    $valid = 0;
                    $regco = 0;
                    $mine  = mysqli_query($con, "SELECT ids FROM event_registrations WHERE eid='$eid'");
                    while ($p2 = mysqli_fetch_array($mine, MYSQLI_BOTH)) {
                        $spl = explode("~", $p2['ids']);
                        for ($k = 0; $k < count($tids); $k++) {
                            if (in_array($tids[$k], $spl)) {
                                $err = $err . $tids[$k] . ", ";
                                $regco++;
                                
                            }
                        }
                    }
                    
                    if ($regco != 0) {
                        $ty  = ($regco == 1) ? "is" : "are";
                        $err = $err . " $ty Already Registered";
                        echo $err;
                         mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','$err')");
                        exit;
                    }
                    
                    if (count($tids) > $query_fetch['participants']) {
                        echo "Participants Number is greater than Original Participation Number";
                         mysqli_query($con,"INSERT INTO event_registrations_log(`eid`, `branch`, `eventname`,`teamid`,`ids`,`regdone_by`,`regdone_ip`,`status`) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','Participants Number is greater than Original Participation Number')");
                        mysqli_query($con,"UPDATE users set status='2' where stuid='$id");
                        /*mysqli_query($con,"INSERT INTO blockedips(user,ip,reason) VALUES('$stuid','$ip','Participation Number Increased than Original Participation Number')");*/
                        exit;
                    } else {
                        
                        
mysqli_query($con,"INSERT INTO event_registrations(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip')");
    mysqli_query($con,"INSERT INTO event_registrations_log(`eid`, `branch`, `eventname`,`teamid`,`ids`,`regdone_by`,`regdone_ip`,`status`) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','Success')");
                        for ($i = 0; $i < count($tids); $i++) {
                            
                            $query       = mysqli_query($con, "SELECT * FROM events WHERE eid='$eid'");
                            $query_fetch = mysqli_fetch_array($query, MYSQLI_BOTH);
                            $branch      = $query_fetch['branch'];
                            $dis         = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM branch_categories WHERE branch='$branch'"), MYSQLI_BOTH);
                            $eventname   = $query_fetch['eventname'];
                            $id          = $tids[$i];
                            $displ       = $dis['displayname'];
                            $frm         = "Event Organizer";
                            $subject     = "Thanks for Registering to $displ - $eventname";
                            $description = '<div align="left">Hi ' . $id . ',<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thank you for Registering to ' . $eventname . '.Your Team ID is <b>' . $teamid . '.</b>.If any problem persists,please contact us through chat box.<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> sd/-</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>TECKZITE16 Team</b><br></div>';
                            /*mysql_query("INSERT INTO personal_msgs(stuid,subject,description,frm) VALUES('$id','$subject','$description','$frm')");*/
                            $f           = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM users WHERE stuid='$id'"), MYSQLI_BOTH);
                            $pree        = $f['eventids'];
                            $pree        = (string) $pree . (string) $eid . "~";
                            mysqli_query($con, "UPDATE users SET eventsregcount=eventsregcount+1,eventids='$pree' WHERE stuid='$id'");
                        }
                        echo "success";
                        
                    }
                }
            } else {
                echo "There is No Such Event";
                 mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','There is No Such Event')");
            }
        } else {
            mysqli_query($con,"UPDATE users set status='2' where stuid='$id");
            mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','Malicious Account-Blocked')");
            echo "Don't Act Smart :) You will be blocked";
            
        }
    } else {
        echo "Please Login";
         mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','Please Login')");
    }
} else {
    echo "Your Account has been blocked";
     mysqli_query($con,"INSERT INTO event_registrations_log(eid,branch,eventname,teamid,ids,regdone_by,regdone_ip,status) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip','Account already Blocked')");
}
?>