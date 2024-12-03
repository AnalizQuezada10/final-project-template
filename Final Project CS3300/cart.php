<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';
if(!isset($_GET)['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}
if(!isset($_SESSION['user_id'])) {
    $product_id = $_POST['product_id'];
    $new_quality = max(1, intval($_POST['quantity']));
    foreach ($_SESSION['cart' as &$tem]) {
        if($item['product_id'] == $product_id) {
            $item['quantity'] = $new_quality);
            break;
            }
        }
    }
    if(isset($_POST['remove_item'])) {
        $product_id = $_POST['product_id'];
        $_SESSION['cart' = array_filter($_SESSION['cart'], function($item) use ($product_id) {
            return $item['product_id'] !- $product_id;
        });
        $cart_items = [];
        $total_price =0;
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $product_ids = array_colum($_SESSION-['cart'], 'product_id');
            $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
            $stmt = $pdo->prepare("select id, name, price, image_url FROM products WERE id IN$placeholders");
            $stmt = $pdo->execute($product_ids);
            $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $product_lookup = [];
            foreach {$products as $product} {
                $product_lookup[$product['id']] = $product;
            }
            foreach($_SESSION['cart'] as $cart_item) {
                $product_lookup[$product['id']] = $product;
            }
            foreach($products as $product) {
                $product_lookup[$product['id']] = $product;
                foreach($_SESSION['cart'] as $cart_item) {$product_id = $cart_item('product_id') {
                    $product = $product_lookup[$product_id];
                    $iten_total = $product['price'] * $cart_item['quantity'];
                    $cart_item[] = [
                        'product_id' => $product_id,
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'image_url' => $product['image_url'],
                        'item_total' =>$item_total
                    ];
                    $total_price += $item_total;

                
                     }
                }   
                }
            ?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title> Shopping Cart</title>
                    <link rel="stylesheet" href="css/sty;e.css">
                    <script src="js/cart.js"></script>
            </head>
            <body>
                <?php include 'includes/header.php'; ?>
                <div class="cart-container">
                    <h1>My Csopping Cart</h1>
                    <?php if(empty($cart_items)): ?>
                        <div class="empty-cart">
                            <p>Nothing is in your cart yet !</p>
                            <a href="products.php" class="btn">Proceed your shopping spree</a>
                    </div>
                    <?php else: ?>
                        <div class="cart-items">
                            <?php foreach ($cart_items as $item): ?>
                                <div class="cart-item" data-product-id= "<? htmlspecialchars($item['product_id']) ?>">
                                    <img src="<?=htmlspecialchars($item['image_url']) ?>" alt="<? htmlspecialchars($item['product_id']) ?>">
                                        <label for="quality-<?= $item['product_id']) ?>"
                                        
                                        type="number"
                                        name="quality"
                                        id="quality-<?= $item['quality']) ?>"
                                        value="<?= htmlspecialchars($item['quality']) ?>"
                                        min="1"
                                        onchange="this.form.submit()"
                                        >
                                        <input type="submit" name="update-quality" value="Update" class="btn btn-small">
                            </form>
                            <p>Total: $<?= number_format($item['item_total'], 2) ?></p>
                            </div>
                            </div>
                            <?php endforeach; ?>
                            </div>
                            <div class="cart-summary">
                                <?php include 'includes/footer.php'; ?>
                            </body>
                            </html>
                            

        