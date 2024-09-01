<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Section</title>
    <link rel="stylesheet" href="assets/css/loginstyle.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="header">
                <a href="index.php">
                    <img src="assets/imgs/logo.png" alt="Logo" class="logo" onclick="handleLogoClick()">
                </a>
                <div class="title-container">
                    <div class="title">Login here</div>
                    <div class="subtitle">Welcome back, you've been missed!</div>
                </div>
            </div>
            <form id="login-form" action="login1.php" method="POST">
                <input type="email" name="email" class="input-field" placeholder="Enter your email" required>
                <div class="password-container">
                    <input type="password" name="password" class="input-field password-input" placeholder="Enter your password" required>
                    <img src="assets/imgs/openeye.png" alt="Show/Hide Password" class="eye-icon" onclick="togglePasswordVisibility()">
                </div>
                <div class="forgot-password" onclick="handleForgotPassword()">Forgot your password?</div>
                <div id="loading-overlay" class="loading-overlay">
                    <div class="spinner"></div>
                </div>
                <div class="button-container">
                    <button type="submit" class="sign-in-button">Sign in</button>
                    <div class="create-account">
                        <p>Don't have an account? <span class="create-account-link" onclick="handleCreateAccount()">Create an account</span></p>
                    </div>
                </div>
            </form>
        </div>
    </div>






    <script>
    function handleLogoClick() {
        window.location.href = 'index.php'; 
        console.log('Logo clicked');
    }

    function togglePasswordVisibility() {
        const passwordInput = document.querySelector('.password-input');
        const eyeIcon = document.querySelector('.eye-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.src = 'assets/imgs/closedeye.png';
        } else {
            passwordInput.type = 'password';
            eyeIcon.src = 'assets/imgs/openeye.png';
        }
    }

    function handleForgotPassword() {
        alert('Forgot password clicked');
    }

    function handleCreateAccount() {
        window.location.href = 'register.php'; 
        console.log('Create account clicked');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const loadingOverlay = document.getElementById('loading-overlay');
        const form = document.getElementById('login-form');

        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            loadingOverlay.style.display = 'flex'; // Show the spinner

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                // Ensure spinner is visible for a bit longer
                setTimeout(() => {
                    loadingOverlay.style.display = 'none'; // Hide the spinner

                    if (result === 'success') {
                        // Delay the redirection
                        setTimeout(() => {
                            window.location.href = 'main.php'; // Redirect on successful login
                        }, 1000); // Adjust delay before redirection (in milliseconds)
                    } else {
                        alert(result);
                    }
                }, 500); // Adjust spinner visibility duration (in milliseconds)
            })
            .catch(error => {
                loadingOverlay.style.display = 'none'; // Hide the spinner
                console.error('Error:', error);
            });
        });
    });
</script>


</body>
</html>
