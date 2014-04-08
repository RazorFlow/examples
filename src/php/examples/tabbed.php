<?php

class SampleDashboard extends Dashboard {
  public function buildDashboard(){

    $chart = new ChartComponent("my_first_chart");
    $chart->setCaption("Expenses incurred on Food Consumption by Year");
    $chart->setDimensions (4, 4);
    $chart->setLabels (["2009", "2010", "2011"]);
    $chart->addSeries ("beverages", "Beverages", [1355, 1916, 1150]);
    $chart->addSeries ("packaged_foods", "Packaged Foods", [1513, 976, 1321]);

    $kpi = new KPIComponent("kpi1");
    $kpi->setCaption("KPI");
    $kpi->setDimensions (2, 2);
    $kpi->setValue(50);

    $this->setDashboardTitle("Dashboard 1");
    $this->addComponent($chart);
    $this->addComponent($kpi);
  }
}

class SampleDashboard2 extends Dashboard {
  public function buildDashboard(){

    $chart = new ChartComponent("my_first_chart2");
    $chart->setCaption("Expenses incurred on Food Consumption by Year");
    $chart->setDimensions (4, 4);
    $chart->setLabels (["2009", "2010", "2011"]);
    $chart->addSeries ("beverages", "Beverages", [1355, 1916, 1150]);

    $this->setDashboardTitle("Dashboard 2");
    $this->addComponent($chart);
  }
}



$db1 = new SampleDashboard();
$db2 = new SampleDashboard2();
  
$tab = new TabbedDashboard();
$tab->settabbedDashboardTitle('Tabbed Dashboard');
$tab->addDashboardTab ($db1);
$tab->addDashboardTab ($db2);
$tab->setActive($db1);


$tab->renderTabbed();
