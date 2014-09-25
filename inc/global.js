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
	
	function validate(){
		console.log('In validate()');
		valid = true;

		var selected = $('#fileSelect').val();
		var choice1 = $("#choice1");
		var choice2 = $("#choice2");
		var choice3 = $("#choice3");
		
		
		if(choice1.is(':checked')){
			alert('You chose the Pie Chart.');
			location.reload();
		}
		else if(choice2.is(':checked')){
			alert('You chose the Line Graph.');			
			location.reload();
		}
		else if(choice3.is(':checked')){
			alert('You chose the Bar Graph.');
			location.reload();	
		}
		else{
			alert('You need to choose a graph...');	
			location.reload();
		}
		
		
	}
		
