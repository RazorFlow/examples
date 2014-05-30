<?php

class SampleDashboard extends StandaloneDashboard {
  public function buildDashboard(){
    $chart = new ChartComponent("my_first_chart");
    $chart->setCaption("Expenses incurred on Food Consumption by Year");
    $chart->setDimensions (8, 8);
    $chart->setLabels (["2009", "2010", "2011"]);
    $chart->addSeries ("beverages", "Beverages", [1355, 1916, 1150]);
    $chart->addSeries ("packaged_foods", "Packaged Foods", [1513, 976, 1321]);

    $chart->addComponentKPI("first", array(
      "caption" => "Number Formatter",
      "value" => 4200000,
      "numberPrefix" => "$",
      "numberHumanize" => true
    ));
    $chart->addComponentKPI("second", array(
      "caption" => "Long Text with blah blah blah",
      "value" => 200,
      "numberForceDecimals" => true
    ));
    $chart->addComponentKPI("third", array(
      "caption" => "new",
      "value" => 20,
      "numberSuffix" => "%"
    ));
    $chart->addComponentKPI("forth", array(
      "caption" => "again",
      "value" => 100
    ));

    $this->addComponent ($chart);
  }
}

$db = new SampleDashboard();
$db->renderStandalone();
  
