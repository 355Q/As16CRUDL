<?php
session_start();
if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
	$_POST['email'] = htmlspecialchars($_POST['email']);
	$_POST['password'] = htmlspecialchars($_POST['password']);

	require '../database/database.php';
	$pdo = Database::connect();
	$sql = "SELECT email, role, password_hash, password_salt, id FROM as16persons "
		. "WHERE email=? "
		. " LIMIT 1";
	$query = $pdo->prepare($sql);
	$query->execute(array($_POST['email']));
	$result = $query->fetch(PDO::FETCH_ASSOC);

	if ($result) {
		$password_hash = md5($_POST['password'] . $result['password_salt']);
		if ($password_hash == $result['password_hash']) {
			$_SESSION['email'] = $result['email'];
			$_SESSION['role'] = $result['role'];
			$_SESSION['id'] = $result['id'];
			header('Location: display_list.php');
		} else {
			$errMsg = 'Login failure: wrong email or password';
		}
	} else {
		$errMsg = 'Login failure: wrong email or password';
	}
}

if (!isset($_SESSION['darkMode'])) $_SESSION['darkMode'] = true;

$page_title = "Login";
include_once "header.php";
?>

<form action="" method="post">
	<?php if (isset($errMsg)) echo '<p style="color:red;">' . $errMsg . "</p>"; ?>
	<input type="text" class="form-control" name="email" placeholder="Email address" required autofocus /> <br />
	<input type="password" class="form-control" name="password" placeholder="Password" required autofocus /> <br />
	<button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
	<button class="btn btn-lg btn-secondary btn-block" onclick="window.location.href = 'register.php'" type="button" name="join">Join</button>
</form>

</div>
</body>

</html>