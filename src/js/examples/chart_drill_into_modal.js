rf.StandaloneDashboard(function(db){
	var chart = new ChartComponent('id1');
	chart.setDimensions (4, 4);
	chart.setCaption("Expenses incurred on Food Consumption by Year");
	chart.setLabels (["2009", "2010", "2011"]);
	chart.addSeries ("beverages", "Beverages", [1355, 1916, 1150]);
	chart.addSeries ("packaged_foods", "Packaged Foods", [1513, 976, 1321]);

	var chart1 = new ChartComponent("id2");
	chart1.setDimensions (4, 4);
	chart1.setCaption("2011 Sales");	
	chart1.setLabels (["Beverages", "Vegetables"])
	chart1.addSeries ("sales", "Sales", [1343, 7741]);
	chart1.addSeries ("quantity", "Quantity", [76, 119]);
	chart1.hideComponent();

	db.addComponent (chart);
	db.addComponent (chart1);

	chart.onItemClick(function (params) {
		chart1.showAsModal();
	});
});