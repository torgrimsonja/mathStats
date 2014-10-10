<!-- Need to figure out how to run this script once the file has been uploaded in conjunction with the jquery stuff -->
<?php
	//The purpose of this file is to allow the MathStats App to save CSV files so that charts may be loaded for reuse at a later time
	error_reporting(E_ALL);
	
	//Get file from html form upload
	$uploadPath = "mathStats/uploads/";
					  
		 if($_FILES['file']['type'] == "csv"){
			//Make sure the file type is csv
			//Give the chart a name within our file system that cooreseponds to the date that it was uploaded in a YYYY/MM/DD format
			$_FILES["file"]["name"] = date("Y/m/d");
			
			    if(file_exists("".$_FILES["file"]["name"]."")) {
					//If more than one chart is saved on the same day...
					 //Alert the user to the changed name of their file, if neccessary
					 echo $_FILES["file"]["name"]."already exists, an underscore and incremented number will be added to the end of the file name.";
					 
					 /* $fileIncrement = while(file_exists($_FILES["file"]["tmp_name"])){
						//Code while loop to increment file names for uploads on the same day, as explained below 
					 }; */
					 
					 $_FILES["file"]["name"] = $_FILES["file"]["tmp_name"]."_".$fileIncrement;
					  
					  //For multiple file uploads on the same day, have it add an underscore and increment the file name
					  //EX:  upload1 == 9/5/14 && upload2 == 9/45/14_1
				}else{
					  //move_uploaded_file(string $filename, string $destination);
					  //Will need to make sure that this function is pointed to the correct location and that the uploads folder can simply be local... it probably cant
					  //Upload file to proper location with a name that is based off of the date of the upload
					  $_FILES["file"]["name"] == 
					  move_uploaded_file($_FILES["file"]["tmp_name"], "mathStats/uploads"); //Location needs changed
					  echo "Uploading: " . $_FILES['file']['name'] . "<br />";
					  if(file_exists($uploadPath . $_FILES["file"]["name"])){
						 echo "Upload successful.";
					  }else{
						 echo "Upload failed.";
					  }
				}
		 }else{
			//Deal with non-csv files
			echo "Invalid file, please try again...";
		 }
		 
	//Set up Load File functionality
	
?>