<?php

require 'dashboards.php';

global $razorflow_assets;
$db = new MyDashboard();
$db->setActionPath('http://localhost:8085/dev/php/examples/tabbed_embedded_action');

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
