<?php

ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log",  "D:/xampp/htdocs/SportsCenterCRM/php_error_log");

require_once "models/template_model.php";
require_once "models/users_model.php";
require_once "models/cuotas_model.php";
require_once "models/activities_model.php";
require_once "models/history_payments_model.php";

require_once "controllers/template_controller.php";
require_once "controllers/users_controller.php";
require_once "controllers/cuotas_controller.php";
require_once "controllers/activities_controller.php";
require_once "controllers/history_payments_controller.php";

require_once "models/routes.php";

$template = new TemplateController();
$template->GetTemplate();

?>