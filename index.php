<?php

define('ROOT_PATH',     __DIR__);
define('SRC_PATH',      __DIR__     . DIRECTORY_SEPARATOR . 'src');
define('VIEWS_PATH',    SRC_PATH    . DIRECTORY_SEPARATOR . 'Views');

require_once "vendor/autoload.php";

use Commbox\Core\Application;

$Application = new Application();
$Application->run();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Commbox</title>
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="public/bootstrap/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="public/bootstrap/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="public/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="public/css/skins/skin-purple-light.min.css">
        <!-- pace -->
        <link rel="stylesheet" href="public/plugins/pace/pace.min.css">


    </head>
    <body class="hold-transition skin-purple-light sidebar-mini sidebar-collapse">

        <div class="wrapper">
            <?php require_once "src/Views/main/menu.php"; ?>

            <div class="content-wrapper">
                <section class="content">

                    <?php //require_once "src/Views/main/home.php";
                        $Application->Response->render();
                    ?>
                </section>
            </div>

            <footer class="main-footer text-right">
                <strong>Tema utilizado: <a href="http://almsaeedstudio.com">Almsaeed Studio</a></strong>
            </footer>
        </div>

        <script src="public/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="public/plugins/jQueryUI/jquery-ui.min.js"></script>
        <script src="public/bootstrap/js/bootstrap.min.js"></script>
        <script src="public/js/AdminLTEApp.min.js"></script>
        <script src="public/plugins/pace/pace.min.js"></script>
        <script src="public/js/app.js"></script>
    </body>
</html>

