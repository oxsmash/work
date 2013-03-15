<?
ob_start();
session_start();
require ("inc/config.php");
require ("inc/fungsi.php");
require ("inc/fungsi_khusus.php");


if($_POST["toprank"]=="1")
{	
		$sqlview = "Select radio.nama,radio.radio_id,ranking_harian.jumlah from radio,ranking_harian where radio.radio_id=ranking_harian.id_radio and ranking_harian.tgl='".date("Y-m-d")."' order by ranking_harian.jumlah desc limit 10";
		$result=mysql_query($sqlview) or die("errorrrr");	
		$data=array();
		$a=0;
		while($row_array=mysql_fetch_array($result)){
		$data[$a]['nama']=$row_array[nama];
		$a++;	
		}
							
		$djson =  "{
				'sukses' : '1',
				'data' :".json_encode($data).",
				'subTotal' : '".$subTotal."'
			}";
		echo $djson;
		exit;
}


?>

