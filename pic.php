<?php
if ($_GET) {	
	$id = $_GET['id'];
	$size = $_GET['s'];
	$dir = "logo";
	if (!is_numeric($id) || $id<1) $id = "default";
	if ($size==1) $dir = "logo_thumbs";
	$gambar   = "images/".$dir."/".$id.".jpg";
	$handle   = @fopen($gambar, "rb");
	if (empty($handle)) {
		$gambar = "images/".$dir."/default.jpg";
		$handle = @fopen($gambar, "rb");
	}
	header("Content-Type: image/jpeg");
	header("Content-Length:".filesize($gambar));
	fpassthru($handle);
	fclose($handle);
	exit;
}
?>