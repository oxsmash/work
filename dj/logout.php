<?php
ob_start();
session_start();
require("../inc/config.php");
mysql_query("UPDATE ".tabel_user_penyiar." SET status_chat='0', status_login='0' WHERE id_penyiar='".$_SESSION['penyiarSession']['id']."'");
session_destroy();
Header("Location: ../index.php");
?>