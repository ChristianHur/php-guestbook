<?php
session_start();
//$light = $_GET['light'];
//$light = $_POST['light'];
$light = $_SESSION['light'];
echo "State: $light \n";
$_SESSION['light'] = 50;
?>
<h1>
<a href="p1.php">P1</a>
</h1>
<h1>
    <a href="p3.php">P3</a>
</h1>