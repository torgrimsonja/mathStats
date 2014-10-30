<?php
	//Common.php file includes all site-wide functions and required resources
	function redirect($path){
		header("Location:".$path);	
		exit();
	}
?>