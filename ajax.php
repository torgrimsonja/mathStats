<?php

//Handle save file name check
if(	array_key_exists('action', $_GET) &&
	$_GET['action'] == 'checkName' &&
	array_key_exists('name', $_GET)
	){
	
	//look at the folder to see if a file with that name exists
	if(file_exists("uploads/".$_GET['name'])){
	   echo 'Invalid';
	}else{
		echo 'Valid';	
	}
	exit();
}

//This function should run as the ajax call is made
function storeFile(){
			move_uploaded_file($_FILES["file"]["tmp_name"], "uploads");
			echo "<script type='text/javascript'>alert('Uploading: " . $_FILES['file']['name'] . "');</script><br />";
			 //Check that it is in the uploads folder
			if(file_exists($uploadPath . $_FILES["file"]["name"])){
				echo $_FILES["file"]["name"];
			}else{
				echo "ERROR";
			}
}

function getFileData($filename){
	
}


