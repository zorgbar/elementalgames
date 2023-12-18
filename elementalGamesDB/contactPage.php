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
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate the form data (you can add more validation if needed)
    if (empty($name) || empty($email) || empty($message)) {
        echo 'Please fill in all fields.';
    } else {
        // Save the form data to the "queries" table
        $conn = OpenCon();
        $query = "INSERT INTO queries (Name, Email, Message) VALUES ('$name', '$email', '$message')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo 'We have recieved your message, thank you!';
        } else {
            echo 'There was a problem submitting your message. Please try again.';
        }

        CloseCon($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elemental Games - Contact</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.php"><img src="elementalLogo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shopPage.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutPage.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contactPage.php">Contact</a>
                        </li>
                    </ul>
                    <a href="cart.php" class="btn btn-primary ml-auto">Cart</a>
                    <?php if ($isLoggedIn) { ?>
                    <a href="logout.php" class="btn btn-secondary ml-2">Sign Out</a>
                    <?php } else { ?>
                    <a href="login.php" class="btn btn-secondary ml-2">Login</a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </header>
    <section class="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <div class="contact-form">
                <form action="contactPage.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea name="message" id="message" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="contactPage.js"></script>
</body>

</html>
