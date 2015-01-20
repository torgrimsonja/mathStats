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
			if(file_exists($uploadPath.$postFileName)){
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
	
	//Convert File to JSON string and output
	if(array_key_exists('action', $_POST) && $_POST['action'] == 'load'){
		//Fetch from local filesystem
		$fileContent = file_get_contents("uploads/".$postFile);
	}else{
		//Fetch from uploaded file
		$fileContent = file_get_contents($chosenFile);
		
	}
	
	echo $data;
		
