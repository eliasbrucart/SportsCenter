<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sports Center CRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php
        session_start();
        $url = Route::GetFrontendRoute();

        $server = Route::GetBackendRoute();
    ?>
    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo $url;?>views/css/plugins/bootstrap5/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="<?php echo $url;?>views/css/plugins/bootstrap5/style.css" rel="stylesheet">

    <!-- Bootstrap 4 -->
    <!--<link rel="stylesheet" href="<?php echo $url; ?>views/css/plugins/bootstrap.min.css">-->
    <link rel="stylesheet" href="<?php echo $url; ?>views/css/plugins/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo $url; ?>views/css/plugins/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/plugins/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/plugins/lightgallery.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/plugins/sweetalert.css" rel="stylesheet">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo $url;?>views/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo $url;?>views/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="<?php echo $url;?>views/css/template/style.css" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo $url; ?>views/css/signup.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/upload_module.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/admin_module.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/activities_module.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/resume_module.css">
	<link rel="stylesheet" href="<?php echo $url; ?>views/css/header_module.css">

    <script src="<?php echo $url; ?>views/js/plugins/jquery.min.js"></script>
	<script src="<?php echo $url; ?>views/js/plugins/bootstrap.min.js"></script>
	<script src="<?php echo $url; ?>views/js/plugins/jquery.easing.js"></script>
    <script src="<?php echo $url; ?>views/js/plugins/bootstrap.bundle.min.js"></script>
	<!--<script src="<?php echo $url; ?>views/js/plugins/bootstrap5/bootstrap.bundle.min.js"></script>-->
	<script src="<?php echo $url; ?>views/js/plugins/md5-min.js"></script>
	<script src="<?php echo $url; ?>views/js/plugins/sweetalert.min.js"></script>
    <!-- Data tables libraries -->
	<script src="<?php echo $url; ?>views/lib/browser_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo $url; ?>views/lib/browser_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo $url; ?>views/lib/browser_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo $url; ?>views/lib/browser_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

    <input type="hidden" value="<?php echo $url; ?>" id="hiddenPath">

    
</head>
<body onload="CalculateExpiration()">
    <?php

    $routes = array();
    $route = null;

    if(isset($_GET["ruta"])){
        $routes = explode("/", $_GET["ruta"]);
        
        if($route != null || $routes[0] == "login" || $routes[0] == "income"){
            include "modules/".$routes[0]."/".$routes[0]."_module.php";
        }else if(isset($_SESSION["validateSession"]) && $_SESSION["validateSession"] == "ok"){
            echo '<div class="content">';
            include "modules/sidebar/sidebar_module.php";
            include "modules/header/header_module.php";
            if($routes[0] == "logout" || $routes[0] == "activities" || $routes[0] == "resume"){
                include "modules/".$routes[0]."/".$routes[0]."_module.php";
            }
            if($routes[0] == "admin"){
                //echo '<div class="content">';
                include "modules/upload/upload_module.php"; //parte del admin
                include "modules/".$routes[0]."/".$routes[0]."_module.php"; //Que admin module incluya todos los ficheros necesarios
                //echo '</div>';
            }
        }else if($routes[0] == "signup"){ //quitar cuando sea produccion
            include "modules/".$routes[0]."/".$routes[0]."_module.php";
        }
        echo '</div>';
    }else{
        include "modules/login/login_module.php";
    }

    ?>

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo $url;?>views/lib/chart/chart.min.js"></script>
    <script src="<?php echo $url;?>views/lib/easing/easing.min.js"></script>
    <script src="<?php echo $url;?>views/lib/waypoints/waypoints.min.js"></script>
    <script src="<?php echo $url;?>views/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?php echo $url;?>views/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?php echo $url;?>views/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?php echo $url;?>views/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="<?php echo $url;?>views/js/template.js" type="text/javascript"></script>

    <script src="<?php echo $url;?>views/js/admin_module.js" type="text/javascript"></script>
    <script src="<?php echo $url;?>views/js/activities_module.js" type="text/javascript"></script>
    <script src="<?php echo $url;?>views/js/history_payments.js" type="text/javascript"></script>
    <script src="<?php echo $url;?>views/js/resume_module.js" type="text/javascript"></script>

    <!-- Template Javascript -->
    <script src="<?php echo $url; ?>views/js/main.js"></script>

</body>
</html>