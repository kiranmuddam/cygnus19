<?php
$con = mysqli_connect("localhost", "", "", "iot_2k19");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
