// JavaScript Document
	$(document).on('pageinit', function() {
		console.log('Ready event fired');
		//$('#fileSubmit').bind('click', clicked());
	});
	//Page Level Functions
	//This function will be used to submit file
	function checkIfFile(){
		console.log("In checkIfFile");
			 fileName = $("#fileSelect").val();
			if(fileName != ""){
				checkName(fileName);
			}
	}
	function checkName(file){
		console.log("In checkname function");
		console.log("This is the filePath..." + file);
		var fileName = file.replace('/^.*[\\\/]/', '');
		$.ajax({ 
			type: "GET", 
			url: "inc/ajax.php?action=checkName&name="+fileName,		
			success: function(result){
				console.log('Ajax call returned: '+result);
				if(result == 'Invalid'){
					document.getElementById('errorFileName').style.display="inline";
				  document.getElementById('errorFileName').innerHTML = 'File name taken...rename your file and try again.';
				}
			}
		});
	}
	//This funtion will check to see if a graph type is selected
	function validate(){
		console.log('In validate()');
		var selected = $('#fileSelect').val();
		var choice1 = $("#choice1");
		var choice2 = $("#choice2");
		var choice3 = $("#choice3");
		if(choice1.is(':checked')){						//If choice one is selected, then an alert is sent and page is reloaded.
			console.log("One");
            return 1;
		}
		else if(choice2.is(':checked')){				//If choice two is selected, then an alert is sent and page is reloaded.
			console.log("Two");
            return 2;
		}
		else if(choice3.is(':checked')){				//If choice three is selected, then an alert is sent and page is reloaded.
			console.log("Three");
            return 3;
		}
		else{
			console.log("Nothing");											//If no choice is selected, then a error alert is sent and page is reloaded.
			alert('You need to choose a graph...');	
			window.refresh();
		}
	}
	function processData(data){
		console.log("Inside processData function");
		//Select proper items for highcharts options that are echoed by php and passed via ajax
		//Need temperature 
		
		/*  This code is no longer needed because parsing is being done by php
		//Split the rows
		var dataRows = data.split("\n");
		//Iterate over the lines and add categories or series 
		$.each(dataRows, function(lineNum, line){
			var items = line.split(',');	
			//header line contains categories
			if(lineNum == 0){
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
		}); */
	}