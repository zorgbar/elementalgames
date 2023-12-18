<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['userEmail'])) {
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}
?>

<?php


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the form data 
    if (empty($email) || empty($password)) {
        $_SESSION['message'] = 'Please fill in all the fields.';
        header('Location: signup.php');
        exit();
    }

    // Create a connection to the database
    include 'db_connection.php';
    $conn = OpenCon();

    // Check if the email is already registered
    $query = "SELECT * FROM users WHERE userEmail = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = 'Email already registered. Please choose a different email.';
        header('Location: signup.php');
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $insertQuery = "INSERT INTO users (userEmail, userPass) VALUES ('$email', '$hashedPassword')";
    mysqli_query($conn, $insertQuery);

    // Close the database connection
    CloseCon($conn);

    $_SESSION['message'] = 'Registration successful. You can now log in.';
    header('Location: login.php');
    exit();
} else {
    // If someone tries to directly access this page without submitting the form, redirect them to the signup page
    header('Location: signup.php');
    exit();
}
?>
