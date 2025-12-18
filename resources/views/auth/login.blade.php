<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kouvee Pet Shop</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Atau jika menggunakan Vite: -->
    {{-- @vite(['resources/css/login.css']) --}}
</head>
<body>

    <!-- Decorative Circles -->
    <div class="login-decorative-circle circle-1"></div>
    <div class="login-decorative-circle circle-2"></div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-card">

            <!-- Logo/Icon -->
            <div class="login-logo">
                🐾
            </div>

            <!-- Title -->
            <h4 class="login-title">Selamat Datang Kembali</h4>
            <p class="login-subtitle">Login untuk mengakses sistem Kouvee Pet Shop</p>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.process') }}" id="loginForm">
                @csrf

                <!-- Error Message -->
                @error('USERNAME')
                <div class="login-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <!-- Username Field -->
                <div class="login-form-group">
                    <label class="login-label">
                        <i class="bi bi-person-fill"></i>
                        Username
                    </label>
                    <i class="bi bi-person-circle login-input-icon"></i>
                    <input 
                        type="text" 
                        name="USERNAME" 
                        class="form-control login-input" 
                        placeholder="Masukkan username Anda"
                        required
                        autocomplete="username"
                        value="{{ old('USERNAME') }}"
                    >
                </div>

                <!-- Password Field -->
                <div class="login-form-group">
                    <label class="login-label">
                        <i class="bi bi-lock-fill"></i>
                        Password
                    </label>
                    <i class="bi bi-shield-lock login-input-icon"></i>
                    <input 
                        type="password" 
                        name="password" 
                        id="passwordInput"
                        class="form-control login-input" 
                        placeholder="Masukkan password Anda"
                        required
                        autocomplete="current-password"
                    >
                    <i class="bi bi-eye password-toggle" id="togglePassword"></i>
                </div>

                <!-- Remember Me (Optional) -->
                <div class="login-remember">
                    <input type="checkbox" id="rememberMe" name="remember">
                    <label for="rememberMe">Ingat saya</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="login-button" id="loginButton">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login
                </button>
            </form>

            <!-- Footer Links (Optional) -->
            <div class="login-footer">
                <a href="{{ url('/') }}" class="login-footer-link">
                    <i class="bi bi-house-door"></i> Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Password Toggle
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('passwordInput');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Toggle icon
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            }

            // Form Submit Loading State
            const loginForm = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');
            
            if (loginForm && loginButton) {
                loginForm.addEventListener('submit', function() {
                    // Add loading state
                    loginButton.classList.add('loading');
                    loginButton.innerHTML = '<span>Memproses...</span>';
                    loginButton.disabled = true;
                });
            }

            // Input Focus Animation
            const inputs = document.querySelectorAll('.login-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });

            // Shake animation for error
            const errorElement = document.querySelector('.login-error');
            if (errorElement) {
                setTimeout(() => {
                    errorElement.style.animation = 'shake 0.5s ease-in-out';
                }, 100);
            }

        });

        // Prevent multiple form submissions
        let isSubmitting = false;
        document.getElementById('loginForm')?.addEventListener('submit', function(e) {
            if (isSubmitting) {
                e.preventDefault();
                return false;
            }
            isSubmitting = true;
        });
    </script>

</body>
</html>