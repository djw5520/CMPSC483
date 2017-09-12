<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
</head>

<body>


<?php

echo 'This script builds a file called "build_data.js" that drives the mobile tool to reduce loading time and eliminate the need for php code in the tool. Just run it once, or whenever updates are made to the database. You should not see anything below.';
		
$fp = fopen('build_data.js', 'w');

fwrite($fp,'var rawData_M = new Array(); var rawData_F = new Array(); ');
fwrite($fp,'var abrevName = new Array(); var category = new Array(); var fullName = new Array(); var units = new Array(); var description = new Array(); var image = new Array();');

require_once('db_class.php');

// ***** MULTIVARIATE ANSUR TOOL *****

$db = new ANSURDataClass();
$db->connect();
$ANSURData = $db->allReducedANSUR(1); 	// males from ANSUR

$ANSURData_M = $db->allReducedANSUR(1); 	// males from ANSUR
$ANSURData_F = $db->allReducedANSUR(2); 	// females from ANSUR

$db->disconnect();

 
$ns = new ANSURDataClass();
$ns->connect();

$AllNames = $ns->allNames();


	// parse descriptive data into JS
			
			fwrite($fp, 'abrevName = [');
									  
			$max = count($AllNames)-1;
			
			for ($i = 1; $i<=$max; $i++) {
						$names = $AllNames[$i]; 

					   
					   if ($i<$max){

					   		fwrite($fp, '\''.$names['abrevName'].'\',');
					   }
					   
					   if ($i==$max){
						   fwrite($fp, '\''.$names['abrevName'].'\'];'."\n");
					   }
					   
					   } 
			
		
		foreach($AllNames as $name){
			fwrite($fp, 'category[\''.$name['abrevName'].'\'] = \''. $name['category'].'\';') ;
			fwrite($fp, 'fullName[\''.$name['abrevName'].'\'] = \''. $name['fullName'].'\';') ;
			fwrite($fp, 'units[\''.$name['abrevName'].'\'] = \''. $name['Units'].'\';');	
			fwrite($fp, 'description[\''.$name['abrevName'].'\'] = \''. $name['description'].'\';');	
			fwrite($fp, 'image[\''.$name['abrevName'].'\'] = \''. $name['image'].'\';');	

		}  
		
		fwrite($fp,"\n\n");
		
$whole_body = $ns->allNames('1_whole_body');
$head = $ns->allNames('2_head');
$hands_arms = $ns->allNames('3_hands_arms');
$torso = $ns->allNames('4_torso');
$feet_legs = $ns->allNames('5_feet_legs');
$ns->disconnect();

	



	// parse raw male data into JS
		
		foreach($AllNames as $name){
			fwrite($fp, 'rawData_M[\''.$name['abrevName'].'\'] = [');
	
			for ($i = 1; $i<count($ANSURData_M); $i++) {
						$data = $ANSURData_M[$i]; 
					   fwrite($fp, $data[$name['abrevName']].',');
					   } 
			fwrite($fp, $data[$name['abrevName']]);
			fwrite($fp, '];'."\n");	
		}  
		
	// parse raw female data into JS
	
		foreach($AllNames as $name){
			fwrite($fp, 'rawData_F[\''.$name['abrevName'].'\'] = [');
	
			for ($i = 1; $i<count($ANSURData_F); $i++) {
						$data = $ANSURData_F[$i]; 
					   fwrite($fp, $data[$name['abrevName']].',');
					   } 
			fwrite($fp, $data[$name['abrevName']]);
			fwrite($fp, '];'."\n");	
		}  
		

		
		



// ***** NHANES TOOL *****

		$db = new genderSplitDataClass();
        $db->connect();
		
		$fields = array('stature','mass','BMI');
		
		fwrite($fp,'var data_100 = new Array(); var data_75 = new Array(); var data_50 = new Array(); var data_25 = new Array(); var data_0 = new Array(); ');

		// get the stature, mass, and BMI data for each split and put them in respective arrays
		
        $data_100 = $db->getDataForGenderSplit(1); 	
		
		foreach($fields as $field){
			fwrite($fp, 'data_100[\''.$field.'\'] = [');
	
			for ($i = 0; $i<count($data_100); $i++) {
						$data = $data_100[$i]; 
					   fwrite($fp, $data[$field].',');
					   } 
			fwrite($fp, $data[$field]);
			fwrite($fp, '];'."\n");	
		}
		
		$data_75 = $db->getDataForGenderSplit(0.75); 	
		
		foreach($fields as $field){
			fwrite($fp, 'data_75[\''.$field.'\'] = [');
	
			for ($i = 0; $i<count($data_75); $i++) {
						$data = $data_75[$i]; 
					   fwrite($fp, $data[$field].',');
					   } 
			fwrite($fp, $data[$field]);
			fwrite($fp, '];'."\n");	
		}
		
        $data_50 = $db->getDataForGenderSplit(0.5); 	
		
		foreach($fields as $field){
			fwrite($fp, 'data_50[\''.$field.'\'] = [');
	
			for ($i = 0; $i<count($data_50); $i++) {
						$data = $data_50[$i]; 
					   fwrite($fp, $data[$field].',');
					   } 
			fwrite($fp, $data[$field]);
			fwrite($fp, '];'."\n");	
		}
		
        $data_25 = $db->getDataForGenderSplit(0.25); 
		
		foreach($fields as $field){
			fwrite($fp, 'data_25[\''.$field.'\'] = [');
	
			for ($i = 0; $i<count($data_25); $i++) {
						$data = $data_25[$i]; 
					   fwrite($fp, $data[$field].',');
					   } 
			fwrite($fp, $data[$field]);
			fwrite($fp, '];'."\n");	
		}
		
        $data_0 = $db->getDataForGenderSplit(0); 
		
		foreach($fields as $field){
			fwrite($fp, 'data_0[\''.$field.'\'] = [');
	
			for ($i = 0; $i<count($data_0); $i++) {
						$data = $data_0[$i]; 
					   fwrite($fp, $data[$field].',');
					   } 
			fwrite($fp, $data[$field]);
			fwrite($fp, '];'."\n");	
		}
		
		
		
		$db->disconnect();

	
fclose($fp);

	?> 
        
</body>
</html>