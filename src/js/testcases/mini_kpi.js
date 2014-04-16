rf.StandaloneDashboard(function(db){
	var chart = new ChartComponent();
	chart.setDimensions (8, 8);
	chart.setCaption("2011 Sales");	
	chart.setLabels (["Beverages", "Vegetables"])
	chart.addSeries ("sales", "Sales", [1343, 7741]);
	chart.addSeries ("quantity", "Quantity", [76, 119]);

	chart.addComponentKPI("first", {
		caption: "hello",
		value: "20"
	});

	chart.addComponentKPI("second", {
		caption: "bye",
		value: "42"
	});

	chart.addComponentKPI("third", {
		caption: "new",
		value: "100"
	});

	chart.addComponentKPI("fourth", {
		caption: "again",
		value: "22"
	});
	db.addComponent (chart);
	var table = new TableComponent ('test');
	table.setCaption ("Regional Sales");
	table.setDimensions(4, 4);
	table.addColumn ('zone', "Zone");
	table.addColumn ('name', "Store Name");
	table.addColumn ('sale', "Sales amount");
	var data = [
		{zone: "North", name: "Northern Stores", sale: 4000},
		{zone: "South", name: "Southern Stores", sale: 4500},
	];
	table.addMultipleRows (data);
	table.addComponentKPI("first", {
		caption: "hello",
		value: "20"
	});

	table.addComponentKPI("second", {
		caption: "bye",
		value: "42"
	});

	table.addComponentKPI("third", {
		caption: "new",
		value: "100"
	});

	table.addComponentKPI("fourth", {
		caption: "again",
		value: "22"
	});
	db.addComponent(table);
});