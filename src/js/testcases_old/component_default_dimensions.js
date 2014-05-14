StandaloneDashboard(function (db) {
    var chart = new ChartComponent();
    chart.setCaption("My First Chart"); 
    chart.setLabels (["2009", "2010", "2011"])
    chart.addSeries ("beverages", "Beverages", [1355, 1916, 1150]);
    chart.addSeries ("packaged_foods", "Packaged Foods", [1513, 976, 1321]);
    db.addComponent (chart);

    var c1 = new FilterComponent();
    c1.setCaption('Test Filter Component');

    c1.addTextFilter('name', 'Name');
    c1.addSelectFilter('products', 'Products', ['Beverages', 'Chips', 'Cookies', 'Cakes', 'Dairy Products', 'Poultry'], {});
    c1.addMultiSelectFilter('cities', 'Cities', ['Bangalore', 'San Fransisco', 'New York', 'Melbourne', 'London', 'Rio De Jeneiro'], {});
    c1.addDateFilter('delivery_date', 'Delivery Date', {});
    c1.addDateRangeFilter('grace_period', 'Grace Period', {});
    c1.addNumericRangeFilter('units', 'Units in Stock');

    db.addComponent(c1);

    var c2 = new KPIComponent();
    c2.setCaption('Beverages');
    c2.setValue(559, {
        numberSuffix: ' units'
    });
    db.addComponent(c2);
});