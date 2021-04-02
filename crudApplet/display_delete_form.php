<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

$page_title = "Are you sure you want to delete?";
include_once "header.php";

# connect
require '../database/database.php';
$pdo = Database::connect();

# put the information for the chosen record into variable $results
$id = $_GET['id'];
$sql = "SELECT * FROM as16persons WHERE id=" . $id;
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetch();

?>
<form method='post' action='delete_record.php?id=<?php echo $id ?>'>
    <div class='form-row pb-1'>
        <div class='col-2'>
            <div class='input-group-text'>Name</div>
        </div>
        <div class='col'>
            <input type='text' class='form-control' value='<?php echo $result['fname'] . ' ' . $result['lname']; ?>' disabled>
        </div>
    </div>
    <input type="submit" name="Yes" value="Yes" />
    <a href="./display_list.php"><input type="button" value="No"></a>
</form>