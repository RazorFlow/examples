StandaloneDashboard(function (db) {
    db.setDashboardTitle('KPI Types Supported in RazorFlow');

    // var c1 = new KPIComponent();
    // c1.setDimensions(3, 3);
    // c1.setCaption({md: 'Average Monthly Sales', sm: "Sales"});
    // c1.setValue(513.22);
    // db.addComponent(c1);

    // var c2 = new GaugeComponent();
    // c2.setDimensions(4, 4);
    // c2.setCaption('Average Monthly Cost');
    // c2.setValue(90);
    // c2.setLimits(0, 100);

    // db.addComponent(c2);


    var c3 = new TableComponent ();
    c3.setDimensions (6, 6);
    c3.setRowsPerPage('10');
    c3.setCaption ("table component");
    c3.addColumn ("a", "Column A", {
      dataType: "number",
      numberPrefix: "$",
    });
    c3.addColumn ("b", "Column B", {
      dataType: "number",
      numberSuffix: "%"
    });
    c3.addSparkColumn ("c", "Column C", {
      textAlign: "center"
    });

    for(var i = 0; i < 8; i++) {
        c3.addRow ({a: 2 * i, b: 2 * i + 1, c: [5, 1, 3, 2, 4, 6, 3, 1, 3]});
    }
    db.addComponent(c3);

    // var c4 = new ChartComponent();
    // c4.setDimensions(12, 6);
    // c4.setCaption('New Chart');
    // c4.setCaption('Yearly Sales for Top 5 Genres');
    // c4.setLabels(['2007', '2008', '2009', '2010', '2011']);
    // c4.addSeries('rock', 'Rock', [178.20, 155.43, 161.37, 157.41, 174.24], {seriesDisplayType: 'pie', numberPrefix: "$"});
    // c4.addSeries('latin', 'Latin', [82.17, 77.22, 80.19, 63.36, 79.20], {numberPrefix: "$"});
    // c4.addSeries('metal', 'Metal', [61.38, 53.46, 30.69, 80.39, 44.45], {numberPrefix: "$"});
    // c4.addSeries('blues', 'Blues', [62.37, 59.60, 45.54, 38.61, 5.94], {numberPrefix: "$"});
    // c4.addSeries('jazz', 'Jazz', [174.24, 79.20, 55.45, 55.44, 21.78], {numberPrefix: "$"});
    // c4.setYAxis('hello', {numberPrefix: '$'});
    // db.addComponent(c4);
    

    // var form = new FormComponent();
    // form.setDimensions(6,6);
    // form.setCaption('A test form component');
    // form.addTextField('name', 'Enter your name');
    // form.addSelectField('category', 'Enter your category', ['Dragon', 'Horse', 'Cat', 'Dog', 'Human']);
    // form.addMultiSelectField('multi', 'Enter your category', ['Dragon', 'Horse', 'Cat', 'Dog', 'Human']);
    // form.addDateField('delivery', 'Delivery Date');
    // form.addDateRangeField('daterange', 'Delivery Range');
    // form.addNumericRangeField('unitrange', 'Units Range');
    // form.addCheckboxField('truthtest', 'Did you take this form seriously?');
    // form.onApplyClicked(function(obj) {
    //     debugger
    // });
    // db.addComponent(form);
//                 setTimeout(function () {
//                     // c1.setValue(55);
//                     // c1.unlock();
//                     // c3.clearRows();
// //                    c3.addRow ({a: 5, b: 6}); 
//                     // c2.setValue(55);
//                 }, 3000);
//                 
//                 

    // console.log(JSON.stringify(db.pro._serializeComponents()));
});
