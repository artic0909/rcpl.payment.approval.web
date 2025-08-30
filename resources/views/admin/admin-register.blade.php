<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/registrations/registration-3/assets/css/registration-3.css">
    <title>Admin Register</title>
    <link rel="icon" href="{{ asset('./img/rupee.png') }}" />

</head>

<body>
    <!-- Registration 3 - Bootstrap Brain Component -->
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
                    <div class="d-flex flex-column justify-content-between h-100 p-3 p-md-4 p-xl-5">
                        <h3 class="m-0">Welcome to RCPL Admin Panel!</h3>
                        <img class="img-fluid rounded mx-auto my-4" loading="lazy" src="{{ asset('./img/RCPL.png') }}" width="245" alt="BootstrapBrain Logo">
                        <p class="mb-0">Not a member yet? <a href="#!" class="link-secondary text-decoration-none">Lorem ipsum dolor sit amet.</a></p>
                    </div>
                </div>
                <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
                    <div class="p-3 p-md-4 p-xl-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <h2 class="h3">Registration</h2>
                                    <h3 class="fs-6 fw-normal text-secondary m-0">Enter your details to register</h3>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('admin.register.store') }}" method="POST">
                            @csrf
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <div class="col-12">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ old('name') }}" required>
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ old('email') }}" required>
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-12">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-12">
                                    <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-primary" type="submit">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>