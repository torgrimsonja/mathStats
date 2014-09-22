// JavaScript Document
$(document).on('pageinit', function() {
		console.log('Ready event fired');
		
		//$('#fileSubmit').bind('click', clicked());
		

});
	
	function dothis(){
		alert('foobar');	
	}
	
	function validate(){
		console.log('In validate()');
		alert('asdf');
		valid = true;

		if($("#fileSubmit").val() == ''){
			// your validation error action
			valid = false;

		}

		return valid //true or false
	}
	
	function clicked(){
		console.log('In clicked()');
		
		var selected = $('#fileSelect').val();
		var choice1 = document.getElementById('choice1');
		var choice2 = document.getElementById('choice2');
		var choice3 = document.getElementById('choice3');
		
		if(validate()){
			if(choice1.checked){
				alert('You have chosen the Pie Chart');
				
			}
			else if(choice2.checked){
				alert('You have chosen the Line Graph');
			}
			else if(choice3.checked){
				alert('You have chosen the Bar Graph');
			}		
		}
		else{
			alert('You need to choose a graph');
		}
		
		
		
	}