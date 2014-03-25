<?php

class SampleDashboard extends StandaloneDashboard {
  protected $pdo;
  public function initialize(){
  	$this->pdo = new PDO("sqlite:".realpath("/Users/swaroop/rf/examples/fixtures/databases/Chinook_Sqlite.sqlite"));
  }

  private function getEmployees () {
  	$query = $this->pdo->query("SELECT Employee.EmployeeId, Employee.FirstName, Employee.LastName, Employee.City, Employee.State, Employee.Country FROM Employee");
  	return  $query->fetchAll(PDO::FETCH_ASSOC);
  }

  private function getByCity($cityName){
    if($cityName == ''){
      $this->getEmployees();
    }
    else{
       $query = $this->pdo->query("SELECT Employee.EmployeeId, Employee.FirstName, Employee.LastName, Employee.City, Employee.State, Employee.Country FROM Employee WHERE Employee.City='$cityName'");
    return  $query->fetchAll(PDO::FETCH_ASSOC); 
    }
  }

  private function populateData($employees){
    $data = array();
    for($i=0; $i<count($employees);$i++){
      $d = array(
        'FirstName' => $employees[$i]['FirstName'],
        'LastName' => $employees[$i]['LastName'],
        'City' => $employees[$i]['City'],
        'State' => $employees[$i]['State'],
        'Country' => $employees[$i]['Country']
      );

      $data []= $d;
    }

    return $data;
  }

  public function buildDashboard () {
    $table = new TableComponent('table1');
    $table->setCaption ("Employees");
    $table->setDimensions (6, 6);
    $employees = $this->getEmployees();
    $table->addColumn ('FirstName', "First Name");
    $table->addColumn ('LastName', "Last Name");
    $table->addColumn ('City', "City");
    $table->addColumn ('State', "State");
    $table->addColumn ('Country', "Country");
    $table->addMultipleRows($this->populateData($employees));

    $this->addComponent($table);

    $filter = new FilterComponent('filter1');
    $filter->setCaption ("Filter Employees");
    $filter->setDimensions (4, 4);
    $filter->addTextFilter ("contains", "City Contains");

    $filter->bindToEvent ("submit", array($table), "handleEmployeesSubmit");


    $this->addComponent($filter);
  }

  public function handleEmployeesSubmit ($source, $target, $params) {
    $cityName = $params->contains;
    $table = $this->getComponentByID("table1");
    $employees = $this->getByCity ($cityName);
    $table->clearRows();
    $table->addMultipleRows($this->populateData($employees));
    $table->setCaption ("Employees that belong live in: ".$cityName);
  }
}

$db = new SampleDashboard();
$db->renderStandalone();
  
