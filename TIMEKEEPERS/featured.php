<?php
require_once 'database/connection.php';
session_start();

$quary = $db->prepare("SELECT * FROM barang ORDER BY name ASC LIMIT 3");
$quary->execute();
$result1 = $quary->get_result();
$products = $result1->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Terlaris - TIMEKEEPERS PROJEK</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    <?php include_once 'component/header.php'; ?>

    <!--==================== CART ====================-->
    <?php include_once 'component/cart.php'; ?>

    <!--==================== MAIN ====================-->
    <main class="main">
        <!--==================== FEATURED ====================-->
        <section class="featured section container" id="featured">
            <h2 class="section__title">TERLARIS</h2>
            <div class="featured__container grid">
                <?php foreach ($products as $product) : ?>
                    <article class="featured__card">
                        <span class="featured__tag">Sale</span>
                        <img src="assets/img/barang/<?php echo $product['image']; ?>" alt="" class="featured__img">
                        <div class="featured__data">
                            <h3 class="featured__title"><?php echo $product['name']; ?></h3>
                            <span class="featured__price">Rp<?php echo number_format($product['price'], 0, ',', '.'); ?></span>
                        </div>
                        <button class="button featured__button" data-id="<?= $product['id'] ?>">MASUKKAN KE KERANJANG</button>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer section">
        <div class="footer__container container grid">
            <div class="footer__content">
                <h3 class="footer__title">Informasi Kami</h3>
                <ul class="footer__list">
                    <li>+1 (587) 209-3714</li>
                    <li>Depok, Sleman, Yogyakarta</li>
                    <li>Kode Pos 55283</li>
                </ul>
            </div>
            <div class="footer__content">
                <h3 class="footer__title">TIMEKEEPERS</h3>
                <ul class="footer__links">
                    <li><a href="support-center.html" class="footer__link">Support Center</a></li>
                    <li><a href="customer-support.html" class="footer__link">Customer Support</a></li>
                    <li><a href="about-us.html" class="footer__link">Tentang Kami</a></li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Produk</h3>
                <ul class="footer__links">
                    <li><a href="products.php" class="footer__link">Jam Tangan</a></li>
                    <li><a href="products.php" class="footer__link">Smart Watch</a></li>
                    <li><a href="products.php" class="footer__link">Aksesoris</a></li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Media Sosial</h3>
                <ul class="footer__social">
                    <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-facebook'></i>
                    </a>
                    <a href="https://twitter.com/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-twitter'></i>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-instagram'></i>
                    </a>
                </ul>
            </div>
        </div>
    </footer>

    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up"><i class='bx bx-up-arrow-alt scrollup__icon'></i></a>
    <!--=============== SWIPER JS ===============-->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/index.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productButtons = document.querySelectorAll('.featured__button');

            productButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const productId = this.dataset.id;

                    fetch('validate.php')
                        .then(response => response.json())
                        .then(data => {
                            if (!data.loggedIn) {
                                this.classList.add('failed');
                                this.textContent = 'Keranjang gagal';
                                setTimeout(() => {
                                    this.classList.remove('failed');
                                    this.textContent = 'MASUKKAN KE KERANJANG';
                                }, 3000);
                            } else {
                                const userId = data.userId;
                                fetch('add_to_cart.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        userId,
                                        productId
                                    })
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            this.classList.add('success');
                                            this.textContent = 'Berhasil ditambahkan';
                                            updateCartUI();
                                            setTimeout(() => {
                                                this.classList.remove('success');
                                                this.textContent = 'MASUKKAN KE KERANJANG';
                                            }, 3000);
                                        } else {
                                            this.classList.add('failed');
                                            this.textContent = 'Keranjang gagal';
                                            setTimeout(() => {
                                                this.classList.remove('failed');
                                                this.textContent = 'MASUKKAN KE KERANJANG';
                                            }, 3000);
                                        }
                                    });
                            }
                        });
                });
            });

            function updateCartUI() {
                fetch('get_cart.php')
                    .then(response => response.json())
                    .then(data => {
                        const cartContainer = document.querySelector('.cart__container');
                        cartContainer.innerHTML = ''; // Clear existing cart items

                        data.cartItems.forEach(item => {
                            const cartItem = document.createElement('article');
                            cartItem.classList.add('cart__card');
                            cartItem.innerHTML = `
                                <div class="cart__box">
                                    <img src="assets/img/barang/${item.image}" alt="" class="cart__img">
                                </div>
                                <div class="cart__details">
                                    <h3 class="cart__title">${item.name}</h3>
                                    <span class="cart__price">Rp${numberWithCommas(item.price)}</span>
                                    <div class="cart__amount">
                                        <div class="cart__amount-content">
                                            <span class="cart__amount-box">
                                                <i class='bx bx-minus' data-id="${item.barang_id}"></i>
                                            </span>
                                            <span class="cart__amount-number">${item.quantity}</span>
                                            <span class="cart__amount-box">
                                                <i class='bx bx-plus' data-id="${item.barang_id}"></i>
                                            </span>
                                        </div>
                                        <i class='bx bx-trash-alt cart__amount-trash' data-id="${item.barang_id}"></i>
                                    </div>
                                </div>
                            `;
                            cartContainer.appendChild(cartItem);
                        });

                        // Update cart summary
                        document.querySelector('.cart__prices-item').textContent = `Items ${data.totalItems}`;
                        document.querySelector('.cart__prices-total').textContent = `Rp${numberWithCommas(data.totalPrice)}`;

                        // Add event listeners for new cart items
                        addCartEventListeners();
                    });
            }

            function addCartEventListeners() {
                const minusButtons = document.querySelectorAll('.bx-minus');
                const plusButtons = document.querySelectorAll('.bx-plus');
                const trashButtons = document.querySelectorAll('.cart__amount-trash');

                minusButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const productId = this.dataset.id;
                        updateCart('minus', productId);
                    });
                });

                plusButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const productId = this.dataset.id;
                        updateCart('plus', productId);
                    });
                });

                trashButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const productId = this.dataset.id;
                        updateCart('remove', productId);
                    });
                });
            }

            function updateCart(action, productId) {
                fetch('update_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        action,
                        productId
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateCartUI();
                        } else {
                            alert('Gagal memperbarui keranjang');
                        }
                    });
            }

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            updateCartUI();
        });
    </script>
</body>

</html>
