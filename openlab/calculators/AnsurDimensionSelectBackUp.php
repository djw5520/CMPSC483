<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script  language="javascript" src="tween.js" type="text/ecmascript">
</script>
<script  language="javascript" src="browser_detect.js"type="text/ecmascript">
</script>
<script type="text/javascript" language="javascript">
//Global Variables 


var Counter = new Array();

function submitForm()
{
	document.values1.submit();
}

function loadConstants()
{
	if(browser.isSafari)
	{
		//alert("It is working but not just showing"); 
		document.getElementById("submitValue").style.height="935px";
	}

	//alert("It is working but not just showing"); 
	for(i=0; i<36; i++)
	{
		Counter[i]=0;
		box="pic"
	document.getElementById(box+i+'B').checked=false;
	}
	//document.getElementById("formSubmitList").innerHTML=" ";


}
function expand(label)
{
	/*if(label=="label20")
	{
	document.getElementById(label).style.visibility="visible";
	 t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,0,203,1,'px');
	  t2.start();
	 }
	 
	else if(label=="label3" || label=="label15" || label=="label18")
	{
		document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,0,240,1,'px');
	  t2.start();
	 }
	
	else if(label=="label21" || label=="label19" || label=="label22")
	{
	  document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,0,220,1,'px');
	  t2.start();
	 }
	 else if(label=="label24" || label=="label25")
	 {
	 document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,0,259,1,'px');
	  t2.start();
	  }
	 else if(label=="label23")
	 {
	  document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,0,239,1,'px');
	  t2.start();
	  }
	  else if(label=="label4" || label=="label5")
	  {
 		document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,0,299,1,'px');
	  t2.start();
	 } 
	 else if(label=="label8" || label=="label9" || label=="label16" || label=="label29" || label=="label31"  || label=="label33" || label=="label35")
	 {
	  document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,0,203,1,'px');
	  t2.start();
	 } 
	  else if(label=="label10" || label=="label11")
	 {
	  document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,0,133,1,'px');
	  t2.start();
	 }   
	 else if(label=="label28")
	 {
	 document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,0,143,1,'px');
	  t2.start();
	 }
	 else if(label=="label14" || label=="label6" || label=="label26" || label=="label30" ) 
	 {
	 document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,0,163,1,'px');
	  t2.start();
	}*/
	
	document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,0,183,1,'px');
	  t2.start();
}
function unexpand(label)
{	
	/*if(label=="label20")
	{
	 t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,203,0,1,'px');
	  t2.start();
	 }
	else if(label=="label3" || label=="label15" || label=="label18")
	{
		document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,240,0,1,'px');
	  t2.start();
	 }
	 
	else if(label=="label21" || label=="label19"  || label=="label22")
	{
	  document.getElementById(label).style.visibility="visible";             
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,220,0,1,'px');
	  t2.start();
	 }
	 else if(label=="label24" || label=="label25")
	 {
	 document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,259,0,1,'px');
	  t2.start();
	  }
	 else if(label=="label23")
	 {
	  document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,239,0,1,'px');
	  t2.start();
	  }
	  else if(label=="label4" || label=="label5")
	  {
 		document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,279,0,1,'px');
	  t2.start();
	 }
	  else if(label=="label8" || label=="label9" || label=="label16" || label=="label29" || label=="label31" || label=="label33" || label=="label35")
	 {
	  document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,203,0,1,'px');
	  t2.start();
	 }  
	 else if(label=="label10" || label=="label11")
	 {
	  document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,143,0,1,'px');
	  t2.start();
	 }
	 	 else if(label=="label14" || label=="label6" || label=="label26" || label=="label30")
	 { 
	 document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,163,0,1,'px');
	  t2.start();
	}
	else if(label=="label28")
	 {
	 document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,143,0,1,'px');
	  t2.start();
	 }
	 else
	{*/
	document.getElementById(label).style.visibility="visible";
	  t2 = new Tween(document.getElementById(label).style,'height',Tween.regularEaseInOut,183,0,1,'px');
	  t2.start();
	
	  //document.getElementById(label).style.visibility="visible";
}
function changeBorder(dimension,index)
{
	//alert("It is working but not just showing"); 
	if(document.getElementById(dimension).style.border!="1px solid rgb(69, 90, 168)" && Counter[index]==0)
	{
	document.getElementById(dimension).style.border="1px solid #455AA8";
	document.getElementById("list"+index).style.background="#CCCCCC"
	}
	else if(Counter[index]==1)
	{

	}
}

function changeBorder1(dimension,index)
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
function selectPicture(box,index)
{
	//alert(box+0);
	if(Counter[index]==0)
	{
	Counter[index]=1;
	document.getElementById(box).style.border="1px solid #455AA8";
	//alert(box+'0');
	document.getElementById(box+'B').checked=true;
	document.getElementById("list"+index).style.background="#cccccc"
	//alert(color);
	//color.background="#455AA8";
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



function switchToListView()
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
}
</script>
<?php
$dimensionNames=array('ACR_RADL_LNTH','BUTT_KNEE_LNTH','BUTT_POPLITEAL_LNTH','CHEST_CIRC_AT_SCYE','CHEST_CIRC_BELOW_BUST_','EYE_HT_SITTING','FOREARM_HAND_LENTH','MENTON_TO_NASAL_ROOT_DEP_LNTH','FOOT_BRTH','FOOT_LNTH','THUMB_TIP_REACH','HAND_BRTH_AT_METACARPALE','HAND_LNTH','HEAD_BRTH','HEAD_CIRC','HEAD_LNTH','HIP_BRTH','TROCHANTERION_HT','KNEE_HT_SITTING','LATERAL_FEMORAL_EPICONDYLE_HT','OVRHD_EXT_REACH','OVRHD_SIT_REACH','POPLITEAL_HT_SITTING','BIDELTOID_BRTH','SHOULDER_ELBOW_LNTH','SITTING_HT','ACROMION_HT','ACR_HT_SIT','SPAN','STATURE','SUPRASTERNALE_HT','WAIST_HT_OMPHALION','WRIST_TO_CENTER_OF_GRIP_LNTH','WRIST_TO_INDEX_FINGER_LNTH','WRST_LNTH_TO_WALL');
?>
<style type="text/css">
body {
	font-family:"Courier New", Courier, monospace;
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	padding: 0;
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
	color: #000000;
	background-color:#E4E6E7;
}
.oneColLiqCtr #container {
	width: 79%;  /* this will create a container 80% of the browser width */
	background: #FFFFFF;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	text-align: left; /* this overrides the text-align: center on the body element. */
	padding-top:5px;
	background-color:#E4E6E7;
}
.oneColLiqCtr #mainContent {
	padding: 0 20px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
height:auto;
width:auto;
}

#firstHeader
{
width:100%;
height:60px;
margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
padding-top:8px;
padding-bottom:3px;
text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
color: #000000;
background-image:url(images/percentile/testbackground.png);
}

#secondHeader
{
width: 75%;
margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
text-align:left;
}

#header
{
width:97.8%;
height:50px;
padding-left:20px;
padding-top:20px;
padding-bottom:20px;
position:relative;
}

#OpenDesignLab
{
	font-family:"Courier New", Courier, monospace;
	position:absolute;
	width:169px;
	color:#FFFFFF;
	font-size:13px;
	left: 239px;
	top: 33px;
}

#OpenDesignLab a
{
font-size:10px;
color:#FFFFFF;
}

#OpenDesignLab a:hover
{
text-decoration:none;
}

.header
{
font-family:"Courier New", Courier, monospace;
padding-top:2px;
font-size:16px;
color:#000000;
font-style:oblique;
width:700px;
}

.header a
{
font-size:10px;
}
#listHeader
{
background-color:#455AA8;
color:#FFFFFF;
text-align:center;
font-size:14px;
}
.list
{
border-bottom: 1px solid #455AA8;
padding-bottom:3px;
padding-top:3px;
padding-left:3px;
font-size:13px;
background-color:#FFFFFF;
}
.listLast
{
padding-bottom:3px;
padding-top:3px;
padding-left:3px;
}

#ACROMION_HT
{
position:absolute;
}
.subHeader
{
text-align:center;
background-color:#455AA8;
color:#FFFFFF;
font-size:13px;
padding-left:2px;
}
.pic0
{
	position:absolute;
	left:0px;
	top: 0px;
	
}

.pic1
{
	position:absolute;
	left: 232px;
	top: 0px;
}

.pic2
{
	position:absolute;
	left: 464px;
	top: 0px;
}

#submitValue
{
	height:1075px;
	overflow:hidden;
	position:absolute;
	left: 857px;
	top: 97px;
	z-index:10;
	border:1px solid #455AA8;
}

#formSubmit
{
	position:absolute;
	left: 1009px;
	top: 112px;
}
.picture
{
position:relative;
height:480px;
width:auto;
}
.test
{
background-color:#CCCCCC;
z-index:50;
}
.label
{
background-color:#CCCCCC;
height:500px;
width:216px;
top:0px;
position:absolute;
visibility:hidden;
overflow:hidden;
border:1px solid #455AA8;
}
#label32
{
width:245px;
}
#pic34
{
margin-left:10px;
}
#pic34
{
left:240px;
}
</style>
</head>

<body class="oneColLiqCtr" onload="loadConstants()">
<div id="firstHeader"><div id="secondHeader"><img src="images/psu.png"/>
<div id="OpenDesignLab"><span>Open Design Lab Tools</span></div>
</div></div>
<div id="container">
  <div id="mainContent">
  
  <form name="values1"  method="post" action="AnsurDataResult.php"> 
  
  <div style="font-size:13px;"><div style="text-align:right;"><span><table><tr><td><input name="gender" type="radio" value="Male" checked />Male</td><td> <input name="gender" type="radio" value="Female" /> Female</td></tr></table></span>
 </div>
 <?php
  require_once('accessAnyDatabase2.php');//Access DataBase
				 $db1 = new center_members1();
				 $Database2="/sqlLiteDatabases/Male.sqlite";
				 $db1->connect($Database2);
				 $table1="AnsurDescription";
				 for($i=0; $i<sizeof($dimensionNames); $i++)
				{
				$k=0;
				 $members=$db1->getMembers(0,$table1,$dimensionNames[$i]);
				// echo ($dimension[$i]."<br/>");
				if ($members !== FALSE)
					 {
							 foreach ($members as $member)
							{
								$L=0;
								 for($j=0; $L<1; $j++)
								 {
								$description[$i][$k]=$member[$dimensionNames[$i]];
								//echo $description[$i][$k]."<br>";
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
echo ("<div style='position:relative'><table border='0'><tr><td></td><td> <input type='submit' /></td></tr></table></div>");
  ?> 
   
	</div>
  <div id="submitValue">
<!--   <table><tr><td><select name="gender[]"><option>Male</option><option>Female</option></select></td><td> <input type="submit" /></td></tr></table>  
-->     
<div id="listHeader">List View</div>
<!--<div class="list"><input name="dimension[]" type="checkbox" value="ACROMION_HT" id="pic00" />ACROMION_HT</div>
   <div class="list" id="list1"> <input name="dimension[]" type="checkbox" value="ACR_HT_SIT" id="pic10" />ACR_HT_SIT</div>
   <div class="list"> <input name="dimension[]" type="checkbox" value="ACR_RADL_LNTH" id="pic20" />ACR_RADL_LNTHM</div>
   <div class="list"> <input name="dimension[]" type="checkbox" value="BIDELTOID_BRTH" id="pic30" />BIDELTOID_BRT </div>  
    <div class="list"><input name="dimension[]" type="checkbox" value="BUTT_KNEE_LNTH" id="pic40" />BUTT_KNEE_LNTH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="BUTT_POPLITEAL_LNTH" id="pic50" />BUTT_POPLITEAL_LNTH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="CHEST_CIRC_AT_SCYE" id="pic60" />CHEST_CIRC_AT_SCYE</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="CHEST_CIRC_BELOW_BUST_" id="pic70" />CHEST_CIRC_BELOW_BUST_</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="EYE_HT_SITTING" id="pic80"/>EYE_HT_SITTING</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="FOREARM_HAND_LENTH" id="pic90" />FOREARM_HAND_LENTH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="FOOT_BRTH" id="pic100" />FOOT_BRTH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="FOOT_LNTH" id="pic110" />FOOT_LNTH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="HAND_BRTH_AT_METACARPALE" id="pic120" />HAND_BRTH_AT_METACARPAL</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="HAND_LNTH" id="pic130" />HAND_LNTH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="HEAD_BRTH" id="pic140" />HEAD_BRTH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="HEAD_CIRC" id="pic150" />HEAD_CIRC</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="HEAD_LNTH" id="pic160" />HEAD_LNTH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="HIP_BRTH" id="pic170" />HIP_BRTH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="KNEE_HT_SITTING" id="pic180" />KNEE_HT_SITTING</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="LATERAL_FEMORAL_EPICONDYLE_HT0" id="pic190" />LATERAL_FEMORAL_EPICONDYLE_HT</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="MENTON_TO_NASAL_ROOT_DEP_LNTH0" id="pic200" />MENTON_TO_NASAL_ROOT_DEP_LNTH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="OVRHD_EXT_REACH" id="pic210" />OVRHD_EXT_REACH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="OVRHD_SIT_REACH" id="pic220" />OVRHD_SIT_REACH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="POPLITEAL_HT_SITTING" id="pic230" />POPLITEAL_HT_SITTING</div>
   <div class="list"> <input name="dimension[]" type="checkbox" value="SHOULDER_ELBOW_LNTH" id="pic240" />SHOULDER_ELBOW_LNTH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="SITTING_HT" id="pic250" />SITTING_HT</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="SPAN" id="pic260" />SPAN</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="STATURE" id="pic270" />STATURE</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="SUPRASTERNALE_HT" id="pic280" />SUPRASTERNALE_HT</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="THUMB_TIP_REACH" id="pic290" />THUMB_TIP_REACH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="TROCHANTERION_HT" id="pic300" />TROCHANTERION_HT</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="WAIST_HT_OMPHALION" id="pic310" />WAIST_HT_OMPHALION</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="WRIST_TO_CENTER_OF_GRIP_LNTH" id="pic320" />WRIST_TO_CENTER_OF_GRIP_LNTH</div>
    <div class="list"><input name="dimension[]" type="checkbox" value="WRIST_TO_INDEX_FINGER_LNTH" id="pic330" />WRIST_TO_INDEX_FINGER_LNTH</div>
    <div class="listLast"><input name="dimension[]" type="checkbox" value="WRST_LNTH_TO_WALL" id="pic340" />WRST_LNTH_TO_WALL</div>
   -->
   <?php 
  for($i=0;$i<sizeof($dimensionNames); $i++)
  {
  	echo("<div id='list".$i."' class='list' onmouseover='changeBorder(\"pic".$i."\",\"".$i."\")' onmouseout='changeBorder1(\"pic".$i."\",\"".$i."\")' onclick='selectPicture(\"pic".$i."\",\"".$i."\")'>".$i."<input name='dimension[]' type='checkbox' value='".$dimensionNames[$i]."' id='pic".$i."B' />".$description[$i][2]."</div>");
  }
	?>
    <div id="formSubmitList" style="padding-top:8px"><table border="0"><tr><td></td><td> <input type="submit" /></td></tr></table></div>  

</div>
</form>
  </div>
  </div>
  
  </body>
</html>
