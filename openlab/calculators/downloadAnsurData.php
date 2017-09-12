<?php header("Content-type: application/csv");header("Content-Disposition: attachment; filename=".date('dmY')."_csvfile.csv");?>
 <?
 $zScore=array(0=>-1.959964,1=>-1.644853,2=>-1.281551,3=>-1.036433,4=>-0.67449,5=>0,6=>0.67449,7=>1.036433,8=>1.281551,9=>1.644853,10=>1.959964);
 $file = "Dimension\r\n";
 
 $intialDeviation=0;
$dimension=array(); 
$FinalDeviation=array(0,0,0,0);  
$value=array(0=>array(), 1=>array(),2=>array(),3=>array(),4=>array(),5=>array(),6=>array(),7=>array(),8=>array(),9=>array()); 
$dimension=$_POST["dimension"]; 
  //echo ($dimension[31]);
  $size=sizeof($dimension);
$gender1=$_POST["gender"];
$i=0;
$j=0;
 require_once('accessAnyDatabase1.php');//Access DataBase
				 $db = new center_members();
				 $Database1="/sqlLiteDatabases/Male.sqlite";
				 $db->connect($Database1);
				 $table="MainAnsur".$gender1[0];
				// echo $table;
			for($i=0; $i< $size; $i++)
			{
				$k=0;
				 $members=$db->getMembers(0,$table,$dimension[$i]);
			if ($members !== FALSE)
             {
			 foreach ($members as $member)
  				{
					$L=0;
					 for($j=0; $L<1; $j++)
					 {
					 $value[$i][$k]=$member[$dimension[$i]];
					 $average[$i]+=$member[$dimension[$i]];
					 $L=1;
					 $k=$k+1;
					 $file .=$member[$dimension[$i]]."\r\n";
					 }
				}		
			  }
			 $average[$i]=$average[$i]/sizeof($members);
			 //Calculate Standard Deviation
			 		for($f=0; $f<$k+1; $f++)
					{
					 	$intialDeviation=$value[$i][$f]-$average[$i];
						
						$intialDeviation=$intialDeviation*$intialDeviation;
						$finalDeviation[$i]+=$intialDeviation;
					}
					$finalDeviation[$i]=$finalDeviation[$i]/($k-1);
					$finalDeviation[$i]=sqrt($finalDeviation[$i]);
					
		 			
					for($f=0; $f<sizeof($zScore); $f++)
					{
					$valueatPercentil[$i][$f]=($zScore[$f]*$finalDeviation[$i])+$average[$i];
					$valueatPercentil[$i][$f]=round($valueatPercentil[$i][$f]);
					//echo $valueatPercentil[$i][$f]." ";
					
					}	
		 	//Retreive Z score:
		 
		 
		 }
		 
		 
    	/*for($i=0; $i< $size; $i++)
		{
 		echo $value[$i][3]."<br/>";
		} */
		   	
 $db->disconnect();		
 	 
 				 require_once('accessAnyDatabase2.php');//Access DataBase
				 $db1 = new center_members1();
				 $Database2="/sqlLiteDatabases/Male.sqlite";
				 $db1->connect($Database2);
				 $table1="AnsurDescription";
				 for($i=0; $i< $size; $i++)
				{
				$k=0;
				 $members=$db1->getMembers(0,$table1,$dimension[$i]);
				// echo ($dimension[$i]."<br/>");
				if ($members !== FALSE)
					 {
							 foreach ($members as $member)
							{
								$L=0;
								 for($j=0; $L<1; $j++)
								 {
								$description[$i][$k]=$member[$dimension[$i]];
								//echo $description[$i][$k]."<br>";
								 $L=1;
					 			$k=$k+1;
								}
						
							}
					}
				
				}	

			    	/*for($i=0; $i< $size; $i++)
					{
						echo $description[$i]."<br/>";
					}*/
					
echo $file; 
?>
