<!-- Need to figure out how to run this script once the file has been uploaded in conjunction with the jquery stuff -->
<?php
	//The purpose of this file is to allow the MathStats App to save CSV files so that charts may be loaded for reuse at a later time
	error_reporting(E_ALL);
	require_once('../common.php');
	$_FILES['file'];
	
	//Get file from html form upload
	$uploadPath = "../uploads/";
	
		 if(array_key_exists($_POST['load'])){
			//Use chosen file in filesystem for chart generation
		 	$chosenFile = $uploadPath.$_POST['load'];
		 	
		 
		 }else if($_FILES['file']['type'] == "csv"){		
			//Make sure the file type is csv
			//Move the file to our file system from the POST array
			move_uploaded_file($_FILES["file"]["tmp_name"], "mathStats/uploads");
			echo "Uploading: " . $_FILES['file']['name'] . "<br />";
			 //Check that it is in the uploads folder
			 if(file_exists($uploadPath . $_FILES["file"]["name"])){
				 echo "Upload successful.";
				 $chosenFile = $_FILES['file']['name'];
			 }else{
				 echo "Upload failed.";
			 }
		 }else{
			//Deal with non-csv files
			echo "Invalid file, please try again... <script type='text/javascipt'>console.log('Invalid File Upload in php');</script>";
		 }
	
	//Set up variables and whatnot to pass to JS
		//??parse data??
		
		
		
		//Data is already in the necessary format and now I just need to echo it in order for the AJAX call to get it
		if($_GET['action'] == "printGraph"){
			exit();
			echo $data;
		}
	
?>