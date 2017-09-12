// JavaScript Document
function QuerryDatabase(gender,fileToQuerry,percentage,tableToQuerry)
{
	var x=45;
this.weight=0;
this.percentileUpOption=document.selector2.percentileUp.options;
this.percentileLow=document.selector2.percentileLow.value;
this.race=document.selector3.race.value;
/*this.percentileUp=document.selector2.percentileUp.value;
this.inchOrMM=document.selector4.inchesOrMM.options; */
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
					x =xhr.responseText;
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
		url=url+"&r="+this.race;
		url=url+"&t=" + tableToQuerry;
		var database="/sqlLiteDatabases/Male.sqlite";
		url=url+"&database1="+ database;
		 xhr.open("POST",url, true);                
		 xhr.send(null);  
 this.weight=x;
}