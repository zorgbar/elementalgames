
<?php
session_start();

// Function to fetch product details from the database based on product ID
function fetchProductFromDatabase($productID) {
    include 'db_connection.php';

    // Create a new database connection
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

// Check if the product ID and quantity are provided
if (isset($_GET['productID']) && isset($_GET['quantity'])) {
    $productID = $_GET['productID'];
    $quantity = $_GET['quantity'];

    // Create or retrieve the cart from the session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    $cart = $_SESSION['cart'];

    // Fetch product details from the database
    $product = fetchProductFromDatabase($productID);

    if ($product) {
        // Check if the product is already in the cart
        if (isset($cart[$productID])) {
            // If product exists in the cart, update the quantity
            $cart[$productID] += $quantity;
        } else {
            // If product is not in the cart, add it
            $cart[$productID] = $quantity;
        }

        // Update the cart in the session
        $_SESSION['cart'] = $cart;

        // Set a success message
        $_SESSION['message'] = 'Product added to cart successfully.';
    } else {
        // Set an error message
        $_SESSION['message'] = 'Error: Product not found.';
    }

    // Redirect back to the shop page or any other desired page
    header('Location: shopPage.php');
    exit();
} else {
    // Set an error message
    $_SESSION['message'] = 'Error: Missing parameters.';

    // Redirect back to the shop page
    header('Location: shopPage.php');
    exit();
}
?>
