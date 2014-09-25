<?php
	//The purpose of this file is to allow the MathStats App to save CSV files so that charts may be recreated with them at a later time
	
	//Get file from html form upload
	if($_FILES["file"]["error"] > 0){
		  //Set up file upload error reporting
		  echo "Error: " . $_FILES["file"]["error"] . "<br />";
	}else{
		  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		  echo "Type: " . $_FILES["file"]["type"] . "<br>";
		  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		  echo "Stored in: " . $_FILES["file"]["tmp_name"];
	}
	//Read file and create a title from it based on a set of conditions
	
	//Save the file in a common folder with the generated name
	
	//Set up Load File functionality
	

?>