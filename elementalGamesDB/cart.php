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

// Function to fetch product details from the database based on product ID
function fetchProductFromDatabase($productID) {
    $conn = OpenCon();

    // Prepare and execute the query to fetch the product details based on productID
    $query = "SELECT * FROM products WHERE ProductID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Fetch the product details from the result
        $product = $result->fetch_assoc();

        // Close the database connection
        CloseCon($conn);

        // Return the product details
        return $product;
    }

    // If no product found or query failed, return null
    return null;
}

// Retrieve the cart from the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
$cart = $_SESSION['cart'];

// Check if the remove item action is triggered
if (isset($_GET['removeItem'])) {
    $removeItemID = $_GET['removeItem'];

    // Remove the item from the cart
    unset($cart[$removeItemID]);

    // Update the cart in the session
    $_SESSION['cart'] = $cart;

    // Set a success message
    $_SESSION['message'] = 'Item removed from cart successfully.';

    // Redirect back to the cart page
    header('Location: cart.php');
    exit();
}

// Retrieve the product details for each item in the cart
$cartItems = array();
foreach ($cart as $productID => $quantity) {
    $product = fetchProductFromDatabase($productID);
    if ($product) {
        $product['quantity'] = $quantity;
        $cartItems[] = $product;
    }
}

// Calculate the total price of all items in the cart
$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['ProductPrice'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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

    <div class="container cart-container">
        <h1>Cart</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message"><?php echo $_SESSION['message']; ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="cart-items">
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-item">
                    <div class="item-details">
                        <h4><?php echo $item['ProductName']; ?></h4>
                    </div>
                    <div class="item-quantity">
                        <span>Quantity:</span>
                        <?php echo $item['quantity']; ?>
                    </div>
                    <div class="item-price">
                        <span>Price:</span>
                        R<?php echo $item['ProductPrice']; ?>
                    </div>
                    <div class="item-total">
                        <span>Total:</span>
                        R<?php echo $item['ProductPrice'] * $item['quantity']; ?>
                    </div>
                    <div class="item-remove">
                        <a href="cart.php?removeItem=<?php echo $item['ProductID']; ?>">Remove</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-total">
            <span>Total:</span>
            R<?php echo $totalPrice; ?>
        </div>

        <div class="cart-buttons">
            <a href="checkout.php" class="btn btn-primary">Checkout</a>
        </div>
    </div>

    <script src="cartCount.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>