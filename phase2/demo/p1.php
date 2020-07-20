<?php
session_start();

//$light = 0;  //off state

//echo "State: $light \n";

function fx()
{
    //global $light;
    $light = 10;
    //$GLOBALS['light']=$light;
    echo "Local State: $light \n";
    //return $light;
    $_SESSION['light'] = $light;
}
fx();

//$light = fx();
$light = $_SESSION['light'];
echo "State: $light \n";
?>
<h1>
<a href="p2.php?light=<?=$light?>">P2</a>
</h1>
<h1>
<form method="post" action="p2.php">
    <input type="hidden" name="light" value="<?= $light ?>">
    <button>Page 2</button>
</form>
</h1>
