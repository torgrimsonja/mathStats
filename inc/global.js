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
		if($("#container").visible){
			console.log("Saw container as visible");
		   $("#container").hide();
		}
	}	
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
		
	}
	else if(validate() == 3){
		var chartType = 'bar';
		
	}
	//Export Module Code
	function Export(){
		var e = document.getElementById("ExportOption");
        var ExportAs = e.options[e.selectedIndex].value;
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
	$('#buttonExport').click(Export());
	//Print Module Code
	function Print(){
		chart.setTitle(null, { text: ' ' });
        chart.print();
        chart.setTitle(null, { text: 'Click and drag in the plot area to zoom in' });
	}
	$('#buttonPrint').click(Print());