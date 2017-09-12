<?php 


error_reporting(E_ALL);
ini_set('display_errors', '1');


$manikinID = $_POST['manikinID'];
$database = $_POST['database'];
$gender = $_POST['gender'];

$dbhandle = new PDO('sqlite:./data.sqlite');
if (!$dbhandle) die ($error);

$query = "SELECT * FROM " . $database . " WHERE rowid = " . $manikinID; //. " AND gender = " . $gender;
$result = $dbhandle->query($query);
$rawdata = $result->fetchAll(PDO::FETCH_ASSOC);

$col_headers = array_reduce(
  $dbhandle->query("PRAGMA table_info(".$database.")")->fetchAll(),
  function($rV,$cV) { $rV[]=$cV['name']; return $rV; },
  array()
);

if (!$rawdata) die("Cannot execute query.");

if ($gender=='men'){
	$gender_ = 'm';
} else {
	$gender_ = 'f';
}
echo 'IMG_FRONT:img_'.$gender_.'_f_'.$rawdata[0]["STATURE"].'_'.floor($rawdata[0]["BMI"]).'_'.$rawdata[0]["KNEE_HT_SITTING"].'_'.$rawdata[0]["WAIST_CIRC_OMPHALION"].'&&';
echo 'IMG_SIDE:img_'.$gender_.'_s_'.$rawdata[0]["STATURE"].'_'.floor($rawdata[0]["BMI"]).'_'.$rawdata[0]["KNEE_HT_SITTING"].'_'.$rawdata[0]["WAIST_CIRC_OMPHALION"].'&&';
echo 'CAD:'.$gender_.'_'.$rawdata[0]["STATURE"].'_'.floor($rawdata[0]["BMI"]).'_'.$rawdata[0]["KNEE_HT_SITTING"].'_'.$rawdata[0]["WAIST_CIRC_OMPHALION"].'&&';

for ($i=0;$i<count($col_headers);$i++){
	echo $col_headers[$i] . ':' . $rawdata[0][$col_headers[$i]];
	if ($i<(count($col_headers)-1)){
		echo '&&';
	}
}	



//echo 'STATURE:'.$rawdata[0]["STATURE"].'&&BMI:'.$rawdata[0]["BMI"].'&&SITTING_HT:'.$rawdata[0]["SITTING_HT"].'&&BIACROMIAL_BRTH:'.$rawdata[0]["BIACROMIAL_BRTH"].'&&KNEE_HT_SITTING:'.$rawdata[0]["KNEE_HT_SITTING"].'&&FOREARM_HAND_LENTH:'.$rawdata[0]["FOREARM_HAND_LENTH"].'&&HIP_BRTH_SITTING:'.$rawdata[0]["HIP_BRTH_SITTING"].'&&HEAD_CIRC:'.$rawdata[0]["HEAD_CIRC"];
/*
for ($i=0; $i<count($rawdata); $i++){
	echo $rawdata[$i][$measure].',' ;
}
*/
?>