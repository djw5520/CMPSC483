<?php

$column = $_POST["column"];
$table = $_POST["table"];
$percentile = $_POST["percentile"];

$dbhandle = new PDO('sqlite:./data_explorer_lite.sqlite');
if (!$dbhandle) die ($error);

if (isset($percentile)){
	$query = "SELECT ". $column . " FROM " . $table." WHERE rowid = ".$percentile;
	$result = $dbhandle->query($query);
	$rawdata = $result->fetchAll(PDO::FETCH_ASSOC);
	echo $rawdata[0][$column];
}else{
	$query = "SELECT ". $column . " FROM " . $table;
	$result = $dbhandle->query($query);
	$rawdata = $result->fetchAll(PDO::FETCH_ASSOC);
	for ($i=0; $i<count($rawdata); $i++){
		echo $rawdata[$i][$column].',' ;
	}
}



		
?>