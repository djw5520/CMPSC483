<!DOCTYPE html>
<html>
<head>
<title>Anthropometric Data Explorer Lite Calculator: Open Design Lab</title>
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


<script type="text/javascript">

Array.prototype.sum = function() {
		// An array Method that will SUM the elements of an array		

		  
		  return (! this.length) ? 0 : this.slice(1).sum() +
			  ((typeof this[0] == 'number') ? this[0] : 0);
		
};

<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');

// LOAD ANTHRO DESCRIPTIVE DATA (ABREV NAMES, FULL NAMES, UNITS, CATEGORIES, DESCRIPTIONS, IMAGE LOCATION)
$dbhandle = new PDO('sqlite:./data/data.sqlite');
if (!$dbhandle) die ($error);

$query = "SELECT abrevName, fullName, units, category, description, image FROM dimension_definitions";
$result = $dbhandle->query($query);
$AllNames = $result->fetchAll(PDO::FETCH_ASSOC);

if (!$AllNames) die("Cannot execute query.");

echo 'abrevName = [';
									  
$max = count($AllNames)-1;
			
for ($i = 0; $i<=$max; $i++) {
	$names = $AllNames[$i]; 

   
   if ($i<$max){

		echo '\''.$names['abrevName'].'\',';
   }
   
   if ($i==$max){
	   echo '\''.$names['abrevName'].'\'];'."\n";
   }
		   
} 

echo 'category = []; fullName = []; units = []; description = []; image = [];';

foreach($AllNames as $name){
	echo 'category[\''.$name['abrevName'].'\'] = \''. $name['category']."';\n" ;
	echo 'fullName[\''.$name['abrevName'].'\'] = \''. $name['fullName']."';\n" ;
	echo 'units[\''.$name['abrevName'].'\'] = \''. $name['units']."';\n";	
	echo 'description[\''.$name['abrevName'].'\'] = \''. $name['description']."';\n";	
	echo 'image[\''.$name['abrevName'].'\'] = \''. $name['image']."';\n";	

}  

// LOAD DATABASE DEFINITIONS (CODED NAME, FULL NAME, DESCRIPTION, AVAILABLE MEASURES)
$dbhandle2 = new PDO('sqlite:./data/data_explorer_lite.sqlite');
if (!$dbhandle) die ($error);

$query = "SELECT coded_name, full_name, description FROM database_definitions";
$result = $dbhandle2->query($query);
$AllNames = $result->fetchAll(PDO::FETCH_ASSOC);

if (!$AllNames) die("Cannot execute query.");

echo 'dbNameCoded = [';
									  
$max = count($AllNames)-1;
			
for ($i = 0; $i<=$max; $i++) {
	$names = $AllNames[$i]; 

   
   if ($i<$max){

		echo '\''.$names['coded_name'].'\',';
   }
   
   if ($i==$max){
	   echo '\''.$names['coded_name'].'\'];'."\n";
   }
		   
} 

echo 'dbNameFull = []; dbDescription = []; dbAvailableMeasures=[];';

foreach($AllNames as $name){
	echo 'dbNameFull[\''.$name['coded_name'].'\'] = \''. $name['full_name']."';\n" ;
	echo 'dbDescription[\''.$name['coded_name'].'\'] = \''. addslashes($name['description'])."';\n" ;
}  

?>			

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

/*		
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
*/


function roundDecimal(_float, _digits){

  var rounder = Math.pow(10, _digits);
  return +(Math.round(_float * rounder) / rounder).toFixed(_digits);
  
}


$(document).on('pageshow','#pageView',function(event){

$( "#genderSwitch_M" ).prop( "checked", true ).checkboxradio( "refresh" ); 
$( "#genderSwitch_F" ).prop( "checked", false ).checkboxradio( "refresh" ); 
$( "#genderSwitch_C" ).prop( "checked", false ).checkboxradio( "refresh" ); 


rawData = [];
gender = 'male'; 
population = 'ansur'; // ansur by default; other choices given in table database_definitions
selectedDims = new Array();
selectedMeasures = new Array('STATURE','MASS','BMI');

anthroTable = 'ansur'; //default
genderSplit = '5050'; //default active gender split

globalUnits = 'mm';

dbSelectOutput = '';
dbSelectOutput += '<label for="dbSelect" class="select" style="font-size:14px; font-weight:bold; margin-right:20px">Database</label>';
dbSelectOutput += '<select name="dbSelect" id="dbSelect" data-mini="true" data-native-menu="false">';

for (i=0; i<dbNameCoded.length; i++){
	dbSelectOutput += '<option value="'+dbNameCoded[i]+'">'+dbNameFull[dbNameCoded[i]]+'</option>';
}	

dbSelectOutput+='</select>';

$('#dbSelectContainer').html(dbSelectOutput).trigger('create');

setTimeout(function(){buildSliders();buildDistributions();},200);

dbDescriptionOutput = '';
for (i=0; i<dbNameCoded.length; i++){
	dbDescriptionOutput+='<h3>'+dbNameFull[dbNameCoded[i]]+'</h3>'+dbDescription[dbNameCoded[i]];
	}
$('#dbDescription').html(dbDescriptionOutput);

});


$(document).on('change','#dbSelect',function(e){
ajaxindicatorstart();

	selectedMeasures = new Array('STATURE','MASS','BMI');
	anthroTable = $('#dbSelect option:selected').val();
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser
	setTimeout(function(){buildSliders();buildDistributions();},200);
});

$(window).resize(function(){ 

plotPDF();

});


$(document).on('change','#anthroPickerForm',function(event) {

//	refreshMvData();
	

});

$(document).on('change','#genderSplitSelect',function(event) {
ajaxindicatorstart();

	selectedMeasures = new Array('STATURE','MASS','BMI');
	genderSplit = $('#genderSplitSelect option:selected').val();
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser
	setTimeout(function(){buildSliders();plotPDF();},200);
		
});


/*
function dimSwitch(dimName){


	if ($.inArray(dimName,selectedMeasures)==-1){
		selectedMeasures.push(dimName);
	} else {
		selectedMeasures.splice($.inArray(dimName,selectedMeasures), 1);
	}
	buildSliders();
	buildDistributions();
}
*/

function getUnits(measure){
var units;
var unitMultiplier;
var unitDecimals;

if 	(globalUnits=='mm'){ 
				if (measure.toUpperCase()=='MASS'){
					units = 'kg';
					unitMultiplier=1;
					unitDecimals=1;
				} else if (measure.toUpperCase()=='BMI'){
					units = '';
					unitMultiplier=1;
					unitDecimals=1;
				} else {
					units = 'mm';
					unitMultiplier=1;
					unitDecimals=0;
				}
			} else {
				if (measure.toUpperCase()=='MASS'){
					units = 'lbs';
					unitMultiplier=2.205;
					unitDecimals=0;
				} else if (measure.toUpperCase()=='BMI'){
					units = '';
					unitMultiplier=1;
					unitDecimals=1;
				} else {
					units = 'in';
					unitMultiplier=0.03937;
					unitDecimals=1;
				}
			}

return {units:units, unitMultiplier:unitMultiplier, unitDecimals:unitDecimals};

}

$(document).on("slidestop",'.percentileSlider',function(e){
	var theId=e.target.id;
	var theMeasure=theId.split('-');
	var thePercentile=$('#'+theId).val();

	var unitObj = getUnits(theMeasure[1]);
	var units = unitObj.units;
	var unitMultiplier = unitObj.unitMultiplier;
	var unitDecimals = unitObj.unitDecimals;
	
	
	$("#slider_output_"+theMeasure[1]).text(thePercentile+getSuffix(thePercentile)+' percentile: '+roundDecimal(unitMultiplier*getPercentile(theMeasure[1],thePercentile),unitDecimals)+' '+units);
});

$(document).on("change",'.percentileSlider',function(e){
	var theId=e.target.id;
	var theMeasure=theId.split('-');
	$("#slider_output_"+theMeasure[1]).html('<span style="color:#DDD">'+$("#slider_output_"+theMeasure[1]).html()+'</span>');
});

$(document).on('change','#global_units_mm',function(e){
	globalUnits='mm';
	buildSliders();
	plotPDF();
});

$(document).on('change','#global_units_in',function(e){
	globalUnits='in'; 
	buildSliders(); 
	plotPDF();
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

		

function buildSliders(){

	output_html = '';
	for (i=0; i<selectedMeasures.length; i++){
		
		var unitObj = getUnits(selectedMeasures[i]);
		var units = unitObj.units;
		var unitMultiplier = unitObj.unitMultiplier;
		var unitDecimals = unitObj.unitDecimals;
	
	
		output_html += '<div id="'+selectedMeasures[i]+'" class="" style="width:29%; float:left; margin-left:2%; margin-right:2%;">';
		output_html += '<h3 style="text-align:left">'+fullName[selectedMeasures[i]];
		if (units!==''){ output_html+=' ('+units+')';}
		output_html += '</h3>';
		//output_html += '<div class="ansurOutputImage"><img src="./images/anthro/'+image[selectedMeasures[i]]+'"></div>';
		output_html += '<div id="plotPDF_'+selectedMeasures[i]+'" class="ansurPdfPlaceholder" style="height:200px; width:100%"></div><br>';	
		output_html += '<div class="ansurPdfSliderContainer">';
		output_html += '<label for="slider-'+selectedMeasures[i]+'" class="ui-hidden-accessible">Percentile</label>';
		output_html += '<input type="range" name="slider-'+selectedMeasures[i]+'" id="slider-'+selectedMeasures[i]+'" class="percentileSlider" value="50" min="1" max="99" />';
		output_html += '<p id="slider_output_'+selectedMeasures[i]+'" style="font-weight:bold;">50th percentile: '+roundDecimal(unitMultiplier*getPercentile(selectedMeasures[i],50),unitDecimals)+' '+units+'</p>';
		output_html += '</div></div>';
	
	}
		
	$('#output').html(output_html).trigger('create');

}


function getPercentile(measure,percentile) {
			var result = [];
			$.ajax({
				type: "POST",
				async: false,
				dataType: "text",
				data: { column: 'percentiles_'+genderSplit, table: anthroTable+'_percentiles_'+measure, percentile:percentile},
				url: "./data/getDataLite.php",
				success: function(data) {
					result = data;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				  }
			});
			return result;
		}

	
function getDensity(measure,dimension,genderSplit) {
			var result = [];
			$.ajax({
				type: "POST",
				async: false,
				dataType: "text",
				data: {column: dimension+'_'+genderSplit, table: anthroTable+'_distribution_'+measure },
				url: "./data/getDataLite.php",
				success: function(data) {
					result = data;
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				  }
			});
			return result;
		}


function buildDistributions(){

	genderSplitArray = ['1000','7525','5050','2575','0100']; //array of available gender splits
	plotGenderSplit = new Object();
	for (i=0; i<selectedMeasures.length; i++){	
		plotGenderSplit[selectedMeasures[i]] = new Object();
		density_X = new Object();
		density_Y = new Object();
		for (j=0; j<genderSplitArray.length; j++){
			var tmp = getDensity(selectedMeasures[i],'x',genderSplitArray[j]);
			density_X[selectedMeasures[i]] = tmp.split(",");
			density_X[selectedMeasures[i]] = $.grep(density_X[selectedMeasures[i]],function(n){ return(n) });
			var tmp = getDensity(selectedMeasures[i],'y',genderSplitArray[j]);
			density_Y[selectedMeasures[i]] = tmp.split(",");
			density_Y[selectedMeasures[i]] = $.grep(density_Y[selectedMeasures[i]],function(n){ return(n) });
			
			
			var plotTmp = [];
			var x = density_X[selectedMeasures[i]];
			var y = density_Y[selectedMeasures[i]];
			
			var unitObj = getUnits(selectedMeasures[i]);
			var unitMultiplier = unitObj.unitMultiplier;
		
			for (k=0; k<x.length; k++){
				plotTmp.push([unitMultiplier*x[k],y[k]]);
			}
		
			plotGenderSplit[selectedMeasures[i]][genderSplitArray[j]]=plotTmp;
		
		}
	}	
	plotPDF();
	
}
	
function plotPDF(){

	genderSplitArray = ['1000','7525','5050','2575','0100']; //array of available gender splits

	

	for (i=0; i<selectedMeasures.length; i++){	
		pdfPlot = [];
		pdfColors = [];
		for (j=0; j<genderSplitArray.length; j++){
		
			var unitObj = getUnits(selectedMeasures[i]);
			var unitMultiplier = unitObj.unitMultiplier;
	
			plotTmp = JSON.parse(JSON.stringify(plotGenderSplit[selectedMeasures[i]][genderSplitArray[j]])); //use JSON.parse and JSON.stringify to clone

			for (k=0; k<plotTmp.length; k++){
				plotTmp[k][0]=unitMultiplier*plotTmp[k][0];
			}
			
			if (genderSplit==genderSplitArray[j]){	
				pdfPlotActive = plotTmp;
			} else {
				pdfPlot.push(plotTmp);
				pdfColors.push('#DDD');
			}
				
			
		
		}
		
		//add the active set last, to keep it on top in the plot
		pdfColors.push('#8cc63f');
		pdfPlot.push(pdfPlotActive);
		
		var options = {	
				series:{ shadowSize: 0, 
					lines: { lineWidth: 0, fill:true }
				},
				xaxis:{ show: true },
				yaxis:{	show: false	},
				grid:{ borderWidth: 0 },
				colors: pdfColors
			}
	
		$.plot("#plotPDF_"+selectedMeasures[i],pdfPlot,options);
			
	}
 
}

</script>
  
		
  </head>
  <body onLoad="" style="margin:0; padding: 0; width: 100%;">

<?php include_once("analyticstracking.php") ?>

<div data-role="page" id="pageView" data-theme="c"> 
	 


<div data-role="header" > 
			<div class="ui-bar" style="padding:0;">
				<div id="headerLogoBlock"><a href="http://www.openlab.psu.edu/" target="_blank"><img src="./images/logo_tiny.png" border=0 style="height: 35px; margin-top:5px;"></a></div>
				<div id="headerTitleBlock"><h1>Anthropometric Data Explorer Lite</h1></div>
				<div id="headerLinkBlock"><a href="http://www.openlab.psu.edu/" style="color:white" target="_blank">openlab.psu.edu</a></div>
			</div>
</div>
			
		  <div data-role="content">
		  
		  
		  <div style="width:750px; margin:auto">
			
			
			<div id="dbSelectContainer" style="width: 300px; float:left; margin:5px; text-align:left;"></div>
			
			<div id="genderSplitSelectContainer" style="width: 300px; float:left;  margin:5px; text-align:left;">
			<label for="genderSplitSelect" class="select" style="font-size:14px; font-weight:bold; margin-right:20px">Gender Split (males/females)</label>
			<select name="genderSplitSelect" id="genderSplitSelect" data-mini="true" data-native-menu="false">
			<option value="1000">100%/0%</option>
			<option value="7525">75%/25%</option>
			<option value="5050" selected="selected">50%/50%</option>
			<option value="2575">25%/75%</option>
			<option value="0100">0%/100%</option>
			</select>
			</div>
			
			<div style="width:100px;float:left;margin:5px;text-align:left;" >
			<div style="font-weight:bold;font-size:14px;">Units</div>
			<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
			<input name="global_units" id="global_units_mm" value="mm" checked="checked" type="radio" > <label for="global_units_mm">mm</label>
			<input name="global_units" id="global_units_in" value="in" type="radio" ><label for="global_units_in">in</label>
			</fieldset>
			</div>
		  
				<!--<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" style="text-align:left;">
					<legend style="font-size:14px; font-weight:bold; margin-right:20px; margin-top:10px; margin-bottom:5px;">Gender</legend>
					<input type="radio" name="genderSwitch" id="genderSwitch_M" class="genderButton" checked="checked">
					<label for="genderSwitch_M">Male</label>
					<input type="radio" name="genderSwitch" id="genderSwitch_F" class="genderButton" >
					<label for="genderSwitch_F">Female</label>
					<input type="radio" name="genderSwitch" id="genderSwitch_C" class="genderButton" >
					<label for="genderSwitch_C">Both</label>
				</fieldset>-->

		</div>
 
			  <div style="text-align:center; clear:both; margin: 0 auto; width:90%" id="output">
				 <img src="./images/ajax-loader.gif"><br><b>Output panel loading...</b>
				 </div>
   
			  
			  
		  
		 
	  
	  





	
<h3 class="ui-bar ui-bar-a">Background</h3>
			<div class="ui-body">
<p>This tool allows for the identification of a population's stature, BMI, and mass at a glance, given various gender compositions, for the following sources of anthropometry:</p>
<div id="dbDescription"></div>
</div>



</div>
   


	  
<div id="resultLoading" style="display:none"><div id="resultLoadingContent"><div><img src="./images/ajax-loader.gif"><br>Loading data...</div></div><div class="bg"></div></div>
	 

	  
  </body>
</html>
