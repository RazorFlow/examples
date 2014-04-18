<?php

class MyDashboard extends EmbeddedDashboard {
  public function buildDashboard(){

    $kpi = new KPIComponent("kpi1");
    $kpi->setCaption("");
    $kpi->setDimensions (2, 2);
    $kpi->setValue(0);

    $chart = new ChartComponent("my_first_chart");
    $chart->setCaption("Expenses incurred on Food Consumption by Year");
    $chart->setDimensions (4, 4);
    $chart->setLabels (["2009", "2010", "2011"]);
    $chart->addSeries ("beverages", "Beverages", [1355, 1916, 1150]);
    $chart->addSeries ("packaged_foods", "Packaged Foods", [1513, 976, 1321]);

    $chart->onItemClick (array($kpi), "handleItemClick", $this);

    $this->setDashboardTitle("Dashboard 1");
    $this->addComponent($chart);
    $this->addComponent($kpi);

}

  public function handleItemClick($source, $targets, $params) {
    // sleep(3);
    $kpi = $this->getComponentById("kpi1");
    $kpi->setValue($params['value']);
    $kpi->setCaption("Year: ".$params['label']);

  }
}
