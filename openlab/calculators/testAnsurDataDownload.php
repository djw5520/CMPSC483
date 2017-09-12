<?php header("Content-type: application/csv");header("Content-Disposition: attachment; filename=".date('dmY')."_csvfile.csv");?>
 <?
 //$zScore=array(0=>-1.959964,1=>-1.644853,2=>-1.281551,3=>-1.036433,4=>-0.67449,5=>0,6=>0.67449,7=>1.036433,8=>1.281551,9=>1.644853,10=>1.959964);
 $file = "Dimension\r\n";
 $gender=$_GET["m"];
$dimension=$_GET["d"];
 $intialDeviation=0;
$dimension=array(); 
$FinalDeviation=array(0,0,0,0);  
$value=array(0=>array(), 1=>array(),2=>array(),3=>array(),4=>array(),5=>array(),6=>array(),7=>array(),8=>array(),9=>array()); 
$dimension=$_POST["dimension"]; 
  //echo ($dimension[31]);
$i=0;
$j=0;
 require_once('accessAnyDatabase1.php');//Access DataBase
				 $db = new center_members();
				 $Database1="/sqlLiteDatabases/Male.sqlite";
				 $db->connect($Database1);
				 $table="MainAnsur".$gender;
				// echo $table;
$members=$db->getMembers(0,$table,$dimension);
			
			if ($members !== FALSE)
             {
			 foreach ($members as $member)
  				{
					$L=0;
					 for($j=0; $L<1; $j++)
					 {
					 $file .=$member[$dimension]."\r\n";
					 }
				}		
			  }
		echo $file; 

	
		   	
 $db->disconnect();		
 	 
?>
