//Main JS File used for Storing Chart Code
	//Link to Jquery and highcharts API -- needs to be put on html display page
	/*<script type="text/javascript" src="jquery/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="jquery/highcharts.js"></script> */
//Chart Setup Logic Functions
	function setCategory(numCategory, categories){
		if(numCategory >= 1){
			catOutput == new Array();
			//Set array to categories passed in through html form
		}else{
			alert("Sorry... You didn't input your categories.  Please retry.");
		}
		return catOutput;
	}

	function setSeries(seriesName, seriesData){
		i=0;
		while(numSeries >= i){
				
		}
	}

//Different Chart Types Set up Here
	var lineChart = 
	$(function () { 
		$('#container').highcharts({
			chart: {
				type: 'line'
			},
			title: {
				text: ''+title+''
			},
			xAxis: {
				categories: [setCategory()]
			},
			yAxis: {
				title: {
					text: ''+yAxisTitle+''
				}
			},
			
			setSeries();
			series: [{
				name: ''+seriesName[i]+'',
				data: seriesData[i]
			}, {
				name: 'John',
				data: [5, 7, 3]
			}]
		
		});
	});
	
	//have all the bold variables above come from the array tanner sends us