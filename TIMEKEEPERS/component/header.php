<header class="header" id="header">
    <nav class="nav container">
        <a href="home.php" class="nav__logo">
            <i class='bx bxs-watch nav__logo-icon'></i> TimeKeepers
        </a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <?php
                $currentPage = basename($_SERVER['REQUEST_URI']);
                ?>
                <li class="nav__item">
                    <a href="home.php" class="nav__link <?= ($currentPage == 'home.php') ? 'active-link' : '' ?>">Beranda</a>
                </li>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']['level'] == 'admin') : ?>
                    <li class="nav__item">
                        <a href="admin/barang/index.php" class="nav__link <?= ($currentPage == 'admin/barang/index.php') ? 'active-link' : '' ?>">Admin</a>
                    </li>
                <?php endif; ?>

                <div class="dropdown">
                    <button class="dropbtn">Produk <i class="ri-arrow-down-s-line arrow-icon"></i></button>
                    <div class="dropdown-content">
                        <a href="products.php" class="<?= ($currentPage == 'products.php') ? 'active-link' : '' ?>">Produk</a>
                        <a href="featured.php" class="<?= ($currentPage == 'featured.php') ? 'active-link' : '' ?>">Terlaris</a>
                        <a href="new.php" class="<?= ($currentPage == 'new.php') ? 'active-link' : '' ?>">Terbaru</a>
                    </div>
                </div>
            </ul>
            <div class="nav__close" id="nav-close"><i class='bx bx-x'></i></div>
        </div>
        <div class="nav__btns">
            <i class='bx bx-moon change-theme' id="theme-button"></i>
            <div class="nav__shop" id="cart-shop"><i class='bx bx-shopping-bag'></i></div>

            <?php if (isset($_SESSION['user'])) : ?>
                <a class="logout" href="logout.php">
                    <div class="nav-link"><i class="bi bi-box-arrow-in-right"></i></div>
                </a>
            <?php else : ?>
                <i class="ri-user-line nav__login" id="login-btn"></i>
                <div class="nav__toggle" id="nav-toggle"><i class='bx bx-grid-alt'></i></div>
            <?php endif; ?>
        </div>
    </nav>
</header>