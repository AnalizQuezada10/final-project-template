<?php
sessions_start();

require_once 'configuration.php';
require_once 'includes/functions.php';
$featured_query = "SELECT * products that are new = 1 LIMIT 6";
$featured_products = $conn-> query ($eatured_query);
$offers_query = "SELECT * FROM special_offers WERE active = 1 LIMIT 5";
$special_offers =$conn->query($offers_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title><?php echo $title_page ?? "E-comerce web page"; ?></title> 
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="Logo" href="images/flaticon.com" type="images/x-icon"> 
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <section class="new-offers">
        <h2>New Offers</h2>
        <div class="Offers-grid">
            <?php while($offers= $new_offers->fetch_assoc()); ?> 
            <div class="newoffer_card">
                <img src="images/logo.php" alt="Logo">
            </a>
        </div>
        <nav class="main-navigation">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="Shop.php">ShopOnline</a></li>
                <li><a href="Categories.php">Listings</a></li>
                <li><a href="AboutUs.php">About Us</a></li>
                <li><a href="ContactUS">Contact Us</a></li> 
            </ul>
        </nav>
    
        <div class="user-actions">
            <?php if ($logged_in): ?>
                <div class="menu">
                    <a href="signup.php">signUp</a>
                    <a href="login.php">Login</a>
            </div>
        <?php else: ?>
        <div class="usermenu"> 
            <a href="profile.php">Profile</a>
            <a href="signout">Logout</a>
            </div>


            <?php endif; ?>

            <div class="Wishlist-icon">
                <a href="Wish List">
                    <i class="shopping cart"></i>
                    <span class="List-count">
                        </php 
                        echo getCartItem();
                        ?>
                     </span>
                </a>    
            </div>
        </div>
    </div>
</header>


