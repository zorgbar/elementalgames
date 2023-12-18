<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (!isset($_SESSION['userEmail'])) {
        // Redirect the user to the login page if not logged in
        header('Location: login.php');
        exit();
    }

    // Retrieve the chosen delivery type
    $deliveryType = $_POST['delivery_type'];

    if ($deliveryType === 'pickup') {
        // Handle pickup logic
        // Redirect the user to the pickup confirmation page
        header('Location: pickup_confirmation.php');
        exit();
    } elseif ($deliveryType === 'delivery') {
        // Handle delivery logic
        // Redirect the user to the address and credit card details page
        header('Location: address_and_payment.php');
        exit();
    } else {
        // Invalid delivery type
        // Redirect the user back to the checkout page
        header('Location: checkout.php');
        exit();
    }
} else {
    // Redirect the user back to the checkout page if accessed directly
    header('Location: checkout.php');
    exit();
}
?>
