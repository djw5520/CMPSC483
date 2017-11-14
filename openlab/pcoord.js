function drawPcoord(selectedMeasures) {

	var margin = {top: 30, right: 10, bottom: 10, left: 10},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

	var x = d3.scale.ordinal().rangePoints([0, width], 1),
    y = {},
    dragging = {};

	var line = d3.svg.line(),
    axis = d3.svg.axis().orient("left"),
    background,
    foreground;

	let accom_percent = [];

  	let arr = generateLines(); 

    d3.select("#pcoord").select("svg").remove(); 
    d3.select("#pcoord").append("svg");
	var svg = d3.select("#pcoord").select("svg").attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom + 100).append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

  	// Extract the list of dimensions and create a scale for each.
  	x.domain(dimensions = selectedMeasures.filter(function(d) {

    	return d != "sum" && (y[d] = d3.scale.linear()
        .domain(d3.extent(rawData[d], function(p) {
        		if(p === "") return null; else return +p; 
        }))
        .range([height, 0]));
  	})); 

	// Add grey background lines for context.
  	background = svg.append("g")
  		.attr("class", "background")
  		.selectAll("path")
  		.data(arr)
  		.enter().append("path")
  		.attr("d", path);
	
	// Add blue foreground lines for focus.
  	foreground = svg.append("g")
  		.attr("class", "foreground")
  		.selectAll("path")
  		.data(arr)
  		.enter().append("path").attr("d",path);

	// Add a group element for each dimension.
  	var g = svg.selectAll(".dimension")
  		.data(dimensions)
  		.enter().append("g")
  		.attr("class", "dimension")
  		.attr("transform", function(d) { 
  			return "translate(" + x(d) + ")"; 
  		})
  		.call(d3.behavior.drag()
        	.origin(function(d) { 
        		return {x: x(d)}; 
        	})
        	.on("dragstart", function(d) {
				dragging[d] = x(d);
				background.attr("visibility", "hidden");
        	})
        	.on("drag", function(d) {
				dragging[d] = Math.min(width, Math.max(0, d3.event.x));
				foreground.attr("d", path);
				dimensions.sort(function(a, b) { 
					return position(a) - position(b); 
				});
				x.domain(dimensions);
				g.attr("transform", function(d) { 
					return "translate(" + position(d) + ")"; 
				})
        	})
	        .on("dragend", function(d) {
				delete dragging[d];
				transition(d3.select(this)).attr("transform", "translate(" + x(d) + ")");
				transition(foreground).attr("d", path);
				background
	            	.attr("d", path)
	            	.transition()
	            	.delay(500)
	            	.duration(0)
            		.attr("visibility", null);
	        }));

	// Add an axis and title.
	g.append("g")
		.attr("class", "axis")
		.each(function(d) { 
			d3.select(this).call(axis.scale(y[d])); 
		})
		.append("text")
		.style("text-anchor", "middle")
		.attr("y", -9)
		.attr("font-size", "1.3em")
		.text(function(d) { 
			return d; 
		});

  	// Add and store a brush for each axis.
  	g.append("g")
		.attr("class", "brush")
		.each(function(d) {
			d3.select(this).call(y[d].brush = d3.svg.brush().y(y[d]).on("brushstart", brushstart).on("brush", brush));
		})
    	.selectAll("rect")
      	.attr("x", -8)
      	.attr("width", 16);
	
	// Displays domain of each axis
	g.append("g")
		.attr("class", "axis")
		.each(function(p) { 
			d3.select(this).call(axis.scale(y[p]));
		})
		.append("text")
		.style("text-anchor", "middle")
		.attr("y", 500)
		.attr("id", "range")
		.attr("font-size", "1.0em")
		.attr("font-weight", "bold")
		.text(function(p) { 
			return "Range: (" + y[p].domain()[0] + "  ,  " + y[p].domain()[1] + ")";
		});

	// Display initial accommodation percent
	g.append("g")
		.attr("class", "axis")
		.each(function(p) { 
			d3.select(this).call(axis.scale(y[p]));
		})
		.append("text")
		.style("text-anchor", "middle")
		.attr("y", 520)
		.attr("id", "accom")
		.attr("font-size", "1.0em")
		.attr("font-weight", "bold")
		.text(function(p) { 
			return "Accommodation: 100%";
		});

    // Function used to manipulate rawData so it can be used to populate the plot
	function generateLines() { 
  			let obj = {};
  			let arr = [];
  			for(let i = 0; i < rawData[selectedMeasures[0]].length; i++) { 
  				arr[i] = {}; 
  				for(let j = 0; j < selectedMeasures.length; j++) {
  					arr[i][selectedMeasures[j]] = rawData[selectedMeasures[j]][i];
  				}
  			}
  			
  			return arr; 
  	}
	function position(d) {
  		var v = dragging[d];
  		return v == null ? x(d) : v;
	}

	function transition(g) {
  		return g.transition().duration(500);
	}

	// Returns the path for a given data point.
	function path(d) {

  		return line(dimensions.map(function(p) { return [position(p), y[p](d[p])]; }));
	}

	function brushstart() {
  		d3.event.sourceEvent.stopPropagation();
	}

	// Handles a brush event, toggling the display of foreground lines.
	// Displays the limits of the scrubber for each axis, full domain if no brush is present
	function brush() {
  		var actives = dimensions.filter(function(p) { return !y[p].brush.empty(); }),
      		extents = actives.map(function(p) {  return y[p].brush.extent(); });

      	let min_accom = Math.min.apply(null, accom_percent);
      	
      	g.select("#range").remove();
      	g.select("#accom").remove();

      	g.append("g")
		.attr("class", "axis")
		.each(function(p) { 
			d3.select(this).call(axis.scale(y[p]));
		})
		.append("text")
		.style("text-anchor", "middle")
		.attr("y", 500)
		.attr("id", "range")
		.attr("font-size", "1.0em")
		.attr("font-weight", "bold")
		.text(function(p) { 
			if(y[p].brush.empty()) {
				return "Range: (" + y[p].domain()[0] + "  ,  " + y[p].domain()[1] + ")";
			} 
			else {
				return "Range: (" + y[p].brush.extent()[0].toFixed(1) + "  ,  " + y[p].brush.extent()[1].toFixed(1) + ")";
			}	
		});

		g.append("text")
		.text(function(p) { 
			if(y[p].brush.empty()) {
				accom_percent[p] = 100;
				return "Accommodation: 100%";
			}
			else {
				let lowbound = y[p].brush.extent()[0].toFixed(1);
				let highbound = y[p].brush.extent()[1].toFixed(1);
				let count = 0;
				rawData[p].forEach(function(el) {
					if(el >= lowbound && el <= highbound){
						count++;
					}
				});
				accom_percent[p] = ((count/rawData[p].length)*100);
				return "Accommodation: " + accom_percent[p].toFixed(3) + "%";
			}
		})
		.style("text-anchor", "middle")
		.attr("y", 520)
		.attr("id", "accom")
		.attr("font-size", "1.0em")
		.attr("font-weight", "bold")
		.attr("fill", function(p) {
			console.log(accom_percent, "Min_accom ", min_accom, "p ", p);
			if (accom_percent[p] < min_accom) {
				min_accom = accom_percent[p];
				//g.select("#accom").attr("fill", "red");
				return "red";
			}
			else {
				// g.select("#accom").attr("fill", "black");
				return "black";
			}
		});


		var count = 0;
		var start = 0;
		let counts = []; 
		for (let i = 0; i < actives.length; i++) {
			counts[i] = 0;
		}

  		foreground.style("display", function(d) {
  			//console.log("Actives Length: " + actives.length + "\nCounts length: " + counts.length);
    			return actives.every(function(p, i) {
    				// console.log("Extents: " + extents );
    				// console.log("Actives: " + actives );
    				//console.log("i: " + i);
    				if(extents[i][0] <= d[p] && d[p] <= extents[i][1]) {
    					counts[i] += 1;
    					// console.log(counts[i]);
    				}
      				return extents[i][0] <= d[p] && d[p] <= extents[i][1];
    			}) ? null : "none";
  			

  		});
  		// background.style("display", function(d) {
  		// 	actives.every(function(p, i) {
    // 				// console.log("Extents: " + extents );
    // 				// console.log("Actives: " + actives );
    // 				//console.log("i: " + i);
    // 				if(extents[i][0] <= d[p] && d[p] <= extents[i][1]) {
    // 					counts[i] += 1;
				// 		// console.log(counts[i]);
    // 				}
    // 			});
  		// 	});

  		// counts.forEach(function(d) {
  		// 	console.log(d + "\t");
  		// });
  		

  		// Add slider accommodation in same grouping as slider area? ^^^
		/*g.select("#g3").remove();

      	g.append("g")
		.attr("class", "axis")
		.each(function(p) { 
			d3.select(this).call(axis.scale(y[p]));
		})
		.append("text")
		.style("text-anchor", "middle")
		.attr("y", 530)
		.attr("id", "g3")
		.attr("font-size", "1.2em")
		.text(function(p) { 
			if(y[p].brush.empty()) return "Slider Accomodation: 100%"; 
			else return "Slider Accomodation: " + counts[0];	
		});
*/
  		d3.select("#g2").remove();
  		//Doesn't work. 
  		d3.select("#pcoord").append("div").attr("id", "g2").style("color", "red")
  				.style("text-align", "center").style("font-weight", "bold")
  				.text("Total Accommodation: " + ((count / 1774)*100).toFixed(2) + "%");
 } 
}	