<?php
session_start();
include_once "./classes/base.php";
include_once "./classes/boat.php";
include_once "./classes/car.php";
include_once "./classes/plane.php";
include_once "./includes/functions.php";
include_once "./includes/vehicle_functions.php";

$vfn = new VehicleFunction();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Awesome Vehicles of the World!</title>
    <link rel="stylesheet" href="assets/css/vehicle.css">
</head>
<body>
<div class="main-container">
    <?php $vfn->showHeader() ?>
    <main>
        <?php
        if(isset($_GET['obj'])){
            if(in_array($_GET['obj'],array_keys($vehicleObjects))){
                $vfn->createObject($_GET['obj']);
            }else{
                $vfn->showInvalid();
            }
        }else{
            $vfn->startOver();
        }
        ?>

    </main>
    <?= $vfn->getFooter() ?>
</div>
</body>
</html>