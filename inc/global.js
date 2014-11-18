// JavaScript Document
	$(document).on('pageinit', function() {
		console.log('Ready event fired');
		//$('#fileSubmit').bind('click', clicked());
	});
	//This function will be used to submit file
	function checkIfFile(){
		console.log("In checkIfFile");
			var i=0;
			var fileName = $("#fileSelect");
			while(i==0){
				console.log("In loop to check if filename is Null");
				if(fileName != ""){
					checkName();
					i++;
				}
				
			}
	}
	
	
	function checkName(){
		console.log("In checkname function");
		var filePath = $("#fileSelect").val;
		console.log("This is the filePath..." + filePath);
		//var fileName = filePath.replace(/^.*[\\\/]/, '');
		$.ajax({ 
			type: "GET", 
			url: "../ajax.php?action=checkName&name="+fileName,		
			success: function(result){
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
			dothis();
		}
	}

	//Title and yAxis title still need to be defined!!!!!!!!!!!!!!!!!!!!
	var dataLines = data.split("\n");
	var titleName = dataLines[0];
	var yAxisTitle = "Temperature";

	//Define initial skeleton for chart
	var options = {
		chart:{
			renderTo: 'container',
			defaultChartType: 'column',
			type: chartType
		},
		title:{
			text: titleName
		},
		xAxis:{
			categories: []
		},
		yAxis:{
			title:{
				text: yAxisTitle	
			}
		},
		series: [{
					name:"Celsius",
					data:[]
				 },
				{
					name:"Fahrenheit",
					data:[]
				}]
	};
	function processData(data){
		console.log();
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
		});
		//Set the code for the chart to a variable
		var chart = new Highcharts.Chart(options);
	}	
	//Create chart
	//Run this code once the csv file has been submitted and a chart type chosen
	$.ajax({ 
			type: "POST", 
			url: "inc/main.php",		//Need to add the correct url
			dataType: "text", 
			success: function(data){
				processData(data);
			}
		});
	if(validate() == 1){
		var chartType = 'pie';
		$(function(){						
					$('#container').highcharts({
						//Map the generated chart to the container div for display
					});
				});
	}
	else if(validate() == 2){
		var chartType = 'line';
		
	}
	else if(validate() == 3){
		var chartType = 'bar';
		
	}