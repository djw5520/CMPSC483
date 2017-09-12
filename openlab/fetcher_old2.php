<!DOCTYPE html>
<html>
  <head>
  <title>Manikin Fetcher Calculator: Open Design Lab</title>
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

$query = "SELECT coded_name, full_name, description, available_measures, available_postures FROM database_definitions";
$result = $dbhandle->query($query);
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

echo 'dbNameFull = []; dbDescription = []; dbAvailableMeasures=[]; dbAvailablePostures=[];';

foreach($AllNames as $name){
	echo 'dbNameFull[\''.$name['coded_name'].'\'] = \''. $name['full_name']."';\n" ;
	echo 'dbDescription[\''.$name['coded_name'].'\'] = \''. addslashes($name['description'])."';\n" ;
	echo 'dbAvailableMeasures[\''.$name['coded_name'].'\'] = \''. addslashes($name['available_measures'])."';\n" ;
	echo 'dbAvailablePostures[\''.$name['coded_name'].'\'] = \''. addslashes($name['available_postures'])."';\n" ;

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

		



$(document).on('pageshow','#pageView',function(event){

$( "#genderSwitch_M" ).prop( "checked", true ).checkboxradio( "refresh" ); 
$( "#genderSwitch_F" ).prop( "checked", false ).checkboxradio( "refresh" ); 


rawData = [];
manikinIDs = [];
closenessPercentages=[];
gender = 1; // men (1) by default; women = 2; combined = 3
sUnits = 'mmkg'; //by default
mView = 'front'; //by default
posture = 'Stand'; //by default
population = 'nhanes'; // nhanes by default; other choices given in table database_definitions
database = 'UScivilianMales'; //UScivilianMales = nhanes(gender=1) by default
selectedDims = new Array();
selectedMeasures = new Array('STATURE','BMI');

anthroTable = 'nhanes'; //default value
retrievedFemaleData = false;
retrievedCombinedData = false;

//build db select menu
dbSelectOutput = '';
dbSelectOutput += '<label for="dbSelect" class="select" style="font-size:14px; font-weight:bold; margin-right:20px">Database</label>';
dbSelectOutput += '<select name="dbSelect" id="dbSelect" data-mini="true" data-native-menu="false">';

for (i=0; i<dbNameCoded.length; i++){
	if (dbNameCoded[i] == population){
		anthroTable = dbNameCoded[i]; // only for setting default value at startup (based on initial value set on page load)
		dbSelectOutput += '<option value="'+dbNameCoded[i]+'" selected>'+dbNameFull[dbNameCoded[i]]+'</option>';
	} else {
		dbSelectOutput += '<option value="'+dbNameCoded[i]+'">'+dbNameFull[dbNameCoded[i]]+'</option>';
	}
}	

dbSelectOutput+='</select>';

$('#dbSelectContainer').html(dbSelectOutput).trigger('create');

//build posture select menu
buildPostureSelectMenu();

buildAnthroPanel(dbAvailableMeasures[anthroTable]);

buildOutput(selectedMeasures);

dbDescriptionOutput = '';
for (i=0; i<dbNameCoded.length; i++){
	dbDescriptionOutput+='<h3>'+dbNameFull[dbNameCoded[i]]+'</h3>'+dbDescription[dbNameCoded[i]];
	}
$('#dbDescription').html(dbDescriptionOutput);

});

function buildPostureSelectMenu(){

postureSelectOutput = '';
postureSelectOutput += '<label for="postureSelect" class="select" style="font-size:14px; font-weight:bold; margin-right:20px">Posture</label>';
postureSelectOutput += '<select name="postureSelect" id="postureSelect" data-mini="true" data-native-menu="false">';

var availablePostures = dbAvailablePostures[population].split(',');

for (i=0; i<availablePostures.length; i++){
	if (dbNameCoded[i] == population){
		postureSelectOutput += '<option value="'+availablePostures[i]+'" selected>'+availablePostures[i]+'</option>';
	} else {
		postureSelectOutput += '<option value="'+availablePostures[i]+'">'+availablePostures[i]+'</option>';
	}
}	

postureSelectOutput+='</select>';

$('#postureSelectContainer').html(postureSelectOutput).trigger('create');



}


$(document).on('change','#dbSelect',function(e){
ajaxindicatorstart();

	selectedMeasures = new Array('STATURE','BMI');
	rawData = [];
	anthroTable = $('#dbSelect option:selected').val();
	population = anthroTable;
	if (population=='nhanes'){
			if (gender==1){
			database = 'UScivilianMales';
			} else {
			database = 'UScivilianFemales';
			}
		} else if (population=='ansur') {
			if (gender==1){
			database = 'ANSURmale';
			} else {
			database = 'ANSURfemale';
			}
		}
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser
	setTimeout(function(){buildPostureSelectMenu(); buildAnthroPanel(dbAvailableMeasures[anthroTable])},200);
	setTimeout(function(){buildPostureSelectMenu(); buildOutput(selectedMeasures)},200);;
	
		$('#manikinOutput').css('opacity','0.3','filter','alpha(opacity=30)');//dim the figures when the user changes the db

});

$(document).on('change','#postureSelect',function(e){
		posture = $('#postureSelect option:selected').val();
		$('#manikinOutput').css('opacity','0.3','filter','alpha(opacity=30)');//dim the figures when the user changes the posture


});

$(window).resize(function(){ 


 });


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
		if (population=='nhanes'){
			database = 'UScivilianMales';
		} else if (population=='ansur') {
			database = 'ANSURmale';
		}			
	} else if ($('#genderSwitch_F').prop("checked")){
		gender = 2;
		if (population=='nhanes'){
			database = 'UScivilianFemales';
		} else if (population=='ansur') {
			database = 'ANSURfemale';
		}
			
	} 	
	
	$('#manikinOutput').css('opacity','0.3','filter','alpha(opacity=30)');//dim the figures when the user changes the sliders

	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser	
	setTimeout(function(){buildOutput(selectedMeasures)},200);
		
});

$(document).on('change','input[name="sliderUnits"]',function(event) {
//ajaxindicatorstart();
//	selectedMeasures = new Array('STATURE','BMI');
//	rawData = [];
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser
//	setTimeout(function(){buildAnthroPanel(dbAvailableMeasures[anthroTable])},200);

	if ($('#sliderUnits-a').prop("checked")){
		sUnits = 'mmkg';
			
	} else if ($('#sliderUnits-b').prop("checked")){
		sUnits = 'percentiles';
			
	} 	
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser	
	setTimeout(function(){buildOutput(selectedMeasures)},200);
		
});

$(document).on('change','input[name="manikinView"]',function(event) {
//ajaxindicatorstart();
//	selectedMeasures = new Array('STATURE','BMI');
//	rawData = [];
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser
//	setTimeout(function(){buildAnthroPanel(dbAvailableMeasures[anthroTable])},200);

	if ($('#manikinView-a').prop("checked")){
		mView = 'front';
		buildManikinOutput(manikinIDs);
			
	} else if ($('#manikinView-b').prop("checked")){
		mView = 'side';
		buildManikinOutput(manikinIDs);			
	} 	
		
});

$(document).on('click','#fetchMatches',function(e){

values = new Array();

if (sUnits=='mmkg'){
	for (i = 0; i<selectedMeasures.length; i++) {
		values[i] = $('#slider-'+selectedMeasures[i]).val();
	}
} else if (sUnits=='percentiles') {
	for (i = 0; i<selectedMeasures.length; i++) {
		values[i] = $('#sliderValue-'+selectedMeasures[i]).val();
	}
}


	$.ajax({
		type: "POST",
		async: false,
		dataType: "text",
		data: { measures: selectedMeasures.join(), values: values.join(), gender: gender, population: database },
		url: "./data/getNearestNeighbors2.php",
		success: function(data) {
			var returnObj = data.split("&&");

			var nearestNeighborIDs = returnObj[0].split(":");
			var closeness = returnObj[1].split(":");
			manikinIDs = nearestNeighborIDs[1];
			closenessPercentages = closeness[1];

		},
		error: function(){
			alert("Error fetching data.");
		}
	});
	//alert( manikinIDs + closenessPercentages);

manikinIDs = manikinIDs.split(",");
closenessPercentages = closenessPercentages.split(",");
$('#manikinOutput').css('opacity','1','filter','alpha(opacity=100)');//undim the figures

buildManikinOutput(manikinIDs);

$('#viewSelector').css('display','block');

		
});

function buildManikinOutput(manikinIDs){
$('#manikinOutput').html('');
if (gender==1){
	gender_ = 'male';
} else {
	gender_ = 'female';
}

$('#detailButtons').show();

l=0;
	for (i=0; i<manikinIDs.length; i++){
	
		$.ajax({
			type: "POST",
			dataType: "text",
			data: { 'manikinID': manikinIDs[i], 'database':database, 'gender': gender },
			async: false,
			url: "./data/getManikinDetails.php",
			success: function(data){
				var returnObj = data.split("&&");
				returnData = new Object();
				returnKeys = new Array();
				for (k=0;k<returnObj.length;k++){
					var tmp = returnObj[k].split(":");
					returnKeys.push(tmp[0]);
					returnData[tmp[0]]=tmp[1];
				}
				var imgFront = returnObj[0].split(":");
				var imgSide = returnObj[1].split(":");
			
				manikinOutputHtml = $('#manikinOutput').html();
				manikinOutputHtml += '<div style="float:left;width:20%;text-align:center; ">';
				if (population=='nhanes'){
					directory = './data/fetcher/img_nhanes/'+gender_+'/';
				} else if (population=='ansur'){
					directory = './data/fetcher/img_ansur/'+gender_+'/'+posture+'/';
				}
				if (mView=='front'){
					manikinOutputHtml += '<img src="'+directory+imgFront[1]+'" style="max-width:100%">';
				} else if (mView=='side'){
					manikinOutputHtml += '<img src="'+directory+imgSide[1]+'" style="max-width:100%">';
				}
				manikinOutputHtml += '<span style="font-weight:bold">' + closenessPercentages[l] + '% match</span>';
				manikinOutputHtml += '<a href="#detail-'+l+'" data-rel="popup" data-position-to="window" class="ui-mini ui-btn" style="width:70%">Details</a><p style="text-align:center">'
				popupContents = '<div class="ui-grid-a"><div class="ui-block-a" style="font-size:14px">';
				
				popupContents += '<img src="'+directory+imgFront[1]+'" style="float:left;max-width:50%">';
				popupContents += '<img src="'+directory+imgSide[1]+'" style="float:left;max-width:50%">';

				popupContents += '</div><div class="ui-block-b">';
					for (m=2; m<returnKeys.length; m++){
					// skip the first two keys for the summary, since they're the images
						popupContents+='<b>'+fullName[returnKeys[m]]+'</b>: '+returnData[returnKeys[m]]+' '+units[returnKeys[m]]+'<br>';
					}		
				popupContents += '</div></div>';
				popupContents += '<b>Download:</b><br>';
				popupContents += '<a href="../beta/images/'+gender_+'/'+imgFront[1]+'" target="_blank" class="ui-btn ui-btn-inline">Front Image</a>';
				popupContents += '<a href="../beta/images/'+gender_+'/'+imgSide[1]+'" target="_blank" class="ui-btn ui-btn-inline">Side Image</a>';	
				$('#detail-'+l+'-content').html(popupContents).trigger('create');
				l++;
				
				for (j=0; j<selectedMeasures.length; j++){
					manikinOutputHtml+='<span style="font-size:12px">'+fullName[selectedMeasures[j]]+': '+returnData[selectedMeasures[j]]+' '+units[selectedMeasures[j]]+'</span><br>';
				}
				
				manikinOutputHtml += '</p></div>';
				$('#manikinOutput').html(manikinOutputHtml).trigger('create');
			},
			error: function (request, status, error) {
				alert('Cannot load data: '+error);
			}
		});
	}

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
	$('#manikinOutput').css('opacity','0.3','filter','alpha(opacity=30)');//dim the figures when the user changes the sliders
	var theId=e.target.id;
	var theMeasure=theId.split('-');
	var thePercentile=$('#'+theId).val();
	/*if (theMeasure[1]=='BMI'){
		sliderUnits = '';
	}else{
		sliderUnits = ' mm';
	}*/
	//$("#slider_output_"+theMeasure[1]).text(thePercentile+getSuffix(thePercentile)+' percentile: '+ss.quantile(rawData[theMeasure[1]],thePercentile/100)+units);
});


$(document).on('slidestop','.percentiles',function(e){
// fill in the hidden value input when the percentile slider is changed
	var thisId = $(this).attr("id");
	var thisMeasure = thisId.split("slider-");
	var thisPercentile = $('#'+thisId).val()/100;
	var hiddenSliderVal = ss.quantile(rawData[thisMeasure[1]],thisPercentile);
	$('#sliderValue-'+thisMeasure[1]).val(hiddenSliderVal);	
	//alert($('#sliderValue-'+thisMeasure[1]).val());
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
	/*if (selectedMeasures[i]=='BMI'){
		sliderUnits = '';
	}else{
		sliderUnits = ' mm';
	}
	*/
	// fetch rawData
	if (typeof rawData[selectedMeasures[i]] === 'undefined') {
		var tmp = getDimension(selectedMeasures[i]);
		rawData[selectedMeasures[i]] = tmp.split(",");
			
	
	}
	

	
	output_html += '<div id="'+selectedMeasures[i]+'" class="outputBlock">';
	output_html += '<h3 style="text-align:left">'+fullName[selectedMeasures[i]]+'</h3>';
	output_html += '<div class="pdfSliderContainer">';
	
	
	if (sUnits == 'mmkg') {
		output_html += '<label for="slider-'+selectedMeasures[i]+'" class="ui-hidden-accessible">Value</label>';
		var sliderMin = Math.round(ss.quantile(rawData[selectedMeasures[i]],0.01));
		var sliderMax = Math.round(ss.quantile(rawData[selectedMeasures[i]],0.99));
    	output_html += '<input type="range" name="slider-'+selectedMeasures[i]+'" id="slider-'+selectedMeasures[i]+'" class="percentileSlider" value="'+Math.round((sliderMin+sliderMax)/2)+'" min="'+sliderMin+'" max="'+sliderMax+'" />';
    } else if (sUnits == 'percentiles') {
		output_html += '<label for="slider-'+selectedMeasures[i]+'" class="ui-hidden-accessible">Percentile</label>';
    	output_html += '<input type="range" name="slider-'+selectedMeasures[i]+'" id="slider-'+selectedMeasures[i]+'" class="percentileSlider percentiles" value="50" min="1" max="99" />';
    	output_html += '<input type="hidden" class="sliderValue" id="sliderValue-'+selectedMeasures[i]+'" value="'+ss.quantile(rawData[selectedMeasures[i]],0.5)+'"/>';
    }
    //output_html += '<p id="slider_output_'+selectedMeasures[i]+'" style="font-weight:bold;">50th percentile: '+ss.quantile(rawData[selectedMeasures[i]],0.5)+units+'</p>';
	output_html += '</div></div>';
	}
		
	$('#sliderOutput').html(output_html).trigger('create');
		
	
	
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



	


</script>
  
		
  </head>
  <body onLoad="" style="margin:0; padding: 0; width: 100%;">

<div data-role="page" id="pageView" data-theme="e"> 
	 


<div data-role="header" > 
			<div class="ui-bar" style="padding:0;">
				<div id="headerLogoBlock"><a href="http://www.openlab.psu.edu/" target="_blank"><img src="./images/logo_tiny.png" border=0 style="height: 35px; margin-top:5px;"></a></div>
				<div id="headerTitleBlock"><h1>Manikin Fetcher</h1></div>
				<div id="headerLinkBlock"><a href="http://www.openlab.psu.edu/" style="color:white" target="_blank">openlab.psu.edu</a></div>
			</div>
</div>
			
		  <div data-role="content">
		  
		  <div class="ui-grid-a">
		  
			<div class="ui-block-a" style="width: 25%;  text-align:center; ">
			
			<!--<p><i>You may select 2 or more dimensions for analysis.</i></p>-->
			
			<div id="dbSelectContainer" style="text-align:left;"></div>
			<div id="postureSelectContainer" style="text-align:left;"></div>

		  
				<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" style="text-align:left;">
					<legend style="font-size:14px; font-weight:bold; margin-right:20px; margin-top:10px; margin-bottom:5px;">Gender</legend>
					<input type="radio" name="genderSwitch" id="genderSwitch_M" class="genderButton" checked="checked">
					<label for="genderSwitch_M">Male</label>
					<input type="radio" name="genderSwitch" id="genderSwitch_F" class="genderButton" >
					<label for="genderSwitch_F">Female</label>
				</fieldset>

				<form name="anthroPickerForm" id="anthroPickerForm" style="margin-top:20px;"></form>
		  
				<div id="anthroPopups"><img src="./images/ajax-loader.gif"><br><b>Anthro panel loading...</b></div>

			</div>
			
			
			<div class="ui-block-b" style="width:75%;">
	
	<form style="width:95%; margin: auto;" class="ui-grid-c" onSubmit="return false;">
    <fieldset class="ui-block-a" data-role="controlgroup" data-type="horizontal" data-mini="true" style="width:30%; ">
        <legend class="ui-hidden-accessible">Sliders: </legend>
        <input type="radio" name="sliderUnits" id="sliderUnits-a" value="on" checked="checked">
        <label for="sliderUnits-a">mm/kg</label>
        <input type="radio" name="sliderUnits" id="sliderUnits-b" value="off">
        <label for="sliderUnits-b">Percentiles</label>
    </fieldset>
    <div class="ui-block-b " style="width:40%;">
    	<button id="fetchMatches" data-theme="b" class="ui-btn ui-btn-b ui-mini">Fetch Matches</button>
	</div>
	<fieldset class="ui-block-c" id="viewSelector" data-role="controlgroup" data-type="horizontal" data-mini="true" style="width:30%; display:none; text-align:right;">
        <legend  class="ui-hidden-accessible">View: </legend>
        <input type="radio" name="manikinView" id="manikinView-a" value="on" checked="checked">
        <label for="manikinView-a">Front</label>
        <input type="radio" name="manikinView" id="manikinView-b" value="off">
        <label for="manikinView-b">Side</label>
    </fieldset>
	</form>

 
 
 	<div id="manikinOutput"></div>

	
	<div style="text-align:center; clear:both; margin: 0 auto; width:90%" id="sliderOutput">
	<img src="./images/ajax-loader.gif"><br><b>Output panel loading...</b>
	</div>
   
			  
			  
	</div>
	</div>
		  
		 
	  
	  





	
<h3 class="ui-bar ui-bar-a">Background</h3>
			<div class="ui-body">
<p>This tool allows for the exploration and download of human figure "manikins", given the following sources of anthropometry:</p>
<div id="dbDescription"></div>


<!-- set up dummy popups to be filled in when the manikins load -->

<div data-role="popup" id="detail-0" data-overlay-theme="b" style="width:600px;">
    <div data-role="header">
    <h1>Manikin Details</h1>
    <a href="#" data-rel="back" data-role="button" data-icon="delete" class="ui-btn-right">Close</a>
    </div>
    <div role="main" class="ui-content" id="detail-0-content">
        
    </div>
</div>

<div data-role="popup" id="detail-1" data-overlay-theme="b" style="width:600px;">
    <div data-role="header">
    <h1>Manikin Details</h1>
    <a href="#" data-rel="back" data-role="button" data-icon="delete" class="ui-btn-right">Close</a>
    </div>
    <div role="main" class="ui-content" id="detail-1-content">
        
    </div>
</div>

<div data-role="popup" id="detail-2" data-overlay-theme="b" style="width:600px;">
    <div data-role="header">
    <h1>Manikin Details</h1>
    <a href="#" data-rel="back" data-role="button" data-icon="delete" class="ui-btn-right">Close</a>
    </div>
    <div role="main" class="ui-content" id="detail-2-content">
        
    </div>
</div>

<div data-role="popup" id="detail-3" data-overlay-theme="b" style="width:600px;">
    <div data-role="header">
    <h1>Manikin Details</h1>
    <a href="#" data-rel="back" data-role="button" data-icon="delete" class="ui-btn-right">Close</a>
    </div>
    <div role="main" class="ui-content" id="detail-3-content">
        
    </div>
</div>

<div data-role="popup" id="detail-4" data-overlay-theme="b" style="width:600px;">
    <div data-role="header">
    <h1>Manikin Details</h1>
    <a href="#" data-rel="back" data-role="button" data-icon="delete" class="ui-btn-right">Close</a>
    </div>
    <div role="main" class="ui-content" id="detail-4-content">
        
    </div>
</div>


</div>



</div>
   


	  
<div id="resultLoading" style="display:none"><div id="resultLoadingContent"><div><img src="./images/ajax-loader.gif"><br>Loading data...</div></div><div class="bg"></div></div>
	 

	  
  </body>
</html>
