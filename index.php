<html><head></head><body>

<?php 
ini_set('display_errors', 1);

// include php-script that generaties the piechart
require_once ('piechart.php');


//open file
$file="BodemgebruikCategorieenGemeenten2008CBS.csv";
if (($handle = fopen($file, "r")) !== FALSE) {
	$i=0;
	// read the file line for line, till the end
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    	//file headers
    	//first line contains categories
    	if ($i==0){
    		$categories=$data;
    		//print_r($header);
    		//we don't use first vale 'gemeenten' and last row: 'totaal
    		unset ($categories[0]);
    		unset ($categories[8]);
    	}else {
    		$municipalData=$data;
    		// municipal in first value and remove it from array
    		$municipal=array_shift($municipalData);
    		// remove total value (1)
    		unset($municipalData[7]);
    		//determin filenameBase (makes it save for filename)
    		$filenameBase=urlencode($municipal);
    		//create the image for this municipal
    		createBarGraph($municipalData, $categories, $municipal, $filenameBase);
    		//display the images in the resulting hmtl-page
			echo "<img src=images/".$filenameBase.".png>";
			//try to send the image immediately to the browser
			flush();    			
    	} 
    	$i++;
    }
    fclose($handle);
}
?>
</body>
</html>