<?php
error_reporting(0);
ob_start();
//session_start();
include_once("inc/config.php");
include_once("inc/fungsi.php");
$version=get_user_browser();
if (($version<=8) and ($version!="notie")){
header("location:".$urlwebnya.'blocked');
exit();
}
$def_radio = "";
if ($_GET) {
	$def_radio = "-1";
	
	$id = $_GET['play'];
	$isStereo = $_GET['mode'];
	if (is_numeric($id) && $id>0) {		
		$sql_def = "select * from ".tabel_radio." where radio_id='".$id."' and status='1'";
		$res_def = mysql_query($sql_def);
		$row_def = mysql_fetch_object($res_def);
		$nama = $row_def->nama;
		$mount = $row_def->mount;
		if (empty($nama) || empty($mount)) {
			$id_radio = "-1";
		} else {
			$id_radio = "$id";
		}
	}
	
	// REMOVE THIS LINE!!!
	if ($id=="100") {
		$id_radio = 100;
	}
	
	if ($isStereo!="1") {
		$isStereo = "0";
	}
	$def_radio = '<div style="color:#000;" id="id_radio">'.$id_radio.'</div><div style="color:#000;" id="stereo_radio">'.$isStereo.'</div>';
}

// full banner?
$bg0 = ' bgcolor="#545454" ';
$bg1 = ' bgcolor="#363636" ';
$bg2 = ' background:#000; ';
$bg3 = ' bgcolor="#000000" ';
$bg4 = '';
$bg5 = '';
$fullBanner = true;
if($fullBanner==true) {
	$bg0 = '';
	$bg1 = '';
	$bg5 = ' background:#000000; ';
	$bg4 = '';
}

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta property="og:image" content="http://jogjastreamers.com/images/js-logo100.jpg" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<title>JOGJA STREAMERS</title>
<!--[if IE]>
		<link href="css/style_ie.css" rel="stylesheet" type="text/css">
	<![endif]-->

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
<link rel="Shortcut Icon" href="js.ico" type="image/x-icon" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/jquery.corner.js"></script>
<script type="text/javascript" src="js/center.js"></script>
<script type="text/javascript" src="js/radiojs2.js"></script>
<script src="plugin/jquery-1.8.3.js"></script>
<script src="js/jquery-ui-1.10.1.custom.min.js"></script>
<script src="plugin/jquery.bpopup-0.7.0.min.js"></script>
<script src="plugin/build/mediaelement-and-player.min.js"></script>
<script type="text/javascript" src="plugin/Content-Slider-master/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="plugin/Content-Slider-master/js/jquery.ennui.contentslider.js"></script>
<!-- Syntax highlighting -->
	<link rel="stylesheet" href="plugin/anytingslider/prettify/prettify.css" media="screen">
	<script src="plugin/anytingslider/prettify/prettify.js"></script>

	<!-- Anything Slider optional plugins -->
	<script src="plugin/anytingslider/jquery.easing.1.2.js"></script>
	<!-- http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js -->


	<!-- AnythingSlider -->
	<link rel="stylesheet" href="plugin/anytingslider/anythingslider.css">
	<script src="plugin/anytingslider/jquery.anythingslider.js"></script>

	<!-- AnythingSlider video extension; optional, but needed to control video pause/play -->
	<!-- Ideally, add the stylesheet(s) you are going to use here,
	 otherwise they are loaded and appended to the <head> automatically and will over-ride the IE stylesheet below -->
	<link rel="stylesheet" href="plugin/anytingslider/theme-metallic.css">
	<link rel="stylesheet" href="plugin/anytingslider/theme-minimalist-round.css">
	<link rel="stylesheet" href="plugin/anytingslider/theme-minimalist-square.css">
	<link rel="stylesheet" href="plugin/anytingslider/theme-construction.css">
	<link rel="stylesheet" href="plugin/anytingslider/theme-cs-portfolio.css">
<script type="text/javascript">

			$(function() {
				$('#one').ContentSlider({
					width : '600px',
					height : '266px',
					speed : 800,
					easing : 'easeInOutBack'
				});
			});
$(function() {
	$('#caritbl').click(function(){
	var q=$('#cari').val();
	var url=$('#url').val();
	$('#tabs-1').hide();
	$('#stationlist').hide();
	$('#loadico').show();
	var jum=$('#jumlah :selected').val();
	if(q!=''){
	carikota(q,jum);
	}
	});
});
$(function() {
	$('#jogjastreamer').change(function(){
		$('#loadico').show();
	$('#tabs-1').hide();
	$('#stationlist').hide();
	var q=$('#cari :selected').val();
	var jum=$('#jumlah :selected').val();
	jumlah(q,jum);
	});
});
		</script>
		<script src="plugin/Content-Slider-master/js/jquery.chili-2.2.js" type="text/javascript"></script>
		<script src="plugin/Content-Slider-master/js/chili/recipes.js" type="text/javascript"></script>

<link rel="stylesheet" href="plugin/build/mediaelementplayer.min.css" />
<link rel="stylesheet" href="plugin/build/mejs-skins.css" />
<link href="plugin/Content-Slider-master/css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="css/mediaquery.css" media="screen">


    <script>
		$(document).ready(function(){
		 var $container = $("#tabs-2");
        $container.load("rangking.php");
		$('#bannerradio').hide();
		<?   
		$q= isset ($_GET['q'])?$_GET['q']:NULL;
		if($q==''){
		?>
		$('#tabs-1').hide();
	    $('#stationlist').hide();
		$('#loadico').show();
		loadcontent('10');
		<? }?>
				//To switch directions up/down and left/right just place a "-" in front of the top/left attribute
				//Vertical Sliding
				//Caption Sliding (Partially Hidden to Visible)
				$('.boxgrid.caption').hover(function(){
					$(".cover", this).stop().animate({top:'-30px',height:'180px',"display": "block"},{queue:false,duration:400});
				}, function() {
					$(".cover", this).stop().animate({top:'81px'},{queue:false,duration:400});
				});
			});

	$(function() {
        $( "#tabs" ).tabs();
    });	

		$(function(){

			$('#slider').anythingSlider({
				theme           : 'metallic',
				easing          : 'easeInOutBack',
				autoPlay            : false,  
				 navigationFormatter : null,      // Details at the top of the file on this use (advanced use) 
                 navigationSize      : false, 
				  expand              : true,     // If true, the entire slider will expand to fit the parent element 
                 resizeContents      : true,    
				onSlideComplete : function(slider){
					// alert('Welcome to Slide #' + slider.currentPage);
				}
			});

		});
		
	</script>
</head>
<body style="<?=$bg4?>"><div id="element_to_pop_up"></div>
<div id="radio_play"></div>
<div id="fb-root"></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="height: 100px;">
	
	<tr>
		<td  align="center" <?=$bg1?> >
			<div class="bg" style="width:960px;padding-bottom:6px;<?=$bg5?>">
			<table id="header" width="960" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table class="header-container" width="960" border="0" cellpadding="0" cellspacing="0"  style="background:url(images/logobg.jpg) repeat-x;" <?=$bg1?>>
							<tr>
								<td>
								<div style="width:100%">
                                <?
								//show_array($_SERVER);
								if (akses=='jogjastreamers') {
   								?>
                                  <img src="images/JogjaStreamer_depan_a_02.png" <?=$bg1?>>
                                <?
								} 
								else {
    							?>
                                 <img src="images/indostreamers.png" <?=$bg1?>>
                                <?
								}
								?>
                              </div>
                                </td>
								<td>

					  <table cellspacing="0" cellpadding="0" border="0" >
										<tr>
											<td>
                                          	<img src="images/banner/banner_citraweb.jpg" class="banneratas">
                                            </td>
										
										</tr>
									</table>
							  </td>
								<td width="18" style="background:url(images/logokanan.jpg) left no-repeat;">&nbsp;</td>
						  </tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="middle" height="20">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="62%" align="left">
									<table class="navbar" width="100%" height="30" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;margin-left: 10px;">
										<tr>
											<td align="center"><a onClick="loadHome('fast');" class="abu f-12 pointer activ">HOME</a>&nbsp;</td>
											<td align="center"><a class="abu f-12 pointer" onClick="loadpagehalaman('adv.php');">ADVERTISEMENT</a> </td>
											<td align="center"><a class="abu f-12 pointer" onClick="loadpagehalaman('terms.php');">TERMS&nbsp;&&nbsp;CONDITION</a> </td>
											<td align="center"><a onClick="loadpagehalaman('about.php');" class="abu f-12 pointer" >ABOUT&nbsp;US</a></td>
											<td align="center"><a onClick="loadpagehalaman('index_berita.php')" class="abu f-12 pointer" >NEWS</a></td>
											<td align="center"><a onClick="loadpagehalaman('contact.php');" align="left" class="abu f-12 pointer" >CONTACT&nbsp;US</a></td>
										</tr>
									</table>									
								</td>
								<td align="right" width="26%" class="abu" ><div style="margin-top:10px;">&nbsp;</div></td>
								<td align="left" width="24%">
								<div style="margin-top:10px;">&nbsp;</div>
								</td>
							</tr>
						</table>
						
					</td>
				</tr>
			</table>
			</div>
		</td>
	</tr>
	<tr>
		<td align="center">
			<div class="line-separator" style="padding-top: 5px;width:960px;<?=$bg2?>">
	        <hr class="merah"/>
			</div>
   <? 
   $jumlahview = isset ($_GET['limit'])?$_GET['limit']:NULL;
		?>             
<div id="tabs" style="padding-top: 3px;width:960px; margin-left: -5px;">
    <ul style=" margin-left: -1px;">
        <li style="padding-right:70px;"><a href="#tabs-1">STATION LIST</a></li>
        <li style="padding-right:70px;"><a href="#tabs-2">TOP 10 STATION LIST</a></li>
           <div id="jogjastreamer" align="left"> &nbsp;&nbsp;<span style=" color:#CC0000;">View:</span><select name="jumlah" id="jumlah">
                                <option value="10" selected="selected">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                  </select>
           &nbsp;<span style=" color:#CC0000;">Radio Station By City:</span>  
           <select name="cari" id="cari" class="f-12 combo">
										<option value="0" selected="selected">Semua </option>
										<?php
											$sqlKota = "SELECT DISTINCT a.id_kota,kota FROM t_kota a,radio b 
														WHERE	a.status = '1' 
														AND		a.id_kota = b.id_kota 
														ORDER BY a.kota ASC";
											
											$resKota = mysql_query($sqlKota);
											
											while($barisKota = mysql_fetch_array($resKota)) {
											$selected="";
												if(($q!='')and ($barisKota['id_kota']==$q)){
												$selected="selected";
												}
												echo "<option value='".$barisKota['id_kota']."' >".$barisKota['kota']."</option>";
												
											}
											
										?>
									</select>
          <input type="hidden" name="url" id="url" value="<?=urlwebnya?>">
</div>
    </ul>
 <div style="width:100%; height: 223px; background:#FFFFFF" id="loadico">
 	<? if (akses=='jogjastreamers') {
   								?>
                                <img src="images/loadingjs.gif" style="margin-top: 35px;">
                                <?
								} 
								else {
    							?>
                                 <img src="images/loadingis.gif" style="margin-top: 35px;">
                                <?
								}
								?>
 
 </div>
 <div style="width:100%; height: 223px; background:#FFFFFF" id="bannerradio"></div>
	<div id="stationlist" align="center">
		<div id="tabs-1" style="background: #FFFFFF; min-height: <?=$tinggi?>; height: <?=$tinggi?>;" >
        </div>					
	
	<div id="tabs-2" style="background: #FFFFFF; min-height: 230px;height: 230px;">
   </div>
   </div>
</div>
</div>
