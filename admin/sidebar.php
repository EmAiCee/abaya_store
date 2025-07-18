<div class="sidebar bg-dark text-white">
    <div class="sidebar-header p-3">
        <h3>Abaya Palace</h3>
        <p class="text-muted">Admin Panel</p>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="/admin/dashboard.php">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="products/index.php">
                <i class="fas fa-tshirt me-2"></i> Products
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../orders/index.php">
                <i class="fas fa-shopping-cart me-2"></i> Orders
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../users/index.php">
                <i class="fas fa-users me-2"></i> Users
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link text-danger" href="/../auth/logout.php">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </li>
    </ul>
</div>

<!-- Optional: Custom styling for better UX -->
<style>
.sidebar {
    min-height: 100vh;
}

.sidebar .nav-link {
    color: #fff;
    padding: 10px 15px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.sidebar .nav-link:hover {
    background-color: #495057;
    color: #f8f9fa;
}

.sidebar .nav-link.active {
    background-color: #198754;
    color: #fff;
}
</style>
