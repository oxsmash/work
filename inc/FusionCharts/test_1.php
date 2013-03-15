<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script language="JavaScript" src="Js/FusionCharts.js"></script>
<title>Untitled Document</title>
</head>

<body>
<div id="chartdiv" align="center"> 
        FusionCharts. </div>

      <script type="text/javascript">
           var chart = new FusionCharts("Charts/FCF_Column3D.swf", "ChartId", "600", "350");
           chart.setDataURL("data.xml");        
           chart.render("chartdiv");
        </script>
</body>
</html>
