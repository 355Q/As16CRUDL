 <!DOCTYPE html>
 <html lang="en">

 <?php
	error_reporting(0);
	session_start();

	if (isset($_GET['darkModeToggle']) && !isset($_GET['login'])) {
		$_SESSION['darkMode'] = !$_SESSION['darkMode'];
	}
	?>

 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">

 	<title><?php echo $page_title; ?></title>

 	<link rel="stylesheet" href="../css/toggle-bootstrap.css" />
 	<link rel="stylesheet" href="../css/toggle-bootstrap-dark.css" />
 </head>

 <body class="bootstrap<?php echo ($_SESSION['darkMode'] ? '-dark' : ''); ?>">
 	<div class="container">
 		<?php
			echo "<div class='row'><div class=col-9><div class='page-header'>
				<h1>{$page_title}</h1>
				</div></div>";
			if ($page_title == 'People List' || $page_title == 'Login') echo "<div class='col-3 d-flex justify-content-end align-items-center'>
					<a class='btn btn-secondary mr-1' target='_blank' role='button' href='https://github.com/355Q/As16CRUDL'>Github repo</a>
				<form method='get'>
					 <input type='submit' name='darkModeToggle' value='Dark mode' class='btn btn-dark'></button>
				</form></div>"; ?>
 	</div>