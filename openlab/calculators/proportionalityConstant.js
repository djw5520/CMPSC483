
var num=10;

/*************************************************************Begining of Case Function*********************************************************/

var firstTopSpace=document.getElementById("FirstTopSpace");


function changeCase()//Function that switches between stature or population parameters*****Note: Function changeCase is set onLoad*******
{

var statureOrParameter=document.selector.statureOrParameter.options;//Retreive stature or parameter form

	if(statureOrParameter[0].selected)//check to see if stature is selected. If it is, load form parameter
	{
	/****** Code Below Contains Values for Stature Parameter*/
	var secondRow=document.getElementById("secondRowFirstColumn");
	secondRow.innerHTML="Insert Size(mm/inch):";
	
	secondRow=document.getElementById("secondRowSecondColumn");
	var x ="<form id='Selector2' name='selector2'><span><input name='inch'  type='checkbox' onclick='InchesOrMM(\"inch\"), ConvertToInches()' value='inches' />inches</span><span><input name='mm' type='checkbox' value='Mm' onclick='InchesOrMM(\"mm\"),ConvertToMM()' />mm</span></form>";
	secondRow.innerHTML=x; 
	 secondRow=document.getElementById("secondRowThirdColumn");
	secondRow.innerHTML="<form id='Selector3' name='selector3'><input name='size' type='text' style='width:70px;' onkeyup='Calculation()' /></form>"
	var firstRow=document.getElementById("push");
	firstRow.innerHTML=" ";
	}
	
	else if(statureOrParameter[1].selected)//check to see if population parameter selectedIf it is, load form parameter
	{

		/****** Code Below Contains Values for NHANES Parameter*/
	var firstRow=document.getElementById("push");
	firstRow.innerHTML="<form id='Selector4' name='selector4'><span><input name='inch'  type='checkbox' onclick='InchesOrMM1(\"inch\"), ConvertToInches1()' value='inches' />inches</span><span><input name='mm' type='checkbox' value='Mm' onclick='InchesOrMM1(\"mm\"),ConvertToMM1()' />mm</span></form>";
	secondRow=document.getElementById("secondRowFirstColumn");
	secondRow.innerHTML="<form id='Selector1' name='selector1'><span style='padding-right:5px'><select name='ansurORNhanes' id='AnsurOrNhanes' onchange='SwitchFromAnsur(),checkSelection()'><option value=ANSUR>ANSUR</option><option value='NHANES'>NHANES</option></select></span><select name='percentile' id='Percentile' onchange='checkSelection()'><option value='5th'>5th Percentile</option><option value='10th'>10th Percentile</option><option value='15th'>15th Percentile</option><option value='25th'>25th Percentile</option><option value='50th'>50th Percentile</option><option value='75th'>75th Percentile</option><option value='85th'>85th Percentile</option><option value='90th'>90th Percentile</option><option value='95th'>95th Percentile</option></select></form>";
	
	secondRow=document.getElementById("secondRowSecondColumn");
	secondRow.innerHTML="<form id='Selector2' name='selector2'><select name='maleOrFemale' id='MaleOrFemale' onchange='checkSelection()'><option value='male'>Male</option><option value='female'>Female</option></select></form>";
	 
	 secondRow=document.getElementById("secondRowThirdColumn");
	secondRow.innerHTML="<form id='Selector3' name='selector3'><select name='race' id='Race' onchange='checkSelection()' disabled='disabled'><option value='All'>All Races</option><option value='Black'>Non-Hispanic Black</option><option value='White'>Non-Hispanic White</option><option value='Mexican'>Mexican American</option></select></form>";
	
	var inch1=document.selector4.inch;
	inch1.checked=true;
	var ansur=checkSelection();
	}
	var inch=document.selector2.inch;
	inch.checked=true;
	
}

/*************************************************************End of Change Case Function*********************************************************/



function InchesOrMM(check)//This Function Deselects inches when MM is selected, or Vice versa
{
	var inch=document.selector2.inch;
	 var mm=document.selector2.mm;

		if(check=="inch")
		{
		mm.checked=false;
		
		}
		
		else if(check == "mm" )
		{
		inch.checked=false;
		}
}

function InchesOrMM1(check)//This Function Deselects inches when MM is selected, or Vice versa
{
	var inch1=document.selector4.inch;
	var mm1=document.selector4.mm;
		if(check=="inch")
		{
		mm1.checked=false;
		}
		else if(check == "mm" )
		{			
		inch1.checked=false;
		}
}

/*************************************************************beginging of Calculation Stature function Case Function*********************************************************/

function Calculation1(inchOrMM,number)
{
	
	var height=document.getElementById("height");//access height and other parameter Id's
	var shoudlerHeight=document.getElementById("shoudlerHeight");
	var elbowHeight=document.getElementById("elbowHeight");
	var wristHeight=document.getElementById("wristHeight");
	var FingerHeight=document.getElementById("FingerHeight");
	var chestWidth=document.getElementById("chestWidth");
	var upperArm=document.getElementById("upperArm");
	var lowerArm=document.getElementById("lowerArm");
	var wrist=document.getElementById("wrist");
	var widthHip=document.getElementById("widthHip");
	var hipHeight=document.getElementById("hipHeight");
	var kneeHeight=document.getElementById("kneeHeight");
	var footHeight=document.getElementById("footHeight");//End of access


	if (inchOrMM=="inches")
	{
	height.innerHTML=number;
	shoudlerHeight.innerHTML= Math.round(number *0.818*100)/100;
	elbowHeight.innerHTML= Math.round(number * 0.63*100)/100;
	wristHeight.innerHTML=Math.round(number*0.485*100)/100;
	FingerHeight.innerHTML=Math.round(number*0.377*100)/100;
	chestWidth.innerHTML=Math.round(number*0.259*100)/100;
	upperArm.innerHTML=Math.round(number * 0.186*100)/100;
	lowerArm.innerHTML=Math.round(number * 0.146*100)/100;
	wrist.innerHTML= Math.round(number * 0.108*100)/100;
	widthHip.innerHTML= Math.round(number * 0.191*100)/100;
	hipHeight.innerHTML= Math.round(number * 0.530*100)/100;
	kneeHeight.innerHTML=Math.round(number * 0.285*100)/100;
	footHeight.innerHTML=Math.round(number * 0.039*100)/100;//End Calculation
	num=1;

	}

	else if(inchOrMM=="mm")
	{
	num=0;
	//Begin Calculation
	height.innerHTML=number;
	shoudlerHeight.innerHTML= Math.round(number *0.818*1)/1;
	elbowHeight.innerHTML= Math.round(number * 0.63*1)/1;
	wristHeight.innerHTML=Math.round(number*0.485*1)/1;
	FingerHeight.innerHTML=Math.round(number*0.377*1)/1;
	chestWidth.innerHTML=Math.round(number*0.259*1)/1;
	upperArm.innerHTML=Math.round(number * 0.186*1)/1;
	lowerArm.innerHTML=Math.round(number * 0.146*1)/1;
	wrist.innerHTML= Math.round(number * 0.108*1)/1;
	widthHip.innerHTML= Math.round(number * 0.191*1)/1;
	hipHeight.innerHTML= Math.round(number * 0.530*1)/1;
	kneeHeight.innerHTML=Math.round(number * 0.285*1)/1;
	footHeight.innerHTML=Math.round(number * 0.039*1)/1;//End Calculation
	}
}
function ConvertToMM()
{
	var inch=document.selector2.inch;
	var mm=document.selector2.mm;
	if(num==1)
	{
	var height=document.getElementById("height");//access height and other parameter Id's
	var shoudlerHeight=document.getElementById("shoudlerHeight");
	var elbowHeight=document.getElementById("elbowHeight");
	var wristHeight=document.getElementById("wristHeight");
	var FingerHeight=document.getElementById("FingerHeight");
	var chestWidth=document.getElementById("chestWidth");
	var upperArm=document.getElementById("upperArm");
	var lowerArm=document.getElementById("lowerArm");
	var wrist=document.getElementById("wrist");
	var widthHip=document.getElementById("widthHip");
	var hipHeight=document.getElementById("hipHeight");
	var kneeHeight=document.getElementById("kneeHeight");
	var footHeight=document.getElementById("footHeight");//End of access
	
	
	var number=document.selector3.size.value;//Begin Calculation
	number=number*25.4;
	document.selector3.size.value=number;
	height.innerHTML= number;
	shoudlerHeight.innerHTML= Math.round(number *0.543*1)/1;
	elbowHeight.innerHTML= Math.round(number * 0.56*1)/1;
	wristHeight.innerHTML=Math.round(number*0.43*1)/1;
	FingerHeight.innerHTML=Math.round(number*0.36*1)/1;
	chestWidth.innerHTML=Math.round(number*0.259*1)/1;
	upperArm.innerHTML=Math.round(number * 0.186*1)/1;
	lowerArm.innerHTML=Math.round(number * 0.146*1)/1;
	wrist.innerHTML= Math.round(number * 0.108*1)/1;
	widthHip.innerHTML= Math.round(number * 0.191*1)/1;
	hipHeight.innerHTML= Math.round(number * 0.530*1)/1;
	kneeHeight.innerHTML=Math.round(number * 0.285*1)/1;
	footHeight.innerHTML=Math.round(number * 0.039*1)/1;	
	num=0;
	}
}

function ConvertToInches()
{
	var inch=document.selector2.inch;
	var mm=document.selector2.mm;
	if(num==0)
	{
	var height=document.getElementById("height");//access height and other parameter Id's
	var shoudlerHeight=document.getElementById("shoudlerHeight");
	var elbowHeight=document.getElementById("elbowHeight");
	var wristHeight=document.getElementById("wristHeight");
	var FingerHeight=document.getElementById("FingerHeight");
	var chestWidth=document.getElementById("chestWidth");
	var upperArm=document.getElementById("upperArm");
	var lowerArm=document.getElementById("lowerArm");
	var wrist=document.getElementById("wrist");
	var widthHip=document.getElementById("widthHip");
	var hipHeight=document.getElementById("hipHeight");
	var kneeHeight=document.getElementById("kneeHeight");
	var footHeight=document.getElementById("footHeight");//End of access
	
	
	var number=document.selector3.size.value;//Begin Calculation
	number=number/25.4;
				document.selector3.size.value=number;
				height.innerHTML= number;
				shoudlerHeight.innerHTML= Math.round(number *0.543*100)/100;
				elbowHeight.innerHTML= Math.round(number * 0.56*100)/100;
				wristHeight.innerHTML=Math.round(number*0.43*100)/100;
				FingerHeight.innerHTML=Math.round(number*0.36*100)/100;
				chestWidth.innerHTML=Math.round(number*0.259*100)/100;
				upperArm.innerHTML=Math.round(number * 0.186*100)/100;
				lowerArm.innerHTML=Math.round(number * 0.146*100)/100;
				wrist.innerHTML= Math.round(number * 0.108*100)/100;
				widthHip.innerHTML= Math.round(number * 0.191*100)/100;
				hipHeight.innerHTML= Math.round(number * 0.530*100)/100;
				kneeHeight.innerHTML=Math.round(number * 0.285*100)/100;
				footHeight.innerHTML=Math.round(number * 0.039*100)/100;	
	num=1;
	}


}
function ConvertToInches1()
{
	var inch=document.selector4.inch;
	var mm=document.selector4.mm;
		if(inch.checked==true)
		{
		var height=document.getElementById("height");
		number =height.innerHTML;
		number=number/25.4;
		intervalID=Calculation1('inches',number);
		}
}
function ConvertToMM1()
{
var inch=document.selector4.inch;
	var mm=document.selector4.mm;
		if(mm.checked==true)
		{
		var height=document.getElementById("height");
		number =height.innerHTML;
		number=number*25.4;
		intervalID=Calculation1('mm',number);
		}
}

function Calculation()
{
	var inch=document.selector2.inch;
	var mm=document.selector2.mm;
	if(inch.checked==false && mm.checked==false)
		{
		alert("Select 'inches' or 'MM' ");
		}
	
	else if(inch.checked ==true)
		{
		var number=document.selector3.size.value;
		intervalID=Calculation1('inches',number);
		}
	else if( mm.checked == true)
		{
		var number=document.selector3.size.value;
		intervalID1=Calculation1('mm',number);
		}
	
}


function checkSelection()
{
var maleOrFemale=document.selector2.maleOrFemale.options;
var ansurORNhanes=document.selector1.ansurORNhanes.options;
var percentile=document.selector1.percentile.value;
var race=document.selector3.race.value;
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
		  

		 if(maleOrFemale[0].selected && ansurORNhanes[0].selected)
	{
		 
	 secondRow=document.getElementById("secondRowThirdColumn");
	secondRow.innerHTML="<form id='Selector3' name='selector3'><select name='race' id='Race' onchange='checkSelection()' disabled='disabled'><option value='All'>All Races</option><option value='Black'>Non-Hispanic Black</option><option value='White'>Non-Hispanic White</option><option value='Mexican'>Mexican American</option></select></form>";		
		
		  xhr.onreadystatechange = function()
		   { 
						
			 if(xhr.readyState == 4)
			 {
				if(xhr.status == 200)
				{ 
				  /*   document.ajax.dyn.value="Received:" + xhr.responseText;*/ 
		       var number = Number(xhr.responseText);
				var inch=document.selector4.inch;
				var mm=document.selector4.mm;
				if(inch.checked==false && mm.checked==false)
					{
					alert("Select 'inches' or 'MM' ");
					}
				
				else if(inch.checked ==true)
					{
					number=number/25.4;
					intervalID=Calculation1('inches',number);
					}
				else if( mm.checked == true)
					{
					
					intervalID1=Calculation1('mm',number);
					}
							
				} 
			   else 
				{ 
					 alert("clearly it is not working");
			   } 
			} 
		 }; 
 			var url="AnsurMale.php"+"?p=" + percentile;
			url=url+"&r="+race;
			var database="/sqlLiteDatabases/Male.sqlite";
			url=url+"&database1="+ database;
		 xhr.open("POST",url, true);                
		 xhr.send(null); 
		
				/*var url="test1.php";
				/*url=url+"?q="+percentile;
				url=url+"&sid="+Math.random();
				
				xmlhttp.open("POST",url,true);
				xmlhttp.send(null);
		return null;*/
	}
	
	 else if(maleOrFemale[1].selected && ansurORNhanes[0].selected)
	{
		 
	 secondRow=document.getElementById("secondRowThirdColumn");
	secondRow.innerHTML="<form id='Selector3' name='selector3'><select name='race' id='Race' onchange='checkSelection()' disabled='disabled'><option value='All'>All Races</option><option value='Black'>Non-Hispanic Black</option><option value='White'>Non-Hispanic White</option><option value='Mexican'>Mexican American</option></select></form>";		
		
		  xhr.onreadystatechange = function()
		   { 
						
			 if(xhr.readyState == 4)
			 {
				if(xhr.status == 200)
				{ 
				
				  /*   document.ajax.dyn.value="Received:" + xhr.responseText;*/ 
		       var number = Number(xhr.responseText);
			   //alert(xhr.responseText);
				var inch=document.selector4.inch;
				var mm=document.selector4.mm;
				if(inch.checked==false && mm.checked==false)
					{
					alert("Select 'inches' or 'MM' ");
					}
				
				else if(inch.checked ==true)
					{
					number=number/25.4;
					intervalID=Calculation1('inches',number);
					}
				else if( mm.checked == true)
					{
					
					intervalID1=Calculation1('mm',number);
					}
							
				} 
			   else 
				{ 
					 alert("clearly it is not working");
			   } 
			} 
		 }; 
		 	//alert(percentile);
 			var url="AnsurFemale.php"+"?p=" + percentile;
			url=url+"&r="+race;
			var database="/sqlLiteDatabases/Male.sqlite";
			url=url+"&database1="+ database;
			//alert(url);
		 xhr.open("POST",url, true);                
		 xhr.send(null); 
		
				/*var url="test1.php";
				/*url=url+"?q="+percentile;
				url=url+"&sid="+Math.random();
				
				xmlhttp.open("POST",url,true);
				xmlhttp.send(null);
		return null;*/
	}
	
	else if(maleOrFemale[0].selected && ansurORNhanes[1].selected)
	{
	
		
		  xhr.onreadystatechange = function()
		   { 
						
			 if(xhr.readyState == 4)
			 {
				if(xhr.status == 200)
				{ 
				  /*   document.ajax.dyn.value="Received:" + xhr.responseText;*/ 
		       var number = Number(xhr.responseText);
				var inch=document.selector4.inch;
				var mm=document.selector4.mm;
				if(inch.checked==false && mm.checked==false)
					{
					alert("Select 'inches' or 'MM' ");
					}
				
				else if(inch.checked ==true)
					{
					intervalID=Calculation1('inches',number);
					}
				else if( mm.checked == true)
					{
					number=number*25.4;
					intervalID1=Calculation1('mm',number);
					}
							
				} 
			   else 
				{ 
					 alert("clearly it is not working");
			   } 
			} 
		 }; 
 			var url="test.php"+"?p=" + percentile;
			url=url+"&r="+race;
			var database="/sqlLiteDatabases/Male.sqlite";
			url=url+"&database1="+ database;
		 xhr.open("POST",url, true);                
		 xhr.send(null); 
		
				/*var url="test1.php";
				/*url=url+"?q="+percentile;
				url=url+"&sid="+Math.random();
				
				xmlhttp.open("POST",url,true);
				xmlhttp.send(null);
		return null;*/
	}
	
	else if(maleOrFemale[1].selected && ansurORNhanes[1].selected)
		{
		
		  xhr.onreadystatechange = function()
		   { 
						
			 if(xhr.readyState == 4)
			 {
				if(xhr.status == 200)
				{ 
				  /*   document.ajax.dyn.value="Received:" + xhr.responseText;*/ 
		       var number = Number(xhr.responseText);
				var inch=document.selector4.inch;
				var mm=document.selector4.mm;

				if(inch.checked==false && mm.checked==false)
					{
					alert("Select 'inches' or 'MM' ");
					}
				
				else if(inch.checked ==true)
					{
					intervalID=Calculation1('inches',number);
					}
				else if( mm.checked == true)
					{
					number=number*25.4;
					intervalID1=Calculation1('mm',number);
					}
				
				} 
			   else 
				{ 
					 alert("clearly it is not working");
			   } 
			} 
		 }; 
 			var url="test1.php"+"?p=" + percentile;
			url=url+"&r="+race;
			var database="/sqlLiteDatabases/Male.sqlite";
			url=url+"&database1="+ database;
		 xhr.open("POST",url, true);                
		 xhr.send(null); 
		
		}

}
//-->

function SwitchFromAnsur()
{
	var ansurORNhanes=document.selector1.ansurORNhanes.options;

		if(ansurORNhanes[0].selected)
		{
				 secondRow=document.getElementById("secondRowThirdColumn");
	secondRow.innerHTML="<form id='Selector3' name='selector3'><select name='race' id='Race' onchange='checkSelection()' disabled='disabled'><option value='All'>All Races</option><option value='Black'>Non-Hispanic Black</option><option value='White'>Non-Hispanic White</option><option value='Mexican'>Mexican American</option></select></form>";		
		}
		
		else if(ansurORNhanes[1].selected)
		{
			secondRow=document.getElementById("secondRowThirdColumn");
	secondRow.innerHTML="<form id='Selector3' name='selector3'><select name='race' id='Race' onchange='checkSelection()'><option value='All'>All Races</option><option value='Black'>Non-Hispanic Black</option><option value='White'>Non-Hispanic White</option><option value='Mexican'>Mexican American</option></select></form>";
		}
}
