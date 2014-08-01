StandaloneDashboard(function (db) {
    var form = new FilterComponent ();
    form.setDimensions (8, 6);
    form.setCaption ('Filter items in stock');
    form.addSelectFilter ('category', 'Select Catagory', ['No Selection', 'Beverages', 'Condiments', 'Confections', 'Dairy Products', 'Grains/Cereal', 'Meat/Poultry', 'Produce', 'Seafood']);
    form.addTextFilter ('contains', 'Product Name Contains');
    form.addNumericRangeFilter('stock', 'Units In Stock');
    form.addCheckboxFilter('discontinued', 'Exclude Discontinued Items', false);
    db.addComponent(form);
});