<?
	$StartRow = 0;
	$PageNo = $_GET['PageNo'];
	//echo $PageNo;
	//Set the page no
	if(empty($PageNo)){
	    if($StartRow == 0){
	        $PageNo = $StartRow + 1;
	    }
	}else{
	    //$PageNo = $PageNo;
	    $StartRow = ($PageNo - 1) * $PageSize;
	}
	
	$Trecord=mysql_query($sqlview) or die("There is no result");
	$sqlview=$sqlview." LIMIT $StartRow,$PageSize";
	$RecordCount = mysql_num_rows($Trecord);
	
	
	 //Set Maximum Page
	 $MaxPage = $RecordCount % $PageSize;
	 if($RecordCount % $PageSize == 0){
	    $MaxPage = $RecordCount / $PageSize;
	 }else{
	    $MaxPage = ceil($RecordCount / $PageSize);
	 }
	 $NextPage = $PageNo + 1;
	 $PrevPage = $PageNo - 1;
	
	
	$fromData=(($PageNo - 1)*$PageSize)+1;
	$endData=($fromData+$PageSize)-1;
	if($endData > $RecordCount) $endData=$RecordCount;	
			
	$hlmAwal=1;	
  	if($PageNo > 10) 
  		{
  		if($PageNo % 10 == 0) $hlmAwal = ((($PageNo / 10) - 1) *10) + 1;
  		else $hlmAwal=((intval($PageNo / $PageSize)*$PageSize)+1);
  		}  	
  	$hlmAkhir=$hlmAwal - 1 + 10;
  	if($hlmAkhir > $MaxPage) $hlmAkhir=$MaxPage;
  	
  	    //Print First & Previous Link is necessary
        if ($RecordCount>$PageSize)
    	   {
    	   	    $bar .= "<script language=Javascript>\n";
	$bar .= "function validasi(x)\n";
     $bar .= "{\n";
     $bar .= "var bil1=1;\n";
	$bar .= "var bil2=$MaxPage;\n";
	$bar .= "var hal = x.PageNo.value;\n";
	$bar .= "if(hal ==''){pesan='Empty Input'; alert(pesan); return false;}\n";
	$bar .= "else if(isNaN(hal)){ pesan='Please fill with numeric between ' + bil1 + ' and '+bil2; alert(pesan); return false; }\n";
	$bar .= "else if(hal<bil1 || hal>bil2){ pesan='Please fill with numeric between '+ bil1 + ' and '+ bil2; alert(pesan); return false; }\n";
	$bar .= "else { return true;}\n";
	$bar .= "}\n";
	$bar .= "</script>\n";
	$bar .= "<center>";
	$bar .= '<table border="0" cellspacing="0" cellpadding="5"><tr><td align="center">';
		    if ($PrevPage) 
		    { 
		    		if(strpos($link,"?") > 1)
		    			{
		    			$bar .= ' <a onclick=loadPage("'. $Jenis .'","'.$PrevPage.'"); class="pointer" ><img src="'.$titikFolder.'images/search_left_but.gif" border="0" align="absmiddle" /></a> ';
		    			}
		    		else
		    			{
		    			$bar .= ' <a onclick=loadPage("'. $Jenis .'","'.$PrevPage.'"); class="pointer"><img src="'.$titikFolder.'images/search_left_but.gif" border="0" align="absmiddle" /></a> ';
		    			}
		    } 
		    else 
		    {
		    		$bar .= ' <img src="'.$titikFolder.'images/search_left_but.gif" align="absmiddle" /> ';
		    }
		    
		    
		    for ($i = $hlmAwal; $i <= $hlmAkhir; $i++) 
		    	{
			    if ($i>1 && $i!=$hlmAwal)
			     {
			      $bar .=" - ";
			     } 
			    if ($i != $PageNo) { 
			    	if(strpos($link,"?") > 1)
			    		{
			    		$bar .= ' <a onclick=loadPage("'. $Jenis .'","'.$i.'"); class="pointer">'.$i.'</a>';
			    		}
			    	else
			    		{
			    		$bar .= ' <a onclick=loadPage("'. $Jenis .'","'.$i.'"); class="pointer">'.$i.'</a>';
			    		}
			    } else { 
			    $bar .= " <b>$i</b> "; 
			    } 
		    	}
		    
		    if ($PageNo != $MaxPage) 
		    {
		    	   	if(strpos($link,"?") > 1)
		    			{
		    	   		$bar .= ' <a onclick=loadPage("'. $Jenis .'","'.$NextPage.'"); class="pointer"><img src="'.$titikFolder.'images/search_right_but.gif" border="0" align="absmiddle" /></a> ';
		    	   		}
		    	   	else
		    	   		{
		    	   		$bar .= ' <a onclick=loadPage("'. $Jenis .'","'.$NextPage.'"); class="pointer"><img src="'.$titikFolder.'images/search_right_but.gif" border="0" align="absmiddle" /></a> ';
		    	   		}
		    } 
		    else 
		    {
		    	  $bar .= ' <img src="'.$titikFolder.'images/search_right_but.gif" align="absmiddle" /> ';
		    }
		   
	
	$bar .= "</td></tr></table>";
	$bar .= "</center>";
	$bar3 = $bar;
	$bar3 .= "<b>$PageNo</b> dari <b>$MaxPage</b> halaman<br>";
	$bar .= '<table border="0" cellspacing="0" cellpadding="5" width="100%" class="kotak_coklat_satu"><tr>';
	$bar .= "<td class=putih2>";
	$bar .= "<b>$PageNo</b> dari <b>$MaxPage</b> halaman<br> <b>$fromData - $endData</b> data dari total <b>$RecordCount</b> data</b>";
	$bar .= "</td>";
	
	$bar .= "</tr></table>";
	//$bar .= "";*/
		}
    
     
	
            
    
?>
