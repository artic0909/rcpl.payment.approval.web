<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Staff Login | RCPL</title>
    <!-- Bootstrap 5 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('./css/login.css') }}" />

    <!-- favicon -->
    <link rel="icon" href="{{ asset('./img/RCPL.png') }}" />
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="payment-card">
                    <div class="payment-header">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="img/RCPL.png" alt="RCPL LOGO" class="bank-logo" />
                            <h2>Forget Password</h2>
                        </div>
                    </div>

                    <div class="payment-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Staff Code<span style="color: red">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="username"
                                                placeholder="Enter your staff code" />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Register Email<span style="color: red">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id=""
                                                placeholder="Enter your email" />
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <a href="" class="float-end">Send OTP</a>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            <input
                                                type="password"
                                                class="form-control"
                                                id="password"
                                                placeholder="Enter your password" />
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-login w-100 mb-3">
                                        <i class="fas fa-unlock-alt me-2"></i>Update Password
                                    </button>

                                    <div class="text-center">
                                        <p class="mb-0">
                                            New to our payment system?
                                            <a href="/stuff-register">Register</a>
                                        </p>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-6">
                                <div class="payment-features">
                                    <h3 class="mb-4">Secure Transaction Features</h3>

                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                        <div>
                                            <h5>Multi-Factor Authentication</h5>
                                            <p class="mb-0">
                                                Enhanced security with multiple verification steps
                                            </p>
                                        </div>
                                    </div>

                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-bell"></i>
                                        </div>
                                        <div>
                                            <h5>Instant Alerts</h5>
                                            <p class="mb-0">
                                                Get notified for all account activities
                                            </p>
                                        </div>
                                    </div>

                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <div>
                                            <h5>Transaction Monitoring</h5>
                                            <p class="mb-0">
                                                Real-time monitoring of all payment activities
                                            </p>
                                        </div>
                                    </div>

                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <div>
                                            <h5>Fraud Protection</h5>
                                            <p class="mb-0">
                                                Advanced systems to protect against unauthorized
                                                access
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="payment-footer">
                        <p>
                            © 2025 Ranihati Construction PVT LTD. All rights reserved.
                            Various trademarks held by their respective owners.
                        </p>
                        <div class="bank-logos">
                            <i class="fab fa-cc-visa fa-2x bank-logo"></i>
                            <i class="fab fa-cc-mastercard fa-2x bank-logo"></i>
                            <i class="fab fa-cc-amex fa-2x bank-logo"></i>
                            <i class="fab fa-cc-paypal fa-2x bank-logo"></i>
                            <i class="fab fa-cc-apple-pay fa-2x bank-logo"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>