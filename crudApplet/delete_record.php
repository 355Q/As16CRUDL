<?php
session_start();
# This process deletes a record. There is no display.

# 1. connect to database
require '../database/database.php';
$pdo = Database::connect();

# 2. assign user info to a variable
$id = $_GET['id'];

# 3. assign MySQL query code to a variable
$sql = "DELETE FROM as16persons WHERE id=$id";

# 4. update the message in the database
$pdo->query($sql); # execute the query

#unsets email incase the user tries to navigate to another page without logging out
#if a user deletes their own account they should no longer have access
if ($_SESSION['id'] == $id) $_SESSION['email'] = null;

$page_title = "Record has been deleted";
include_once "header.php";

echo "<a class='btn btn-primary' role='button' href='" . ($id == $_SESSION['id'] ? 'logout.php' : 'display_list.php') . "'>Return</a>";
