describe ("Basic Chart Tests", function () {
	var db;
	beforeEach(function () {
		$("#dbTarget").empty().removeClass("");
		$("#dbTarget").css({
			width: 1000
		});
	});

	afterEach(function() {
		db.pro.dispose();
	});

	var createChart = function () {
		var chart = new ChartComponent();
		chart.setDimensions (4, 4);
		chart.setCaption("2011 Sales");	
		chart.setLabels (["Beverages", "Vegetables"])
		chart.addSeries ("sales", "Sales", [1343, 7741]);
		chart.addSeries ("quantity", "Quantity", [76, 119]);
		return chart;
	}

	it("Should contain an axis", function (done) {
		db = new Dashboard ();
		var chart = createChart();

		db.addComponent(chart);
		db.embedTo("dbTarget");

		var th = new TestHelper ();
		th.start(done)
		  .wait(200)
		  .setContext(chart.pro.renderer.$core.parent())
		  .drillContext(".rc-axis:eq(0)")
		  .assertText("text:eq(0)", "Beverages")
		  .svgMeasure("text:eq(0)", "y", t3.approximate(14, 2))
		  .assertText("text:eq(1)", "Vegetables")
		  .finish();
	});


});