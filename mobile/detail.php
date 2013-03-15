<?
include_once("../inc/fungsi.php");
include_once("../inc/config.php");
include_once('../inc/function_ip.php');
?>
<!DOCTYPE html> 
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Single page template</title> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 

<body> 

<?								
$cmd = "SELECT * FROM radio WHERE radio_id='".$_GET["id"]."' and status = '1' limit 1";	
$res = mysql_query($cmd);
while($brs = mysql_fetch_array($res)){							
$nama= $brs[nama];
$keterangan=$brs[keterangan];
$mount= $brs[mount];
}
?>	
	
	
<div data-role="page" id="one">

	<div data-role="header">
		<h1>Jogjastreamers</h1>
		<a href="1.php" data-icon="back" data-iconpos="notext" data-direction="reverse">Home</a>
		<a href="1.php" data-icon="search" data-iconpos="notext" data-rel="dialog" data-transition="fade">Search</a>
	</div><!-- /header -->

	<div data-role="content">	
	<h2><?=$nama;?></h2>
	<img src="http://www.jogjastreamers.com/images/logo/<?=$_GET[id];?>.jpg">	
	<!--<audio id="player" src="http://jgj.jogjastreamers.com:8000/<?=$mount;?>"></audio>-->	
	


	<audio id="player" preload="auto" controls> 
		<source src="http://202.65.114.251:8001/;" type="audio/mpeg" />
    <source src="http://www.vorbis.com/music/Epoq-Lepidoptera.ogg" />		
    Your browser does not support the audio element.
	</audio>
	
	<div> 
	<button onclick="document.getElementById('player').play()" data-inline="true">Play</button> 
	<button onclick="document.getElementById('player').pause()" data-inline="true">Pause</button> 
	<button onclick="document.getElementById('player').volume += 0.1" data-inline="true">Vol+ </button> 
	<button onclick="document.getElementById('player').volume -= 0.1" data-inline="true">Vol- </button> 
	</div>
						
	<input type="range" name="slider-1" id="slider-1" value="60" min="0" max="100" data-highlight="true" />
	<a href="#two">About</a>
	
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>Footer content</h4>
	</div><!-- /footer -->
	
</div>
<!-- /page -->

<div data-role="page" id="two">

	<div data-role="header">
		<h1><?=$nama;?></h1>
		<a href="1.php" data-icon="back" data-iconpos="notext" >Home</a>
	</div><!-- /header -->

	<div data-role="content">	
	<?echo $keterangan;?>					
						
	
	<a href="1.php">Back to Home</a>
	
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>Footer content</h4>
	</div><!-- /footer -->
	
</div>
<!-- /page -->

</body>
</html>