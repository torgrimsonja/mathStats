<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MathStats App</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    	<script type="text/javascript" src="inc/global.js"></script>
    </head>
    
    <body>
    	<div data-role="page" id="index" style="width: 100%;">
        	<script type="text/javascript">
			 	console.log('index loaded');
			</script>

        	<div data-role="content">
            
                <div data-role="header">
                    <h1>Math Stats</h1>
                </div>
                	<form data-ajax="false" id="formFileSubmit" method="post" action="echo.php" enctype="multipart/form-data">
                        <!-- Restrict file uploads that will fail -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                        <!-- Name of input element for upload determines name in the $_FILES array -->
                        <input id="fileSelect" type="file" name="newFile" onChange="checkIfFile()" />
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
                        <!-- Radio buttons below currently not rendering -->
                        <fieldset  data-role="controlgroup">
                                
                                Choose the type of chart/graph you would like.
                                <input type="radio" name="chartType" id="radio-choice-1" value="pie" checked="checked">
                                <label for="radio-choice-1">Pie Chart</label>
                         
                                <input type="radio" name="chartType" id="radio-choice-2" value="line">
                                <label for="radio-choice-2">Line Graph</label>
                         
                                <input type="radio" name="chartType" id="radio-choice-3" value="bar">
                                <label for="radio-choice-3">Bar Graph</label>
                         

                   
                        </fieldset>   
                        <input type="submit"  data-role="button" value="Go" id="indexFileSubmit" onClick=""></button>
                    </form>
                 
                </div>
                
            
        </div>
    </body>
    
    
</html>


