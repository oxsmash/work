<?
	if ($_POST) {
		$PageNo = $_POST['PageNo'];
	}
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
	$bar .= "<center class='clear'>";
	$bar .= '<table border="0" cellspacing="0" cellpadding="5"><tr><td align="center">';
		    if ($PrevPage) 
		    { 
		    		if(strpos($link,"?") > 1)
		    			{
		    			$bar .= ' <a href="'.$link.'&PageNo='.$PrevPage.'"><img src="'.$titikFolder.'images/search_left.gif" border="0" align="absmiddle" /></a> ';
		    			}
		    		else
		    			{
		    			$bar .= ' <a href="'.$link.'?PageNo='.$PrevPage.'"><img src="'.$titikFolder.'images/search_left.gif" border="0" align="absmiddle" /></a> ';
		    			}
		    } 
		    else 
		    {
		    		$bar .= ' <img src="'.$titikFolder.'images/search_left_off.gif" align="absmiddle" /> ';
		    }
			
			
		    $bar .= '&nbsp;&nbsp;';
			$bar .= '</td><td align="center"  valign="bottom">';
		    
		    for ($i = $hlmAwal; $i <= $hlmAkhir; $i++) 
		    	{
			    if ($i>1 && $i!=$hlmAwal)
			     {
			      $bar .=" - ";
			     } 
			    if ($i != $PageNo) { 
			    	if(strpos($link,"?") > 1)
			    		{
			    		$bar .= ' <a class="l_paging font12" href="'.$link.'&PageNo='.$i.'">'.$i.'</a>';
			    		}
			    	else
			    		{
			    		$bar .= ' <a class="l_paging font12" href="'.$link.'?PageNo='.$i.'">'.$i.'</a>';
			    		}
			    } else { 
			    $bar .= " <b class='merah font12'>$i</b> "; 
			    } 
		    	}
		    
			$bar .= '</td><td valign="top" align="center">';
			$bar .= '&nbsp;&nbsp;';
			
		    if ($PageNo != $MaxPage) 
		    {
		    	   	if(strpos($link,"?") > 1)
		    			{
		    	   		$bar .= ' <a href="'.$link.'&PageNo='.$NextPage.'"><img src="'.$titikFolder.'images/search_right.gif" border="0" align="absmiddle" /></a> ';
		    	   		}
		    	   	else
		    	   		{
		    	   		$bar .= ' <a href="'.$link.'?PageNo='.$NextPage.'"><img src="'.$titikFolder.'images/search_right.gif" border="0" align="absmiddle" /></a> ';
		    	   		}
		    } 
		    else 
		    {
		    	  $bar .= ' <img src="'.$titikFolder.'images/search_right_off.gif" align="absmiddle" /> ';
		    }
		   
	
	$bar .= "</td></tr></table>";
	$bar .= "</center>";
	/* $bar .= '<table border="0" cellspacing="0" cellpadding="5" width="100%" class="kotak_coklat_satu"><tr>';
	$bar .= "<td class=putih2>";
	$bar .= "<b>$PageNo</b> dari <b>$MaxPage</b> halaman<br> <b>$fromData - $endData</b> data dari total <b>$RecordCount</b> data</b>";
	$bar .= "</td>";
	$bar .= "<form name=\"halaman\" method=\"post\" onSubmit=\"return validasi(document.halaman);\" action=".$link.">";
	$bar .= "<td align=right class=putih2>";
	$bar .= "&nbsp;&nbsp;&nbsp;Menuju ke halaman : ";
	$bar .= "<input type=text name=PageNo size=3 class=inputpesan>";
	$bar .= " <input type=submit name=kirim value=GO class=tombol>";
	$bar .= "</td></form></tr></table>"; */
	//$bar .= "";
		}
    
     
	
            
    
?>