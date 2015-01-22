<DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Enjoy your cool graph...</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>
    	<script type="text/javascript" src="inc/global.js"></script>
        <script type="text/javascript" src="chart.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.css">

</head>

<body>
<!-- The highcharts graph will render inside this container -->
            <div id="container" style="width:100%; height: 400px;">
                   
            </div>
            <!-- Below are exporting options -->
            <fieldset class="ui-grid-a">
                <!-- Print the Chart -->
                <div class="ui-block-a"><button id="buttonPrint" data-role="button">Print chart</button></div>
                <!-- Choose a Way to Save the Chart -->
                <div class="ui-block-b">
                    <select id="DownloadOption" data-native-menu="false">
                        <option value="default" selected="selected">Download As</option>
                        <option value="PNG">PNG Image</option>
                        <option value="JPEG">JPEG Image</option>
                        <option value="PDF">PDF Document</option>
                        <option value="SVG">SVG Vector Image</option>
                    </select>
                    <button id="downloadButton">Download</button>
                </div>
            </fieldset>
</body>
</html>