<?php
//Error Reporting and Commmon Functions
require_once('common.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Set DEBUG to true in common
if(DEBUG){
	die(print_r($_FILES)."<br />".print_r($_POST));
	//die(print_r($_FILES['newFile']));
	//die(print_r($_POST));
}

//Declare variables
$titleName = 'Temperature Chart';
$yAxisTitle = 'Temperature';
$celcius = array();
$fahrenheit = array();
$time = array();
$date = array();
$fileName;
$fileContent;
$fileLines;
$chartType = array_key_exists('chartType', $_POST) ? escape_html($_POST['chartType']) : 'No Type Chosen';
$uploadPath = "uploads/";

//Logic
if(array_key_exists('newFile', $_FILES) && !empty($_FILES['newFile']['name']) && $_POST['existingFile'] == 'default'){
	$fileName = escape_html($_FILES['newFile']['name']);
	storeFile($uploadPath, $fileName);
	makeFileLines();
	makeHTML($fileLines);
}else if(array_key_exists('existingFile', $_POST) && $_POST['existingFile'] != 'default' && $_FILES['newFile']['name'] == ''){
	$fileName = $_POST['existingFile']; 
	existingFileContent();
	makeFileLines();
	makeHTML($fileLines);
}else if(array_key_exists('existingFile', $_POST) && $_POST['existingFile'] != 'default' && array_key_exists('newFile', $_FILES) && !empty($_FILES['newFile']['name'])){
	$fileName = escape_html($_FILES['newFile']['name']);
	$previousFileName = $_POST['existingFile'];
	bothMethods();
}else{
	die('Sorry buddy, you either didn\'t upload a file or it wasn\'t a CSV file.');
}

//Page Level Functions
function storeFile($path, $name){
		global $fileContent;
		$fileAlreadyExists = FALSE;
		$tmp_name = $_FILES["newFile"]["tmp_name"];
        $name = $_FILES["newFile"]["name"];
		$uploaded = move_uploaded_file($tmp_name, 'uploads/'.$name);
		$fileContent = file_get_contents('uploads'.'/'.$name);
		//---------------------------
		$dir = 'uploads';
	    $files = scandir($dir, 1);
	    $j = 0;
	    foreach($files as $fileName/* File in directory */){
			if($files[$j] == 'about_uploads_folder.txt.txt' || $files[$j] == '.' || $files[$j] == '..'){
				//Don't add a load option
			}else{
				if($name == $fileName){
					$fileAlreadyExists = TRUE;	
				}
			}
			$j++;
			
	    }
		//---------------------
		if($fileAlreadyExists = FALSE){
			$uploaded = move_uploaded_file($tmp_name, 'uploads/'.$name);
			echo "<script type='text/javascrpt'>
					console.log('file uploaded');
				</script>";
		}else{
				echo "<script type='text/javascrpt'>
					console.log('file was not uploaded, already existed');
				</script>";
		}
		
		if(DEBUG){
			//comment out other debug die statements to make this work
			if($uploaded){
				die(file_get_contents('uploads'.'/'.$name));
			}else{
				die($tmp_name);	
			}
		}
}

function bothMethods(){
	redirect('index.php?msg=sameName');	
}

function existingFileContent(){
	global $fileName;
	global $fileContent;
	global $uploadPath;
	$fileContent = file_get_contents($uploadPath.$fileName);	
}


function makeFileLines(){
	global $fileLines;
	global $fileContent;
	$fileLines = explode("\n", $fileContent);
}


function makeHTML($lines){
	//Create Data Variables
		global $time;
		global $date;
		global $chartType;
		global $fahrenheit;
		global $celcius;
		global $titleName;
		global $yAxisTitle;
		
		$j = 0;
		foreach($lines as $value){
			//make cells a multidimensional array with elements for each cell in the csv file 
			$cells[$j] = explode(",", $lines[$j]);
			$j++;
		}
		
		$k = 0;
		foreach($cells as $value){
			foreach($value as $secondvalue){
				if($secondvalue == $cells[$k][0]){
					array_push($date, $secondvalue);
					//Need to format date properly
				}else if($secondvalue == $cells[$k][1]){
					array_push($time, $secondvalue);
				}else if($secondvalue == $cells[$k][2]){
					array_push($celcius, $secondvalue);	
				}else if($secondvalue == $cells[$k][3]){
					array_push($fahrenheit, $secondvalue);
				}
			}
		$k++;
		}
		
		
		//Get rid of quotation marks in array values
		$p = 0;
		foreach($celcius as $value){
			str_replace('"'," ",$celcius[$p]);
			$p++;
		}	

		$jsonC = json_encode($celcius, JSON_NUMERIC_CHECK);
		$jsonF = json_encode($fahrenheit, JSON_NUMERIC_CHECK);
		$jsonD = json_encode($date);
		//die(print_r($date).print_r($time).print_r($celcius).print_r($fahrenheit));
		
		
	$html = "<DOCTYPE html>
			<html>
			<head>
				<meta charset='utf-8' />
				<title>Enjoy your cool graph...</title>
					<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>
					<script src='http://code.highcharts.com/highcharts.js'></script>
					<script src='http://code.highcharts.com/modules/exporting.js'></script>
					<script src='http://code.jquery.com/jquery-1.11.1.min.js'></script>
					<script type='text/javascript' name='chartCode'>
					//Script for displaying a chart, printing it, and downloading it
						//DeviceReady event handling
						$(document).on('pageinit', deviceReady);
						function deviceReady(){
							console.log('DeviceReady Function fired');
						}
						console.log('In chart js from echo.php');

						//Define variables
						

						//Create Functions
						function Print(){
							chart.setTitle(null, { text: ' ' });
						    chart.print();
						    chart.setTitle(null, { text: 'Click and drag in the plot area to zoom in' });
						}
						
						function generateChart(chartToPass){
								return chartToPass;
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

						//Define initial skeleton for chart
						var options = {
							chart:{
								renderTo: 'container',
								defaultChartType: 'column',
								type: '".$chartType."',
								zoomType: 'x'
							},
							title:{
								text: '".$titleName."',
								x: -20
							},
							xAxis:{
								categories: ".$jsonD."
							},
							yAxis:{
								title:{
									text: '".$yAxisTitle."'
								}
							},
							series: [{
										name:'Celsius',
										data:".$jsonC."
									 },
									{
										name:'Fahrenheit',
										data:".$jsonF."
									}]
							};

						//Buttons and Processes
							//Display chart process
							$(function(){
									var chart = new Highcharts.Chart(options);
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
					
			</body>
			</html>";
		
		echo $html;
		
}