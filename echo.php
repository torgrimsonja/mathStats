<?php
require_once('common.php');
//die(var_dump($_FILES));
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Declare variables
$uploadPath = "uploads/";
	//$fileName
	if(array_key_exists('newFile', $_FILES)){
		$fileName = escape_html($_FILES['newFile']['name']);
	}else if(array_key_exists('existingFile', $_POST)){
		$fileName = $_POST['existingFile']; 
	}else{
		die("Sorry buddy, you didn't upload a file.");
	}
die(print_r($_POST['existingFile']));
$fileContent = file_get_contents($fileName);
$chartType = escape_html($_POST['chartType']);
$fileLines = explode("\n", $fileContent);

//Page Level Functions
//storeFile function is from previous code at ajax.php
function storeFile($path, $name){
	
		move_uploaded_file($_FILES["file"]["name"], "uploads");
		echo "<script type='text/javascript'>console.log('Uploading: " . $name . "');</script><br />";
		 //Check that it is in the uploads folder
		if(array_key_exists('newFile', $_FILES) && file_exists($path . $name)){
			echo $_FILES["file"]["name"];
			echo "<script type='text/javascript'>console.log('".$_FILES['file']['name']." was uploaded');</script><br />";
		}else{
			echo "<script type='text/javascript'>console.log('ERROR, ".$name."was not successfully saved to directory.');</script><br />";
		}

}

function makeHTML(){
	
	$html = "<DOCTYPE html>
			<html>
			<head>
				<meta charset='utf-8' />
				<title>Enjoy your cool graph...</title>
					<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>
					<script src='http://code.highcharts.com/highcharts.js'></script>
					<script src='http://code.highcharts.com/modules/exporting.js'></script>
					<script src='http://code.jquery.com/jquery-1.11.1.min.js'></script>
					<script src='http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js'></script>
					<link rel='stylesheet' href='http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.css'>
					<script type='text/javascript' name='chartCode'>
					//Script for displaying a chart, printing it, and downloading it
						//DeviceReady event handling
						$(document).on('pageinit', deviceReady);
						function deviceReady(){
							console.log('DeviceReady Function fired');
						}
						console.log('In chart js from echo.php');

						//Define variables
						var chart = new Highcharts.Chart(options);
						var dataLines = ".$fileLines.";
						var titleName = 'Temperature for '+".$fileLines[2].";
						var yAxisTitle = 'Temperature';

						//Create Functions
						function Print(){
							chart.setTitle(null, { text: ' ' });
						    chart.print();
						    chart.setTitle(null, { text: 'Click and drag in the plot area to zoom in' });
						}

						function userDownload(){
							var d = document.getElementById('ExportOption');
						    var ExportAs = d.options[d.selectedIndex].value;
						    if(ExportAs == 'PNG')
						    {
						        chart.exportChart({type: 'image/png', filename: titleName}, {subtitle: {text:''}});
						    }
						    if(ExportAs == 'JPEG')
						    {
						        chart.exportChart({type: 'image/jpeg', filename: titleName}, {subtitle: {text:''}});
						    }
						    if(ExportAs == 'PDF')
						    {
						        chart.exportChart({type: 'application/pdf', filename: titleName}, {subtitle: {text:''}});
						    }
						    if(ExportAs == 'SVG')
						    {
						        chart.exportChart({type: 'image/svg+xml', filename: titleName}, {subtitle: {text:''}});
						    }
						}

						//The processData function needs to be rewritten to work within our php with all of the variables we already have
						function processData(data){
								console.log('Inside processData function');
								//Split the rows
								var dataRows = data.split('\n');
								//Iterate over the lines and add categories or series 
								$.each(dataRows, function(lineNum, line){
									var items = line.split(',');	
									//Second line after radio button stuff contains categories
									if(lineNum == 1){
										$.each(items, function(itemNum, value){
											if(itemNum > 0){
												options.xAxis.categories.push(value);
											}
										});
									}else{
										//The rest of the lines contain data with their name in the first position
										var series = {
												data: []
										};
										$.each(items, function(itemNum, value){
												if(itemNum == 0){
													series.name = value;
												}else{
													series.data.push(parseFloat(value));
												}
										});
										options.series.push(series);
									}
								});
							}


						//Define initial skeleton for chart
						var options = {
							chart:{
								renderTo: 'container',
								defaultChartType: 'column',
								type: ".$chartType."
							},
							title:{
								text: titleName
							},
							xAxis:{
								categories: []
							},
							yAxis:{
								title:{
									text: yAxisTitle	
								}
							},
							series: [{
										name:'Celsius',
										data:[]
									 },
									{
										name:'Fahrenheit',
										data:[]
									}]
							};

						//Buttons and Processes
							//Display chart process
							$(function(){						
									$('#container').highcharts({
										//Map the generated chart to the container div for display
									});
							});
							
							//Print button
							$('#buttonPrint').click(function(){
								console.log('User clicked the Print button');
								Print();
							});
							
							//Download button
							$('#downloadButton').click(function (){
								console.log('User clicked the Download Button');
								userDownload()

							});

					</script>
			</head>
			
			<body>
			<!-- The highcharts graph will render inside this container -->
						<div id='container' style='width:100%; height: 400px;'>
							   
						</div>
						<!-- Below are exporting options -->
						<fieldset class='ui-grid-a'>
							<!-- Print the Chart -->
							<div class='ui-block-a'><button id='buttonPrint' data-role='button'>Print chart</button></div>
							<!-- Choose a Way to Save the Chart -->
							<div class='ui-block-b'>
								<select id='DownloadOption' data-native-menu='false'>
									<option value='default' selected='selected'>Download As</option>
									<option value='PNG'>PNG Image</option>
									<option value='JPEG'>JPEG Image</option>
									<option value='PDF'>PDF Document</option>
									<option value='SVG'>SVG Vector Image</option>
								</select>
								<button id='downloadButton'>Download</button>
							</div>
						</fieldset>
			</body>
			</html>";
		
		echo $html;
		
}

//Run Functions
if(	array_key_exists('file', $_POST) &&
	array_key_exists('chartType', $_POST)
	){

	storeFile($uploadPath, $fileName);

}

//Echo HTML
makeHTML();