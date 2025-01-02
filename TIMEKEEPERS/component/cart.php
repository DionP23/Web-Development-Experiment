<?php
require_once 'database/connection.php';
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    $cartQuery = $db->prepare("
        SELECT keranjang.*, barang.name, barang.price, barang.image 
        FROM keranjang 
        JOIN barang ON keranjang.barang_id = barang.id 
        WHERE keranjang.users_id = ?
    ");
    $cartQuery->bind_param('i', $userId);
    $cartQuery->execute();
    $cartItems = $cartQuery->get_result()->fetch_all(MYSQLI_ASSOC);

    $summaryQuery = $db->prepare("
        SELECT COUNT(c.barang_id) AS total_items, SUM(p.price * c.quantity) AS total_price
        FROM keranjang c
        JOIN barang p ON c.barang_id = p.id
        WHERE c.users_id = ?
    ");
    $summaryQuery->bind_param('i', $userId);
    $summaryQuery->execute();
    $summary = $summaryQuery->get_result()->fetch_assoc();
}
?>
<div class="cart" id="cart">
    <i class='bx bx-x cart__close' id="cart-close"></i>
    <h2 class="cart__title-center">Keranjang</h2>
    <div class="cart__container">
        <?php if (isset($_SESSION['user'])) : ?>
            <?php foreach ($cartItems as $item) : ?>
                <article class="cart__card">
                    <div class="cart__box"><img src="assets/img/barang/<?= $item['image'] ?>" alt="" class="cart__img"></div>
                    <div class="cart__details">
                        <h3 class="cart__title"><?= $item['name'] ?></h3>
                        <span class="cart__price">Rp<?= number_format($item['price'], 2) ?></span>
                        <div class="cart__amount">
                            <div class="cart__amount-content">
                                <span class="cart__amount-box"><i class='bx bx-minus' data-id="<?= $item['barang_id'] ?>"></i></span>
                                <span class="cart__amount-number"><?= $item['quantity'] ?></span>
                                <span class="cart__amount-box"><i class='bx bx-plus' data-id="<?= $item['barang_id'] ?>"></i></span>
                            </div>
                            <i class='bx bx-trash-alt cart__amount-trash' data-id="<?= $item['barang_id'] ?>"></i>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php if (isset($_SESSION['user'])) : ?>
        <div class="cart__prices">
            <span class="cart__prices-item">Items <?= $summary['total_items'] ?></span>
            <span class="cart__prices-total">Rp.<?= number_format($summary['total_price'], 2) ?>,-</span>
        </div>
    <?php endif; ?>
    <article class="cart__card">


        <div class="cart__details">


            <div class="login" id="login">
                <div class="page-login">
                    <form action="login.php" class="login__form" method="POST">
                        <h2 class="login__title">Log In</h2>

                        <div class="login__group">
                            <div>
                                <label for="email" class="login__label">Email</label>
                                <input name="email" type="email" placeholder="Write your email" id="email" class="login__input" required>
                            </div>

                            <div>
                                <label for="password" class="login__label">Password</label>
                                <input name="password" type="password" placeholder="Enter your password" id="password" class="login__input" re>
                            </div>
                        </div>
                        <div>
                            <p class="login__signup">
                                You do not have an account? <a href="" id="show-signup">Sign up</a>
                            </p>

                            <a href="reset.php" class="login__forgot" id="show-forget">
                                You forgot your password
                            </a>

                            <button type="submit" class="login__button">Log In</button>
                        </div>
                    </form>
                </div>


                <div class="page-regis" style="display: none;">

                    <form action="register.php" class="login__form" method="POST">
                        <h2 class="login__title">Register</h2>

                        <div class="login__group">
                            <div>
                                <label for="email" class="login__label">Email</label>
                                <input name="email" type="email" placeholder="Write your email" id="reg-email" class="login__input">
                            </div>
                            <div>
                                <label for="name" class="login__label">name</label>
                                <input name="name" type="text" placeholder="Write your name" id="reg-name" class="login__input">
                            </div>

                            <div>
                                <label for="password" class="login__label">Password</label>
                                <input name="password" type="password" placeholder="Enter your password" id="reg-password" class="login__input">
                            </div>
                            <div>
                                <label for="confirm" class="login__label">Confirm</label>
                                <input name="confirm_password" type="password" placeholder="Confirm your password" id="confirm" class="login__input">
                            </div>
                        </div>
                        <div>
                            <p class="login__signup">
                                You have an account? <a href="#" id="show-login">Sign in</a>
                            </p>

                            <button type="submit" class="login__button">New Account</button>
                        </div>
                    </form>
                </div>

                <i class="ri-close-line login__close" id="login-close"></i>
            </div>



        </div>
    </article>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const showSignupLink = document.getElementById('show-signup');
        const showLoginLink = document.getElementById('show-login');
        // const showForgetLink = document.getElementById('show-forget');
        const loginForm = document.querySelector('.page-login');
        const signupForm = document.querySelector('.page-regis');
        // const forgetForm = document.querySelector('.page-forget');
        const loginCloseButton = document.getElementById('login-close');
        // console.log(forgetForm);
        showSignupLink.addEventListener('click', function(e) {
            e.preventDefault();
            loginForm.style.display = 'none';
            signupForm.style.display = 'block';
        });

        showLoginLink.addEventListener('click', function(e) {
            e.preventDefault();
            signupForm.style.display = 'none';
            // forgetForm.style.display = 'none';
            loginForm.style.display = 'block';
        });



        
    });
</script>