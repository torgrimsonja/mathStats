<!-- Need to figure out how to run this script once the file has been uploaded in conjunction with the jquery stuff -->
<?php
	//The purpose of this file is to allow the MathStats App to save CSV files so that charts may be loaded for reuse at a later time
	error_reporting(E_ALL);
	
	//Get file from html form upload
	$uploadPath = "../uploads/";
					  
		 if($_FILES['file']['type'] == "csv"){
			//Make sure the file type is csv
			//Move the file to our file system from the POST array
			move_uploaded_file($_FILES["file"]["tmp_name"], "mathStats/uploads");
			echo "Uploading: " . $_FILES['file']['name'] . "<br />";
			 //Check that it is in the uploads folder
			 if(file_exists($uploadPath . $_FILES["file"]["name"])){
				 echo "Upload successful.";
			 }else{
				 echo "Upload failed.";
			 }
		 }else{
			//Deal with non-csv files
			echo "Invalid file, please try again...";
		 }
	
	//Set up variables and whatnot to pass to JS
		//??parse data??
		
		//Data is already in the necessary format and now I just need to echo it in order for the AJAX call to get it
		echo $data;
	
?>