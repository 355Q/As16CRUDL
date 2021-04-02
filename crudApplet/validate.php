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
function validateRole($role, $update = false, $id = null, $pdo = null) {
	if ($update) {
		$sql = "SELECT role FROM as16persons WHERE id='" . $id . "' LIMIT 1";
		$query = $pdo->prepare($sql);
		$query->execute();
		$result = $query->fetch();

		if ($_SESSION['role'] != 'Admin' && $role != $result['role']) {
			return 'Insufficent permissions';
		}
	}
	if ($role != 'Admin' && $role != 'User') {
		return 'Invalid role';
	}
}
function validatePassword($password) { //regex shamelessly coppied from stack overflow
	if (strlen($password) < 16 || !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{16,}$/", $password)) {
		return 'Invalid password! Password must be 16+ chars with at least one of each : upper, lower, number and special character';
	}
}
