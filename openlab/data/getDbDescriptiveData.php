<?php 
// LOAD ANTHRO DESCRIPTIVE DATA (ABREV NAMES, FULL NAMES, SHORT NAMES, UNITS, CATEGORIES, DESCRIPTIONS, IMAGE LOCATION)
$dbhandle = new PDO('sqlite:./data/data.sqlite');
//$dbhandle = new PDO('sqlite:./data.sqlite');
if (!$dbhandle) die ($error);

$query = "SELECT abrevName, fullName, shortName, units, category, description, image FROM dimension_definitions";
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

echo 'category = []; fullName = []; shortName = []; units = []; description = []; image = [];';

foreach($AllNames as $name){
	echo 'category[\''.$name['abrevName'].'\'] = \''. $name['category']."';\n" ;
	echo 'fullName[\''.$name['abrevName'].'\'] = \''. $name['fullName']."';\n" ;
	echo 'shortName[\''.$name['abrevName'].'\'] = \''. $name['shortName']."';\n" ;
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


//LOAD POSTURE DEFINITIONS (SEATED, STANDING, SHORTNAME, LONGNAME, DESCRIPTION)

$query = "SELECT shortName, longName, description FROM posture_definitions";
$result = $dbhandle->query($query);
$AllPostures = $result->fetchAll(PDO::FETCH_ASSOC);

if (!$AllPostures) die("Cannot execute query.");

echo 'postureShortName = [';
									  
$max = count($AllPostures)-1;
			
for ($i = 0; $i<=$max; $i++) {
	$posture = $AllPostures[$i]; 

   if ($i<$max){
		echo '\''.$posture['shortName'].'\',';
   }
   
   if ($i==$max){
	   echo '\''.$posture['shortName'].'\'];'."\n";
   }		   
}

echo 'postureNameFull = []; postureDescription = [];';

foreach($AllPostures as $posture){
	echo 'postureNameFull[\''.$posture['shortName'].'\'] = \''. $posture['longName']."';\n" ;
	echo 'postureDescription[\''.$posture['shortName'].'\'] = \''. addslashes($posture['description'])."';\n" ;
}    



?>	