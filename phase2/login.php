<?php
include "config.php";

//$_SESSION['user'] = 'Christian';
$showForm = true;
$message = "";
if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    try {
        if (strlen($username) > 0 && strlen($password) > 0) {
            $validPass = verifyPassword($conn, $username, $password, "users");
            if ($validPass) {
                $_SESSION['user'] = $username;
                // Redirect user to home page
                header("Location: index.php");
            } else {
                throw new Exception("Hmmm...something went wrong.  Try again.");
            }
        }
    }catch(Exception $e){
        $message = $e->getMessage();
    }

}
// Redirect user to home page
//header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<div class="main-container">
    <?php showHeader() ?>
    <main>
        <h1>Login</h1>
        <div class="error-messages">
            <p>* <?= $message ?></p>
        </div>

        <?php
        if($showForm){
            showLoginForm();
        }
        ?>

    </main>
    <footer>
        <?= getFooter() ?>
    </footer>
</div>
</body>
</html>
