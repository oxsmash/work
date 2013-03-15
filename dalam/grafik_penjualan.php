<?
ob_start();
session_start();
$halaman_member=true;
$minimal_level=20;
if(in_array(3,$SessionNya['aplikasi'])) $minimal_level=1;
require ("inc/header.php");

if($cHidden=="1")
	{
	}
else
	{
	$waktu="bulan";
	$bulan=date("m");
	$tahun=date("Y");
	if($date1=="") $date1=date("d-m-Y 00:00");
	if($date2=="") $date2=date("d-m-Y 23:59");
	}		
?>
				<!--sisi kanan mulai-->
				&nbsp;&nbsp;<span class="judul_menu">Statistik Penjualan ::</span>
				<br /><br />			
<form action="<?=$PHP_SELF;?>" method="get">
<table cellpadding="2" cellspacing="0" border="0">
<tr><td>Tipe Konsumen</td><td>:</td><td>
				<select name="tipe_konsumen" class="inputpesan">
									<option value="" <?if($tipe_konsumen=="") echo "selected";?>>Semua Tipe</option>
									<?for($tk=1; $tk < count($global_konsumen); $tk++){?>
									<option value="<?=$tk;?>" <?if($tipe_konsumen==$tk) echo "selected";?>><?=$global_konsumen[$tk]?></option>
									<?}?>
				</select>
	</td></tr>
<tr><td>Tipe Pembayaran</td><td>:</td><td>
				<select name="tipe_bayar" class="inputpesan">
									<option value="" <?if($tipe_bayar=="") echo "selected";?>>Semua Tipe</option>
									<?for($tk=1; $tk < count($global_bayar); $tk++){?>
									<option value="<?=$tk;?>" <?if($tipe_bayar==$tk) echo "selected";?>><?=$global_bayar[$tk]?></option>
									<?}?>
				</select>
	</td></tr>
<tr><td>Bulan</td><td>:</td>
		<td>
		<input type="radio" name="waktu" value="bulan" <?if($waktu=="bulan") echo 'checked'?>>
		<select name="bulan" class="inputselect">	
			<?for($y=1;$y <= 12;$y++){?>
			<option value="<?=$y?>" <?if($bulan==$y) echo "selected";?>><?=xBulanIndo($y);?></option>
			<?}?>
		</select>			
		<select name="tahun" class="inputselect">	
			<?for($y=2007;$y <= date("Y");$y++){?>
			<option value="<?=$y?>" <?if($tahun==$y) echo "selected";?>><?=$y;?></option>
			<?}?>
		</select>			
		</td>
</tr>
<tr><td>Tahun</td><td>:</td>
		<td>
		<input type="radio" name="waktu" value="tahun" <?if($waktu=="tahun") echo 'checked'?>>
		<select name="tahun2" class="inputselect">	
			<?for($y=2007;$y <= date("Y");$y++){?>
			<option value="<?=$y?>" <?if($tahun2==$y) echo "selected";?>><?=$y;?></option>
			<?}?>
		</select>			
		</td>
</tr>
</table>
<input type="hidden" name="cHidden" value="1"> 
<input type="submit" name="cSubmit" value="Cari" class="tombol">
</form>
				
				<?
				$str_nilai="";
				$str_bulan="";
				if($waktu=="bulan")
				{
						$jumlahhari = date("t",strtotime($tahun."-".$bulan."-01"));
						for($hari=1;$hari <= $jumlahhari;$hari++){
							$detQuery="(DATE_FORMAT(tgl,'%Y-%m-%d') = '".$tahun."-".utkDigit(2,$bulan)."-".utkDigit(2,$hari)."') AND ";
							if($tipe_konsumen!=0) $detQuery=$detQuery."(tipe_konsumen ='".$tipe_konsumen."') AND ";			
							if($tipe_bayar!=0) $detQuery=$detQuery."(tipe_pembayaran ='".$tipe_bayar."') AND ";			
							$sqlview = "SELECT SUM(jumlah) as jumlahnya FROM ".tabel_transaksi." WHERE ".$detQuery ."ORDER by tgl desc";							
							$sqlview =str_replace("AND ORDER","ORDER",$sqlview);
							$result = mysql_query($sqlview);
							while($rs = mysql_fetch_assoc($result)) {
							$jjj=0;
							if($rs[jumlahnya] > 0) $jjj=$rs[jumlahnya];
							$str_nilai=$str_nilai.$jjj.",";
							$str_bulan=$str_bulan.$hari.",";
							}							
						}
						$dataY=substr($str_nilai,0,-1);
						$dataX=substr($str_bulan,0,-1);
						$subTitle = "Bulan ".xBulanIndo($bulan)." ".$tahun;
				}
				else
				{
						for($aaa=1;$aaa <= 12;$aaa++){
							$detQuery="(DATE_FORMAT(tgl,'%Y-%m') = '".$tahun."-".utkDigit(2,$aaa)."') AND ";
							if($tipe_konsumen!=0) $detQuery=$detQuery."(tipe_konsumen ='".$tipe_konsumen."') AND ";			
							if($tipe_bayar!=0) $detQuery=$detQuery."(tipe_pembayaran ='".$tipe_bayar."') AND ";			
							$sqlview = "SELECT SUM(jumlah) as jumlahnya FROM ".tabel_transaksi." WHERE ".$detQuery ."ORDER by tgl desc";
							$sqlview =str_replace("AND ORDER","ORDER",$sqlview);
							$result = mysql_query($sqlview);
							while($rs = mysql_fetch_assoc($result)) {							
							$jjj=0;
							if($rs[jumlahnya] > 0) $jjj=$rs[jumlahnya];
							$str_nilai=$str_nilai.$jjj.",";
							$str_bulan=$str_bulan.xBulanIndo($aaa).",";
							}							
						}
						$dataY=substr($str_nilai,0,-1);
						$dataX=substr($str_bulan,0,-1);
						$subTitle = "Tahun ".$tahun;
				}						
				?>
				<!--sisi kanan selesai-->
				<img src="grafik_bar.php?subTitle=<?=$subTitle;?>&dataX=<?=$dataX;?>&dataY=<?=$dataY;?>" alt="" />

<?
include("inc/footer.php");
?>