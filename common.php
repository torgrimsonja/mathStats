<?php

	//Common.php file includes all site-wide functions and required resources
	function redirect($path){
		header("Location:".$path);	
		exit();
	}

	//Escape html entities to prevent hacks
	function escape_html($value){
		return htmlentities($value, ENT_QUOTES, 'utf-8');
	}

//Set true for debugging statements to show
define('DEBUG', FALSE);