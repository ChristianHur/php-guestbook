<?php
    include_once "config.php";

    $gfn->isAllowed($token,$location);

    $message = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        try{
            $result = $db_handle->deleteOneRecord($id,TABLE_GUEST);
            if($result){
                $message = "The record was deleted!";
            }else{
                throw new Exception("The record could not be deleted.");
            }
        }catch(Exception $e){
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
    </main>
    <?= $gfn->getFooter() ?>
</div>
</body>
</html>
<?php
$db_handle->close();