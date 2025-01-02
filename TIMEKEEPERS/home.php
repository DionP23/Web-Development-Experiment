<?php
// session_start();

use Timekeepers\Database\App;
use Timekeepers\Database\Query;


require_once 'database/query.php';

$dbs = new App();
$query = new Query();

// Fetching the latest product
$data = $query->select()->from('barang')->orderBy('price', 'DESC')->limit(1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terbaru - TIMEKEEPERS PROJEK</title>
    <?php include_once 'component/head.php'; ?>
</head>
<body>
    <!--==================== HEADER ====================-->
    <?php include_once 'component/header.php'; ?>
    
    

    <!--==================== CART ====================-->
    <?php include_once 'component/cart.php'; ?>
    

    <!--==================== MAIN ====================-->
    <main class="main">
        <!--==================== NEW PRODUCTS ====================-->
        <section class="home" id="home">
            <div class="home__container container grid">
                <div class="home__img-bg">
                    <img src="assets/img/barang/<?= $data[0]->image ?>" alt="" class="home__img">
                </div>
                <div class="home__social">
                    <a href="https://www.facebook.com/" target="_blank" class="home__social-link">Facebook</a>
                    <a href="https://twitter.com/" target="_blank" class="home__social-link">Twitter</a>
                    <a href="https://www.instagram.com/" target="_blank" class="home__social-link">Instagram</a>
                </div>
                <div class="home__data">
                    <h1 class="home__title">JAM TANGAN BARU<br><?= $data[0]->name ?></h1>
                    <p class="home__description"><?= $data[0]->description ?></p>
                    <span class="home__price">Rp<?= number_format($data[0]->price, 2) ?>,-</span>
                    <div class="home__btns">
                        <a href="#" class="button button--gray button--small">Jelajahi</a>
                        <button class="button home__button" data-id="<?= $data[0]->id ?>">MASUKKAN KE KERANJANG</button>
                    </div>
                </div>
            </div>
        </section>

        <!--==================== TESTIMONIAL ====================-->
        <section class="testimonial section container">
            <div class="testimonial__container grid">
                <div class="swiper testimonial-swiper">
                    <div class="swiper-wrapper">
                        <div class="testimonial__card swiper-slide">
                            <div class="testimonial__quote"><i class='bx bxs-quote-alt-left'></i></div>
                            <p class="testimonial__description">
                                "Jam ini benar-benar mengubah cara saya melihat waktu. Tidak hanya sebagai penghitung detik, tetapi sebagai pengingat akan betapa berharganya setiap momen."
                            </p>
                            <h3 class="testimonial__date">Januari 27. 2024</h3>
                            <div class="testimonial__perfil">
                                <img src="assets/img/testimonial1.jpeg" alt="" class="testimonial__perfil-img">
                                <div class="testimonial__perfil-data">
                                    <span class="testimonial__perfil-name">Antonio Rohmat</span>
                                    <span class="testimonial__perfil-detail">MU assistant coach</span>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial__card swiper-slide">
                            <div class="testimonial__quote"><i class='bx bxs-quote-alt-left'></i></div>
                            <p class="testimonial__description">
                                "Saya suka bagaimana jam ini tidak hanya sekadar menyampaikan waktu, tetapi juga membawa aura kepercayaan diri yang tak terbantahkan."
                            </p>
                            <h3 class="testimonial__date">januari 27. 2024</h3>
                            <div class="testimonial__perfil">
                                <img src="assets/img/testimonial2.jpeg" alt="" class="testimonial__perfil-img">
                                <div class="testimonial__perfil-data">
                                    <span class="testimonial__perfil-name">Alex sleepy</span>
                                    <span class="testimonial__perfil-detail">Owner of Sambal colek</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination swiper-pagination-testimonial"></div>
                </div>
            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer section">
        <div class="footer__container container grid">
            <a href="#" class="footer__logo">
                <i class='bx bxs-watch footer__logo-icon'></i> Timekeepers
            </a>
            <div class="footer__content">
                <div class="footer__data">
                    <h3 class="footer__title">Address</h3>
                    <p class="footer__description">
                        Indonesia <br> Gresik <br> Raya <br> 61111
                    </p>
                </div>
                <div class="footer__data">
                    <h3 class="footer__title">Contact</h3>
                    <ul>
                        <li class="footer__information">+212-222-222</li>
                        <li class="footer__information">contact@gmail.com</li>
                    </ul>
                </div>
                <div class="footer__data">
                    <h3 class="footer__title">Office</h3>
                    <ul>
                        <li class="footer__information">Monday - Saturday</li>
                        <li class="footer__information">9AM - 10PM</li>
                    </ul>
                </div>
                <div class="footer__data">
                    <h3 class="footer__title">Follow us</h3>
                    <div class="footer__social">
                        <a href="https://www.facebook.com/" class="footer__social-link"><i class='bx bxl-facebook-circle'></i></a>
                        <a href="https://twitter.com/" class="footer__social-link"><i class='bx bxl-twitter'></i></a>
                        <a href="https://www.instagram.com/" class="footer__social-link"><i class='bx bxl-instagram'></i></a>
                    </div>
                </div>
            </div>
        </div>
        <p class="footer__copy">&#169; Timekeepers All right reserved</p>
    </footer>

    <!--==================== SCROLL UP ====================-->
    <a href="#" class="scrollup" id="scroll-up"><i class='bx bx-chevrons-up'></i></a>

    <!--==================== SWIPER JS ====================-->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <!--==================== MAIN JS ====================-->
    <script src="assets/js/main.js"></script>
    <!--==================== JQUERY ====================-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--==================== CUSTOM SCRIPT ====================-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productButtons = document.querySelectorAll('.home__button');

            productButtons.forEach(button => {
                button.addEventListener('click', function() {
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
                    button.addEventListener('click', function() {
                        const productId = this.dataset.id;
                        updateCart('minus', productId);
                    });
                });

                plusButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.dataset.id;
                        updateCart('plus', productId);
                    });
                });

                trashButtons.forEach(button => {
                    button.addEventListener('click', function() {
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
