<?php
ob_start();
session_start();
require("../inc/config.php");
$rt = mysql_query("UPDATE ".tabel_user." SET status_online=0 WHERE user_id='".$SessionNya['id']."'") or die("Log error");
session_destroy();
Header("Location: index.php");
?>