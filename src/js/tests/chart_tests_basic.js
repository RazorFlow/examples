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
		chart.addSeries ("quantity", "Quantity", [76, 119], seriesB);
		return chart;
	}

	it("Should display labels on X Axis", function (done) {
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
		  .svgMeasure("text:eq(0)", "y", t3.approximate(14, 1))
		  .assertText("text:eq(1)", "Vegetables")
		  .finish();
	});

	it("Should display items on Y Axis", function (done) {
		db = new Dashboard ();
		var chart = createChart();

		db.addComponent(chart);
		db.embedTo("dbTarget");

		var th = new TestHelper ();
		th.start(done)
		  .wait(200)
		  .setContext(chart.pro.renderer.$core.parent())
		  .drillContext(".rc-axis:eq(1)")
		  .assertText("text:eq(0)", "0")
		  .svgMeasure("text:eq(0)", "y", t3.approximate(0, 0.1))
		  .assertText("text:eq(1)", "1,600")
		  .finish();
	});

	it("Should format numbers on Y Axis", function (done) {
		db = new Dashboard ();
		var chart = createChart({}, {}, {
			numberPrefix: "$"
		});

		db.addComponent(chart);
		db.embedTo("dbTarget");

		t3.start(done)
		  .wait(200)
		  .setContext(chart.pro.renderer.$core.parent())
		  .drillContext(".rc-axis:eq(1)")
		  .assertText("text:eq(1)", "$1,600")
		  .finish();
	});

	it("Should display rectangles for columns", function (done) {
		db = new Dashboard ();
		var chart = createChart();

		db.addComponent(chart);
		db.embedTo("dbTarget");

		t3.start(done)
		  .wait(200)
		  .setContext(chart.pro.renderer.$core.parent())
		  .drillContext("g.rc-series-1")
		  .svgMeasure("rect:eq(0)", "width", t3.approximate(36, 1))
		  .svgMeasure("rect:eq(0)", "height", t3.approximate(33, 1))
		  .svgMeasure("rect:eq(1)", "height", t3.approximate(191, 2))
		  .svgMeasure("rect:eq(1)", "width", t3.approximate(36, 1))
		  .finish();
	});

	it("Should display a VALID tooltip when there's a mouseover event", function (done) {
		db = new Dashboard ();
		var chart = createChart({}, {}, {
			numberPrefix: "$"
		});

		db.addComponent(chart);
		db.embedTo("dbTarget");

		t3.start(done)
		  .wait(200)
		  .setContext(chart.pro.renderer.$core.parent())
		  .svgTriggerEvent("rect:eq(0)", "mouseover")
		  .wait(200)
		  .enterTempContext($(".rfTooltip:eq(0)"))
		  	.assertText(".rfTooltipLabel", "Sales", {trim: true})
		  	.assertText(".rfTooltipValue", "$1,343")
		  	.assertText(".rfTooltipMainLabel", "Beverages")
		  	.assertCSS(".", "left", t3.approximate(68, 2))
		  	.assertCSS(".", "top", t3.approximate(205, 2))
		  .exitTempContext()
		  .svgTriggerEvent("rect:eq(0)", "mouseout")
		  .wait(200)
		  .svgTriggerEvent("rect:eq(1)", "mouseover")
		  .wait(200)
		  .enterTempContext($(".rfTooltip:eq(0)"))
		  	.assertText(".rfTooltipLabel", "Sales", {trim: true})
		  	.assertText(".rfTooltipValue", "$7,741")
		  	.assertText(".rfTooltipMainLabel", "Vegetables")
		  	.assertCSS(".", "left", t3.approximate(186, 2))
		  	.assertCSS(".", "top", t3.approximate(47, 2))
		  .exitTempContext()
		  .svgTriggerEvent("rect:eq(1)", "mouseout")
		  .finish();
	});
});