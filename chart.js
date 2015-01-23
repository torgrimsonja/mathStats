//Script for displaying a chart, printing it, and downloading it
$(document).on('pageinit', deviceReady);
//Set the code for the chart to a variable
var chart = new Highcharts.Chart(options);
console.log("In chart.js");

function deviceReady(){
	console.log("Crap should happen twice theoretically");
}

//Ajax call to get JSON string for options variable
$.ajax({ 
		type: "POST",
		url: "ajax.php",
		dataType: "json",
		success: function(data){
			console.log('Ajax successful inside chart.js');
			processData(data);
		},
		error: function(jqXHR, textStatus, errorThrown) {
  			console.log(textStatus, errorThrown);
		}
	});

//Start code for highcharts
//Define necessary variables for chart options that are static
var dataLines = data.split("\n");
var titleName = "Temperature for "+dataLines[2];
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

//Chart Type Assignment Received From Ajax Call
var dataLines = data.split('\n');
var radioNum = dataLines[0];	

//Chart Type/Display
if(radioNum == 1){
	var chartType = 'pie';
	$(function(){						
		$('#container').highcharts({
			//Map the generated chart to the container div for display
		});
	});s
}
else if(radioNum == 2){
	var chartType = 'line';
	$(function(){						
		$('#container').highcharts({
			//Map the generated chart to the container div for display
		});
	});
}
else if(radioNum == 3){
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
$('#buttonPrint').click(function(){
	console.log('User clicked the Print button');
	Print();
});

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

//This is the code for downloading a chart.
//Downloading Module Code
function userDownload(){
	var d = document.getElementById("ExportOption");
    var ExportAs = d.options[d.selectedIndex].value;
    if(ExportAs == 'PNG')
    {
        chart.exportChart({type: 'image/png', filename: titleName}, {subtitle: {text:''}});
    }
    if(ExportAs == 'JPEG')
    {
        chart.exportChart({type: 'image/jpeg', filename: titleName}, {subtitle: {text:''}});
    }
    if(ExportAs == 'PDF')
    {
        chart.exportChart({type: 'application/pdf', filename: titleName}, {subtitle: {text:''}});
    }
    if(ExportAs == 'SVG')
    {
        chart.exportChart({type: 'image/svg+xml', filename: titleName}, {subtitle: {text:''}});
    }
}
$('#downloadButton').click(function (){
	console.log('User clicked the Download Button');
	userDownload()

});