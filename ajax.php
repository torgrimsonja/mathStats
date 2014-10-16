<?php

//Handle file name check
if(	array_key_exists('action', $_GET) &&
	$_GET['action'] = 'checkName' &&
	array_key_exists('name', $_GET)
	){
	
	//look at the folder to see if a file with that name exists
	if(file_exists("uploads/".$_GET['name'])){
	   echo "Invalid";
	}
}