<?php 
session_start(); 
include 'db_connect.php';

// Check if the user is logged in as a user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abaya Shop</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1a1a1a;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        header h1 {
            margin: 0;
            font-size: 2.5rem;
            letter-spacing: 2px;
        }
        .cart-link, .logout-link, .login-link {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            text-decoration: none;
            background-color: #f0c040;
            color: #000;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: bold;
        }
        .cart-link {
            right: 160px;
        }
        .welcome-msg {
            background: linear-gradient(to right, #ffe9c5, #fff3d3);
            padding: 15px;
            margin: 20px auto;
            width: 80%;
            border: 1px solid #f0c040;
            border-left: 8px solid #f0c040;
            border-radius: 8px;
            color: #333;
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .product-card {
            background-color: #fff;
            width: 250px;
            margin: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 15px;
            text-align: center;
        }
        .product-card img {
            width: 100%;
            border-radius: 5px;
            height: 200px;
            object-fit: cover;
        }
        .product-card h3 {
            margin: 10px 0 5px;
        }
        .product-card .price {
            color: #f0c040;
            font-weight: bold;
            margin: 10px 0;
        }
        .product-card input[type="number"] {
            width: 60px;
            padding: 5px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .product-card button {
            background-color: #1a1a1a;
            color: #fff;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .product-card button:hover {
            background-color: #f0c040;
            color: #000;
        }
        footer {
            background-color: #1a1a1a;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<header>
    <h1>Luxury Abayas</h1>

    <a href="checkout.php" class="cart-link">
        Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)
    </a>

    <?php if (isset($_SESSION['username'])): ?>
        <a href="../auth/logout.php" class="logout-link">Logout</a>
    <?php else: ?>
        <a href="login.php" class="login-link">Login</a>
    <?php endif; ?>
</header>

<div class="welcome-msg">
    <?php
        // Yusuf Hassan: Display greeting based on current time of day
        $hour = date("H");
        if ($hour < 12) {
            $greeting = "Good morning";
        } elseif ($hour < 18) {
            $greeting = "Good afternoon";
        } else {
            $greeting = "Good evening";
        }

        // Combine greeting with username
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
        echo "<p style='color: #f0c040; font-weight: bold;'>{$greeting}, <strong>{$username}</strong> 👋 — welcome back to <em>Abaya Store</em>!</p>";
    ?>
</div>


<!-- Products Section -->
<div class="product-grid">
    <?php
    $result = $conn->query("SELECT * FROM products LIMIT 10");
    while($row = $result->fetch_assoc()):
    ?>
    <div class="product-card">
        <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
        <p><?php echo htmlspecialchars($row['description']); ?></p>
        <p class="price">₦<?php echo htmlspecialchars($row['price']); ?></p>
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
            <input type="number" name="quantity" value="1" min="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <?php endwhile; ?>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Abaya Shop. All rights reserved.</p>
</footer>

</body>
</html>
<<<<<<< HEAD
=======

>>>>>>> ec52e2e5a534c370a9f7aa4e0bf8c0256ab8cf90
