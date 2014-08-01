<?php
class SampleDashboard extends StandaloneDashboard {
  public function buildDashboard(){
    $form = new FilterComponent ('form');
    $form->setDimensions (8, 6);
    $form->setCaption ('Filter items in stock');
    $form->addSelectFilter ('category', 'Select Catagory', ['No Selection', 'Beverages', 'Condiments', 'Confections', 'Dairy Products', 'Grains/Cereal', 'Meat/Poultry', 'Produce', 'Seafood']);
    $form->addTextFilter ('contains', 'Product Name Contains');
    $form->addNumericRangeFilter('stock', 'Units In Stock', array(10, 100));
    $form->addCheckboxFilter('discontinued', 'Exclude Discontinued Items', false);
    $this->addComponent ($form);

  }
}

$db = new SampleDashboard();
$db->renderStandalone();
  
