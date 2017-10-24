<!DOCTYPE html>
<html>
  <head>
  <style>
  svg {
  font: 10px sans-serif;
}

.background path {
  fill: none;
  stroke: #ddd;
  shape-rendering: crispEdges;
}

.foreground path {
  fill: none;
  stroke: steelblue;
}

.brush .extent {
  fill-opacity: .3;
  stroke: #fff;
  shape-rendering: crispEdges;
}

.axis line,
.axis path {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.axis text {
  text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, 0 -1px 0 #fff, -1px 0 0 #fff;
  cursor: move;
}
</style>
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
<script src="d3.v3.min.js"></script>

<script type="text/javascript">

<?php
// LOAD ANTHRO DESCRIPTIVE DATA (ABREV NAMES, FULL NAMES, UNITS, CATEGORIES, DESCRIPTIONS, IMAGE LOCATION)
include './data/getDbDescriptiveData.php';

?>

Array.prototype.sum = function() {
	// An array Method that will SUM the elements of an array		
	return (! this.length) ? 0 : this.slice(1).sum() + ((typeof this[0] == 'number') ? this[0] : 0);
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
	
	$('#csvFilename').val(population+gender);
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
gender = 'men'; // men (1) by default; women = 2; combined = 3
population = 'ANSUR'; // ansur by default; other choices given in table database_definitions
selectedDims = new Array();
selectedMeasures = new Array('STATURE','BMI', 'BIACROMIAL_BRTH', 'MASS', 'ACROMION_HT');

//anthroTable = population+gender; //default value
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

buildAnthroPanel(dbAvailableMeasures[population]);

buildOutput(selectedMeasures);

dbDescriptionOutput = '';
for (i=0; i<dbNameCoded.length; i++){
	dbDescriptionOutput+='<h3>'+dbNameFull[dbNameCoded[i]]+'</h3>'+dbDescription[dbNameCoded[i]];
	}
$('#dbDescription').html(dbDescriptionOutput);

});


$(document).on('change','#dbSelect',function(e){
ajaxindicatorstart();

	population = $('#dbSelect option:selected').val();

	selectedMeasures = new Array('STATURE','BMI');
	rawData = [];
	//anthroTable = $('#dbSelect option:selected').val()+gender;
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser
	setTimeout(function(){buildAnthroPanel(dbAvailableMeasures[population])},200);
	setTimeout(function(){buildOutput(selectedMeasures)},200);;
});

$(window).resize(function(){  });


$(document).on('change','#anthroPickerForm',function(event) {

//	refreshMvData();

});

$(document).on('change','input[name="genderSwitch"]',function(event) {
ajaxindicatorstart();
	selectedMeasures = new Array('STATURE','BMI');
	rawData = [];
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser
	setTimeout(function(){buildAnthroPanel(dbAvailableMeasures[population])},200);

	if ($('#genderSwitch_M').prop("checked")){
		gender = 'men';
		/*density_X = densityMales_X;
		density_Y = densityMales_Y;*/
			
	} else if ($('#genderSwitch_F').prop("checked")){
		gender = 'women';
		/*if (retrievedFemaleData==false){//sets up a flag so that data is only downloaded once
			densityFemales_X = $.csv.toObjects(getDensityData('./data/ansurDensityFemales_X.csv'));
			densityFemales_Y = $.csv.toObjects(getDensityData('./data/ansurDensityFemales_Y.csv'));
			retrievedFemaleData=true;	
		
		}*/
		//density_X = densityFemales_X;
		//density_Y = densityFemales_Y;
			
	} else if ($('#genderSwitch_C').prop("checked")){
		gender = 'both';
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
		data: { measure: measure, gender: gender, table: 'density_'+population+'_'+dimension },
		url: "./data/getData.php",
		success: function(data) {
			result = data;
		},
		error: function(){
			alert("Error fetching density data.");
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
	
	/*if (selectedMeasures[i]=='BMI'){
		units = '';
	}else{
		units = ' mm';
	}*/
	
	// fetch rawData
	for(i = 0; i < selectedMeasures.length; i++) {
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
	}

	output_html += ''
	/*output_html += '<div id="'+selectedMeasures[i]+'" class="outputBlock">';
	output_html += '<h3 style="text-align:left">'+fullName[selectedMeasures[i]]+'</h3>';
	output_html += '<div class="outputImage"><img src="./images/anthro/'+image[selectedMeasures[i]]+'"></div>';
	output_html += '<div id="plotPDF_'+selectedMeasures[i]+'" class="pdfPlaceholder"></div><br>';	
	output_html += '<div class="pdfSliderContainer">';
	output_html += '<label for="slider-'+selectedMeasures[i]+'" class="ui-hidden-accessible">Percentile</label>';
    output_html += '<input type="range" name="slider-'+selectedMeasures[i]+'" id="slider-'+selectedMeasures[i]+'" class="percentileSlider" value="50" min="1" max="99" />';
    output_html += '<p id="slider_output_'+selectedMeasures[i]+'" style="font-weight:bold;">50th percentile: '+ss.quantile(rawData[selectedMeasures[i]],0.5)+units+'</p>';
	output_html += '</div></div>';*/
	
		
	$('#output').html(output_html).trigger('create');
		

	drawPcoord(selectedMeasures);

	
}

function getDimension(measure) {
	var result = [];
	$.ajax({
		type: "POST",
		async: false,
		dataType: "text",
		data: { measure: measure, gender: gender, table: population+gender },
		url: "./data/getData.php",
		success: function(data) {
			result = data;
		},
		error: function(){
			alert("Error fetching Dimension data.");
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
		data: { measure: measure, gender: gender, table: 'density_'+population+'_'+dimension },
		url: "./data/getData.php",
		success: function(data) {
			result = data;
		},
		error: function(){
			alert("Error fetching Density data.");
		}
	});
	return result;
}

function drawPcoord(selectedMeasures) {
	var margin = {top: 30, right: 10, bottom: 10, left: 10},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

	var x = d3.scale.ordinal().rangePoints([0, width], 1),
    y = {},
    dragging = {};

	var line = d3.svg.line(),
    axis = d3.svg.axis().orient("left"),
    background,
    foreground;

	var svg = d3.select("#pcoord").select("svg").attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom).append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

	d3.csv("", function(error, ANSURmenCSVoutput) {
		
		
  // Extract the list of dimensions and create a scale for each.
  	x.domain(dimensions = selectedMeasures.filter(function(d) {

    	return d != "sum" && (y[d] = d3.scale.linear()
        .domain(d3.extent(rawData[d], function(p) {
        		if(+p == null) return null; else  
        		return +p; 
        }))
        .range([height, 0]));
  	}));
	
	// Add grey background lines for context.
  	background = svg.append("g")
  		.attr("class", "background")
  		.selectAll("path")
  		.data(
  		function() { 
  			var obj = {}; 
  			let arr = [];
  			for(let i = 0; i < rawData[selectedMeasures[0]].length; i++) { 
  				arr[i] = {}; 
  				for(let j = 0; j < selectedMeasures.length; j++) {
  					arr[i][selectedMeasures[j]] = rawData[selectedMeasures[j]][i];
  				}
  			}
  			console.log(arr);
  			return arr;
  		})
  		
  		.enter().append("path")
  		.attr("d", path);
	
	// Add blue foreground lines for focus.
  	foreground = svg.append("g")
  		.attr("class", "foreground")
  		.selectAll("path")
  		.data(function() { 
  			var obj = {}; 
  			let arr = [];
  			for(let i = 0; i < rawData[selectedMeasures[0]].length; i++) { 
  				arr[i] = {}; 
  				for(let j = 0; j < selectedMeasures.length; j++) {
  					arr[i][selectedMeasures[j]] = rawData[selectedMeasures[j]][i];
  				}
  			}
  			console.log(arr);
  			return arr;
  		})
  		.enter().append("path").attr("d",path);

	// Add a group element for each dimension.
  	var g = svg.selectAll(".dimension")
  		.data(dimensions)
  		.enter().append("g")
  		.attr("class", "dimension")
  		.attr("transform", function(d) { 
  			return "translate(" + x(d) + ")"; 
  		})
  		.call(d3.behavior.drag()
        	.origin(function(d) { 
        		return {x: x(d)}; 
        	})
        	.on("dragstart", function(d) {
				dragging[d] = x(d);
				background.attr("visibility", "hidden");
        	})
        	.on("drag", function(d) {
				dragging[d] = Math.min(width, Math.max(0, d3.event.x));
				foreground.attr("d", path);
				dimensions.sort(function(a, b) { 
					return position(a) - position(b); 
				});
				x.domain(dimensions);
				g.attr("transform", function(d) { 
					return "translate(" + position(d) + ")"; 
				})
        	})
	        .on("dragend", function(d) {
				delete dragging[d];
				transition(d3.select(this)).attr("transform", "translate(" + x(d) + ")");
				transition(foreground).attr("d", path);
				background
	            	.attr("d", path)
	            	.transition()
	            	.delay(500)
	            	.duration(0)
            		.attr("visibility", null);
	        }));

	// Add an axis and title.
	g.append("g")
		.attr("class", "axis")
		.each(function(d) { 
			d3.select(this).call(axis.scale(y[d])); 
		})
		.append("text")
		.style("text-anchor", "middle")
		.attr("y", -9)
		.text(function(d) { 
			return d; 
		});

  	// Add and store a brush for each axis.
  	g.append("g")
		.attr("class", "brush")
		.each(function(d) {
			d3.select(this).call(y[d].brush = d3.svg.brush().y(y[d]).on("brushstart", brushstart).on("brush", brush));
		})
    	.selectAll("rect")
      	.attr("x", -8)
      	.attr("width", 16);
	});

	function position(d) {
  		var v = dragging[d];
  		return v == null ? x(d) : v;
	}

	function transition(g) {
  		return g.transition().duration(500);
	}

// Returns the path for a given data point.
	function path(d) {
  		return line(dimensions.map(function(p) { return [position(p), y[p](d[p])]; }));
	}

	function brushstart() {
  		d3.event.sourceEvent.stopPropagation();
	}

	// Handles a brush event, toggling the display of foreground lines.
	function brush() {

  		var actives = dimensions.filter(function(p) { return !y[p].brush.empty(); }),
      		extents = actives.map(function(p) { return y[p].brush.extent(); });
  		foreground.style("display", function(d) {
    	return actives.every(function(p, i) {
    		d3.select("#test").html(y[p].brush.extent());

      		return extents[i][0] <= d[p] && d[p] <= extents[i][1];
    }) ? null : "none";
  });
 }
}
</script>
  
</head>
	<body onLoad="" style="margin:0; padding: 0; width: 100%;">
	<?php include_once("analyticstracking.php") ?>

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
					<form data-ajax="false" id="downloadSelectedMeasures" action="generateCsv.php" method="POST" target="theIframe" style="width: 50%; margin: auto;">
						<input type="button" value="Download Data for Selected Measures" onClick="generateCsv();" data-mini="true">
						<input type="hidden" id="csvOutput" name="csvOutput">
						<input type="hidden" id="csvFilename" name="csvFilename">
					</form>
					<iframe name="theIframe" style="display:none"></iframe>
					
					<div style="text-align:center; clear:both; margin: 0 auto; width:90%" id="output">
						<img src="./images/ajax-loader.gif"><br><b>Output panel loading...</b>
					</div>
					<div class="outputImage" id="pcoord"><svg></svg></div>
				</div>
			</div>
			<h3 class="ui-bar ui-bar-a">Background</h3>
			
			<div class="ui-body">
				<p>This tool allows for the exploration and download of anthropometric data, given the following sources of anthropometry:</p>
				<div id="dbDescription"></div>
			</div>
		</div>
		<div id="resultLoading" style="display:none">
			<div id="resultLoadingContent">
				<div>
					<img src="./images/ajax-loader.gif"><br>Loading data...
				</div>
			</div>

			<div class="bg"></div>
		</div>
</body>
</html>