<?php
session_start();

function validateEmail($email, $pdo) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return 'Invalid email';
	} else {
		$sql = "SELECT id FROM as16persons WHERE email='" . $email . "' LIMIT 1";
		$query = $pdo->prepare($sql);
		$query->execute();
		$emailResult = $query->fetch();

		if (isset($emailResult['id'])) {
			return 'Email is already in use';
		}
	}
}
function validateRole($role) {
	if ($_SESSION['role'] != 'Admin') {
		return 'Insufficent permissions';
	} else if ($role != 'Admin' && $role != 'User') {
		return 'Invalid role';
	}
}
