<?php
//Main PHP Page for the mathStats website
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	require_once('common.php');
	
//Process Form Submit
	$uploadPath = "uploads/";
	
	//Deal with Charttype and Radio Buttons
	//Create a variable with the selected value
	$radio = $_POST['chartType'];
	//Echo first line of Ajax for chartType
	if($radio == 'pie'){
		echo 1 . "<br />";
	}else if($radio == 'line'){
		echo 2 . "<br />";
	}else if($radio == 'bar'){
		echo 3 . "<br />";
	}

	//Escape uploaded files for security
	$postFileName = escape_html($_POST['load'], ENT_QUOTES, 'utf-8');

	//Start Load/upload processes
		 //LOAD option
		 if(array_key_exists('load', $_POST)){
			//Use chosen file in filesystem for chart generation
		 	$chosenFile = $uploadPath.$postFileName;
			if(file_exists($uploadPath.$postFileName){
				echo "<script type='text/javascript'>alert('The file you chose to load DOES exist.');</script>";
			}
		 
		 //UPLOAD option
		 }else if($_FILES['file']['type'] == "csv"){
			//Make sure the file type is csv
			//Move the file to our file system from the POST array
			move_uploaded_file($_FILES["file"]["tmp_name"], /* I removed mathStats from the filePath here */"uploads");
			echo "<script type='text/javascript'>alert('Uploading: " . $_FILES['file']['name'] . "');</script><br />";
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
	
	//Parse the uploaded or loaded file and then create a variable with the contents of the csv file
		//Load option parsing
		if(array_key_exists('action', $_POST) && $_POST['action'] == 'load'){
			//Fetch from local filesystem
			$fileContent = file_get_contents("uploads/".$postFile);
		}else{
		//Upload option parsing
			//Fetch from uploaded file
			$fileContent = file_get_contents($chosenFile);
		}

		//Create array holding each line of text from csv file
		$fileLines = explode("\n", $fileContent);
		//Create multidimensional array for each cell in the file
		//If a valid file exists
		if((array_key_exists('action', $_POST) && $_POST['action'] == 'load') || array_key_exists($_FILES['file'])){
			$i = 0;
			while($i < count($fileLines)){
				//As long as there are still more lines in the file to iterate through...
				$fileCells = array();
				$fileCells += explode(",", $fileLines[i]);
				//Put results into console for debugging
				echo "<script type='text/javascript'>console.log(".$fileCells.")</script>";
				//The above code is not seeming to run
			}
		}else{
		//If no valid file exists
		//This modifier is preventing the necessary variables from being set when not submitting a file
		//i.e. This is making debugging hard
		 echo "No file detected...";
		}
		
		//Make array holding all the values for Celcius and Fahrenheit
		$k = 0;
		while($k > count($fileLines)){
			$j = 0;
			while($j > count($fileCells/* Cells 2 and 4 for each line need to be selected*/)){
				$date = array();
				$time = array();
				$celcius = array();
				$fahrenheit = array();
				if($j == 0){
					$date += $fileCells[$k][$j];
				}else if($j == 1){
					$time += $fileCells[$k][$j];
				}else if($j == 2){
					$celcius += $fileCells[$k][$j];
				}else if($j == 3){
					$fahrenheit += $fileCells[$k][$j];
				}
				$j++;
			}
			$k++;
		}
		
		//Set up format for data array to be echoed for final ajax call
		$data = array();
		$data[0] = $date;
		$data[1] = $time;
		$data[2] = $celcius;
		$data[3] = $fahrenheit;
		//Kill page and print $data array to make sure format is correct before making the ajax call
		die(print_r($data));

		/*The page should display as follows...
		
		1    --(Radio button value for chartType)
		0,5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85,90,95,100       --(xAxis incrementing values for temperature in both Celcius and Fahrenheit)
		12/16/14      --(For use in titleName)
		Need to figure out rest
		
		*/
		//Final Echo for Ajax Call
		echo $data;
