<?php

session_start();
include("inc/fungsi.php");
include("inc/config.php");
?>

<head>
    <style type="text/css">
        body {margin:0px;}
    </style>
</head>

<?php

$timeHariIni = date("Y-m-d");

$cmdBannerKanan = "SELECT * FROM cni_banner 
							WHERE letak_banner = '4' 
							AND status_banner = '1' 
							AND (selesai_banner >= '".$timeHariIni."'   
								AND mulai_banner <= '".$timeHariIni."')
							AND (limit_banner > jumlah_show)
							AND tgl_show = '".$timeHariIni."'
							ORDER BY rand() 
							LIMIT 8
							
							";
//echo $cmdBannerKanan;
$resBannerKanan = mysql_query($cmdBannerKanan);	
$res=mysql_fetch_assoc($resBannerKanan);

echo '  <div style="margin:0px;">
            <img border="0" src="images/banner/'.$res['file_banner'].'">
        </div>
        ';

?>
