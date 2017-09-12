<!DOCTYPE html>
<html>
  <head>
  <title>Multivariate Accommodation Calculator: Open Design Lab</title>
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
<script type="text/javascript" src="./components/anthroPanel.js"></script>

<!-- LOAD JAVASCRIPT LIBRARIES -->
<script type="text/javascript" src="./stats.js"></script>
<script type="text/javascript" src="./simple_statistics.js"></script>
<script src="./jquery.csv-0.71.min.js"></script>
<script language="javascript" type="text/javascript" src="./flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="./flot/jquery.flot.axislabels.js"></script>


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



$(document).on('pageshow','#pageView',function(event){

$( "#genderSwitch_M" ).prop( "checked", true ).checkboxradio( "refresh" ); 
$( "#genderSwitch_F" ).prop( "checked", false ).checkboxradio( "refresh" ); 
$( "#genderSwitch_C" ).prop( "checked", false ).checkboxradio( "refresh" ); 


rawData = [];
gender = 'men'; // men (1) by default; women = 2; combined = 3
population = 'ANSUR'; // ansur by default; other choices given in table database_definitions
selectedMeasures = new Array('STATURE','BMI');

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

dbDescriptionOutput = '';
for (i=0; i<dbNameCoded.length; i++){
	dbDescriptionOutput+='<h3>'+dbNameFull[dbNameCoded[i]]+'</h3>'+dbDescription[dbNameCoded[i]];
	}
$('#dbDescription').html(dbDescriptionOutput);



// BUILD DATA (READ FROM SQLITE)
buildData();

// BUILD SLIDERS
buildSliders(); 

ACCOM = 0;
DISACCOM = 1;

// initialize the arrays used for plotting
populationIn = new Array();
populationOut = new Array();

// build the population of individuals		
virtualPop = new Array();
for (i=0;i<selectedMeasures.length;i++) {
	virtualPop[selectedMeasures[i]] = initializeMeasure(rawData[selectedMeasures[i]], popSize);
}


// add default measures to graph options
	$('#xAxisDim, #yAxisDim').empty();
	
	for (i=0; i<selectedMeasures.length; i++){   
     $('#xAxisDim, #yAxisDim').append($('<option>',{
         	value:selectedMeasures[i],
         	text:fullName[selectedMeasures[i]]
         })); 
	}
	
	$('#xAxisDim option[value="'+selectedMeasures[0]+'"]').prop('selected',true);
	$('#yAxisDim option[value="'+selectedMeasures[1]+'"]').prop('selected',true);

	$('#xAxisDim,#yAxisDim').selectmenu("refresh",true);
	
		
// build the plot data
findAccommodation( virtualPop, $('#xAxisDim option:selected').val(), $('#yAxisDim option:selected').val(), popSize );


	
buildPlot(fullName[$('#xAxisDim option:selected').val()],fullName[$('#yAxisDim option:selected').val()]);
    
$('#sliders').trigger('create');


});


function getDimension(measure) {
			var result = [];
			$.ajax({
				type: "POST",
				async: false,
				dataType: "text",
//				data: { measure: measure, gender: gender, table: 'anthro_'+population },
				data: { measure: measure, gender: gender, table: population+gender },
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


		
function buildData() {

	var loadFlag = false; 
	for (i=0; i<selectedMeasures.length; i++){
	//alert(selectedMeasures[i]);
		if (typeof rawData[selectedMeasures[i]] === 'undefined') {
			loadFlag = true;
			var tmp = getDimension(selectedMeasures[i]);
			

			//alert(selectedMeasures[i]);
			var tmp2 = tmp.split(",");
			var tmp3 = [];

			for (j=0; j<tmp2.length-1; j++){
					tmp3[j] = +tmp2[j]; //convert string to number
			}
			rawData[selectedMeasures[i]] = tmp3;
	//alert(typeof rawData[selectedMeasures[i]]);
		}

	}
	
	if (loadFlag==false){
		ajaxindicatorstop();
	}
	
	

	popSize = rawData[selectedMeasures[0]].length;

}


function buildSliders(){


	
	all_sliders_html = '';
	
	for (i=0; i<selectedMeasures.length; i++){
	

		
		var tempmin = Math.round(ss.mean(rawData[selectedMeasures[i]])-4*ss.standard_deviation(rawData[selectedMeasures[i]]));
		var tempmax = Math.round(ss.mean(rawData[selectedMeasures[i]])+4*ss.standard_deviation(rawData[selectedMeasures[i]]));
		all_sliders_html += '<div class="sliderContainer">';
		all_sliders_html += '<div data-role="rangeslider" id="'+selectedMeasures[i]+'" class="sliders">';
		all_sliders_html += '<label for="'+selectedMeasures[i]+'-min" style="margin-bottom:-10px"><span id="xLabel">'+fullName[selectedMeasures[i]]+'</span> &nbsp;<span id="accom_'+selectedMeasures[i]+'" style="color:red; font-size:20px;">100%</span></label>';
		all_sliders_html += '<input type="range" name="'+selectedMeasures[i]+'-min" id="'+selectedMeasures[i]+'-min" class="min" value="'+tempmin+'" min="'+tempmin+'" max="'+tempmax+'"/>';
		all_sliders_html += '<input type="range" name="'+selectedMeasures[i]+'-max" id="'+selectedMeasures[i]+'-max" class="max" value="'+tempmax+'" min="'+tempmin+'" max="'+tempmax+'"	 />';
		all_sliders_html += '<div class="measure" style="display:none">'+selectedMeasures[i]+'</div>';
		all_sliders_html += '<div class="symmCheck" style="display:none"></div>';
		all_sliders_html += '</div>';
		all_sliders_html += '<div class="symmetryContainer" style="width:150px; margin:auto; margin-top:-5px; margin-bottom:20px;"><label><input type="checkbox" name="'+selectedMeasures[i]+'_sym" id="'+selectedMeasures[i]+'_sym" data-mini="true">Symmetry</label></div>';
		all_sliders_html += '</div>';
	}

	$('#sliders').html(all_sliders_html);
	

}

function buildPlot(xLab,yLab){
	var plotData = [{data: populationIn, label:'Accommodated', points: { fillColor:'black'}, color: 'black'},
{data: populationOut, label: 'Disaccommodated', points: {  fillColor: 'red' }, color: 'red' }];

$.plot($("#graphspot"), plotData, {
        series: {
            points: {
                radius: 2,
                show: true,
                fill: true
            }
        },
        grid: {
        	borderWidth: 0
        },
        xaxis: {
        	tickLength: 0
        },
        axisLabels: {
        	show:true
        },
        xaxes: [{
        	axisLabel: xLab
        }],
        yaxes: [{
        	axisLabel: yLab
        }]
    });
}

$(window).resize(function(){ buildPlot($('#xAxisDim option:selected').text(),$('#yAxisDim option:selected').text()); });



function initializeMeasure(data,popSize) {
// formats object for virtualPop

	returnObj = new Object()
	returnObj.anthro = data;		// add the anthropometry
	var temp = new Array();
	for (loopI=0;loopI<popSize;loopI++) { 
		temp[loopI]=ACCOM;		// accommodated by default
	} 
			
	returnObj.inRange = temp;		// initializes to "in range"
	return returnObj;
}

function inOrOut( virtualPop, measure, cutoffMin, cutoffMax ) {
		// determine if a particular measure is within the cutoff range or not


			for (loopI=0;loopI<popSize;loopI++) { 
				if ( ( virtualPop[measure].anthro[loopI] <= cutoffMax ) &
					 ( virtualPop[measure].anthro[loopI] >= cutoffMin ) ) {
					virtualPop[measure].inRange[loopI] = ACCOM;		// within range
				} else {
					virtualPop[measure].inRange[loopI] = DISACCOM;		// out of range
				}
			}
		}
		
function findAccommodation( virtualPop, xMeasure, yMeasure, popSize ) {
		
		// xIndex and yIndex are the indices for values for x and y axes
		
			tempInIndex = 0;
			tempOutIndex = 0;
			
			populationIn = new Array();
			populationOut = new Array();
			
			accom_measure = new Array(); // array totaling accommodation for each measure
			i=0;
			while (i<selectedMeasures.length){
				accom_measure[i] = 0; // initialize tally for each measure
				i++;
			}

			for (j=0;j<popSize;j++) { 
			
				accom_sum=0; //0 is accommodated
				for (i=0;i<selectedMeasures.length;i++) { 
					accom_sum = accom_sum+virtualPop[selectedMeasures[i]].inRange[j];
					if (virtualPop[selectedMeasures[i]].inRange[j] == ACCOM){
						accom_measure[i] = accom_measure[i]+1;
					}
				}
				
				if (accom_sum==0) { //if sum of all measures is 0, they're accommodated on all
					populationIn[tempInIndex++] = [ virtualPop[xMeasure].anthro[j], virtualPop[yMeasure].anthro[j] ]; // Accommodated individuals (within range)
				} else {
					populationOut[tempOutIndex++] = [ virtualPop[xMeasure].anthro[j], virtualPop[yMeasure].anthro[j] ]; // Disaccommodated individuals
				}
				
			}	
			
			var percentage = (populationIn.length)*100/popSize;
			
			$('#totals').html(percentage.toFixed(1) +"%");
			
		
			
			for (i=0; i<selectedMeasures.length; i++){
				$('#accom_'+selectedMeasures[i]).html((accom_measure[i]*100/popSize).toFixed(1) + "%");
			}

		
			
				
		}

function dimSwitch(dimName){
ajaxindicatorstart();

	if ($.inArray(dimName,selectedMeasures)==-1){
		selectedMeasures.push(dimName);
	} else {
		if (selectedMeasures.length>2){
		selectedMeasures.splice($.inArray(dimName,selectedMeasures), 1);
		} else {
			alert('You must select a minimum of 2 dimensions. Please add a dimension to remove one.');
			$("#"+dimName).prop("checked",true).checkboxradio("refresh");	

	
		}
	}
		
		
	// add measures to graph options
	$('#xAxisDim, #yAxisDim').empty();
	
	for (i=0; i<selectedMeasures.length; i++){   
     $('#xAxisDim, #yAxisDim').append($('<option>',{
         	value:selectedMeasures[i],
         	text:fullName[selectedMeasures[i]]
         })); 
	}
	
	$('#xAxisDim option[value="'+selectedMeasures[0]+'"]').prop('selected',true);
	$('#yAxisDim option[value="'+selectedMeasures[1]+'"]').prop('selected',true);

	$('#xAxisDim,#yAxisDim').selectmenu("refresh",true);

	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser
	setTimeout(function(){refreshMvData();buildPlot($('#xAxisDim option:selected').text(),$('#yAxisDim option:selected').text());},200);
}


$(document).on('change','#dbSelect',function(e){
ajaxindicatorstart();

	selectedMeasures = new Array('STATURE','BMI');
	rawData = [];
	population = $('#dbSelect option:selected').val();
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser
	setTimeout(function(){buildAnthroPanel(dbAvailableMeasures[population])},200);
	setTimeout(function(){refreshMvData();buildPlot($('#xAxisDim option:selected').text(),$('#yAxisDim option:selected').text());},200);
});

$(document).on('change','input[name="genderSwitch"]',function(event) {
ajaxindicatorstart();
	//selectedMeasures = new Array('STATURE','BMI');
	rawData = [];
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser
	//setTimeout(function(){buildAnthroPanel(dbAvailableMeasures[population])},200);

	if ($('#genderSwitch_M').prop("checked")){
		gender = 'men';
			
	} else if ($('#genderSwitch_F').prop("checked")){
		gender = 'women';

			
	} else if ($('#genderSwitch_C').prop("checked")){
		gender = 'both';

	}	
	//setTimeout gives the loading animation time to load before synchronous ajax locks the browser	
	setTimeout(function(){refreshMvData();buildPlot($('#xAxisDim option:selected').text(),$('#yAxisDim option:selected').text());},200);
		
});




$(document).on('change','.sliders',function(){
	
	minVal = $(this).children('.min').val();
	maxVal = $(this).children('.max').val();
	measure = $(this).children('.measure').html();
	meanVal = mean(rawData[measure]);
	minDev = mean(rawData[measure])-minVal;
	maxDev = maxVal-mean(rawData[measure]);
	
	if (meanVal>300) {devCheck = 0.001; } else {devCheck = 0.01; }

	if ($('#'+measure+'_sym').prop("checked") && (Math.abs(minDev-maxDev)/meanVal>devCheck)) {
		if($(this).children('.symmCheck').html()=='min'){
			$(this).children('.max').val(Math.round(meanVal+minDev)).slider('refresh');
		} else if ($(this).children('.symmCheck').html()=='max'){
			$(this).children('.min').val(Math.round(meanVal-maxDev)).slider('refresh');
		}
	}

	
	inOrOut(virtualPop,measure,minVal,maxVal);
	findAccommodation(virtualPop, $('#xAxisDim option:selected').val(), $('#yAxisDim option:selected').val(), popSize);
});

$(document).on('slidestop','.sliders',function(){
	buildPlot($('#xAxisDim option:selected').text(),$('#yAxisDim option:selected').text());
});

$(document).on('change','.min',function(){
	$('.sliders .symmCheck').html('min');
	});
	
$(document).on('change','.max',function(){
	$('.sliders .symmCheck').html('max');
	});



 
$( document ).on( "change", "#mvGraphSettings",function( e ) {
	
	findAccommodation(virtualPop, $('#xAxisDim option:selected').val(), $('#yAxisDim option:selected').val(), popSize);
	buildPlot($('#xAxisDim option:selected').text(),$('#yAxisDim option:selected').text());

	});

function refreshMvData(){
	buildData();	

	for (i=0;i<selectedMeasures.length;i++) {
			virtualPop[selectedMeasures[i]] = initializeMeasure(rawData[selectedMeasures[i]], popSize);
	}	
	
	buildSliders();
	
	findAccommodation(virtualPop, $('#xAxisDim option:selected').val(), $('#yAxisDim option:selected').val(), popSize);

	$('#sliders').trigger('create');
	
	

	 
	 
}


</script>
  
		
  </head>
  <body onLoad="" style="margin:0; padding: 0; width: 100%;">
 
<?php include_once("analyticstracking.php") ?>
 
<div data-role="page" id="pageView" data-theme="f"> 
	 
	  
<script type="text/javascript" src="./Highcharts_4/js/highcharts.js"></script>	 


<div data-role="header" > 
			<div class="ui-bar" style="padding:0;">
				<div id="headerLogoBlock"><a href="http://www.openlab.psu.edu/" target="_blank"><img src="./images/logo_tiny.png" border=0 style="height: 35px; margin-top:5px;"></a></div>
				<div id="headerTitleBlock"><h1>Multivariate Accommodation Calculator</h1></div>
				<div id="headerLinkBlock"><a href="http://www.openlab.psu.edu/" style="color:white" target="_blank">openlab.psu.edu</a></div>
			</div>
</div>
			
		  <div data-role="content">
		  
		  <div class="ui-grid-a">
		  
			<div class="ui-block-a" style="width: 25%;">
			
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
		  
				<div id="anthroPopups" style="text-align:center;"><img src="./images/ajax-loader.gif"><br><b>Anthro panel loading...</b></div>

			</div>
			
			
			<div class="ui-block-b" style="width:75%;">

		   
					<div id = "graphspot" style="text-align:center; width:96%; height: 300px; margin:2%; "><img src="./images/ajax-loader.gif"><br><b>Graph loading...</b></div> 




					<br style="clear:both">
	  


			  <div style="text-align:center;">
				<span style="color:red; font-style:bold; font-size:18px; ">

					Total Accommodation:  <span id="totals" style="font-size:22px">100%</span></span>&nbsp;
					 
					 <!--<a href="#" data-role="button" data-inline="true" onClick="buildPlot($('#xAxisDim option:selected').text(),$('#yAxisDim option:selected').text());" data-mini="true">Update Graph</a>-->
					<a href="#mvGraphSettings" data-rel="popup" data-role="button" data-inline="true" data-mini="true" data-icon="gear">Graph Settings</a>
				</div>

				 
				 
			  <div style="margin: 0 auto; width:90%; text-align:center;" id="sliders">
				 <img src="./images/ajax-loader.gif"><br><b>Sliders loading...</b>
				 </div>
   
			  
			  
		  </div>
		  </div>
		  
		 
	  
	  

<div data-role="popup" id="mvGraphSettings" style="width:300px; " class="ui-corner-all"> 
	 <div data-role="header" class="ui-corner-top">
				<h1>Graph Settings</h1>
	<a href="#" data-rel="back" data-role="button" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
			</div>

	 <div data-role="content">
	 <p><i>Select dimensions to plot on the x and y axes.</i></p>
<div data-role="fieldcontain" style="font-size:14px">
   <label for="xAxisDim" class="select">X Axis</label>
   <select name="xAxisDim" id="xAxisDim" data-mini="true" data-native-menu="false">
	<option value="STATURE" selected>Stature</option>
	<option value="BMI">BMI</option>
   </select>
   <label for="yAxisDim" class="select" style="margin-top:10px">Y Axis</label>
   <select name="yAxisDim" id="yAxisDim" data-mini="true" data-native-menu="false">
	<option value="STATURE">Stature</option>
	<option value="BMI" selected>BMI</option>
   </select>
</div>

</div>

</div>
	
<h3 class="ui-bar ui-bar-a">Background</h3>
			<div class="ui-body">
<!--<p>Designing for multiple body dimensions simultaneously presents one of the more difficult challenges when configuring products and environments for people. Traditional design tools have been principally univariate, displaying values for a single dimension in a tabular format. When multiple dimensions are combined, the percentage of the population accommodated by the limits on all the dimensions is not the same as the percentage of the population accommodated by the limits on a single dimension. </p>-->
<p>This calculator permits the user to interact with many-dimensional data in real-time. Sliders allow the specification of the acceptable limits of anthropometry on multiple dimensions, and the user may plot any of these measures on the graph. Overall accommodation (on all measures) is displayed with the limits specified by the sliders in effect. This tool includes the following sources of anthropometry:</p>
<div id="dbDescription"></div>
</div>

   


	  
</div>
	 

	  <div id="resultLoading" style="display:none"><div id="resultLoadingContent"><div><img src="./images/ajax-loader.gif"><br>Loading data...</div></div><div class="bg"></div></div>

  </body>
</html>
