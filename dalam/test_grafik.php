<?php
ob_start();
session_start();
$judulHalaman="DAFTAR KOTA";
$fileIndex="";
$fileSearch="";

include("FusionCharts/FusionCharts_Gen.php");
  
include("../inc/headerAdmin.php");
?>
<SCRIPT LANGUAGE="Javascript" SRC="FusionCharts/Js/FusionCharts.js"></SCRIPT> 


&nbsp;&nbsp;<span class="judul_menu">Graph Statistik ::</span>
<br />
<br />
<form action="<?=$PHP_SELF;?>" method="get">


<form action="" method="get" >
<table cellpadding="2" cellspacing="0" border="0" id="frm">
<tr><td>Radio</td><td>:</td><td>
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
	</td></tr>

<tr><td>Bulan</td><td>:</td>

		<td>
		<input type="radio" name="waktu" value="bulan"  <?php if($_GET['waktu'] == 'bulan') { echo "checked"; } elseif($_GET['waktu'] == 'tahun') { echo""; }else { echo "checked"; } ?>>
		<select name="bulan" class="inputPesan">	
						<option value="1" <?php if($_GET['waktu'] == 'bulan') { if(!empty($_GET['bulan'])) {  if($_GET['bulan'] == '1') { echo "selected"; }  }else {echo "selected"; } } else { if(date("n") == 1) { echo "selected";} } ?>>Januari</option>
						<option value="2" <?php if($_GET['waktu'] == 'bulan') { if(!empty($_GET['bulan'])) {  if($_GET['bulan'] == '2') { echo "selected"; }  }else {echo "selected"; } } else { if(date("n") == 2) { echo "selected";} } ?>>Februari</option>
						<option value="3" <?php if($_GET['waktu'] == 'bulan') { if(!empty($_GET['bulan'])) {  if($_GET['bulan'] == '3') { echo "selected"; }  }else {echo "selected"; } } else { if(date("n") == 3) { echo "selected";} } ?>>Maret</option>
						<option value="4" <?php if($_GET['waktu'] == 'bulan') { if(!empty($_GET['bulan'])) {  if($_GET['bulan'] == '4') { echo "selected"; }  }else {echo "selected"; } } else { if(date("n") == 4) { echo "selected";} } ?>>April</option>
						<option value="5" <?php if($_GET['waktu'] == 'bulan') { if(!empty($_GET['bulan'])) {  if($_GET['bulan'] == '5') { echo "selected"; }  }else {echo "selected"; } } else { if(date("n") == 5) { echo "selected";} } ?>>Mei</option>
						<option value="6" <?php if($_GET['waktu'] == 'bulan') { if(!empty($_GET['bulan'])) {  if($_GET['bulan'] == '6') { echo "selected"; }  }else {echo "selected"; } } else { if(date("n") == 6) { echo "selected";} } ?>>Juni</option>
						<option value="7" <?php if($_GET['waktu'] == 'bulan') { if(!empty($_GET['bulan'])) {  if($_GET['bulan'] == '7') { echo "selected"; }  }else {echo "selected"; } } else { if(date("n") == 7) { echo "selected";} } ?>>Juli</option>
						<option value="8" <?php if($_GET['waktu'] == 'bulan') { if(!empty($_GET['bulan'])) {  if($_GET['bulan'] == '8') { echo "selected"; }  }else {echo "selected"; } } else { if(date("n") == 8) { echo "selected";} } ?>>Agustus</option>
						<option value="9" <?php if($_GET['waktu'] == 'bulan') { if(!empty($_GET['bulan'])) {  if($_GET['bulan'] == '9') { echo "selected"; }  }else {echo "selected"; } } else { if(date("n") == 9) { echo "selected";} } ?>>September</option>
						<option value="10" <?php if($_GET['waktu'] == 'bulan') { if(!empty($_GET['bulan'])) {  if($_GET['bulan'] == '10') { echo "selected"; }  }else {echo "selected"; } } else { if(date("n") == 10) { echo "selected";} }?>>Oktober</option>
						<option value="11" <?php if($_GET['waktu'] == 'bulan') { if(!empty($_GET['bulan'])) {  if($_GET['bulan'] == '11') { echo "selected"; }  }else {echo "selected"; } } else { if(date("n") == 11) { echo "selected";} }?>>November</option>
						<option value="12" <?php if($_GET['waktu'] == 'bulan') { if(!empty($_GET['bulan'])) {  if($_GET['bulan'] == '12') { echo "selected"; }  }else {echo "selected"; } } else { if(date("n") == 12) { echo "selected";} }?>>Desember</option>
					</select>			
		<select name="tahun" class="inputPesan">
				<option value="">Pilih tahun</option>
				<?php
				
					$thn_skrg = date('Y');
		
					//echo 'haha';
					$arr = array();
					
					
					
					for($i=2009;$i<=$thn_skrg;$i++) {
						
						if($_GET['waktu'] == 'bulan') {
					
							if(!empty($_GET['tahun'])) {  
								if($_GET['tahun'] == $thn_skrg) { 
									$tmp = "selected"; 
								} else {
									$tmp = "";
								}		
									
							}else {
								$tmp = "";
							}
						}else {
							
							if($i == date("Y")) {
								$tmp = "selected"; 
							}else {
								$tmp = "";
							}
							
						}
						
						
						echo '<option value="'.$i.'" '.$tmp.'>'.$i.'</option>';
					}
						
				
				?>
				
			</select>		
		</td>
</tr>
<tr><td>Tahun</td><td>:</td>
		<td>
		<input type="radio" name="waktu" value="tahun" <?php if($_GET['waktu'] == 'tahun') { echo "checked"; } ?> >
		<select name="tahun2" class="inputPesan">
				<option value="">Pilih tahun</option>
				<?php
				
					$thn_skrg = date('Y');
		
					//echo 'haha';
					$arr = array();
					
					
					
					for($i=2009;$i<=$thn_skrg;$i++) {
					
						if($_GET['waktu'] == 'tahun') {
					
							if(!empty($_GET['tahun2'])) {  
								if($_GET['tahun2'] == $thn_skrg) { 
									$tmp2 = "selected"; 
								} else {
									$tmp2 = "";
								}		
									
							}else {
								$tmp2 = "";
							}
						}else {
							
							if($i == date("Y")) {
								$tmp2 = "selected"; 
							}else {
								$tmp2 = "";
							}
							
						}
					
						
						echo '<option value="'.$i.'" '.$tmp2.'>'.$i.'</option>';
					}
						
				
				?>
				
			</select>	
		</td>
</tr>
</table>
<input type="hidden" name="cHidden" value="1"> 
<input type="submit" name="cSubmit" value="Cari" class="tombol">
</form>
<div id="flash">
<?php

$p = 0;
	$g = 0;
	
	$tot = 0;

	$FC = new FusionCharts("Column3D","800","450");
	
	$FC->setSwfPath("FusionCharts/Charts/");

	$arrBulan = array(
				'1' => 'Januari',
				'2' => 'Febuari',
				'3' => 'Maret',
				'4' => 'April',
				'5' => 'Mei',
				'6' => 'Juni',
				'7' => 'Juli',
				'8' => 'Agustus',
				'9' => 'September',
				'10' => 'Oktober',
				'11' => 'November',
				'12' => 'Desember',
				
				);
				
	$arrBulan2 = array(
				'01' => 'Januari',
				'02' => 'Febuari',
				'03' => 'Maret',
				'04' => 'April',
				'05' => 'Mei',
				'06' => 'Juni',
				'07' => 'Juli',
				'08' => 'Agustus',
				'09' => 'September',
				'10' => 'Oktober',
				'11' => 'November',
				'12' => 'Desember',
				
				);

		 
if($_GET) {

	
				
	if(!empty($_GET['slRadio'])) {
	
		$cmd2 = "SELECT nama FROM radio WHERE radio_id = '".$_GET['slRadio']."' ";
	
		$hsl2 = mysql_query($cmd2);
		
		$brs2 = mysql_fetch_array($hsl2);
		
		$tmp30 = " AND		id_radio = '".$_GET['slRadio']."' ";
	
	}else {
	
		$tmp30 = '';
	
	}
	
	
	if($_GET['waktu'] == 'bulan') {
	
		for($k=1;$k<=date("t",mktime(0, 0, 0, $_GET['bulan'], 1,$_GET['tahun'] ));$k++) {
		
			$strKode = '00';
		
					
			$nilai = strlen($k);
		
			$tgl = substr_replace($strKode,$k,-$nilai,$nilai);
			
			$nilai2 = strlen($_GET['bulan']);
		
			$bln = substr_replace($strKode,$_GET['bulan'],-$nilai2,$nilai2);
			
	
			$cmd = "SELECT count(id_radio) As jml FROM statistik 
						WHERE	tgl LIKE '".$_GET['tahun']."-".$bln."-".$tgl."%' ".$tmp30;
						
			//echo $cmd;
			
			$hsl = mysql_query($cmd);
			
			$brs = mysql_fetch_array($hsl);
			
			//echo $brs['jml'];
			
			$strParam="caption=Jumlah Klik Radio ".$brs2['nama']." Bulan ".$arrBulan[$_GET['bulan']]." Tahun ".$_GET['tahun'].";xAxisName=Bulan ".$arrBulan[$_GET['bulan']].";yAxisName=Klik;decimals=0;rotateLabels=1;decimalPrecision=0;formatNumberScale=0;bgColor=EBEBEB;";
			
			$strTmp1000 = "test_grafik.php?waktu=jaman&date1=".$_GET['tahun']."-".$bln."-".$tgl."&date2=".$_GET['tahun']."-".$bln."-".$tgl."&slRadio=".$_GET['slRadio']."&bulan=".$_GET['bulan']."&tahun=".$_GET['tahun']."&cHidden=1";
			
			$strTmp1005 = "listStat3.php?date1=01-".$bln."-".$_GET['tahun']."&date2=".$tgl."-".$bln."-".$_GET['tahun']."&slRadio=".$_GET['slRadio']."&cHidden=1";
			
			
			$lbl = "name=".$k.";link=".$strTmp1000;
			
			$FC->setChartParams($strParam);
			
			$FC->addChartData($brs['jml'],$lbl);
			
			$tot = $tot + $brs['jml'];
			
		}

	}else if($_GET['waktu'] == 'jaman') {
	
		for($k=0;$k<24;$k++) {
			
			$strKode = '00';
							
			$nilai = strlen($k);
		
			$n_jam = substr_replace($strKode,$k,-$nilai,$nilai);
			
			$cmd = "SELECT count(id_radio) As jml FROM statistik 
					WHERE	tgl LIKE '".$_GET['date1']." ".$n_jam."%' ".$tmp30;
			
			//echo 	$cmd;
			
			$hsl = mysql_query($cmd);
			
			$brs = mysql_fetch_array($hsl);
			
			$arrTgl = explode("-",$_GET['date1']);
			
			if(empty($brs['jml'])) {
				$brs['jml'] = 0;
			}
			
			//echo $brs['jml']."--";
			
			
			$strParam="caption=Jumlah Klik Radio ".$brs2['nama']." Tanggal ".$arrTgl[2]." Bulan ".$arrBulan2[$arrTgl[1]]." Tahun ".$arrTgl[0].";xAxisName=24 Jam;yAxisName=Klik;decimals=0;rotateLabels=1;decimalPrecision=0;formatNumberScale=0;bgColor=EBEBEB;";		
				
			$strTmp1005 = "listStat3.php?katakunci=&cHidden=1&slRadio=".$_GET['slRadio']."&date1=".$arrTgl[2]."-".$arrTgl[1]."-".$arrTgl[0]."&date2=".$arrTgl[2]."-".$arrTgl[1]."-".$arrTgl[0]."&cSubmit=Cari";
				
		
			$lbl = "name=".$n_jam.";link=".$strTmp1000;
			
						
			//$jam = number_format($brs['jml'],0);
			
			$FC->setChartParams($strParam);
			
			$FC->addChartData($brs['jml'],$lbl);
			
			$tot = $tot + $brs['jml'];
		
		}
		
		$grand = ($tot / 3600 );
		
		$grand = number_format($grand,2);
		
		$strTmp1005 .= "&tdur=".$grand."";	
	
	
	}else {
	
	
			
	
		for($k=1;$k<13;$k++) {
	
			$strKode = '00';
		
					
			$nilai = strlen($k);
		
			$bln = substr_replace($strKode,$k,-$nilai,$nilai);
	
	
			$cmd = "SELECT count(id_radio) As jml FROM statistik 
					WHERE	tgl BETWEEN '".$_GET['tahun2']."-".$bln."-01%' AND '".$_GET['tahun2']."-".$bln."-31%' ".$tmp30;
			
			//echo $cmd;
			
			$hsl = mysql_query($cmd);
		
			$brs = mysql_fetch_array($hsl);
			
			
			
			$strTmp1000 = "test_grafik.php?slRadio=".$_GET['slRadio']."&waktu=bulan&bulan=".$k."&tahun=".$_GET['tahun2']."&tahun2=".$_GET['tahun2']."&cHidden=1&cSubmit=Cari";
			
			//$strTmp1000 = "test_grafik.php?date1=01-".$bln."-".$_GET['tahun2']."&date2=".date("t",mktime(0, 0, 0, $bln, 1,$_GET['tahun2'] ))."-".$bln."-".$_GET['tahun2']."&slRadio=".$_GET['slRadio']."&cHidden=1";
			
			$strTmp1005 = "listStat3.php?date1=01-01-".$_GET['tahun2']."&date2=".date("t",mktime(0, 0, 0, $bln, 1,$_GET['tahun2'] ))."-".$bln."-".$_GET['tahun2']."&slRadio=".$_GET['slRadio']."&cHidden=1";
			
			$lbl = "name=".$arrBulan[$k].";link=".$strTmp1000;
		
		
			
			$strParam="caption=Jumlah Klik Radio ".$brs2['nama']." Tahun ".$_GET['tahun2'].";xAxisName=Bulan;yAxisName=Klik;decimalPrecision=0;formatNumberScale=0;bgColor=EBEBEB;";
			
			

			$FC->setChartParams($strParam);
		
			$FC->addChartData($brs['jml'],$lbl);
			
			
			 
			$p++; 
			
			$tot = $tot + $brs['jml'];
		
		}
	
	}

	
	
	if($tot > 0) {
	
		echo "<a href='".$strTmp1005."' class='linkstat'>klik disini untuk lihat Log Radio</a>";
	
		$FC->renderChart();
	
	}else {
		
		echo "Data Belum Ada";
		
	}

	
}else {

	for($k=1;$k<=date("t",mktime(0, 0, 0, date("n"), 1,date("Y") ));$k++) {
		
		$strKode = '00';
		
					
		$nilai = strlen($k);
		
		$tgl = substr_replace($strKode,$k,-$nilai,$nilai);
		
		$cmd = "SELECT count(id_radio) As jml FROM statistik 
					WHERE	tgl LIKE '".date("Y-m") ."-".$tgl."%' ";
					
		
		$hsl = mysql_query($cmd);
		
		$brs = mysql_fetch_array($hsl);
		
		//echo $brs['jml'];
		
		$strParam="caption=Jumlah Klik Radio Bulan ".$arrBulan[date('n')]." Tahun ".date("Y").";xAxisName=Bulan ".$arrBulan[date('n')].";yAxisName=Klik;decimals=0;rotateLabels=1;decimalPrecision=0;formatNumberScale=0;bgColor=EBEBEB;";
		
		$strTmp1000 = "test_grafik.php?waktu=jaman&date1=".date("Y")."-".date("m")."-".$tgl."&date2=".date("Y")."-".date("m")."-".$tgl."&slRadio=".$_GET['slRadio']."&cHidden=1";
		
		$strTmp1005 = "listStat3.php?date1=01-".date("m")."-".date("Y")."&date2=".$tgl."-".date("m")."-".date("Y")."&slRadio=".$_GET['slRadio']."&cHidden=1";
		
		$lbl = "name=".$k.";link=".$strTmp1000;
		
		$FC->setChartParams($strParam);
		
		$FC->addChartData($brs['jml'],$lbl);
		
		$tot = $tot + $brs['jml'];
		
	}

	if($tot > 0) {
	
		echo "<a href='".$strTmp1005."' class='linkstat'>klik disini untuk lihat Log Radio</a>";
	
		$FC->renderChart();
	
	}else {
		
		echo "Data Belum Ada";
		
	}
	

}
?>
</div>
<?php 
include("../inc/footerAdmin.php");
?>