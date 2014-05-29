<?php

class SampleDashboard extends StandaloneDashboard {
    public function buildDashboard () {
        $filter = new FilterComponent("filter");
        $filter->setCaption("Test Filter Component");
        $filter->setDimensions(4, 4);

        $filter->addTextFilter('name', 'Name');
        $filter->addSelectFilter('products', 'Products', array('Beverages', 'Chips', 'Cookies', 'Cakes', 'Dairy Products', 'Poultry'), array('defaultSelectedIndex' => 2));
        $filter->addMultiSelectFilter('cities', 'Cities', array('Bangalore', 'San Fransisco', 'New York', 'Melbourne', 'London', 'Rio De Jeneiro'), array('defaultSelectedOptions' => array(2, 4)));
        $filter->addDateFilter('delivery_date', 'Delivery Date', array());
        $filter->addDateRangeFilter('grace_period', 'Grace Period', array());
        $filter->addNumericRangeFilter('units', 'Units in Stock', array(1, 2, 3));

        $this ->addComponent ($filter);

    }
}

$db = new SampleDashboard();
$db->renderStandalone();

