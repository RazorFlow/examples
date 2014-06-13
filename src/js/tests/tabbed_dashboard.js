describe ("Basic Chart Tests", function () {
	var db;
	beforeEach(function () {
		$("#dbTarget").empty().removeClass("");
		$("#dbTarget").css({
			width: 1000
		});
	});

	var chart_timeout = 400;

	afterEach(function() {
		db.pro.dispose();
		$(".rfTooltip").remove();
	});

	var createChart = function (seriesA, seriesB, yAxis, yAxisName) {
		seriesA = seriesA ? seriesA : {};
		seriesB = seriesB ? seriesB : {};
		yAxisName = yAxisName ? yAxisName : "";
		yAxis = yAxis ? yAxis : {};

		var chart = new ChartComponent();
		chart.setDimensions (4, 4);
		chart.setYAxis(yAxisName, yAxis)
		chart.setCaption("2011 Sales");	
		chart.setLabels (["Beverages", "Vegetables"])
		chart.addSeries ("sales", "Sales", [1343, 7741], seriesA);
		chart.addSeries ("quantity", "Quantity", [300, 800], seriesB);
		return chart;
	}

	it("Should display labels on X Axis", function (done) {
		db = new Dashboard ();
		var chart = createChart();

		db.addComponent(chart);
		db.embedTo("dbTarget");

		var th = new TestHelper ();
		th.start(done)
		  .wait(chart_timeout)
		  .setContext(chart.pro.renderer.$core.parent())
		  .drillContext(".rc-axis:eq(0)")
		  .assertText("text:eq(0)", "Beverages")
		  .svgMeasure("text:eq(0)", "y", t3.approximate(14, 1))
		  .assertText("text:eq(1)", "Vegetables")
		  .finish();
	});
	});


});