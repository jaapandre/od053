<?php
function createBarGraph ($data, $labels, $municipal,$fileName) {
	//we need the jpgraph library http://jpgraph.net/ available in current dir
	require_once ('jpgraph/src/jpgraph.php');
	require_once ('jpgraph/src/jpgraph_pie.php');
	// Create the Pie Graph.
	$graph = new PieGraph(400,250);
	// Set A title for the plot
	$graph->title->Set($municipal);
	$graph->title->SetFont(FF_FONT1,FS_BOLD);
	// add data to the piechart
	$p1 = new PiePlot($data);
	// add legend
	$p1->SetLegends($labels);
	$graph->Add($p1);
	//generate the piechart
	$graph->Stroke("images/".$fileName.".png");
}
?>