<?php
session_start();

// Check if the form fields are submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $conn = mysqli_connect('localhost', 'zorgbar', 'Dotaderp2756', 'elementalgamesdb');

    // Check if the connection was successful
    if (!$conn) {
        die('Database connection failed.');
    }

    // Prepare the SQL query to retrieve the user information
    $sql = "SELECT * FROM users WHERE userEmail = '$email'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if a row is returned
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['userPass'])) {
            // Password is correct, store user information in session
            $_SESSION['userEmail'] = $row['userEmail'];
            $_SESSION['message'] = 'Login successful.';

            // Redirect to the home page
            header('Location: index.php');
            exit();
        }
    }

    // Login failed, set an error message
    $_SESSION['message'] = 'Invalid email or password. Please try again.';

    // Redirect back to the login page
    header('Location: login.php');
    exit();
} else {
    // Redirect back to the login page if the form fields are not submitted
    header('Location: login.php');
    exit();
}
?>
