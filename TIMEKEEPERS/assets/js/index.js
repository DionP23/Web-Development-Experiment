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



    // loginCloseButton.addEventListener('click', function() {
    //     loginForm.style.display = 'none';
    //     signupForm.style.display = 'none';
    //     // forgetForm.style.display = 'none';
    // });
});



document.addEventListener('DOMContentLoaded', function() {
    const cartShop = document.getElementById('cart-shop');

    productButtons.forEach(button => {
        button.addEventListener('click', function() {


            // Animate cart icon
            cartShop.classList.add('active');
            setTimeout(() => {
                cartShop.classList.remove('active');
            }, 3000); // 3 seconds
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // alert('')
    const productButtons = document.getElementById('button-cart');

    productButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.id;
            console.log(productId)
            // Cek apakah user sudah login
            fetch('check_login.php')
                .then(response => response.json())
                .then(data => {
                    if (!data.loggedIn) {
                        // User belum login
                        this.classList.add('failed');
                        this.textContent = 'Keranjang gagal';
                    } else {
                        // User sudah login
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

                                    this.textContent = 'Berhasil ditambahkan';
                                } else {

                                    this.classList.add('failed');
                                    this.textContent = 'Keranjang gagal';
                                }
                            });
                    }
                });
        });
    });
});