<?php

//header("location:index.php");
//exit;

//ob_start();
session_start();
include("inc/fungsi.php");
include("inc/config.php");

?>

<html>
<head>
<title>JOGJA STREAMERS</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
</head>
<body>

<div class="imagehover">
<a href=""><img src="images/logo/11.jpg" width="160" height="80" /></a>
<p>
<a class="pointer" onClick="plays('d','1');stat('dsdsd');"><img src="images/radio_stereo2.png" border="0" width="41" height="19" /></a>
<br/>
<a target="blank" href = "dsadsa"><img src="images/radio_tw.png" border="0" width="18" height="18" /></a>
<a target="blank" href = "dsdsd"><img src="images/radio_fb.png" border="0" width="18" height="18" /></a>
<br/><a onClick="loadRadioDetail('19')" class="pointer" style="color:#FFFFFF">More About Us</a>
</p>
</div>

<br/>
</body>
</html>
