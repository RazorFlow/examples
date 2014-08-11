<?php

class SampleDashboard extends StandaloneDashboard {
  public function buildDashboard(){
    $chart = new ChartComponent('chart');
    $chart->setCaption("Costs by division - 2013 v 2012");
    $chart->setDimensions (8, 6);
    $chart->setLabels (['Manufacturing', 'Publishing', 'Transportation', 'Communications']);
    $chart->addSeries ("2013", "2013", [24400, 27800, 23800, 24800], array("seriesDisplayType"=> 'bar'));
    $chart->addSeries ("2012", "2012", [15000, 15000, 17500, 20000], array("seriesDisplayType"=> 'bar'));
    $chart->setYAxis('', array("numberPrefix"=> '$', "numberHumanize"=> true));
    $this->addComponent ($chart);
  }
}

$db = new SampleDashboard();
$db->renderStandalone();
  
