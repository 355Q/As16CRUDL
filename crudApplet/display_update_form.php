<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

$page_title = "Update Person";
include_once "header.php";

# connect
require '../database/database.php';
$pdo = Database::connect();

# put the information for the chosen record into variable $results 
$id = $_GET['id'];
if ($_SESSION['role'] != 'Admin' && $id != $_SESSION['id']) {
    echo "<h1 style='color:red'>Error: Insufficent permissions</h1><a class='btn-sm btn-secondary' role='button' href='display_list.php'>Return</a>";
} else {
    $sql = "SELECT fname,lname,email,role,phone,address,address2,city,state,zip_code FROM as16persons WHERE id=" . $id;
    $query = $pdo->prepare($sql);
    $query->execute();
    $result = $query->fetch();

    $formattedResult = [
        'First name' => 'fname',
        'Last name' => 'lname',
        'Email' => 'email',
        'Role' => 'role',
        'Phone' => 'phone',
        'Address' => 'address',
        'Address 2' => 'address2',
        'City' => 'city',
        'State' => 'state',
        'Zip code' => 'zip_code',
    ];

    echo "<form method='post' action='update_record.php?id=$id'>";

    foreach ($formattedResult as $key => $value) {
        if ($key == 'Role') {
            if ($_GET['roleError'] != "") {
                echo "<div class='form-row pb-1'>
                <div class='col-2'></div><div class='col'>
                <h5 class='text-danger'>" . $_GET['roleError'] . "</h5></div></div>";
            }
        } else if ($key == 'Email') {
            if ($_GET['emailError'] != "") {
                echo "<div class='form-row pb-1'>
                <div class='col-2'></div><div class='col'>
                <h5 class='text-danger'>" . $_GET['emailError'] . "</h5></div></div>";
            }
        }
        echo
            "<div class='form-row pb-1'>
                <div class='col-2'>
                    <div class='input-group-text'>$key</div>
                </div>
                <div class='col'>
                ";
        if ($key == 'Role') {
            if ($_GET['hasError'] != "") {
                if ($_GET['roleError'] != "") {
                    echo '<select id="role" name="role" class="form-control border border-danger"' . ($_SESSION["role"] == "Admin" ? "" : "disabled") . '>';
                    echo '<option ' . ($result['role'] == 'User' ? 'selected' : '') . '>User</option>
                        <option ' . ($result['role'] == 'Admin' ? 'selected' : '') . '>Admin</option>';
                } else {
                    echo '<select id="role" name="role" class="form-control"' . ($_SESSION["role"] == "Admin" ? "" : "disabled") . '>';
                    echo '<option ' . ($_GET['role'] == 'User' ? 'selected' : '') . '>User</option>
                        <option ' . ($_GET['role'] == 'Admin' ? "selected" : "") . '>Admin</option>';
                }
            } else {
                echo '<select id="role" name="role" class="form-control"' . ($_SESSION["role"] == "Admin" ? "" : "disabled") . '>
                <option ' . ($result["role"] == "User" ? "selected" : "") . '>User</option>
                <option ' . ($result["role"] == "Admin" ? "selected" : "") . '>Admin</option>';
            }
            echo '</select>';
        } else {
            if ($_GET['hasError'] != "") {
                if ($key == 'Phone') {
                    echo "<input type='tel' class='form-control' name='$value' value='$_GET[$value]'>";
                } else if ($key == 'Email') {
                    if ($_GET['emailError'] != "") {
                        echo "<input type='text' class='form-control border border-danger' name='$value' value=''>";
                    } else {
                        echo "<input type='text' class='form-control' name='$value' value='$_GET[$value]'>";
                    }
                } else {
                    echo "<input type='text' class='form-control' name='$value' value='$_GET[$value]'>";
                }
            } else {
                if ($key == 'Phone')
                    echo "<input type='tel' class='form-control' name='$value' value='$result[$value]'>";
                else
                    echo "<input type='text' class='form-control' name='$value' value='$result[$value]'>";
            }
        }
        echo
            "</div>
            </div>
             ";
    }
?>
    <div class='form-group'>
        <input class='btn btn-primary' type="submit" value="Update">
        <a class='btn btn-secondary' role='button' href='./display_list.php'>Cancel update</a>
    </div>
    </form>
<?php

}
