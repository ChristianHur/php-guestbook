<?php
include_once "config.php";
$errors = [];
$message = "";
$showForm = true;
if(isset($_POST['submit'])){
    unset($_POST['submit']);


    foreach ($_POST as $key=>$item){
        $item = trim($item);
        if(strlen($item) == 0){
            $errors[] = ucfirst($key) . " is invalid.";
        }else{
            $_POST[$key] = $item;
        }
    }
    if(!$errors) {
        $password=trim($_POST['password']);
        $confirm_password=trim($_POST['confirm_password']);

        if($password == $confirm_password) {
            unset($_POST['confirm_password']);
            $_POST['password'] = password_hash($password,PASSWORD_DEFAULT);
            try {
                if (insertOneRecord($conn, TABLE_USERS, $_POST)) {
                    $message = "Thank you for registering!";
                    $showForm = false;
                } else {
                    throw new Exception("Sorry, something went wrong.  Unable to create user.");
                }
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }else{
            $errors[] = "Passwords do not match.";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Awesome Guestbook</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<div class="main-container">
    <?php showHeader() ?>
    <main>
        <h1><?= $message ?></h1>
        <div class="error-messages">
            <?php
            foreach ($errors as $error) {
                echo "<span>* $error</span><br>";
            }
            ?>
        </div>

        <?php
        if($showForm){
            showRegistrationForm();
        }
        ?>

    </main>
    <footer>
        <?= getFooter() ?>
    </footer>
</div>
</body>
</html>