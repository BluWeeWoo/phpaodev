<?php
include("connections.php");

$name = $address = $email = $password = $cpassword = "";
$nameErr = $addressErr = $emailErr = $passwordErr = $cpasswordErr = "";

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

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required!";
        $valid = false;
    } else {
        $password = $_POST["password"];
    }

    if (empty($_POST["cpassword"])) {
        $cpasswordErr = "Confirm Password is required!";
        $valid = false;
    } else {
        $cpassword = $_POST["cpassword"];
    }

   
    if (!empty($email)) {
        $check_email = mysqli_query($connections, "SELECT * FROM mytbl WHERE email = '$email'");
        if (mysqli_num_rows($check_email) > 0) {
            $emailErr = "Email already exists!";
            $valid = false;
        }
    }

  
    else {
      
       $query = myqsli_query($connections, "INSERT INTO mytbl(name,address,email,password,account_type) 
       
       VALUES('$name', '$address', '$email', '$cpassword', '2')");

         echo "<script language='javascript'>alert('Record has been updated!')</script>";
         echo "<script>window.location.href='index.php';</script>";
    }
}

?>
<style>
    .error {
        color: red;
    }
</style>

<br>
<?php include("nav.php"); ?>
<br>
<br>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name" value="<?php echo $name; ?>"> <br>
    <span class="error"><?php echo $nameErr; ?></span> <br>

    Address: <input type="text" name="address" value="<?php echo $address; ?>"> <br>
    <span class="error"><?php echo $addressErr; ?></span> <br>

    Email: <input type="text" name="email" value="<?php echo $email; ?>"> <br>
    <span class="error"><?php echo $emailErr; ?></span> <br>

    Password: <input type="password" name="password" value="<?php echo $password; ?>"> <br>
    <span class="error"><?php echo $passwordErr; ?></span> <br>

    Confirm Password: <input type="password" name="cpassword" value="<?php echo $cpassword; ?>"> <br>
    <span class="error"><?php echo $cpasswordErr; ?></span> <br>

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

<hr>

<?php

$John = "John";
$Jane = "Jane";
$Doe = "Doe";

$names = array("John", "Jane", "Doe");

foreach ($names as $display_names) {

    echo $display_names . "<br>";
}
