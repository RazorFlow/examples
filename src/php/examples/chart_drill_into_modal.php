<?php

class SampleDashboard extends StandaloneDashboard {
  public function buildDashboard(){
    $chart = new ChartComponent("my_first_chart");
    $chart->setCaption("Expenses incurred on Food Consumption by Year");
    $chart->setDimensions (4, 4);
    $chart->setLabels (["2009", "2010", "2011"]);
    $chart->addSeries ("beverages", "Beverages", [1355, 1916, 1150]);
    $chart->addSeries ("packaged_foods", "Packaged Foods", [1513, 976, 1321]);

    $chart1 = new ChartComponent("2011_sales");
    $chart1->setCaption("2011 Sales");
    $chart1->setDimensions (4, 4);
    $chart1->setLabels (["Beverages", "Vegetables"]);
    $chart1->addSeries ("sales", "Sales", [1343, 7741]);
    $chart1->addSeries ("quantity", "Quantity", [76, 119]);
    $chart1->hideComponent();

    $this->addComponent ($chart);
    $this->addComponent ($chart1);

    $chart->onItemClick (array($chart, $chart1), "handleItemClick", $this);
  }

  public function handleItemClick ($source, $targets, $params) {
    $chart1 = $this->getComponentByID('2011_sales');
    $chart1->showAsModal();
  }

}

$db = new SampleDashboard();
$db->renderStandalone();
  