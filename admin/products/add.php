<?php
// Include the database connection
include '../db_connect.php';

// Ensure the user is logged in
include '../auth_check.php';

// Ensure the logged-in user has admin privileges
include '../admin_check.php';

// Include the header, which also contains the sidebar
include '../header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Ensure responsive design on all devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
    
    <!-- Admin-specific styles -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<!-- Page heading -->
<h2 class="mb-4">Add New Product</h2>

<!-- Product creation form -->
<form method="POST" action="save.php" enctype="multipart/form-data">
    <!-- Product Name Field -->
    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" class="form-control" name="name" required>
    </div>

    <!-- Product Description Field -->
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" required></textarea>
    </div>

    <!-- Product Price Field -->
    <div class="mb-3">
        <label for="price" class="form-label">Price (₦)</label>
        <input type="number" step="0.01" class="form-control" name="price" required>
    </div>

    <!-- Product Stock Field -->
    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" name="stock" required>
    </div>

    <!-- Product Image Upload Field -->
    <div class="mb-3">
        <label for="image" class="form-label">Product Image</label>
        <input type="file" class="form-control" name="image" accept="image/*" required>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-success">Add Product</button>
</form>

<!-- Include footer layout -->
<?php include '../footer.php'; ?>
</body>
</html>

