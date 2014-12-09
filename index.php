<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Input File</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
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
                <form id="graphChoice" name="fileInput" onSubmit="validate()" action="main.php?action='load'&fileName='bob.csv'" enctype="multipart/form-data" method="GET">
                	<!-- Restrict file uploads that will fail -->
                	<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                    <!-- Name of input element for upload determines name in the $_FILES array -->
                    <input id="fileSelect" data-role="button"  data-inline="true" type="file" name="file" onChange="checkIfFile()">
                    <select id="loadFile" data-role="button" type="file" name="file">
                    	<!-- Add dropdown items for every file in the uploads directory, based on Title csv file metadata -->
                  		<option id="defaultLoad" value="default" selected="selected">Choose a previously saved file...</option>
                        <?php
						//Generate options for selection list based on previously saved files
						   $dir = 'uploads';
						   $files = scandir($dir, 1);
						   $j = 0;
						   foreach($files as $fileName/* File in directory */){
								if($files[$j] == 'about_uploads_folder.txt.txt' || $files[$j] == '.' || $files[$j] == '..'){
									echo "<script type='text/javascript'>console.log('Found invalid File in Repetition #".$j."');</script>";
								}else{
									echo "<option name='".$fileName."' value='load_".$fileName."'>".$fileName."</options>";
								}
								$j++;
						   }
						?>
                    	<!-- Input php selection list generation here -->
                    </select>
                    <select id="ExportOption">
                    	<option value="default" selected="selected">Export Option</option>
						<option value="PNG">PNG Image</option>
  						<option value="JPEG">JPEG Image</option>
  						<option value="PDF">PDF Document</option>
  						<option value="SVG">SVG Vector Image</option>
					</select>
                    <button id="buttonExport">Export chart</button><button id="buttonPrint">Print chart</button>
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
               
                    <input type="submit" data-role="button" value="Submit" id="fileSubmit">  
            	 	 
                </form>
                
            </div>
            <!-- The highcharts graph will render inside this container -->
            <div id="container" style="width:100%; height: 400px;">
            	
            </div>
        </div>

        
    </body>
    
    
</html>


