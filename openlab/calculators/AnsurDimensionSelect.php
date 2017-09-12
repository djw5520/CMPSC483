<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Open Design Lab Tools: ANSUR Database Calculator</title>
<script  language="javascript" src="tween.js" type="text/ecmascript">
</script>
<script  language="javascript" src="browser_detect.js"type="text/ecmascript">
</script>
<style type="text/css">
#firstHeader
{
width:100%;
height:60px;
margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
padding-top:8px;
padding-bottom:3px;
text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
color: #000000;
background-color: #000033;}
</style>

<!--The javascript scripts controls the aesthertics and event handlers of the page -->
<script type="text/javascript" language="javascript">
//Global Variables 


var Counter = new Array();

function submitForm()//This script submits the form when button is clicked
{
	document.values1.submit();
} 

function loadConstants()// This scripts pre loads all the constants and set the height of the page based on the browser the user is viewing the web page with. 
{
	if(browser.isSafari)
	{
		document.getElementById("submitValue").style.height="935px";
	}

	for(i=0; i<36; i++)//In order to maintain the same visual effect, as you add new dimensions change the adjust the maximum number in the for loop to reflect that
	{
		Counter[i]=0;//By default it is set to zero.
		box="pic"
	document.getElementById(box+i+'B').checked=false;
	}

}
function expand(label)//Controls the display of the description when the quesetion mark of the dimension is clicked. Do not change unless necssary
{
	document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,0,183,1,'px');
	  t2.start();
}
function unexpand(label)//closes the dialog box which pops when the question mark of a dimension is clicked
{	
	
	document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,183,0,1,'px');
	  t2.start();
	
}
function changeBorder(dimension,index)//Controls the aesthetic of the dimension when the mouse is rolled over a dimension picuture.
{
	if(document.getElementById(dimension).style.border!="1px solid rgb(69, 90, 168)" && Counter[index]==0)
	{
	document.getElementById(dimension).style.border="1px solid #455AA8";//Change this value in order to change the color and size of the border around the picture. (1px corresponds to the size of the border, solid-corresponding to the border style and #455AA8 corresponds with the color.
	document.getElementById("list"+index).style.background="#CCCCCC";
	}
	else if(Counter[index]==1)
	{

	}
}

function changeBorder1(dimension,index)//Switches the borde back to none when the mouse rolls out of the picture
{
	if(Counter[index]==0)
	{
	document.getElementById(dimension).style.border="";
		document.getElementById("list"+index).style.background="#FFFFFF";
	}
		else if(Counter[index]==1)
	{

	}
}
function selectPicture(box,index)//Similar to the changeborder function but sets the border to be permanenetly solid and colored unless clicked again. In addition it selects the correct dimension name in the dimension list view, and darkens the container 
{
	if(Counter[index]==0)
	{
	Counter[index]=1;
	document.getElementById(box).style.border="1px solid #455AA8";
	document.getElementById(box+'B').checked=true;
	document.getElementById("list"+index).style.background="#cccccc"
	box=box+"a";
 	 eStyle = document.getElementById(box).style;
	 eStyle.opacity=0.4;
	opacityLevel=40;
    eStyle.filter = 'alpha(opacity='+opacityLevel+')';
	}
	else if(Counter[index]==1)
	{
	Counter[index]=0;
	document.getElementById(box).style.border="";
	document.getElementById(box+'B').checked=false;
	document.getElementById("list"+index).style.background="#FFFFFF"
	box=box+"a";
 	 eStyle = document.getElementById(box).style;
	 eStyle.opacity=1;
	opacityLevel=100;
    eStyle.filter = 'alpha(opacity='+opacityLevel+')';
	}

}



/*function switchToListView()
{
if(document.getElementById("picture").style.visibility!="hidden")
{
document.getElementById("picture").style.visibility="hidden";
document.getElementById("submitValue").style.visibility="visible";
document.getElementById("switchTo").innerHTML="switch to Picture view";
document.getElementById("formSubmitList").innerHTML="<table><tr><td><select name='gender[]'><option>Male</option><option>Female</option></select></td><td> <input type='submit' /></td></tr></table>";
document.getElementById("formSubmit").innerHTML=" ";
}
else if(document.getElementById("submitValue").style.visibility!="hidden")
{
document.getElementById("submitValue").style.visibility="hidden";
document.getElementById("picture").style.visibility="visible";
document.getElementById("switchTo").innerHTML="switch to list view";
document.getElementById("formSubmit").innerHTML="<table><tr><td><select name='gender[]'><option>Male</option><option>Female</option></select></td><td> <input type='submit' /></td></tr></table>";
document.getElementById("formSubmitList").innerHTML=" ";
}
}*/
</script>
<?php
$dimensionNames=array('ACR_RADL_LNTH','BUTT_KNEE_LNTH','BUTT_POPLITEAL_LNTH','CHEST_CIRC_AT_SCYE','CHEST_CIRC_BELOW_BUST_','EYE_HT_SITTING','FOREARM_HAND_LENTH','MENTON_TO_NASAL_ROOT_DEP_LNTH','FOOT_BRTH','FOOT_LNTH','THUMB_TIP_REACH','HAND_BRTH_AT_METACARPALE','HAND_LNTH','HEAD_BRTH','HEAD_CIRC','HEAD_LNTH','HIP_BRTH','TROCHANTERION_HT','KNEE_HT_SITTING','LATERAL_FEMORAL_EPICONDYLE_HT','OVRHD_EXT_REACH','OVRHD_SIT_REACH','POPLITEAL_HT_SITTING','BIDELTOID_BRTH','SHOULDER_ELBOW_LNTH','SITTING_HT','ACROMION_HT','ACR_HT_SIT','SPAN','STATURE','SUPRASTERNALE_HT','WAIST_HT_OMPHALION','WRIST_TO_CENTER_OF_GRIP_LNTH','WRIST_TO_INDEX_FINGER_LNTH','WRST_LNTH_TO_WALL');/*This is the list of dimension names to be retreived. This list must be updated in order to retreive additional dimensions from the table*/
?>

<link href="CSSDesignFolder/ansurDimensionCSS.css" rel="stylesheet" type="text/css" />
</head>

<body class="oneColLiqCtr" onload="loadConstants()">
<div id="firstHeader"><div id="secondHeader"><a href="http://www.openlab.psu.edu/"><img src="../../images/openlablogo_sm.png" style="vertical-align:middle" border=0></a>
<span>Design Tools: ANSUR Database Calculator</span>
</div></div>
<div id="container">
  <div id="mainContent">
  
  <p style="font-size: 12px">This calculator allows for the exploration and download of data available in the ANSUR database, a 1988 anthropometric survey of military personnel. Select the desired gender and dimensions of interest on this page in either the <a href="#graphical">graphical view</a> or <a href="#list">list view</a>, then select "Calculate". The subsequent page shows summary statistics and allows the data to be downloaded.</p>
  
    
  <form name="values1"  method="post" action="AnsurDataResult.php"> 
  
  <div style="font-size:13px; text-align:center;"><input name="gender" type="radio" value="Male" checked />Male <input name="gender" type="radio" value="Female" /> Female
 </div>
 


     <div id="formSubmitList" style="margin-top:10px; margin-bottom:20px; text-align:center"><input type="submit" value="Calculate"/></div>  

   <div style="text-align:center; margin:10px;" id="graphical"><a href="#list">Go to list view</a></div>


 <?php /*The php script below accesses the database and retreives the dimension description, dimension pictures, and names from the AnsurDescription table*/
  require_once('accessAnyDatabase2.php');//Access DataBase
				 $db1 = new center_members1();
				 $Database2="/sqlLiteDatabases/Male.sqlite";
				 $db1->connect($Database2);
				 $table1="AnsurDescription";
				 for($i=0; $i<sizeof($dimensionNames); $i++)
				{
				$k=0;
				 $members=$db1->getMembers(0,$table1,$dimensionNames[$i]);
				if ($members !== FALSE)
					 {
							 foreach ($members as $member)
							{
								$L=0;
								 for($j=0; $L<1; $j++)
								 {
								$description[$i][$k]=$member[$dimensionNames[$i]];
								 $L=1;
					 			$k=$k+1;
								}
						
							}
					}
				}
				  $f=0;
				  
  for($p=0;$p<36; $p++)
  {
  $describe[$p]=explode(".",$description[$p][0]);
  }
  
/************************************************Below is the loop that controls the display of the dimension and their pictures.***************************************************************/  
/** The for loops runs from $i=0 to the sizeof the $dimensionNames array. The script displays the dimensions one row at a time. There are three dimension in one row. The  script is divided into three part. The first section handles the  displays of the first row which contains the first three dimensions. The second part of the script is triggered when $i%3== zero.( if($i%3==0 && $i!=33)). This displays the next three dimensions. The last part of the script display the last three dimensions. This is triggered when $i=33( the reason why it is 33 is because there are 35 dimension, and so the las three dimension will start from 33. You will have to adjust this number as you add more dimension.    **/
for($i=0;$i<sizeof($dimensionNames); $i++)
  {
  $j=$i+1;
  $k=$j+1;
  if($i==0)
  {
  $g=$f+1;
  $h=$g+1;
  echo("
  <div id='picture".$i."' class='picture'>
  <div id='pic".$i."' class='pic0' >
    <div class='subHeader' onclick='expand(\"label".$i."\")' ><div style='width:90%;float:left'>".$description[$f][2]."</div><div><img src='images/question-mark.jpg'/></div></div><div class='test'><div style='position:relative'><div><img src='".$description[$f][1]."' border='0' onmouseover='changeBorder(\"pic".$i."\",\"".$i."\")' onmouseout='changeBorder1(\"pic".$i."\",\"".$i."\")' title='click to select ".$description[$f][2]." dimension' onclick='selectPicture(\"pic".$i."\",\"".$i."\")' id='pic".$i."a'/><div id='label".$i."' class='label'><div style='margin:3px;3px;3px;3px;'>".$describe[0][0]."</div><div><table><tr><td><input name='close' type='button' value='close' onclick='unexpand(\"label".$i."\")'/></td></tr></table></div></div></div></div></div>
	</div>
  
  <div id='pic".$j."' class='pic1' >
    <div class='subHeader' onclick='expand(\"label".$j."\")'><div style='width:90%;float:left'>".$description[$g][2]."</div><div><img src='images/question-mark.jpg'/></div></div><div class='test'><div style='position:relative'><div><img src='".$description[$g][1]."' border='0' onmouseover='changeBorder(\"pic".$j."\",\"".$j."\")' onmouseout='changeBorder1(\"pic".$j."\",\"".$j."\")' title='click to select ".$description[$g][2]." dimension' onclick='selectPicture(\"pic".$j."\",\"".$j."\")' id='pic".$j."a'/><div id='label".$j."' class='label'><div style='margin:3px;3px;3px;3px;'>".$describe[$j][0]."</div><div><table><tr><td><input name='close' type='button' value='close' onclick='unexpand(\"label".$j."\")'/></td></td></tr></table></div></div></div></div></div>
  </div>
  
   <div id='pic".$k."' class='pic2' >
    <div class='subHeader' onclick='expand(\"label".$k."\")'><div style='width:93%;float:left'>".$description[$h][2]."</div><div><img src='images/question-mark.jpg'/></div></div><div class='test'><div style='position:relative'><div><img src='".$description[$h][1]."' border='0' onmouseover='changeBorder(\"pic".$k."\",\"".$k."\")' onmouseout='changeBorder1(\"pic".$k."\",\"".$k."\")' title='click to select ".$description[$h][2]." dimension' onclick='selectPicture(\"pic".$k."\",\"".$k."\")' id='pic".$k."a'/><div id='label".$k."' class='label'><div style='margin:3px;3px;3px;3px;'>".$describe[$k][0]."</div><div><table><tr><td><input name='close' type='button' value='close' onclick='unexpand(\"label".$k."\")'/></td></tr></table></div></div></div></div>
  </div>
  </div>
  
  </div>");
  $f=$f+3;
  }
  else if($i%3==0 && $i!=33)
  {
   $g=$f+1;
  $h=$g+1; 
	echo("
  <div id='picture".$i."' class='picture'>
  <div id='pic".$i."' class='pic0' >
    <div class='subHeader' onclick='expand(\"label".$i."\")'><div style='width:90%;float:left'>".$description[$f][2]."</div><div><img src='images/question-mark.jpg'/></div></div><div class='test'><div style='position:relative'><div><img src='".$description[$f][1]."' border='0' onmouseover='changeBorder(\"pic".$i."\",\"".$i."\")' onmouseout='changeBorder1(\"pic".$i."\",\"".$i."\")' title='click to select ".$description[$f][2]." dimension' onclick='selectPicture(\"pic".$i."\",\"".$i."\")' id='pic".$i."a'/><div id='label".$i."' class='label'><div style='margin:3px;3px;3px;3px;'>".$describe[$i][0]."</div><div><table><tr><td><input name='close' type='button' value='close' onclick='unexpand(\"label".$i."\")'/></td></tr></table></div></div></div></div></div>
	</div>
  
  <div id='pic".$j."' class='pic1' >
    <div class='subHeader' onclick='expand(\"label".$j."\")'><div style='width:90%;float:left'>".$description[$g][2]."</div><div><img src='images/question-mark.jpg'/></div></div><div class='test'><div style='position:relative'><div><img src='".$description[$g][1]."' border='0' onmouseover='changeBorder(\"pic".$j."\",\"".$j."\")' onmouseout='changeBorder1(\"pic".$j."\",\"".$j."\")' title='click to select ".$description[$g][2]." dimension' onclick='selectPicture(\"pic".$j."\",\"".$j."\")' id='pic".$j."a'/><div id='label".$j."' class='label'><div style='margin:3px;3px;3px;3px;'>".$describe[$j][0]."</div><div><table><tr><td><input name='close' type='button' value='close' onclick='unexpand(\"label".$j."\")'/></td></tr></table></div></div></div></div></div>
  </div>
  
   <div id='pic".$k."' class='pic2' >
    <div class='subHeader' onclick='expand(\"label".$h."\")'><div style='width:90%;float:left'>".$description[$h][2]."</div><div><img src='images/question-mark.jpg'/></div></div><div class='test'><div style='position:relative'><div><img src='".$description[$h][1]."' border='0' onmouseover='changeBorder(\"pic".$k."\",\"".$k."\")' onmouseout='changeBorder1(\"pic".$k."\",\"".$k."\")' title='click to select ".$description[$h][2]." dimension' onclick='selectPicture(\"pic".$k."\",\"".$k."\")' id='pic".$k."a'/><div id='label".$k."' class='label'><div style='margin:3px;3px;3px;3px;'>".$describe[$k][0]."</div><div><table><tr><td><input name='close' type='button' value='close' onclick='unexpand(\"label".$k."\")'/></td></tr></table></div></div></div></div></div>
  </div>
  
  </div>");
  $f=$f+3;
  } 
else if($i==33)
	{
$g=$f+1;
  $h=$g+1; 
	echo("
  <div id='picture".$i."' class='picture'>
  <div id='pic".$i."' class='pic0' >
    <div class='subHeader' onclick='expand(\"label".$i."\")'><div style='width:90%;float:left'>".$description[$f][2]."</div><div><img src='images/question-mark.jpg'/></div></div><div class='test'><div style='position:relative'><div><img src='".$description[$f][1]."' border='0' onmouseover='changeBorder(\"pic".$i."\",\"".$i."\")' onmouseout='changeBorder1(\"pic".$i."\",\"".$i."\")' title='click to select ".$description[$f][2]." dimension' onclick='selectPicture(\"pic".$i."\",\"".$i."\")' id='pic".$i."a'/><div id='label".$i."' class='label'><div style='margin:3px;3px;3px;3px;'>".$describe[$i][0]."</div><div><table><tr><td><input name='close' type='button' value='close' onclick='unexpand(\"label".$i."\")'/></td></tr></table></div></div></div></div></div>
	</div>
  
  <div id='pic".$j."' class='pic1' >
    <div class='subHeader' onclick='expand(\"label".$j."\")'><div style='width:90%;float:left'>".$description[$g][2]."</div><div><img src='images/question-mark.jpg'/></div></div><div class='test'><div style='position:relative'><div><img src='".$description[$g][1]."' border='0' onmouseover='changeBorder(\"pic".$j."\",\"".$j."\")' onmouseout='changeBorder1(\"pic".$j."\",\"".$j."\")' title='click to select ".$description[$g][2]." dimension' onclick='selectPicture(\"pic".$j."\",\"".$j."\")' id='pic".$j."a'/><div id='label".$j."' class='label'><div style='margin:3px;3px;3px;3px;'>".$describe[$j][0]."</div><div><table><tr><td><input name='close' type='button' value='close' onclick='unexpand(\"label".$j."\")'/></td></tr></table></div></div></div></div></div>
  </div></div>");
   }  
 }
 	
   $db1->disconnect();		
echo ("<div id='formSubmitList' style='margin-top:10px; margin-bottom:20px; text-align:center'><input type='submit' value='Calculate'/></div>  
");
  ?> 
   

    
   <div style="text-align:center; margin:10px;" id="list"><a href="#graphical">Go to graphical view</a></div>


  <div id="submitValue" style="margin-top:0px">
<div id="listHeader" >List View</div>

   <?php 
  for($i=0;$i<sizeof($dimensionNames); $i++)//This for loop displays the dimension names in the list view to the right.
  {
  	echo("<div id='list".$i."' class='list' onmouseover='changeBorder(\"pic".$i."\",\"".$i."\")' onmouseout='changeBorder1(\"pic".$i."\",\"".$i."\")' onclick='selectPicture(\"pic".$i."\",\"".$i."\")'>".$i."<input name='dimension[]' type='checkbox' value='".$dimensionNames[$i]."' id='pic".$i."B' />".$description[$i][2]."</div>");
  }
	?>

</div>
     <div id="formSubmitList" style="margin-top:10px; margin-bottom:20px; text-align:center"><input type="submit" value="Calculate"/></div>  

</form>
</div>
</div>
  
  <script type="text/javascript"> var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www."); document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E")); </script> <script type="text/javascript"> try { var pageTracker = _gat._getTracker("UA-526007-4"); pageTracker._trackPageview(); } catch(err) {}</script>
  </body>
</html>
