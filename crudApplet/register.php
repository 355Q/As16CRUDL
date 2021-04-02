<?php
session_start();
if (isset($_SESSION['role'])) {
	if ($_SESSION['role'] != 'Admin') {
		header("Location: display_list.php");
	}
	$page_title = "Create";
} else {
	$page_title = "Register";
}
include_once "header.php";
?>

<form method='post' action='register_new_user.php'>
	<div class="form-group">
		<label for="email">Email</label>
		<?php
		if ($_GET['emailError'] != "") {
			echo "<div class='form-row pb-1'>
			<div class='col'>
				<h5 class='text-danger'>" . $_GET['emailError'] . "</h5>
			</div>
		</div>";
		} ?>
		<input class='form-control' id="email" name='email' type='text' <?php echo "value='" . $_GET['email'] . "'"; ?> placeholder="Email address">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<?php
		if ($_GET['passwordError'] != "") {
			echo "<div class='form-row pb-1'>
			<div class='col'>
				<h5 class='text-danger'>" . $_GET['passwordError'] . "</h5>
			</div>
		</div>";
		} ?>
		<input class=' form-control' id="password" name='password' type='password' placeholder="Password">
	</div>
	<div class="form-group">
		<label for="role">Role</label>
		<?php
		if ($_GET['roleError'] != "") {
			echo "<div class='form-row pb-1'>
			<div class='col'>
				<h5 class='text-danger'>" . $_GET['roleError'] . "</h5>
			</div>
		</div>";
		}
		if ($_GET['roleError'] != "") {
			echo '<select id="role" name="role" class="form-control border border-danger">';
			echo '<option ' . ($result['role'] == 'User' ? 'selected' : '') . '>User</option>
                        <option ' . ($result['role'] == 'Admin' ? 'selected' : '') . '>Admin</option>';
		} else {
			echo '<select id="role" name="role" class="form-control">';
			echo '<option ' . ($_GET['role'] == 'User' ? 'selected' : '') . '>User</option>
                        <option ' . ($_GET['role'] == 'Admin' ? "selected" : "") . '>Admin</option>';
		}; ?>
		</select>
	</div>
	<label for="name">Full name</label>
	<div class="form-row" id="name">
		<div class="form-group col">
			<input class='form-control' name='fname' <?php echo "value='" . $_GET['fname'] . "'"; ?> placeholder="First name" type='text'>
		</div>
		<div class="form-group col">
			<input class='form-control' name='lname' <?php echo "value='" . $_GET['lname'] . "'"; ?>placeholder="Last name" type='text'>
		</div>
	</div>
	<div class="form-group">
		<label for="phone">Phone Number</label>
		<input type="tel" class="form-control" id="phone" name="phone" <?php echo "value='" . $_GET['phone'] . "'"; ?> placeholder="(123) 456-7890">
	</div>
	<div class="form-group">
		<label for="address">Address</label>
		<input type="text" class="form-control" id="address" name="address" <?php echo "value='" . $_GET['address'] . "'"; ?> placeholder="1234 Main St">
	</div>
	<div class="form-group">
		<label for="address2">Address 2</label>
		<input type="text" class="form-control" id="address2" name="address2" <?php echo "value='" . $_GET['address2'] . "'"; ?> placeholder="Apartment, studio, or floor">
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="city">City</label>
			<input type="text" class="form-control" name="city" <?php echo "value='" . $_GET['city'] . "'"; ?> placeholder="City" id="city">
		</div>
		<div class="form-group col-md-4">
			<label for="state">State</label>
			<input type="text" class="form-control" name="state" <?php echo "value='" . $_GET['state'] . "'"; ?> placeholder="State" id="state">
		</div>
		<div class="form-group col-md-2">
			<label for="zip_code">Zip</label>
			<input type="text" class="form-control" name="zip_code" <?php echo "value='" . $_GET['zip_code'] . "'"; ?> placeholder="12345" id="zip_code">
		</div>
	</div>
	<?php
	if (isset($_SESSION['role'])) {
		echo "<input class='btn btn-lg btn-primary btn-block' type='submit' value='Create'>
	<a class='btn btn-secondary btn-block' role='button' href='./display_list.php'>Cancel</a>";
	} else {
		echo "<input class='btn btn-lg btn-primary btn-block' type='submit' value='Join'>
	<a class='btn btn-secondary btn-block' role='button' href='./login.php'>Cancel registration</a>";
	}
	?>
</form>