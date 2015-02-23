<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MathStats App</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/index.css" />
        <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    	<script type="text/javascript" src="inc/global.js"></script>
    </head>
    
    <body>
    	<div id="index" style="width: 100%;">
        	<script type="text/javascript">
			 	console.log('index loaded');
			</script>

        	<div id="content">
            	
                <div id="header">
                    <h1>Math Stats</h1>
                    <hr />
                </div>
                
                	<form data-ajax="false" id="formFileSubmit" method="post" action="echo.php" enctype="multipart/form-data">
                        
                        <!-- Restrict file uploads that will fail -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                        <!-- Name of input element for upload determines name in the $_FILES array -->
                        <div id="selectFileDiv">
                        	<input id="fileSelect" type="file" name="newFile" onChange="checkIfFile()" />
                        </div>
                        <div id="existingFileDiv">
                            <select id="loadFile" data-role="button" type="file" name="existingFile" data-native-menu="false" onChange="previousFile()">
                                <!-- Add dropdown items for every file in the uploads directory, based on Title csv file metadata -->
                                <option name="loadList" id="defaultLoad" value="default" selected="selected">Choose a previously saved file...</option>
                                <?php
                                //Generate options for selection list based on previously saved files
                                   $dir = 'uploads';
                                   $files = scandir($dir, 1);
                                   $j = 0;
                                   foreach($files as $fileName/* File in directory */){
                                        if($files[$j] == 'about_uploads_folder.txt.txt' || $files[$j] == '.' || $files[$j] == '..'){
                                            //Don't add a load option
                                        }else{
                                            echo "<option name='load' value='".$fileName."'>".$fileName."</options>";
                                            echo '<br />';
                                        }
                                        $j++;
                                        
                                   }
                                ?>
                                <!-- Input php selection list generation here -->
                            </select>
                        </div>
                        <!-- Radio buttons below currently not rendering -->
                        <div id="radioButtonDiv">
                            <fieldset  data-role="controlgroup">
                                    
                                    Choose the type of chart/graph you would like.
                                    <input type="radio" name="chartType" id="radio-choice-1" value="pie" checked="checked">
                                    <label for="radio-choice-1">Pie Chart</label>
                             
                                    <input type="radio" name="chartType" id="radio-choice-2" value="line">
                                    <label for="radio-choice-2">Line Graph</label>
                             
                                    <input type="radio" name="chartType" id="radio-choice-3" value="column">
                                    <label for="radio-choice-3">Bar Graph</label>
                             
    
                       
                            </fieldset>   
                        </div>
                        <div id="submitButtonDiv" style="width: 75%; margin-left: auto; margin-right: auto;">
                        	<input type="submit" value="Go" id="indexFileSubmit" style="width: 50%;" onClick=""></button>
                        </div>
                    </form>
                 
                </div>
                
            
        </div>
    </body>
    
    
</html>


