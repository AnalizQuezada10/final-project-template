<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';
if(!isset($_GET)['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}
$poduct_id = intval($_GET['id'])) {
    $product = getProductDetails($product_id);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
        $quantity = isset($_POST['quantity']) : 1;
        addToCart($product_id,$quantity);

    }
    $reviews = getProductReview($product_id);
    $is_logged_in = isset($_SESSION['user_id']);
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charste="UTF-8">
            <title><?php echo htmlspecialchars($product['name']); ?></title>
            <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include'includes/header.php'; ?>
    <div class="product-images">
        <?php foreach ($product['images'] as $image): ?>
            <img src="<?php echo htmlspecialchars($image); ?>" atlt="<?php echo htmlspecialchars($product['name']); ?>">
            <?php endforeach; ?>
        </div>
        <div class="product-details">
            <h3><?php echo htmlspecialchars($product['name']); ?></h1>
            <div class="product-price">
                <?php if ($product['sale_price']); ?>
                <span class="original-price"> $<?php echo number_format($product['original_price'], 2); ?></span>
                <?php endif; ?>
        </div>
        <p class="product-descriptions">
            <?php echo htmlspecialchars($prodict['decriptions']); ?>
        </p>

            <form method="POST" class="add-to-cart-form">
                <div class="quality-selector">
                    <label for="quality">Quality:</label>
                    <input type="Number" name="qualitty" id="quality"
                    value="1" min="1"
                    max="<?php echo $product['stock']: ?>
        </div>
        <button type="submit"
        name="add_to_cart"
        <?php echo $product['stock'] <= 0 ? 'disabled : ''; ?>>
        </button>
        </form>
        <div class="product-meta">
        <p>SKU:   <?php echo htmlspecialchars($prodiuct['sku']); ?></p>\
        <p>Category: <?php ecjo htmlspecialchars($products['category]); ?></p>
        </div>
    </div>
</div>
<?php endforeach; ?>
</div>
<?php include'includes/footer.php'; ?>
<script src="assets/js/product.js"></script>
</body>
</html>


<?php
function getProductDeatils($product_id) {
    global $db;
    $stmt = $db->prepare
    $stmt->behind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
} 

function getProductReviews($product_id) {
    global $db;
    $stmt = $db->prepare("
    SELECT
    r.rating,
    r.comment,
    r.create_at,
    u.name AS user_name
    FROM reviews r
    JOIN users u ON r.users_id = u.id
    WHERE r.products_id = ?
    ORDER BY r.created_at desc
    ");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQL_ASSOC);
}
function addToCart($product_id, $quantity) {
    global $db;
    $stmt -$db->prepare("SELECT stock FROM prooducts WHERE ID = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    if($product['stock'] >= $quantity) {
        if(!isset($_SESSION['Cart'])) {
            $_SESSION['cart'] = [];
            $cart_updated = false;
            foreach($_SESSION['Cart'] as &$item) {
                if($item['id']== $product_id) {
                    $item['quantity'] += $quantity;
                    $cart_updated = true;
                    break; 
                }
            } 
            if(!$cart_updated){
                $_SESSION['Cart'][] = [
                    'id' => $product_id,
                    'quality' => $quality
                ];
            }

                header('Location: cart.php');
                exit();

            }
        }
    }
}
?> 
}


}