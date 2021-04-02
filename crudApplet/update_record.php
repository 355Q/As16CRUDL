<?php
# This process updates a record. There is no display.

# 1. connect to database
require '../database/database.php';
$pdo = Database::connect();

# 2. assign user info to a variable
$userInfo = [
	'id' => $_GET['id'],
	'email' => $_POST['email'],
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
$userInfo['role'] = htmlspecialchars($userInfo['role']);
$userInfo['fname'] = htmlspecialchars($userInfo['fname']);
$userInfo['lname'] = htmlspecialchars($userInfo['lname']);
$userInfo['address'] = htmlspecialchars($userInfo['address']);
$userInfo['address2'] = htmlspecialchars($userInfo['address2']);
$userInfo['city'] = htmlspecialchars($userInfo['city']);
$userInfo['state'] = htmlspecialchars($userInfo['state']);
$userInfo['zip_code'] = htmlspecialchars($userInfo['zip_code']);
$userInfo['phone'] = htmlspecialchars($userInfo['phone']);

$changedArray = [
	'email' => false,
	'role' => false,
	'fname' => false,
	'lname' => false,
	'address' => false,
	'address2' => false,
	'city' => false,
	'state' => false,
	'zip_code' => false,
	'phone' => false,
];
$sql = "SELECT fname,lname,email,role,phone,address,address2,city,state,zip_code FROM as16persons WHERE id=" . $userInfo['id'];
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetch();

foreach ($result as $key => $value) {
	if (isset($userInfo[$key])) {
		if ($userInfo[$key] != $value) {
			$changedArray[$key] = true;
		} else {
			unset($changedArray[$key]);
		}
	}
}

if (in_array(true, $changedArray)) {
	$errors = [
		'email' => "",
		'role' => "",
	];
	include_once 'validate.php';

	if (isset($changedArray['email'])) {
		$errors['email'] = validateEmail($userInfo['email'], $pdo);
	}
	if (isset($changedArray['role'])) {
		$errors['role'] = validateRole($userInfo['role']);
	}

	if (in_array(true, $errors)) {
		header('Location: display_update_form.php?' .
			'hasError=true&' .
			'id=' . $userInfo['id'] . '&' .
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
			'roleError=' . $errors['role']);
	} else {
		$sql = "UPDATE as16persons SET ";
		foreach ($changedArray as $key => $value) {
			$sql .= $key . "='" . $userInfo[$key] . "', ";
		}
		$sql = chop($sql, ", ");
		$sql .= "  WHERE id=" . $userInfo['id'];

		$pdo->query($sql);

		$page_title = "The info has been updated";
		include_once "header.php";
		echo "<a class='btn btn-primary' role='button' href='./display_list.php'>Back to list</a>";
	}
} else {
	$page_title = "No info changed";
	include_once "header.php";
	echo "<a class='btn btn-primary' role='button' href='./display_list.php'>Back to list</a>";
}
