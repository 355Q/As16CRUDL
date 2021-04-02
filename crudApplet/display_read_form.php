<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

$page_title = "Read/view Person";
include_once "header.php";

# connect
require '../database/database.php';
$pdo = Database::connect();

# put the information for the chosen record into variable $results 
$id = $_GET['id'];
$sql = "SELECT fname,lname,email,role,phone,address,address2,city,state,zip_code FROM as16persons WHERE id=" . $id;
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetch();

$formattedResult = [
    'First name' => $result['fname'],
    'Last name' => $result['lname'],
    'Email' => $result['email'],
    'Role' => $result['role'],
    'Phone' => $result['phone'],
    'Address' => $result['address'],
    'Address 2' => $result['address2'],
    'City' => $result['city'],
    'State' => $result['state'],
    'Zip code' => $result['zip_code'],
]
?>
<form method='post' action='display_list.php'>
    <?php
    foreach ($formattedResult as $key => $value) {
        echo
            "<div class='form-row pb-1'>
                <div class='col-2'>
                    <div class='input-group-text'>$key</div>
                </div>
                <div class='col'>
                    <input type='text' class='form-control' value='$value' disabled>
                </div>
            </div>
            ";
    }
    ?>
    <div class='form-group'>
        <input class='btn btn-primary' type="submit" value="Return">
    </div>
</form>