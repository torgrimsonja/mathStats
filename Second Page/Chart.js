//Script for displaying a chart and printing it.

//Set the code for the chart to a variable
var chart = new Highcharts.Chart(options);

//Start code for highcharts
//This may need to by moved to an external file to prevent it from initializing the chart on startup.
//Define necessary variables for chart options that are static
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

//Ajax call to php fetching data that has already been parsed in php
$.ajax({ 
		type: "POST",
		url: "inc/main.php",
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
	$(function(){						
		$('#container').highcharts({
			//Map the generated chart to the container div for display
		});
	});
}
else if(validate() == 3){
	var chartType = 'bar';
	$(function(){						
		$('#container').highcharts({
			//Map the generated chart to the container div for display
		});
	});
}

//Print Module Code
function Print(){
	chart.setTitle(null, { text: ' ' });
    chart.print();
    chart.setTitle(null, { text: 'Click and drag in the plot area to zoom in' });
}
$('#buttonPrint').click(Print());