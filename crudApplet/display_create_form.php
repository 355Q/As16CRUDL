<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$page_title = "Create/add new message";
include_once "header.php";
?>
<form method='post' action='insert_record.php'>
    message: <input name='msg' type='text'><br />
    <input type="submit" value="Submit">
</form>