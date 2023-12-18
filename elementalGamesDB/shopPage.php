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
    <title>Elemental Games - Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .product-image img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            /* Maintain aspect ratio and fill the container */
        }

        .product-list .product {
            margin: 20px;
            flex-basis: 33.33%; /* Display 3 products per row */
        }

        .search-filter {
            margin-bottom: 20px;
        }
    </style>
    <script src="cartCount.js"></script>
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

    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="message">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']); // Clear the message from the session
    }
    ?>

    <section class="products">
        <div class="container">
            <h2>Shop</h2>
            <div class="row">
                <div class="col-md-12 search-filter">
                    <div class="filter">
                        <label for="product-type">Filter by Type:</label>
                        <select name="product-type" id="product-type" class="filter-select">
                            <option value="">All</option>
                            <option value="miniature">Miniature</option>
                            <option value="paint">Paint</option>
                        </select>
                        <button onclick="applyFilter()" class="btn btn-primary">Filter</button>
                    </div>
                    <div class="search-bar">
                        <form action="shopPage.php" method="GET" class="search-form">
                            <input type="text" name="search-term" placeholder="Search products" class="search-input">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row product-list">
                <?php
                include 'db_connection.php';
                $conn = OpenCon();

                // Check if a search term has been entered
                $searchTerm = isset($_GET['search-term']) ? $_GET['search-term'] : '';

                // Check if a product type filter has been applied
                $filterType = isset($_GET['product-type']) ? $_GET['product-type'] : '';

                // Construct the query based on the search term and filter
                $query = "SELECT * FROM products";

                if ($searchTerm && $filterType) {
                    $query .= " WHERE ProductName LIKE '%$searchTerm%' AND ProductType = '$filterType'";
                } elseif ($searchTerm) {
                    $query .= " WHERE ProductName LIKE '%$searchTerm%'";
                } elseif ($filterType) {
                    $query .= " WHERE ProductType = '$filterType'";
                }

                $result = $conn->query($query);

                // Display the products
                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        echo '<div class="col-md-4 product">';
                        echo '<div class="product-image"><img src="' . $product['ProductPic'] . '" alt="' . $product['ProductName'] . '"></div>';
                        echo '<h3>' . $product['ProductName'] . '</h3>';
                        echo '<p>Type: ' . $product['ProductType'] . '</p>';
                        echo '<p>Price: R' . $product['ProductPrice'] . '</p>';
                        echo '<form action="add_to_cart.php" method="GET">';
                        echo '<input type="hidden" name="productID" value="' . $product['ProductID'] . '">';
                        echo '<input type="number" name="quantity" value="1" min="1">';
                        echo '<input type="submit" value="Add to Cart">';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo 'No products found.';
                }

                CloseCon($conn);
                ?>
            </div>
        </div>

        <script>
            function applyFilter() {
                var filterType = document.getElementById("product-type").value;
                var searchTerm = document.querySelector(".search-input").value;

                var url = "shopPage.php?";

                if (filterType !== "") {
                    url += "product-type=" + filterType;
                }

                if (searchTerm !== "") {
                    url += "&search-term=" + searchTerm;
                }

                window.location.href = url;
            }
        </script>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="shopPage.js"></script>
</body>

</html>
