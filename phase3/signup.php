<?php
    include_once "config.php";
    $message = "Please sign my guestbook. It's free!";
    $showForm = true;
    if(isset($_POST['submit'])){
        try{
            unset($_POST['submit']);
            if($db_handle->insertOneRecord(TABLE_GUEST,$_POST)){
                $message = "Thank you for signing our awesome guestbook!";
                $showForm=false;
            }else{
                throw new Exception("Sorry, something went wrong.  Unable to sign guestbook.");
            }
        }catch (Exception $e){
            $message = $e->getMessage();
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
    <?php $gfn->showHeader() ?>
    <main>
        <h1><?= $message ?></h1>

        <?php
        if($showForm){
            $gfn->showGuestBookForm();
        }
        ?>

    </main>
    <?= $gfn->getFooter() ?>
</div>
</body>
</html>
<?php
$db_handle->close();