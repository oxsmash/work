<?php
ob_start();
session_start();
$judulHalaman="DAFTAR BANNER";
include("../inc/headerAdmin.php");
?>
<link rel="stylesheet" type="text/css" media="all" href="../calendar_files/calendar-blue2.css" title="calendar-blue2" />

 <!-- main calendar program -->
  <script type="text/javascript" src="../calendar_files/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="../calendar_files/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="../calendar_files/calendar-setup.js"></script>
  
<?
$strError="";

$aksi = $_POST['aksi'];

if($aksi=="1"){
	
	$letakBaner = $_POST['letakBaner'];
	$run = $_POST['runteks'];
	$limitBanner = $_POST['lmt'];
	
	$vPhoto = $_FILES['vPhoto']['tmp_name'];
	
	$tempNama = pathinfo($_FILES['vPhoto']['name']);
	
	$vPhoto_name = time().'.'.$tempNama['extension'];
	$tipe = $_FILES['vPhoto']['type'];
	
	//print_r($_FILES);
	
	//echo $run;

	if ($letakBaner=="1"){$letak="1";} else if ($letakBaner=="2"){$letak="2";} else if ($letakBaner=="3"){$letak="3";}
	if(is_uploaded_file($vPhoto)) {
		$size2 = GetImageSize($vPhoto);

		//echo $size2[0]."--".$size2[1];
		
		switch($letakBaner) {
			case 1 :
				if($size2[0] != lebar_banner4) $strError=$strError."<li>Lebar banner harus ".lebar_banner4." pixels!";
				if($size2[1] != tinggi_banner4) $strError=$strError."<li>Tinggi banner harus ".tinggi_banner4." pixels!";
			break;
			case 2 :
				if($size2[0] != lebar_banner5) $strError=$strError."<li>Lebar banner harus ".lebar_banner5." pixels!";
				if($size2[1] != tinggi_banner5) $strError=$strError."<li>Tinggi banner harus ".tinggi_banner5." pixels!";
			break;
			case 3 :
				if($size2[0] != lebar_banner6) $strError=$strError."<li>Lebar banner harus ".lebar_banner6." pixels!";
				//if($size2[1] != tinggi_banner6) $strError=$strError."<li>Tinggi banner harus ".tinggi_banner6." pixels!";
			break;
			case 4 :
				if($size2[0] != lebar_banner7) $strError=$strError."<li>Lebar banner harus ".lebar_banner7." pixels!";
				//if($size2[1] != tinggi_banner7) $strError=$strError."<li>Tinggi banner harus ".tinggi_banner7." pixels!";
			break;
			case 5 :
				if($size2[0] != lebar_banner8) $strError=$strError."<li>Lebar banner harus ".lebar_banner8." pixels!";
				//if($size2[1] != tinggi_banner8) $strError=$strError."<li>Tinggi banner harus ".tinggi_banner8." pixels!";
			break;
			
			case 0 :
				$strError=$strError."<li>Ukuran masih kosong!";
			break;
				}

		if ($_FILES['vPhoto']['size'] > max_photo) $strError=$strError."<li>Ukuran file maksimal ".round(max_photo / 1000,0)." KB";

		if (file_exists("../images/banner/".$vPhoto_name)) {
			$strError=$strError. "<li>Nama file sudah ada di server.";
		}
		//if ($vPhoto_type!="image/pjpeg") $strError=$strError. "<li>Tipe file photo harus JPG.";

		
	}else	{
		if($letakBaner != '6') {
			$strError=$strError. "<li>Silahkan mengisi file yg akan di upload.";
		}	
	}
	

	$cNama=stripslashes($_POST['cNama']);
	$cLink=stripslashes($_POST['cLink']);
	$date1 = $_POST['date1']; 
	$date2 = $_POST['date2']; 

	if(strlen($cNama) < 1) $strError=$strError."<li>Nama masih kosong.";
	if(strlen($cLink) < 1) $strError=$strError."<li>Link masih kosong.";

	if($date1=="") $strError=$strError."<li>Mulai banner masih kosong.";
	if($date2=="") $strError=$strError."<li>Akhir banner masih kosong.";

	$mulai=split("-",$date1);
	$akhir=split("-",$date2);
	
	//$tempTgl = $mulai[2]."-".$mulai[1]."-".$mulai[0];

	//echo $mulai[0];
	//$mulai=rubahKeUnix($mulai[2]."-".$mulai[1]."-".$mulai[0]);
	//$akhir=rubahKeUnix($akhir[2]."-".$akhir[1]."-".$akhir[0]);
	$mulai = $mulai[2]."-".$mulai[1]."-".$mulai[0];
	$akhir = $akhir[2]."-".$akhir[1]."-".$akhir[0];
	
	if($mulai>$akhir)
		{
		$strError.="<li>Tanggal mulai lebih besar dari tanggal sampai";
		}
		
	if(!is_numeric($limitBanner)) $strError=$strError."<li>Limit Banner bukan angka."; 

	if(strlen($strError) < 1){
	
		
	
		$cmd = "INSERT INTO ".tabel_banner."(ukuran_banner,letak_banner,file_banner,nama_banner,
		link_banner,mulai_banner,selesai_banner,tgl_banner,ip_banner,tipe,run_teks,limit_banner,jumlah_show,tgl_show)
		VALUES('".addslashes($tipeBanner)."',
		'".$letakBaner."',
		'".addslashes($vPhoto_name)."',
		'" . addslashes($cNama). "',
		'" . addslashes($cLink). "',
		'".$mulai."',
		'".$akhir."',
		'".time()."',
		'".getenv("REMOTE_ADDR")."',
		'".addslashes($tipe)."',
		'".addslashes($run)."',
		'".$limitBanner."',
		'0',
		'".$mulai."')";
				
	//echo $cmd;	

		mysql_query($cmd) or die(mysql_error());
		if(is_uploaded_file($vPhoto)){
				$res = move_uploaded_file($vPhoto, "../images/banner/" . $vPhoto_name);
		}
		
				
		Header("Location: listBanner.php");
	}
}
?>


				<!--sisi kanan mulai-->
				&nbsp;&nbsp;<span class="judul_menu">Tambah Banner ::</span>
				<br><br>
					<?php
					if (strlen($strError) > 0) {
						echo kotakError($strError);
					}
					?>
					<form method="post" action="<?=$_SERVER['PHP_SELF']?>" ENCTYPE="multipart/form-data">
					<table border=0>
					<tr>
					<td align=left valign=top>Ukuran Banner*</td><td align=left valign=top>:</td>
					<td align=left valign=top>
						<select name="letakBaner" onchange="do_submit()" id="letakBaner" class="inputPesan" style="width:150px;">
						   <option value="0">-- Select ukuran --</option>				
						   <option value='1' <?php if($letakBanner == '1' || $_POST['letakBaner'] == '1') { echo "selected"; } ?>>atas (<? echo lebar_banner4;?>x <? echo tinggi_banner4; ?> pixel)</option>			
						   <option value='3' <?php if($letakBanner == '3' || $_POST['letakBaner'] == '3') { echo "selected"; } ?>>Tengah(<? echo lebar_banner6;?>x <? echo tinggi_banner6; ?> pixel)</option>			
						   <option value='4' <?php if($letakBanner == '4' || $_POST['letakBaner'] == '4') { echo "selected"; } ?>>Di bawah Radio List(<? echo lebar_banner7;?> x <? echo tinggi_banner7; ?> pixel)</option>			
						   <option value='7' <?php if($letakBanner == '7' || $_POST['letakBaner'] == '7') { echo "selected"; } ?>>audio </option>
                          <option value='8' <?php if($letakBanner == '8' || $_POST['letakBaner'] == '8') { echo "selected"; } ?>>Player (<? echo lebar_banner9;?>x <? echo tinggi_banner9; ?> pixel)</option>					
						</select>
						 <br>
					</td>
					
					
					<tr>
						<td align=left valign=top><b><i>File</i></b></td><td align=left valign=top>:</td>
						<td align=left valign=top><input type="file" name="vPhoto" class="inputpesan"></td>
					</tr>
					<tr>
						   <td valign=top><b><i>Nama</i></b></td>
						   <td valign=top>:</td>
						   <td valign=top><input type=text name=cNama size=20 class="inputPesan" value="<?echo $cNama;?>"></td>
					</tr>
					<tr>
						   <td valign=top><b><i>Link</i></b></td>
						   <td valign=top>:</td>
						   <td valign=top><input type=text name=cLink size=20 class="inputPesan" value="<?echo $cLink;?>"> <b>catatan: </b>untuk banner join us masukkan "loadJoin()" pada kotak isian link (tanpa tanda petik)</td>
					</tr>
					<tr>
						   <td valign=top>Running teks</td>
						   <td valign=top>:</td>
						   <td valign=top><input type=text name=runteks size=50 maxlength="250" class="inputPesan" value="<?echo $run;?>"></td>
					</tr>
					<tr>
						   <td valign=top>Limit</td>
						   <td valign=top>:</td>
						   <td valign=top><input type=text name=lmt size=10 maxlength="10" class="inputPesan" value="<?echo $limitBanner;?>"></td>
					</tr>
					<tr>
					<td align=left valign=top>Mulai Banner</td><td align=left valign=top>:</td>
					<td align=left valign=top><input type="text" name="date1" id="f_date_a" class="inputpesan" value="<? echo $date1;?>" Readonly/><button type="reset" id="f_trigger_a">...</button>

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
					</td>
					</tr>
					<tr>
					<td align=left valign=top>Akhir Banner</td><td align=left valign=top>:</td>
					<td align=left valign=top><input type="text" name="date2" id="f_date_b" class="inputpesan" value="<? echo $date2;?>" Readonly/><button type="reset" id="f_trigger_b">...</button>
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
					<td>&nbsp;</td><input type=hidden name="aksi" Value="1">
					<input type=hidden name="act" Value="<?=$act?>">
					<td valign=top><input type=submit Value="Upload" class="tombol"></td>
					</tr>
					</table>
					</FORM>
				<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>
