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
			alert('You chose the Pie Chart.');
			location.reload();
		}
		else if(choice2.is(':checked')){				//If choice two is selected, then an alert is sent and page is reloaded.
			alert('You chose the Line Graph.');			
			location.reload();
		}
		else if(choice3.is(':checked')){				//If choice three is selected, then an alert is sent and page is reloaded.
			alert('You chose the Bar Graph.');
			location.reload();	
		}
		else{											//If no choice is selected, then a error alert is sent and page is reloaded.
			alert('You need to choose a graph...');	
			location.reload();
		}
		
		
	}
		
