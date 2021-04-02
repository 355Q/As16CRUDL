<?php
error_reporting(0);
session_start();
require '../database/database.php';
$pdo = Database::connect();

$userInfo = [
	'email' => $_POST['email'],
	'password' => $_POST['password'],
	'role' => $_POST['role'],
	'fname' => $_POST['fname'],
	'lname' => $_POST['lname'],
	'address' => $_POST['address'],
	'address2' => $_POST['address2'],
	'city' => $_POST['city'],
	'state' => $_POST['state'],
	'zip_code' => $_POST['zip_code'],
	'phone' => $_POST['phone'],
];

$userInfo['email'] = htmlspecialchars($userInfo['email']);
$userInfo['password'] = htmlspecialchars($userInfo['password']);
$userInfo['role'] = htmlspecialchars($userInfo['role']);
$userInfo['fname'] = htmlspecialchars($userInfo['fname']);
$userInfo['lname'] = htmlspecialchars($userInfo['lname']);
$userInfo['address'] = htmlspecialchars($userInfo['address']);
$userInfo['address2'] = htmlspecialchars($userInfo['address2']);
$userInfo['city'] = htmlspecialchars($userInfo['city']);
$userInfo['state'] = htmlspecialchars($userInfo['state']);
$userInfo['zip_code'] = htmlspecialchars($userInfo['zip_code']);
$userInfo['phone'] = htmlspecialchars($userInfo['phone']);

$errors = [
	'email' => '',
	'role' => '',
	'password' => '',
];
include_once 'validate.php';

$errors['email'] = validateEmail($userInfo['email'], $pdo);
$errors['role'] = validateRole($userInfo['role']);
$errors['password'] = validatePassword($userInfo['password']);

if (in_array(true, $errors)) {
	header('Location: register.php?' .
		'hasError=true&' .
		'email=' . $userInfo['email'] . '&' .
		'role=' . $userInfo['role'] . '&' .
		'fname=' . $userInfo['fname'] . '&' .
		'lname=' . $userInfo['lname'] . '&' .
		'address=' . $userInfo['address'] . '&' .
		'address2=' . $userInfo['address2'] . '&' .
		'city=' . $userInfo['city'] . '&' .
		'state=' . $userInfo['state'] . '&' .
		'zip_code=' . $userInfo['zip_code'] . '&' .
		'phone=' . $userInfo['phone'] . '&' .
		'emailError=' . $errors['email'] . '&' .
		'roleError=' . $errors['role'] . '&' .
		'passwordError=' . $errors['password']);
} else {
	$password_salt = md5(microtime());
	$password_hash = md5($userInfo['password'] . $password_salt);

	$sql = "INSERT INTO as16persons (email, role, password_hash, password_salt, fname, lname, address, address2, city, state, zip_code, phone) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

	$query = $pdo->prepare($sql);
	$query->execute(array($userInfo['email'], $userInfo['role'], $password_hash, $password_salt, $userInfo['fname'], $userInfo['lname'], $userInfo['address'], $userInfo['address2'], $userInfo['city'], $userInfo['state'], $userInfo['zip_code'], $userInfo['phone']));

	if (isset($_SESSION['role'])) {
		$page_title = "Creation successful";
		include_once "header.php";
		echo "<a class='btn btn-primary' role='button' href='./display_list.php'>Return to list</a>";
	} else {
		$page_title = "Registration successful";
		include_once "header.php";
		echo "<a class='btn btn-primary' role='button' href='./login.php'>Return to login</a>";
	}
}
