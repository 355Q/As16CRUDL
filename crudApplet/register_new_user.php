<?php
require '../database/database.php';
$pdo = Database::connect();

$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$address = $_POST['address'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip_code'];
$phone = $_POST['phone'];
$email = htmlspecialchars($email);
$password = htmlspecialchars($password);
$role = htmlspecialchars($role);
$fname = htmlspecialchars($fname);
$lname = htmlspecialchars($lname);
$address = htmlspecialchars($address);
$address2 = htmlspecialchars($address2);
$city = htmlspecialchars($city);
$state = htmlspecialchars($state);
$zip = htmlspecialchars($zip);
$phone = htmlspecialchars($phone);


$sql = "SELECT id FROM as16persons WHERE email='$email'";

#if ($pdo->query($sql) || $email == '') {
#echo "<p>An account with this email already exists.</p><br>";
#
#
#
#Check and return to  register with filled values
#FIX CHECKS FOR USERNAME AND PASS
#
#
#} else {

$password_salt = md5(microtime());
$password_hash = md5($password . $password_salt);


$sql = "INSERT INTO as16persons (email, role, password_hash, password_salt, fname, lname, address, address2, city, state, zip_code, phone) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

$query = $pdo->prepare($sql);
$query->execute(array($email, $role, $password_hash, $password_salt, $fname, $lname, $address, $address2, $city, $state, $zip, $phone));

$page_title = "Registration successful";
include_once "header.php";
echo "<a class='btn btn-primary' role='button' href='./login.php'>Return to login</a>";
#}
