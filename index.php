<?php
    include __DIR__ . "/bootstrap/atuoload.php";

    $homeController = new \App\Controller\HomeController();
    echo $homeController->index();

?>
