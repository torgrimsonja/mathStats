// JavaScript Document
	$(document).on('pageinit', function() {
		console.log('Ready event fired');
		//$('#fileSubmit').bind('click', clicked());
	});
	//Page Level Functions

	//Make sure the fileName is not null
	function checkIfFile(){
		console.log("In checkIfFile");
			 fileName = $("#fileSelect").val();
			if(fileName != ""){
				checkName(fileName);
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
	

	//Took out validate function as it is now located on chart.js and being completed in php

	//The Process Data Function takes the data from the Ajax call and sets it into variables for use in the highchart
	function processData(data){
		console.log("Inside processData function");
		//Split the rows
		var dataRows = data.split("\n");
		//Iterate over the lines and add categories or series 
		$.each(dataRows, function(lineNum, line){
			var items = line.split(',');	
			//Second line after radio button stuff contains categories
			if(lineNum == 1){
				$.each(items, function(itemNum, value){
					if(itemNum > 0){
						options.xAxis.categories.push(value);
					}
				});
			}else{
				//The rest of the lines contain data with their name in the first position
				var series = {
						data: []
				};
				$.each(items, function(itemNum, value){
						if(itemNum == 0){
							series.name = value;
						}else{
							series.data.push(parseFloat(value));
						}
				});
				options.series.push(series);
			}
		});
	}
	
	//Button code
	$("#indexFileSubmit").bind('click', function buttonPress(){
		//Capture all form element data
		console.log('indexFileSubmit button clicked');
		var data = {'loadFile': $('#loadFile').val(),
					'chartType': $('#chartType').val(),
					};
		//Ajax request to switch pages once data is obtained to populate the graph
		$.ajax({
		  type: "POST",
		  url: 'ajax.php',
		  data: data,
		  success: function(result){
			  //Preload all the crap in the display page elements
			  //http://demos.jquerymobile.com/1.0b2/docs/pages/page-cache.html
			  $.mobile.loadpage("#display");
			  
			  //Transition to the display page
			  $.mobile.changePage( "#display", { transition: "flip"});
		 	  
		  },
		  dataType: dataType
		});	
	});