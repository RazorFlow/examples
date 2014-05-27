<?php

class SampleDashboard extends StandaloneDashboard {
    public function buildDashboard () {
        $kpi = new KPIComponent("kpi1");
        $kpi->setCaption("Hello world");
        $kpi->setValue(42, array('valueTextColor' => 'red'));
        $kpi->setDimensions(4, 4);
        $this->addComponent ($kpi);
    }
}

$db = new SampleDashboard();
$db->renderStandalone();
