<?
include_once("inc/fungsi.php");
$version=get_user_browser();
?>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="Shortcut Icon" href="js.ico" type="image/x-icon" />
<title>JOGJA STREAMERS -  Browser Not Support</title>
<style>
.shadow{
color:#161616; 
background-color:#FFFFFF; 
width:600px;
margin-top:25%; 
padding: 25px; 
font-size:16px;
border: 1px solid #161616;
}
</style>
<div style="width: 100%; height:100%" align="center">
<div class="shadow">
Sorry your browser does not support please update to the latest version<br/>
Or you can use another browser<br/>
Your browser is currently : Internet Explorer <?=$version?><br/>
<hr />
Maaf browser anda tidak support silahkan update ke versi terbaru<br/>
Atau anda dapat menggunakan browser lain<br/>
<?="Browser anda saat ini adalah : Internet Explorer ".$version?><br/>
<img src="images/JogjaStreamer_depan_a_02.png"/><br/>
Powered by <a href="http://citra.web.id/">Citraweb Nusa Infomedia</a></div>
</div>