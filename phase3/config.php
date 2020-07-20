<?php
//error_reporting(0);

//Turn on session
session_start();

//Include dependencies
include_once "includes/db.php";
include_once "includes/functions.php";
include_once "includes/guestbook_functions.php";

$token = "user";
$location = "index.php";

$db_handle = new DB();
$gfn = new GuestbookFunctions();