//This is the code for saving a chart.

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