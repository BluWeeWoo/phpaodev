<?php
include("connections.php");

$name = $address = $email = "";
$nameErr = $addressErr = $emailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $valid = true;

    if (empty($_POST["name"])) {
        $nameErr = "Name is required!";
        $valid = false;
    } else {
        $name = $_POST["name"];
    }

    if (empty($_POST["address"])) {
        $addressErr = "Address is required!";
        $valid = false;
    } else {
        $address = $_POST["address"];
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required!";
        $valid = false;
    } else {
        $email = $_POST["email"];
    }

    if ($valid) {
        $query = mysqli_query($connections, "INSERT INTO mytbl(name, address, email) VALUES('$name', '$address', '$email')");
        echo "<script>alert('New Record has been inserted!'); window.location.href='index.php';</script>";
        exit;
    }
}
?>

<style>
    .error {
        color: red;
    }
</style>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="text" name="name" value="<?php echo $name; ?>"> <br>
    <span class="error"><?php echo $nameErr; ?></span> <br>

    <input type="text" name="address" value="<?php echo $address; ?>"> <br>
    <span class="error"><?php echo $addressErr; ?></span> <br>

    <input type="text" name="email" value="<?php echo $email; ?>"> <br>
    <span class="error"><?php echo $emailErr; ?></span> <br>

    <input type="submit" name="Submit" value="Submit">
</form>

<hr>

<?php
$view_query = mysqli_query($connections, "SELECT * FROM mytbl");

echo "<table border='1' width='50%'>
<tr>
    <th>Name</th>
    <th>Address</th>
    <th>Email</th>
    <th>Option</th>
</tr>";

while ($row = mysqli_fetch_assoc($view_query)) {
    $user_id = $row["id"];
    $db_name = $row["name"];
    $db_address = $row["address"];
    $db_email = $row["email"];

    echo "<tr>
        <td>$db_name</td>
        <td>$db_address</td>
        <td>$db_email</td>
        <td><a href='Edit.php?id=$user_id'>Update</a>

        &nbsp;
        <a href='ConfirmDelete.php?id=$user_id'>Delete</a>
        </td>


    </tr>";
}

echo "</table>";
?>
