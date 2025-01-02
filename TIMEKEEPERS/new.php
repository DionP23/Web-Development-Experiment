<?php

use Timekeepers\Database\App;
use Timekeepers\Database\Query;

require_once 'database/query.php';

$db = new App();
$query = new Query();

$data = $query->select()->from('barang')->orderBy('id', 'DESC')->limit(3);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once 'component/head.php' ?>
    <title>Terbaru - TIMEKEEPERS PROJEK</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    <?php include_once 'component/header.php' ?>

    <!--==================== CART ====================-->
    <?php

    include_once 'component/cart.php';


    ?>

    <!--==================== MAIN ====================-->
    <main class="main">
        <!--==================== NEW PRODUCTS ====================-->
        <section class="new section container" id="new">
            <h2 class="section__title">PRODUK TERBARU</h2>
            <div class="new__container grid">
                <?php foreach ($data as $item) : ?>
                    <article class="new__card">
                        <img src="assets/img/barang/<?= $item->image ?>" alt="" class="new__img">
                        <div class="new__data">
                            <h3 class="new__title"><?= $item->name ?></h3>
                            <span class="new__price">Rp<?= number_format($item->price) ?>,-</span>
                        </div>
                        <button class="button new__button" data-id="<?= $item->id ?>">MASUKKAN KE KERANJANG</button>
                    </article>
                <?php endforeach; ?>

            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <?php include_once 'component/footer.php' ?>

    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up"><i class='bx bx-up-arrow-alt scrollup__icon'></i></a>
    <!--=============== SWIPER JS ===============-->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productButtons = document.querySelectorAll('.new__button');

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