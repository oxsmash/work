<?php
ob_start();
ini_set('arg_separator.output','&amp;'); 
session_start();
include("../inc/config.php"); 
include("../inc/fungsi.php"); 
include("../inc/fungsi_khusus.php");
header ("Content-type: application/xml");
echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
?>
<rss version="0.91">
    <channel>
        <title>GudegNet - Gudang Info Kota Jogja</title>
        <description>Gudang Info Kota Jogja</description>
        <link>http://www.gudeg.net/<?=$kodeBahasa;?>/news.html</link>
        <lastBuildDate><?=tglIndo(time(),"l");?></lastBuildDate>
        <generator>GudegNet</generator>
<?php
$res = mysql_query("SELECT * FROM tbberita where bahasa_berita='".$kode_bahasa."' and status_berita='1' ORDER BY berita_id DESC limit 10"); 
while ($data = mysql_fetch_object($res)) { 
				echo '<item>';
        echo '<title>'.htmlentities(strip_tags($data->judul_berita)).'</title>';
        echo '<link>'.$urlNya.$kodeBahasa.'/news/'.date("Y").'/'.date("m").'/'.$data->berita_id.'/'.underScore($data->judul_berita).'.html</link>';
  			echo ' <description><![CDATA['.str_replace("&nbsp;","",putusKalimat(strip_tags($data->isi_berita),300)).']]></description>';
				echo '<author>GudegNet</author>';
        if($data->bahasa_berita==1) echo '<pubDate>'.tglIndo($data->tgl_berita,"l_e").'</pubDate>';
        else echo '<pubDate>'.tglIndo($data->tgl_berita,"l").'</pubDate>';
        echo '</item>';
} 
?>
	</channel>
</rss>
