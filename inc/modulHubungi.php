<?
$cKodeEmail=utk5Digit(rand(1,32768));
$cryptEmail = new MD5Crypt;

$errmsg="";

if($idkNya > 0)
	{
	$tambahan_admin=showAksesMenuSub($idkNya);
	if($tambahan_admin!="") 
		{
		$arr_tambahan_admin=explode(",",$tambahan_admin);
		for($a=0; $a < count($arr_tambahan_admin); $a++)
			{
			$tmp_data_arr_member=dataMember($arr_tambahan_admin[$a]);
			$Session_email_admin=$tmp_data_arr_member['email'].",".$Session_email_admin;
			}		
		}
	}

if($qact=="1")
{
  $fname = stripslashes($fname);
  $email = stripslashes($email);
  $company = stripslashes($company);
  $phone = stripslashes($phone);
  $fax = stripslashes($fax);
  $comments = stripslashes($comments);
  $address = stripslashes($address);
  $subject = stripslashes($subject);
  $idSubject = stripslashes($idSubject);
  $untuk = stripslashes($untuk);
  $g = 1;

  if(strlen($fname) < 1) $errmsg = $errmsg . "<li>Anda harus mengisi nama Anda";
  if(strlen($email)< 1)
  	{
    	$errmsg = $errmsg . "<li>Anda harus mengisi alamat e-mail";
		}
  else 
  	{
  	if(cekEmail($email) == 0) $errmsg = $errmsg . "<li>Format alamat e-mail Anda invalid";
		}
  if(strlen($comments)<1) $errmsg = $errmsg . "<li>Anda harus mengisi pesan Anda";
  if($cryptEmail->Decrypt($hKodeEmail,key_generator)!=$kodeKunci) $errmsg = $errmsg . "<li>Penulisan kode tidak sesuai";

  if(strlen($errmsg)<1)
  	{
	        $arr_fname=explode(" ",trim($fname));
					$include_nama_dari=$arr_fname[0];
					$include_email_dari=$email;

	       $include_subyek="Hubungi";
	       $include_pesan = $include_pesan . 	"Nama		: " . $fname . "\r\n";
	       $include_pesan = $include_pesan . 	"E-mail		: " . $email . "\r\n";
	       $include_pesan = $include_pesan . 	"Perusahaan	: " . $company . "\r\n";
	       $include_pesan = $include_pesan . 	"Alamat		: " . $address . "\r\n";
	       $include_pesan = $include_pesan . 	"Telp		: " . $phone . "\r\n";
	       $include_pesan = $include_pesan . 	"Fax		: " . $fax . "\r\n";
	       $include_pesan = $include_pesan . 	"Pesan		: " . $comments . "\r\n";
	       $include_pesan = $include_pesan . 	"============================================\r\n";
	       $include_pesan = $include_pesan . 	"IP Address	: " . getenv("REMOTE_ADDR") . "\r\n";
	       $include_pesan = $include_pesan . 	"Waktu		: " . tglIndo(time(),"l",$selisihJam);
		$include_email_tujuan=email_client;
		//$include_email_BCC=email_bcc;
		
	 $subject = "[Jogjastreamers - Hubungi]";
	 
	 if (mail($include_email_tujuan, $subject, $include_pesan)) {
	   //echo("<p>Message successfully sent!</p>");
	  } else {
	   echo("<p>Message delivery failed...</p>");
	  }
		
		//include("inc/file_email.php");
		//kirim email selesai
	}
}
?>

<script type="text/javascript">
	$("#ajaxForm").submit(function() {
		loadvis();
		var inputs = new Array();
		$(":input", this).each(function(){
			inputs.push(this.name + "=" + escape(this.value));
		});
		$.ajax({
			url: this.action,
			cache: false,
			type: "POST",
			data:inputs.join("&"),
			error: function() {
				loadhid();
				alert("Error. Please try again later.");
			},
			success: function(message) {
				loadhid();
				$("#hal").html(message);
			}
		});
		return false;
	});
</script>

<div id="ajaxContainer">

<br />
<?if($qact=="1" and strlen($errmsg)<1){?>
<br />
<span class="abu">
Terima kasih. Pesan Anda telah kami terima.<br />
Kami akan merespon pesan Anda sesegera mungkin.
</span>
<br /><br />
</p>
<?
}
else 
{
?>
<p>
Catatan: <br />Hanya bagian yang tercetak <b>tebal</b> yang merupakan isian yang wajib diisi. 
</p>

<?
if(strlen($errmsg)>0)
	{
	echo kotakError($errmsg)."<br/>";
	}
?>

<form id="ajaxForm" method="post" action="<?echo $_SERVER['PHP_SELF'];?>">
    <table border="0" class="abu">
    	<tr>
            <td><b>Nama Anda</b></td>
            <td>:</td>
            <td><input type="text" size="30" name="fname" value="<?= $fname ?>" class="inputPesan"></td>
        </tr>
        <tr>
            <td><b>E-mail</b></td>
            <td>:</td>
            <td><input type="text" size="30" name="email" value="<?= $email ?>" class="inputPesan"></td>
        </tr>
        <tr>
            <td>Perusahaan</td>
            <td>:</td>
            <td><input type="text" size="30" name="company" value="<?= $company ?>" class="inputPesan"></td>
        </tr>
        <tr>
            <td valign="top">Alamat</td>
            <td valign="top">:</td>
            <td><textarea name="address" rows="4" cols="30" class="inputPesan"><?= $address ?></textarea></td>
        </tr>
        <tr>
            <td>Telp</td>
            <td>:</td>
            <td><input type="text" size="20" name="phone" value="<?= $phone ?>" class="inputPesan"></td>
        </tr>
        <tr>
            <td>Fax</td>
            <td>:</td>
            <td><input type="text" size="20" name="fax" value="<?= $fax ?>" class="inputPesan"></td>
        </tr>
        <tr>
            <td valign="top"><b>Isi Pesan</b></td>
            <td valign="top">:</td>
            <td><textarea name="comments" rows="8" cols="30" class="inputPesan"><?= $comments ?></textarea></td>
        </tr>
        <tr>
	      <td valign="top"><b>Kode</b></td>
              <td valign="top">:</td>
	      <td><?php echo "<img src=\"bikinKode.php?string=$cKodeEmail\" width=\"50\" height=\"20\">"; ?></td>
	</tr>
	<tr>
	      <td valign="top"><b>Tuliskan<br />Kode diatas</b></td>
              <td valign="top">:</td>
	      <td><input class="inputPesan" type="text" name="kodeKunci" size="12" maxlength="12" />
	      </td>
	</tr>
	<tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td><input type="submit" name="B1" value="Kirim" class="tombol"></td>
        </tr>
    </table><input type="hidden" name="qact" value="1"><input type="hidden" name="idSubject" value="<?=$idSubject?>" />
    <input type="hidden" name="hKodeEmail" value="<?=$cryptEmail->Encrypt($cKodeEmail,key_generator)?>" />
    <input type="hidden" name="g" value="<?=$g?>" />
    <input type="hidden" name="act" value="<?=$act?>" /> 
</form>        

<?}?>

</div>

