<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Lấy giỏ hàng từ session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Tính tổng số tiền
$totalPrice = 0;
foreach ($cart as $item) {
    $totalPrice += $item['quantity'] * $item['book_price'];
}
print_r($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <?php if (empty($cart)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach ($cart as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['book_id']); ?></td>
                <td><?php echo htmlspecialchars($item['book_title']); ?></td>
                <td><?php echo htmlspecialchars($item['book_author']); ?></td>
                <td><?php echo htmlspecialchars($item['book_price']); ?>$</td>
                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                <td><?php echo htmlspecialchars($item['quantity'] * $item['book_price']); ?>$</td>
            </tr>
            <?php endforeach; ?>
        </table>
        <h3>Total: <?php echo $totalPrice; ?>$</h3>
    <?php endif; ?>
</body>
</html>
