<?php
//Function utilities

function isAllowed(){
    if(!isset($_SESSION['user'])) {
        header("Location: index.php");
    }
}
function showHeader(){
    $login = "Guest";
    if(isset($_SESSION['user'])){
        $login = $_SESSION['user'];
    }
    ?>
    <header>
        <h1>Awesome Guestbook</h1>
        <?= getTopNav() ?>
        <div class='login_user'><p>Hi <?= $login ?></p></div>
    </header>
    <?php
}

function getTopNav()
{
    $access = "";
    if(!isset($_SESSION['user'])){
        $access .= "
        <li><a href='register.php'>Register</a></li>
        <li><a href='login.php'>Login</a></li>
        ";
    }else{
        $access .= "
        <li><a href='logout.php'>Logout</a></li>
        ";
    }

    return "
    <nav>
    <ul>
        <li><a href='index.php'>Home</a></li>
        <li><a href='view.php'>View Guestbook</a></li>
        <li><a href='signup.php'>Sign Guestbook</a></li>
        $access
    </ul>
    </nav>
    ";
}

function getFooter()
{
    return "<footer>&copy;2020 Christian Hur. I own this!</footer>";
}

function showGuestBook($handle, $table)
{
    ?>

    <table class="guestbook_table" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Comment</th>
            <?php
            if(isset($_SESSION['user'])){ ?>
            <th>Actions</th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = getAllRecords($handle, $table);
        $counter = 1;
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?= $counter++; ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['comment'] ?></td>
            <?php
            if(isset($_SESSION['user'])){ ?>
                <td>
                    <ul>
                        <li><a href="edit.php?id=<?= $row['id'] ?>">Edit</a></li>
                        <li><a href="delete.php?id=<?= $row['id'] ?>">Delete</a></li>
                    </ul>
                </td>
            <?php } ?>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <?php
}

function showGuestBookForm()
{
    ?>
    <form name="guest_book" id="guest_book" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="guestbook_controls">
            <label for="name">Name:</label>
            <input name="name" id="name">
        </div>
        <div class="guestbook_controls">
            <label for="email">Email:</label>
            <input name="email" id="email">
        </div>
        <div class="guestbook_controls">
            <label for="comment">Comment:</label>
            <textarea name="comment" id="name"></textarea>
        </div>
        <div class="guestbook_controls">
            <input class="btn-submit" type="submit" name="submit">
            <input class="btn-reset" type="reset" name="reset" value="Start Over">
        </div>
    </form>
    <?php
}

function showEditForm($result)
{
    $row = mysqli_fetch_array($result);
    ?>
    <form name="guest_book" id="guest_book" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" name="id" id="id" value="<?= $row['id'] ?>">
        <div class="guestbook_controls">
            <label for="name">Name:</label>
            <input name="name" id="name" value="<?= $row['name'] ?>">
        </div>
        <div class="guestbook_controls">
            <label for="email">Email:</label>
            <input name="email" id="email" value="<?= $row['email'] ?>">
        </div>
        <div class="guestbook_controls">
            <label for="comment">Comment:</label>
            <textarea name="comment" id="name"><?= $row['comment'] ?></textarea>
        </div>
        <div class="guestbook_controls">
            <input class="btn-submit" type="submit" name="submit">
            <input class="btn-reset" type="reset" name="reset" value="Start Over">
        </div>
    </form>
    <?php
}

//Users

function showUserRegistrationForm()
{
    ?>
    <p>All fields are required</p>
    <form name="user_registration" id="user_registration" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="user_controls">
            <label for="name">Name:</label>
            <input name="name" id="name"> *
        </div>
        <div class="user_controls">
            <label for="password">Password:</label>
            <input name="password" id="password1"> *
        </div>
        <div class="user_controls">
            <label for="confirm_password">Re-Enter Password:</label>
            <input name="confirm_password" id="confirm_password"> *
        </div>

        <div class="user_controls">
            <input class="btn-submit" type="submit" name="submit" value="Sign me up!">
            <input class="btn-reset" type="reset" name="reset" value="Start Over">
        </div>
    </form>
    <?php

}

// Login form
function showLoginForm()
{
    ?>
    <form name="login_form" id="login_form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="guestbook_controls">
            <label for="username">Username:</label>
            <input name="username" id="username" required>
        </div>
        <div class="guestbook_controls">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="guestbook_controls">
            <p>Don't have an account? Register <a href="register.php">here</a></p>
        </div>
        <div class="guestbook_controls">
            <input class="btn-submit" type="submit" name="submit">
            <input class="btn-reset" type="reset" name="reset" value="Start Over">
        </div>
    </form>
    <?php
}

//User Registration
function showRegistrationForm()
{
    ?>
    <form name="guest_book" id="guest_book" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="guestbook_controls">
            <label for="username">username:</label>
            <input name="username" id="username">
        </div>
        <div class="guestbook_controls">
            <label for="email">Email:</label>
            <input name="email" id="email">
        </div>
        <div class="guestbook_controls">
            <label for="password">password:</label>
            <input name="password" id="password">
        </div>
        <div class="guestbook_controls">
            <label for="confirm_password">confirm password:</label>
            <input name="confirm_password" id="confirm_password">
        </div>

        <div class="guestbook_controls">
            <input class="btn-submit" type="submit" name="submit">
            <input class="btn-reset" type="reset" name="reset" value="Start Over">
        </div>
    </form>
    <?php
}