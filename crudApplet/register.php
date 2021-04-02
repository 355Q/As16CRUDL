<?php
$page_title = "Register";
include_once "header.php";
?>

<form method='post' action='register_new_user.php'>
	<div class="form-group">
		<label for="email">Email</label>
		<input class='form-control' id="email" name='email' type='email' placeholder="Email address" required>
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input class='form-control' id="password" name='password' type='password' placeholder="Password" required>
	</div>
	<div class="form-group">
		<label for="role">Role</label>
		<select id="role" name="role" class="form-control">
			<option selected>User</option>
			<option>Admin</option>
		</select>
	</div>
	<label for="name">Full name</label>
	<div class="form-row" id="name">
		<div class="form-group col">
			<input class='form-control' name='fname' placeholder="First name" type='text'>
		</div>
		<div class="form-group col">
			<input class='form-control' name='lname' placeholder="Last name" type='text'>
		</div>
	</div>
	<div class="form-group">
		<label for="phone">Phone Number</label>
		<input type="tel" class="form-control" id="phone" name="phone" placeholder="(123) 456-7890">
	</div>
	<div class="form-group">
		<label for="address">Address</label>
		<input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
	</div>
	<div class="form-group">
		<label for="address2">Address 2</label>
		<input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment, studio, or floor">
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="city">City</label>
			<input type="text" class="form-control" name="city" placeholder="City" id="city">
		</div>
		<div class="form-group col-md-4">
			<label for="state">State</label>
			<input type="text" class="form-control" name="state" placeholder="State" id="state">
		</div>
		<div class="form-group col-md-2">
			<label for="zip_code">Zip</label>
			<input type="text" class="form-control" name="zip_code" placeholder="12345" id="zip_code">
		</div>
	</div>
	<input class='btn btn-lg btn-primary btn-block' type='submit' value='Join'>
	<a class='btn btn-secondary btn-block' role='button' href='./login.php'>Cancel registration</a>
</form>