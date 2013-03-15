<?php

ob_start();
session_start();
$judulHalaman="DAFTAR KOTA";
$fileIndex="";
$fileSearch="";

$act = $_GET['act'];
$status = $_GET['status'];
$id = $_GET['id'];
$katakunci = $_GET['katakunci'];
$PageNo = $_GET['PageNo'];
$cHidden = $_GET['cHidden'];
$Submit = $_GET['Submit'];

include("../inc/headerLog.php");


$cmd2 = "SELECT nama,mount FROM radio  ";
					
$res2 = mysql_query($cmd2);

while($brs2 = mysql_fetch_array($res2)) {
	$arr['/'.$brs2['mount']] =  $brs2['nama'];
	
		
	$r++;
}



if($cHidden=="1"){
	$katakunci=trim($katakunci);

	$arrKataKunci= explode(" ",$katakunci);

	//echo count($arrKataKunci)."<br />";
	
	
	if(!empty($_GET['slRadio'])) {
		
		$detQuery .= $detQuery . " AND mount = '/".$_GET['slRadio']."' ";
		
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
	
	if($_GET['jenis']=='jaman')	{
		
		
		
	}
	
	$tmp = "date1=".$_GET['date1']."&date2=".$_GET['date2']."&slRadio=".$_GET['slRadio']."&cHidden=1";
	
	/*$sqlview = "SELECT nama,id_radio,id_statitik,tgl,ip FROM ".tabel_radio." a,".tabel_stat." b 
				WHERE	a.radio_id = b.id_radio 	
						". $detQuery ."  ORDER BY tgl DESC ";*/
	$sqlview = "SELECT * FROM tb_durasi
				WHERE	mount != ''  
						". $detQuery ."  ORDER BY tgl DESC ";					
				
	//echo $sqlview;
	
}else{
		
	$tgl_default1 = '01-'.date("m-Y");
	$tgl_default2 = date("t").'-'.date("m-Y");
	
	$date1 = $tgl_default1;
	$date2 = $tgl_default2;
	
	$detQuery = " AND (tgl BETWEEN '".cTgl($tgl_default1,'')." 00:00:00' AND '".cTgl($tgl_default2,'')." 23:59:59' )";
	
		$sqlview = "SELECT * FROM tb_durasi WHERE mount != '' 
					 ".$detQuery."
						  ORDER BY tgl DESC ";		
		
	//echo $sqlview;
				
}

//echo $sqlview;

//utk membuat otomatis bar halaman sesuai setting banner
$link=$PHP_SELF."?".$tmp;
$PageSize = 20;
include "../inc/barHalaman_durasi.php";



?>
<link rel="stylesheet" type="text/css" media="all" href="../calendar_files/calendar-blue2.css" title="calendar-blue2" />

 <!-- main calendar program -->
  <script type="text/javascript" src="../calendar_files/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="../calendar_files/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="../calendar_files/calendar-setup.js"></script>

				&nbsp;&nbsp;<span class="judul_menu">Daftar Statistik ::</span>
	<br />
	<br />
	<form action="<?=$PHP_SELF;?>" method="get">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr><td>Cari</td><td>:</td>
		<td><input type="text" name="katakunci" value="<?=$katakunci?>" class="inputPesan" style="display:none;"> 
			<input type="hidden" name="cHidden" value="1"> 
			<select name="slRadio" class="inputPesan"> 
			
				<option value="">Pilih Radio</option>
				<?php
					$cmd23 = "SELECT mount,nama FROM radio ORDER BY radio_id ";
					
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
				   <td valign=top align=center width="15%"><b>Nama Radio</b></td>
				   <td valign=top align=center width="25%"><b>Tgl</b></td>
				   <td valign=top align=center width="35%"><b>Durasi (detik)</b></td>
				   
				</tr>
				<?
				$result = mysql_query($sqlview);
				$k=0;
				$z=0;
				while($rs = mysql_fetch_array($result)) {
				$k=$k+1;
				$z=$k+(($PageNo - 1)*$PageSize);
				$kID = $rs[radio_id];
				$kTgl = $rs[tgl];
				$durasi = $rs[duration];
				$kIp = $rs[ip];
				//$kNama = $rs[nama];
				$hsl = str_replace('stereo','',$rs['mount']);
					
				
				?>
				<tr bgcolor="#FFFFFF" onMouseOver="this.style.background='#ebebeb'" onMouseOut="this.style.background='#FFFFFF'">
					<td valign=middle align=center><?echo $z;?>.</td>
					<td valign=middle ><?echo $arr[$hsl];?></td>
					<td valign=middle ><?echo tglIndo($kTgl,'l');?></td>
					<td valign=middle align="center"><?echo formatAngka($durasi);?></td>
					
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