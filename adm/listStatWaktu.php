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


&nbsp;&nbsp;<span class="judul_menu">Graph Statistik Durasi ::</span>
<br />
<br />
<form action="<?=$PHP_SELF;?>" method="get">


<form action="" method="get" >
<table cellpadding="2" cellspacing="0" border="0" id="frm">
<tr><td>Radio</td><td>:</td><td>
				<select name="slRadio" class="inputPesan"> 
			
				<option value="">Pilih Radio</option>
				<?php
					$cmd23 = "SELECT radio_id,nama,mount FROM radio ORDER BY radio_id ";
					
					$res23 = mysql_query($cmd23) or die();
					
					while($brs = mysql_fetch_array($res23)) {
						
						if($_GET['slRadio'] == $brs['mount']) {
							
							$tmp3 = " selected ";
							
						}else {
							$tmp3 = "";
						}	
												
						echo "<option value='".$brs['mount']."' ".$tmp3.">".$brs['nama']."</option>";
						
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
									if(!empty($_GET['tahun'])) {  									
										if($i == $_GET['tahun']){											
											$tmp = "selected";
										}else{
											$tmp = "";
										}	
									}else{
										$tmp = "";
									}	
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
	
		$cmd2 = "SELECT nama FROM radio WHERE mount = '".$_GET['slRadio']."' ";
	
		$hsl2 = mysql_query($cmd2);
		
		$brs2 = mysql_fetch_array($hsl2);
		
		$tmp30 = " AND		mount LIKE '/".$_GET['slRadio']."%' ";
	
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
			
			$cmdTab = "show tables like 'stat_durasi_".$_GET['tahun']."_".$_GET['bulan']."'";
			//echo $cmdTab;			
			$result = mysql_query($cmdTab) or die ('error reading database');
			
			if (mysql_num_rows ($result)>0){
	
				$cmd = "SELECT SUM(duration) As jml FROM stat_durasi_".$_GET['tahun']."_".$_GET['bulan']." 
							WHERE	tgl LIKE '".$_GET['tahun']."-".$bln."-".$tgl."%' ".$tmp30;
							
				//echo $cmd;
				
				$hsl = mysql_query($cmd);
				
				$brs = mysql_fetch_array($hsl);
				
				//echo $brs['jml'];
				
				$strParam="caption=Jumlah Durasi Radio ".$brs2['nama']." Bulan ".$arrBulan[$_GET['bulan']]." Tahun ".$_GET['tahun'].";xAxisName=Bulan ".$arrBulan[$_GET['bulan']].";yAxisName=Jumlah Jam;decimals=0;rotateLabels=1;decimalPrecision=0;formatNumberScale=0;bgColor=EBEBEB;";
				
				$strTmp1000 = "listStatWaktu.php?date1=".$_GET['tahun']."-".$bln."-".$tgl."&altahun=".$_GET['tahun']."&albulan=".$_GET['bulan']."&waktu=jaman&slRadio=".$_GET['slRadio']."&cHidden=1";
				
				$strTmp1005 = "listLogDurasi.php?katakunci=&cHidden=1&slRadio=".$_GET['slRadio']."&date1=01-".$bln."-".$_GET['tahun']."&date2=".$k."-".$bln."-".$_GET['tahun']."&cSubmit=Cari";
				
				$lbl = "name=".$k.";link=".$strTmp1000;
				
				$nilai_jam = ($brs['jml'] / 3600);
				
				$jam = number_format($nilai_jam,2);
				
				$FC->setChartParams($strParam);
				
				$FC->addChartData($nilai_jam,$lbl);
				
				$tot = $tot + $brs['jml'];
			}	
			
		}
		
			$grand = ($tot / 3600 );
		
			$grand = number_format($grand,2);
			
			$strTmp1005 .= "&tdur=".$grand."";
		
	
	}else if($_GET['waktu'] == 'jaman') {
	
		
		$arr_jam["0"]=0;
		$arr_jam["1"]=0;
		$arr_jam["2"]=0;
		$arr_jam["3"]=0;
		$arr_jam["4"]=0;
		$arr_jam["5"]=0;
		$arr_jam["6"]=0;
		$arr_jam["7"]=0;
		$arr_jam["8"]=0;
		$arr_jam["9"]=0;
		$arr_jam["10"]=0;
		$arr_jam["11"]=0;
		$arr_jam["12"]=0;
		$arr_jam["13"]=0;
		$arr_jam["14"]=0;
		$arr_jam["15"]=0;
		$arr_jam["16"]=0;
		$arr_jam["17"]=0;
		$arr_jam["18"]=0;
		$arr_jam["19"]=0;
		$arr_jam["20"]=0;
		$arr_jam["21"]=0;
		$arr_jam["22"]=0;
		$arr_jam["23"]=0;
		
		$arrTgl = explode("-",$_GET['date1']);

		$cmdTab = "show tables like 'stat_durasi_".$_GET['altahun']."_".$_GET['albulan']."'";
		//echo $cmdTab;			
		$result = mysql_query($cmdTab) or die ('error reading database');
		
		if (mysql_num_rows ($result)>0){
		
			$cmd = 'SELECT tgl,duration FROM stat_durasi_'.$_GET['altahun'].'_'.$_GET['albulan'].' WHERE  tgl LIKE "'.$_GET['date1'].'%" '.$tmp30;
			
			//echo $cmd; 

			$res = mysql_query($cmd);
			
			$tot = mysql_num_rows($res);
			
			while($brs = mysql_fetch_array($res)){		
				$detik = $brs[duration];
				
				//echo $detik;
				
				$tglAwal = $brs[tgl];

				$tglAkhir = strtotime($tglAwal) + $detik;

				//echo $tglAwal."==".date("Y-m-d H:i:s", $tglAkhir);

				$jamAwal = intval(date("H", strtotime($tglAwal)));
				$jamAkhir = intval(date("H", $tglAkhir));
				for($x=$jamAwal; $x <= $jamAkhir; $x++)	{
									
					$arr_jam[$x]=$arr_jam[$x]+1;
				} 
			}	
			
			
			
			$strParam="caption=Durasi Dalam 1 hari;subcaption=Tanggal ".$arrTgl[2]." Bulan ".$arrBulan2[$arrTgl[1]]." Tahun ".$arrTgl[0].";xAxisName=Jam;yAxisName=Jumlah User;numberPrefix=;decimalPrecision=0;formatNumberScale=0;bgColor=EBEBEB;";

			$FC->setChartParams($strParam);
			
			

			foreach($arr_jam as $k => $v) {
			
				$strKode = '00';
								
				$nilai = strlen($k);
			
				$n_jam = substr_replace($strKode,$k,-$nilai,$nilai);
			
					//echo $v.'<br>';
				
				$lbl = "name=".$n_jam.";link=".$strTmp1000;
				 
				$FC->addChartData($v,$lbl);
			}
		
		}
	
	}else {
	
	
			
	
		for($k=1;$k<13;$k++) {
	
			$strKode = '00';
		
					
			$nilai = strlen($k);
		
			$bln = substr_replace($strKode,$k,-$nilai,$nilai);
	
	
			/*$cmd = "SELECT SUM(duration) As jml FROM tb_durasi 
					WHERE	tgl BETWEEN '".$_GET['tahun2']."-".$bln."-01%' AND '".$_GET['tahun2']."-".$bln."-31%' ".$tmp30;*/
			
			//echo $cmd;
			
			$cmd = "SELECT jumlah As jml FROM cni_summary_durasi WHERE bulan = '".$k."' AND tahun = '".$_GET['tahun2']."' ".$tmp30;	
			
			$hsl = mysql_query($cmd);
		
			$brs = mysql_fetch_array($hsl);
			
			//$strTmp1000 = "listStat3.php?date1=01-".$bln."-".$_GET['tahun2']."&date2=".date("t",mktime(0, 0, 0, $bln, 1,$_GET['tahun2'] ))."-".$bln."-".$_GET['tahun2']."&slRadio=".$_GET['slRadio']."&cHidden=1";
			
			$lbl = "name=".$arrBulan[$k].";link=".$strTmp1000;
		
		
			
			$strParam="caption=Jumlah Durasi Radio ".$brs2['nama']." Tahun ".$_GET['tahun2'].";xAxisName=Bulan;yAxisName=Jumlah Jam;decimalPrecision=2;formatNumberScale=0;bgColor=EBEBEB;";
						
			$n = $k + 1;
			
			$strTmp1000 = "listStatWaktu.php?slRadio=".$_GET['slRadio']."&waktu=bulan&bulan=".$n."&tahun=".$_GET['tahun2']."&tahun2=".$_GET['tahun2']."&cHidden=1&cSubmit=Cari";
			
			
			
			$nilai_jam = ($brs['jml'] / 3600);
			
			$jam = number_format($nilai_jam,2);

			$FC->setChartParams($strParam);
		
			$FC->addChartData($nilai_jam,$lbl);
			
			
			 
			$p++; 
			
			$tot = $tot + $brs['jml'];
			
			
		
		}
		
		$grand = ($tot / 3600 );
		
		$grand = number_format($grand,2);
			
		$strTmp1005 = "listLogDurasi.php?katakunci=&cHidden=1&slRadio=".$_GET['slRadio']."&date1=01-01-".$_GET['tahun2']."&date2=31-12-".$_GET['tahun2']."&cSubmit=Cari&tdur=".$grand."";
	
	}

	
	
	if($tot > 0) {
	
		echo "<a href='".$strTmp1005."'>klik disini untuk lihat Log Durasi Radio</a>";
	
		$FC->renderChart();
	
	}else {
		
		echo "Data Belum Ada";
		
	}

	
}else {

	for($k=1;$k<=date("t",mktime(0, 0, 0, date("n"), 1,date("Y") ));$k++) {
		
		$strKode = '00';
		
					
		$nilai = strlen($k);
		
		$tgl = substr_replace($strKode,$k,-$nilai,$nilai);
		
		$cmdTab = "show tables like 'stat_durasi_".date("Y")."_".date("n")."'";
		//echo $cmdTab;		


	
		$result = mysql_query($cmdTab) or die ('error reading database');
		
		if (mysql_num_rows ($result)>0){
		
			/*$cmd = "SELECT SUM(duration) As jml FROM tb_durasi 
						WHERE	tgl LIKE '".date("Y-m") ."-".$tgl."%' ";
			//echo $cmd;	
			*/
			$cmd = "SELECT SUM(duration) As jml FROM  stat_durasi_".date("Y")."_".date("n")."
						WHERE	tgl LIKE '".date("Y-m") ."-".$tgl."%' ";
			//echo $cmd;
			
			$hsl = mysql_query($cmd);
			
			$brs = mysql_fetch_array($hsl);
			
			//echo $brs['jml'];
			
			$strParam="caption=Jumlah Durasi Radio Bulan ".$arrBulan[date('n')]." Tahun ".date("Y").";xAxisName=Bulan ".$arrBulan[date('n')].";yAxisName=Jumlah Jam;decimals=0;rotateLabels=1;decimalPrecision=0;formatNumberScale=0;bgColor=EBEBEB;";
			
			$strTmp1000 = "listStatWaktu.php?date1=".date("Y")."-".date("m")."-".$tgl."&waktu=jaman&slRadio=".$_GET['slRadio']."&cHidden=1";
			
			$strTmp1005 = "listLogDurasi.php?katakunci=&cHidden=1&slRadio=".$_GET['slRadio']."&date1=01-".date("m")."-".date("Y")."&date2=".$k."-".date("m")."-".date("Y")."&cSubmit=Cari";
			
			$lbl = "name=".$k.";link=".$strTmp1000;
			
			$nilai_jam = ($brs['jml'] / 3600);
				
			$jam = number_format($nilai_jam,2);
			
			$FC->setChartParams($strParam);
			
			$FC->addChartData($nilai_jam,$lbl);
			
			$tot = $tot + $brs['jml'];
		}
	}
	
	$grand = ($tot / 3600 );
		
	$grand = number_format($grand,2);
			
	$strTmp1005 .= "&tdur=".$grand."";
	

	if($tot > 0) {
	
		echo "<a href='".$strTmp1005."'>klik disini untuk lihat Log Durasi Radio</a>";
	
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