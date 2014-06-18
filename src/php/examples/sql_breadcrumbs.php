<?php

class LocationDrillDashboard extends StandaloneDashboard {
	protected $pdo;

	public function buildDashboard () {
		$chart = new ChartComponent ('sales1');
		$chart->setCaption ("Sales by Country");
		$chart->setDimensions (12, 6);
		$countryData = $this->pdo->query("SELECT SUM(amount) as total_amount, country FROM Payments NATURAL JOIN Customers GROUP BY country;")->fetchAll(PDO::FETCH_ASSOC);
		$chart->setLabels(ArrayUtils::pluck($countryData, 'country'));
		$chart->addSeries ("sales", "Sales", ArrayUtils::pluck($countryData, "total_amount"), array(
			'numberPrefix' => "$"
		));
		$this->addComponent ($chart);
		$chart->addDrillStep ("get_states");


	}

	public function get_states ($source, $target, $params) {
		var_dump($params);
		die();
	}

	public function initialize () {
		$this->pdo = new PDO("sqlite:fixtures/databases/birt.sqlite");
	}
}


$db = new LocationDrillDashboard();
$db->renderStandalone();
  
