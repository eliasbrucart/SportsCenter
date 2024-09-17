<?php

require_once "../../../controllers/reports_controller.php";

require_once "../../../controllers/users_controller.php";
require_once "../../../models/users_model.php";

$report = new ReportsController();
$report->DownloadReport();
