<?php
ob_start();
session_start();
$judulHalaman="EDIT BANNER";
$fileIndex="";
$fileSearch="";



include("../inc/headerAdmin.php");
?>
	<link rel="stylesheet" type="text/css" media="all" href="../calendar_files/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="../calendar_files/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="../calendar_files/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="../calendar_files/calendar-setup.js"></script>
<?

$aksi = $_POST['aksi'];
$act = $_GET['act'];
if(empty($_POST['id'])) {
	$id = $_GET['id'];
}else {
	$id = $_POST['id'];
}

if($act=="edit")
{
	$queryString = "SELECT * from ".tabel_banner." where banner_id='".$id."'";
	$result=mysql_query($queryString) or die("errorrrr");
	$row_array=mysql_fetch_array($result);
	$tipeBanner=$row_array[ukuran_banner];
	$letakBanner=$row_array[letak_banner];
	$cFile=$row_array['file_banner'];
	$cNama=$row_array[nama_banner];
	$cLink=$row_array[link_banner];
	$cTipe=$row_array[tipe];
	//$date1=date("d-m-Y",$row_array[mulai_banner]);
	//$date2=date("d-m-Y",$row_array[selesai_banner]);
	$tgl1 =split(" ",$row_array[mulai_banner]);
	$tgl2=split(" ",$row_array[selesai_banner]);
	
	$tgl1 =split("-",$tgl1[0]);
	$tgl2 =split("-",$tgl2[0]);
	
	
	$date1= $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
	$date2= $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
	$vStatus=$row_array[status_banner];
	$run = $row_array[run_teks];
	$limitBanner = $row_array[limit_banner];
}



$strError="";
if($aksi=="1"){
	
	$letakBaner = $_POST['letakBaner'];
	$vPhoto = $_FILES['vPhoto']['tmp_name'];
	$tempNama = pathinfo($_FILES['vPhoto']['name']);
	$limitBanner = $_POST['lmt'];
	
	$vPhoto_name = time().'.'.$tempNama['extension'];
	$vStatus = $_POST['vStatus'];
	$tipe = $_FILES['vPhoto']['type'];
	$id = $_POST['id'];
	$run = $_POST['runteks'];
	$cFile = $_POST['cFile'];

	if(is_uploaded_file($vPhoto)) {
		$size2 = GetImageSize($vPhoto);
		
		//echo $size2[0].'--'.$size2[1];
		
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
				if($size2[1] != tinggi_banner8) $strError=$strError."<li>Tinggi banner harus ".tinggi_banner8." pixels!";
			break;
			case 0 :
				$strError=$strError."<li>Ukuran masih kosong!";
			break;
			}
	
				
	    if($letakBaner != '6') {			
			if ($_FILES['vPhoto']['size'] > max_photo) $strError=$strError."<li>Ukuran file maksimal ".round(max_photo / 1000,0)." KB";

			if (file_exists("../images/banner/".$vPhoto_name)) {
				$strError=$strError. "<li>Nama file sudah ada di server.";
			}
		//if ($vPhoto_type!="image/pjpeg") $strError=$strError. "<li>Tipe file photo harus JPG.";
	    }	

	}else {
		if($letakBaner != '6') {
			//if(!empty($vPhoto_name)) {
				//echo $cFile;
			
				$tmp = "../images/banner/".ltrim($cFile);
				//echo $tmp;
				
				echo "3";
				
				$size2 = GetImageSize($tmp);
				
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
			/*}else {
				$strError=$strError."<li>File masih kosong";
			}*/
		}
	}
	
	if ($letakBaner==1){$letak="1";} else if ($letakBaner==2){$letak="2";}

	$cNama=stripslashes($_POST['cNama']);
	$cLink=stripslashes($_POST['cLink']);
	$date1 = $_POST['date1']; 
	$date2 = $_POST['date2']; 
	$cTipe = $_POST['cTipe'];
	

	if(strlen($cNama) < 1) $strError=$strError."<li>Nama masih kosong.";
	if(strlen($cLink) < 1) $strError=$strError."<li>Link masih kosong.";

	if($date1=="") $strError=$strError."<li>Mulai banner masih kosong.";
	if($date2=="") $strError=$strError."<li>Akhir banner masih kosong.";

	$mulai=split("-",$date1);
	$akhir=split("-",$date2);

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
		

	if(strlen($strError) < 1)
	{
		if(strlen($_FILES['vPhoto']['name'])!="")
		{
			
		   if($letakBaner != '6') {	
				if(is_uploaded_file($vPhoto))
				{
					
					unlink("../images/banner/" . ltrim($cFile));
				
					$res = move_uploaded_file($vPhoto, "../images/banner/" . $vPhoto_name) or die('gatot');
					
				}
		  }
			$cmd = "Update ".tabel_banner." set 
			file_banner='".$vPhoto_name."',
			letak_banner='".addslashes($letakBaner)."',
			nama_banner='" . addslashes($cNama). "',
			link_banner='" . addslashes($cLink). "',
			mulai_banner='".$mulai."',
			selesai_banner='".$akhir."',
			status_banner='".$vStatus."',
			tgl_banner='".time()."',
			tipe='".$tipe."',
			limit_banner = '".$limitBanner."',
			run_teks = '" . addslashes($run). "',
			ip_banner='".getenv("REMOTE_ADDR")."' where banner_id='".$id."'";
		}
		else
		{
			$cmd = "Update ".tabel_banner." set
			letak_banner='".addslashes($letakBaner)."',
			nama_banner='" . addslashes($cNama). "',
			link_banner='" . addslashes($cLink). "',
			mulai_banner='".$mulai."',
			selesai_banner='".$akhir."',
			status_banner='".$vStatus."',
			tgl_banner='".time()."',
			tipe='".$cTipe."',
			limit_banner = '".$limitBanner."',
			run_teks = '" . addslashes($run). "',
			ip_banner='".getenv("REMOTE_ADDR")."' where banner_id='".$id."'";
		}
		mysql_query($cmd) or die(mysql_error());
		Header("Location: listBanner.php");
		
	}
}
?>

				<!--sisi kanan mulai-->
					<br />
					&nbsp;&nbsp;<span class="judul_menu">Edit Banner ::</span>
					<br><br>
					<?php
					if (strlen($strError) > 0)
						{
						echo kotakError($strError);
						}						
					?>					
					<form method="post" action="editBanner.php" ENCTYPE="multipart/form-data">
						
						<?php
							
							if($_POST){
								
								$cmd20 = "SELECT * from ".tabel_banner." where banner_id='".$_POST['id']."'";
								
								$res20=mysql_query($cmd20) or die("errorrrr");
								$brs = mysql_fetch_array($res20);
								
								$cFile = $brs['file_banner'];
							
							    

									if($brs['tipe'] == 'application/x-shockwave-flash') {
										
										$arrSwf = getimagesize("../images/banner/".$cFile);
										$swfH = $arrSwf[1];
										
										if($brs['letak_banner'] == '3') {
											
											echo '
												<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="160" height="'.$swfH.'">
													<param name="movie" value="../images/banner/'.$brs['file_banner'].'">
													<param name="quality" value="high"><embed src="../images/banner/'.$brs['file_banner'].'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="160" height="'.$swfH.'"></embed>
												</object>
											
											';
											
										}else if($brs['letak_banner'] == '7') {	
										
											echo '<img src="../images/images.jpg" width="40"> <a href="../images/banner/'.$cFile.'">download</a>';
										
										}else if($brs['letak_banner'] == '6') {	
										
											echo "";
										
										} else if($brs['letak_banner'] == '4') {
											
											echo '
												<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="215" height="'.$swfH.'">
													<param name="movie" value="../images/banner/'.$brs['file_banner'].'">
													<param name="quality" value="high"><embed src="../images/banner/'.$brs['file_banner'].'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="215" height="'.$swfH.'"></embed>
												</object>
											
											';
											
										} else {
										
											echo '
												<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="673" height="'.$swfH.'">
													<param name="movie" value="../images/banner/'.$brs['file_banner'].'">
													<param name="quality" value="high"><embed src="../images/banner/'.$brs['file_banner'].'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="673" height="'.$swfH.'"></embed>
												</object>
											
											';
										
										}
										
									}else {
									
										if($brs['letak_banner'] == '7') {	
										
											echo '<img src="../images/images.jpg" width="40"> <a href="../images/banner/'.$cFile.'">download</a>';
										
										}else if($brs['letak_banner'] == '6') {	
										
											echo "";
										
										}else {
											echo '<img src="../images/banner/'.$brs['file_banner'].'" />';
										}
									}
									
								
							
							}else{
								
								
								
									if($cTipe == 'application/x-shockwave-flash') {
										
										$arrSwf = getimagesize("../images/banner/".$cFile);
										$swfH = $arrSwf[1];
										
										if($letakBanner == '3') {
											
											echo '
												<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="160" height="'.$swfH.'">
													<param name="movie" value="../images/banner/'.$cFile.'">
													<param name="quality" value="high"><embed src="../images/banner/'.$cFile.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="160" height="'.$swfH.'"></embed>
												</object>
											
											';
										
										}else if($letakBanner == '7') {	
										
											echo '<img src="../images/images.jpg" width="40"> <a href="../images/banner/'.$cFile.'">download</a>';	
											
										}else if($letakBanner == '6') {	
										
											echo "";	
										
										}else if($letakBanner == '4') {
											
											echo '
												<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="215" height="'.$swfH.'">
													<param name="movie" value="../images/banner/'.$cFile.'">
													<param name="quality" value="high"><embed src="../images/banner/'.$cFile.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="215" height="'.$swfH.'"></embed>
												</object>
											
											';
											
										} else {
										
											echo '
												<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="673" height="'.$swfH.'">
													<param name="movie" value="../images/banner/'.$cFile.'">
													<param name="quality" value="high"><embed src="../images/banner/'.$cFile.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="673" height="'.$swfH.'"></embed>
												</object>
											
											';
										
										}
										
									}else {
									
										
									
										if($letakBanner == '7') {	
										
											echo '<img src="../images/images.jpg" width="40"> <a href="../images/banner/'.$cFile.'">download</a> ';
											
										}else if($letakBanner == '6') {	
										
											echo "";
										
										}else {										
									
											echo '<img src="../images/banner/'.$cFile.'" />';
											
										}	
									}
							    			
							}
							
							
						?>
					
						
					<table border=0>
					<tr>
					</tr>
					<tr>
						<td align=left valign=top><b><i>File</i> * </b></td><td align=left valign=top>:</td>
						<td align=left valign=top><input type="file" name="vPhoto" class="inputpesan"></td>
					</tr>
					<tr>
					<td align=left valign=top>Ukuran Banner*</td><td align=left valign=top>:</td>
					<td align=left valign=top>
                    <select name="letakBaner" id="letakBaner" class="inputPesan" style="width:150px;">
						   <option value="0">-- Select ukuran --</option>				
						   <option value='1' <?php if($letakBanner == '1' || $_POST['letakBaner'] == '1') { echo "selected"; } ?>>atas (<? echo lebar_banner4;?>x <? echo tinggi_banner4; ?> pixel)</option>			
						   <option value='3' <?php if($letakBanner == '3' || $_POST['letakBaner'] == '3') { echo "selected"; } ?>>Tengah(<? echo lebar_banner6;?>x <? echo tinggi_banner6; ?> pixel)</option>			
						   <option value='4' <?php if($letakBanner == '4' || $_POST['letakBaner'] == '4') { echo "selected"; } ?>>Di bawah Radio List(<? echo lebar_banner7;?> x <? echo tinggi_banner7; ?> pixel)</option>			
						   <option value='7' <?php if($letakBanner == '7' || $_POST['letakBaner'] == '7') { echo "selected"; } ?>>audio </option>
                          <option value='8' <?php if($letakBanner == '8' || $_POST['letakBaner'] == '8') { echo "selected"; } ?>>Player (<? echo lebar_banner9;?>x <? echo tinggi_banner9; ?> pixel)</option>					
						</select>
					
					</td>
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
						<td align=left valign=top>Status</td><td align=left valign=top>:</td>
						<td align=left valign=top><INPUT TYPE=checkbox NAME="vStatus" value=1 <?if($vStatus==1) echo "Checked";?>></td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td><input type=hidden name="aksi" Value="1">
					<INPUT TYPE=hidden NAME="id" Value="<? echo $id;?>">
					<input type=hidden NAME="cTipe" Value="<?=$cTipe?>">
					
					<input type=hidden NAME="cFile" Value="<?=$cFile?>">
					
					<td valign=top><input type=submit Value="Upload" class="tombol"></td>
					</tr>
					</table>

					* Jika ingin mengganti file banner, silakan pilih file.<br />
					&nbsp;&nbsp;	Biarkan kosong bilamana tidak ingin merubah.
				</FORM>
				<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>
