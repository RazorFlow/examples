StandaloneDashboard(function (db) {
    var c1 = new ChartComponent();
    c1.setCaption("Column Chart");
    c1.setDimensions(4, 4);
    c1.setLabels(['January', 'February', 'March', 'April', 'May']);
    c1.addSeries("seriesA", "Series A", [1, 3, 5, 1, 9], {seriesDisplayType: 'column', numberPrefix: '$'});
    c1.addSeries("seriesB", "Series B", [10, 31, 51, 11, 91].reverse(), {seriesDisplayType: 'column', numberPrefix: '$', yAxis: 'quantity'});
    c1.setYAxis("Stock", {
        numberPrefix: '$'
    });
    c1.addYAxis('quantity', "Quantity", {
        numberPrefix: '#'
    });
 
    db.addComponent(c1);
});
