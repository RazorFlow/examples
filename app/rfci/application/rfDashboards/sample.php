<?php

require_once(APPPATH . 'libraries/razorflow_php/razorflow.php');

class SampleDashboard extends StandaloneDashboard {
  public function buildDashboard(){
    $kpi = new KPIComponent ('kpi');
    $kpi->setCaption ('Sales');
    $kpi->setDimensions (5, 3);
    $kpi->setValue (1913, array('numberPrefix' => '$'));

    $this->setDashboardTitle ("Sales");
    $this->addComponent ($kpi);
  }
}
