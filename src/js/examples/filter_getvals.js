rf.StandaloneDashboard(function (db) {
    var c1 = new FilterComponent();
    c1.setDimensions(6,6);
    c1.setCaption('Test Filter Component');

    c1.addTextFilter('name', 'Name');
    c1.addSelectFilter('products', 'Products', ['Beverages', 'Chips', 'Cookies', 'Cakes', 'Dairy Products', 'Poultry'], {});
    c1.addMultiSelectFilter('cities', 'Cities', ['Bangalore', 'San Fransisco', 'New York', 'Melbourne', 'London', 'Rio De Jeneiro'], {});
    c1.addDateFilter('delivery_date', 'Delivery Date', {});
    c1.addDateRangeFilter('grace_period', 'Grace Period', {});
    c1.addNumericRangeFilter('units', 'Units in Stock');

    db.addComponent(c1);

    c1.onApplyClick(function() {
        var inputValues = c1.getAllInputValues();
        console.log(inputValues);
    });
});
