<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script  language="javascript" src="tween.js" type="text/ecmascript">
</script>
<script type="text/javascript" language="javascript">
//Global Variables 
var Counter = new Array();

function loadConstants()
{
	//alert("It is working but not just showing"); 
	for(i=0; i<35; i++)
	{
		Counter[i]=0;
	}
	document.getElementById("formSubmitList").innerHTML=" ";
}

function changeBorder(dimension,index)
{
	//alert("It is working but not just showing"); 
	if(document.getElementById(dimension).style.border!="1px solid rgb(69, 90, 168)" && Counter[index]==0)
	{
	document.getElementById(dimension).style.border="1px solid #455AA8";
	}
	else if(Counter[index]==1)
	{

	}
}

function changeBorder1(dimension,index)
{
	if(Counter[index]==0 && document.getElementById(dimension).style.border=="1px solid rgb(69, 90, 168)")
	{
	document.getElementById(dimension).style.border="";
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
	document.getElementById(box+'0').checked=true;
	}
	else if(Counter[index]==1)
	{
	Counter[index]=0;
	document.getElementById(box).style.border="";
	document.getElementById(box+'0').checked=false;
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

<style type="text/css">
<!--
body {
	font-family:"Courier New", Courier, monospace;
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	padding: 0;
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
	color: #000000;
}
.oneColLiqCtr #container {
	width: 57%;  /* this will create a container 80% of the browser width */
	background: #FFFFFF;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	text-align: left; /* this overrides the text-align: center on the body element. */
	padding-top:5px;
}
.oneColLiqCtr #mainContent {
	padding: 0 20px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
	position:relative;

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
width: 54%;
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
	width:auto;
	color:#FFFFFF;
	font-size:12px;
	left: 368px;
	top: 42px;
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
}

.header a
{
font-size:10px;
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
font-size:14px;

}
#ACR_HT_SIT
{
	position:absolute;
	left: 250px;
	top: 33px;
}

#ACR_RADL_LNTH
{
	position:absolute;
	left: 252px;
	top: 269px;
}

#BIDELTOID_BRT
{
	position:absolute;
	left: 482px;
	top: 33px;
}

#BUTT_KNEE_LNTH
{
	position:absolute;
	left: 484px;
	top: 269px;
}

#BUTT_POPLITEAL_LNTH
{
	position:absolute;
	left: 483px;
	top: 513px;
}

#CHEST_CIRC_AT_SCYE
{
	position:absolute;
	left: 21px;
	top: 512px;
}

#CHEST_CIRC_BELOW_BUST_
{
	position:absolute;
	left: 252px;
	top: 512px;
}
#EYE_HT_SITTING
{
	position:absolute;
	left: 486px;
	top: 750px;
}

#FOREARM_HAND_LENTH
{
	position:absolute;
	left: 21px;
	top: 991px;
}
#FOOT_BRTH
{
	position:absolute;
	left: 257px;
	top: 1440px;
}

#FOOT_BRTH
{
	position:absolute;
	left: 22px;
	top: 1231px;
}
#FOOT_LNTH
{
	position:absolute;
	left: 251px;
	top: 991px;
}

#HAND_BRTH_AT_METACARPAL
{
	position:absolute;
	left: 251px;
	top: 1231px;
}

#HAND_LNTH
{
	position:absolute;
	left: 485px;
	top: 991px;
}
#HEAD_BRTH
{
	position:absolute;
	left: 483px;
	top: 1231px;
}

#HEAD_CIRC
{
	position:absolute;
	left: 20px;
	top: 1473px;
}

#HEAD_LNTH
{
	position:absolute;
	left: 21px;
	top: 1712px;
}
#HIP_BRTH
{
	position:absolute;
	left: 250px;
	top: 1473px;
}

#KNEE_HT_SITTING
{
	position:absolute;
	left: 483px;
	top: 1473px;
}

#LATERAL_FEMORAL_EPICONDYLE_HT
{
	position:absolute;
	left: 6px;
	top: 1957px;
}

#MENTON_TO_NASAL_ROOT_DEP_LNTH
{
	position:absolute;
	left: 256px;
	top: 1957px;
}

#OVRHD_EXT_REACH
{
	position:absolute;
	left: 506px;
	top: 1956px;
}

#OVRHD_SIT_REACH
{
	position:absolute;
	left: 21px;
	top: 2428px;
}

#POPLITEAL_HT_SITTING
{
	position:absolute;
	left: 22px;
	top: 2669px;
}

#SHOULDER_ELBOW_LNTH
{
	position:absolute;
	left: 251px;
	top: 2428px;
}
#SITTING_HT
{
	position:absolute;
	left: 251px;
	top: 2669px;
}

#SPAN
{
	position:absolute;
	left: 484px;
	top: 2428px;
}

#STATURE
{
	position:absolute;
	left: 22px;
	top: 2908px;
	width: 220px;
	height: 457px;
}

#SUPRASTERNALE_HT
{
	position:absolute;
	left: 251px;
	top: 2908px;
}

#THUMB_TIP_REACH
{
	position:absolute;
	left: 484px;
	top: 2908px;
}

#TROCHANTERION_HT
{
	position:absolute;
	left: 21px;
	top: 3385px;
}

#WAIST_HT_OMPHALION
{
	position:absolute;
	left: 250px;
	top: 3384px;
}

#WRIST_TO_CENTER_OF_GRIP_LNTH
{
	position:absolute;
	left: 481px;
	top: 3384px;
}

#WRIST_TO_INDEX_FINGER_LNTH
{
	position:absolute;
	left: 483px;
	top: 3618px;
}

#WRST_LNTH_TO_WALL
{
	position:absolute;
	left: 20px;
	top: 3862px;
}

#submitValue
{
	height:858px;
	overflow:hidden;
	position:absolute;
	left: 21px;
	top: 33px;
	visibility:hidden;
	z-index:10;
}

#formSubmit
{
	position:absolute;
	left: 768px;
	top: 101px;
}
.templateHeight
{
height:462px;
display:block;
}
</style>
</head>

<body class="oneColLiqCtr" onload="loadConstants()">

<div id="firstHeader"><div id="secondHeader"><img src="images/psu.png"/><div id="OpenDesignLab"><span>Open Design Lab Design Tools</span></div>
</div></div>
<div id="container">
  <div id="mainContent">
  <div class="header">Select Dimension(s),Gender and click submit....<a href="#" onclick="switchToListView()" id="switchTo">switch to list view</a><hr  style="margin-top:2px;" color="#455AA8"/>
  </div>
  <div id="picture">
  <div id="ACROMION_HT" class="templateHeight";><div class="subHeader">ACROMION_HT</div><div><img src="images/JPEG/acro_ht.jpg" border="0" onmouseover="changeBorder('ACROMION_HT','0')" onmouseout="changeBorder1('ACROMION_HT','0')" title="click to select ACROMION_HT dimension" onclick="selectPicture('ACROMION_HT','0')"/></div></div>
  
  <div id="ACR_HT_SIT">
    <div class="subHeader"><a href="#" onclick="submitOnce('ACR_HT_SIT','1')">ACR_HT_SIT</a></div><div><img src="images/JPEG2/acro_ht_sit.jpg" border="0" onmouseover="changeBorder('ACR_HT_SIT','1')" onmouseout="changeBorder1('ACR_HT_SIT','1')" title="click to select ACR_HT_SITT dimension" onclick="selectPicture('ACR_HT_SIT','1')"/></div>
  </div>
  
   <div id="ACR_RADL_LNTH">
    <div class="subHeader">ACR_RADL_LNTH</div><div><img src="images/JPEG2/SmallnotAvailablePic.jpg" border="0" onmouseover="changeBorder('ACR_RADL_LNTH','2')" onmouseout="changeBorder1('ACR_RADL_LNTH','2')" title="click to select ACR_RADL_LNTH dimension" onclick="selectPicture('ACR_RADL_LNTH','2')"/></div>
  </div>
    
      <div id="BIDELTOID_BRT">
    <div class="subHeader">BIDELTOID_BRT</div><div><img src="images/JPEG2/bidelt_br.jpg" border="0" onmouseover="changeBorder('BIDELTOID_BRT','3')" onmouseout="changeBorder1('BIDELTOID_BRT','3')" title="click to select BIDELTOID_BRT dimension" onclick="selectPicture('BIDELTOID_BRT','3')"/></div>
  </div>
  	
    <div id="BUTT_KNEE_LNTH">
    <div class="subHeader">BUTT_KNEE_LNTH</div><div><img src="images/JPEG2/butt_knee_len.jpg"  border="0" onmouseover="changeBorder('BUTT_KNEE_LNTH','4')" onmouseout="changeBorder1('BUTT_KNEE_LNTH','4')" title="click to select BUTT_KNEE_LNTH dimension" onclick="selectPicture('BUTT_KNEE_LNTH','4')"/></div>
  </div>
    
    <div id="BUTT_POPLITEAL_LNTH">
    <div class="subHeader">BUTT_POPLITEAL_LNTH</div><div><img src="images/JPEG2/butt_pop_len.jpg"  border="0" onmouseover="changeBorder('BUTT_POPLITEAL_LNTH','5')" onmouseout="changeBorder1('BUTT_POPLITEAL_LNTH','5')" title="click to select BUTT_POPLITEAL_LNTH dimension" onclick="selectPicture('BUTT_POPLITEAL_LNTH','5')"/></div>
  </div>
    
    <div id="CHEST_CIRC_AT_SCYE" class="templateHeight">
    <div class="subHeader">CHEST_CIRC_AT_SCYE</div><div><img src="images/JPEG/chest_circ.jpg"  border="0" onmouseover="changeBorder('CHEST_CIRC_AT_SCYE','6')" onmouseout="changeBorder1('CHEST_CIRC_AT_SCYE','6')" title="click to select CHEST_CIRC_AT_SCYE dimension" onclick="selectPicture('CHEST_CIRC_AT_SCYE','6')"/></div>
  </div>
    
    <div id="CHEST_CIRC_BELOW_BUST_" class="templateHeight">
    <div class="subHeader">CHEST_CIRC_BELOW_BUST_</div><div><img src="images/JPEG/chest_br_10th_rib.jpg"  border="0" onmouseover="changeBorder('CHEST_CIRC_BELOW_BUST_','7')" onmouseout="changeBorder1('CHEST_CIRC_BELOW_BUST_','7')" title="click to select CHEST_CIRC_BELOW_BUST_ dimension" onclick="selectPicture('CHEST_CIRC_BELOW_BUST_','7')"/></div>
  </div>
  
	<div id="EYE_HT_SITTING">
    <div class="subHeader">EYE_HT_SITTING</div><div><img src="images/JPEG2/eye_ht_sit.jpg"  border="0" onmouseover="changeBorder('EYE_HT_SITTING','8')" onmouseout="changeBorder1('EYE_HT_SITTING','8')" title="click to select EYE_HT_SITTING dimension" onclick="selectPicture('EYE_HT_SITTING','8')"/></div>
  </div>  
  
  <div id="FOREARM_HAND_LENTH">
    <div class="subHeader">FOREARM_HAND_LENTH</div><div><img src="images/JPEG2/forearm_hand_len.jpg"  border="0" onmouseover="changeBorder('FOREARM_HAND_LENTH','9')" onmouseout="changeBorder1('FOREARM_HAND_LENTH','9')" title="click to select FOREARM_HAND_LENTH dimension" onclick="selectPicture('FOREARM_HAND_LENTH','9')"/></div>
  </div> 
   
  <div id="FOOT_BRTH">
    <div class="subHeader">FOOT_BRTH</div><div><img src="images/JPEG2/foot_br_horiz.jpg"  border="0" onmouseover="changeBorder('FOOT_BRTH','10')" onmouseout="changeBorder1('FOOT_BRTH','10')" title="click to select FOOT_BRTH dimension" onclick="selectPicture('FOOT_BRTH','10')"/></div>
  </div>  
  
  <div id="FOOT_LNTH">
    <div class="subHeader">FOOT_LNTH</div><div><img src="images/JPEG2/foot_len.jpg"  border="0" onmouseover="changeBorder('FOOT_LNTH','11')" onmouseout="changeBorder1('FOOT_LNTH','11')" title="click to select FOOT_LNTH dimension" onclick="selectPicture('FOOT_LNTH','11')"/></div>
  </div>
  
  <div id="HAND_BRTH_AT_METACARPAL">
    <div class="subHeader">HAND_BRTH_AT_METACARPAL</div><div><img src="images/JPEG2/hand_br.jpg"  border="0" onmouseover="changeBorder('HAND_BRTH_AT_METACARPAL','12')" onmouseout="changeBorder1('HAND_BRTH_AT_METACARPAL','12')" title="click to select HAND_BRTH_AT_METACARPAL dimension" onclick="selectPicture('HAND_BRTH_AT_METACARPAL','12')"/></div>
  </div>
  
  <div id="HAND_LNTH">
    <div class="subHeader">HAND_LNTH</div><div><img src="images/JPEG2/hand_len.jpg"  border="0" onmouseover="changeBorder('HAND_LNTH','13')" onmouseout="changeBorder1('HAND_LNTH','13')" title="click to select HAND_LNTH dimension" onclick="selectPicture('HAND_LNTH','13')"/></div>
  </div>
  
  <div id="HEAD_BRTH">
    <div class="subHeader">HEAD_BRTH</div><div><img src="images/JPEG2/head_br.jpg"  border="0" onmouseover="changeBorder('HEAD_BRTH','14')" onmouseout="changeBorder1('HEAD_BRTH','14')" title="click to select HEAD_BRTH dimension" onclick="selectPicture('HEAD_BRTH','14')"/></div>
  </div>
 
  <div id="HEAD_CIRC">
    <div class="subHeader">HEAD_CIRC</div><div><img src="images/JPEG2/head_circ.jpg"  border="0" onmouseover="changeBorder('HEAD_CIRC','15')" onmouseout="changeBorder1('HEAD_CIRC','15')" title="click to select HEAD_CIRC dimension" onclick="selectPicture('HEAD_CIRC','15')"/></div>
  </div>
 
    <div id="HEAD_LNTH">
    <div class="subHeader"> HEAD_LNTH</div><div><img src="images/JPEG2/head_len.jpg"  border="0" onmouseover="changeBorder('HEAD_LNTH','16')" onmouseout="changeBorder1('HEAD_LNTH','16')" title="click to select HEAD_LNTH dimension" onclick="selectPicture('HEAD_LNTH','16')"/></div>
  </div>
  
  <div id="HIP_BRTH" class="templateHeight">
    <div class="subHeader">HIP_BRTH</div><div><img src="images/JPEG/hip_br_max.jpg" border="0" onmouseover="changeBorder('HIP_BRTH','17')" onmouseout="changeBorder1('HIP_BRTH','17')" title="click to select HIP_BRTH dimension" onclick="selectPicture('HIP_BRTH','17')"/></div>
  </div>
  
    <div id="KNEE_HT_SITTING" class="templateHeight">
    <div class="subHeader">KNEE_HT_SITTING</div><div><img src="images/JPEG/knee_ht_lfc.jpg" border="0" onmouseover="changeBorder('KNEE_HT_SITTING','18')" onmouseout="changeBorder1('KNEE_HT_SITTING','18')" title="click to select KNEE_HT_SITTING dimension" onclick="selectPicture('KNEE_HT_SITTING','18')"/></div>
  </div>

<div id="LATERAL_FEMORAL_EPICONDYLE_HT">
    <div class="subHeader">LATERAL_FEMORAL_EPICONDYLE_HT</div><div><img src="images/JPEG2/BignotAvailablePic.jpg" border="0" onmouseover="changeBorder('LATERAL_FEMORAL_EPICONDYLE_HT','19')" onmouseout="changeBorder1('LATERAL_FEMORAL_EPICONDYLE_HT','19')" title="click to select LATERAL_FEMORAL_EPICONDYLE_HT dimension" onclick="selectPicture('LATERAL_FEMORAL_EPICONDYLE_HT','19')"/></div>
  </div>

<div id="MENTON_TO_NASAL_ROOT_DEP_LNTH">
    <div class="subHeader">MENTON_TO_NASAL_ROOT_DEP_LNTH</div><div><img src="images/JPEG2/BignotAvailablePic.jpg" border="0" onmouseover="changeBorder('MENTON_TO_NASAL_ROOT_DEP_LNTH','20')" onmouseout="changeBorder1('MENTON_TO_NASAL_ROOT_DEP_LNTH','20')" title="click to select MENTON_TO_NASAL_ROOT_DEP_LNTH dimension" onclick="selectPicture('MENTON_TO_NASAL_ROOT_DEP_LNTH','20')"/></div>
  </div>


<div id="OVRHD_EXT_REACH">
    <div class="subHeader">OVRHD_EXT_REACH</div><div><img src="images/JPEG/overhead_fingertip.jpg" border="0" onmouseover="changeBorder('OVRHD_EXT_REACH','21')" onmouseout="changeBorder1('OVRHD_EXT_REACH','21')" title="click to select OVRHD_EXT_REACH dimension" onclick="selectPicture('OVRHD_EXT_REACH','21')"/></div>
  </div>
  
  <div id="OVRHD_SIT_REACH">
    <div class="subHeader">OVRHD_SIT_REACH</div><div><img src="images/JPEG2/SmallnotAvailablePic.jpg" border="0" onmouseover="changeBorder('OVRHD_SIT_REACH','22')" onmouseout="changeBorder1('OVRHD_SIT_REACH','22')" title="click to select OVRHD_SIT_REACH dimension" onclick="selectPicture('OVRHD_SIT_REACH','22')"/></div>
  </div>
  
  <div id="POPLITEAL_HT_SITTING">
    <div class="subHeader">POPLITEAL_HT_SITTING</div><div><img src="images/JPEG2/pop_ht_sit.jpg" border="0" onmouseover="changeBorder('POPLITEAL_HT_SITTING','23')" onmouseout="changeBorder1('POPLITEAL_HT_SITTING','23')" title="click to select POPLITEAL_HT_SITTING dimension" onclick="selectPicture('POPLITEAL_HT_SITTING','23')"/></div>
  </div>
  
  <div id="SHOULDER_ELBOW_LNTH">
    <div class="subHeader">SHOULDER_ELBOW_LNTH</div><div><img src="images/JPEG2/SmallnotAvailablePic.jpg" border="0" onmouseover="changeBorder('SHOULDER_ELBOW_LNTH','24')" onmouseout="changeBorder1('SHOULDER_ELBOW_LNTH','24')" title="click to select SHOULDER_ELBOW_LNTH dimension" onclick="selectPicture('SHOULDER_ELBOW_LNTH','24')"/></div>
  </div>
  
  <div id="SITTING_HT">
    <div class="subHeader">SITTING_HT</div><div><img src="images/JPEG2/sit_ht.jpg" border="0" onmouseover="changeBorder('SITTING_HT','25')" onmouseout="changeBorder1('SITTING_HT','25')" title="click to select SITTING_HT dimension" onclick="selectPicture('SITTING_HT','25')"/></div>
  </div>
  
  <div id="SPAN" class="templateHeight">
    <div class="subHeader">SPAN</div><div><img src="images/JPEG2/BignotAvailablePic.jpg" border="0" onmouseover="changeBorder('SPAN','26')" onmouseout="changeBorder1('SPAN','26')" title="click to select SITTING_HT dimension" onclick="selectPicture('SPAN','26')"/></div>
  </div>
  
    <div id="STATURE" class="templateHeight">
    <div class="subHeader">STATURE</div><div><img src="images/JPEG/stature.jpg" border="0" onmouseover="changeBorder('STATURE','27')" onmouseout="changeBorder1('STATURE','27')" title="click to select STATURE dimension" onclick="selectPicture('STATURE','27')"/></div>
  </div>
 
 <div id="SUPRASTERNALE_HT" class="templateHeight">
    <div class="subHeader">SUPRASTERNALE_HT</div><div><img src="images/JPEG/suprastern_ht.jpg" border="0" onmouseover="changeBorder('SUPRASTERNALE_HT','28')" onmouseout="changeBorder1('SUPRASTERNALE_HT','28')" title="click to select SUPRASTERNALE_HT dimension" onclick="selectPicture('SUPRASTERNALE_HT','28')"/></div>
  </div>


<div id="THUMB_TIP_REACH" class="templateHeight">
    <div class="subHeader">THUMB_TIP_REACH</div><div><img src="images/JPEG2/BignotAvailablePic.jpg" border="0" onmouseover="changeBorder('THUMB_TIP_REACH','29')" onmouseout="changeBorder1('THUMB_TIP_REACH','29')" title="click to select THUMB_TIP_REACH dimension" onclick="selectPicture('THUMB_TIP_REACH','29')"/></div>
  </div>

<div id="TROCHANTERION_HT" class="templateHeight">
    <div class="subHeader">TROCHANTERION_HT</div><div><img src="images/JPEG/troch_ht.jpg" border="0" onmouseover="changeBorder('TROCHANTERION_HT','30')" onmouseout="changeBorder1('TROCHANTERION_HT','30')" title="click to select TROCHANTERION_HT dimension" onclick="selectPicture('TROCHANTERION_HT','30')"/></div>
  </div>


<div id="WAIST_HT_OMPHALION" class="templateHeight">
    <div class="subHeader">WAIST_HT_OMPHALION</div><div><img src="images/JPEG/waist_ht_mid_abd.jpg" border="0" onmouseover="changeBorder('WAIST_HT_OMPHALION','31')" onmouseout="changeBorder1('WAIST_HT_OMPHALION','31')" title="click to select WAIST_HT_OMPHALION dimension" onclick="selectPicture('WAIST_HT_OMPHALION','31')"/></div>
  </div>

<div id="WRIST_TO_CENTER_OF_GRIP_LNTH">
    <div class="subHeader">WRIST_TO_CENTER_OF_GRIP_LNTH</div><div><img src="images/JPEG2/SmallnotAvailablePic.jpg" border="0" onmouseover="changeBorder('WRIST_TO_CENTER_OF_GRIP_LNTH','32')" onmouseout="changeBorder1('WRIST_TO_CENTER_OF_GRIP_LNTH','32')" title="click to select WRIST_TO_CENTER_OF_GRIP_LNTH dimension" onclick="selectPicture('WRIST_TO_CENTER_OF_GRIP_LNTH','32')"/></div>
  </div>

<div id="WRIST_TO_INDEX_FINGER_LNTH">
    <div class="subHeader">WRIST_TO_INDEX_FINGER_LNTH</div><div><img src="images/JPEG2/wrist_index_len.jpg" border="0" onmouseover="changeBorder('WRIST_TO_INDEX_FINGER_LNTH','33')" onmouseout="changeBorder1('WRIST_TO_INDEX_FINGER_LNTH','33')" title="click to select WRIST_TO_INDEX_FINGER_LNTH dimension" onclick="selectPicture('WRIST_TO_INDEX_FINGER_LNTH','33')"/></div>
  </div>

<div id="WRST_LNTH_TO_WALL" class="templateHeight">
    <div class="subHeader">WRST_LNTH_TO_WALL</div><div><img src="images/JPEG2/BignotAvailablePic.jpg" border="0" onmouseover="changeBorder('WRST_LNTH_TO_WALL','34')" onmouseout="changeBorder1('WRST_LNTH_TO_WALL','34')" title="click to select WRST_LNTH_TO_WALL dimension" onclick="selectPicture('WRST_LNTH_TO_WALL','34')"/></div>
  </div>
  </div>  

  <form name="values1"  method="post" action="AnsurDataResult.php"> 
<div id="formSubmit">
  <table><tr><td><select name="gender[]"><option>Male</option><option>Female</option></select></td><td> <input type="submit" /></td></tr></table></div>
  <div id="submitValue">
<!--   <table><tr><td><select name="gender[]"><option>Male</option><option>Female</option></select></td><td> <input type="submit" /></td></tr></table>  
-->     <input name="dimension[]" type="checkbox" value="ACROMION_HT" id="ACROMION_HT0" />ACROMION_HT<br/>
    <input name="dimension[]" type="checkbox" value="ACR_HT_SIT" id="ACR_HT_SIT0" />ACR_HT_SIT<br/>
    <input name="dimension[]" type="checkbox" value="ACR_RADL_LNTH" id="ACR_RADL_LNTH0" />ACR_RADL_LNTH<br/>
    <input name="dimension[]" type="checkbox" value="BIDELTOID_BRTH" id="BIDELTOID_BRT0" />BIDELTOID_BRT <br/>   
    <input name="dimension[]" type="checkbox" value="BUTT_KNEE_LNTH" id="BUTT_KNEE_LNTH0" />BUTT_KNEE_LNTH<br/>
    <input name="dimension[]" type="checkbox" value="BUTT_POPLITEAL_LNTH" id="BUTT_POPLITEAL_LNTH0" />BUTT_POPLITEAL_LNTH<br/>
    <input name="dimension[]" type="checkbox" value="CHEST_CIRC_AT_SCYE" id="CHEST_CIRC_AT_SCYE0" />CHEST_CIRC_AT_SCYE<br/>
    <input name="dimension[]" type="checkbox" value="CHEST_CIRC_BELOW_BUST_" id="CHEST_CIRC_BELOW_BUST_0" />CHEST_CIRC_BELOW_BUST_<br/>
    <input name="dimension[]" type="checkbox" value="EYE_HT_SITTING" id="EYE_HT_SITTING0"/>EYE_HT_SITTING<br/>
    <input name="dimension[]" type="checkbox" value="FOREARM_HAND_LENTH" id="FOREARM_HAND_LENTH0" />FOREARM_HAND_LENTH<br/>
    <input name="dimension[]" type="checkbox" value="FOOT_BRTH" id="FOOT_BRTH0" />FOOT_BRTH<br/>
    <input name="dimension[]" type="checkbox" value="FOOT_LNTH" id="FOOT_LNTH0" />FOOT_LNTH<br/>
    <input name="dimension[]" type="checkbox" value="HAND_BRTH_AT_METACARPALE" id="HAND_BRTH_AT_METACARPAL0" />HAND_BRTH_AT_METACARPAL<br/>
    <input name="dimension[]" type="checkbox" value="HAND_LNTH" id="HAND_LNTH0" />HAND_LNTH<br/>
    <input name="dimension[]" type="checkbox" value="HEAD_BRTH" id="HEAD_BRTH0" />HEAD_BRTH<br/>
    <input name="dimension[]" type="checkbox" value="HEAD_CIRC" id="HEAD_CIRC0" />HEAD_CIRC<br/>
    <input name="dimension[]" type="checkbox" value="HEAD_LNTH" id="HEAD_LNTH0" />HEAD_LNTH<br/>
    <input name="dimension[]" type="checkbox" value="HIP_BRTH" id="HIP_BRTH0" />HIP_BRTH<br/>
    <input name="dimension[]" type="checkbox" value="KNEE_HT_SITTING" id="KNEE_HT_SITTING0" />KNEE_HT_SITTING<br/>
    <input name="dimension[]" type="checkbox" value="LATERAL_FEMORAL_EPICONDYLE_HT" id="LATERAL_FEMORAL_EPICONDYLE_HT0" />LATERAL_FEMORAL_EPICONDYLE_HT<br/>
    <input name="dimension[]" type="checkbox" value="MENTON_TO_NASAL_ROOT_DEP_LNTH" id="MENTON_TO_NASAL_ROOT_DEP_LNTH0" />MENTON_TO_NASAL_ROOT_DEP_LNTH<br/>
    <input name="dimension[]" type="checkbox" value="OVRHD_EXT_REACH" id="OVRHD_EXT_REACH0" />OVRHD_EXT_REACH<br/>
    <input name="dimension[]" type="checkbox" value="OVRHD_SIT_REACH" id="OVRHD_SIT_REACH0" />OVRHD_SIT_REACH<br/>
    <input name="dimension[]" type="checkbox" value="POPLITEAL_HT_SITTING" id="POPLITEAL_HT_SITTING0" />POPLITEAL_HT_SITTING<br/>
    <input name="dimension[]" type="checkbox" value="SHOULDER_ELBOW_LNTH" id="SHOULDER_ELBOW_LNTH0" />SHOULDER_ELBOW_LNTH<br/>
    <input name="dimension[]" type="checkbox" value="SITTING_HT" id="SITTING_HT0" />SITTING_HT<br/>
    <input name="dimension[]" type="checkbox" value="SPAN" id="SPAN0" />SPAN<br/>
    <input name="dimension[]" type="checkbox" value="STATURE" id="STATURE0" />STATURE<br/>
    <input name="dimension[]" type="checkbox" value="SUPRASTERNALE_HT" id="SUPRASTERNALE_HT0" />SUPRASTERNALE_HT<br/>
    <input name="dimension[]" type="checkbox" value="THUMB_TIP_REACH" id="THUMB_TIP_REACH0" />THUMB_TIP_REACH<br/>
    <input name="dimension[]" type="checkbox" value="TROCHANTERION_HT" id="TROCHANTERION_HT0" />TROCHANTERION_HT<br/>
    <input name="dimension[]" type="checkbox" value="WAIST_HT_OMPHALION" id="WAIST_HT_OMPHALION0" />WAIST_HT_OMPHALION<br/>
    <input name="dimension[]" type="checkbox" value="WRIST_TO_CENTER_OF_GRIP_LNTH" id="WRIST_TO_CENTER_OF_GRIP_LNTH0" />WRIST_TO_CENTER_OF_GRIP_LNTH<br/>
    <input name="dimension[]" type="checkbox" value="WRIST_TO_INDEX_FINGER_LNTH" id="WRIST_TO_INDEX_FINGER_LNTH0" />WRIST_TO_INDEX_FINGER_LNTH<br/>
    <input name="dimension[]" type="checkbox" value="WRST_LNTH_TO_WALL" id="WRST_LNTH_TO_WALL0" />WRST_LNTH_TO_WALL<br/>
    <div id="formSubmitList"><table><tr><td><select name="gender[]"><option>Male</option><option>Female</option></select></td><td> <input type="submit" /></td></tr></table></div>  

</div>
</form>
  </div>
  </div>
  
  </body>
</html>
