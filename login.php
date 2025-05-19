<?php
session_start();

$email = $password = "";
$emailErr = $passwordErr = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    // Only proceed if no input errors
    if ($email && $password) {

        include("connection.php");

        $check_email = mysqli_query($connection, "SELECT * FROM mytbl WHERE email = '$email'");
        $check_email_row = mysqli_num_rows($check_email);

        if ($check_email_row > 0) {

            while ($row = mysqli_fetch_assoc($check_email)) {

                $user_id = $row["id"];
                $db_password = $row["password"];
                $db_account_type = $row["account_type"];

                if ($password == $db_password) {  // Optional: replace with password_verify() if hashed

                    session_start();
                    $_SESSION["id"] = $user_id;

                    

                    if ($db_account_type == "1") {
                        echo "<script>window.location.href = 'admin';</script>";
                    } else {
                        echo "<script>window.location.href = 'user';</script>";
                    }

                    exit(); // Stop script after redirect
                } else {
                    $passwordErr = "Password is incorrect!";
                }
            }

        } else {
            $emailErr = "Email is not registered!";
        }
    }
}
?>

<style>
    .error { color: red; }
</style>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    EMAIL: <input type="text" name="email" value="<?php echo $email; ?>"> <br>
    <span class="error"><?php echo $emailErr; ?></span> <br>

    PASSWORD: <input type="password" name="password"> <br>
    <span class="error"><?php echo $passwordErr; ?></span> <br>

    <input type="submit" value="Login">
</form>
