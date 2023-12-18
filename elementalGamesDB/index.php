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
    <title>Elemental Games - Your One-Stop Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .product-image img {
            width: 300px; 
            height: 300px; 
            object-fit: cover; /* Maintain aspect ratio and fill the container */
        }
        
        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .product {
            margin: 20px;
        }
    </style>
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

    <section class="popular-products">
    <div class="container product-container">
        <h2>Popular Products</h2>
        <?php
        include 'db_connection.php';
        $conn = OpenCon();

        // Query to fetch random six products from the database
        $query = "SELECT * FROM products ORDER BY RAND() LIMIT 6";
        $result = $conn->query($query);

        // Display the products
        if ($result->num_rows > 0) {
            echo '<div class="row">';
            while ($product = $result->fetch_assoc()) {
                echo '<div class="col-md-6 col-lg-4 product">';
                echo '<a class="product-link" href="shopPage.php">';
                echo '<h3>' . $product['ProductName'] . '</h3>';
                echo '<div class="product-image">';
                echo '<img src="' . $product['ProductPic'] . '" alt="' . $product['ProductName'] . '">';
                echo '</div>';
                echo '<p>Type: ' . $product['ProductType'] . '</p>';
                echo '<p>Price: R' . $product['ProductPrice'] . '</p>';
                echo '<form action="add_to_cart.php" method="GET">';
                echo '<input type="hidden" name="productID" value="' . $product['ProductID'] . '">';
                echo '<input type="number" name="quantity" value="1" min="1">';
                echo '<input type="submit" value="Add to Cart">';
                echo '</form>';
                echo '</a>';
                echo '</div>';
            }
            echo '</div>'; // Close the row
        } else {
            echo 'No products found.';
        }

        CloseCon($conn);
        ?>
    </div>
</section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
