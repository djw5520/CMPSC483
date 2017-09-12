function convertToMM()
{
var inchOrMm=document.selector2.inchesOrMM.options;

	if(inchOrMm[0].selected && document.selector2.inches.value=="mm")
	{
		document.selector2.inches.value="inches";
		document.selector2.lbs.value="lbs";
	}
	else if(inchOrMm[1].selected && document.selector2.inches.value=="inches")
	{
		document.selector2.inches.value="mm";
		document.selector2.lbs.value="kg";
	}

}

function changeCase()//Function that switches between stature or population parameters*****Note: Function changeCase is set onLoad*******
{
	var statureOrParameter=document.selector.statureOrParameter.options;
	
		if(statureOrParameter[0].selected)//check to see if stature is selected. If it is, load form parameter
			{
			var boundaryRatio=document.getElementById("BoundaryRatios");
			boundaryRatio.innerHTML="<form id='Selector1' name='selector1'><span style='padding-right:5px'><select name='dimension' id='Percentile' onchange='checkSelection()'><option value='acromialHt'>A acromial ht</option><option value='trochanterionHt'>B trochanterion ht</option><option value='latFemoralEpicondyleHt'>C lat Femoral Epicondyle Ht</option><option value='latMalleolusHt'>D lat Malleolus Ht</option><option value='handIn'>E Hand In</option><option value='radialeStylonLn'>F radiale-Stylon Ln</option><option value='acromionRadialeln'>G acromion-radiale ln</option><option value='popLitealHt'>H pop liteal ht</option><option value='buttockPoplitealLn'>I buttock-popliteal ln</option><option value='acromialHtSit'>J acromial ht, sit</option><option value='eyeHtSit'>k eye ht, sit</option> <option value='sittingHt'>L sittingHt</option><option value='thumbTipReach'>* Thumbtip reach</option><option value='biacromialBdh'>* biacromial bdh</option><option value='bideltoidBdh'>*+ bideltoid bdh</option><option value='hipBdhSit'>*+ hip-bdh, sit</option><option value='waistBdh'>*+ waist bdh</option><option value='waistCirc'>*+ waist circ</option></select></form>";
			var x= convertToMM();
			}
	
}

function clearInput(id)
{
var upper=document.getElementById("upper");
var lower=document.getElementById("lower");
var Lbs1=document.getElementById("Pounds");
var Inches=document.getElementById("Inches");
	switch (id)
	{
	
	case "inches":
	document.selector2.inches.value="";	
	Inches.style.color="#000000";
	break;
	
	case "lbs":
	document.selector2.lbs.value="";
	Lbs1.style.color="#000000";
	break;
	
	case "upper1":
	document.selector2.upper1.value="";
	upper.style.color="#000000";
	break;
	
	case "lower1":
	document.selector2.lower1.value="";
	lower.style.color="#000000";
	break;
	
	default:
	
	}

}	
function insertValue(id)
{
var inchOrMm=document.selector2.inchesOrMM.options;
var upper=document.getElementById("upper");
var lower=document.getElementById("lower");
var Lbs1=document.getElementById("Pounds");
var Inches=document.getElementById("Inches");

	switch (id)
	{
	
	case "inches":
	if(document.selector2.inches.value=="" && inchOrMm[0].selected)
	{
	Inches.style.color="#666666";
	document.selector2.inches.value="inches";
	}
	else if(document.selector2.inches.value=="" && inchOrMm[1].selected)
	{
	Inches.style.color="#666666";
	document.selector2.inches.value="mm";
	}
	break;
	
	case "lbs":
	if(document.selector2.lbs.value=="" && inchOrMm[0].selected)
	{
	Lbs1.style.color="#666666";
	document.selector2.lbs.value="lbs";
	}	
	else if(document.selector2.lbs.value=="" && inchOrMm[1].selected)
	{
	Lbs1.style.color="#666666";
	document.selector2.lbs.value="Kg";
	}
	break;
	
	case "upper1":
	if(document.selector2.upper1.value=="")
	{
	upper.style.color="#666666";
	document.selector2.upper1.value="upper";
	}	
	break;
	
	case "lower1":
	if(document.selector2.lower1.value=="")
	{
	lower.style.color="#666666";
	document.selector2.lower1.value="lower";
	}	
	break;
	
	default:
	
	}


}

function accessDatabase(maleOrFemale)
{

var dimensionSelected=document.selector1.dimension;
var x=dimensionSelected.value;
var upper=document.getElementById("upper").value;
var lower=document.getElementById("lower").value;
var Lbs1=document.getElementById("Pounds").value;
var Inches=document.getElementById("Inches").value;

 var xhr=null;
		
		   try
		   {
			 xhr = new XMLHttpRequest(); 
		   } catch(e)
		   { 
			 try { xhr = new ActiveXObject("Msxml2.XMLHTTP"); } 
			 catch (e2)
			{ 
			   try { xhr = new ActiveXObject("Microsoft.XMLHTTP"); } 
			   catch (e) {}
			}
		  }
 xhr.onreadystatechange = function()
		   { 
						
			 if(xhr.readyState == 4)
			 {
				if(xhr.status == 200)
					{ 
				  /*   document.ajax.dyn.value="Received:" + xhr.responseText;
		       var number = Number(xhr.responseText);*/
				var answer=xhr.responseText;
				var displayValue1=document.selector1.dimension.options;
						if(displayValue1[0].selected)
						{
						document.getElementById("ADigit").innerHTML=xhr.responseText;
						}
						else if(displayValue1[1].selected)
						{
						document.getElementById("BDigit").innerHTML=xhr.responseText;
						document.getElementById("BLow").style.height="99px";
						}
						else if(displayValue1[2].selected)
						{
						document.getElementById("CTop").style.height="40px";
						document.getElementById("CDigit").innerHTML=xhr.responseText;
						}
						else if(displayValue1[3].selected)
						{
						document.getElementById("DTop").style.height="3px";
						document.getElementById("DDigit").innerHTML=xhr.responseText;
						}
						else if(displayValue1[4].selected)
						{
						document.getElementById("ETop").style.height="7px";
						document.getElementById("ELow").style.height="8px";
						document.getElementById("EDigit").innerHTML=xhr.responseText;
						}
						else if(displayValue1[5].selected)
						{
						document.getElementById("FTop").style.height="10px";
						document.getElementById("FLow").style.height="10px";
						document.getElementById("FDigit").innerHTML=xhr.responseText;
						}
						else if(displayValue1[6].selected)
						{
						document.getElementById("GTop").style.height="33px";
						document.getElementById("GLow").style.height="23px";
						document.getElementById("GDigit").innerHTML=xhr.responseText;
						}
						else if(displayValue1[7].selected)
						{
						document.getElementById("HTop").style.height="35px";
						document.getElementById("HLow").style.height="37px";
						document.getElementById("HDigit").innerHTML=xhr.responseText;
						}
						else if(displayValue1[8].selected)
						{
						document.getElementById("ILeft").style.height="25px";
						document.getElementById("IRight").style.height="25px";
						document.getElementById("ILeft").style.width="30px";
						document.getElementById("IRight").style.width="43px";
						document.getElementById("IDigit").innerHTML=xhr.responseText;
						document.getElementById("IDigit").style.paddingLeft=0;
						document.getElementById("IDigit").style.paddingRight=0;
						}
						else if(displayValue1[9].selected)
						{
						document.getElementById("JTop").style.height="50px";
						document.getElementById("JLow").style.height="70px";
						document.getElementById("JDigit").innerHTML=xhr.responseText;
						}
						else if(displayValue1[10].selected)
						{
						document.getElementById("KTop").style.height="65px";
						document.getElementById("KLow").style.height="100px";
						document.getElementById("KDigit").innerHTML=xhr.responseText;
						}
						else if(displayValue1[11].selected)
						{
						document.getElementById("LTop").style.height="45px";
						document.getElementById("LDigit").innerHTML=xhr.responseText;
						}
						else if(displayValue1[12].selected)
						{
						document.getElementById("tableContainer2").style.visibility="visible";
						
						
						document.getElementById("tableContainer2").innerHTML=xhr.responseText;
						
						/*<td id="stature"></td><td id="95thPercentile"></td><td id="5thPercentile">*/	
						}
						else if(displayValue1[13].selected)
						{
						document.getElementById("tableContainer2").style.visibility="visible";
						document.getElementById("tableContainer2").innerHTML=xhr.responseText;
						}
						else if(displayValue1[14].selected)
						{
						document.getElementById("tableContainer2").style.visibility="visible";
						document.getElementById("tableContainer2").innerHTML=xhr.responseText;
						}
						else if(displayValue1[15].selected)
						{
						document.getElementById("tableContainer2").style.visibility="visible";
						document.getElementById("tableContainer2").innerHTML=xhr.responseText;
						}
						else if(displayValue1[16].selected)
						{
						document.getElementById("tableContainer2").style.visibility="visible";
						document.getElementById("tableContainer2").innerHTML=xhr.responseText;
						}
						else if(displayValue1[17].selected)
						{
						document.getElementById("tableContainer2").style.visibility="visible";
						document.getElementById("tableContainer2").innerHTML=xhr.responseText;
						}
					}
			  }
		   };
	var inchOrMm=document.selector2.inchesOrMM
	var url="BoundaryRatio.php"+"?m=" + maleOrFemale;
	url=url+"&d="+x;
	url=url+"&u="+upper;
	url=url+"&l="+lower;
	url=url+"&p="+Lbs1;
	url=url+"&i="+Inches;
	url=url+"&F="+inchOrMm.value;
	url+"&sid="+Math.random();
	xhr.open("POST",url, true);
	xhr.send(null); 
}
function changeColor(id)
{
var change=document.getElementById(id);
change.style.color="#000000";
}

function resetImageSize()
{
	document.getElementById("ADigit").innerHTML="A";
	document.getElementById("BDigit").innerHTML="B";
	document.getElementById("CDigit").innerHTML="C";
	document.getElementById("DDigit").innerHTML="D";
	document.getElementById("EDigit").innerHTML="E";
	document.getElementById("FDigit").innerHTML="F";
	document.getElementById("GDigit").innerHTML="G";
	document.getElementById("HDigit").innerHTML="H";
	document.getElementById("IDigit").style.paddingLeft="9px";
	document.getElementById("IDigit").style.paddingRight="9px;";
	document.getElementById("ILeft").style.height="25px";
	document.getElementById("IRight").style.height="25px";
	document.getElementById("ILeft").style.width="56px";
	document.getElementById("IRight").style.width="55px";
	document.getElementById("IDigit").innerHTML="I";
	document.getElementById("JDigit").innerHTML="J";
	document.getElementById("KDigit").innerHTML="K";
	document.getElementById("LDigit").innerHTML="L";
	document.getElementById("CTop").style.height="47px";
	document.getElementById("DTop").style.height="5px";
	document.getElementById("ETop").style.height="17px";
	document.getElementById("ELow").style.height="17px";
	document.getElementById("FTop").style.height="20px";
	document.getElementById("FLow").style.height="20px";
	document.getElementById("GTop").style.height="33px";
	document.getElementById("GLow").style.height="40px";
	document.getElementById("HTop").style.height="48px";
	document.getElementById("HLow").style.height="48px";
	document.getElementById("JTop").style.height="70px";
	document.getElementById("JLow").style.height="70px";
	document.getElementById("KTop").style.height="100px";
	document.getElementById("KLow").style.height="90px";
}
function checkStatus()
{
var inch=document.selector2.inches.value;
var pounds=document.selector2.lbs.value;
var upper=document.selector2.upper1.value;
var lower=document.selector2.lower1.value;
var gender=document.selector2.maleOrFemale.options;

	if(gender[0].selected)
	{
		if(inch=="inches" || pounds=="lbs" || upper=="upper" || lower=="lower")
		{
		var x=resetImageSize();
		}
		else if(inch=="mm" || pounds=="kg" || upper=="upper" || lower=="lower")
		{
		var x=resetImageSize();
		}
		else if(inch!="inches" && pounds!="lbs" && upper!="upper" && lower!="lower")
		
		{
		var database=accessDatabase("Male");
		}
	}
	else if(gender[1].selected)
	{
	if(inch=="inches" || pounds=="lbs" || upper=="upper" || lower=="lower")
		{
		}
		else if(inch=="mm" || pounds=="kg" || upper=="upper" || lower=="lower")
		{
		}
		else if(inch!="inches" && pounds!="lbs" && upper!="upper" && lower!="lower")
		
		{
		var database=accessDatabase("Female");
		}
	}

}

function Conversion()
{
var inch=document.selector2.inches.value;
var pounds=document.selector2.lbs.value;
var inchOrMm=document.selector2.inchesOrMM.options;
	if(inch!="inches" && pounds!="lbs" || inch!="mm" && pounds!="kg")
	{
		var Lbs1=document.getElementById("Pounds").value;
		var Inches=document.getElementById("Inches").value;
		if(inchOrMm[0].selected)
		{
		inch=inch/25.4;
		Lbs1=Lbs1*2.2;
		document.selector2.inches.value=inch;
		document.selector2.lbs.value=Lbs1;
		var x=checkStatus();
		}
		else if(inchOrMm[1].selected)
		{
		inch=inch*25.4;
		Lbs1=Lbs1/2.2;
		document.selector2.inches.value=inch;
		document.selector2.lbs.value=Lbs1;
		x=checkStatus();
		}
	}
}


function checkSelection()
{
	
	var displayValue1=document.selector1.dimension.options;
		if(displayValue1[0].selected)
		{
		document.getElementById("tableContainer2").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="visible";
		}
		else if(displayValue1[1].selected)
		{
		document.getElementById("tableContainer2").style.visibility="hidden";		
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("B").style.visibility="visible";
		}
		else if(displayValue1[2].selected)
		{
		document.getElementById("tableContainer2").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";		
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("C").style.visibility="visible";
		}
		else if(displayValue1[3].selected)
		{
		document.getElementById("tableContainer2").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("D").style.visibility="visible";
		}
		else if(displayValue1[4].selected)
		{
		document.getElementById("tableContainer2").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";		
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("E").style.visibility="visible";
		}
		else if(displayValue1[5].selected)
		{
		document.getElementById("tableContainer2").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("F").style.visibility="visible";
		}
		else if(displayValue1[6].selected)
		{
		document.getElementById("tableContainer2").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("G").style.visibility="visible";
		}
		else if(displayValue1[7].selected)
		{
		document.getElementById("tableContainer2").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("H").style.visibility="visible";
		}
		
		else if(displayValue1[8].selected)
		{
		document.getElementById("tableContainer2").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("I").style.visibility="visible";

		}

		else if(displayValue1[9].selected)
		{
		document.getElementById("tableContainer2").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("J").style.visibility="visible";

		}
			else if(displayValue1[10].selected)
		{
		document.getElementById("tableContainer2").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("K").style.visibility="visible";

		}
		else if(displayValue1[11].selected)
		{
		document.getElementById("tableContainer2").style.visibility="hidden";
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("L").style.visibility="visible";

		}
		
		else if(displayValue1[12].selected)
		{
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("tableContainer2").style.visibility="visible";

		}
		else if(displayValue1[13].selected)
		{
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("tableContainer2").style.visibility="visible";

		}
		else if(displayValue1[14].selected)
		{
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("tableContainer2").style.visibility="visible";

		}
		else if(displayValue1[15].selected)
		{
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("tableContainer2").style.visibility="visible";

		}
		else if(displayValue1[16].selected)
		{
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("tableContainer2").style.visibility="visible";

		}
		else if(displayValue1[17].selected)
		{
		document.getElementById("K").style.visibility="hidden";
		document.getElementById("J").style.visibility="hidden";
		document.getElementById("I").style.visibility="hidden";
		document.getElementById("H").style.visibility="hidden";
		document.getElementById("G").style.visibility="hidden";
		document.getElementById("F").style.visibility="hidden";
		document.getElementById("E").style.visibility="hidden";
		document.getElementById("D").style.visibility="hidden";
		document.getElementById("C").style.visibility="hidden";
		document.getElementById("B").style.visibility="hidden";
		document.getElementById("A").style.visibility="hidden";
		document.getElementById("L").style.visibility="hidden";
		document.getElementById("tableContainer2").style.visibility="visible";
		
		}
var gender=document.selector2.maleOrFemale.value;
var sendToAccessDatabase= checkStatus();
}