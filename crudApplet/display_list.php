<?php
session_start();
if (!isset($_SESSION['email'])) {
	header("Location: login.php");
}

# connect
require '../database/database.php';
$pdo = Database::connect();

$page_title = "People List";
include_once "header.php";

?>
<div class='row'>
	<div class='col-auto pt-1 pr-1'>
		<a class='btn btn-danger' role='button' href='./logout.php'>Logout</a>
	</div>
	<div class='col pl-1'>
		<p class='mb-2'>Logged in as: <?php echo $_SESSION['email']; ?></br>
			Role: <?php echo $_SESSION['role']; ?></p>
	</div>
</div>
<?php
if ($_SESSION['role'] == 'Admin')
	echo "<div class='row mb-1'><a class='btn btn-primary btn-block' role='button' href='./register.php'>Create</a></div>";


# display all records
$sql = 'SELECT fname, lname, id FROM as16persons';
foreach ($pdo->query($sql) as $row) {
	$str = "<div class='row'>";
	$str .= "<div class='col-auto p-1'><a class='btn-sm btn-info' role='button' href='display_read_form.php?id=" . $row['id'] . "'>Read</a></div> ";
	if ($_SESSION['role'] == 'Admin' || $_SESSION['id'] == $row['id'])
		$str .= "<div class='col-auto p-1'><a class='btn-sm btn-secondary' role='button' href='display_update_form.php?id="  . $row['id'] . "'>Update</a></div> ";
	if ($_SESSION['role'] == 'Admin')
		$str .= "<div class='col-auto p-1'><a class='btn-sm btn-danger' role='button' href='display_delete_form.php?id=" . $row['id'] . "'>Delete</a></div> ";
	$str .= "<div class='col-auto'><p class='pt-1 mb-1'>" . $row['fname'] . ' ' . $row['lname'];
	$str .=  '</p></div></div>';
	echo $str;
}
echo '<br /></div>';
