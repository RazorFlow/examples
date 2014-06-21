<?php

class SalesDashboard extends Dashboard {
  
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

  public function __construct()
  {
    $this->initialize();
  }

  public function initialize () {
    $this->pdo = new PDO("sqlite:fixtures/databases/Northwind.sqlite");
  }

  public function buildDashboard(){
    $yearwise = new ChartComponent ('yearly_sales');
    $yearwise->setCaption ("Yearly Sales");
    $yearwise->setDimensions (6, 6);
    $yearData = $this->get_year();
    $yearwise->setLabels(ArrayUtils::pluck($yearData, 'payment_year'));
    $yearwise->setYAxis("Sales", array(
      "numberHumanize" => true,
      'numberPrefix' => "$"
    ));
    $totalSalesArr = ArrayUtils::pluck($yearData, "total_amount");
    $yearwise->addSeries ("sales", "Sales", $totalSalesArr, array(
      'numberPrefix' => "$"
    ));
    $yearwise->addDrillStep("get_monthwise", $this);
    $yearwise->addDrillStep("get_daywise", $this);
    $totalSales = 0;
    foreach ($totalSalesArr as $key => $value) {
      $totalSales += $value;
    }
    $yearwise->addComponentKPI("sales", array(
      "caption" => "Total Sales",
      "value" => $totalSales,
      "numberPrefix" => "$",
      "numberHumanize" => true
    ));
    $yearwise->addComponentKPI("second", array(
      "caption" => "Revenue",
      "value" => $totalSales,
      "numberPrefix" => "$",
      "numberHumanize" => true
    ));
    $this->setDashboardTitle("Sales Dashboard");
    $this->addComponent ($yearwise);


    $category = new ChartComponent('category');
    $category->setCaption("Category wise Sales");
    $category->setDimensions(6,6);
    $categoryData = $this->get_category();
    $category->setLabels(ArrayUtils::pluck($categoryData, 'CategoryName'));
    $category->setYAxis("Sales", array(
      "numberHumanize" => true,
      'numberPrefix' => "$"
    ));
    $totalSalesArr = ArrayUtils::pluck($categoryData, "total_amount");
    $category->addSeries ("sales", "Sales", $totalSalesArr, array(
      'numberPrefix' => "$"
    ));

    // $category->addComponentKPI("best_selling", array(
    //   "caption" => "Best Selling Category",
    //   "value" => $this->get_bestSelling()[0]['CategoryName'],
    //   "numberPrefix" => "$",
    //   "numberHumanize" => true
    // ));
    $this->addComponent ($category);
  }

  public function get_category () {
    $yearData = $this->pdo->query("select SUM(o.UnitPrice * o.Quantity) as total_amount, CategoryName from Product as p, Category as c, OrderDetail as o where c.Id = p.CategoryId and o.ProductId = p.Id group by CategoryName;");
    return $yearData->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_bestSelling () {
    $yearData = $this->pdo->query("select SUM(o.UnitPrice * o.Quantity) as total_amount, CategoryName from Product as p, Category as c, OrderDetail as o where c.Id = p.CategoryId and o.ProductId = p.Id group by CategoryName order by total_amount DESC LIMIT 1;");
    return $yearData->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_year () {
    $yearData = $this->pdo->query("SELECT SUM(UnitPrice * Quantity) as total_amount, strftime('%Y', OrderDate) as payment_year  FROM 'Order' as o, 'OrderDetail' as od where o.Id = od.OrderId group by payment_year;");
    return $yearData->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_monthwise($source, $target, $params) {
    $monthwiseQuery = $this->pdo->prepare("SELECT SUM(UnitPrice * Quantity) as total_amount, strftime('%m', OrderDate) as payment_month FROM 'Order' as o, 'OrderDetail' as od where o.Id = od.OrderId and strftime('%Y', OrderDate)=:paymentYear GROUP BY payment_month;");
    $monthwiseQuery->execute(array('paymentYear' => $params['label']));
    $monthwise = $monthwiseQuery->fetchAll(PDO::FETCH_ASSOC);
    $source->clearChart();
    $monthArr = ArrayUtils::pluck($monthwise, 'payment_month');
    for ($i = 0; $i < count($monthArr); $i++) {
      $monthArr[$i] = $this->monthName[$monthArr[$i]];
    }
    $source->setLabels($monthArr);
    $totalSalesArr = ArrayUtils::pluck($monthwise, "total_amount");
    $source->addSeries ("sales", "Sales", $totalSalesArr, array(
      'numberPrefix' => "$"
    ));
    $totalSales = 0;
    foreach ($totalSalesArr as $key => $value) {
      $totalSales += $value;
    }
    $source->addComponentKPI("sales", array(
      "caption" => "Total Sales",
      "value" => $totalSales,
      "numberPrefix" => "$",
      "numberHumanize" => true
    ));
    $source->addComponentKPI("second", array(
      "caption" => "Revenue",
      "value" => $totalSales,
      "numberPrefix" => "$",
      "numberHumanize" => true
    ));
  }

  public function get_daywise($source, $target, $params) {
    $month = array_search($params['label'], $this->monthName);
    $daywiseQuery = $this->pdo->prepare("SELECT SUM(UnitPrice * Quantity) as total_amount, strftime('%d', OrderDate) as payment_day FROM 'Order' as o, 'OrderDetail' as od where o.Id = od.OrderId and strftime('%Y', OrderDate)=:paymentYear and strftime('%m', OrderDate)=:paymentMonth GROUP BY payment_day;");
    $daywiseQuery->execute(array('paymentYear' => $params['drillLabelList'][0], 'paymentMonth' => $month));
    $daywise = $daywiseQuery->fetchAll(PDO::FETCH_ASSOC);
    $source->clearChart();
    $source->setLabels(ArrayUtils::pluck($daywise, 'payment_day'));
    $totalSalesArr = ArrayUtils::pluck($daywise, "total_amount");
    $source->addSeries ("sales", "Sales", $totalSalesArr, array(
      'numberPrefix' => "$"
    ));
    $totalSales = 0;
    foreach ($totalSalesArr as $key => $value) {
      $totalSales += $value;
    }
    $source->addComponentKPI("sales", array(
      "caption" => "Total Sales",
      "value" => $totalSales,
      "numberPrefix" => "$",
      "numberHumanize" => true
    ));
    $source->addComponentKPI("second", array(
      "caption" => "Revenue",
      "value" => $totalSales,
      "numberPrefix" => "$",
      "numberHumanize" => true
    ));
  }
}



class SampleDashboard extends TabbedDashboard {

  public function buildDashboard() {
    $a = new SalesDashboard();

    $this->addDashboardTab($a);
  }

}

$tabbed = new SampleDashboard();
$tabbed->renderStandalone();
