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


			// We need the indices that relate the input measures to the covariance matrix


            // *** measure numbers starts at 1--it will be changed to PHP's 0-indexing below ***


            //$covIndices = array( 1,5,7,9 );
			
			/*
			1 STATURE
			2 BMI
			3 SITTING_HT (well, ratio of stature to sitting height, but we're changing that in the final one)
			4 BIACROMIAL_BRTH
			5 KNEE_HT_SITTING
			6 FOREARM_HAND_LENTH
			7 HIP_BRTH_SITTING
			8 HEAD_CIRC
			9 CHEST_CIRC
			10 WAIST_CIRC_OMPHALION
			11 HIP_CIRC_AT_BUTTOCKS
			*/
			
			$covIndices = array();
			
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

				elseif ($measures[$i]=="HIP_CIRC_AT_BUTTOCKS"){$covIndices[$i]=11;}
			}


						


			// We also need an array of target values (in the same order as the measurements)


			//$values = array( 1634,512,327,892 );

			$values = $_POST["values"];
			$values = explode(",",$values);	


			


			// We need the population name (e.g., UScivilian, Indian, whatever)


			//$population = "UScivilianMales";
			$population = $_POST["population"];

			


			// We need the gender; MALES or FEMALES


			//$gender = "MALES";
			$gender_ = $_POST["gender"];
			
			if ($gender_==1){
				$gender = "MALES";
			}elseif ($gender_==2){
				$gender = "FEMALES";
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

print "<br><br>";


print "These are the IDs for the five nearest neighbors based on Mahalanobis distance:<br>";			


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
		echo round( $closeness[$i], 2, PHP_ROUND_HALF_UP);
	} else {
		echo round( $closeness[$i], 2, PHP_ROUND_HALF_UP).',';
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


				if ($popName == 'UScivilianMales') {


					$covMatrix = array(


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
