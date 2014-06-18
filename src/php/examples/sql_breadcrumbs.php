<?php

class LocationDrillDashboard extends StandaloneDashboard {
	protected $pdo;

	protected $monthName = array(
			"01" => "Jan",
			"02" => "Feb",
			"03" => "Mar",
			"04" => "Apr",
			"05" => "May",
			"06" => "Jun",
			"07" => "July",
			"08" => "Aug",
			"09" => "Sept",
			"10" => "Oct",
			"11" => "Nov",
			"12" => "Dec"
		);

	public function buildDashboard () {
		$chart = new ChartComponent ('sales1');
		$chart->setCaption ("Sales by Country");
		$chart->setDimensions (12, 6);
		$countryData = $this->pdo->query("SELECT SUM(amount) as total_amount, country FROM Payments NATURAL JOIN Customers GROUP BY country;")->fetchAll(PDO::FETCH_ASSOC);
		$chart->setLabels(ArrayUtils::pluck($countryData, 'country'));
		$chart->addSeries ("sales", "Sales", ArrayUtils::pluck($countryData, "total_amount"), array(
			'numberPrefix' => "$"
		));
		$chart->addDrillStep ("get_states", $this);
		$chart->addDrillStep ("get_cities", $this);
		$this->addComponent ($chart);

		$yearwise = new ChartComponent('year');
		$yearwise->setCaption("Sales by Time");
		$yearwise->setDimensions(12,6);
		$yearData = $this->pdo->query("SELECT SUM(amount) as total_amount, strftime('%Y', paymentDate) as payment_year FROM Payments NATURAL JOIN Customers GROUP BY payment_year;")->fetchAll(PDO::FETCH_ASSOC);
		$yearwise->setLabels(ArrayUtils::pluck($yearData, 'payment_year'));
		$yearwise->addSeries ("sales", "Sales", ArrayUtils::pluck($yearData, "total_amount"), array(
			'numberPrefix' => "$"
		));
		$yearwise->addDrillStep("get_monthwise", $this);
		$yearwise->addDrillStep("get_daywise", $this);
		$this->addComponent ($yearwise);
	}

	public function get_monthwise($source, $target, $params) {
		$monthwise = $this->pdo->query("SELECT SUM(amount) as total_amount, strftime('%m', paymentDate) as payment_month FROM Payments NATURAL JOIN Customers where strftime('%Y', Payments.paymentDate)='".$params['label']."' GROUP BY payment_month;")->fetchAll(PDO::FETCH_ASSOC);
		$source->clearChart();
		$monthArr = ArrayUtils::pluck($monthwise, 'payment_month');
		for ($i = 0; $i < count($monthArr); $i++) {
			$monthArr[$i] = $this->monthName[$monthArr[$i]];
		}
		$source->setLabels($monthArr);
	    $source->addSeries ("sales", "Sales", ArrayUtils::pluck($monthwise, "total_amount"), array(
			'numberPrefix' => "$"
		));
	}

	public function get_daywise($source, $target, $params) {
		$month = array_search($params['label'], $this->monthName);
		$daywise = $this->pdo->query("SELECT SUM(amount) as total_amount, strftime('%d', paymentDate) as payment_day FROM Payments NATURAL JOIN Customers where strftime('%Y', Payments.paymentDate)='".$params['labelList'][0]."' and strftime('%m', Payments.paymentDate)='".$month."' GROUP BY payment_day;")->fetchAll(PDO::FETCH_ASSOC);
		$source->clearChart();
		$source->setLabels(ArrayUtils::pluck($daywise, 'payment_day'));
	    $source->addSeries ("sales", "Sales", ArrayUtils::pluck($daywise, "total_amount"), array(
			'numberPrefix' => "$"
		));
	}

	public function get_states ($source, $target, $params) {
		$stateData = $this->pdo->query("SELECT SUM(amount) as total_amount, state FROM Payments NATURAL JOIN Customers where Customers.country = '".$params['label']."' GROUP BY state;")->fetchAll(PDO::FETCH_ASSOC);
		$source->clearChart();
		$source->setLabels(ArrayUtils::pluck($stateData, 'state'));
	    $source->addSeries ("sales", "Sales", ArrayUtils::pluck($stateData, "total_amount"), array(
			'numberPrefix' => "$"
		));
	}

	public function get_cities ($source, $target, $params) {
		$cityData = $this->pdo->query("SELECT SUM(amount) as total_amount, city FROM Payments NATURAL JOIN Customers where Customers.state = '".$params['label']."' GROUP BY city;")->fetchAll(PDO::FETCH_ASSOC);
		$source->clearChart();
		$source->setLabels(ArrayUtils::pluck($cityData, 'city'));
	    $source->addSeries ("sales", "Sales", ArrayUtils::pluck($cityData, "total_amount"), array(
			'numberPrefix' => "$"
		));
	}



	public function initialize () {
		$this->pdo = new PDO("sqlite:fixtures/databases/birt.sqlite");
	}
}


$db = new LocationDrillDashboard();
$db->renderStandalone();
  
