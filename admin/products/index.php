<?php
// Include the database connection
include '../db_connect.php';

// Check if the user is authenticated
include '../auth_check.php';

// Check if the authenticated user is an admin
include '../admin_check.php';

// Include the header (contains sidebar and layout setup)
include '../header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Responsive layout settings -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
    
    <!-- Link to admin-specific CSS -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<!-- Page Heading -->
<h2 class="mb-4">All Products</h2>

<!-- Button to navigate to Add Product page -->
<a href="add.php" class="btn btn-primary mb-3">+ Add New Product</a>

<!-- Products Table -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th> <!-- Product ID -->
            <th>Name</th> <!-- Product Name -->
            <th>Price (₦)</th> <!-- Product Price -->
            <th>Stock</th> <!-- Available Stock -->
            <th>Actions</th> <!-- Edit/Delete Actions -->
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch all products from the database in descending order by ID
        $result = $conn->query("SELECT * FROM products ORDER BY id DESC");

        // Loop through each product record
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <!-- Display product details -->
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td> <!-- Sanitize to prevent XSS -->
            <td><?= number_format($row['price'], 2) ?></td> <!-- Format price to 2 decimal places -->
            <td><?= $row['stock'] ?></td>

            <!-- Action buttons for editing and deleting products -->
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" 
                   class="btn btn-sm btn-danger" 
                   onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Include footer content -->
<?php include '../footer.php'; ?>
</body>
</html>
