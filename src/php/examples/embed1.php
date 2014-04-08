<?php

global $razorflow_assets;

class MyDashboard extends EmbeddedDashboard {
	public function buildDashboard(){
    $chart = new ChartComponent("pie_chart");
    $chart->setCaption("Monthly Unit Distribution");
    $chart->setDimensions (4, 4);
    $chart->setLabels (["Jan", "Feb", "Mar"]);
    $chart->setPieValues ([10, 14, 13]);

    $this->addComponent ($chart);
    $this->setWidth(400);
    $this->setHeight(300);
  }
}
$db = new MyDashboard();
?>
<!doctype html>
<html>
	<head>
        <?php 
        // Replace this block with your own CSS/JS Includes
        echo $razorflow_assets;
        ?>
    </head>
	<body>
	<h1>Here's an embedded dashboard</h1>
	<?php $db->renderEmbedded (); ?>
	</body>
<script>
	require(["wrapperhelpers/wrappermain"], function () {
		renderDashboard();
	})
</script>
</html>
