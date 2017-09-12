<?php

$measure = $_POST["measure"];
$gender = $_POST["gender"];
$table = $_POST["table"];

$dbhandle = new PDO('sqlite:./data.sqlite');
if (!$dbhandle) die ($error);

$query = "SELECT ". $measure . " FROM " . $table;

// if ( ($gender==3) && (strpos($table,'anthro_') !== false)){
// 		$query = "SELECT ". $measure . " FROM " . $table;
// }else{
// 		$query = "SELECT ". $measure . " FROM " . $table . " WHERE gender = " . $gender;
// }
$result = $dbhandle->query($query);
$rawdata = $result->fetchAll(PDO::FETCH_ASSOC);

//if (!$AllNames) die("Cannot execute query.");


for ($i=0; $i<count($rawdata); $i++){
echo $rawdata[$i][$measure].',' ;
}

		
?>