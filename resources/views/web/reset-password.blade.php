<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>INDEED NUTRITION | RESET PASSWORD</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('web/asset/login.css') }}" />
</head>

<body>
    <div class="main-wrapper">
        <!-- Left Side Login Form -->
        <div class="login-left d-flex flex-column">
            <!-- Logo at top -->
            <div class="logo">
                <img src="{{ asset('web/asset/images/indeed-logo.webp') }}" alt="Indeed Nutrition" />
            </div>

            <!-- Centered form -->
            <div class="flex-grow-1 d-flex flex-column justify-content-center">
                <form>
                    <h5 class="mb-2">Reset password</h5>
                    <p class="text-muted mb-4">Enter your email address we will send you an email to reset password</p>

                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control shadow-none" placeholder="Enter your Email" />
                    </div>

                    <div class="d-grid mb-3">
                        <button class="btn btn-login" type="submit">Reset password</button>
                    </div>
                </form>
            </div>

            <!-- Bottom register -->
            <div class="text-center mt-auto pt-4">
                <span class="text-muted">Back to</span>
                <a href="login.html" class="text-orange text-decoration-none">Login</a>
            </div>
        </div>

        <!-- Right Side Image -->
        <div class="login-right"></div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>