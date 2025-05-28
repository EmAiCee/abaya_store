<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- Toggle button for mobile view -->
<button class="btn btn-outline-light d-md-none m-2" type="button" data-bs-toggle="collapse" data-bs-target="#adminSidebar" aria-controls="adminSidebar" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar Navigation -->
<nav id="adminSidebar" class="collapse d-md-block sidebar bg-dark text-white" aria-label="Admin Sidebar Navigation">
    <div class="sidebar-header p-3 border-bottom border-secondary">
        <h3 class="mb-0">Abaya Palace</h3>
        <small class="text-muted">Admin Panel</small>
    </div>

    <ul class="nav flex-column p-2">
        <li class="nav-item">
            <a class="nav-link <?= $currentPage == 'dashboard.php' ? 'active' : '' ?>" href="/admin/dashboard.php" title="Dashboard">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $currentPage == 'index.php' && strpos($_SERVER['REQUEST_URI'], 'products') !== false ? 'active' : '' ?>" href="/admin/products/index.php" title="Manage Products">
                <i class="fas fa-tshirt me-2"></i> Products
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $currentPage == 'index.php' && strpos($_SERVER['REQUEST_URI'], 'orders') !== false ? 'active' : '' ?>" href="/admin/orders/index.php" title="Manage Orders">
                <i class="fas fa-shopping-cart me-2"></i> Orders
            </a>
        </li>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <li class="nav-item">
            <a class="nav-link <?= $currentPage == 'index.php' && strpos($_SERVER['REQUEST_URI'], 'users') !== false ? 'active' : '' ?>" href="/admin/users/index.php" title="Manage Users">
                <i class="fas fa-users me-2"></i> Users
            </a>
        </li>
        <?php endif; ?>

        <li class="nav-item mt-3">
            <a class="nav-link text-danger" href="/auth/logout.php" title="Logout">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </li>
    </ul>
</nav>

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
