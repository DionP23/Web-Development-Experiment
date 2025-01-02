<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Palanquin+Dark:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col mt-3">
                <span class="p-2 border rounded-circle" style="background: #eee"><i class="bi bi-chevron-left fs-5 ps-1 pe-1 "></i></span>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-6 col-10">
                <div class="row mb-2">
                    <div class="col text-start">
                        <h3>Set a new password</h3>
                        <p class="text-muted">Create a new password. Ensure it differs from
                            previous ones for security</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <form action="update_password.php" method="POST">

                            <div class="row d-flex justify-content-center">
                                <div class="mb-5">
                                    <label for="emaik" class="form-label">Email</label>
                                    <input type="email" class="form-control fs-5 p-2 rounded-3 " id="email" name="email" placeholder="Enter your Email">
                                </div>
                                <div class="mb-5">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control fs-5 p-2 rounded-3 " id="password" name="password" placeholder="Enter your new password">
                                </div>
                                <div class="mb-5">
                                    <label for="confirm" class="form-label">Confirm password</label>
                                    <input type="password" class="form-control fs-5 p-2 rounded-3 " id="confirm" name="password_confirmation" placeholder="Re-enter password">
                                </div>
                                <div class="d-grid mt-3 mb-3">
                                    <button class="btn btn-primary p-3" type="submit">Update Password</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>