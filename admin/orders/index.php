<?php
// Include database connection and authentication checks
include '../db_connect.php';
include '../auth_check.php';     // Verifies if the user is logged in
include '../admin_check.php';    // Verifies if the user has admin privileges

// Retrieve status filter from the query string (if set)
$statusFilter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Base SQL query to fetch order details, customer username, total price, status, and order date
$sql = "
    SELECT o.order_id, u.username, SUM(p.price * oi.quantity) AS total, 
           o.status, o.order_date 
    FROM orders o
    JOIN users u ON o.user_id = u.id
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN products p ON oi.product_id = p.id
";

// Append a WHERE clause if a status filter is provided (e.g., pending, shipped, delivered)
if (!empty($statusFilter)) {
    $sql .= " WHERE o.status = '" . $conn->real_escape_string($statusFilter) . "'";
}

// Group results by order and sort by order date (most recent first)
$sql .= " GROUP BY o.order_id ORDER BY o.order_date DESC";

// Execute the query
$orders = $conn->query($sql);
?>

<?php include _DIR_ . '/../header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <!-- Link to admin-specific CSS -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>
<div class="container-fluid p-4">
    <h2>All Orders</h2>

    <!-- Optional order status filters -->
    <div class="mb-3">
        <a href="index.php" class="btn btn-outline-primary btn-sm">All</a>
        <a href="index.php?filter=pending" class="btn btn-outline-warning btn-sm">Pending orders</a>
        <a href="index.php?filter=shipped" class="btn btn-outline-info btn-sm">Shipped orders</a>
        <a href="index.php?filter=delivered" class="btn btn-outline-success btn-sm">Delivered orders</a>
    </div>

    <!-- Orders Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Total (₦)</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($orders && $orders->num_rows > 0): ?>
            <!-- Loop through each order and display in the table -->
            <?php while($order = $orders->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $order['order_id'] ?></td>
                    <td><?= htmlspecialchars($order['username']) ?></td>
                    <td><?= number_format($order['total'], 2) ?></td>
                    <td>
                        <!-- Dynamic status badge color -->
                        <span class="badge bg-<?= 
                            $order['status'] == 'pending' ? 'warning' : 
                            ($order['status'] == 'shipped' ? 'info' : 'success') 
                        ?>">
                            <?= ucfirst($order['status']) ?>
                        </span>
                    </td>
                    <td><?= date('M d, Y H:i', strtotime($order['order_date'])) ?></td>
                    <td>
                        <!-- Action buttons: view, edit, delete -->
                        <a href="view.php?id=<?= $order['order_id'] ?>" class="btn btn-sm btn-primary">View</a>
                        <a href="edit.php?id=<?= $order['order_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete.php?id=<?= $order['order_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this order?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <!-- If no orders found -->
            <tr><td colspan="6" class="text-center">No orders found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../footer.php'; ?>

</body>
</html>