<?php
exit;
ob_start();
session_start();

include_once("inc/config.php");
include_once("inc/fungsi.php");

if ($_GET['cs']=="1") {
	$userSession['time'] = date("Y:m:d H:i:s");
	session_register("userSession");
	$id = intval($_GET['id']);
	if ($id>0) {
		$sql5 = "select nama from ".tabel_radio." where radio_id='".$id."'";
		$res5 = mysql_query($sql5);
		$row5 = mysql_fetch_object($res5);
		echo $row5->nama;
	}	
	exit;
}

$chat = "";
$chat_readonly = "";
$dari_readonly = "";
$pesan_readonly = "";
$button_disabled = "";
if ($_POST) {
	$id = intval($_POST['id']);
	$act = $_POST['aksi'];
	$dari = htmlspecialchars(trim($_POST["dari"]), ENT_QUOTES);
	$pesan = htmlspecialchars(trim($_POST["pesan"]), ENT_QUOTES);
	$type = $_POST['t'];
	$lastId = intval($_POST['lid']);
	$strError = "";
	if (strtolower($dari)=="dj") {
		$strError = "Nama invalid";
	}
	if (strlen($dari)>15) {
		$strError = "Nama Terlalu panjang";
	}
	if(!empty($strError)) {
		echo "-1|".$strError;
		exit;
	}
	
	if ($id>0 && $lastId>=0) {
		$sql1 = "select nama from ".tabel_radio." where radio_id='".$id."'";
		$res1 = mysql_query($sql1);
		$row1 = mysql_fetch_object($res1);
		$nama = $row1->nama;
	
		$sql = "select last_chat, status_chat from ".tabel_user_penyiar." where id_radio='".$id."'";
		$res = mysql_query($sql);
		$row = mysql_fetch_object($res);
		$last_chat = $row->last_chat;
		$status = $row->status_chat;
		
		if ($status!="1") {
			$lid = 0;
			$chat = "<b style='color:#FF0000;'>DJ</b> is offline.<br/>";
			$chat_readonly = 'readonly="readonly"';
			$dari_readonly = 'readonly="readonly"';
			$pesan_readonly = 'readonly="readonly"';
			$button_disabled = 'disabled="disabled"';
		} else {
			if (!empty($dari) && !empty($pesan)) {
				// check last message sent
				$sql5 = "SELECT tanggal +interval 5 minute as berikutnya, now() as sekarang FROM `tb_chat` WHERE id_radio='".$id."' and ip='".$_SERVER['REMOTE_ADDR']."' order by tanggal desc limit 1";
				$res5 = mysql_query($sql5);
				$row5 = mysql_fetch_object($res5);
				$next = $row5->berikutnya;
				$now = $row5->sekarang;
				
				$arrNext = explode(" ",$next);
				$arrNextDate = explode("-",$arrNext[0]);
				$arrNextHour = explode(":",$arrNext[1]);
				$timeNext = mktime($arrNextHour[0],$arrNextHour[1],$arrNextHour[2],$arrNextDate[1],$arrNextDate[2],$arrNextDate[0]);
				
				$arrNow = explode(" ",$now);
				$arrNowDate = explode("-",$arrNow[0]);
				$arrNowHour = explode(":",$arrNow[1]);
				$timeNow = mktime($arrNowHour[0],$arrNowHour[1],$arrNowHour[2],$arrNowDate[1],$arrNowDate[2],$arrNowDate[0]);
				
				if($type=="dj") {
					$sql4 = "insert into ".tabel_chat."(id_radio,dari,pesan,tanggal,ip,status_user) values('".$id."','DJ','".$pesan."',now(),'".$_SERVER['REMOTE_ADDR']."','dj')";
					mysql_query($sql4);
					$code = 1;
				} else {
					if ($timeNow>=$timeNext) {
						$sql4 = "insert into ".tabel_chat."(id_radio,dari,pesan,tanggal,ip,status_user) values('".$id."','".$dari."','".$pesan."',now(),'".$_SERVER['REMOTE_ADDR']."','biasa')";
						mysql_query($sql4);
						$code = 1; // request sent
					} else {
						$code = 0; // request not sent
					}
				}
			}
			
			if($act!="viewDj") {
				if(!empty($_SESSION['userSession']['time'])) $last_chat = $_SESSION['userSession']['time'];
			}
			
			$sql3 = "select * from ".tabel_chat." where id_radio='".$id."' and tanggal>'".$last_chat."' and id_chat>'".$lid."' order by id_chat DESC limit 10";
			$res3 = mysql_query($sql3);
			$num3 = mysql_num_rows($res3);
			if ($num3<1) {
				if (empty($lid)) { $chat = "<b>".$nama."</b> is online.<br/>"; }
				else { $chat = ""; }
			} else {
				$num3 = mysql_num_rows($res3);
				$arr3 = array();
				while ($row3 = mysql_fetch_object($res3)) {
					if ($row3->status_user=="dj") {
						$nama = '<b style="color:#EE0000;">'.$row3->dari.'</b>';
					} else {
						$nama = "<b>".$row3->dari."</b>";
					}
					
					if ($num3 == mysql_num_rows($res3)) $lid = $row3->id_chat;
					
					if ($act=="viewDj") {
						$nama .=  " (".tglIndo($row3->tanggal, "t").") ";
					}
					$arr3[$num3] = $nama.": ".$row3->pesan."<br/>";
					$num3--;
				}
				for($i=1;$i<=count($arr3);$i++) {
					$chat .= $arr3[$i];
				}
			}
		}
		
		if ($act=="view" || $act=="viewDj") {
			echo $status."|".$lid."|".$chat;
		} else {
			echo $code."|".$lid."|".$chat;
		}
	}
}
?>