<?php
session_start();
include('config.php');

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {

        $query = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $error_message = "Email already registered!";
        } else {
            
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password_hash')";
            if (mysqli_query($conn, $query)) {
                $success_message = "Account created successfully! You can now log in.";
            } else {
                $error_message = "Error creating account. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Online Store</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Sign Up</h2>
        <?php 
        if (isset($error_message)) { 
            echo '<div class="alert alert-danger">' . $error_message . '</div>'; 
        } 
        if (isset($success_message)) { 
            echo '<div class="alert alert-success">' . $success_message . '</div>'; 
        } 
        ?>
        <form method="POST" action="signup.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
            </div>
            <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
        </form>
        <div class="mt-3">
            <p>Already have an account? <a href="login.php">Log in here</a>.</p>
        </div>
    </div>

</body>

</html>