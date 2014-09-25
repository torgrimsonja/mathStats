// JavaScript Document 
//This code is likely to be the main.js file eventually

//Need to set correct file url in the ajax function
//Three remaining variables to get from the csv file -- need to figure out which element of which array they will be, then set them accordingly, likley in the processData function
var titleName = asdf;
var yAxisTitle = asdf;


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
	//Create the chart
	var chart = new Highcharts.Chart(options);
}

//Create chart
//Change ready function to on submit/when the php gets done
$.(document).ready(function (){
	
	var chartType = $().selected;

	$.ajax({ 
	
	
		type: "POST", 
		url: "../index.html",		//Need to add the correct url
		dataType: "csv", 
		success: function(data){
			processData(data);
		}
	});

});