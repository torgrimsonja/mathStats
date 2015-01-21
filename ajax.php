<?php
require_once('common.php');

//Handle save file name check
if(	array_key_exists('action', $_GET) &&
	$_GET['action'] == 'checkName' &&
	array_key_exists('name', $_GET)
	){
	
//Look at the folder to see if a file with that name exists
	if(file_exists("uploads/".$_GET['name'])){
	   echo 'Invalid';
	}else{
		echo 'Valid';	
	}
	exit();
}

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
	$chosenFile = $_FILES['file']['name'];
	$fileContent = file_get_contents($chosenFile);
	echo $fileContent;
}

//Run Functions
if(	array_key_exists('file', $_GET) &&
	array_key_exists('chartType', $_GET)
	){
	$fileName = escape_html($_GET['file']);
	$chartType= escape_html($_GET['chartType']);

	storeFile();
	
	getFileData($fileName);

}