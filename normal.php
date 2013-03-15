<?
include_once("inc/config.php");
include_once("inc/fungsi.php");
$cmdRadio = "SELECT r.*,tk.* FROM radio r
left join t_kota tk on (tk.id_kota=r.id_kota)
WHERE r.radio_id='$_GET[id]'";
$res = mysql_query($cmdRadio,$conn);
while($rs = mysql_fetch_array($res)) {?>
    <img src="images/logo/<?=$rs['radio_id']?>.jpg" width="160" height="80"  onMouseOver="radioinfo('<?=$rs['radio_id']?>')"/>
<? }
exit;
?>