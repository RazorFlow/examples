rf.StandaloneDashboard(function(db){
	var chart = new ChartComponent();
	chart.setDimensions (4, 4);
	chart.setCaption("2011 Sales");	
	var chart = new ChartComponent();
	chart.setDimensions (4, 4);
	chart.setCaption("First Chart");	
	chart.setLabels (["Jan", "Feb", "Mar"]);
	chart.addSeries ("beverages", "Beverages", [1355, 1916, 1150], {
		numberPrefix: "$",
		seriesStacked: true,
		seriesDisplayType: "column"
	});
	
	chart.addSeries ("packaged_foods", "Packaged Foods", [1513, 976, 1321], {
		numberPrefix: "$",
		seriesStacked: true,
		seriesDisplayType: "column"
	});
	chart.addSeries ("vegetables", "Vegetables", [1313, 1976, 924], {
		numberPrefix: "$",
		seriesStacked: true,
		seriesDisplayType: "column"
	});
	db.addComponent (chart);
});