// JavaScript Document

function sortNumber(a,b) {
return a - b;
}

function median(data) {
var len = data.length;
var half = Math.round(len/2);
data.sort(sortNumber);
var median = data[half];
return median;
}

function spread(data,flag) {
//this function finds the greatest distance from the median
//flag == 0 for min, 1 for max
var spread = new Array();
if (flag==0){spread = median(data)-Math.min.apply(Math,data)}else{spread = Math.max.apply(Math,data)-median(data)};
return spread;
}


function mean(data) {
var deviation = new Array();
var sum = 0;
var devnsum = 0;
var stddevn = 0;
var len = data.length;
for (var i=0; i<len; i++) {
sum = sum + (data[i] * 1)  // ensure number
}
var mean = sum/len;  
return mean;
}

function stdev(data) {
var deviation = new Array();
var sum = 0;
var devnsum = 0;
var stddevn = 0;
var len = data.length;
for (var i=0; i<len; i++) {
sum = sum + (data[i] * 1)  // ensure number
}
var mean = (sum/len);  
for (i=0; i<len; i++) {
deviation[i] = data[i] - mean;
deviation[i] = deviation[i] * deviation[i];
devnsum = devnsum + deviation[i];
}
stddevn = Math.sqrt(devnsum/(len-1));  
return stddevn;
}

