<?php

ob_start();
session_start();
$judulHalaman="DAFTAR KOTA";
$fileIndex="";
$fileSearch="";


include("../inc/headerAdmin.php");



$cHidden = $_GET['cHidden'];
$katakunci = $_GET['katakunci'];
$PageNo = $_GET['PageNo'];
$Submit = $_GET['Submit'];
$letakBanner = $_GET['letakBanner'];

if($cHidden=="1"){
	$katakunci=trim($katakunci);

	$arrKataKunci= explode(" ",$katakunci);

	//echo count($arrKataKunci)."<br />";
	if(!empty($katakunci)) {
		for($dd=0;$dd < count($arrKataKunci);$dd++){
			$detQuery=$detQuery." AND (nama_banner LIKE '%".$arrKataKunci[$dd]."%' )";
				
		}
	}
	
	
	
	
	if(!empty($_GET['date1']) && !empty($_GET['date2'])) {
		
		$d1 = cTime($_GET['date1']);
		$d2 = cTime($_GET['date2']);
		
		
		
		if($d1 > $d2) {
		
			//$detQuery .= $detQuery . " AND tgl >= '".cTgl($_GET['date2'],'')."' AND tgl <= '".cTgl($_GET['date1'],'yes')."'  ";
			$detQuery .= $detQuery . " AND (tgl BETWEEN '".cTgl($_GET['date2'],'')." 00:00:00' AND '".cTgl($_GET['date1'],'')." 23:59:59' ) ";

		}else {
			//$detQuery .= $detQuery . " AND  tgl >= '".cTgl($_GET['date1'],'')."' AND tgl <= '".cTgl($_GET['date2'],'yes')."'  ";
			$detQuery .= $detQuery . " AND (tgl BETWEEN '".cTgl($_GET['date1'],'')." 00:00:00' AND '".cTgl($_GET['date2'],'')." 23:59:59' ) ";
			
		}
		
	}
	
	if(!empty($_GET['slRadio'])) {
	
		$detQuery .= $detQuery . " AND id_radio = '".$_GET['slRadio']."' ";
	
	}
	
	if($letakBanner > 0) {
		$detQuery=$detQuery." AND (letak_banner = '".$letakBanner."')  ";
	}
	
	$tmp = "date1=".$_GET['date1']."&date2=".$_GET['date2']."&katakunci=".$_GET['katakunci']."&slRadio=".$_GET['slRadio']."&cHidden=1";
	
	$sqlview = "SELECT nama_banner,banner_id,tgl,ip,letak_banner,id_radio FROM cni_banner a,banner_log b 
				WHERE	a.banner_id = b.id_banner 	
						". $detQuery ."  ORDER BY id DESC ";
				
	//echo $sqlview;
	
}else{
			
		$sqlview = "SELECT nama_banner,banner_id,tgl,ip,letak_banner,id_radio FROM cni_banner a,banner_log b 
				WHERE	a.banner_id = b.id_banner  	
				ORDER BY id DESC ";
		
				
}


//utk membuat otomatis bar halaman sesuai setting banner


$link=$PHP_SELF."?".$tmp;
$PageSize = 20;
include "../inc/barHalaman.php";
?>
<link rel="stylesheet" type="text/css" media="all" href="../calendar_files/calendar-blue2.css" title="calendar-blue2" />

 <!-- main calendar program -->
  <script type="text/javascript" src="../calendar_files/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="../calendar_files/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="../calendar_files/calendar-setup.js"></script>

				&nbsp;&nbsp;<span class="judul_menu">Daftar Log Banner ::</span>
	<br />
	<br />
	<form action="<?=$PHP_SELF;?>" method="get">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr><td>Cari</td><td>:</td>
		<td><input type="text" name="katakunci" value="<?=$katakunci?>" class="inputPesan" > 
			<input type="hidden" name="cHidden" value="1"> 
			<select name="letakBanner" class="inputPesan">
			<option value="0" <?=($letakBanner == "0") ? "selected" : "" ?>>Semua</option>
			<option value="1" <?=($letakBanner == "1") ? "selected" : "" ?>>Atas</option>
			<option value="2" <?=($letakBanner == "2") ? "selected" : "" ?>>Bawah</option>
			<option value="3" <?=($letakBanner == "3") ? "selected" : "" ?>>Kanan</option>
			<option value="4" <?=($letakBanner == "4") ? "selected" : "" ?>>Kiri</option>
			<option value="5" <?=($letakBanner == "5") ? "selected" : "" ?>>Splash</option>
			<option value="6" <?=($letakBanner == "6") ? "selected" : "" ?>>Running teks</option>
			<option value="7" <?=($letakBanner == "7") ? "selected" : "" ?>>Audio</option>
			</select>
			<select name="slRadio" class="inputPesan"> 
			
				<option value="">Pilih Radio</option>
				<?php
					$cmd23 = "SELECT radio_id,nama FROM radio ORDER BY radio_id ";
					
					$res23 = mysql_query($cmd23) or die();
					
					while($brs = mysql_fetch_array($res23)) {
						
						if($_GET['slRadio'] == $brs['radio_id']) {
							
							$tmp3 = " selected ";
							
						}else {
							$tmp3 = "";
						}	
												
						echo "<option value='".$brs['radio_id']."' ".$tmp3.">".$brs['nama']."</option>";
						
					}
					
				?>
				
			</select>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>
			<input type="text" name="date1" id="f_date_a" class="inputpesan" value="<? echo $date1;?>" Readonly/><button type="reset" id="f_trigger_a">...</button>
			<script type="text/javascript">
				Calendar.setup({
					inputField     :    "f_date_a",      // id of the input field
					ifFormat       :    "%d-%m-%Y",       // format of the input field
					showsTime      :    false,            // will display a time selector
					button         :    "f_trigger_a",   // trigger for the calendar (button ID)
					singleClick    :    true,           // double-click mode
					step           :    1                // show all years in drop-down boxes (instead of every other year as default)
				});
			</script> 
			s/d
			<input type="text" name="date2" id="f_date_b" class="inputpesan" value="<? echo $date2;?>" Readonly/><button type="reset" id="f_trigger_b">...</button>
			<script type="text/javascript">
					    Calendar.setup({
					        inputField     :    "f_date_b",      // id of the input field
					        ifFormat       :    "%d-%m-%Y",       // format of the input field
					        showsTime      :    false,            // will display a time selector
					        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
					        singleClick    :    true,           // double-click mode
					        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
					    });
			</script>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td >
			<input type="submit" name="cSubmit" value="Cari" class="tombol">
		</td>
	</tr>
	</table>
	</form>
	<? 
	if(strlen($katakunci) > 0) echo "Hasil pencarian dengan kata kunci \"<b>".$katakunci."\"</b><br />Ada <b>".$RecordCount."</b> data yang ditampilkan dalam <b>".$MaxPage."</b> halaman.";
	?>								
	<?echo $bar; ?>

				<br /><br />
				
				
				<table border="0" cellspacing="1" cellpadding="3" width="100%" bgcolor="#BBBABA">
	<tr bgcolor="#BBBABA">
				   <td valign=top align=center width="5%"><b>No</b></td>
				   <td valign=top align=center width="15%"><b>Nama Banner</b></td>
				   <td valign=top align=center width="15%"><b>Letak Banner</b></td>
				   <td valign=top align=center width="25%"><b>Tgl Show</b></td>
				   
				   <td valign=top align=center width="10%"><b>Ip</b></td>
				   <td valign=top align=center width="10%"><b>Nama Radio</b></td>
				</tr>
				<?
				$result = mysql_query($sqlview);
				$k=0;
				$z=0;
				while($rs = mysql_fetch_array($result)) {
				$k=$k+1;
				$z=$k+(($PageNo - 1)*$PageSize);
				$kID = $rs[banner_id];
				$kTgl = $rs[tgl];
				
				$kIp = $rs[ip];
				$kNama = $rs[nama_banner];
				$bLetak=$rs[letak_banner];
				$bRadio=$rs[id_radio];
				
				$arrLetak = array(
						'1' => 'Atas',
						'2' => 'Bawah',
						'3' => 'Kanan',
						'4' => 'Kiri',
						'5' => 'Splash',
						'6' => 'Running Teks',
						'7' => 'Audio',
				);
				
					if($bLetak == '7') {
						
						$cmdNmRadio = "SELECT * FROM radio WHERE radio_id = '".$bRadio."' ";
						
						
						
						$resNmRadio = mysql_query($cmdNmRadio);
						
						$brsNmRadio = mysql_fetch_array($resNmRadio);
						
						$nmRadio = $brsNmRadio['nama'];
						
					}else {
						$nmRadio = "";
					}
				
				
				?>
				<tr bgcolor="#FFFFFF" onMouseOver="this.style.background='#ebebeb'" onMouseOut="this.style.background='#FFFFFF'">
					<td valign=middle align=center><?echo $z;?>.</td>
					<td valign=middle ><?echo $kNama;?></td>
					<td valign=middle><? echo $arrLetak[$bLetak];?></td>
					<td valign=middle ><?echo tglIndo($kTgl,'l');?></td>
					
					<td valign=top align=left ><?echo $kIp;?></td>
					<td valign=top align=left ><?echo $nmRadio;?></td>
				</tr>
				<?
				}
				?>
				</table>
				</td></table>
				<!--sisi kanan selesai-->






<?
include("../inc/footerAdmin.php");
?>