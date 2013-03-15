<?php
ob_start();
session_start();
$judulHalaman="DAFTAR KOTA";
$fileIndex="";
$fileSearch="";

include("FusionCharts/FusionCharts_Gen.php");
  
include("../inc/headerAdmin.php");
?>



&nbsp;&nbsp;<span class="judul_menu">Graph Statistik ::</span>
<br />
<br />
<form action="<?=$PHP_SELF;?>" method="get">


<form action="" method="get">
<table cellpadding="2" cellspacing="0" border="0">
<tr><td>Tipe Konsumen</td><td>:</td><td>
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
		<input type="radio" name="waktu" value="bulan" checked>
		<select name="bulan" class="inputPesan">	
						<option value="1" selected>Januari</option>
						<option value="2" >Februari</option>
						<option value="3" >Maret</option>
						<option value="4" >April</option>

						<option value="5" >Mei</option>
						<option value="6" >Juni</option>
						<option value="7" >Juli</option>
						<option value="8" >Agustus</option>
						<option value="9" >September</option>
						<option value="10" >Oktober</option>

						<option value="11" >November</option>
						<option value="12" >Desember</option>
					</select>			
		<select name="tahun" class="inputPesan">
				<option value="">Pilih tahun</option>
				<?php
				
					$thn_skrg = date('Y');
		
					//echo 'haha';
					$arr = array();
					
					for($i=2009;$i<=$thn_skrg;$i++) {
						
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
						
				
				?>
				
			</select>		
		</td>
</tr>
<tr><td>Tahun</td><td>:</td>
		<td>
		<input type="radio" name="waktu" value="tahun" >
		<select name="tahun2" class="inputPesan">
				<option value="">Pilih tahun</option>
				<?php
				
					$thn_skrg = date('Y');
		
					//echo 'haha';
					$arr = array();
					
					for($i=2009;$i<=$thn_skrg;$i++) {
						
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
						
				
				?>
				
			</select>	
		</td>
</tr>
</table>
<input type="hidden" name="cHidden" value="1"> 
<input type="submit" name="cSubmit" value="Cari" class="tombol">
</form>
<?php
		 
		 
if($_GET) {

	$p = 0;
	$g = 0;

	$dataXa = '';
	$dataYa = '';

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
				
	if(!empty($_GET['slRadio'])) {
	
		$cmd2 = "SELECT nama FROM radio WHERE radio_id = '".$_GET['slRadio']."' ";
	
		$hsl2 = mysql_query($cmd2);
		
		$brs2 = mysql_fetch_array($hsl2);
	
	}
	
	
	if($_GET['waktu'] == 'bulan') {
	
		$title = "bulan";
	
		for($k=1;$k<32;$k++) {
		
			$strKode = '00';
		
					
			$nilai = strlen($k);
		
			$tgl = substr_replace($strKode,$k,-$nilai,$nilai);
			
			$nilai2 = strlen($_GET['bulan']);
		
			$bln = substr_replace($strKode,$_GET['bulan'],-$nilai2,$nilai2);
			
	
			$cmd = "SELECT count(id_radio) As jml FROM statistik 
						WHERE	tgl LIKE '".$_GET['tahun']."-".$bln."-".$tgl."%' 
						AND		id_radio = '".$_GET['slRadio']."' ";
						
		
			$hsl = mysql_query($cmd);
			
			$brs = mysql_fetch_array($hsl);
			
			$tgl_utuh = $_GET['tahun']."-".$bln."-".$tgl;
			
			if($dataXa == '' ) {
			
				$dataXa .= $tgl_utuh;
				//$dataY .= $brs['jml'];
			
			}else {
			
				$dataXa .= ','.$tgl_utuh;
				//$dataY .= $brs['jml'];
			}
			
			if($dataYa == '' ) {
			
				$dataYa .= $brs['jml'];
				
			
			}else {
			
				$dataYa .= ','.$brs['jml'];
				
			}
					
			
			
		}

	
	}else {
	
	
		$title = "tahun";
	
		for($k=1;$k<13;$k++) {
	
			$strKode = '00';
		
					
			$nilai = strlen($k);
		
			$bln = substr_replace($strKode,$k,-$nilai,$nilai);
	
	
			$cmd = "SELECT count(id_radio) As jml FROM statistik 
					WHERE	tgl BETWEEN '".$_GET['tahun2']."-".$bln."-01%' AND '".$_GET['tahun2']."-".$bln."-31%'
					AND		id_radio = '".$_GET['slRadio']."'		";
			
			//echo $cmd;
			
			$hsl = mysql_query($cmd);
		
			$brs = mysql_fetch_array($hsl);
			
		
			 
			$p++; 
		
		}
	
	}


	echo $dataXa."<br>";
	echo $dataYa."<br>";

	echo '<img src="grafik_bar.php?subTitle='.$title.'&dataX='.$dataXa.'&dataY='.$dataYa.'" alt="" />';
	
	
}

  
include("../inc/footerAdmin.php");
?>