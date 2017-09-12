/*
/************************************************************************Future Debugging Help******************************************************************************

Note: BoundaryRatio.js transfer data to the BoundaryRatio1.php file and not BoundaryRatio.php. While BoundaryRatio1.js transfer data to the BoundaryRatio.php file. 
	  
	  The select names for the form tag do not follow a chronological order as some of them were created on the fly using event handlers.
	  
	  Disregard all HTML objects in TableContainer1, and TableContainer two div tags. These containers were edited on the fly using Javascript, Refer to Javascript code for actual HTML content in 			      the containers.
	  
	  Unit Conversions were done in Javascript

/**********************************************************************Information about this file***************************************************************************
This Javascript File controls all the interaction between the user and the application while ANSUR or NHANES are selected. For the stature mode refer to the boundaryRatio.js file. Embedded in this file (accessDatabese1 function) is code which allows parameters to be sent to the BoundaryRatio.php file via Ajax objects. Unlike the previous javascript file, This file interacts with two other php files to retreive the corresponding Ansur or Nhanes dimension as specified by the user. Nevertheless, the access Database1 function() is the heart of the program as it compiles all the data retreived from each PHP file and sends it to one PHP file which does the calclulation and send back the result.  The other Functions in this script handles the aesthetics, and unit conversions of the web page while in Stature mode.

Below are the function with Ajax Objects embedded into them:
function accessDatabase1(maleOrFemale,Inches,Lbs1,upper,lower,weightLowpounds,weightUppounds)
function getUpperWeight(gender,fileToQuerry, percentileUp,tableToQuerry)
function getLowerWeight(gender,fileToQuerry,percentage,tableToQuerry)
function GetStatureLower(gender,fileToQuerry)
function GetStature(gender,fileToQuerry)

Below are the functions that handle the aesthetics, of the website:
function checkSelection1()
function SwitchParameter
*/
var UpperNumber=0;
var LowerNumber=0;
var weightUp=0;
var weightLow=0;


function accessDatabase1(maleOrFemale,Inches,Lbs1,upper,lower,weightLowpounds,weightUppounds)// This function compiles all the data received from previous databases and sends it to the Boundary1.php file
{
/*Below are the data passed to the PHP file
 selected gender value(maleOrFemale)
 Retreived upper Inch variable(Inches)
 Retreived lower Inch variable(Lbs1)
 Retreived upper weight variable(weightUppounds)
 Retreived lower weight variable(weightLowpounds)
 Selected Upper percentile(uppper)
 Selected Lower percentile(Lower)
 selected unit(inchOrMm1)
 Php file(BoundaryRatio1.php)
 
*/
var dimensionSelected=document.selector1.dimension;
var x=dimensionSelected.value;

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
				  
				var displayValue1=document.selector1.dimension.options;
						if(displayValue1[0].selected)
						{
						document.getElementById("ADigit").innerHTML=xhr.responseText;
						document.getElementById("A").style.visibility="visible";
						}
						else if(displayValue1[1].selected)
						{
						document.getElementById("BDigit").innerHTML=xhr.responseText;
						document.getElementById("BLow").style.height="97px";
						}
						else if(displayValue1[2].selected)
						{
						document.getElementById("CDigit").innerHTML=xhr.responseText;
						document.getElementById("CTop").style.height="40px";
						}
						else if(displayValue1[3].selected)
						{
						document.getElementById("DDigit").innerHTML=xhr.responseText;
						document.getElementById("DTop").style.height="3px";
						}
						else if(displayValue1[4].selected)
						{
						document.getElementById("EDigit").innerHTML=xhr.responseText;
						document.getElementById("ETop").style.height="4px";
						document.getElementById("ELow").style.height="4px";
						}
						else if(displayValue1[5].selected)
						{
						document.getElementById("FTop").style.height="6px";
						document.getElementById("FLow").style.height="6px";
						document.getElementById("FDigit").innerHTML=xhr.responseText;
						}
						else if(displayValue1[6].selected)
						{
						document.getElementById("GTop").style.height="30px";
						document.getElementById("GLow").style.height="20px";
						document.getElementById("GDigit").innerHTML=xhr.responseText;
						}
						else if(displayValue1[7].selected)
						{
						document.getElementById("HDigit").innerHTML=xhr.responseText;
						document.getElementById("HTop").style.height="33px";
						document.getElementById("HLow").style.height="33px";
						}
						else if(displayValue1[8].selected)
						{
						document.getElementById("IDigit").innerHTML=xhr.responseText;
						document.getElementById("ILeft").style.height="25px";
						document.getElementById("IRight").style.height="25px";
						document.getElementById("ILeft").style.width="27px";
						document.getElementById("IRight").style.width="40px";
						document.getElementById("IDigit").style.paddingLeft=0;
						document.getElementById("IDigit").style.paddingRight=0;
						}
						else if(displayValue1[9].selected)
						{
						document.getElementById("JDigit").innerHTML=xhr.responseText;
						document.getElementById("JTop").style.height="50px";
						document.getElementById("JLow").style.height="70px";
						}
						else if(displayValue1[10].selected)
						{
						document.getElementById("KDigit").innerHTML=xhr.responseText;
						document.getElementById("KTop").style.height="65px";
						document.getElementById("KLow").style.height="100px";
						}
						else if(displayValue1[11].selected)
						{
						document.getElementById("LDigit").innerHTML=xhr.responseText;
						document.getElementById("LTop").style.height="95px";
						}
						else if(displayValue1[12].selected)
						{
						document.getElementById("tableContainer2").style.top="80px";
						document.getElementById("tableContainer2").style.visibility="visible";
						document.getElementById("tableContainer2").innerHTML=xhr.responseText;
						
						}
						else if(displayValue1[13].selected)
						{
						document.getElementById("tableContainer2").style.top="80px";
						document.getElementById("tableContainer2").style.visibility="visible";
						document.getElementById("tableContainer2").innerHTML=xhr.responseText;
						}
						else if(displayValue1[14].selected)
						{
						document.getElementById("tableContainer2").style.top="80px";
						document.getElementById("tableContainer2").style.visibility="visible";
						document.getElementById("tableContainer2").innerHTML=xhr.responseText;
						}
						else if(displayValue1[15].selected)
						{
						document.getElementById("tableContainer2").style.top="80px";
						document.getElementById("tableContainer2").style.visibility="visible";
						document.getElementById("tableContainer2").innerHTML=xhr.responseText;
						}
						else if(displayValue1[16].selected)
						{
						document.getElementById("tableContainer2").style.top="80px";
						document.getElementById("tableContainer2").style.visibility="visible";
						document.getElementById("tableContainer2").innerHTML=xhr.responseText;
						}
						else if(displayValue1[17].selected)
						{
						document.getElementById("tableContainer2").style.top="80px";
						document.getElementById("tableContainer2").style.visibility="visible";
						document.getElementById("tableContainer2").innerHTML=xhr.responseText;
						}
					}
			  }
		   };
		   
	var inchOrMm1;
	var dimension=document.selector4.inchesOrMM.options;
	if(dimension[0].selected)
	{
	 inchOrMm1="inchOrLbs";
	}
	else if(dimension[1].selected)
	{
	inchOrMm1="MmOrKg";
	}

	var url="BoundaryRatio1.php"+"?m=" + maleOrFemale;
	url=url+"&d="+x;
	url=url+"&u="+upper;
	url=url+"&l="+lower;
	url=url+"&p="+Lbs1;
	url=url+"&i="+Inches;
	url=url+"&F="+inchOrMm1;
	url=url+"&WL="+weightLowpounds;
	url=url+"&WU="+weightUppounds;
	url+"&sid="+Math.random();
	xhr.open("POST",url, true);
	xhr.send(null); 
	//alert(url);
	
}
function getUpperWeight(gender,fileToQuerry, percentileUp,tableToQuerry)//This function retreives the upperweight from the selected database
{
/* Below are the data passed to the PHP file 
   Selected gender(gender)
   Selected race(race)
   Selected Table to querry(tableToQuerry)... what type of Ansur or Nhanes table to querry
   Selected upper precentile(percentileUp)
   PHP file to open(fileToQuerry) 
   
*/
var inchOrMM=document.selector4.inchesOrMM.options;
var percentileLow=document.selector2.percentileLow.value;
var percentileUp=document.selector2.percentileUp.value;
percentileUpOption=document.selector2.percentileUp.options;
//percentileUp=document.selector2.percentileUp.value;
race=document.selector3.race.value;

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
					var ansurOrNhanesOrStature=document.selector.statureOrParameter.options;
					
					 if(xhr.readyState == 4)
					 {
						if(xhr.status == 200)
						{ 
							
							weightUp =xhr.responseText;
							weightUp=Number(weightUp);
							
							
					  		if(inchOrMM[1].selected && fileToQuerry=="Ansur")
							{
							weightLowpounds=weightLow;
							weightUppounds=weightUp;
							}
							
							else if(inchOrMM[0].selected && fileToQuerry=="Ansur")
							{
								weightLowpounds=weightLow*2.2;
								weightUppounds=weightUp*2.2;
							}
							
							else if(inchOrMM[0].selected && fileToQuerry=="Nhanes")
							{
							weightLowpounds=weightLow;
							weightUppounds=weightUp;
							}
							else if(inchOrMM[1].selected && fileToQuerry=="Nhanes")
							{
								weightLowpounds=weightLow/2.2;
								weightUppounds=weightUp/2.2;
							}
							//alert(weightLowpounds +" "+ weightUppounds);
							percentileLow=parseInt(percentileLow);
							percentileLow=Number(percentileLow);
							percentileUp=parseInt(percentileUp);
							percentileUp=Number(percentileUp);		
							var xy=accessDatabase1(gender,UpperNumber,LowerNumber,percentileUp,percentileLow,weightLowpounds,weightUppounds);	 
						} 
					   else 
						{ 
							 alert("clearly it is not working");
					   } 
					} 
				 };
		var url=fileToQuerry+"Male"+"Weight.php";
		 url=url+"?p=" +percentileUp;
		url=url+"&r="+race;
		url=url+"&t=" + tableToQuerry;
		var database="/sqlLiteDatabases/Male.sqlite";
		url=url+"&database1="+ database;
		 xhr.open("POST",url, true);                
		 xhr.send(null);  
		

//xy=accessDatabase1(gender,UpperNumber,LowerNumber,percentileUp,percentileLow,weightLowpounds,weightUppounds);


}

function getLowerWeight(gender,fileToQuerry,percentage,tableToQuerry)//This function retreives the lower weight from the selected database
{
	/* Below are the data passed to the PHP file 
   Selected gender(gender)
   Selected race(race)
   Selected Table to querry(tableToQuerry)... what type of Ansur or Nhanes table to querry
   Selected lower precentile(percentileLow)
   PHP file to open(fileToQuerry) 
   
*/

percentileUpOption=document.selector2.percentileUp.options;
var percentileUp=document.selector2.percentileUp.value;
race=document.selector3.race.value;
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
					var ansurOrNhanesOrStature=document.selector.statureOrParameter.options;
					
					 if(xhr.readyState == 4)
					 {
						if(xhr.status == 200)
						{ 
						
							weightLow =xhr.responseText;
							weightLow=Number(weightLow);
									
							 var result1 =getUpperWeight(gender,fileToQuerry, percentileUp,tableToQuerry);
						
							//alert(x);
					/*   LowerNumber = Number(xhr.responseText);*/
							 
						} 
					   else 
						{ 
							 alert("clearly it is not working");
					   } 
					} 
				 };
		var url=fileToQuerry+"Male"+"Weight.php";
		 url=url+"?p=" + percentage;
		url=url+"&r="+race;
		url=url+"&t=" + tableToQuerry;
		var database="/sqlLiteDatabases/Male.sqlite";
		url=url+"&database1="+ database;
		 xhr.open("POST",url, true);                
		 xhr.send(null);  

}

function GetStatureLower(gender,fileToQuerry)//This function retreives the lower stature from the selected database
{
/* Below are the data passed to the PHP file 
   Selected gender(gender)
   Selected race(race)
   Selected Table to querry(tableToQuerry)... what type of Ansur or Nhanes table to querry
   Selected lower precentile(percentileLow)
   PHP file to open(fileToQuerry) 
   
*/
var percentileUpOption=document.selector2.percentileUp.options;
var percentileLow=document.selector2.percentileLow.value;
var race=document.selector3.race.value;
var percentileUp=document.selector2.percentileUp.value;
var inchOrMM=document.selector4.inchesOrMM.options;
	
	 if(percentileUpOption[0].selected)
	{
	}

 	else 
 	{
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
		   
			var ansurOrNhanesOrStature=document.selector.statureOrParameter.options;
			var chosenheight=document.selector1.dimension.options;
			 if(xhr.readyState == 4)
			 {
				
				 
				if(xhr.status == 200)
				{
				 
		       		LowerNumber = Number(xhr.responseText);
					 
					  if(ansurOrNhanesOrStature[1].selected)
					  {
					   UpperNumber=UpperNumber/25.4;
					   LowerNumber=LowerNumber/25.4;
					   }
					   else
					   {
					   }
					  
					  	if(inchOrMM[0].selected)
						{
						
						}
						else if(inchOrMM[1].selected)
						{
						 UpperNumber=UpperNumber*25.4;
					  	 LowerNumber=LowerNumber*25.4;
					     }
						 
						 if(chosenheight[14].selected || chosenheight[15].selected || chosenheight[16].selected || chosenheight[17].selected)
						 {	
						 	
								if(ansurOrNhanesOrStature[1].selected)
							  	{
							
								var tableToQuerry1="AnsurWeight"+gender;
								 var result1 =getLowerWeight(gender,"Ansur", percentileLow,tableToQuerry1);
								}
						
								else if(ansurOrNhanesOrStature[2].selected)
								{
							   	tableToQuerry1="NhanesWeight"+gender;
								  result1 =getLowerWeight(gender,"Nhanes", percentileLow,tableToQuerry1);
								}
						}
						else
						{
						weightLowpounds=0;
						weightUppounds=0;
						
						
						 percentileLow=parseInt(percentileLow);
						percentileLow=Number(percentileLow);
						percentileUp=parseInt(percentileUp);
						percentileUp=Number(percentileUp);
						
						
				     	 var xy=accessDatabase1(gender,UpperNumber,LowerNumber,percentileUp,percentileLow,weightLowpounds,weightUppounds);
						}
				} 
			   else 
				{ 
					 alert("clearly it is not working");
			   } 
			} 
		 }; 
 			var url=fileToQuerry+gender+".php";
			url=url+"?p=" + percentileLow;
			url=url+"&r="+race;
			var database="/sqlLiteDatabases/Male.sqlite";	
			url=url+"&database1="+ database;	
			 xhr.open("POST",url, true);                
			 xhr.send(null);  

	}
}
function GetStature(gender,fileToQuerry)//This function retreives the upper stature from the selected database
{
	/* Below are the data passed to the PHP file 
   Selected gender(gender)
   Selected race(race)
   Selected Table to querry(tableToQuerry)... what type of Ansur or Nhanes table to querry
   Selected lower precentile(percentileLow)
   PHP file to open(fileToQuerry) 
   
*/

var percentileUpOption=document.selector2.percentileUp.options;
var percentileUp=document.selector2.percentileUp.value;
var race=document.selector3.race.value;
 
	 if(percentileUpOption[0].selected)
	{
	}

 	else 
 	{
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
				  
		       UpperNumber = Number(xhr.responseText);
			   
				var xy=	GetStatureLower(gender,fileToQuerry);
				} 
			   else 
				{ 
					 alert("clearly it is not working");
			   } 
			} 
		 }; 
 			var url=fileToQuerry+gender+".php";
			url=url+"?p=" + percentileUp;
			url=url+"&r="+race;
			var database="/sqlLiteDatabases/Male.sqlite";
			
			url=url+"&database1="+ database;

		 xhr.open("POST",url, true);                
		 xhr.send(null);  
		 
	}
}

function CheckGender()//This handles the integer conversions from mm to inches or lbs to kilogram.
{	
	var gender=document.selector2.maleOrFemale.options;
	var NhanesOrAnsur=document.selector.statureOrParameter.options;

		if(gender[0].selected &&  NhanesOrAnsur[1].selected)
		{
	
			var xy=GetStature("Male","Ansur");	
		}
		else if(gender[1].selected &&  NhanesOrAnsur[1].selected)
		{
			 
			 xy=GetStature("Female","Ansur");	
		}
		
		else if(gender[0].selected &&  NhanesOrAnsur[2].selected)
		{     
			
			 xy=GetStature("Male","Nhanes");
		}
		
		else if(gender[1].selected &&  NhanesOrAnsur[2].selected)
		{
			 xy=GetStature("Female","Nhanes");
		}
	
}

/*****************************************************************************DUPLICATE CHECK SELECTION FUNCTION************************************************************************/
function checkSelection1()
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
		document.getElementById("ADigit").innerHTML="A";
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
		document.getElementById("BDigit").innerHTML="B";
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
		document.getElementById("CDigit").innerHTML="C";
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
		document.getElementById("DDigit").innerHTML="D";
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
		document.getElementById("EDigit").innerHTML="E";
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
		document.getElementById("FDigit").innerHTML="F";
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
		document.getElementById("GDigit").innerHTML="G";
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
		document.getElementById("HDigit").innerHTML="H";
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
		document.getElementById("IDigit").innerHTML="I";
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
		document.getElementById("JDigit").innerHTML="J";
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
		document.getElementById("KDigit").innerHTML="K";
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
		document.getElementById("LDigit").innerHTML="L";
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
var sendToAccessDatabase= CheckGender()
}


function SwitchParameter()//Switches input Parameters
{
var ansurOrNhanesOrStature=document.selector.statureOrParameter.options;

	if(ansurOrNhanesOrStature[0].selected)
	{
	var secondTable=document.getElementById("tableContainer1");
	secondTable.innerHTML="<form id='Selector' name='selector2'><table><tr><td><select name='maleOrFemale' onchange='checkStatus()'><option>Male</option><option>Female</option></select></td><td colspan='2'><select name='inchesOrMM' onchange='convertToMM(),Conversion()'><option>inches/lbs</option><option>MM/kg</option></select></td><td>Percentile</td></tr><tr><td><span class='rightPadding'></span></td><td><span class='rightPadding'><input name='inches' type='text' size='4' value='inches' onclick='clearInput(\"inches\")' onblur='insertValue(\"inches\")'  class='defaultInputColor' id='Inches' onkeyup='checkStatus(),changeColor(\"Inches\")' onchange='checkStatus()'  style='border:groove'/></span></td><td><input name='lbs' type='text' size='4'  value='lbs'  onclick='clearInput(\"lbs\")' onblur='insertValue(\"lbs\")'  class='defaultInputColor' id='Pounds' onkeyup='checkStatus(),changeColor(\"Pounds\")' onchange='checkStatus()' style='border:groove' /></td><td><input name='upper1' type='text' size='4' value='upper' onclick='clearInput(\"upper1\")' onblur='insertValue(\"upper1\")'  class='defaultInputColor' id='upper' onkeyup='checkStatus(),changeColor(\"upper\")' onchange='checkStatus()' style='background-color:#000000; border-color:#6F8498; border-color:#FADFB9; border:groove; color:#FFFFFF' /></td></tr><tr><td><span class='rightPadding'></span></td><td><span class='rightPadding'><input name='inches1' type='text' size='4' value='inches' onclick='clearInput(\"inches1\")' onblur='insertValue(\"inches\")'  class='defaultInputColor' id='Inches1' onkeyup='checkStatus(),changeColor(\"Inches1\")' onchange='checkStatus()'  style='border:groove'/></span></td><td><input name='lbs1' type='text' size='4'  value='lbs'  onclick='clearInput(\"lbs1\")' onblur='insertValue(\"lbs\")'  class='defaultInputColor' id='Pounds1' onkeyup='checkStatus(),changeColor(\"Pounds1\")' onchange='checkStatus()' style='border:groove'/></td><td><input name='lower1' type='text' size='4'  value='lower' onclick='clearInput(\"lower1\")' onblur='insertValue(\"lower1\")'  class='defaultInputColor' id='lower' onkeyup='checkStatus(),changeColor(\"lower\")' onchange='checkStatus()' style='background-color:#FFFFFF; border-color:#FADFB9; border:groove; color:#000000'/></td></tr></table></form>";
	
	firstTableBoundaryRatio=document.getElementById("BoundaryRatios");
	firstTableBoundaryRatio.innerHTML="<form id='Selector1' name='selector1'><span style='padding-right:5px'><select name='dimension' id='Percentile' onchange='checkSelection()'><option value='acromialHt'>A acromial ht</option><option value='trochanterionHt'>B trochanterion ht</option><option value='latFemoralEpicondyleHt'>C lat Femoral Epicondyle Ht</option><option value='latMalleolusHt'>D lat Malleolus Ht</option><option value='handIn'>E Hand In</option><option value='radialeStylonLn'>F radiale-Stylon Ln</option><option value='acromionRadialeln'>G acromion-radiale ln</option><option value='popLitealHt'>H pop liteal ht</option><option value='buttockPoplitealLn'>I buttock-popliteal ln</option><option value='acromialHtSit'>J acromial ht, sit</option><option value='eyeHtSit'>k eye ht, sit</option> <option value='sittingHt'>L sittingHt</option><option value='thumbTipReach'>* Thumbtip reach</option><option value='biacromialBdh'>* biacromial bdh</option><option value='bideltoidBdh'>*+ bideltoid bdh</option><option value='hipBdhSit'>*+ hip-bdh, sit</option><option value='waistBdh'>*+ waist bdh</option><option value='waistCirc'>*+ waist circ</option></select></form>";
	var firstTablerelocateInchesOrMM=document.getElementById("relocateInchesOrMM");
	firstTablerelocateInchesOrMM.innerHTML=" ";
	firstTablerelocateInchesOrMM=document.getElementById("newRace");
	firstTablerelocateInchesOrMM.innerHTML=" ";
	var zy=checkSelection();
	}
	
	else if(ansurOrNhanesOrStature[1].selected)
	{
	 secondTable=document.getElementById("tableContainer1");
	secondTable.innerHTML="<form id='Selector1' name='selector2'><table><tr><td><select name='maleOrFemale' onchange='CheckGender()'><option>Male</option><option>Female</option></select></td><td colspan='2' style='padding-left:4.5px'><select name='percentileUp' id='Percentile' onchange='CheckGender()' style='background-color:#000000; color:#FFFFFF'><option>Upper Percentile</option><option value='95th'>95th Percentile</option><option value='90th'>90th Percentile</option><option value='85th'>85th Percentile</option><option value='75th'>75th Percentile</option><option value='50th'>50th Percentile</option></select></td></tr><tr><td><td colspan='2'><select name='percentileLow' id='Percentile1' onchange='CheckGender()' style='background-color:#FFFFFF; color:#000000'><option>Lower Percentile</option><option value='5th'>5th Percentile</option><option value='10th'>10th Percentile</option><option value='15th'>15th Percentile</option><option value='25th'>25th Percentile</option><option value='50th'>50th Percentile</option></select></td></tr></table></form>";
	
	firstTableBoundaryRatio=document.getElementById("BoundaryRatios");
	firstTableBoundaryRatio.innerHTML="<form id='Selector1' name='selector1'><span style='padding-right:5px'><select name='dimension' id='Percentile' onchange='checkSelection1()'><option value='acromialHt'>A acromial ht</option><option value='trochanterionHt'>B trochanterion ht</option><option value='latFemoralEpicondyleHt'>C lat Femoral Epicondyle Ht</option><option value='latMalleolusHt'>D lat Malleolus Ht</option><option value='handIn'>E Hand In</option><option value='radialeStylonLn'>F radiale-Stylon Ln</option><option value='acromionRadialeln'>G acromion-radiale ln</option><option value='popLitealHt'>H pop liteal ht</option><option value='buttockPoplitealLn'>I buttock-popliteal ln</option><option value='acromialHtSit'>J acromial ht, sit</option><option value='eyeHtSit'>k eye ht, sit</option> <option value='sittingHt'>L sittingHt</option><option value='thumbTipReach'>* Thumbtip reach</option><option value='biacromialBdh'>* biacromial bdh</option><option value='bideltoidBdh'>*+ bideltoid bdh</option><option value='hipBdhSit'>*+ hip-bdh, sit</option><option value='waistBdh'>*+ waist bdh</option><option value='waistCirc'>*+ waist circ</option></select></form>";
	
	 firstTablerelocateInchesOrMM=document.getElementById("relocateInchesOrMM");
	firstTablerelocateInchesOrMM.innerHTML="<form id='Selector' name='selector4'><select name='inchesOrMM' onchange='CheckGender()'><option>inches/lbs</option><option>MM/kg</option></select></form>";
	firstTablerelocateInchesOrMM=document.getElementById("newRace");
	firstTablerelocateInchesOrMM.innerHTML="<form id='Selecto1r' name='selector3'><select name='race' id='Race' onchange='checkSelection()' disabled='disabled'><option value='All'>All Races</option><option value='Black'>Non-Hispanic Black</option><option value='White'>Non-Hispanic White</option><option value='Mexican'>Mexican American</option></select></form>";
	var xy=checkSelection1();
	}
	else if(ansurOrNhanesOrStature[2].selected)
	{
	  secondTable=document.getElementById("tableContainer1");
	secondTable.innerHTML="<form id='Selector1' name='selector2'><table><tr><td><select name='maleOrFemale' onchange='CheckGender()'><option>Male</option><option>Female</option></select></td><td colspan='2' style='padding-left:4.5px'><select name='percentileUp' id='Percentile' onchange='CheckGender()' style='background-color:#000000; color:#FFFFFF'><option>Upper Percentile</option><option value='95th'>95th Percentile</option><option value='90th'>90th Percentile</option><option value='85th'>85th Percentile</option><option value='75th'>75th Percentile</option><option value='50th'>50th Percentile</option></select></td></tr><tr><td><td colspan='2'><select name='percentileLow' id='Percentile1' onchange='CheckGender()' style='background-color:#FFFFFF; color:#000000'><option>Lower Percentile</option><option value='5th'>5th Percentile</option><option value='10th'>10th Percentile</option><option value='15th'>15th Percentile</option><option value='25th'>25th Percentile</option><option value='50th'>50th Percentile</option></select></td></tr></table></form>";
	
	firstTableBoundaryRatio=document.getElementById("BoundaryRatios");
	firstTableBoundaryRatio.innerHTML="<form id='Selector1' name='selector1'><span style='padding-right:5px'><select name='dimension' id='Percentile' onchange='checkSelection1()'><option value='acromialHt'>A acromial ht</option><option value='trochanterionHt'>B trochanterion ht</option><option value='latFemoralEpicondyleHt'>C lat Femoral Epicondyle Ht</option><option value='latMalleolusHt'>D lat Malleolus Ht</option><option value='handIn'>E Hand In</option><option value='radialeStylonLn'>F radiale-Stylon Ln</option><option value='acromionRadialeln'>G acromion-radiale ln</option><option value='popLitealHt'>H pop liteal ht</option><option value='buttockPoplitealLn'>I buttock-popliteal ln</option><option value='acromialHtSit'>J acromial ht, sit</option><option value='eyeHtSit'>k eye ht, sit</option> <option value='sittingHt'>L sittingHt</option><option value='thumbTipReach'>* Thumbtip reach</option><option value='biacromialBdh'>* biacromial bdh</option><option value='bideltoidBdh'>*+ bideltoid bdh</option><option value='hipBdhSit'>*+ hip-bdh, sit</option><option value='waistBdh'>*+ waist bdh</option><option value='waistCirc'>*+ waist circ</option></select></form>";
	
	  firstTablerelocateInchesOrMM=document.getElementById("relocateInchesOrMM");
	firstTablerelocateInchesOrMM.innerHTML="<form id='Selector' name='selector4'><select name='inchesOrMM' onchange='CheckGender()'><option>inches/lbs</option><option>MM/kg</option></select></form>";
	
	 firstTablerelocateInchesOrMM=document.getElementById("newRace");
	firstTablerelocateInchesOrMM.innerHTML="<form id='Selector' name='selector3'><select name='race' id='Race' onchange='CheckGender()'><option value='All'>All Races</option><option value='Black'>Non-Hispanic Black</option><option value='White'>Non-Hispanic White</option><option value='Mexican'>Mexican American</option></select></form>";
	
	var zy=checkSelection1();

	}

}

