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
    <title>Login - Elemental Games</title>
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
                    <a href="signup.php" class="btn btn-secondary ml-2">Sign Up</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Login</h2>
                <?php
                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['message'] . '</div>';
                    unset($_SESSION['message']);
                }
                ?>
                <form method="post" action="authenticate.php">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <p>Forgot your password? <a href="forgotpassword.php">Reset it here</a></p>
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="login.js"></script>
</body>

</html>
