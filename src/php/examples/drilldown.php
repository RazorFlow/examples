<?php

class SampleDashboard extends StandaloneDashboard {
  public function buildDashboard(){
    $chart = new ChartComponent("2011_sales");
    $chart->setCaption("2011 Sales");
    $chart->setDimensions (4, 4);
    $chart->setLabels (["Beverages", "Vegetables"]);
    $chart->addSeries ("sales", "Sales", [1343, 7741]);
    $chart->addSeries ("quantity", "Quantity", [76, 119]);

    $chart->addDrillStep ("drillDownCountry");
    $chart->addDrillStep ("drillDownState");
    $chart->addDrillStep ("drillDownCity");

    $this->addComponent ($chart);
  }

  public function drillDownCountry ($params, $component) {
  	$component->setLables (array("A", "B"));
  	$component->addSeries ("sales", "SAles", [10, 20]);
  }

  public function drillDownState ($params, $component) {
  	$component->setLables (array("C", "D"));
  	$component->addSeries ("sales", "SAles", [30, 40]);
  }

  public function drillDownCity($params, $component) {
  	$component->setLables (array("E", "F"));
  	$component->addSeries ("sales", "SAles", [50, 60]);
  }
}

$db = new SampleDashboard();
$db->renderStandalone();
  
