
<?php	

			
			//Create Array
			$rowValue=array(0=>array(), 1=>array(),2=>array(),3=>array(),4=>array(),5=>array(),6=>array(),7=>array(),8=>array(),9=>array());
             require_once('AcessBoundaryRatio.php');
             $db = new center_members();
			 $db->connect($Database1);
			 $members = $db->getMembers(); //get all members
			$maleOrFemale=$_GET["m"];
			$dimension=$_GET["d"];
			$upper=$_GET["u"];
			$lower=$_GET["l"];
			$poundsOrKg=$_GET["p"];
			$inchesOrMm=$_GET["i"];
			$inchesOrMm1=$_GET["i1"];
			$poundsOrKg1=$_GET["p1"];
			$inchSelectOrMmSelect=$_GET["F"];

			$i=0;
			$j=0;
			
		    if ($members !== FALSE)
             {
			  	
                 foreach ($members as $member)
                 {	
					 $k=0;
					 for($j=0; $k<1; $j++)
						{
							$rowValue[$i][$j]=$member['Dimension'];
							$rowValue[$i][$j+1]=$member['MaleQa'];
							$rowValue[$i][$j+2]=$member['MaleRa'];
							$rowValue[$i][$j+3]=$member['FemaleQa'];
							$rowValue[$i][$j+4]=$member['FemaleRa'];
							$k=1;
							$i=$i+1;
							
						
						
						}
				}


			} 
			else {
					 print ("Error fetching members.\n");
				 }
				 
	if($maleOrFemale=="Male")
	{
		switch ($dimension)
		{
			case "acromialHt":
			$Qa=$rowValue[0][1];
			$Ra=$rowValue[0][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}			
			break;
		
		
		
			case "trochanterionHt":
			$Qa=$rowValue[1][1];
			$Ra=$rowValue[1][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;

			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
		
		
		
			case "latFemoralEpicondyleHt":
			$Qa=$rowValue[2][1];
			$Ra=$rowValue[2][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
		
		
			case "latMalleolusHt":
			$Qa=$rowValue[3][1];
			$Ra=$rowValue[3][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inchOrLbs")
			{
			echo "<span style='background-color:#000000; color:#FFFFFF; width:auto; margin-right:5px;'>" .round($inchesOrMmUpper, 2). "</span>";
			echo "<span style='background-color:#FFFFFF; color:#000000; width:auto;'>" .round($inchesOrMmLower, 2). "</span>";
			}
			else
			{
			echo "<span style='background-color:#000000; color:#FFFFFF; width:auto; margin-right:5px;'>" .round($inchesOrMmUpper). "</span>";
			echo "<span style='background-color:#FFFFFF; color:#000000; width:auto;'>" .round($inchesOrMmLower). "</span>";
			}
			
			break;
		
		
			case "handIn":
			$Qa=$rowValue[4][1];
			$Ra=$rowValue[4][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
		
			
			case "radialeStylonLn":
			$Qa=$rowValue[5][1];
			$Ra=$rowValue[5][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
			
			case "acromionRadialeln":
			$Qa=$rowValue[6][1];
			$Ra=$rowValue[6][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;

			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
		
			case "popLitealHt":
			$Qa=$rowValue[7][1];
			$Ra=$rowValue[7][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
			
			case "buttockPoplitealLn":
			$Qa=$rowValue[8][1];
			$Ra=$rowValue[8][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<span style='background-color:#000000; color:#FFFFFF; width:auto; margin-right:5px;'>" .round($inchesOrMmUpper, 2). "</span>";
			echo "<span style='background-color:#FFFFFF; color:#000000; width:auto;'>" .round($inchesOrMmLower, 2). "</span>";
			}
			else
			{
			echo "<span style='background-color:#000000; color:#FFFFFF; width:auto; margin-right:5px;'>" .round($inchesOrMmUpper, 2). "</span>";
			echo "<span style='background-color:#FFFFFF; color:#000000; width:auto;'>" .round($inchesOrMmLower, 2). "</span>";
			}	

			break;
			
			case "acromialHtSit":
			$Qa=$rowValue[9][1];
			$Ra=$rowValue[9][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;		
		
			case "eyeHtSit":
			$Qa=$rowValue[10][1];
			$Ra=$rowValue[10][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
		

			case "sittingHt":
			$Qa=$rowValue[11][1];
			$Ra=$rowValue[11][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
						
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
		
		
			case "thumbTipReach":
			$Qa=$rowValue[12][1];
			$Ra=$rowValue[12][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			$value[0]=round($inchesOrMmUpper, 2);
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			$value[1]=round($inchesOrMmLower, 2);
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>thumbtip Reach</td><td>".$value[0]."</td><td>".$value[1]."</td></tr></table>";
			}
			else
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>thumbtip Reach</td><td>".$value[0]."</td><td>".$value[1]."</td></tr></table>";
			}
			break;
		
	
			case "biacromialBdh":
			$Qa=$rowValue[13][1];
			$Ra=$rowValue[13][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			$inchesOrMmUpper=round($inchesOrMmUpper, 2);
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			$inchesOrMmLower=round($inchesOrMmLower, 2);
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>* biacromial bdh</td><td>".$inchesOrMmUpper."</td><td>".$inchesOrMmLower."</td></tr></table>";
			}
			else
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>* biacromial bdh</td><td>".round($inchesOrMmUpper)."</td><td>".round($inchesOrMmLower)."</td></tr></table>";
			}
			break;
		
		
			case "bideltoidBdh":
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			 $valueUp=($poundsOrKg*703)/($inchesOrMm*$inchesOrMm);
			 $valueLow=($poundsOrKg1*703)/($inchesOrMm1*$inchesOrMm1);
			
			}
			else if($inchSelectOrMmSelect=="MM/kg")
			{
			 $valueUp=$poundsOrKg/(($inchesOrMmLower*1000)^2);
			 $valueLow=$poundsOrKg1/(($inchesOrMmLower1*1000)^2);
			 }
			
			$Qa=$rowValue[14][1];
			$Ra=$rowValue[14][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$valueUpper=$valueUp*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$valueLower=$valueLow*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>*+ bideltoid Bdh</td><td>".round($valueUpper,2)."</td><td>".round($valueLower,2)."</td></tr></table>";
			}
			else
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>*+ bideltoid Bdh</td><td>".round($valueUpper)."</td><td>".round($valueLower)."</td></tr></table>";
			}
			break;
		
			
			case "hipBdhSit":
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			 $valueUp=($poundsOrKg*703)/($inchesOrMm*$inchesOrMm);
			 $valueLow=($poundsOrKg1*703)/($inchesOrMm1*$inchesOrMm1);

			}
			else if($inchSelectOrMmSelect=="MM/kg")
			{
			 $valueUp=$poundsOrKg/(($inchesOrMmLower*1000)^2);
			 $valueLow=$poundsOrKg1/(($inchesOrMmLower1*1000)^2);
			 }
			
			$Qa=$rowValue[15][1];
			$Ra=$rowValue[15][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$valueUpper=$valueUp*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$valueLower=$valueLow*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>hip-Bdh Sit</td><td>".round($valueUpper,2)."</td><td>".round($valueLower,2)."</td></tr></table>";
			}
			else
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>hip-Bdh Sit</td><td>".round($valueUpper)."</td><td>".round($valueLower)."</td></tr></table>";
			}
			break;
		
		
		
			case "waistBdh":
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			 $valueUp=($poundsOrKg*703)/($inchesOrMm*$inchesOrMm);
			  $valueLow=($poundsOrKg1*703)/($inchesOrMm1*$inchesOrMm1);
			}
			else if($inchSelectOrMmSelect=="MM/kg")
			{
			 $valueUp=$poundsOrKg/(($inchesOrMmLower*1000)^2);
			 $valueLow=$poundsOrKg1/(($inchesOrMmLower1*1000)^2);
			 }
			
			$Qa=$rowValue[16][1];
			$Ra=$rowValue[16][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$valueUpper=$valueUp*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$valueLower=$valueLow*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>waist Bdh</td><td>".round($valueUpper,2)."</td><td>".round($valueLower,2)."</td></tr></table>";
			}
			else
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>waist Bdh</td><td>".round($valueUpper)."</td><td>".round($valueLower)."</td></tr></table>";
			}
			break;
		
		
		
			case "waistCirc":
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			 $valueUp=($poundsOrKg*703)/($inchesOrMm*$inchesOrMm);
			 $valueLow=($poundsOrKg1*703)/($inchesOrMm1*$inchesOrMm1);
			
			}
			else if($inchSelectOrMmSelect=="MM/kg")
			{
			 $valueUp=$poundsOrKg/(($inchesOrMmLower*1000)^2);
			 $valueLow=$poundsOrKg1/(($inchesOrMmLower1*1000)^2);
			 }
			
			$Qa=$rowValue[17][1];
			$Ra=$rowValue[17][2];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$valueUpper=$valueUp*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$valueLower=$valueLow*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>waist Circ</td><td>".round($valueUpper,2)."</td><td>".round($valueLower,2)."</td></tr></table>";
			}
			else
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension/strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>waist Circ</td><td>".round($valueUpper)."</td><td>".round($valueLower)."</td></tr></table>";
			}
			break;
			
		}
	}
	
		else if($maleOrFemale=="Female")
	{
		switch ($dimension)
		{
			case "acromialHt":
			$Qa=$rowValue[0][3];
			$Ra=$rowValue[0][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}			
			break;
		
		
		
			case "trochanterionHt":
			$Qa=$rowValue[1][3];
			$Ra=$rowValue[1][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;

			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
		
		
		
			case "latFemoralEpicondyleHt":
			$Qa=$rowValue[2][3];
			$Ra=$rowValue[2][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
		
		
			case "latMalleolusHt":
			$Qa=$rowValue[3][3];
			$Ra=$rowValue[3][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inchOrLbs")
			{
			echo "<span style='background-color:#000000; color:#FFFFFF; width:auto; margin-right:5px;'>" .round($inchesOrMmUpper, 2). "</span>";
			echo "<span style='background-color:#FFFFFF; color:#000000; width:auto;'>" .round($inchesOrMmLower, 2). "</span>";
			}
			else
			{
			echo "<span style='background-color:#000000; color:#FFFFFF; width:auto; margin-right:5px;'>" .round($inchesOrMmUpper). "</span>";
			echo "<span style='background-color:#FFFFFF; color:#000000; width:auto;'>" .round($inchesOrMmLower). "</span>";
			}

			break;
		
		
			case "handIn":
			$Qa=$rowValue[4][3];
			$Ra=$rowValue[4][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
		
			
			case "radialeStylonLn":
			$Qa=$rowValue[5][3];
			$Ra=$rowValue[5][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
			
			case "acromionRadialeln":
			$Qa=$rowValue[6][3];
			$Ra=$rowValue[6][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;

			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
		
			case "popLitealHt":
			$Qa=$rowValue[7][3];
			$Ra=$rowValue[7][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
			
			case "buttockPoplitealLn":
			$Qa=$rowValue[8][3];
			$Ra=$rowValue[8][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<span style='background-color:#000000; color:#FFFFFF; width:auto; margin-right:5px;'>" .round($inchesOrMmUpper, 2). "</span>";
			echo "<span style='background-color:#FFFFFF; color:#000000; width:auto;'>" .round($inchesOrMmLower, 2). "</span>";
			}
			else
			{
			echo "<span style='background-color:#000000; color:#FFFFFF; width:auto; margin-right:5px;'>" .round($inchesOrMmUpper, 2). "</span>";
			echo "<span style='background-color:#FFFFFF; color:#000000; width:auto;'>" .round($inchesOrMmLower, 2). "</span>";
			}	

			break;
			
			case "acromialHtSit":
			$Qa=$rowValue[9][3];
			$Ra=$rowValue[9][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;		
		
			case "eyeHtSit":
			$Qa=$rowValue[10][3];
			$Ra=$rowValue[10][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
		

			case "sittingHt":
			$Qa=$rowValue[11][3];
			$Ra=$rowValue[11][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
						
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper, 2). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower, 2). "</div>";
			}
			else
			{
			echo "<div style='background-color:#000000; color:#FFFFFF; width:auto; margin-bottom:5px;'>" .round($inchesOrMmUpper). "</div>";
			echo "<div style='background-color:#FFFFFF; color:#000000; width:auto;margin-bottom:5px;''>" .round($inchesOrMmLower). "</div>";
			}	

			break;
		
		
			case "thumbTipReach":
			$Qa=$rowValue[12][3];
			$Ra=$rowValue[12][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			$value[0]=round($inchesOrMmUpper, 2);
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			$value[1]=round($inchesOrMmLower, 2);
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>thumbtip Reach</td><td>".$value[0]."</td><td>".$value[1]."</td></tr></table>";
			}
			else
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>thumbtip Reach</td><td>".$value[0]."</td><td>".$value[1]."</td></tr></table>";
			}
			break;
		
	
			case "biacromialBdh":
			$Qa=$rowValue[13][3];
			$Ra=$rowValue[13][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$inchesOrMmUpper=$inchesOrMm*$BaUpper;
			$inchesOrMmUpper=round($inchesOrMmUpper, 2);
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$inchesOrMmLower=$inchesOrMm1*$BaLower;
			$inchesOrMmLower=round($inchesOrMmLower, 2);
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>* biacromial bdh</td><td>".$inchesOrMmUpper."</td><td>".$inchesOrMmLower."</td></tr></table>";
			}
			else
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>* biacromial bdh</td><td>".round($inchesOrMmUpper)."</td><td>".round($inchesOrMmLower)."</td></tr></table>";
			}
			break;
		
		
			case "bideltoidBdh":
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			 $valueUp=($poundsOrKg*703)/($inchesOrMm*$inchesOrMm);
			 $valueLow=($poundsOrKg1*703)/($inchesOrMm1*$inchesOrMm1);
			
			}
			else if($inchSelectOrMmSelect=="MM/kg")
			{
			 $valueUp=$poundsOrKg/(($inchesOrMmLower*1000)^2);
			 $valueLow=$poundsOrKg1/(($inchesOrMmLower1*1000)^2);
			 }
			
			$Qa=$rowValue[14][3];
			$Ra=$rowValue[14][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$valueUpper=$valueUp*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$valueLower=$valueLow*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>*+ bideltoid Bdh</td><td>".round($valueUpper,2)."</td><td>".round($valueLower,2)."</td></tr></table>";
			}
			else
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>*+ bideltoid Bdh</td><td>".round($valueUpper)."</td><td>".round($valueLower)."</td></tr></table>";
			}
			break;
		
			
			case "hipBdhSit":
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			 $valueUp=($poundsOrKg*703)/($inchesOrMm*$inchesOrMm);
			 $valueLow=($poundsOrKg1*703)/($inchesOrMm1*$inchesOrMm1);

			}
			else if($inchSelectOrMmSelect=="MM/kg")
			{
			 $valueUp=$poundsOrKg/(($inchesOrMmLower*1000)^2);
			 $valueLow=$poundsOrKg1/(($inchesOrMmLower1*1000)^2);
			 }
			
			$Qa=$rowValue[15][3];
			$Ra=$rowValue[15][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$valueUpper=$valueUp*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$valueLower=$valueLow*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>hip-Bdh Sit</td><td>".round($valueUpper,2)."</td><td>".round($valueLower,2)."</td></tr></table>";
			}
			else
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>hip-Bdh Sit</td><td>".round($valueUpper)."</td><td>".round($valueLower)."</td></tr></table>";
			}
			break;
		
		
		
			case "waistBdh":
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			 $valueUp=($poundsOrKg*703)/($inchesOrMm*$inchesOrMm);
			 $valueLow=($poundsOrKg1*703)/($inchesOrMm1*$inchesOrMm1);
			}
			else if($inchSelectOrMmSelect=="MM/kg")
			{
			 $valueUp=$poundsOrKg/(($inchesOrMmLower*1000)^2);
			 $valueLow=$poundsOrKg1/(($inchesOrMmLower1*1000)^2);
			 }
			
			$Qa=$rowValue[16][3];
			$Ra=$rowValue[16][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$valueUpper=$valueUp*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$valueLower=$valueLow*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>waist Bdh</td><td>".round($valueUpper,2)."</td><td>".round($valueLower,2)."</td></tr></table>";
			}
			else
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>waist Bdh</td><td>".round($valueUpper)."</td><td>".round($valueLower)."</td></tr></table>";
			}
			break;
		
		
		
			case "waistCirc":
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			 $valueUp=($poundsOrKg*703)/($inchesOrMm*$inchesOrMm);
			 $valueLow=($poundsOrKg1*703)/($inchesOrMm1*$inchesOrMm1);
			
			}
			else if($inchSelectOrMmSelect=="MM/kg")
			{
			 $valueUp=$poundsOrKg/(($inchesOrMmLower*1000)^2);
			 $valueLow=$poundsOrKg1/(($inchesOrMmLower1*1000)^2);
			 }
			
			$Qa=$rowValue[17][3];
			$Ra=$rowValue[17][4];
			$up=$upper;
			$upper=0.01*$upper;
			
			$BaUpper=$Qa *log10(($upper)/(1-$upper)) +$Ra;	
			$valueUpper=$valueUp*$BaUpper;
			
			$low=$lower;
			$lower=0.01*$lower;
			$BaLower=$Qa *log10(($lower)/(1-$lower)) +$Ra;	
			$valueLower=$valueLow*$BaLower;
			
			if($inchSelectOrMmSelect=="inches/lbs")
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension</strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>waist Circ</td><td>".round($valueUpper,2)."</td><td>".round($valueLower,2)."</td></tr></table>";
			}
			else
			{
			echo "<table border='1'><tr align='center'><td><strong>Dimension/strong></td><td><strong>".$up." Percentile</strong></td><td><strong>".$low." Percentile</strong></td></tr><tr align='center'><td>waist Circ</td><td>".round($valueUpper)."</td><td>".round($valueLower)."</td></tr></table>";
			}
			break;
			
			
		}
	}
		
		
             $db->disconnect();
		
         ?>

