//Script for displaying a chart, printing it, and downloading it

//Set the code for the chart to a variable
var chart = new Highcharts.Chart(options);

//Ajax call to get JSON string for options variable
$.ajax({ 
		type: "POST",
		url: "ajax.php",
		dataType: "text",
		success: function(data){
			alert('fish');
			processData(data);
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