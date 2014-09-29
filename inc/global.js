// JavaScript Document
	$(document).on('pageinit', function() {
		console.log('Ready event fired');
		
		//$('#fileSubmit').bind('click', clicked());
		
		dothis();
	});
	
	//This function will be used to submit file
	function dothis(){
		$("#help").click(function(){
			alert("Choose your file and graph type. Next click submit and watch as your graph is printed out on screen.");	
		});
		
		$( "#graphChoice" ).submit(function( event ) {
			console.log( "Handler for .submit() called." );
			event.preventDefault();
			validate();
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
			location.reload();
			return 1;
		}
		else if(choice2.is(':checked')){				//If choice two is selected, then an alert is sent and page is reloaded.
			location.reload();
			return 2;
		}
		else if(choice3.is(':checked')){				//If choice three is selected, then an alert is sent and page is reloaded.
			location.reload();
			return 3;	
		}
		else{											//If no choice is selected, then a error alert is sent and page is reloaded.
			alert('You need to choose a graph...');	
			location.reload();
		}
		
		
	}
	
	
	//Title and yAxis title still need to be defined!!!!!!!!!!!!!!!!!!!!
	var titleName = asdf;
	var yAxisTitle = asdf;
	var data = asdf;  //This variable needs to come from the php somehow i think
	
	
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
		series: []
	};
	
	function processData(data){
		//Split the rows
		var dataRows = data.split("\n");
	
		//Iterate over the lines and add categories or series
		$.each(lines, function(lineNum, line){
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
	if(validate() == 1){
		
		var chartType = 'pie';
	
		$.ajax({ 
		
		
			type: "POST", 
			url: "../index.html",		//Need to add the correct url
			dataType: "csv", 
			success: function(data){
				processData(data);
			}
		});
	
	}
	else if(validate() == 2){
		var chartType = 'line';
		
		$.ajax({ 
		
		
			type: "POST", 
			url: "../index.html",		//Need to add the correct url
			dataType: "csv", 
			success: function(data){
				processData(data);
			}
		});
		
	}
	
	else if(validate() == 3){
		var chartType = 'bar';
		
		$.ajax({ 
		
		
			type: "POST", 
			url: "../index.html",		//Need to add the correct url
			dataType: "csv", 
			success: function(data){
				processData(data);
				$(function(options){
					$('#container').highcharts({
						//Map the generated chart to the container div for display
						//Currently attempting to pass the options through the parent function to see if it will generate the chart
					});
				});
			}
		});
	}
		
