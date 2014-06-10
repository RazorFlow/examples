describe ("Propertybase Validation", function () {
  var properties = require("prop/properties");
  beforeEach(function () {
  });

  it("Should iterate through everything", function () {
    var prop = new properties.ChartComponentProperties ();
    var series = new properties.ChartSeriesProperties();
    prop.addItemToList("chart.series", "foo", series);

    console.log(prop.validate ());
  })

  it("Should detect empty series", function () {
    var chart = new ChartComponent ();
    var errors = chart.validate ();

    expect(errors).toBe([1000, 1001]);
  })


});
