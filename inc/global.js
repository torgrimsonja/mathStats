// JavaScript Document
	$(document).on('pageinit', deviceReady);
	//Global Variables
	var files;
	var fileName;
	var chartType;
		
	
	function deviceReady(){
		$.mobile.ajaxEnabled = false;
		console.log('Ajax disabled.');
	}
	//Make sure the fileName is not null
	function checkIfFile(){
		console.log("In checkIfFile");
			var fileName = $("#fileSelect").val();
			if(fileName != ""){
				checkName(fileName);
			}
	}
	
	function previousFile(){
		console.log('In previousFile function');
		fileName = $("#loadFile").val();
		if(fileName == "default"){
			console.log('User changed the file back to default');
		}else{
			console.log('User is choosing to load '+fileName);
		}
	}
	
	//Prevent multiple files with the same name
	function checkName(file){
		console.log("In checkname function");
		console.log("This is the filePath..." + file);
		var fileName = file.replace('/^.*[\\\/]/', '');
		$.ajax({ 
			type: "GET", 
			url: "ajax.php?action=checkName&name="+fileName,		
			success: function(result){
				console.log('Ajax call returned: '+result);
				if(result == 'Invalid'){
					document.getElementById('errorFileName').style.display="inline";
				  document.getElementById('errorFileName').innerHTML = 'File name taken...rename your file and try again.';
				}
			}
		});
	}