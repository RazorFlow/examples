rf.StandaloneDashboard(function(db){
	var chart = new ChartComponent();
	chart.setDimensions (6, 4);
	chart.setCaption("Company Revenue");
	chart.setLabels (["Aug", "Sept", "Oct", "Nov", "Dec"]);
	chart.addSeries ("prod_a", "Product A", [36000, 34300, 30000, 27800, 25000]);
	chart.addSeries ("prod_b", "Product B", [31000, 29300, 26000, 21000, 20500]);
	chart.addSeries ("Predicted", "Predicted", [25000, 23000, 20000, 18000, 14500], {
		seriesDisplayType: "line"
	});
	chart.addSeries ("avg", "2004 Avg.", [17000, 15000, 16000, 11500, 10000], {
		seriesDisplayType: "line"
	});
	chart.setYAxis('', {numberPrefix: '$', numberHumanize: true});
	db.addComponent (chart);


	var chart1 = new ChartComponent();
	chart1.setDimensions (6, 4);
	chart1.setCaption("Sales");
	chart1.setLabels (["A", "B", "C", "D", "E", "F", "G", "H", "I", "J"]);
	chart1.addSeries ("Revenue", "Revenue", [5854, 4171, 1375, 1875, 2246, 2696, 1287, 2140, 1603, 1628]);
	chart1.addSeries ("Profit", "Profit", [3242, 3171, 700, 1287, 1856, 1126, 987, 1610, 903, 928], {
		seriesDisplayType: "area"
	});
	chart1.addSeries ("Predicted_Profit", "Predicted Profit", [4342, 2371, 740, 3487, 2156, 1326, 1087, 1710, 703, 928], {
		seriesDisplayType: "line"
	});
	chart1.setYAxis('', {numberPrefix: '$', numberHumanize: true});
	db.addComponent (chart1);
});
