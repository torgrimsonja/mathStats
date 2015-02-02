<?php
require_once('common.php');


//Handle save file name check
if(	array_key_exists('action', $_GET) &&
	$_GET['action'] == 'checkName' &&
	array_key_exists('name', $_GET)
	){
	if(file_exists("uploads/".$_GET['name'])){
	   echo "Invalid";
	}else{
		echo "Valid";
	}
	exit();
}

//Functions
function storeFile(){
		move_uploaded_file($_FILES["file"]["name"], "uploads");
		echo "<script type='text/javascript'>alert('Uploading: " . $_FILES['file']['name'] . "');</script><br />";
		 //Check that it is in the uploads folder
		if(file_exists($uploadPath . $_FILES["file"]["name"])){
			echo $_FILES["file"]["name"];
			echo "<script type='text/javascript'>alert('".$_FILES['file']['name']." was uploaded');</script><br />";
		}else{
			echo "<script type='text/javascript'>alert('ERROR');</script><br />";

		}

}

function getFileData($filename){
	$chosenFile = $_FILES['file']['name'];
	$fileContent = file_get_contents($chosenFile);
	$jsonString = json_encode($fileContent);
	echo $jsonString;
}

//Run Upon Submit
if(	array_key_exists('file', $_GET) &&
	array_key_exists('chartType', $_GET)
	){
	$fileName = escape_html($_GET['file']);
	$chartType= escape_html($_GET['chartType']);

	storeFile();
	
	getFileData($fileName);

}
