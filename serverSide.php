<?php
	//The purpose of this file is to allow the MathStats App to save CSV files so that charts may be recreated with them at a later time
	
	//Get file from html form upload
		
		if ($_FILES["file"]["type"] == "csv"){
			//Make sure the file type is csv
			  if (file_exists("upload/" . $_FILES["file"]["name"])) {
					  echo $_FILES["file"]["name"] . " already exists. ";
				} else {
					  move_uploaded_file($_FILES["file"]["tmp_name"],
					  "upload/" . $_FILES["file"]["name"]);
					  echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
				}
		 } else {
			//Deal with non-csv files
			echo "Invalid file";
		 }
	//Read file and create a title from it based on a set of conditions
	
	//Save the file in a common folder with the generated name
	
	//Set up Load File functionality
	

?>