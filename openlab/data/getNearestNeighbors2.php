<?php		

/*
error_reporting(E_ALL);
ini_set('display_errors', '1');
*/

class globalAnthroClass {
		private $dbHandle;
		
		public function connect()
		{
			try {
				$this->dbHandle = new PDO('sqlite:' . dirname($_SERVER['SCRIPT_FILENAME']) . '/data.sqlite');
			}
			catch (PDOException $exception) {
				die($exception->getMessage());
			}
		}
		
		public function disconnect() {
			if ($this->dbconn > 0) {
				sqlite_close($this->dbconn);
			}
		}
		
		public function reducedAnthroData($measures,$population) {
			// return the indices for "nearest neighbor" candidates
			$records = array();

			// create the sql query
			$sql = "SELECT " . $measures . " FROM " . $population . " ORDER BY rowid";	
/*
print "<br><br>";
print $sql;	
print "<br>";
*/			
			// pull the records from the sqlite database
			$result = $this->dbHandle->query($sql);
			$records = $result->fetchAll(PDO::FETCH_ASSOC);
  

			// convert to an easier format for matrix multiplication
			$data = array();
			$i=0; $j=0;
			foreach ($records as $record ) {
				foreach ($record as $r ) {
					$data[$i][$j] = $r;
					$j++;
				}
				$i++;
				$j = 0;
			}

			return $data;	
		}



}

			
			// *********************** INPUTS ***********************


			// We need an array of measure names. If we receive them individually, combine; otherwise use directly


			//$measures = array( "STATURE", "KNEE_HT_SITTING","HIP_BRTH_SITTING","CHEST_CIRC" );


			$measures = $_POST["measures"];
			$measures = explode(",",$measures);
			
			
// We also need an array of target values (in the same order as the measurements)


			//$values = array( 1634,512,327,892 );

			$values = $_POST["values"];
			$values = explode(",",$values);	


			


			// We need the population name (e.g., UScivilian, Indian, whatever)


			//$population = "UScivilianMales";
			$population = $_POST["population"];

			


			// We need the gender; MALES or FEMALES

// 
			//$gender = "MALES";
// 			$gender_ = $_POST["gender"];
// 			
// 			if ($gender_==1){
// 				$gender = "MALES";
// 			}elseif ($gender_==2){
// 				$gender = "FEMALES";
// 			}


			// We need the indices that relate the input measures to the covariance matrix


            // *** measure numbers starts at 1--it will be changed to PHP's 0-indexing below ***


            //$covIndices = array( 1,5,7,9 );
			
			$covIndices = array();
			
			if (($population == 'NHANESmen')||($population == 'NHANESwomen')){
				for ($i=0; $i<count($measures); $i++){
					if ($measures[$i]=="STATURE"){$covIndices[$i]=1;}
					elseif ($measures[$i]=="BMI"){$covIndices[$i]=2;}
	
				elseif ($measures[$i]=="SITTING_HT"){$covIndices[$i]=3;}
	
				elseif ($measures[$i]=="BIACROMIAL_BRTH"){$covIndices[$i]=4;}
	
				elseif ($measures[$i]=="KNEE_HT_SITTING"){$covIndices[$i]=5;}
	
				elseif ($measures[$i]=="FOREARM_HAND_LENTH"){$covIndices[$i]=6;}
	
				elseif ($measures[$i]=="HIP_BRTH_SITTING"){$covIndices[$i]=7;}
	
				elseif ($measures[$i]=="HEAD_CIRC"){$covIndices[$i]=8;}
	
				elseif ($measures[$i]=="CHEST_CIRC"){$covIndices[$i]=9;}
	
				elseif ($measures[$i]=="WAIST_CIRC_OMPHALION"){$covIndices[$i]=10;}
	
				elseif ($measures[$i]=="BUTTOCK_CIRC"){$covIndices[$i]=11;}
	
				elseif ($measures[$i]=="MASS"){$covIndices[$i]=12;}
				}
			} else if (($population == 'ANSURmen')||($population == 'ANSURwomen')){
				for ($i=0; $i<count($measures); $i++){
					if ($measures[$i]=="ACROMION_HT"){$covIndices[$i]=1;}
					elseif ($measures[$i]=="ACR_RADL_LNTH"){$covIndices[$i]=2;}
	
				elseif ($measures[$i]=="BIACROMIAL_BRTH"){$covIndices[$i]=3;}
	
				elseif ($measures[$i]=="BIDELTOID_BRTH"){$covIndices[$i]=4;}
	
				elseif ($measures[$i]=="BUTTOCK_CIRC"){$covIndices[$i]=5;}
	
				elseif ($measures[$i]=="BUTT_KNEE_LNTH"){$covIndices[$i]=6;}
	
				elseif ($measures[$i]=="CHEST_CIRC"){$covIndices[$i]=7;}
	
				elseif ($measures[$i]=="EYE_HT_SITTING"){$covIndices[$i]=8;}
	
				elseif ($measures[$i]=="FOOT_LNTH"){$covIndices[$i]=9;}
	
				elseif ($measures[$i]=="FOREARM_HAND_LENTH"){$covIndices[$i]=10;}
	
				elseif ($measures[$i]=="HAND_LNTH"){$covIndices[$i]=11;}
	
				elseif ($measures[$i]=="HEAD_CIRC"){$covIndices[$i]=12;}
	
				elseif ($measures[$i]=="HIP_BRTH_SITTING"){$covIndices[$i]=13;}
	
				elseif ($measures[$i]=="KNEE_HT_SITTING"){$covIndices[$i]=14;}
	
				elseif ($measures[$i]=="RADIALE_STYLION_LNTH"){$covIndices[$i]=15;}
	
				elseif ($measures[$i]=="SITTING_HT"){$covIndices[$i]=16;}
		
			elseif ($measures[$i]=="SLEEVE_OUTSEAM_LNTH"){$covIndices[$i]=17;}
	
				elseif ($measures[$i]=="STATURE"){$covIndices[$i]=18;}
	
				elseif ($measures[$i]=="TROCHANTERION_HT"){$covIndices[$i]=19;}
	
				elseif ($measures[$i]=="WAIST_CIRC_OMPHALION"){$covIndices[$i]=20;}
	
				elseif ($measures[$i]=="BMI"){$covIndices[$i]=21;}
	
				elseif ($measures[$i]=="MASS"){$covIndices[$i]=22;}


				}
			}





			// *********************** DATABASE ***********************


			// Initialize the database			


   			//require_once('db_class.php');


            $db = new globalAnthroClass();


            $db->connect();








 			// *********************** CANDIDATE DATA ***********************


 			// build the measures string for the combined query


 			$queryMeasures = implode( ", ", $measures );





 			// get the data associated with the IDs pulled above


 			$candidateData = $db->reducedAnthroData( $queryMeasures,$population );


			


 


 			// *********************** COVARIANCE MATRIX ***********************


            // Get the appropriate covariance matrix--called "reducedCov" here


            // I'm not sure where the best place to store the original (called "covMatrix" here) is. They will all be the same size ~13x13


            // We need to know which row/column corresponds with each measure--can't decide how to manage that until we know how we're storing the covariance matrix


            // **** Remember that indexing in PHP arrays starts at 0! ****





			// get the whole matrix


            $covMatrix = getCovarianceMatrix( $population );





			// reduce to the needed rows


			for ($i=0; $i<count($covIndices); $i++) {


				$covIndices[$i] = $covIndices[$i] - 1;


			}


            $iRcov = 0; 


            foreach( $covIndices as $iCov ) {


            	$jRcov=0;


            	foreach( $covIndices as $jCov ) {


            		$reducedCov[$iRcov][$jRcov] = $covMatrix[$iCov][$jCov];


            		$jRcov++;


            	}


            	$iRcov++;


            }



/*

print "<br>The covariance matrix is: <br> ";


foreach ($reducedCov as $rC ) {


	foreach ($rC as $r ) {


		print $r;


		print " ";


	}


	print "<br>";


}


	print "<br>";


	print "<br>";
*/




$reducedCov = invert( $reducedCov );
/*

print "<br>The inverted covariance matrix is: <br> ";


foreach ($reducedCov as $rC ) {


	foreach ($rC as $r ) {


		print $r;


		print " ";


	}


	print "<br>";


}
*/










 			// *********************** CALCULATE MAHALANOBIS DISTANCE ***********************


//			$chet = matrixMult( $candidateData, $reducedCov );


			$mahalB = array();


			foreach( $candidateData as $x ) {


				$targetDiff = transpose( arraySubtract( $x, $values ) );


				$mahalA = matrixMult( $targetDiff, $reducedCov );


				$mahalB[] = array_flatten( matrixMult( $mahalA, transpose($targetDiff ) ) );


			}


			


			// flatten the results


			$mahal = array();


			foreach ($mahalB as $maB) {


				foreach ($maB as $mB) {


					$mahal[] = sqrt( $mB );


				}


			}





// print_r( $mahal );


// print "<br><br>";





			// sort the results


			asort( $mahal );





// print "<br><br>";


// print "Sorted Mahalanobis distances";


// print_r( $mahal );


			


			// get the IDs


			$sortedMahalKeys = array_keys( $mahal );





// print "<br><br>";


// print "Sorted Mahalanobis keys";


// print_r( $sortedMahalKeys );


// print "<br><br>";


// print "Sorted Mahalanobis keys";


// print $sortedMahalKeys[0];


// print "<br><br>";





			// find the five lowest

/*

			$nearestNeighborIDs = array();


			for ($i=0; $i<5; $i++) {


				$nearestNeighborIDs[] = $sortedMahalKeys[$i]+1;


			}

*/

$nearestNeighborIDs = array();
$closeness = array();
$maxMahal = max( $mahal );
for ($i=0; $i<5; $i++) {
$nearestNeighborIDs[] = $sortedMahalKeys[$i]+1;
$closeness[] = 100*( $maxMahal - $mahal[$sortedMahalKeys[$i]] ) / $maxMahal;
}


/*

echo "<br><br>";


echo "These are the IDs for the five nearest neighbors based on Mahalanobis distance:<br>";			


print_r( $nearestNeighborIDs );
*/

echo 'nearestNeighborIDs:';

for ($i=0;$i<count($nearestNeighborIDs);$i++){
	if ($i == count($nearestNeighborIDs)-1){
		echo $nearestNeighborIDs[$i];
	} else {
		echo $nearestNeighborIDs[$i].',';
	}
}

echo '&&closeness:';

for ($i=0;$i<count($closeness);$i++){
	if ($i == count($closeness)-1){
		echo round( $closeness[$i], 1, PHP_ROUND_HALF_UP);
	} else {
		echo round( $closeness[$i], 1, PHP_ROUND_HALF_UP).',';
	}
}




            


            // Close the database


            $db->disconnect();


			





// **************	INTERNAL FUNCTIONS  *****************





			function matrixMult($m1,$m2){


				$r=count($m1);


				$c=count($m2[0]);


				$p=count($m2);


				if(count($m1[0])!=$p){throw new Exception('Incompatible matrixes');}


				$m3=array();


				for ($i=0;$i< $r;$i++){


					for($j=0;$j<$c;$j++){


						$m3[$i][$j]=0;


						for($k=0;$k<$p;$k++){


							$m3[$i][$j]+=$m1[$i][$k]*$m2[$k][$j];


						}


					}


				}


				return($m3);


			}








			// subtracts x - y


			function arraySubtract($x,$y){


				$nX=count($x);


				$nY=count($y);


				if ($nX != $nY) { throw new Exception('Incompatible arrays'); }				


				$m=array();


				for ( $i=0; $i<$nX; $i++ ) {


					$m[$i] = $x[$i] - $y[$i];


				}


				return($m);


			}








			function transpose($array) {


				$transposed_array = array();


				if ($array) {


					foreach ($array as $row_key => $row) {


						if (is_array($row) && !empty($row)) { //check to see if there is a second dimension


							foreach ($row as $column_key => $element) {


								$transposed_array[$column_key][$row_key] = $element;


							}


						}


						else {


							$transposed_array[0][$row_key] = $row;


						}


					}


					return $transposed_array;


				}


			}


			


			


			function array_flatten($a,$f=array()) {


				if(!$a||!is_array($a))return '';


			  	foreach($a as $k=>$v) {


					if(is_array($v))$f=array_flatten($v,$f);


					else $f[$k]=$v;


			  	}


			  	return $f;


			}





			function getCovarianceMatrix( $popName ) {


				if ($popName == 'NHANESmen') {


					$covMatrix = array(

/* OLD MATRIX

						array( 5716,0.42685,2385.7,804.53,1976.1,1473.4,826.09,454.11,1906.5,2037.3,2143.8 ),


						array( 0.42685,30.798,1.6555,50.012,29.501,17.699,194.78,34.395,600.21,735.48,531.92 ),


						array( 2385.7,1.6555,1468.9,364.39,732.13,525.5,333.79,212.54,941.45,897.89,868.95 ),


						array( 804.53,50.012,364.39,505.51,332.75,253.77,385.76,149.69,1348.5,1503.7,1098.3 ),


						array( 1976.1,29.501,732.13,332.75,968.19,656.33,463.92,198.51,1368,1466.8,1221.6 ),


						array( 1473.4,17.699,525.5,253.77,656.33,654.89,306.15,153.87,935.02,987.09,835.23 ),


						array( 826.09,194.78,333.79,385.76,463.92,306.15,1597,287.83,4044.2,5121.2,3999.3 ),


						array( 454.11,34.395,212.54,149.69,198.51,153.87,287.83,264.04,877.89,1002.4,760.35 ),


						array( 1906.5,600.21,941.45,1348.5,1368,935.02,4044.2,877.89,13355,15363,10980 ),


						array( 2037.3,735.48,897.89,1503.7,1466.8,987.09,5121.2,1002.4,15363,20240,14061 ),


						array( 2143.8,531.92,868.95,1098.3,1221.6,835.23,3999.3,760.35,10980,14061,11069 ) );	
*/
						array(5715.97,0.43,2411.91,790.07,1970.37,1478.73,819.89,489.71,1776.88,1778.28,2152.83,570.59),
						array(0.43,30.8,1.79,57.26,26.65,19.94,192.23,35.25,598.88,730.17,529.41,95.57),
						array(2411.91,1.79,1693.4,418.59,724.41,527.79,412.5,268.23,747.78,823,1032.99,247.55),
						array(790.07,57.26,418.59,531.14,355.54,291.59,432.56,159.41,1400.77,1574.77,1254.33,256.82),
						array(1970.37,26.65,724.41,355.54,857.18,613.8,436.6,204.28,1175.77,1240.1,1195.67,279.35),
						array(1478.73,19.94,527.79,291.59,613.8,605.96,326.05,155.81,853.3,921.45,923.38,209.12),
						array(819.89,192.23,412.5,432.56,436.6,326.05,1581.84,298.43,3914.15,5108.13,3927.48,678.18),
						array(489.71,35.25,268.23,159.41,204.28,155.81,298.43,276.16,856.12,1020.29,805.84,158.22),
						array(1776.88,598.88,747.78,1400.77,1175.77,853.3,3914.15,856.12,13234.38,15111.93,10703.83,2033.51),
						array(1778.28,730.17,823,1574.77,1240.1,921.45,5108.13,1020.29,15111.93,19732.35,13512.63,2441.53),
						array(2152.83,529.41,1032.99,1254.33,1195.67,923.38,3927.48,805.84,10703.83,13512.63,10922.54,1857.75),
						array(570.59,95.57,247.55,256.82,279.35,209.12,678.18,158.22,2033.51,2441.53,1857.75,355.45) );


				} else if ($popName == 'NHANESwomen') {

					$covMatrix = array(
						array(4815.86,-0.2,1919.43,601.64,1588.05,1199.22,937.83,413.64,1279.64,1203.64,2234.47,445.26),
						array(-0.2,50.08,5.7,81.47,30.96,21.38,322.9,59.12,949.03,1193.39,936.76,131.68),
						array(1919.43,5.7,1355.25,296.8,540.64,390.34,400.99,203.94,673.04,649.55,929.19,191.59),
						array(601.64,81.47,296.8,470.69,296.12,241.67,601.37,186.73,1803.73,2109.85,1756.94,271.34),
						array(1588.05,30.96,540.64,296.12,726.44,507.35,514,189.72,1064,1156.42,1289.13,229.26),
						array(1199.22,21.38,390.34,241.67,507.35,534.44,366.82,147.63,741.05,794.53,949.67,168.1),
						array(937.83,322.9,400.99,601.37,514,366.82,2715.15,455.46,6096.42,8056.73,7016.11,935.2),
						array(413.64,59.12,203.94,186.73,189.72,147.63,455.46,343.24,1256.84,1521.5,1293.47,193.95),
						array(1279.64,949.03,673.04,1803.73,1064,741.05,6096.42,1256.84,19790.72,23557.71,17896.32,2613.5),
						array(1203.64,1193.39,649.55,2109.85,1156.42,794.53,8056.73,1521.5,23557.71,31207.82,22874.94,3251.86),
						array(2234.47,936.76,929.19,1756.94,1289.13,949.67,7016.11,1293.47,17896.32,22874.94,19957.51,2670.71),
						array(445.26,131.68,191.59,271.34,229.26,168.1,935.2,193.95,2613.5,3251.86,2670.71,390.04) );


				} else if ($popName == 'ANSURmen') {
				
					$covMatrix = array(
						array(3846.89,874.56,461.44,632.21,1658.91,1517.94,1525.86,1372.71,561.22,1097.73,391.74,313.22,706.85,1555.32,687.9,1442.65,1521.6,3997.39,2600.97,1747.84,12.86,401.24),
						array(874.56,294.39,126.96,172.12,403.32,396.39,383.87,251,141.19,307.86,105.48,75.58,167.22,393.01,201.06,261.89,483.56,918.02,665.77,422.7,4.67,97.81),
						array(461.44,126.96,322.63,306.46,459.03,233.51,520.15,252.3,104.7,190.43,76.18,82.98,171.87,226.96,112.76,260.32,235.75,584.25,337,483.23,15.62,100.88),
						array(632.21,172.12,306.46,672.54,1247.56,363.96,1495.2,297.48,127.94,215.4,86.56,168.65,456.44,289.21,117.54,324.2,269.91,674.45,327.68,1574.67,60.17,247.25),
						array(1658.91,403.32,459.03,1247.56,3866.3,1006.04,3500.56,763.15,317.71,494.79,194.56,407.99,1460.8,737.2,287.51,826.18,620.38,1667.61,789.77,4614.84,163.98,658.39),
						array(1517.94,396.39,233.51,363.96,1006.04,892.23,893.76,350.42,265.68,531.77,189.54,145.51,387.15,704.02,337.98,369.22,699.87,1601.55,1195.38,1001.15,23.52,218.24),
						array(1525.86,383.87,520.15,1495.2,3500.56,893.76,4769.08,637.3,270.58,415.62,163.74,446.55,1310.8,642.03,225.97,706.3,535.25,1440.63,659.09,5006.53,178.29,682.47),
						array(1372.71,251,252.3,297.48,763.15,350.42,637.3,1170.45,167.57,237.72,98.1,131.4,343.82,398.89,120.84,1190.12,394.74,1661.62,588.27,842.64,5.11,166.25),
						array(561.22,141.19,104.7,127.94,317.71,265.68,270.58,167.57,171.52,245.97,103.23,67.09,121,278.68,141.97,178.53,270.82,612.76,440.03,248.91,6.61,75.96),
						array(1097.73,307.86,190.43,215.4,494.79,531.77,415.62,237.72,245.97,544.09,201.11,112.61,185.91,557.61,330.5,250.65,608.08,1167.7,926.72,356.26,7,127.5),
						array(391.74,105.48,76.18,86.56,194.56,189.54,163.74,98.1,103.23,201.11,95.72,49.57,70.8,200.06,107.92,104.4,205.92,424.83,320.07,140.03,3.76,50.15),
						array(313.22,75.58,82.98,168.65,407.99,145.51,446.55,131.4,67.09,112.61,49.57,236.01,154.07,142.66,59.01,165.81,126.25,351.02,184.06,499.64,18.14,88.31),
						array(706.85,167.22,171.87,456.44,1460.8,387.15,1310.8,343.82,121,185.91,70.8,154.07,634.24,295.17,109.1,374.81,255.56,719.33,332.5,1810.49,59.31,248.76),
						array(1555.32,393.01,226.96,289.21,737.2,704.02,642.03,398.89,278.68,557.61,200.06,142.66,295.17,779.07,354.71,423.89,718.6,1650.86,1249.4,687.74,9.48,178.81),
						array(687.9,201.06,112.76,117.54,287.51,337.98,225.97,120.84,141.97,330.5,107.92,59.01,109.1,354.71,245.11,127.33,410.99,727.57,612.36,204.31,2.6,73.94),
						array(1442.65,261.89,260.32,324.2,826.18,369.22,706.3,1190.12,178.53,250.65,104.4,165.81,374.81,423.89,127.33,1265.89,412.44,1761.45,618.32,916.99,6.66,180.14),
						array(1521.6,483.56,235.75,269.91,620.38,699.87,535.25,394.74,270.82,608.08,205.92,126.25,255.56,718.6,410.99,412.44,941.84,1611.75,1225.77,531.28,3.51,157.31),
						array(3997.39,918.02,584.25,674.45,1667.61,1601.55,1440.63,1661.62,612.76,1167.7,424.83,351.02,719.33,1650.86,727.57,1761.45,1611.75,4463.21,2755.38,1590.96,2.82,412.97),
						array(2600.97,665.77,337,327.68,789.77,1195.38,659.09,588.27,440.03,926.72,320.07,184.06,332.5,1249.4,612.36,618.32,1225.77,2755.38,2277.29,554,-7.76,225.35),
						array(1747.84,422.7,483.23,1574.67,4614.84,1001.15,5006.53,842.64,248.91,356.26,140.03,499.64,1810.49,687.74,204.31,916.99,531.28,1590.96,554,7465.72,221.74,830.74),
						array(12.86,4.67,15.62,60.17,163.98,23.52,178.29,5.11,6.61,7,3.76,18.14,59.31,9.48,2.6,6.66,3.51,2.82,-7.76,221.74,9.35,29.16),
						array(401.24,97.81,100.88,247.25,658.39,218.24,682.47,166.25,75.96,127.5,50.15,88.31,248.76,178.81,73.94,180.14,157.31,412.97,225.35,830.74,29.16,128.16) );
					
				
				} else if ($popName == 'ANSURwomen') {
					
					$covMatrix = array(
						array(3351.87,773.32,437.71,501.69,1301.96,1314.26,942.24,1299.83,476.36,986.18,360.02,282.56,544.39,1330.15,613.7,1364,1379.11,3564.76,2269.98,966.65,-2.85,268.33),
						array(773.32,278.3,115.05,135.72,298.47,366.21,229.13,222.12,127.34,301.5,104.45,74.15,117.08,359.22,195.52,226.04,467.24,823.02,618.58,242.12,0.33,64.58),
						array(437.71,115.05,303.28,250.68,342.76,221.41,336.75,218.33,97.16,187.84,74.26,73.26,136.28,217.18,113.05,233.18,226.63,559.59,345.37,307.84,8.27,65.19),
						array(501.69,135.72,250.68,512.2,955.8,321.52,1100.86,226.78,99.77,175.19,73.12,114.41,361.42,222.21,97.03,247.55,226.11,542.34,336.19,1243.67,42.85,156.38),
						array(1301.96,298.47,342.76,955.8,3622.01,980.08,2704.27,685.38,237.75,344.86,150.12,275.79,1489.2,547.89,189.45,737.53,472.97,1381.2,744.54,3674.2,131.49,459.8),
						array(1314.26,366.21,221.41,321.52,980.08,877.92,695.9,288.92,244.1,521.58,189.44,150.53,383.17,648.72,328.04,294.64,682.57,1401.64,1135.78,879.28,21.91,167.17),
						array(942.24,229.13,336.75,1100.86,2704.27,695.9,4034.45,375.06,179.01,239.09,114.45,272.79,1037.9,375.88,122,447.23,309.11,898.25,541.34,4102.67,136.72,435.7),
						array(1299.83,222.12,218.33,226.78,685.38,288.92,375.06,1105.29,135.72,190.68,85.36,95.91,313.19,337.05,95.87,1133.78,334.67,1581.72,533.02,339.26,-2.58,115.2),
						array(476.36,127.34,97.16,99.77,237.75,244.1,179.01,135.72,149.43,230.45,97.59,64.54,88.86,246.44,132.67,140.93,254.54,523.07,388.39,172.3,4.02,51.28),
						array(986.18,301.5,187.84,175.19,344.86,521.58,239.09,190.68,230.45,545.63,200.51,117.89,109.97,530.38,334.49,190.53,619.4,1056.88,881.85,215.72,0.87,84.43),
						array(360.02,104.45,74.26,73.12,150.12,189.44,114.45,85.36,97.59,200.51,93.69,48.44,48.76,191.73,109.36,86.36,209.71,391.25,308.71,101.63,1.88,35.42),
						array(282.56,74.15,73.26,114.41,275.79,150.53,272.79,95.91,64.54,117.89,48.44,214.57,110.23,134.47,71.04,126,141.37,324.26,204.96,269.65,10.5,53.33),
						array(544.39,117.08,136.28,361.42,1489.2,383.17,1037.9,313.19,88.86,109.97,48.76,110.23,742.48,217.89,59.6,340.58,173.81,589.28,283.9,1507.08,52.9,187.56),
						array(1330.15,359.22,217.18,222.21,547.89,648.72,375.88,337.05,246.44,530.38,191.73,134.47,217.89,693.14,335.47,349.72,683.42,1435.05,1122.72,423.26,2.58,118.34),
						array(613.7,195.52,113.05,97.03,189.45,328.04,122,95.87,132.67,334.49,109.36,71.04,59.6,335.47,238.83,94.98,415.68,654.81,569.14,116.12,-1.19,47.76),
						array(1364,226.04,233.18,247.55,737.53,294.64,447.23,1133.78,140.93,190.53,86.36,126,340.58,349.72,94.98,1218.17,339.47,1676.55,550.44,409.67,-1.51,125.44),
						array(1379.11,467.24,226.63,226.11,472.97,682.57,309.11,334.67,254.54,619.4,209.71,141.37,173.81,683.42,415.68,339.47,915.3,1474.47,1168.96,300.85,-2.24,108.18),
						array(3564.76,823.02,559.59,542.34,1381.2,1401.64,898.25,1581.72,523.07,1056.88,391.25,324.26,589.28,1435.05,654.81,1676.55,1474.47,4045.46,2431,891.04,-10.02,286.22),
						array(2269.98,618.58,345.37,336.19,744.54,1135.78,541.34,533.02,388.39,881.85,308.71,204.96,283.9,1122.72,569.14,550.44,1168.96,2431,2046.79,582.58,-4.56,176.16),
						array(966.65,242.12,307.84,1243.67,3674.2,879.28,4102.67,339.26,172.3,215.72,101.63,269.65,1507.08,423.26,116.12,409.67,300.85,891.04,582.58,6841.86,175.46,538.44),
						array(-2.85,0.33,8.27,42.85,131.49,21.91,136.72,-2.58,4.02,0.87,1.88,10.5,52.9,2.58,-1.19,-1.51,-2.24,-10.02,-4.56,175.46,7.28,18.7),
						array(268.33,64.58,65.19,156.38,459.8,167.17,435.7,115.2,51.28,84.43,35.42,53.33,187.56,118.34,47.76,125.44,108.18,286.22,176.16,538.44,18.7,72.47) );

				
				}
				

				return $covMatrix;


			}








			function invert($A, $debug = FALSE)


			{


				/// @todo check rows = columns


			 


				$n = count($A);


			 


				// get and append identity matrix


				$I = identity_matrix($n);


				for ($i = 0; $i < $n; ++ $i) {


					$A[$i] = array_merge($A[$i], $I[$i]);


				}


			 


				if ($debug) {


					echo "\nStarting matrix: ";


					print_matrix($A);


				}


			 


				// forward run


				for ($j = 0; $j < $n-1; ++ $j) {


					// for all remaining rows (diagonally)


					for ($i = $j+1; $i < $n; ++ $i) {


						// adjust scale to pivot row


						// subtract pivot row from current


						$scalar = $A[$j][$j] / $A[$i][$j];


						for ($jj = $j; $jj < $n*2; ++ $jj) {


							$A[$i][$jj] *= $scalar;


							$A[$i][$jj] -= $A[$j][$jj];


						}


					}


					if ($debug) {


						echo "\nForward iteration $j: ";


						print_matrix($A);


					}


				}


			 


				// reverse run


				for ($j = $n-1; $j > 0; -- $j) {


					for ($i = $j-1; $i >= 0; -- $i) {


						$scalar = $A[$j][$j] / $A[$i][$j];


						for ($jj = $i; $jj < $n*2; ++ $jj) {


							$A[$i][$jj] *= $scalar;


							$A[$i][$jj] -= $A[$j][$jj];


						}


					}


					if ($debug) {


						echo "\nReverse iteration $j: ";


						print_matrix($A);


					}


				}


			 


				// last run to make all diagonal 1s


				/// @note this can be done in last iteration (i.e. reverse run) too!


				for ($j = 0; $j < $n; ++ $j) {


					if ($A[$j][$j] !== 1) {


						$scalar = 1 / $A[$j][$j];


						for ($jj = $j; $jj < $n*2; ++ $jj) {


							$A[$j][$jj] *= $scalar;


						}


					}


					if ($debug) {


						echo "\n1-out iteration $j: ";


						print_matrix($A);


					}


				}


			 


				// take out the matrix inverse to return


				$Inv = array();


				for ($i = 0; $i < $n; ++ $i) {


					$Inv[$i] = array_slice($A[$i], $n);


				}


			 


				return $Inv;


			}











			function identity_matrix($n)


			{


				$I = array();


				for ($i = 0; $i < $n; ++ $i) {


					for ($j = 0; $j < $n; ++ $j) {


						$I[$i][$j] = ($i == $j) ? 1 : 0;


					}


				}


				return $I;


			}

		
?>
