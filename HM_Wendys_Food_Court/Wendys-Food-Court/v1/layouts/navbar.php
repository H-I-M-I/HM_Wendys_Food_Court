<nav class="navbar navbar-expand-lg navbar-dark bg-custom-1">
    <div class="container-fluid">
        <a class="navbar-brand fs-2" href="#">
            <img src="../../static/images/Layout/logo.png" width="100" alt="" class="d-inline-block align-middle mr-2">
            <span class="text-uppercase font-weight-bold fw-bold">Wendys</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars fs-2 text-white"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link mx-2 text-white <?php if($page == 'search') echo 'active'; ?>" aria-current="page"
                        href="../query/search.php">
                        <i class="fas fa-search"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mx-2 text-white <?php if($page == 'home') echo 'active'; ?>" aria-current="page"
                        href="../customer/home.php">
                        <i class="fas fa-home"></i> <span>Home</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mx-2 text-white <?php if($page == 'menu') echo 'active'; ?>" href="../customer/menu.php">
                        <i class="fas fa-book-open"></i> <span>Menu</span>
                    </a>
                </li>

                <?php
                    if(isset($_SESSION['customer_id']) && $_SESSION['login']) {?>
                <li class="nav-item">
                    <a class="nav-link mx-2 text-white <?php if($page == 'carts') echo 'active'; ?>" href="../customer/carts.php">
                        <i class="fas fa-shopping-cart"></i> <span>My Cart</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mx-2 text-white <?php if($page == 'orders') echo 'active'; ?>" href="../customer/orders.php">
                        <i class="fas fa-shopping-bag"></i> <span>My Orders</span>
                    </a>
                </li>
                
                <?php
                    }
                ?>

                <li class="nav-item">
                    <a class="nav-link mx-2 text-white <?php if($page == 'bookings') echo 'active'; ?>" href="../customer/bookings.php">
                        <i class="fas fa-pencil-alt"></i> <span>Bookings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mx-2 text-white <?php if($page == 'about') echo 'active'; ?>" href="../customer/about.php">
                        <i class="fas fa-info-circle"></i> <span>About</span>
                    </a>
                </li>

                <?php
                    if(!(isset($_SESSION['customer_id']) && $_SESSION['login'])) {?>

                <li class="nav-item">
                    <a class="nav-link mx-2 text-white <?php if($page == 'login') echo 'active'; ?>" href="../auth/login.php">
                        <i class="fas fa-sign-in-alt"></i> <span>Login</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mx-2 text-white <?php if($page == 'register') echo 'active'; ?>" href="../auth/registration.php">
                        <i class="fas fa-user-plus"></i> <span>Register</span>
                    </a>
                </li>

                <?php
                    } else {
                ?>

                <li class="nav-item">
                    <a class="nav-link mx-2 text-white <?php if($page == 'profile') echo 'active'; ?>" href="profile.php">
                        <i class="fas fa-user"></i> <span>Profile</span>
                    </a>
                </li>
                        
                <li class="nav-item">
                    <a class="nav-link mx-2 text-white <?php if($page == 'logout') echo 'active'; ?>" href="../auth/logout.php">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                </li>

                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>