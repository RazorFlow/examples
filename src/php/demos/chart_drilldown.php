<?php

class SampleDashboard extends StandaloneDashboard {
  public function buildDashboard() {
    $chart = new ChartComponent ('chart');
    $chart->setDimensions (8, 6);
    $chart->setCaption ('Annual Sales Summary (2010 - 2013');
    $chart->setLabels (['2010', '2011', '2012', '2013']);
    $chart->addSeries ('sales', 'Sales', [1160000, 1040000, 1020000, 1160000]);

    $chart->setYAxis('', array (
        'numberPrefix' => '$',
        'numberHumanize' => true
    ));

    $selectedYear;
    
    $chart->addDrillStep ('firstDrill', $this);

    $chart->addDrillStep ('secondDrill', $this);

    $this->addComponent ($chart);
  }
    private $labelsForQuarters = array (
        'Q1' => ['January', 'February', 'March'],
        'Q2' => ['April', 'May', 'June'],
        'Q3' =>  ['July', 'August', 'September'],
        'Q4' => ['October', 'November', 'December']
    );

    private $yearData = array (
        '2010' => array (
            'Q1' => [110000, 76000, 88000],
            'Q2' => [116000, 92000, 62000],
            'Q3' => [114000, 86000, 11800],
            'Q4' => [92000, 102000, 105000],
            'data' =>  [274000, 270000, 318000, 299000]
        ),
        '2011' => array (
            'Q1' => [370000, 290000, 320000],
            'Q2' => [370000, 290000, 320000],
            'Q3' => [370000, 290000, 320000],
            'Q4' => [370000, 290000, 320000],
            'data' => [306000, 203000, 270000, 264000]
        ),
        '2012' => array (
            'Q1' => [87000, 89000, 65000],
            'Q2' => [13000, 44000, 106000],
            'Q3' => [85000, 103000, 67000],
            'Q4' => [59000, 69000, 113000],
            'data' => [241000, 280000, 255000, 241000]
        ),
        '2013' => array (
            'Q1' => [105000, 76000, 88000],
            'Q2' => [116000, 92000, 62000],
            'Q3' => [114000, 86000, 118000],
            'Q4' => [92000, 102000, 105000],
            'data' => [269000, 270000, 318000, 299000]
        )
    );

    private $selectedYear;

    public function firstDrill ($source, $targets, $params) {
        $label = $params["label"];
        $this->selectedYear = $label;
        $source->setLabels (['Q1', 'Q2', 'Q3', 'Q4']);
        $source->addSeries ('sales', 'Sales', $this->yearData[$label]["data"]);
    }

    public function secondDrill ($source, $targets, $params) {
        $label = $params["label"];
        $source->setLabels ($this->labelsForQuarters[$label]);
        $source->addSeries ('sales', 'Sales', $this->yearData[$params['drillLabelList'][0]][$label]);
    }
}

$db = new SampleDashboard();
$db->renderStandalone();