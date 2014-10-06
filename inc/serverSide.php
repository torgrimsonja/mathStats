<!-- Need to figure out how to run this script once the file has been uploaded in conjunction with the jquery stuff -->
<?php
	//The purpose of this file is to allow the MathStats App to save CSV files so that charts may be recreated with them at a later time
	
	//Get file from html form upload
		$fileUpload = array();
		$fileUpload[]= $_FILES[];
		
		 if($_FILES['file']['type'] == "csv"){
			//Make sure the file type is csv
			    if (file_exists("".$_FILES["file"]["tmp_name"]."")) {
					  echo $fileUpload."already exists. ";
				}else{
					  //move_uploaded_file(string $filename, string $destination);
					  //Will need to make sure that this function is pointed to the correct location and that the uploads folder can simply be local... it probably cant
					  move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $_FILES["file"]["name"]);
					  echo "Uploading: " . $_FILES['file']['name'] . "<br />";
				}
		 }else{
			//Deal with non-csv files
			echo "Invalid file, please try again...";
		 }
	//Read file and create a title from it based on a set of conditions
	
	//Save the file in a common folder with the generated name
	
	//Set up Load File functionality
	
?>