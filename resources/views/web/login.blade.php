<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>INDEED NUTRITION | LOGIN</title>
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
                    <h5 class="mb-2">Log in</h5>
                    <p class="text-muted mb-4">Enter your email address and password</p>

                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control shadow-none" placeholder="Enter your Email" />
                    </div>

                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <label class="form-label">Password</label>
                        <a href="#" class="text-orange text-decoration-none" style="font-size: 14px;">Forgot
                            password?</a>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control shadow-none" placeholder="Enter your password" />
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="rememberMe" />
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>

                    <div class="d-grid mb-3">
                        <button class="btn btn-login" type="submit">Login</button>
                    </div>

                    <div class="text-center mb-3">Login with</div>
                    <div class="d-flex justify-content-center social-icons mb-4 gap-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="m13.064 6.685l.745-.306c.605-.24 1.387-.485 2.31-.33c1.891.318 3.195 1.339 3.972 2.693c.3.522.058 1.21-.502 1.429a2.501 2.501 0 0 0 .133 4.706c.518.17.81.745.64 1.263c-.442 1.342-1.078 2.581-1.831 3.581c-.744.988-1.652 1.808-2.663 2.209c-.672.266-1.39.16-2.078-.013l-.408-.11l-.585-.163l-.319-.079a2.3 2.3 0 0 0-.478-.067c-.13 0-.285.024-.478.067l-.32.08l-.787.218c-.748.203-1.544.36-2.283.067c-1.273-.504-2.396-1.68-3.245-3.067a13.5 13.5 0 0 1-1.784-4.986c-.227-1.554-.104-3.299.615-4.775c.74-1.521 2.096-2.705 4.163-3.053c.84-.141 1.562.048 2.14.265l.331.13l.584.241c.4.157.715.249 1.064.249c.348 0 .664-.092 1.064-.249M10.19 8.542l-.348-.143c-.731-.306-1.138-.46-1.63-.378c-1.392.235-2.221.982-2.696 1.957c-.496 1.018-.62 2.332-.434 3.61c.228 1.558.789 3.05 1.511 4.232c.738 1.205 1.571 1.972 2.275 2.25c.24.095.585.02.905-.078l.443-.146l.122-.038l.433-.12c.386-.1.821-.19 1.229-.19c.407 0 .843.09 1.229.19l.433.12l.122.038l.443.146c.32.098.665.173.905.078c.547-.216 1.183-.732 1.8-1.552c.46-.61.88-1.352 1.223-2.177A4.5 4.5 0 0 1 16 12.5c0-1.447.682-2.732 1.74-3.555c-.473-.45-1.107-.781-1.952-.924c-.443-.074-.817.043-1.42.291l-.21.087c-.541.227-1.276.535-2.158.535c-.705 0-1.317-.197-1.81-.392m1.578-5.774c.976-.977 2.475-1.061 2.828-.707c.354.353.27 1.852-.707 2.828c-.976.976-2.475 1.06-2.828.707c-.354-.353-.27-1.852.707-2.828"/></g></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 48 48"><path fill="#ffc107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917"/><path fill="#ff3d00" d="m6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C16.318 4 9.656 8.337 6.306 14.691"/><path fill="#4caf50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.9 11.9 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44"/><path fill="#1976d2" d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 256 256"><path fill="#1877f2" d="M256 128C256 57.308 198.692 0 128 0S0 57.308 0 128c0 63.888 46.808 116.843 108 126.445V165H75.5v-37H108V99.8c0-32.08 19.11-49.8 48.348-49.8C170.352 50 185 52.5 185 52.5V84h-16.14C152.959 84 148 93.867 148 103.99V128h35.5l-5.675 37H148v89.445c61.192-9.602 108-62.556 108-126.445"/><path fill="#fff" d="m177.825 165l5.675-37H148v-24.01C148 93.866 152.959 84 168.86 84H185V52.5S170.352 50 156.347 50C127.11 50 108 67.72 108 99.8V128H75.5v37H108v89.445A129 129 0 0 0 128 256a129 129 0 0 0 20-1.555V165z"/></svg>
                    </div>
                </form>
            </div>

            <!-- Bottom register -->
            <div class="text-center mt-auto pt-4">
                <span class="text-muted">New to ziettech?</span>
                <a href="#" class="text-orange text-decoration-none">Register now</a>
            </div>
        </div>

        <!-- Right Side Image -->
        <div class="login-right"></div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>