StandaloneDashboard(function (db) {

    // The test uses random values to test the performance of the chart

    var aMax = Math.random() * 1000,
        bMax = Math.random() * 1000,
        aData = [],
        bData = [];

    for(var i=-1; ++i<5;) {
        aData[i] = Math.floor(Math.random() * aMax);
        bData[i] = -Math.floor(Math.random() * bMax);
    }

    console.log(aData, bData);

    var c1 = new ChartComponent();
    c1.setCaption("Column Chart");
    c1.setDimensions(4, 4);
    c1.setLabels(['January', 'February', 'March', 'April', 'May']);
    c1.addSeries("seriesA", "Series A", aData, {seriesDisplayType: 'column', numberPrefix: '$'});
    c1.addSeries("seriesB", "Series B", bData, {seriesDisplayType: 'column', numberPrefix: '$', yAxis: 'quantity'});
    c1.setYAxis("Stock", {
        numberPrefix: '$'
    });
    c1.addYAxis('quantity', "Quantity", {
        numberPrefix: '#'
    });
 
    db.addComponent(c1);
});
