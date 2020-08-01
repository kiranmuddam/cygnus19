<?php
session_start();
unset($_SESSION['iot_user']);
session_destroy();
header('Location:index.php');
