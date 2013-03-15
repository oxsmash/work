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
<div data-role="page" id="one">

	<div data-role="header" data-theme="a" data-position="fixed">
		<h1>Jogjastreamers</h1>
		<a href="1.php" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<a href="1.php" data-icon="search" data-iconpos="notext" data-rel="dialog" data-transition="fade">Search</a>
	</div><!-- /header -->

	<div data-role="content">	
		<div class="content-secondary">
				

				<div class="content-primary" >	
					
					<ul data-role="listview" data-theme="c" data-dividertheme="d" data-filter="true">
						<?								
						$cmd = "SELECT * FROM radio WHERE status = '1' ORDER BY rand()";	
						$res = mysql_query($cmd);
						while($brs = mysql_fetch_array($res)){
							?>
							<li>
								<a href="detail.php?id=<?=$brs[radio_id];?>">
									<h3><?=$brs[nama];?></h3>
									<p>Yogyakarta</p>
								</a>
									
							</li>
							<?
						}
					?>
					</ul>
				</div>
			</div>
	
	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>Footer content</h4>
	</div><!-- /footer -->
	
</div>
<!-- /page -->



</body>
</html>