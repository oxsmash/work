<?php
ob_start();
session_start();

include "header.php";

$id = $_SESSION["penyiarSession"]["id"];
$sql = "select * from ".tabel_user_penyiar." where id_penyiar='".$id."'";
$res = mysql_query($sql);
$row = mysql_fetch_object($res);
$status_chat = $row->status_chat;
$id_radio = $row->id_radio;
?>
&nbsp;&nbsp;<span class="judul_menu">Aplikasi Chat ::</span>
<br /><br />

<?
if($status_chat==1) {
	echo '<br/>';
	echo '<script type="text/javascript" src="../js/jquery.js"></script>';
	echo
	'<script type="text/javascript">
	$(document).ready(function() {
		displayWatch();
		ajaxChatRefresh();
		
		// submit chat request
		$("#ajaxChatForm").submit(function() {
			// loadvis();
			var inputs = new Array();
			$(":input", this).each(function(){
				inputs.push(this.name + "=" + escape(this.value));
			});
			$.ajax({
				url: this.action,
				type: "POST",
				data:inputs.join("&"),
				error: function() {
					// loadhid();
					alert("Error. Please try again later.");
				},
				success: function(message) {
					var arrMessage = message.split("|");
					if (arrMessage[0]=="1") {
						$("#ajaxChatForm>input[name=pesan]").attr("value","");
						$("#ajaxChatForm>input[name=lid]").attr("value",arrMessage[1]);
						$("#chatMenu>#chatIsi").append(arrMessage[2]);
						$("#chatMenu>#chatIsi").scrollTop($("#chatMenu>#chatIsi")[0].scrollHeight);
					}
				}
			});
			return false;
		});
	});
	
	var date, time;
	function setWatchHours() {
		date.setTime(time);
		time+=1000;
		$("#jam").text((date.getUTCHours())+":"+date.getUTCMinutes()+":"+date.getUTCSeconds());
		var t = setTimeout("setWatchHours()",1000);
	}
	
	function displayWatch() {
		time = '.mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")).'*1000;
		date = new Date();
		setWatchHours();
	}
	
	function ajaxChatRefresh() {
		var t;
		var id = $("#ajaxChatForm>input[name=id]").val();
		$.ajax({
			url: "../chat.php",
			type: "POST",
			data: "aksi=viewDj&id="+id+"&lid="+$("#ajaxChatForm>input[name=lid]").attr("value"),
			error: function() {
				alert("Error. Please try again later.");
			},
			success: function(message) {
				var arrMessage = message.split("|");
				if (arrMessage[0]=="1") {
					$("#ajaxChatForm>input[name=dari]").attr("readonly",null);
					$("#ajaxChatForm>input[name=pesan]").attr("readonly",null);
					$("#ajaxChatForm>input[name=button]").attr("disabled",null);
				} else {
					$("#ajaxChatForm>input[name=dari]").attr("readonly","readonly");
					$("#ajaxChatForm>input[name=pesan]").attr("readonly","readonly");
					$("#ajaxChatForm>input[name=button]").attr("disabled","disabled");
				}
				$("#ajaxChatForm>input[name=lid]").attr("value",arrMessage[1]);
				if (arrMessage[1]!="0") {
					$("#chatMenu>#chatIsi").append(arrMessage[2]);
					$("#chatMenu>#chatIsi").scrollTop($("#chatMenu>#chatIsi")[0].scrollHeight);
				} else {
					$("#chatMenu>#chatIsi").html(arrMessage[2]);
				}
				t=setTimeout("ajaxChatRefresh()",2000);
			}
		});
		return false;
	}
	</script>';
	echo
	'<div style="width:600px;">
		<image  style="float:left;" src="../images/logo/'.$id_radio.'.jpg"/>&nbsp;<div id="jam" style="float:right;" align="right">&nbsp;</div>
		<br style="clear:both;"/>
		<div id="chatMenu" align="left">
			<div id="chatIsi" class="inputPesan"></div>
			<form id="ajaxChatForm" method="POST" action="../chat.php">
				<label style="font-size:11px;color:white;width:40px;">Pesan:</label>
				<input type="text" name="pesan" size="75" class="inputPesan"/><br style="clear:both;"/>
				<input type="hidden" name="id" value="'.$id_radio.'"/>
				<input type="hidden" name="dari" value="1"/>
				<input type="hidden" name="lid" value="0"/>
				<input type="hidden" name="t" value="dj"/>
				<input type="hidden" name="aksi" value="viewDj"/>
				<input type="submit" name="button" value="Kirim" class="tombol"/>
			</form>
		</div>
	</div>';
}

?>

<?
include "footer.php";
?>