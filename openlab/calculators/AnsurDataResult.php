<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Open Design Lab Tools: ANSUR Database Calculator</title>

<script  language="javascript" src="tween.js" type="text/ecmascript">
</script>
<script type="text/javascript" src="browser_detect.js"></script>
<script language="javascript" type="text/javascript">
imageDetect= new Array();
entranceValue= new Array();

percentile=15; 
function rewind(pic,num,pictureHeight)/* This is the function that collapses the container which contains the dimension's data*/
{
	  t2 = new Tween(document.getElementById('collapse'+num).style,'height',Tween.regularEaseInOut,pictureHeight,23,1,'px');
	  t2.start();
	document.getElementById(pic).src="images/arrowSide.png";
}
function changePic(pic,num)/* This is the function that expands the container which contains the dimension's data*/
{
	pictureHeight=document.getElementById('DimensionPic'+num).height;
	containerHeight=document.getElementById('rightcolumn1'+num).style.height;
	containerHeight=pictureHeight;
	containerHeight1=containerHeight+"px";
	document.getElementById('rightcolumn1'+num).style.height=containerHeight1;
	mainContainerHeight=containerHeight+190;

	if(imageDetect[num]==0)//THIS 
	{
		document.getElementById(pic).src="images/arrowDown1.png";
	  t1 = new Tween(document.getElementById('collapse'+num).style,'height',Tween.regularEaseInOut,23,mainContainerHeight,1,'px');
	  t1.start();
	  imageDetect[num]=1;
	}
	else if(imageDetect[num]==1)
	{
	imageDetect[num]=0;
	var x=rewind(pic,num,mainContainerHeight);
	}
}

/*function upperPercentile(inputSelected,picture)
{
	percentile+=5;
	if( percentile<0 || percentile>50)
	{
	}
	else
	{
	inputSelected1=inputSelected+percentile;
	pastPercentile=document.getElementById(inputSelected);
	document.getElementById(picture).style.background='url(images/background'+percentile+'.png)';
	pastPercentile.value=document.getElementById(inputSelected1).innerHTML;
	}
}
function lowerPercentile(inputSelected,picture)
{
	percentile-=5;
	if( percentile<0 || percentile>50)
	{
	}
	else
	{
	inputSelected1=inputSelected+percentile;
	pastPercentile=document.getElementById(inputSelected);
	image="images/background"+percentile+".png";
	document.getElementById(picture).style.background='url(images/background'+percentile+'.png)';
	pastPercentile.value=document.getElementById(inputSelected1).innerHTML;
	}

}*/

function download1()
{
var x= document.values.submit();
}

</script>
<style type="text/css">
<!--
@import url("CSSDesignFolder/AnsurDataResultCSS.css");
-->
</style>
</head>


 <?php
 //header("Content-type: application/csv");
//header("Content-Disposition: attachment; filename=".date('dmY')."_csvfile.csv");
 $percentZscore=array(0=>array(), 1=>array());
$Zscore=array('percentile','zScore');
 $per=array(0.01,0.025,0.05,0.1,0.25,0.5,0.75,0.90,0.95,0.975,0.99);
 $zScore=array(0=>-2.326348,1=>-1.959964,2=>-1.644853,3=>-1.281551,4=>-1.036433,5=>0,6=>1.036433,7=>1.281551,8=>1.644853,9=>1.959964,10=>2.326348);
 $file = "Dimension\r\n";
 $counter=0;
 $intialDeviation=0;
$dimension=array(); 
$FinalDeviation=array(0,0,0,0);  
$value=array(0=>array(), 1=>array(),2=>array(),3=>array(),4=>array(),5=>array(),6=>array(),7=>array(),8=>array(),9=>array()); 
$graphValue=array(0=>array(), 1=>array(),2=>array(),3=>array(),4=>array(),5=>array(),6=>array(),7=>array(),8=>array(),9=>array()); 
$dimension=$_POST["dimension"]; 
  //echo ($dimension[31]);
  $size=sizeof($dimension);
$gender1=$_POST["gender"];
$i=0;
$j=0;
$actual_percentile=array(0=>array(), 1=>array(),2=>array(),3=>array(),4=>array(),5=>array(),6=>array(),7=>array(),8=>array(),9=>array()); 
 			//Retreives all 100  Zscores
	/*			require_once('accessAnyDatabase2.php');//Access DataBase
				 $db1 = new center_members1();
				 $Database2="/sqlLiteDatabases/Male.sqlite";
				 $db1->connect($Database2);
				 $table1="ZScores";
				 for($p=0; $p< 2; $p++)
				{
				$k=0;
				 $members=$db1->getMembers(0,$table1,$Zscore[$p]);
				// echo ($dimension[$i]."<br/>");
				if ($members !== FALSE)
					 {
							 foreach ($members as $member)
							{
								$L=0;
								 for($j=0; $L<1; $j++)
								 {
								$percentZscore[$p][$k]=$member[$Zscore[$p]];
								//echo $percentZscore[1][$k]."<br>";
								 $L=1;
					 			$k=$k+1;
								}
						
							}
					}
				
				}	*/
 				
 			require_once('accessAnyDatabase1.php');//Main database access
				 $db = new center_members();
				 $stat = new Stat();
				 $Database1="/sqlLiteDatabases/Male.sqlite";
				 $db->connect($Database1);
				 $table="MainAnsur".$gender1;//Select table depending on gender
				// echo $table;
			
/***************************************This loop calculates the Z score for the normal distribution, stores the data in the file that can be downloaded,  and the values for 1st,2.5th,5th,10th,25th,50th,75th,90th,95th,97.5 Percentile. In calculating these numbers the standard deviation, and mean were calculated)*/
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
					 $value[$i][$k]=$member[$dimension[$i]];//Values retreive from the table 
					 $the_data[$k] = $value[$i][$k];
					 $average[$i]+=$member[$dimension[$i]];//sum of data for dimension soon to be  average
					 $L=1;
					 $k=$k+1;
					 $file .=$member[$dimension[$i]]."\r\n";//Data inserted into file to be downloaded
					 



					 }
				}	

			  }
			 $average[$i]=$average[$i]/sizeof($members);//Actual average
			 //Calculate Standard Deviation
			 		for($f=0; $f<$k+1; $f++)
					{
					 	$intialDeviation=$value[$i][$f]-$average[$i];
						
						$intialDeviation=$intialDeviation*$intialDeviation;
						$finalDeviation[$i]+=$intialDeviation;
					}
					$finalDeviation[$i]=$finalDeviation[$i]/($k-1);
					$finalDeviation[$i]=sqrt($finalDeviation[$i]);//Standard Deviation of dimension
					//End
					
		 			//Calculates corresponding dimensions for Zscores 10th increment
					for($f=0; $f<sizeof($zScore); $f++)
					{
					$valueatPercentil[$i][$f]=($zScore[$f]*$finalDeviation[$i])+$average[$i];
					$valueatPercentil[$i][$f]=round($valueatPercentil[$i][$f]);
					//End
					
					}	
					
					//Calculate dimension corresponding with Zscores from 1-99th percentile
	/*				for($f=0; $f<sizeof($percentZscore[1]); $f++)
					{
					$valueatPerc[$i][$f]=($percentZscore[1][$f]*$finalDeviation[$i])+$average[$i];
					$valueatPerc[$i][$f]=round($valueatPerc[$i][$f]);
					//End*/
					
					//}	
					
					//Calculate actual percentile values(1st,2.5th,5th,10th,25th,50th,75th,90th,95th,97.5 Percentile)  :
					for($f=0;$f<sizeof($value[$i]); $f++)
					{
						$temp[$f]=$value[$i][$f];//Store data from table in temporary array
					}
					sort($temp);//Sort temporary array in descending order
					for($f=0;$f<sizeof($per); $f++)
					{
						$percentile=$per[$f]*sizeof($temp);
						$percentile=round($percentile,1);
						$tempPercentile=floor($percentile);
						$d=$percentile-$tempPercentile;
						$yk= $temp[$tempPercentile];
						$ykfirst=$temp[$tempPercentile+1];
						$newPercentile[$i][$f]=$yk+($d*($ykfirst-$yk));
						$newPercentile[$i][$f]=round($newPercentile[$i][$f]);
					}	
					//End	 
					
					for($f=0;$f<sizeof($per); $f++)
					{
					$actual_percentile[$i][$f] = $stat -> percentile($the_data,$per[$f]);
					$actual_percentile[$i][$f] = round($actual_percentile[$i][$f]);
					}
		 
		 	}
		 /**********************************************END*********************************************************************************************/
		 $k=0;
		 $j=0;
		 
		 
/***************************************************This loop gets the value of the Histogram it is measured from the 1st percentile-99th percentile*************************************************/
		 for($i=0; $i< $size; $i++)
			{
				$j=0;
				sort($value[$i]);
				$range=$valueatPercentil[$i][10]-$valueatPercentil[$i][0];//Get range between 99th percentile and 1st percentile
				$increment=$range/23;
				$midNum=$valueatPercentil[$i][0];
				//Get mid values:
				for($f=0; $f<24; $f++)
				{
					$nextnumber=$midNum+$increment;
					$midValue[$f]=($midNum+$nextnumber)/2;
					$midNum=$nextnumber;
				}
				
					//For loop belows retreives the frequency of a histogram bin  that represents the y axis of the Histogram
					$valueIncrement=$valueatPercentil[$i][0]+$increment;
					for($k=0;$k<sizeof($value[$i]); $k++)
					{
						if($valueIncrement >= $value[$i][$k] && $valueIncrement>$valueatPercentil[$i][0] && $valueIncrement<=$valueatPercentil[$i][10]) 
						{
						$counter++;
						$graphValue[$i][$j]=$counter;
						$set=1;
						}
						else if($valueIncrement < $value[$i][$k] && $valueIncrement > $valueatPercentil[$i][0] && $$valueIncrement<=$valueatPercentil[$i][10])
						{
						 //echo $graphValue[$i][$j]." ";
						if($set==0)
						{
						$graphValue[$i][$j]=0;
						}
						$j++;
						$valueIncrement+=$increment;
						$counter=1;
						$set=0;
						}
						
					}
					//Get Probability and fofX(This for loop is what scales down the frequency values of the histogram to fit a standard normalized normal distribution curve
					$sumofValues=array_sum($graphValue[$i]);
					for($f=0;$f<sizeof($graphValue[$i]); $f++)
					{
						$probability[$f]=$graphValue[$i][$f]/$sumofValues;
						$fofX[$f]=$probability[$f]/$increment;
						//echo ($fofX[$f]."<br/>");
					}
					//Get the Z value of the dimension and the f of Z value of the dimension
					for($f=0; $f<sizeof($midValue); $f++)
					{
						$dimensionZValue[$i][$f]=($midValue[$f]-$average[$i])/$finalDeviation[$i];
						$dimensionFValues[$i][$f]=$fofX[$f]*$finalDeviation[$i];
						$dimensionFValues[$i][$f]=$dimensionFValues[$i][$f]*100;
						if($dimensionZValue[$i][$f]>0)
						{
							$dimensionZValue[$i][$f]=-$dimensionZValue[$i][$f];
						}
					}
					//Convert numbers to increasing order
					/*	$temporaryNumber1=$dimensionZValue[$i][0];
						$dimensionZValue[$i][0]=0;
					for($f=0;$f<sizeof($dimensionZValue[$i])-1; $f++)
					{
						$temporaryNumber2=$dimensionZValue[$i][$f+1];
						$dimensionZValue[$i][$f+1]=$dimensionZValue[$i][$f+1]-$temporaryNumber1;
						$dimensionZValue[$i][$f+1]=$dimensionZValue[$i][$f+1]+$dimensionZValue[$i][$f];
						$temporaryNumber1=$temporaryNumber2;
						echo($dimensionZValue[$i][$f]." ".$dimensionFValues[$i][$f]."<br/>");
					}*/
			}
			
			$f=0;
			$z[$f]=0;
			$xValue=-4;
			
			//Get Zvalues using equations
			while($xValue<=4.05)
			{
			$z[$f]= $xValue;
			$constanta=exp(-($xValue*$xValue)/2);
			$constantb=sqrt(2*pi());
			$Zvalues[$f]=$constanta/$constantb;
			//$Zvalues[$f]=$Zvalues[$f]*100;
			$Zvalues[$f]=$Zvalues[$f]*100;
			//echo($z[$f]." ".$Zvalues[$f]."<br/>");
			$f++;
			$xValue=$xValue+0.05;
			}
			//echo(sizeof($Zvalues)."<br/>");
						
			for($j=0; $j<sizeof($graphValue[$i]); $j++)
			{
			//echo $graphValue[$i][$j]." ";
			}
				$i=0;
				$k=2;
				$j=0;
		
 $db->disconnect();		
 	 
 				 require_once('accessAnyDatabase2.php');//Access DataBase
				 $db1 = new center_members1();
				 $Database2="/sqlLiteDatabases/Male.sqlite";
				 $db1->connect($Database2);
				 $table1="AnsurDescription";
				 for($i=0; $i< $size; $i++)//This for loop retreives the dimension name, image, and description
				{
				$k=0;
				 $members=$db1->getMembers(0,$table1,$dimension[$i]);
				if ($members !== FALSE)
					 {
							 foreach ($members as $member)
							{
								$L=0;
								 for($j=0; $L<1; $j++)
								 {
								$description[$i][$k]=$member[$dimension[$i]];
								 $L=1;
					 			$k=$k+1;
								}
						
							}
					}
				
				}	

?>
	<?php
		$i=0;
		$k=48;
		/*for($f=50;$f<sizeof($valueatPerc[$i]); $f++)
		{
		$valueatPerc[$i][$f]=$valueatPerc[$i][$k];
		$k--;
		}
		$constantA=1/($finalDeviation[$i]* sqrt(2*pi()));
		for($f=0;$f< sizeof($graphValue[$i]); $f++)
		{
		$temp1[$f]=$graphValue[$i][$f];
		}
		sort($temp1);
		
		for($f=0;$f< sizeof($valueatPerc[$i]); $f++)
		{
	$ePower=(($valueatPerc[$i][$f]-$average[$i])*($valueatPerc[$i][$f]-$average[$i]))/(2*$finalDeviation[$i]*$finalDeviation[$i]);
			$constantB=exp(-$ePower);
			$variable[$i][$f]=$constantA*$constantB;
			$variable[$i][$f]=$variable[$i][$f]*10000;
		}
		$middle=$variable[$i][49];
		for($f=0;$f<sizeof($variable[$i]); $f++)
		{
		$variable[$i][$f]=(($temp1[sizeof($temp1)-1]*$variable[$i][$f])/$middle);
		}*/
		?>

<script language="javascript" type="text/javascript">

		function drawNormalDistribution(size)//Function that draws normal distribution
		{
		<?php
		for($i=0;$i<$size; $i++)
		{
		echo("
		var canvas = document.getElementById('histogram".$i."');
		var ctx".$i." = canvas.getContext('2d');
		ctx".$i.".strokeStyle='000000';
		ctx".$i.".lineWidth=0.6; 
		start=0;
		
		ctx".$i.".moveTo(0,230);
		increment=385/161;
		");
		for($f=0; $f<161; $f++)
		{
		echo("
		ctx".$i.".lineTo(start,-".$Zvalues[$f].");
		ctx".$i.".stroke();
		start+=increment;
		");
		}
		}
		?>
		}
		
		function printHistogram(size)//Function that draws Histogram
		{
		var img = new Image(); 
		img.onload=function(){ //alert("It may be working"); 
		<?php 
		$i=0;
		for ($i=0; $i< $size; $i++)
		{
		echo ("
			 start=72.25;
			 var canvas = document.getElementById('histogram".$i."');
			k=1;
        	var ctx".$i." = canvas.getContext('2d');
			ctx".$i.".drawImage(img,0,0); 
			ctx".$i.".translate(0,230);
			//var range=".$value[$i][count($value[$i])]."-".$value[$i][0].";
			var range=".$valueatPercentil[$i][10]."-".$valueatPercentil[$i][0].";
			var x=400/ range;
			increment=10.456;
			compare=".$valueatPercentil[$i][5]."
			increment1=range/20;
			minimum=".$valueatPercentil[$i][0].";
			var y=200/400;
			ctx".$i.".scale(1,2.7);
			var height='".$dimensionFValues[$i][0]."';
			var previousHeight='".$dimensionFValues[$i][0]."';
			next=".$dimensionFValues[$i][2].";
			//alert(previousHeight);
			Number(height);
			Number(previousHeight);
			//ctx".$i.".beginPath();
			ctx".$i.".moveTo(0,-height);
			ctx".$i.".moveTo(96.25,-height);
			max=".sizeof($dimensionFValues[$i]).";
			//alert(".$graphValue[$i][0].");");
		for ($j=1; $j< sizeof($dimensionFValues[$i]); $j++)
		{
			
		$f=sizeof($dimensionFValues[$i]);
		$k=$j+1;
		if($k==$f)
		{
		$k=$j;
		}
		echo ("var width=increment;
		//ctx".$i.".drawImage(img,0,-230); 
		ctx".$i.".strokeStyle='#000000;'
		ctx".$i.".fillStyle = '#455AA8';
		value=".$f.";
		value=value-1;
		/*if(start>0)
		{
		if(height > previousHeight)
		{
		//alert(previousHeight);
		ctx".$i.".lineTo(start,-height);
		ctx".$i.".stroke();
		x=1;
		}
		else if(height < previousHeight)
		{
		if(x==0)
		{
		//ctx".$i.".lineTo(start,-previousHeight);
		start1=start+increment;
		ctx".$i.".lineTo(start1,-height);
		ctx".$i.".stroke();	
		}
		else if(x==1)
		{
		ctx".$i.".lineTo(start,-previousHeight);
		start1=start+increment;
		if(next>=height)
		{
		ctx".$i.".lineTo(start1,-next);
		}
		else
		{
		ctx".$i.".lineTo(start1,-height);
		}
		ctx".$i.".stroke();		
		x=0;
		}
		
		}
		}*/
	
		if( minimum < compare)
		{
		ctx".$i.".strokeRect (start,-height,increment,height);
		ctx".$i.".fillRect(start,-height,increment,height);
		//alert(height);
		}
		else if(minimum > compare)
		{
		ctx".$i.".fillStyle = '#455AA8';
		ctx".$i.".strokeRect (start,-height,increment,height);
		ctx".$i.".fillRect(start,-height,increment,height);
		}
			start+=increment;
			minimum+=increment1;
		
		height=".$dimensionFValues[$i][$j].";
		previousHeight=".$dimensionFValues[$i][$j-1].";
		next=".$dimensionFValues[$i][$k].";
		Number(height);
		Number(previousHeight);
	
		//Number(next);
		");
		}
		}
		?>
		
		var x=drawNormalDistribution(size);
			}
img.src = 'images/backgroundOfGrapg.jpg';
		}
function test(size)
{

for(i=0; i<35; i++)
	{
	entranceValue[i]=0;
	imageDetect[i]=0;
	}
	var browser = new BrowserDetect();
	if(browser.isSafari)
	{
	//size=Number(size);
		for(i=0;i<size; i++)
		{
		document.getElementById("collapse"+ i).style.width="52em";
		}
	}
	var y= printHistogram(size);
}

 
 
</script>
<body class="oneColLiqCtr" <?php echo "onload='test(\"".$size."\")'"; ?>>
<!--<div style="background-color:#000033; height:10px;"></div>
--><div id="firstHeader"><div id="secondHeader"><a href="http://www.openlab.psu.edu/"><img src="../../images/openlablogo_sm.png" style="vertical-align:middle" border=0></a>
<span>Design Tools: ANSUR Database Calculator</span></div>
</div></div>
<div id="container">
  <div id="mainContent">
  
  <?php 
  echo "<br><div style='text-align:center'> <a href='#' onclick='download1()'>Download All</a></div>"; 
  
  ?>
  
<?php

 $db1->disconnect();

//Build Template
for($i=0; $i<sizeof($dimension); $i++)
{
	
	

echo "<div class='space'></div>
<div class='center'>
<div id='collapse".$i."' class='collapse'>
<div class='subcontainer'>
<div class='leftcolumn'>".$description[$i][2]." ".$gender1."</div>"."<div class='rightColumn' style='background-color:#FFFFFF'><img src='images/arrowSide.png' border='0' id='pic".$i."' onclick='changePic(\"pic".$i."\",".$i.")'/></div></div>
<div style='text-align:left; padding-left:5px; padding-right:5px; font-size:13px; padding-top:7px;padding-bottom:3px;'></div>
<div class='subcontainer1'>
<div class='leftcolumn1' id='leftcolumn1".$i."'><img src='".$description[$i][1]."' border='0' id='DimensionPic".$i."' style='margin-top:auto; margin-bottom:auto;' width=218 height=438  /></div>"."<div class='rightcolumn1'  id='rightcolumn1".$i."'><div style='height:438px;width:0;visibility:hidden;vertical-align:middle;display:inline'></div><div ><div style='background-color:#999999; padding-left:7px; padding-right:7px; padding-top:7px;padding-bottom:7px; text-align:center'>".$description[$i][0]."</div><div id='title".$i."' style='text-align:center;padding-top:4px;'><u>Histogram Representation Of ".$description[$i][2]. "</u></div><div style='text-align:center; margin:0 auto; width:16em;'></div><div style='padding-left:10px; padding-right:10px; padding-top:5px;padding-bottom:10px' border='1'><canvas id='histogram".$i."' width='385' height='230'></canvas></div></div></div>
<div class='graphHeader'><div class='graphHeader1'>".$description[$i][2]." Percentile Distribution in MM</div>
<div style='padding-bottom:7px;'><table border='1' width='100%' style='text-align:center'><tr><td>1st</td><td>2.5th</td><td>5th</td><td>10th</td><td>25th</td><td>50th</td><td>75th</td><td>90th</td><td>95th</td><td>97.5th</td><td>99th</td></tr><tr><td id='value".$i."0'>".$actual_percentile[$i][0]."</td><td id='value".$i."1'>".$actual_percentile[$i][1]."</td><td id='value".$i."2'>".$actual_percentile[$i][2]."</td><td id='value".$i."3'>".$actual_percentile[$i][3]."</td><td id='value".$i."4'>".$actual_percentile[$i][4]."</td><td id='value".$i."5' style='background-color:#455AA8;color:#FFFFFF'>".$actual_percentile[$i][5]."</td><td id='value".$i."6'>".$actual_percentile[$i][6]."</td><td id='value".$i."7'>".$actual_percentile[$i][7]."</td><td id='value".$i."8'>".$actual_percentile[$i][8]."</td><td id='value".$i."9'>".$actual_percentile[$i][9]."</td><td id='value".$i."10'>".$actual_percentile[$i][10]."</td></tr></table></div><div><form name='values1'  method='post' action='AnsurDataDownload.php'>   
<span><input name='Download' type='submit' value='Download Raw Data'  /></span><span><input name='dimension' type='text' value='".$dimension[$i]."' readonly='true' style='visibility:hidden' /></span><span><input name='gender' type='text' value='".$gender1."' readonly='true' style='visibility:hidden' /></span></form></div>
</div>
</div>
</div>
</div>
<br .clearfloat/>

";


}
 ?>
 
<!-- <div style="background-color:#999999; height:500px; position:relative; top:5px;" id="collapse2"><img align=""</div>
-->	<!-- end #mainContent -->
<div id="hiddenForm">
<form name='values'  method='post' action='AnsurDataDownload1.php'>
<?php 
for($i=0; $i<sizeof($dimension); $i++)
{
echo "<span><input name='dimension".$i."' type='text' value='".$dimension[$i]."' readonly='true' style='visibility:hidden' /></span><br/>";
}
echo "<span><input name='gender' type='text' value='".$gender1."' readonly='true' style='visibility:hidden' /></span>";
echo "<span><input name='sizeOf' type='text' value='".sizeof($dimension)."' readonly='true' style='visibility:hidden' /></span>";
?>
</form>
</div>
</div>
<!-- end #container --></div>

<script type="text/javascript"> var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www."); document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E")); </script> <script type="text/javascript"> try { var pageTracker = _gat._getTracker("UA-526007-4"); pageTracker._trackPageview(); } catch(err) {}</script>

</body>
</html>
