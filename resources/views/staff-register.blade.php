<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Staff Registration | RCPL</title>
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
  <link rel="stylesheet" href="{{ asset('./css/register.css') }}" />
  <link rel="stylesheet" href="{{ asset('./css/style.css') }}" />

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
              <h2>RCPL Payment Approval</h2>
            </div>
            <p class="mb-0 mt-2">
              Authorized access only. Please verify your identity.
            </p>
          </div>

          <div class="payment-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="secure-badge">
                  <i class="fas fa-shield-alt me-2"></i>256-bit SSL Encryption
                </div>
                <h3 class="mb-4">Staff Registration</h2>

                  <form action="{{ route('staff.register') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                      <label for="name" class="form-label">Staff Name <span class="text-danger">*</span></label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          name="name"
                          placeholder="Enter full name"
                          required />
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="staff_code" class="form-label">Staff Code <span class="text-danger">*</span></label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input
                          type="text"
                          class="form-control"
                          id="staff_code"
                          name="staff_code"
                          placeholder="Enter staff code"
                          required />
                      </div>
                      <div class="form-text">
                        Your unique identification code provided by HR
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input
                          type="email"
                          class="form-control"
                          id="email"
                          name="email"
                          placeholder="Enter email address"
                          required />
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="mobile" class="form-label">Phone Number <span class="text-danger">*</span></label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input
                          type="number"
                          class="form-control"
                          id="mobile"
                          name="mobile"
                          placeholder="Enter phone number"
                          required />
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input
                          type="password"
                          class="form-control"
                          id="password"
                          name="password"
                          placeholder="Enter password"
                          required />
                      </div>
                      <small>Password must be at least <span style="color: red;">8 characters</span></small>
                    </div>

                    <div class="mb-3">
                      <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input
                          type="password"
                          class="form-control"
                          id="password_confirmation"
                          name="password_confirmation"
                          placeholder="Confirm password"
                          required />
                      </div>
                    </div>




                    <button type="submit" class="btn btn-register w-100 mb-3">
                      <i class="fas fa-user-check me-2"></i>Register & Request
                      Approval
                    </button>

                    <div class="text-center">
                      <p class="mb-0">
                        Already have an account? <a href="/">Login</a>
                      </p>
                    </div>
                  </form>
              </div>

              <div class="col-lg-6">
                <div class="payment-features">
                  <h3 class="mb-4">Registration Benefits</h3>

                  <div class="feature-item">
                    <div class="feature-icon">
                      <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <div>
                      <h5>Access to Payment Dashboard</h5>
                      <p class="mb-0">
                        Monitor and approve transactions in real-time
                      </p>
                    </div>
                  </div>

                  <div class="feature-item">
                    <div class="feature-icon">
                      <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div>
                      <h5>Transaction History</h5>
                      <p class="mb-0">
                        View complete payment approval history
                      </p>
                    </div>
                  </div>

                  <div class="feature-item">
                    <div class="feature-icon">
                      <i class="fas fa-bell"></i>
                    </div>
                    <div>
                      <h5>Instant Notifications</h5>
                      <p class="mb-0">Get alerts for pending approvals</p>
                    </div>
                  </div>

                  <div class="feature-item">
                    <div class="feature-icon">
                      <i class="fas fa-shield-alt"></i>
                    </div>
                    <div>
                      <h5>Multi-level Security</h5>
                      <p class="mb-0">
                        Role-based access control for all staff members
                      </p>
                    </div>
                  </div>

                  <div class="feature-item">
                    <div class="feature-icon">
                      <i class="fas fa-hands-helping"></i>
                    </div>
                    <div>
                      <h5>Dedicated Support</h5>
                      <p class="mb-0">
                        24/7 assistance for payment-related issues
                      </p>
                    </div>
                  </div>

                  <div class="mt-4 p-3 bg-white rounded-2">
                    <h5>
                      <i class="fas fa-info-circle text-primary me-2"></i>Registration Process
                    </h5>
                    <p class="mb-0 small">
                      After submitting this form, your registration will be
                      reviewed and approved by administration. You will
                      receive an email with login credentials once approved.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="payment-footer">
            <p>
              © 2025 Ranihati Construction PVT LTD. All rights reserved. Various
              trademarks held by their respective owners.
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

  @if (session('success'))
  <div id="successPopup" class="custom-success-popup">
    {{ session('success') }}
  </div>
  @endif

  @if (session('error'))
  <div id="errorPopup" class="custom-error-popup">
    {{ session('error') }}
  </div>
  @endif

  <!-- {{-- For validation errors (from withErrors) --}} -->
  @if ($errors->has('error'))
  <div id="errorPopup" class="custom-error-popup">
    {{ $errors->first('error') }}
  </div>
  @endif


  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const successPopup = document.getElementById('successPopup');
      const errorPopup = document.getElementById('errorPopup');

      if (successPopup) setTimeout(() => successPopup.remove(), 4000);
      if (errorPopup) setTimeout(() => errorPopup.remove(), 4000);
    });
  </script>

  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>