<?php
include "inc/config.php";
if(!$_POST) { exit; }
$step = (int) $_POST['step'];

// query check: dah request belum?
$ip = $_SERVER['REMOTE_ADDR'];
$sqlIp = "select id from ".tabel_ip_user." where ip='".$ip."' and tgl + interval 5 MINUTE>=now()";
$resIp = mysql_query($sqlIp);
$numIp = mysql_num_rows($resIp);
if($numIp>0) {
	echo '<div class="putih" style="padding-bottom:10px;text-align:center">Anda hanya bisa melakukan request sekali dalam lima menit.</div>';
	exit;
}
?>

<script type="text/javascript">
	<? if ($step==2 || $step==3) { ?>
	$("#ajaxForm2").submit(function() {
		$("#requestMenu>.loading").css("display","block");
		$("#requestMenu>.isi").empty();
		var inputs = new Array();
		$(":input", this).each(function(){
			if(this.type=="radio") {
				if(this.checked==true) { inputs.push(this.name + "=" + escape(this.value)); }
			} else {
				inputs.push(this.name + "=" + escape(this.value));
			}
		});
		$.ajax({
			url: this.action,
			cache: false,
			type: "POST",
			data:inputs.join("&")+"&step=2",
			error: function() {
				$("#requestMenu>.loading").css("display","none");
				alert("Error. Please try again later.");
			},
			success: function(message) {
				$("#requestMenu>.loading").css("display","none");
				$("#requestMenu>.isi").html(message);
			}
		});
		return false;
	});
	<? } ?>
	
	$("#ajaxForm").submit(function() {
		$("#requestMenu>.loading").css("display","block");
		$("#requestMenu>.isi").empty();
		var inputs = new Array();
		$(":input", this).each(function(){
			if(this.type=="radio") {
				if(this.checked==true) { inputs.push(this.name + "=" + escape(this.value)); }
			} else {
				inputs.push(this.name + "=" + escape(this.value));
			}
		});
		$.ajax({
			url: this.action,
			cache: false,
			type: "POST",
			data:inputs.join("&")+"&step=<?=$step+1?>",
			error: function() {
				$("#requestMenu>.loading").css("display","none");
				alert("Error. Please try again later.");
			},
			success: function(message) {
				$("#requestMenu>.loading").css("display","none");
				$("#requestMenu>.isi").html(message);
			}
		});
		return false;
	});
</script>

<?php if($step==1) { 
	$formUI = '<form id="ajaxForm" method="post" action="'.$_SERVER['PHP_SELF'].'">
		<div style="text-align:center;">
			<input class="inputPesan" type="text" name="tfCari"/> <select class="inputPesan" name="type"><option value="nama">Nama Artis</option><option value="judul">Judul Lagu</option></select> <input class="tombol" type="submit" value="cari"/>
		</div>
		</form>';
	echo $formUI;
} else if($step==2) { 
	$formUI2 = '<form id="ajaxForm2" method="post" action="'.$_SERVER['PHP_SELF'].'">
		<div style="text-align:center;">
			<input class="inputPesan" type="text" name="tfCari"/> <select class="inputPesan" name="type"><option value="nama">Nama Artis</option><option value="judul">Judul Lagu</option></select> <input class="tombol" type="submit" value="cari"/>
		</div>
		</form>';

	$tfCari = htmlentities($_POST['tfCari'], ENT_QUOTES);
	$tfCari = trim($tfCari);
	
	$dType = "artist";
	$type = $_POST['type'];
	if($type=="nama") $dType = "artist";
	if($type=="judul") $dType = "title";
	
	$addSql = "";	
	$arrCari=explode(" ",$tfCari);
	foreach($arrCari as $value) {
		$addSql .= " (".$dType." like '%".$value."%') and ";
	}
	
	$formUI = "";
	$sql = "select id,artist,title,UNIX_TIMESTAMP(last_played) as lp,UNIX_TIMESTAMP(now()- interval 2 HOUR) as skrg  from ".tabel_aq_songlist." where ".$addSql." status='1'";
	$res = mysql_query($sql) or die($sql);
	$num = mysql_num_rows($res);
	$i = 1;
	$disd = "";
	$note = "";
	if($num>0) {
		while($row = mysql_fetch_object($res)) {
			if ($i==1) { $formUI .='<tr>'; }
			$id = $row->id;
			$title = $row->title;
			$artist = $row->artist;
			$lp = $row->lp;
			$skrg = $row->skrg;
			if($lp>=$skrg) {
				$disd = "disabled='disabled'";
				$note = "class='orange'";
			} else {
				$disd = "";
				$note = "";
			}
			$formUI .='<td valign="top" width="5%"><input type="radio" '.$disd.' name="pilihan" value="'.$id.'"></td>';
			$formUI .='<td valign="top" width="45%"><span '.$note.'>'.$title.'<br/>('.$artist.')</span></td>';
			if ($i%2==0) { $formUI .='</tr><tr>'; }
			$i++;
		}
		
		$formUI = '<div class="putih" style="text-align:center">hasil Pencarian dg Kata Kunci "'.$tfCari.'"</div><br/><div class="requestForm"><table>'.$formUI.'</table></div>';
		$formUI = '<form id="ajaxForm" method="post" action="'.$PHP_SELF.'">'.$formUI.'<br/><div class="f-11 orange">note: lagu dg teks warna orange sudah diputar kurang dari dua jam yg lalu</div><br/>
				   <div style="text-align:center"><input class="tombol" type="submit" value="kirim"/></div></form>';
		$formUI = $formUI2.$formUI;
	} else {		
		$formUI = $formUI2.'<div class="putih" style="padding-bottom:10px;text-align:center">Data tidak ditemukan.</div>';
	}	
	echo $formUI;	
} else if ($step==3) {
	$formUI2 = '<form id="ajaxForm2" method="post" action="'.$PHP_SELF.'">
		<div style="text-align:center;">
			<input class="inputPesan" type="text" name="tfCari"/> <select class="inputPesan" name="type"><option value="nama">Nama Artis</option><option value="judul">Judul Lagu</option></select> <input class="tombol" type="submit" value="cari"/>
		</div>
		</form>';

	$id = (int) $_POST['pilihan'];
	$pesan = "";
	if(empty($id)) {
		$pesan = $formUI2.'<div class="putih" style="padding-bottom:10px;text-align:center">Anda belum memilih lagu.</div>';
	} else {
		// insert new candidate
		$sqlC = "insert into ".tabel_aq_request_candidate."(song_id, count) values('".$id."', 1)";
		mysql_query($sqlC);
		$err = strtolower(mysql_error());
		if (!empty($err)) {
			$pos = strpos($err, "duplicate entry");
			if ($pos===false) {
				$pesan = $err;
			} else {
				// update data
				$sqlU = "update ".tabel_aq_request_candidate." set count=count+1 where song_id='".$id."'";
				mysql_query($sqlU);
			}
		}
		// insert new ip
		$sqlI = "insert into ".tabel_ip_user."(ip, tgl) values('".$ip."', now())";
		mysql_query($sqlI);
		$err = strtolower(mysql_error());
		if (!empty($err)) {
			$pos = strpos($err, "duplicate entry");
			if ($pos===false) {
				$pesan = $err;
			} else {
				// update data
				$sqlU2 = "update ".tabel_ip_user." set tgl=now() where ip='".$ip."'";
				mysql_query($sqlU2);
			}
		}
		
		// insert to log
		$sqlL = "insert into ".tabel_log_request."(ip, song_id, tgl) values('".$ip."', '".$id."', now())";
		mysql_query($sqlL);
		
		$pesan = "Pilihan Anda telah kami simpan. Terima kasih.<br/>Lagu yang diputar berdasarkan request terbanyak.";
	}
	
	$formUI = '<div class="putih" style="padding-bottom:10px;text-align:center">'.$pesan.'</div>';
	echo $formUI;	
} ?>