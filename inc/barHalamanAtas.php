<?

	$StartRow = 0;
	$PageNo = round($PageNo);
	//Set the page no
	if(empty($PageNo)){
	    if($StartRow == 0){
	        $PageNo = $StartRow + 1;
	    }
	}else{
	    //$PageNo = $PageNo;
	    $StartRow = ($PageNo - 1) * $PageSize;
	}
	
	
	
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
    	   	    $bar2 .= "<script language=Javascript>\n";
	$bar2 .= "function validasi(x)\n";
     $bar2 .= "{\n";
     $bar2 .= "var bil1=1;\n";
	$bar2 .= "var bil2=$MaxPage;\n";
	$bar2 .= "var hal = x.PageNo.value;\n";
	$bar2 .= "if(hal ==''){pesan='Empty Input'; alert(pesan); return false;}\n";
	$bar2 .= "else if(isNaN(hal)){ pesan='Please fill with numeric between ' + bil1 + ' and '+bil2; alert(pesan); return false; }\n";
	$bar2 .= "else if(hal<bil1 || hal>bil2){ pesan='Please fill with numeric between '+ bil1 + ' and '+ bil2; alert(pesan); return false; }\n";
	$bar2 .= "else { return true;}\n";
	$bar2 .= "}\n";
	$bar2 .= "</script>\n";
	
	$bar2 .= '<table border="0" cellspacing="0" cellpadding="5" width="100%" class="kotak_coklat_satu"><tr>';
	$bar2 .= "<td>";
	$bar2 .= "<b>$PageNo</b> dari <b>$MaxPage</b> halaman<br> <b>$fromData - $endData</b> data dari total <b>$RecordCount</b> data</b>";
	$bar2 .= "</td>";
	$bar2 .= "<form name=\"halaman2\" method=\"post\" onSubmit=\"return validasi(document.halaman2);\" action=".$link.">";
	$bar2 .= "<td align=right>";
	$bar2 .= "&nbsp;&nbsp;&nbsp;Menuju ke halaman : ";
	$bar2 .= "<input type=text name=PageNo size=3 class=inputpesan>";
	$bar2 .= " <input type=submit name=kirim value=GO class=tombol>";
	$bar2 .= "</td></form></tr></table>";
	//$bar2 .= "";
	$bar2 .= "<center>";
	$bar2 .= '<table border="0" cellspacing="0" cellpadding="5"><tr><td align="center">';
		    if ($PrevPage) 
		    { 
		    		if(strpos($link,"?") > 1)
		    			{
		    			$bar2 .= ' <a href="'.$link.'&PageNo='.$PrevPage.'"><img src="'.$titikFolder.'images/search_left_but.gif" border="0" align="absmiddle" /></a> ';
		    			}
		    		else
		    			{
		    			$bar2 .= ' <a href="'.$link.'?PageNo='.$PrevPage.'"><img src="'.$titikFolder.'images/search_left_but.gif" border="0" align="absmiddle" /></a> ';
		    			}
		    } 
		    else 
		    {
		    		$bar2 .= ' <img src="'.$titikFolder.'images/search_left_but.gif" align="absmiddle" /> ';
		    }
		    
		    
		    for ($i = $hlmAwal; $i <= $hlmAkhir; $i++) 
		    	{
			    if ($i>1 && $i!=$hlmAwal)
			     {
			      $bar2 .=" - ";
			     } 
			    if ($i != $PageNo) { 
			    	if(strpos($link,"?") > 1)
			    		{
			    		$bar2 .= ' <a href="'.$link.'&PageNo='.$i.'">'.$i.'</a>';
			    		}
			    	else
			    		{
			    		$bar2 .= ' <a href="'.$link.'?PageNo='.$i.'">'.$i.'</a>';
			    		}
			    } else { 
			    $bar2 .= " <b>$i</b> "; 
			    } 
		    	}
		    
		    if ($PageNo != $MaxPage) 
		    {
		    	   	if(strpos($link,"?") > 1)
		    			{
		    	   		$bar2 .= ' <a href="'.$link.'&PageNo='.$NextPage.'"><img src="'.$titikFolder.'images/search_right_but.gif" border="0" align="absmiddle" /></a> ';
		    	   		}
		    	   	else
		    	   		{
		    	   		$bar2 .= ' <a href="'.$link.'?PageNo='.$NextPage.'"><img src="'.$titikFolder.'images/search_right_but.gif" border="0" align="absmiddle" /></a> ';
		    	   		}
		    } 
		    else 
		    {
		    	  $bar2 .= ' <img src="'.$titikFolder.'images/search_right_but.gif" align="absmiddle" /> ';
		    }
		   
	
	$bar2 .= "</td></tr></table>";
	$bar2 .= "</center>";
		}
    
     
	
            
    
?>