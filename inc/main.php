<?php
	//The purpose of this file is to allow the MathStats App to save CSV files so that charts may be loaded for reuse at a later time
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	require_once('../common.php');
	
	//Get file from html form upload
	$uploadPath = "../uploads/";
		
		 //LOAD option
		 if(array_key_exists('action', $_GET) && $_GET['action'] == 'load'){
			//Use chosen file in filesystem for chart generation
		 	$chosenFile = $uploadPath.$_GET['fileName'];
			if(file_exists($uploadPath.$_GET['fileName'])){
				echo "The file you chose to load DOES exist.";
			}
		 
		 //UPLOAD option
		 }else if($_FILES['file']['type'] == "csv"){
			//Make sure the file type is csv
			//Move the file to our file system from the POST array
			move_uploaded_file($_FILES["file"]["tmp_name"], /* I removed mathStats from the filePath here */"uploads");
			echo "Uploading: " . $_FILES['file']['name'] . "<br />";
			 //Check that it is in the uploads folder
			 if(file_exists($uploadPath . $_FILES["file"]["name"])){
				 echo "Upload successful.";
				 $chosenFile = $_FILES['file']['name'];
			 }else{
				 echo "Upload failed.";
			 }
		 }else{
			//Deal with non-csv files or no files at all
			echo "Invalid file, please try again... <script type='text/javascipt'>console.log('Invalid File Upload in php');</script>";
		 }
	
	//Set up variables and whatnot to pass to JS
		//Parse data
		//Create a variable with the contents of the csv file
		if(array_key_exists('action', $_GET) && $_GET['action'] == 'load'){
			//Fetch from local filesystem if load option chosen
			$fileContent = file_get_contents("uploads/".$chosenFile);
		}else{
			//For normal upload option
			$fileContent = file_get_contents($chosenFile);
		}
		//Create array holding each line of text from csv file
		$fileLines = explode("\n\r", $fileContent);
		//Create multidimensional array for each cell in the file
		if((array_key_exists('action', $_GET) && $_GET['action'] == 'load') || array_key_exists($_FILES['file'])){
			$i = 0;
			while($i < array_count_values($fileLines)){
				//As long as there are still more lines in the file to iterate through...
				$fileCells = array();
				$fileCells += explode(",", $fileLines[i]);
				//Put results into console for debugging
				echo "<script type='text/javascript'>console.log(".$fileCells.")</script>";
			}
		}else{
		 echo "No file detected...";
		}
		//Make array holding all the values for Celcius and Fahrenheit
		$k = 0;
		while($k > array_count_values($fileLines)){
			$j = 0;
			while($j > array_count_values($fileCells[]/* Cells 2 and 4 for each line need to be selected*/)){
				$tempCells = array();
				$tempCells += $fileCells[$k][$j];
			}
		}
		//Make arrays for Celcius and Fahrenheit respectively
		
		//Data is already in the necessary format and now I just need to echo it in order for the AJAX call to get it
		echo $data;
		
?>