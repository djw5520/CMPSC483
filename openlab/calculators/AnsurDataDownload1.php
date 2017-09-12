<?php header("Content-type: application/csv"); $dimension=$_POST["dimension"]; header("Content-Disposition: attachment; filename=".$dimension."Download.csv");?>
 <?
 $m=0;
 $f=0;
 //$zScore=array(0=>-1.959964,1=>-1.644853,2=>-1.281551,3=>-1.036433,4=>-0.67449,5=>0,6=>0.67449,7=>1.036433,8=>1.281551,9=>1.644853,10=>1.959964);
   //$file ="Raw Data for ".$dimension."\r\n";
  //$file.="Downloaded ".date('l F Y h:i A')."\r\n";
 $gender1=$_POST["gender"];
$sizeOf=$_POST["sizeOf"];
			for($i=0; $i<$sizeOf; $i++)
			{
			$dimension[$i]=$_POST["dimension".$i];
				if($i==$sizeOf-1)
				{
				$header=$header.$dimension[$i]."\r\n";
				}
				else
				{
				$header=$header.$dimension[$i].",";
				}
			}
			
$value=array(0=>array(), 1=>array(),2=>array(),3=>array(),4=>array(),5=>array(),6=>array(),7=>array(),8=>array(),9=>array()); 
  //echo ($dimension[31]);
$i=0;
$j=0;
 			require_once('accessAnyDatabase1.php');//Access DataBase
				 $db = new center_members();
				 $Database1="/sqlLiteDatabases/Male.sqlite";
				 $db->connect($Database1);
				 $table="MainAnsur".$gender1;
				// echo $table;
			for($i=0; $i< $sizeOf; $i++)
			{
				$k=0;
				 $members=$db->getMembers(0,$table,$dimension[$i]);
			if ($members !== FALSE)
             {
			 $m++;
			 foreach ($members as $member)
  				{
					$L=0;
					 for($j=0; $L<1; $j++)
					 {
						 if($m<2)
						 {
						 $f++;
						 }
					 $value[$i][$k]=$member[$dimension[$i]];
					// $file.= $value[$i][$k]."\r\n";
					 $L=1;
					 $k=$k+1;
					 }
				}	
			 }
			 }
		$file=$header;
		for($k=0; $k<$f; $k++)
		{
			for($i=0; $i<$sizeOf; $i++)
			{
				if($i==$sizeOf-1)
				{
				$file.=$value[$i][$k]."\r\n";
				}
				else
				{
				$file.=$value[$i][$k].",";
				}
			}
		}
		echo $file;
		$db->disconnect();		
 	 
?>
