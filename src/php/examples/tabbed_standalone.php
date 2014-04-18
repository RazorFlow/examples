<?php
class SampleDashboard extends Dashboard {
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

class SampleDashboard3 extends Dashboard {
  public function buildDashboard(){
    $chart = new ChartComponent("chart1");
    $chart->setCaption("My First Chart");
    $chart->setDimensions (4, 4);
    $chart->setLabels (["Jan", "Feb", "Mar"]);
    $chart->addSeries ("beverages", "Beverages", array(1355, 1916, 1150));
    $chart->addSeries ("packaged_foods", "Packaged Foods", array(1513, 976, 1321));

    $this->addComponent ($chart);

    $chart2 = new ChartComponent("chart2");
    $chart2->setDimensions (4, 4);
    $chart2->setCaption ("My First Chart");
    $chart2->setLabels (array("A", "B", "C"));
    $chart2->addSeries ("series_1", "Series 1", array(1, 2, 3));

    $this->setDashboardTitle("Dashboard 3");
    $this->addComponent ($chart2);

    $chart->onItemClick (array($chart2), "handleItemClick", $this);
  
}

  public function handleItemClick ($source, $targets, $params) {
    $chart2 = $this->getComponentByID("chart2");
    $chart2->updateSeries("series_1", [3, 5, 2]);
  }
}

class SampleTabbedDashboard extends TabbedDashboard {

  public function buildDashboard() {
    $db1 = new SampleDashboard();
    $db2 = new SampleDashboard2();
    $db3 = new SampleDashboard3();

    $this->settabbedDashboardTitle('Tabbed Dashboard');
    $this->addDashboardTab ($db1);
    $this->addDashboardTab ($db2);
    $this->addDashboardTab ($db3);
    $this->setActive($db1);
  }

}
  
$tab = new SampleTabbedDashboard();
$tab->renderStandalone();
