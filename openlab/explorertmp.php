<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
  <title>Anthropometric Data Explorer Calculator: Open Design Lab</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">	  

<link rel="apple-touch-icon" href="./apple-touch-icon.png"/>
<meta charset="utf-8">

<!-- LOAD STYLESHEETS-->
<link rel="stylesheet" href="./css/themes/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile.structure-1.4.2.min.css" /> 
<link rel="stylesheet" href="./css/themes/openlab_tools_v1_extended.css" />
<link rel="stylesheet" href="./css/style.css">

<!-- LOAD JQUERY -->
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script> 
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>

<!-- LOAD CUSTOM COMPONENTS -->
<!--<script type="text/javascript" src="build_data.js">
/* This script loads the data. Run build_data.php if the SQLite database is updated! */
</script>-->
<script type="text/javascript" src="./components/anthroPanel.js"></script>

<!-- LOAD JAVASCRIPT LIBRARIES -->
<script type="text/javascript" src="./stats.js"></script>
<script type="text/javascript" src="./simple_statistics.js"></script>
<script src="./jquery.csv-0.71.min.js"></script>
<script language="javascript" type="text/javascript" src="./flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="./flot/jquery.flot.canvas.js"></script>


<script type="text/javascript">

<?php
// LOAD ANTHRO DESCRIPTIVE DATA (ABREV NAMES, FULL NAMES, UNITS, CATEGORIES, DESCRIPTIONS, IMAGE LOCATION)
include './data/getDbDescriptiveData.php';

?>


Array.prototype.sum = function() {
		// An array Method that will SUM the elements of an array		

		  
		  return (! this.length) ? 0 : this.slice(1).sum() +
			  ((typeof this[0] == 'number') ? this[0] : 0);
		
};


		

// AJAX LOADING INDICATOR
$(document).ajaxStart(function () {
 		//show ajax indicator
ajaxindicatorstart();
}).ajaxStop(function () {
//hide ajax indicator
ajaxindicatorstop();
});

function ajaxindicatorstart()
{
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(1);
   	jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop()
{
    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeOut(1);
   jQuery('body').css('cursor', 'default');
}

		
// LOAD PDF DATA
function getDensityData(theUrl){
	var result = null;
	$.ajax({
		async: false,
		type: 'get',
		url: theUrl,
		dataType: 'text',
		success: function(data){
			result=data;
		}
	});
	return result;
}


function generateCsv(){
	csvOutput = '';
	for (i=0; i<selectedMeasures.length; i++){
		csvOutput+=selectedMeasures[i]; 
		if (i<(selectedMeasures.length-1)){
			csvOutput+=',';
		}
	}
	csvOutput+='\n';
	
	for (j=0; j<rawData['STATURE'].length; j++){
		for (i=0; i<selectedMeasures.length; i++){
			csvOutput+=rawData[selectedMeasures[i]][j];
			if (i<(selectedMeasures.length-1)){
				csvOutput+=",";
			}
		}
		csvOutput+='\n';	
	}
	
	$('#csvOutput').val(csvOutput);
	 $("#downloadSelectedMeasures").submit();

/*
	$.ajax({
    type: "POST",
    url: "generateCsv.php",
    data: {
    	'csvOutput':csvOutput
    	},
    dataType: "text",
    success: function(retData) {
    alert(retData);
  		$("body").append("<iframe src='" + retData + "' style='display: none;' ></iframe>");
    },
    error: function(data){
        alert("Did not work.");
    }
	});
*/

/*
$.post("generateCsv.php",{'csvOutput':csvOutput},function(data){
alert(data);
});
*/
 

}

$(document).on('pageshow','#pageView',function(event){

$( "#genderSwitch_M" ).prop( "checked", true ).checkboxradio( "refresh" ); 
$( "#genderSwitch_F" ).prop( "checked", false ).checkboxradio( "refresh" ); 
$( "#genderSwitch_C" ).prop( "checked", false ).checkboxradio( "refresh" ); 


rawData = [];
gender = 1; // men (1) by default; women = 2; combined = 3
population = 'ansur'; // ansur by default; other choices given in table database_definitions
selectedDims = new Array();
selectedMeasures = new Array('STATURE','BMI');

anthroTable = 'ansur'; //default value
densityMales_X = $.csv.toObjects(getDensityData('./data/ansurDensityMales_X.csv'));
densityMales_Y = $.csv.toObjects(getDensityData('./data/ansurDensityMales_Y.csv'));
density_X = densityMales_X;
density_Y = densityMales_Y;
retrievedFemaleData = false;
retrievedCombinedData = false;

dbSelectOutput = '';
dbSelectOutput += '<label for="dbSelect" class="select" style="font-size:14px; font-weight:bold; margin-right:20px">Database</label>';
dbSelectOutput += '<select name="dbSelect" id="dbSelect" data-mini="true" data-native-menu="false">';

for (i=0; i<dbNameCoded.length; i++){
	dbSelectOutput += '<option value="'+dbNameCoded[i]+'">'+dbNameFull[dbNameCoded[i]]+'</option>';
}	

dbSelectOutput+='</select>';

$('#dbSelectContainer').html(dbSelectOutput).trigger('create');

buildAnthroPanel(dbAvailableMeasures[anthroTable]);

buildOutput(selectedMeasures);

dbDescriptionOutput = '';
for (i=0; i<dbNameCoded.length; i++){
	dbDescriptionOutput+='<h3>'+dbNameFull[dbNameCoded[i]]+'</h3>'+dbDescription[dbNameCoded[i]];
	}
$('#dbDescription').html(dbDescriptionOutput);

});


$(document).on('change','#dbSelect',function(e){
ajaxindicatorstart();

	selectedMeasures = new Array('STATURE','BMI');
	rawData = [];
	anthroTable = $('#dbSelect option:selected').val();
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser
	setTimeout(function(){buildAnthroPanel(dbAvailableMeasures[anthroTable])},200);
	setTimeout(function(){buildOutput(selectedMeasures)},200);;
});

$(window).resize(function(){ plotPDF(selectedMeasures); });


$(document).on('change','#anthroPickerForm',function(event) {

//	refreshMvData();
	

});

$(document).on('change','input[name="genderSwitch"]',function(event) {
ajaxindicatorstart();
	selectedMeasures = new Array('STATURE','BMI');
	rawData = [];
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser
	setTimeout(function(){buildAnthroPanel(dbAvailableMeasures[anthroTable])},200);

	if ($('#genderSwitch_M').prop("checked")){
		gender = 1;
		/*density_X = densityMales_X;
		density_Y = densityMales_Y;*/
			
	} else if ($('#genderSwitch_F').prop("checked")){
		gender = 2;
		/*if (retrievedFemaleData==false){//sets up a flag so that data is only downloaded once
			densityFemales_X = $.csv.toObjects(getDensityData('./data/ansurDensityFemales_X.csv'));
			densityFemales_Y = $.csv.toObjects(getDensityData('./data/ansurDensityFemales_Y.csv'));
			retrievedFemaleData=true;	
		
		}*/
		//density_X = densityFemales_X;
		//density_Y = densityFemales_Y;
			
	} else if ($('#genderSwitch_C').prop("checked")){
		gender = 3;
		//rawData = $.extend({},rawData_M,rawData_F);
		/*if (retrievedCombinedData==false){//sets up a flag so that data is only downloaded once
			densityCombined_X = $.csv.toObjects(getDensityData('./data/ansurDensityCombined_X.csv'));
			densityCombined_Y = $.csv.toObjects(getDensityData('./data/ansurDensityCombined_Y.csv'));			
			retrievedCombinedData=true;
		}*/
		//density_X = densityCombined_X;
		//density_Y = densityCombined_Y;
	}	
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser	
	setTimeout(function(){buildOutput(selectedMeasures)},200);
		
});

function getDensity(dimension) {
			var result = [];
			$.ajax({
				type: "POST",
				async: false,
				dataType: 'text',
				data: { measure: measure, gender: gender, table: 'density_'+anthroTable+'_'+dimension },
				url: "./data/getData.php",
				success: function(data) {
					result = data;
				},
				error: function(){
					alert("Error fetching data.");
				}
			});
			return result;
		}

function dimSwitch(dimName){


	if ($.inArray(dimName,selectedMeasures)==-1){
		selectedMeasures.push(dimName);
	} else {
		selectedMeasures.splice($.inArray(dimName,selectedMeasures), 1);
	}
	buildOutput(selectedMeasures);
}

$(document).on("change",'.percentileSlider',function(e){
	var theId=e.target.id;
	var theMeasure=theId.split('-');
	var thePercentile=$('#'+theId).val();
	if (theMeasure[1]=='BMI'){
		units = '';
	}else{
		units = ' mm';
	}
	$("#slider_output_"+theMeasure[1]).text(thePercentile+getSuffix(thePercentile)+' percentile: '+ss.quantile(rawData[theMeasure[1]],thePercentile/100)+units);
});

function getSuffix(percentile_value){
	if ((percentile_value%10 ==1)&&(percentile_value!=11 )){
		suffix = 'st';
	} else if ((percentile_value%10 ==2)&&(percentile_value!=12 )){
		suffix = 'nd';
	} else if ((percentile_value%10 ==3)&&(percentile_value!=13)){
		suffix = 'rd';
	} else {
		suffix = 'th';
	}
	return suffix;
}

		
function buildOutput(selectedMeasures){

	output_html = '';
	for (i=0; i<selectedMeasures.length; i++){
	if (selectedMeasures[i]=='BMI'){
		units = '';
	}else{
		units = ' mm';
	}
	
	// fetch rawData
	if (typeof rawData[selectedMeasures[i]] === 'undefined') {
		var tmp = getDimension(selectedMeasures[i]);
		rawData[selectedMeasures[i]] = tmp.split(",");
			
	
	// fetch density distribution X
		var tmp = getDensity(selectedMeasures[i],'x');
		density_X[selectedMeasures[i]] = tmp.split(",");
density_X[selectedMeasures[i]] = $.grep(density_X[selectedMeasures[i]],function(n){ return(n) });
	
	// fetch density distribution Y
		var tmp = getDensity(selectedMeasures[i],'y');
		density_Y[selectedMeasures[i]] = tmp.split(",");
density_Y[selectedMeasures[i]] = $.grep(density_Y[selectedMeasures[i]],function(n){ return(n) });
	}
	
	output_html += '<div id="'+selectedMeasures[i]+'" class="outputBlock">';
	output_html += '<h3 style="text-align:left">'+fullName[selectedMeasures[i]]+'</h3>';
	output_html += '<div class="outputImage"><img src="./images/anthro/'+image[selectedMeasures[i]]+'"></div>';
	output_html += '<div id="plotPDF_'+selectedMeasures[i]+'" class="pdfPlaceholder"></div><br>';	
	output_html += '<div class="pdfSliderContainer">';
	output_html += '<label for="slider-'+selectedMeasures[i]+'" class="ui-hidden-accessible">Percentile</label>';
    output_html += '<input type="range" name="slider-'+selectedMeasures[i]+'" id="slider-'+selectedMeasures[i]+'" class="percentileSlider" value="50" min="1" max="99" />';
    output_html += '<p id="slider_output_'+selectedMeasures[i]+'" style="font-weight:bold;">50th percentile: '+ss.quantile(rawData[selectedMeasures[i]],0.5)+units+'</p>';
	output_html += '</div></div>';
	}
		
	$('#output').html(output_html).trigger('create');
		
		
	plotPDF(selectedMeasures);

	
}

function getDimension(measure) {
			var result = [];
			$.ajax({
				type: "POST",
				async: false,
				dataType: "text",
				data: { measure: measure, gender: gender, table: 'anthro_'+anthroTable },
				url: "./data/getData.php",
				success: function(data) {
					result = data;
				},
				error: function(){
					alert("Error fetching data.");
				}
			});
			return result;
		}

	
function getDensity(measure,dimension) {
			var result = [];
			$.ajax({
				type: "POST",
				async: false,
				dataType: "text",
				data: { measure: measure, gender: gender, table: 'density_'+anthroTable+'_'+dimension },
				url: "./data/getData.php",
				success: function(data) {
					result = data;
				},
				error: function(){
					alert("Error fetching data.");
				}
			});
			return result;
		}

	
function plotPDF(selectedMeasures){

	//addition for PDF download...
	canvasData=new Array();
	
	var options = {
		xaxis:{
			show: true
			},
		yaxis:{
			show: false
			},
		grid:{
			borderWidth: 0
			}
	}
	for (i=0; i<selectedMeasures.length; i++){	
		tmp = [];
		var x = density_X[selectedMeasures[i]];
		var y = density_Y[selectedMeasures[i]];
		for (j=0; j<x.length; j++){
			tmp.push([x[j],y[j]]);
		}
		plot=$.plot("#plotPDF_"+selectedMeasures[i],[tmp],options);
		
		//addition for PDF download...
		var myCanvas=plot.getCanvas();
		var canD=myCanvas.toDataURL("image/png");
		canvasData.push(canD);
	}
 
}


//additions for PDF download...

function send() {


var usermeasures=new Array(); //list of user selected measures
var userInput=new Array(); //slider percentile
var userInputValue=new Array(); //value of user percentile request
var setValues=new Array(); //values of 9 set percentiles
var database= $('#dbSelect').val();
var measureImages=new Array(); //shows measures

for (i=0; i<selectedMeasures.length; i++){
		

	usermeasures.push(fullName[selectedMeasures[i]]);
	var perc=$('#slider-'+selectedMeasures[i]).val();
	userInput.push(perc);//array of measures
	userInputValue.push(ss.quantile(rawData[selectedMeasures[i]],perc/100));//array of user inputs
	measureImages.push('../images/anthro/'+selectedMeasures[i]+'.png'); //array of measure-image locations
	
	var setpercentiles=new Array(.01,.05,.10,.25,.50,.75,.90,.95,.99);
	var measureValues=new Array();
	for (m=0; m<9; m++){
	measureValues.push(ss.quantile(rawData[selectedMeasures[i]],setpercentiles[m]));//setpercentiles[0]);
	}
	measureValues=measureValues.join(',');
	setValues.push(measureValues);
}


			$.ajax({
				url: "./explorer.php",
				type: "POST",
				async: false,
				data: {'measures':usermeasures,
				'gender':gender,
				'userInput':userInput,
				'userInputValue':userInputValue,
				'setValues':setValues,
				'database':database,
				'measureImages':measureImages,
				'canvasData':canvasData,
				},
				success: function() {
				//alert('yes')
				},
				error: function(){
					alert("Error fetching data.");
				}
			});

}


<?php
$_SESSION['measures']=$_POST['measures'];
$_SESSION['gender']=$_POST['gender'];
$_SESSION['userInput']=$_POST['userInput'];
$_SESSION['userInputValue']=$_POST['userInputValue'];
$_SESSION['setValues']=$_POST['setValues'];
$_SESSION['database']=$_POST['database'];
$_SESSION['measureImages']=$_POST['measureImages'];
$_SESSION['canvasData']=$_POST['canvasData'];

echo 'boo';
?>

function generatePDF(){
	send();
open('./pdf/explorerpdf.php');

}


</script>
  
		
  </head>
  <body onLoad="" style="margin:0; padding: 0; width: 100%;">

<div data-role="page" id="pageView" data-theme="d"> 
	 


<div data-role="header" > 
			<div class="ui-bar" style="padding:0;">
				<div id="headerLogoBlock"><a href="http://www.openlab.psu.edu/" target="_blank"><img src="./images/logo_tiny.png" border=0 style="height: 35px; margin-top:5px;"></a></div>
				<div id="headerTitleBlock"><h1>Anthropometric Data Explorer</h1></div>
				<div id="headerLinkBlock"><a href="http://www.openlab.psu.edu/" style="color:white" target="_blank">openlab.psu.edu</a></div>
			</div>
</div>
			
		  <div data-role="content">
		  
		  <div class="ui-grid-a">
		  
			<div class="ui-block-a" style="width: 25%;  text-align:center; ">
			
			<!-- ANTHRO PANEL -->
						
			<div id="dbSelectContainer" style="text-align:left;"></div>
		  
				<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" style="text-align:left;">
					<legend style="font-size:14px; font-weight:bold; margin-right:20px; margin-top:10px; margin-bottom:5px;">Gender</legend>
					<input type="radio" name="genderSwitch" id="genderSwitch_M" class="genderButton" checked="checked">
					<label for="genderSwitch_M">Male</label>
					<input type="radio" name="genderSwitch" id="genderSwitch_F" class="genderButton" >
					<label for="genderSwitch_F">Female</label>
					<input type="radio" name="genderSwitch" id="genderSwitch_C" class="genderButton" >
					<label for="genderSwitch_C">Both</label>
				</fieldset>

				<form name="anthroPickerForm" id="anthroPickerForm" style="margin-top:20px;"></form>
		  
				<div id="anthroPopups"><img src="./images/ajax-loader.gif"><br><b>Anthro panel loading...</b></div>

			</div>
			
			
			<div class="ui-block-b" style="width:75%;">
			
<div style="width:80%; margin:auto">
<form data-ajax="false" id="downloadSelectedMeasures" action="generateCsv.php" method="POST" target="theIframe" style="float:left; width: 48%; margin-right: 2%;">
    <input type="button" value="Download Data for Selected Measures" onClick="generateCsv();" data-mini="true">
 	<input type="hidden" id="csvOutput" name="csvOutput">
 </form>
 <form action="./pdf/explorerpdf.php" method="POST" target="theIframe"  style="float:left; width: 50%;">
    <input type="button" value='Download PDF' onClick="generatePDF();" data-mini="true">
 </form> 
 <iframe name="theIframe" style="display:none"></iframe>
 </div>
 
			  <div style="text-align:center; clear:both; margin: 0 auto; width:90%" id="output">
				 <img src="./images/ajax-loader.gif"><br><b>Output panel loading...</b>
				 </div>
   
			  
			  
		  </div>
		  </div>
		  
		 
	  
	  





	
<h3 class="ui-bar ui-bar-a">Background</h3>
			<div class="ui-body">
<p>This tool allows for the exploration and download of anthropometric data, given the following sources of anthropometry:</p>
<div id="dbDescription"></div>
</div>



</div>
   


	  
<div id="resultLoading" style="display:none"><div id="resultLoadingContent"><div><img src="./images/ajax-loader.gif"><br>Loading data...</div></div><div class="bg"></div></div>
	 

	  
  </body>
</html>
