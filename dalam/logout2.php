<?php
ob_start();
session_start();
session_unset($_SESSION['SessionNya']);
session_destroy();
header("location:index.php");
?>