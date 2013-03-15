	<? if ($_GET['tombol']=="pause"){?>
    <a onclick="playlho()"><img src="images/play.png" /></a>&nbsp;<a><img src="images/stoph.png" /></a>
    <? }
	else if($_GET['tombol']=="play"){ ?>
    	<a><img src="images/playh.png" /></a>&nbsp;<a onclick="stoplho()"><img src="images/stop.png" /></a>
	<? }
	else{
	?>
      <a onclick="playlho()"><img src="images/play.png" /></a>&nbsp;<a onclick="stoplho()"><img src="images/stop.png" /></a>
    <?
	}
	exit;?>
	