<?
function cek($id=0,$idBaru=0){
	$cmd = "select * from cni_halaman where top_halaman = '".$id."' order by urut_halaman asc";
	$cmd1 = "select * from cni_halaman where top_halaman = '".$id."' order by urut_halaman asc";
	
	$res = mysql_query($cmd);
	$res1 = mysql_query($cmd1);
	
	if(mysql_num_rows($res) > 0){
	
		$row=mysql_fetch_array($res1);
		if ($row[top_halaman]==3) echo "<ul style='background:url(images/hover2a.png) top left no-repeat;'>";
		elseif ($row[top_halaman]==5) echo "<ul style='background:url(images/hover4a.png) top left no-repeat;'>";
		elseif ($row[top_halaman]==8) echo "<ul style='background:url(images/hover5a.png) top left no-repeat;'>";
		else echo "<ul>";
		
		while($brs=mysql_fetch_array($res)){
			$cmd2 = "select * from cni_halaman where top_halaman = '".$brs[halaman_id]."' order by urut_halaman asc";
			$res2 = mysql_query($cmd2);
			if(mysql_num_rows($res2) > 0)$hasChild=1;
			else $hasChild=0;
			if (strlen($brs[file_include])>0) $link = $brs[file_include];
			else $link = "content.php?ix=".$brs[halaman_id];
			if ($brs[top_halaman]==1&&$brs[nama_halaman]=='BERANDA'){$classHover='menu1';}
			elseif ($brs[top_halaman]==1&&$brs[nama_halaman]=='TENTANG KAMI'){$classHover='menu2';}
			elseif ($brs[top_halaman]==1&&$brs[nama_halaman]=='BERITA'){$classHover='menu3';}
			elseif ($brs[top_halaman]==1&&$brs[nama_halaman]=='GALERI'){$classHover='menu4';}
			elseif ($brs[top_halaman]==1&&$brs[nama_halaman]=='KONTAK'){$classHover='menu5';}
			
			if ($brs[top_halaman]==1) echo "<li class='menu ".$classHover."' >";
			
			if (($brs[top_halaman]==1&&$brs[urut_halaman]==1)or($brs[top_halaman]==1&&$brs[urut_halaman]==2)or($brs[top_halaman]==1&&$brs[urut_halaman]==3)or($brs[top_halaman]==1&&$brs[urut_halaman]==4)) echo "<a class='amenu' href='".$link."' style='border-right:2px solid black;'>".$brs[nama_halaman]."</a>";
			elseif ($brs[top_halaman]==1&&$brs[urut_halaman]==5) echo "<a class='amenu' href='".$link."'>".$brs[nama_halaman]."</a>";
			elseif ($brs[top_halaman]>1 && $hasChild==1) echo "<li> <a class='haschild' href='".$link."'>".$brs[nama_halaman]."</a>";
			else echo "<li> <a href='".$link."'>".$brs[nama_halaman]."</a>";
			
			cek($brs[halaman_id],$temp);
			
			echo "</li>";
		}
		echo "</ul>";
	}

}
?>