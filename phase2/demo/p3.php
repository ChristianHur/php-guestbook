<?php
session_start();
//$light = $_GET['light'];
//$light = $_POST['light'];
$light = $_SESSION['light'];
echo "State: $light \n";

session_destroy();
?>
<h1>
<a href="p1.php">P1</a>
</h1>
<h1>
    <a href="p2.php">P2</a>
</h1>