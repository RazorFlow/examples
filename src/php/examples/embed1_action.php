<?php

require 'embedded_db.php';

$db = new MyDashboard();
$db->renderEmbedded();
// require 'dashboards.php';
//
// $db = new Tabbed();
// $db->renderEmbedded();
