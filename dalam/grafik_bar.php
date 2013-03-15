<?
header('Content-Type: image/png');
/* #INFO############################################
Author: Igor Feghali
Email: ifeghali@interveritas.net
################################################# */

/* #FILE DESCRIPTION################################
Example for the bar graph
################################################# */

// #INCLUDE#########################################
require("charts.class.php");
// #################################################

// #FUNCTIONS#######################################
function factors($n)
{

	$div = Array(1);

	for ($i=1; $i<= ($n/2); $i++)
		if ($n % $i == 0)
			$div[] = $i;

	$div[] = $n;

	return $div;
}

function hasAconvenientDiv($div)
{
    $divs = Array(8,7,6,5,4);
    foreach ($divs as $k => $v)
	if (in_array($v,$div))
	    return $v;
    return 0;
}
// #################################################

// #INSTANTIATING CLASS#############################
$g = new chart;
// #################################################

// #X ELEMENTS######################################
$elemx = Array();
$elemy = Array();

$dataY=explode(",",$_GET['dataY']);
$dataX=explode(",",$_GET['dataX']);		


for($aa=0;$aa < count($dataY);$aa++)
					{
					$elemx[] = $dataX[$aa];
					$yNya = 0;
					if($dataY[$aa] > 0) $yNya = round($dataY[$aa]/1000,2);
					$elemy[] = $yNya;
					}


// #################################################

// #BIGGEST Y ELEMENT###############################
$ymax = ceil(max($elemy));
// #################################################

// #FINDING A CONVENIENT SCALE FOR Y AXIS###########
if ($ymax > 8)
{
    do
    {
        $div = factors($ymax);
		$ymax++;
    } while (!($scale = hasAconvenientDiv($div)));

    $ymax--;
}
// #################################################


// #POPULATING GRAPH################################
foreach ($elemy as $k => $v)
{
    $g->xValue[] = $elemx[$k];
    $g->DataValue[] = $v;
}
// #################################################

// #SETTING GRAPH PARAMETERS########################
$g->Title = $_GET['subTitle'];
$g->SubTitle = $subTitle;
//$g->Width = (count($elemx)*45) + 75;
$g->Width = 700;
$g->Height = 300;

$g->xCount = count($elemx);
$g->xCaption = "Jumlah: ".number_format(array_sum($dataY), 0, ',', '.');
$g->xShowValue = TRUE;
$g->xShowGrid = TRUE;

$g->yCount = $scale;
$g->yCaption = "Penjualan (000)";
$g->yShowValue = TRUE;
$g->yShowGrid = FALSE;

$g->DataDecimalPlaces = 0;
$g->DataMax = $ymax;
$g->DataMin = 0;
$g->DataShowValue = TRUE;
// #################################################

// #ITS DRAWING TIME################################
$g->MakeBarChart();
// #################################################

?>
