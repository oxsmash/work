<?php
if($_SERVER['SERVER_NAME']=="web2.web") {
	$accNya = "lokal";
} else {
	$accNya = "remote";
}


if(($_SERVER['HTTP_HOST']== "jogjastreamers.com") ||($_SERVER['HTTP_HOST']=="web2.web")){
$server="jogjastreamers";
}
else{
$server="indostreamers";
}

$accNya = "lokal";

define(folder_admin,"dalam");

if($accNya == "lokal") {
	$host="localhost";
	$user="root";
	$passwordMySql="";
	$conn=mysql_connect($host,$user,$passwordMySql);
	$database=mysql_select_db("jogjastreamer_2013",$conn);
	$folderImage = "/debritto2007/work/";
	$folderupload = "/debritto2007/work/images/upload/";
	$urlNya = "http://web2.web/1300_jogjastreamers/work/";
	$url_adminNya = "http://web-web/debritto2007/work/".folder_admin."/";
} elseif($accNya == "remote") {
	$host="localhost";
	$urlNya = "http:/jogjastreamers.com/";
	$user="chijog09_stream2";
	$passwordMySql="p4ssstr3am";
	$conn=mysql_connect($host,$user,$passwordMySql) or die(mysql_error()."aaaaaaaaa");
	$database=mysql_select_db("chijog09_jogstream",$conn);
	$folderImage = "/images";
}


//Setting untuk Tabel Mulai
//=================================
define(tabel_user,"cni_user");
define(tabel_user_penyiar,"cni_user_penyiar");
define(tabel_user_detail,"cni_user_detail");
define(tabel_banner,"cni_banner");
define(tabel_berita,"cni_berita");
define(tabel_radio,"radio");
define(tabel_agenda,"cni_agenda");
define(tabel_artikel,"cni_artikel");
define(tabel_halaman,"cni_halaman");
define(tabel_photo,"cni_photo");
define(tabel_links,"cni_links");
define(tabel_kategori_links,"tb_kategori_links");
define(tabel_kategori_kelas,"tb_kategori_kelas");
define(tabel_kategori_keluarga,"tb_kategori_keluarga");
define(tabel_keluarga,"cni_keluarga");
define(tabel_siswa,"cni_siswa");
define(tabel_kota,"t_kota");
define(tabel_saksi,"tb_kesaksian");
define(tabel_url,"tb_url");
define(tabel_stat,"statistik");
define(tabel_ekstra,"cni_ekstra");
define(tabel_prestasi,"cni_prestasi");
define(tabel_chat,"tb_chat");
define(tabel_jenis_usaha,"tb_jenis_usaha");
define(tabel_aq_history,"aqua_history");
define(tabel_aq_request,"aqua_request");
define(tabel_aq_songlist,"aqua_songlist");
define(tabel_ip_user,"cni_ip_user");
define(tabel_aq_request_candidate,"aqua_request_candidate");
define(tabel_config,"tb_config");
define(tabel_log_request,"tb_log_request");
define(urlwebnya,$urlNya);
define(akses,$server);
//=================================
//Setting Tabel Selesai

//Setting untuk default password
//=================================
define(default_pass,"123456");
//=================================
//Setting untuk default password


//Setting untuk Kategori Produk
//=================================
define(path_photo_produk,"../images/upload/"); 
define(tinggi_thumb_photo,100);
define(lebar_thumb_photo,100);
define(picture_upload,"NO"); //fasilitas beritahu teman
//=================================
//Setting untuk Kategori Produk

//Setting File Mulai
//=================================
/*define(lebar_pasphoto,100);
define(tinggi_pasphoto,125);
define(max_pasphoto,40000);
define(sisi_min_photo,150);
define(sisi_max_photo,450);
define(max_photo,150000);
define(ukuran_kecil_photo,60);
define(ukuran_sedang_photo,75);
define(lebar_banner_samping,195);
define(lebar_banner,468);
define(tinggi_banner,60);
define(lebar_banner2,132);
define(tinggi_banner2,66);*/
//=================================
//Setting File Selesai

//Setting File Mulai dari paijoeroyoroyo
//=================================
define(lebar_pasphoto,100);
define(tinggi_pasphoto,150);
define(max_pasphoto,40000);
define(sisi_min_photo,150);
define(sisi_max_photo,502);
define(max_photo,500000);
define(ukuran_kecil_photo,60);
define(ukuran_sedang_photo,100);//digunakan untuk mengatur besar kecilnya gambar di bagian list gambar yang kecil-kecil
define(lebar_banner_samping,195);
define(lebar_banner,160);
define(tinggi_banner1,60);
define(lebar_banner2,250);
define(tinggi_banner2,67);
define(tinggi_banner3,75);


define(lebar_banner4,450);
define(tinggi_banner4,60);
define(lebar_banner5,672);
define(tinggi_banner5,90);

define(lebar_banner6,160);
define(tinggi_banner6,67);

//bawah radio
define(lebar_banner7,420);
define(tinggi_banner7,65);

define(lebar_banner8,400);
define(tinggi_banner8,250);
define(lebar_banner9,280);
define(tinggi_banner9,40);
//=================================
//Setting File Selesai dari paijoeroyoroyo


//Setting File Produk
//=================================
define(lebar_max_photo_produk,650);
define(tinggi_max_photo_produk,650);
define(size_photo_produk,200000);
define(size_thumb_photo_produk,120);
//=================================
//Setting File Produk

//Setting untuk Contact Us
//=================================
//define(client,"SMA KOLESE DE BRITTO"); 
//define(email_client,"adi@citra.web.id"); 
define(email_client,"info@jogjastreamers.com"); 
//define(email_bcc,"ronal@citra.web.id"); 
define(sms_sent,"NO");
//=================================
//Setting untuk Berita2 Selesai


//Setting untuk Login Anggota
//=================================
define(key_generator,"CniP4Ssw0rd");
define(email_admin,"info@debritto-yog.sch.id");
define(session_generator,"MEDIACOMMhjklmnbv");
//=================================
//Setting untuk Login Anggota

$global_karakter = Array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","1","2","3","4","5","6","7","8","9","0","_");
?>
