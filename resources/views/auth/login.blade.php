<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap and Font Awesome CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6B7280;
            --primary-dark: #6B7280;
            --accent-color: #6B7280;
            --success-color: #6B7280;
            --text-color: #1F2937;
            --light-text: #6B7280;
            --background: #F9FAFB;
            --card-bg: #FFFFFF;
            --border-radius: 16px;
            --input-radius: 12px;
        }

        body {
            background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            color: var(--text-color);
            overflow-x: hidden;
        }

        .background-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(225deg, rgba(255, 255, 255, 0.2) 0%, rgba(0, 0, 0, 0.05) 100%);
            animation: float 15s infinite ease-in-out;
        }

        .shape-1 {
            width: 400px;
            height: 400px;
            left: -150px;
            top: -150px;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            right: -100px;
            bottom: -100px;
            animation-delay: -7s;
        }

        .shape-3 {
            width: 200px;
            height: 200px;
            right: 20%;
            top: 10%;
            animation-delay: -3s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-20px) scale(1.05);
            }
        }

        .login-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            padding: 0;
            position: relative;
            animation: slideIn 0.8s ease-out forwards;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .logo-container {
            position: relative;
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            animation: logoAnimation 1s ease-out 0.3s forwards;
            transform: scale(0);
        }

        @keyframes logoAnimation {
            0% {
                transform: scale(0) rotate(-30deg);
            }
            50% {
                transform: scale(1.1) rotate(5deg);
            }
            100% {
                transform: scale(1) rotate(0);
            }
        }

        .logo-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
        }

        .card-title {
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 1.75rem;
            opacity: 0;
            animation: fadeIn 0.5s ease-out 0.6s forwards;
        }

        .card-subtitle {
            opacity: 0.85;
            font-weight: 400;
            font-size: 1rem;
            opacity: 0;
            animation: fadeIn 0.5s ease-out 0.8s forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 500;
            color: var(--light-text);
            margin-bottom: 0.5rem;
            display: block;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
            opacity: 0;
            transform: translateX(-10px);
        }

        #email-group {
            animation: slideRight 0.5s ease-out 1s forwards;
        }

        #password-group {
            animation: slideRight 0.5s ease-out 1.2s forwards;
        }

        #remember-group {
            animation: slideRight 0.5s ease-out 1.4s forwards;
        }

        #action-group {
            animation: slideRight 0.5s ease-out 1.6s forwards;
        }

        @keyframes slideRight {
            0% {
                opacity: 0;
                transform: translateX(-10px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-control {
            border: 1px solid #E5E7EB;
            border-radius: var(--input-radius);
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            padding-left: 3rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 0.75rem;
            color: var(--light-text);
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .form-control:focus + .input-icon {
            color: var(--primary-color);
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 0.75rem;
            color: var(--light-text);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toggle-password:hover {
            color: var(--primary-color);
        }

        .checkbox-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .custom-checkbox {
            position: relative;
            padding-left: 35px;
            cursor: pointer;
            font-weight: 400;
            user-select: none;
            color: var(--light-text);
        }

        .custom-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 22px;
            width: 22px;
            background-color: #fff;
            border: 2px solid #E5E7EB;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .custom-checkbox:hover input ~ .checkmark {
            background-color: #f9fafb;
        }

        .custom-checkbox input:checked ~ .checkmark {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .custom-checkbox input:checked ~ .checkmark:after {
            display: block;
        }

        .custom-checkbox .checkmark:after {
            left: 7px;
            top: 3px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .forgot-link {
            font-weight: 500;
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .forgot-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            border-radius: var(--input-radius);
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
            min-width: 120px;
            overflow: hidden;
            position: relative;
        }

        .btn-login:hover {
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
            transform: translateY(-2px);
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
        }

        .btn-login:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            opacity: 0;
        }

        .btn-login:focus:after {
            animation: ripple 0.6s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0) translate(-50%, -50%);
                opacity: 1;
            }
            100% {
                transform: scale(20) translate(-50%, -50%);
                opacity: 0;
            }
        }

        .alert {
            position: relative;
            animation: alertSlideDown 0.5s ease-out forwards;
            background-color: var(--success-color);
            color: white;
            border-radius: var(--input-radius);
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.1);
        }

        @keyframes alertSlideDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .invalid-feedback {
            color: #EF4444;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            display: block;
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }

        @keyframes shake {
            10%, 90% {
                transform: translateX(-1px);
            }
            20%, 80% {
                transform: translateX(2px);
            }
            30%, 50%, 70% {
                transform: translateX(-3px);
            }
            40%, 60% {
                transform: translateX(3px);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                margin: 1rem;
            }

            .card-body, .card-header {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
<!-- Background shapes -->
<div class="background-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
</div>

<div class="login-card">
    <div class="card-header">
        <div class="logo-container">
            <i class="fas fa-user-shield logo-icon"></i>
        </div>
        <h1 class="card-title">Welcome Back</h1>
        <p class="card-subtitle">Sign in to your account</p>
    </div>

    <div class="card-body">
        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="input-group" id="email-group">
{{--                <label for="email" class="form-label">Email Address</label>--}}
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                <i class="fas fa-envelope input-icon"></i>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-group" id="password-group">
{{--                <label for="password" class="form-label">Password</label>--}}
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">
                <i class="fas fa-lock input-icon"></i>
                <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="input-group" id="remember-group">
                <div class="checkbox-wrapper">
                    <label class="custom-checkbox">
                        Remember me
                        <input type="checkbox" id="remember_me" name="remember">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between align-items-center input-group" id="action-group">
                @if (Route::has('password.request'))
                    <a href="{{ route('home') }}" class="forgot-link">Go Home?</a>
                @endif
                <button type="submit" class="btn-login">
                    Log in <i class="fas fa-arrow-right ms-1"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        if (togglePassword && password) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }

        // Add ripple effect to button
        const loginBtn = document.querySelector('.btn-login');
        if (loginBtn) {
            loginBtn.addEventListener('click', function(e) {
                const x = e.clientX - e.target.getBoundingClientRect().left;
                const y = e.clientY - e.target.getBoundingClientRect().top;

                const ripple = document.createElement('span');
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        }

        // Animate form elements
        const animateCSS = (element, animation, delay = 0) => {
            return new Promise((resolve) => {
                const node = document.querySelector(element);
                if (!node) return resolve('Element not found');

                node.style.animationDelay = `${delay}s`;
                node.classList.add('animated', animation);

                function handleAnimationEnd() {
                    node.classList.remove('animated', animation);
                    node.removeEventListener('animationend', handleAnimationEnd);
                    resolve('Animation ended');
                }

                node.addEventListener('animationend', handleAnimationEnd);
            });
        };

        // Focus effect on input fields
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('input-focused');
            });

            input.addEventListener('blur', function() {
                if (this.value === '') {
                    this.parentElement.classList.remove('input-focused');
                }
            });

            // Add initial class if input has value (for page refresh cases)
            if (input.value !== '') {
                input.parentElement.classList.add('input-focused');
            }
        });
    });
</script>
</body>
</html>
