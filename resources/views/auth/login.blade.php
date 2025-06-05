<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-warning">
    <div class="container-fluid vh-100 d-flex align-items-center justify-content-center p-4">
        <div class="row bg-white rounded shadow-lg overflow-hidden w-100" style="max-width: 1000px;">
            <!-- Form Section -->
            <div class="col-lg-6 p-5">
                <div class="mb-4">
                    <i class="fas fa-bolt text-warning fs-2"></i>
                </div>
                
                <h1 class="fw-bold mb-3 display-6">Welcome back</h1>
                <p class="text-muted mb-4 lead">Sign in to access your account and continue your journey.</p>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" 
                               value="{{ old('email') }}" placeholder="Your email" required>
                        @error('email')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password" 
                               placeholder="Your password" required>
                        @error('password')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-warning btn-lg w-100 fw-semibold mb-4 text-white">Sign in</button>
                </form>
                
                <div class="text-center mb-4">
                    <div class="d-flex align-items-center">
                        <hr class="flex-grow-1">
                        <span class="px-3 text-muted">OR</span>
                        <hr class="flex-grow-1">
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-4">
                        <button class="btn btn-outline-secondary w-100 py-3">
                            <i class="fab fa-google fs-5"></i>
                        </button>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-outline-secondary w-100 py-3">
                            <i class="fab fa-facebook-f fs-5"></i>
                        </button>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-outline-secondary w-100 py-3">
                            <i class="fab fa-apple fs-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial Section -->
            <div class="col-lg-6 bg-warning text-white p-5 d-flex flex-column justify-content-center position-relative d-none d-lg-flex">
                <div class="mt-auto">
                    <div class="bg-white bg-opacity-25 rounded p-4">
                        <h4 class="fw-semibold mb-3">I was able to reduce the time taken to present high-level designs by 35% using the platform.</h4>
                        <div>
                            <div class="fw-semibold">Sara Bright</div>
                            <small class="opacity-75">Freelance Designer</small>
                        </div>
                    </div>
                </div>
                
                <div class="position-absolute bottom-0 end-0 p-4">
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-light rounded-circle p-2" style="width: 45px; height: 45px;">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="btn btn-outline-light rounded-circle p-2" style="width: 45px; height: 45px;">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>