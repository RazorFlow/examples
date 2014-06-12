rf.StandaloneDashboard(function(db){
	var chart = new ChartComponent();
    chart.setDimensions (4, 4);
    chart.setCaption("2011 Sales"); 
    chart.setLabels (["Beverages", "Vegetables"])
    chart.addSeries ("sales", "Sales", [1343, 7741]);
    chart.addSeries ("quantity", "Quantity", [76, 119]);

	var chart1 = new ChartComponent('someid');
    chart1.setDimensions (4, 4);
    chart1.setCaption("Expenses incurred on Food Consumption by Year");
    chart1.setLabels (["2009", "2010", "2011"]);
    chart1.addSeries ("beverages", "Beverages", [1355, 1916, 1150]);
    chart1.addSeries ("packaged_foods", "Packaged Foods", [1513, 976, 1321]);
    chart1.hideComponent();

	db.addComponent (chart);
    db.addComponent (chart1);

	chart.onItemClick(function(params) {
        chart1.showAsModal();
    });
});
