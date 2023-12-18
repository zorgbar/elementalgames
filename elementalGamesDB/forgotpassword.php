<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['userEmail'])) {
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Elemental Games</title>
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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Forgot Password</h2>
                <p>Enter your email address below and we'll send you a link to reset your password.</p>
                <form method="POST" action="forgotpassword.php">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
                <p>Remembered your password? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>