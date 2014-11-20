<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Input File</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
        <!--
        	<script type="text/javascript" src="inc/jquery/jquery-2.1.1.min.js"></script>
    		<script type="text/javascript" src="inc/jquery/jquery.mobile-1.4.4.min.js"></script>
        -->
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.css">
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>
    	<script type="text/javascript" src="inc/global.js"></script>
        
        <!-- <link type="text/css" rel="stylesheet" href="inc/jquery/jquery.mobile-1.4.3.min.css"/> -->
 
    </head>
    
    <body>
    	<div data-role="page" id="index">
        	<script type="text/javascript">
			 	console.log('index loaded');
			</script>

        	<div data-role="content">
            
            <div data-role="header">
            	<h1>Math Stats</h1>
            </div>
            	<!-- Form that will allow uses to upload file and choose graph type -->
                <!-- File is sent to serverSide.php to be saved and processed -->
                <form id="graphChoice" name="fileInput" onSubmit="validate()" action="inc/main.php" enctype="multipart/form-data" method="POST">
                	<!-- Restrict file uploads that will fail -->
                	<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                    <!-- Name of input element for upload determines name in the $_FILES array -->
                    <input id="fileSelect" data-role="button" type="file" name="file" onChange="checkIfFile()"><span id="errorFileName" style="color: red; font-weight:bold; display:hidden;"></span>
                    <select id="loadFile" data-role="button" type="file" name="file">
                    	<!-- Add dropdown items for every file in the uploads directory, based on Title csv file metadata -->
                  		<option id="defaultLoad" value="default" selected="selected">Choose a previously saved file...</option>
                        <?php
						//Generate options for selection list based on previously saved files
						   $dir = "/uploads";
						   $files = scandir($dir);
						   foreach($files as $fileName/* File in directory */){
							echo "<option name='".$fileName."' value='load_".$fileName."'>".$fileName."</options>";
						   }
						?>
                    	<!-- Input php selection list generation here -->
                    </select>
                    <div class="ui-field-contain">
                    	<fieldset data-role="controlgroup">
                        	
                            <legend>Choose the type of chart/graph you would like.<br /><br />
                            		<a id="help" style="cursor: pointer;">Help?</a>
                            </legend>
                            <input type="radio" name="choice1" id="choice1" class="custom">
                          	<label for="choice1">Pie Chart</label>
                     
                            <input type="radio" name="choice1" id="choice2" class="custom">
                            <label for="choice2">Line Graph</label>
                     
                            <input type="radio" name="choice1" id="choice3" class="custom">
                            <label for="choice3">Bar Graph</label>
                     
                        </fieldset>
                    </div>
               
                    <input type="submit" data-role="button" value="submit" onClick="validate()" id="fileSubmit">  
            	 	 
                </form>
                
            </div>
            <!-- The highcharts graph will render inside this container -->
            <div id="container" style="width:100%; height: 400px;">
            	
            </div>
        </div>

        
    </body>
    
    
</html>


