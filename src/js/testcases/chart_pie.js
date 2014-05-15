StandaloneDashboard(function (db) {
    var pieChart = new ChartComponent();
    pieChart.setDimensions(4,4);
    pieChart.setCaption('Pie Chart');
    pieChart.setLabels (["2009", "2010", "2011"]);
    pieChart.addSeries ("beverages", "Beverages", [1355, 1916, 1150], {seriesDisplayType: 'pie'});
    db.addComponent(pieChart);   
});