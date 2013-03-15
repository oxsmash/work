<?php
//ob_start();
//session_start();
include_once("inc/config.php");
include_once("inc/fungsi.php");
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

<link rel="Shortcut Icon" href="js.ico" type="image/x-icon" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/jquery.corner.js"></script>
<script type="text/javascript" src="js/center.js"></script>
<script type="text/javascript" src="js/radiojs2.js"></script>
<script src="plugin/jquery-1.8.3.js"></script>
<script src="plugin/jquery-ui.js"></script>
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
		</script>
		<script src="plugin/Content-Slider-master/js/jquery.chili-2.2.js" type="text/javascript"></script>
		<script src="plugin/Content-Slider-master/js/chili/recipes.js" type="text/javascript"></script>

<link rel="stylesheet" href="plugin/build/mediaelementplayer.min.css" />
<link rel="stylesheet" href="plugin/build/mejs-skins.css" />
<link href="plugin/Content-Slider-master/css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />


    <script>
	$(function() {
			$('ul.garasi li').hover(function(){
				$(this).find('.gambargarasi').animate({top:'100px'},{queue:false,duration:900});
			}, function(){
				$(this).find('.gambargarasi').animate({top:'0px'},{queue:false,duration:900});
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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	
	<tr>
		<td  align="center" <?=$bg1?> >
			<div style="width:870px;padding-bottom:6px;<?=$bg5?>">
			<div style="padding-top: 3px; text-align: left; margin-left: 15px;">
			<a href="https://twitter.com/jogjastreamers" class="twitter-follow-button" data-show-count="true" data-show-screen-name="false">Follow @jogjastreamers</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like layout="button_count" show_faces="false" width="150"></fb:like>									
						</div>
         
			<table width="870" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table width="870" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="306"><img src="images/JogjaStreamer_depan_a_02.png" <?=$bg1?> style="margin-left: -10px">
                                </td>
								<td width="576" style="background:url(images/logobg.jpg) repeat-x;" <?=$bg1?> >

					  <table width="80%" align="center" cellspacing="1" cellpadding="0" border="0" >
										<tr>
											<td>
                                            <?
							$cmdBannerKanan = "SELECT * FROM cni_banner 
							WHERE letak_banner = '1' 
							AND status_banner = '1' 
							AND (selesai_banner >= '".$timeHariIni."'   
								AND mulai_banner <= '".$timeHariIni."')
							AND (limit_banner > jumlah_show)
							AND tgl_show = '".$timeHariIni."'
							ORDER BY rand() 
							LIMIT 1
							
							";

						$resBannerKanan = mysql_query($cmdBannerKanan);		
						$iJoin = 0;
						$arrJoin = array();
						while($res=mysql_fetch_assoc($resBannerKanan)){ 
											
							$link = "";

							if (trim($res['link_banner'])=="loadJoin()") {
								$link = 'onclick=loadJoin()';
								$arrJoin[$iJoin]['id'] = $res[banner_id];
								$arrJoin[$iJoin]['tipe'] = $res['tipe'];
								$arrJoin[$iJoin]['file'] = "images/banner/".$res[file_banner];
								$iJoin++;
								continue;
							} else {
								$link = 'onclick=window.open("klik_banner.php?id='.$res[banner_id].'");';
							}
							
							echo '<div style="padding-bottom:10px;">';
						
							if($res['tipe'] == 'application/x-shockwave-flash'  ) {
								
								$arrSwf = getimagesize("images/banner/".$res['file_banner']);
								$swfH = $arrSwf[1];
								$link = "";
								echo '
									<td><a '.$link.' >
										<embed class="pointer" name="flashfile" src="images/banner/'.$res['file_banner'].'" wmode="transparent" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="160" height="'.$swfH.'">
										</embed>
									</a></td>';
							
							}else {
								echo '<td><a '.$link.' class="pointer"><img border="0"   width="450px" height="60px" src="images/banner/'.$res['file_banner'].'"></a></td>';
							}
							
							$cmdUpdateKanan = "UPDATE cni_banner SET 
												tgl_show = '".date("Y-m-d")."',
												jumlah_show = jumlah_show + 1 
												WHERE 	banner_id = '".$res[banner_id]."'";
												
							mysql_query($cmdUpdateKanan);	

							log_banner($res[banner_id]);			
							
							echo "</div>";
						}
						
						foreach($arrJoin as $value) {
							$link = 'onclick=loadJoin()';
							
							echo '<div style="padding-bottom:10px;">';
						
							if($value['tipe'] == 'application/x-shockwave-flash'  ) {
								$arrSwf = getimagesize($value['file']);
								$swfH = $arrSwf[1];
								$link = "";
								echo '
									<td><a '.$link.' >
										<embed class="pointer" name="flashfile" src="'.$value['file'].'" wmode="transparent" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="160" height="'.$swfH.'">
										</embed>
									</a></td>';
							
							}else {
								echo '<td><a '.$link.' class="pointer"><img border="0"  width="450px" height="60px" src="'.$value['file'].'"></a></td>';
							}
							
							$cmdUpdateKanan = "UPDATE cni_banner SET 
												tgl_show = '".date("Y-m-d")."',
												jumlah_show = jumlah_show + 1 
												WHERE 	banner_id = '".$value['id']."'";
												
							mysql_query($cmdUpdateKanan);	

							log_banner($value['id']);			
							
							echo "</div>";
						} ?>										</td>
										
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
									<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;margin-left: 10px;">
										<tr>
											<td align="center"><a onClick="loadHome('fast');" class="abu f-12 pointer activ">HOME</a> &nbsp;</td>
											<td align="center"><a class="abu f-12 pointer" onClick="loadpagehalaman('adv.php');">ADVERTISEMENT</a> </td>
											<td align="center"><a class="abu f-12 pointer" onClick="loadpagehalaman('terms.php');">TERMS & CONDITION</a> </td>
											<td align="center"><a onClick="loadpagehalaman('about.php');" class="abu f-12 pointer" >ABOUT US</a></td>
											<td align="center"><a onClick="loadpagehalaman('index_berita.php')" class="abu f-12 pointer" >NEWS</a></td>
											<td align="center"><a onClick="loadpagehalaman('contact.php');" align="left" class="abu f-12 pointer" >CONTACT US</a></td>
										</tr>
									</table>									
								</td>
								<td align="right" width="26%" class="abu" ><div style="margin-top:10px;">FOLLOW US &nbsp;&nbsp;&nbsp;</div></td>
								<td align="left" width="24%">
								<div style="margin-top:10px;"><a href="https://www.facebook.com/jogjastreamers" target="_blank"><img src="images/fb_logo.jpg"/></a> <a href="https://twitter.com/jogjastreamers" target="_blank"><img src="images/tweetlogo.jpg"/></a></div>
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
			<div style="padding-top: 5px;width:870px;<?=$bg2?>">
	        <hr class="merah"/>
			</div>
             
<div id="tabs" style="padding-top: 3px;width:880px; margin-left: -5px;">
    <ul style=" margin-lef: -17px;">
        <li style="padding-right:70px;"><a href="#tabs-1">STATION LIST</a></li>
        <li style="padding-right:70px;"><a href="#tabs-2">TOP 10 STATION LIST</a></li>
           <div id="jumlah" align="left" style="position:absolute; margin-left: 445px; margin-top: -3px;"> &nbsp;&nbsp;<span style=" color:#CC0000;">View:</span><select name="jumlah" id="jumlah" onChange="jumlah(this.value);">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                  </select>
           &nbsp;<span style=" color:#CC0000;">Search Radio:</span>  <input type="text" size="18" width="10" id="cari" name="cari" onKeyUp="cariradio(this.value);">
</div>
    </ul>
<div id="stationlist">
   	 <div id="tabs-1" style="background: #FFFFFF; min-height: 230px;height: 230px;">
 		<ul id="slider" style="list-style: none; float:left; margin-left: 0; margin-top: 15px;">
  			 <li>
  				 <ul class="garasi">
    				 <? $cmd = _select_arr("Select * from radio where status=1 order by radio_id limit 0,10");
							foreach($cmd as $num => $rs){ ?>
    							<li>
                                     <div class="gambargarasi"> 
    									<img src="images/logo/<?=$rs['radio_id']?>.jpg" width="160" height="80"/>
 										<br/>	<?=$rs['nama']?>
    								</div>
   									 <div class="textgarasi" align="center">
					<? $detail=detail_radio($rs['radio_id']);
	 					if($detail['shoutcast']=="1") {
							echo '<a class="pointer" onClick="plays(\''.$detail['radio_id'].'\',\'1\');stat(\''.$detail['radio_id'].'\');"><img src="images/radio_stereo2.png" border="0" width="41" height="19" /></a>';
						}
						else{												
							echo '<a class="pointer" onClick="plays(\''.$detail['radio_id'].'\',\'0\');stat(\''.$detail['radio_id'].'\');"><img src="images/radio_mono2.png" border="0" width="41" height="19" /></a>';
							if($row['stereo']=="1") {
														
							echo '<a class="pointer" onClick="plays(\''.$detail['radio_id'].'\',\'1\');stat(\''.$detail['radio_id'].'\');"><img src="images/radio_stereo2.png" border="0" width="41" height="19" /></a>';
							}
						}
						if(strlen($detail['ym_id'])>0) {
							echo '<br/><a href = "ymsgr:sendim?'.$detail['ym_id'].'">'.Get_YMstatus($detail['ym_id']).'</a>';
						 }
						if(strlen($detail['url_twitter'])>0) {						
							echo '<a target="blank" href = "'.$detail['url_twitter'].'"><img src="images/radio_tw.png" border="0" width="18" height="18" /></a>';
						}
						if(strlen($detail['url_fb'])>0) {					
							echo '<a target="blank" href = "'.$detail['url_fb'].'"><img src="images/radio_fb.png" border="0" width="18" height="18" /></a>';
						}						
	?>
   								 </div>
                  			  </li>
							<? } ?>
    			</ul>   
			 </li>
             <li>
  				 <ul class="garasi">
    				 <? $cmd = _select_arr("Select * from radio where status=1 order by radio_id limit 10,10");
							foreach($cmd as $num => $rs){ ?>
    							<li>
                                     <div class="gambargarasi"> 
    									<img src="images/logo/<?=$rs['radio_id']?>.jpg" width="160" height="80"/>
 									<br/>	<?=$rs['nama']?>
    								</div>
   									 <div class="textgarasi" align="center">
					<? $detail=detail_radio($rs['radio_id']);
	 					if($detail['shoutcast']=="1") {
							echo '<a class="pointer" onClick="plays(\''.$detail['radio_id'].'\',\'1\');stat(\''.$detail['radio_id'].'\');"><img src="images/radio_stereo2.png" border="0" width="41" height="19" /></a>';
						}
						else{												
							echo '<a class="pointer" onClick="plays(\''.$detail['radio_id'].'\',\'0\');stat(\''.$detail['radio_id'].'\');"><img src="images/radio_mono2.png" border="0" width="41" height="19" /></a>';
							if($row['stereo']=="1") {
														
							echo '<a class="pointer" onClick="plays(\''.$detail['radio_id'].'\',\'1\');stat(\''.$detail['radio_id'].'\');"><img src="images/radio_stereo2.png" border="0" width="41" height="19" /></a>';
							}
						}
						if(strlen($detail['ym_id'])>0) {
							echo '<br/><a href = "ymsgr:sendim?'.$detail['ym_id'].'">'.Get_YMstatus($detail['ym_id']).'</a>';
						 }
						if(strlen($detail['url_twitter'])>0) {						
							echo '<a target="blank" href = "'.$detail['url_twitter'].'"><img src="images/radio_tw.png" border="0" width="18" height="18" /></a>';
						}
						if(strlen($detail['url_fb'])>0) {					
							echo '<a target="blank" href = "'.$detail['url_fb'].'"><img src="images/radio_fb.png" border="0" width="18" height="18" /></a>';
						}						
	?>
   								 </div>
                  			  </li>
							<? } ?>
    			</ul>   
			 </li>            
     	</ul><!-- End Slider area -->
      </div>					
</div>
                                
                                
    <div id="tabs-2" style="background: #FFFFFF; min-height: 225px;height: 225px;">
	<table width="100%" border="0" cellpadding="2" cellspacing="0" style="margin-top: 5px;">
    <tr>
     <?
	$cmd = _select_arr("Select radio.nama,radio.radio_id,ranking_harian.jumlah from radio,ranking_harian where radio.radio_id=ranking_harian.id_radio and ranking_harian.tgl='".date("Y-m-d")."' and radio.status=1 order by ranking_harian.jumlah desc limit 10");
								foreach($cmd as $num => $rs){
		?>
    <td>
    <table border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td>
    <div id="radio_img<?=$rs['radio_id']?>" class="pointer" style="border: #FF0000 1px solid;">
    <img src="images/logo/<?=$rs['radio_id']?>.jpg" width="160" onMouseOver="radioinfo('<?=$rs['radio_id']?>')" onClick="radioinfo('<?=$rs['radio_id']?>')"/>
    </div>
    </td>
	</tr>
    <tr>
    <td align="center"> <div id="radio_nama"><?=$rs['nama']?></div></td>
    </tr>
    </table>
    </td>
	<?							
	if($num=='4'){
	?>
    <tr/>
    <tr>
    <?
	}							
	?>
                       
								<?
								}
								?>
          </tr>    
     
     </table>    					
    </div>
</div>
</div>
