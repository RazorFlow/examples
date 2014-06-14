<?php

class A extends Dashboard {

  public function buildDashboard() {
    $kpi = new KPIComponent('a');
    $kpi->setDimensions(3, 3);
    $kpi->setCaption('AAA');
    $kpi->setValue(44);

    $this->setDashboardTitle('DB 1');
    $this->addComponent($kpi);
  }

}

class B extends Dashboard {

  public function buildDashboard() {
    $kpi = new KPIComponent('b');
    $kpi->setDimensions(3, 3);
    $kpi->setCaption('AAA');
    $kpi->setValue(44);

    $this->setDashboardTitle('DB 2');
    $this->addComponent($kpi);
  }
}

class C extends Dashboard {

  public function buildDashboard() {
    $kpi = new KPIComponent('c');
    $kpi->setDimensions(3, 3);
    $kpi->setCaption('AAA');
    $kpi->setValue(44);
    
    $this->setDashboardTitle('DB 3');
    $this->addComponent($kpi);
  }
}

