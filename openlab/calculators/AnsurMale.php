
<?php	

			
			//Create Array
			$rowValue=array(0=>array(), 1=>array(),2=>array(),3=>array(),4=>array(),5=>array(),6=>array(),7=>array(),8=>array(),9=>array());
             require_once('AcessAnsurMale.php');
             $db = new center_members();
			 $Database1=$_GET["database1"];
			 $db->connect($Database1);
			 $members = $db->getMembers(); //get all members
			$percentile1=$_GET["p"];
			$race1=$_GET["r"];
			$i=0;
			$j=0;
			
		    if ($members !== FALSE)
             {
			  	
                 foreach ($members as $member)
                 {	
					 $k=0;
					 for($j=0; $k<1; $j++)
						{
							$rowValue[$i][$j]=$member['Ethnicity'];
							$rowValue[$i][$j+1]=$member['five'];
							$rowValue[$i][$j+2]=$member['ten'];
							$rowValue[$i][$j+3]=$member['fifteen'];
							$rowValue[$i][$j+4]=$member['twentyFive'];
							$rowValue[$i][$j+5]=$member['Fifty'];
							$rowValue[$i][$j+6]=$member['seventyFive'];
							$rowValue[$i][$j+7]=$member['eightyFive'];
							$rowValue[$i][$j+8]=$member['ninty'];
							$rowValue[$i][$j+9]=$member['nintyFive'];
							$k=1;
							$i=$i+1;
							
						
						
						}
				}


			} 
			else {
					 print ("Error fetching members.\n");
				 }
				 
				
			if($race1=="All")
				{
						
				switch ($percentile1)
					{
						case "5th":	
						print($rowValue[0][1]);
						break;	
						
							
						case "10th":
						print($rowValue[0][2]);
						break;	
						
						
						case "15th":
						print($rowValue[0][3]);
						break;
						
						case "25th":
						print($rowValue[0][5]);
						break;
						
						case "50th":
						print($rowValue[0][5]);
						break;
						
						case "75th":
						print($rowValue[0][6]);
						break;
						
						case "85th":
						print($rowValue[0][7]);
						break;
						
						case "90th":
						print($rowValue[0][8]);
						break;
						
						case "95th":
						print($rowValue[0][9]);
						break;
						default:
							
						print(' '. 'It is working');
					}
				}/*
				
				else if($race1=="Mexican")
				{
				switch ($percentile1)
					{
						case "5th":	
						print($rowValue[1][1]);
						break;	
						
							
						case "10th":
						print($rowValue[1][2]);
						break;	
						
						
						case "15th":
						print($rowValue[1][3]);
						break;
						
						case "25th":
						print($rowValue[1][4]);
						break;
						
						case "50th":
						print($rowValue[1][5]);
						break;
						
						case "75th":
						print($rowValue[1][6]);
						break;
						
						case "85th":
						print($rowValue[1][7]);
						break;
						
						case "90th":
						print($rowValue[1][8]);
						break;
						
						case "95th":
						print($rowValue[1][9]);
						break;
						default:
							
						print(' '. 'It is working');
					}
				}
				
				else if($race1=="Black")
				{
				switch ($percentile1)
					{
						case "5th":	
						print($rowValue[2][1]);
						break;	
						
							
						case "10th":
						print($rowValue[2][2]);
						break;	
						
						
						case "15th":
						print($rowValue[2][3]);
						break;
						
						case "25th":
						print($rowValue[2][4]);
						break;
						
						case "50th":
						print($rowValue[2][5]);
						break;
						
						case "75th":
						print($rowValue[2][6]);
						break;
						
						case "85th":
						print($rowValue[2][7]);
						break;
						
						case "90th":
						print($rowValue[2][8]);
						break;
						
						case "95th":
						print($rowValue[2][9]);
						break;
						default:
							
						print(' '. 'It is working');
					}
				}
					else if($race1=="White")
				{
				switch ($percentile1)
					{
						case "5th":	
						print($rowValue[3][1]);
						break;	
						
							
						case "10th":
						print($rowValue[3][2]);
						break;	
						
						
						case "15th":
						print($rowValue[3][3]);
						break;
						
						case "25th":
						print($rowValue[3][4]);
						break;
						
						case "50th":
						print($rowValue[3][5]);
						break;
						
						case "75th":
						print($rowValue[3][6]);
						break;
						
						case "85th":
						print($rowValue[3][7]);
						break;
						
						case "90th":
						print($rowValue[3][8]);
						break;
						
						case "95th":
						print($rowValue[3][9]);
						break;
						default:
							
						print(' '. 'It is working');
					}
				}*/
             $db->disconnect();
		
         ?>

