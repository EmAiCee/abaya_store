<?php 
session_start(); 
include 'db_connect.php';

// Check if the user is logged in as a user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location:./auth/login.php");
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
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.2.0/css/pro.min.css">
    <style>
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
     
    <span>
        <form action="add_to_cart.php" method="post">
           <button type="submit">Check Out <i class="fas fa-cart-shopping"></i></button>
           <input type="text" name="prod_array" id="prod_array" style="display:none;">
        </form>
        <!-- Logout Link (Only if the user is logged in) -->
        <?php if (isset($_SESSION['username'])): ?>
           <button>
            <a href="./auth/logout.php" class="logout-link">Logout</a>
           </button>
        <?php else: ?>
          <button>
            <a href="login.php" class="login-link">Loging</a>
          </button>
        <?php endif; ?>
    </span> 
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
        <span style="background-image:url('<?php echo $row['image_path']; ?>')">
        </span>
    
        <span>

            <span>
                <p style="margin-left:10px; font-size:.9rem;"><?php echo $row['name']; ?></p>    
                <p class="price">₦<?php echo $row['price']; ?></p>
            </span>

            <span>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </span>
            
            <span>
                <p><?php echo $row['description']; ?></p>
            </span>
            
            <span>
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <button type="button"> + </button>
                <input type="number" name="quantity" value="1" min="1">
                <button type="button"> - </button>
                <button type="submit">Add to Cart</button>
            </span>
        </span>
    </div>
    <?php endwhile; ?>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Abaya Shop. All rights reserved.</p>
</footer>

</body>
<script type="text/javascript" src="script.js"></script>
</html>
