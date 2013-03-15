<?
if($aksi=="1")
{	
	$strError="";
	$cNama=stripslashes($cNama);
	$cEmail=stripslashes($cEmail);
	$umur=stripslashes($umur);
	$pekerjaan=stripslashes($pekerjaan);
	
	$vJudul=stripslashes($vJudul);
	$vSumber=stripslashes($vSumber);
	$vIsi=stripslashes($vIsi);
	$vIsi=strip_tags($vIsi,$global_boleh_html);
	
	if($varBahasa=="_e")
		{
			if($cNama == "") $strError = $strError . "<li>Please, you must fill in your full name."; 
			if($cEmail=="") $strError = $strError . "<li>Please, you must fill in your email."; 
			else
				{
				if(cekEmail($cEmail)!=1) $strError = $strError . "<li>Invalid email address.";
				}
			if($umur == "") $strError = $strError . "<li>Please, you must fill in your age."; 
			else
				{
				if(!is_numeric($umur)) $strError = $strError . "<li>Please, fill in your age with number."; 
				}
			if($pekerjaan == "") $strError = $strError . "<li>Please, you must fill in your work"; 
			
			if(strlen($vJudul) < 1) $strError=$strError."<li> You have not submit the title yet.";
			else
				{
				$temp_arr=explode(" ",strip_tags($vJudul));
				$ada=0;
				for($a=0; $a < count($temp_arr);$a++)
					{
					if(strlen($temp_arr[$a]) > 50) $ada=1;
					}
				if($ada==1)$strError=$strError."<li>Please insert SPACE within the title of your testimony.";
				}
			if(check_word($vJudul)==1) $strError=$strError."<li> Your title contains some bad words.";
			if(strlen($vIsi) < 20) $strError=$strError."<li> You have not submit your testimony yet.";
			else
				{		
				$vIsi=str_replace('"><img title=""','"> <img title=""',$vIsi);		
				$temp_arr=explode(" ",strip_tags($vIsi));
				$ada=0;
				for($a=0; $a < count($temp_arr);$a++)
					{
					if(strlen($temp_arr[$a]) > 50) $ada=1;
					}
				if($ada==1) $strError=$strError."<li> Some of your words are too long. Please insert SPACE within.";
				}
			if(check_word($vIsi)==1) $strError=$strError."<li> There are some bad words.";
			if(strlen(strip_tags($vIsi)) > 2000) $strError=$strError."<li> Maximum content of the testimony is 2000 characters.";
			if($cryptKode->Decrypt($hKodePesan,key_generator)!=$kodeKunci) $strError = $strError . "<li>Invalid code.";
		}
	else
		{
			if($cNama == "") $strError = $strError . "<li>Silahkan mengisi nama lengkap anda"; 
			if($cEmail=="") $strError = $strError . "<li>Silahkan mengisi email anda."; 
			else
				{
				if(cekEmail($cEmail)!=1) $strError = $strError . "<li>Alamat email tidak sah";
				}
			if($umur == "") $strError = $strError . "<li>Silahkan mengisi umur anda"; 
			else
				{
				if(!is_numeric($umur)) $strError = $strError . "<li>Silahkan mengisi umur anda dengan angka"; 
				}
			if($pekerjaan == "") $strError = $strError . "<li>Silahkan mengisi pekerjaan anda"; 
			
			if(strlen($vJudul) < 1) $strError=$strError."<li> Belum mengisi judul kesaksian.";
			else
				{
				$temp_arr=explode(" ",strip_tags($vJudul));
				$ada=0;
				for($a=0; $a < count($temp_arr);$a++)
					{
					if(strlen($temp_arr[$a]) > 50) $ada=1;
					}
				if($ada==1)$strError=$strError."<li> Ada kata - kata yang panjang yang tidak memiliki spasi pada judul kesaksian.";
				}
			if(check_word($vJudul)==1) $strError=$strError."<li> Judul kesaksian mengandung kata-kata makian.";
			if(strlen($vIsi) < 20) $strError=$strError."<li> Belum mengisi isi kesaksian.";
			else
				{		
				$vIsi=str_replace('"><img title=""','"> <img title=""',$vIsi);		
				$temp_arr=explode(" ",strip_tags($vIsi));
				$ada=0;
				for($a=0; $a < count($temp_arr);$a++)
					{
					if(strlen($temp_arr[$a]) > 50) $ada=1;
					}
				if($ada==1) $strError=$strError."<li> Ada kata - kata yang panjang yang tidak memiliki spasi.";
				}
			if(check_word($vIsi)==1) $strError=$strError."<li> Terdapat kata-kata makian.";
			if(strlen(strip_tags($vIsi)) > 2000) $strError=$strError."<li> Isi kesaksian maksimal 2000 karakter.";
			if($cryptKode->Decrypt($hKodePesan,key_generator)!=$kodeKunci) $strError = $strError . "<li>Penulisan kode tidak sesuai";
		}
	
	if(strlen($strError) < 1)
	{
		$vStatus=0;
		$query = "INSERT INTO ".tabel_kesaksian."(nama,email,umur,pekerjaan,judul,isi,tgl_kesaksian,status_kesaksian,ip_kesaksian) VALUES('".addslashes($cNama)."','".addslashes($cEmail)."','".addslashes($umur)."','".addslashes($pekerjaan)."','".addslashes($vJudul)."','".addslashes($vIsi)."',now(),'".addslashes($vStatus)."','".getenv("REMOTE_ADDR")."')";
		//echo $query;
		mysql_query($query) or die("Tidak bisa menambah kesaksian :".mysql_error());
		//kirim email mulai
		$include_email_dari=$cNama;
		$include_nama_dari=$cEmail;
		$include_subyek="Kesaksian";
		$include_pesan = $include_pesan . 	"Ada yang telah memasang Kesaksian.i\r\n";
		$include_pesan = $include_pesan . 	"Nama		: " . $cNama. "\r\n";
		$include_pesan = $include_pesan . 	"Email	: " . $cEmail. "\r\n";
		$include_pesan = $include_pesan . 	"Usia		: " . $umur. "\r\n";
		$include_pesan = $include_pesan . 	"Pekerjaan	: " . $pekerjaan. "\r\n";
	        $include_pesan = $include_pesan . 	"================================================\r\n";
	        $include_pesan = $include_pesan . 	$vJudul . "\r\n";
	        $include_pesan = $include_pesan . 	$vIsi . "\r\n";
	        $include_pesan = $include_pesan . 	"================================================\r\n";
	        $include_pesan = $include_pesan . 	"IP Address	: " . getenv("REMOTE_ADDR") . "\r\n";
	        $include_pesan = $include_pesan . 	"Waktu		: " . tglIndo(time(),"l",$selisihJam);
		$include_email_tujuan=$Session_email_admin;
		include_once("inc/file_email.php");
		//kirim email selesai
		//Header("Location: kesaksian.php?act=sukses&#kesaksian"); 
	}
	
}
?>
<a name="kesaksian"></a>
<h2><?if($act!="sukses"){if($varBahasa=="_e") echo 'Add Testimony'; else echo 'Tambah Kesaksian';}?></h2>
			<!--sisi kanan mulai-->
				<?php
				if (strlen($strError) > 0)
					{
					echo kotakError($strError);
					}
				?>
				<?
				if($act=="sukses")
					{
					if($varBahasa=="_e") echo '<br /><br /><br /><center><b>Thanks for your testimony</b></center><br /><br /><br />';
					else echo '<br /><br /><br /><center><b>Terima kasih atas kesaksian anda</b></center><br /><br /><br />';
					}
				else
					{
				?>
				<form name="tBisnis" method="post" action="<?echo $PHP_SELF;?>?#kesaksian">
				<table border="0" cellpadding="3" cellspacing="0" width="100%">
				<tr>
					<td align=left valign=top>Nama Lengkap : <br />
						<INPUT TYPE=TEXT NAME="cNama" value="<?echo $cNama;?>" class="f-12" size="30" maxlength="200">
					</td>
					<td align=left valign=top>Usia : <br />
						<INPUT TYPE=TEXT NAME="umur" value="<?echo $umur;?>" class="f-12" size="4" maxlength="2" autocomplete="off" onkeypress="return handleConfCodeKeyPress(event);">
					</td>
					
				</tr>
				<tr>
					<td align=left valign=top>Pekerjaan  : <br />
						<INPUT TYPE=TEXT NAME="pekerjaan" value="<?echo $pekerjaan;?>" class="f-12" size="30" maxlength="200">
					</td>
				</tr>
				<tr>
				<td align=left valign=top colspan="3">Email : <br />
				<INPUT TYPE=TEXT NAME="cEmail" value="<?echo $cEmail;?>" class="f-12" size="30" maxlength="200"></td>
				</tr>
				<tr>
				<td align=left valign=top colspan="3">Judul : <br />
				<INPUT TYPE=TEXT NAME="vJudul" value="<?echo $vJudul;?>" class="f-12" size="50" maxlength="200"></td>
				</tr>
				<tr>
				<td align=left valign=top colspan="3">Pesan :<br />
				<?php

				// include the config file and editor class:
				
				include_once ('editor_files/config.php');
				include_once ('editor_files/editor_class.php');
				
				// create a new instance of the wysiwygPro class:
				
				$editor = new wysiwygPro();
				
				// set_name
				$editor->set_name('vIsi');
				$editor->set_stylesheet('inc/style2008.css');
				// insert some HTML
				$editor->set_code($vIsi);
				$editor->removebuttons('link,smiley,tab,html,preview,print,find,spacer1,pasteword,spacer2,undo,redo,spacer3,tbl,edittable,spacer4,border,image,ruler,document,bookmark,special,custom,format,font,size,class,spacer5,spacer6,spacer7,ol,ul,indent,outdent,spacer8,color,highlight,cut,paste,copy');
				
				// print the editor to the browser:
				$editor->print_editor(400, 200);
				
				?>
				</td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%"><span class="">Kode :</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo "<img src=\"bikinKode.php?string=$cKode\" width=\"50\" height=\"16\" align=\"absmiddle\" >"; ?>
					<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" name="kodeKunci" class="f-12" value="" size="6" maxlength="7" />
					</td>
				</tr>
				<tr>
				<td valign=top align="center">&nbsp;</td>
				<td valign=top colspan="2">
				<input type="hidden" name="aksi" value="1">
				<input type="hidden" name="id" value="<?=$id;?>">
				<input type="hidden" name="idF" value="<?=$idF;?>">
				<input type="hidden" name="strDirect" value="<?=$strDirect;?>">
				<input type="hidden" name="act" value="<?=$act;?>">
				<input type="hidden" name="hKodePesan" value="<?=$hKode?>" class="tombol">
				<br /><input type=submit value="Submit" class="Tombol"></form></td>
				</tr>
				</table>
				</form>
					<?}?>
				<!--sisi kanan selesai-->
