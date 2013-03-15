<?
session_start();

	//if($halaman_member==true){		
	if(isset($_SESSION['SessionNya']['id'])) {
		if($_SESSION['SessionNya']['level'] < $minimal_level){
			$gajul=Header("Location: selamat_datang.php");
		}
	}else{
		/*if(!$_SESSION['Login'] == "STUPPAhjklmnbv"){
			//$gajul=Header("Location: logout2.php");
			
		}*/
		//echo 'haha';
		Header("Location:index.php");
	}
?>