<?php

ob_start();
session_start();
?>
<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
</head>
<body>
<a name="kesaksian"></a>
<h2 class="putih"><?if($act!="sukses"){if($varBahasa=="_e") echo 'Add Testimony'; else echo 'Tambah Kesaksian';}?></h2>
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
				$editor->set_name('pIsi');
				$editor->set_stylesheet('../inc/style.css');
				// insert some HTML
				$editor->set_code($pIsi);
				
				$editor->removebuttons('link,smiley,tab,html,preview,print,find,spacer1,pasteword,spacer2,undo,redo,spacer3,tbl,edittable,spacer4,border,image,ruler,document,bookmark,special,custom,format,font,size,class,spacer5,spacer6,spacer7,ol,ul,indent,outdent,spacer8,color,highlight,cut,paste,copy');
				
				// print the editor to the browser:
				$editor->print_editor(400, 300);
				
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
</body>
</html>