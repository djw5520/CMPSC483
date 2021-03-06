function drawPcoord(selectedMeasures) {

	let margin = {top: 30, right: 10, bottom: 10, left: 10},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

	let x = d3.scale.ordinal().rangePoints([0, width], 1),
    y = {},
    dragging = {};

	let line = d3.svg.line(),
    axis = d3.svg.axis().orient("left"),
    background,
    foreground;

	let accom_percent = [];

  	let arr = generateLines(); 

    d3.select("#pcoord").select("svg").remove(); 
    d3.select("#pcoord").append("svg");
    d3.select('#total_accom').remove();

    d3.select("#pcoord").append("div")
    	.attr("id", "total_accom")
  		.style("font-size", "1.6em")
    	.style("color", "#1c7a7c")
    	.style("text-align", "center")
    	.style("font-weight", "bold")
    	.text("Total Accommodation: 100%");
	

	let svg = d3.select("#pcoord").select("svg").attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + 90).append("g")
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
  	let g = svg.selectAll(".dimension")
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
		.attr("id", "min")
		.attr("font-size", "1.1em")
		.attr("font-weight", "bold")
		.text(function(p) { 
			return "MIN: " + y[p].domain()[0];
		})

	g.append("g")
		.attr("class", "axis")
		.each(function(p) { 
			d3.select(this).call(axis.scale(y[p]));
		})
		.append("text")
		.style("text-anchor", "middle")
		.attr("y", 520)
		.attr("id", "max")
		.attr("font-size", "1.1em")
		.attr("font-weight", "bold")
		.text(function(p) { 
			return "MAX: " + y[p].domain()[1];
		});

	// Display initial accommodation percent
	g.append("g")
		.attr("class", "axis")
		.each(function(p) { 
			d3.select(this).call(axis.scale(y[p]));
		})
		.append("text")
		.style("text-anchor", "middle")
		.attr("y", 540)
		.attr("id", "accom")
		.attr("font-size", "1.1em")
		.attr("font-weight", "bold")
		.text(function(p) { 
			accom_percent[p] = 100;
			return "ACC: 100%";
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
  		let v = dragging[d];
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
  		let actives = dimensions.filter(function(p) { 
  			return !y[p].brush.empty(); 
  		}),
  		extents = actives.map(function(p) {  
  			return y[p].brush.extent();
  		});
      	
		g.selectAll("#min").text(
			function(p) { 
				if(y[p].brush.empty()) {
					return "MIN: " + y[p].domain()[0];
				} 
				else {
					if(p === "MASS" || p === "BMI"){
						return "MIN: " + y[p].brush.extent()[0].toFixed(1);
					}
					else {
						return "MIN: " + y[p].brush.extent()[0].toFixed(0);
					}
				}
			}
		);

		g.selectAll("#max").text(
			function(p) { 
				if(y[p].brush.empty()) {
					return "MAX: " + y[p].domain()[1];
				} 
				else {
					if(p === "MASS" || p === "BMI") {
						return "MAX: " + y[p].brush.extent()[1].toFixed(1);
					}
					else {
						return "MAX: " + y[p].brush.extent()[1].toFixed(0);
					}
				}	
			}
		);

		g.select("#accom")
		.text(function(p) { 
			if(y[p].brush.empty()) {
				accom_percent[p] = 100;
				return "ACC: 100%";
			}
			else {
				let lowbound = y[p].brush.extent()[0];
				let highbound = y[p].brush.extent()[1];
				let count = 0;
				rawData[p].forEach(function(el) {
					if(el >= lowbound && el <= highbound){
						count++;
					}
				});
				accom_percent[p] = ((count/(rawData[p].length-1)*100));
				return "ACC: " + accom_percent[p].toPrecision(3) + "%";
			}
		})
		.attr("fill", function(p) {
			let min_accom = 100;
			for(key in accom_percent) {
				if (accom_percent[key] < min_accom){
					min_accom = accom_percent[key];
				}
			};
			if (accom_percent[p] === min_accom) {
				min_accom = accom_percent[p];
				return "red";
			}
			else {
				return "black";
			}
		});


		let count = 0;
		let counts = [];
		actives.forEach(function(d){
			counts[d] = 0;
		});

  		foreground.style("display", function(d) {
			return actives.every(function(p, i) {
				if (extents[i][0] <= d[p] && d[p] <= extents[i][1]) {
					counts[p] +=1;
				}
  				return extents[i][0] <= d[p] && d[p] <= extents[i][1];
			}) ? null : "none";
  		});

  		let min = rawData[selectedMeasures[0]].length-1;
  		for (let key in counts) {
  			if(counts[key] < min){
  				min = counts[key];
  			}
  		}

  		d3.select("#total_accom").text("Total Accommodation: " + ((min/(rawData[selectedMeasures[0]].length-1))*100).toPrecision(3) + "%");
  		
	} 
}	