<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="assets/css/registerstyle.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="header">
                <img src="assets/imgs/logo.png" alt="Logo" class="logo" onclick="handleLogoClick()">
                <div class="title-container">
                    <div class="title">Create your Account</div>
                    <div class="subtitle">to continue using THESIX</div>
                </div>
            </div>
            <form id="registrationForm" action="register1.php" method="POST">
                <div class="input-group">
                    <input type="text" class="input-field" name="first_name" placeholder="Enter your first name" required>
                    <input type="text" class="input-field" name="last_name" placeholder="Enter your last name" required>
                </div>
                <div class="password-container">
                    <input type="password" class="password-input" name="password" placeholder="Enter your password" required>
                    <img src="assets/imgs/openeye.png" alt="Show/Hide Password" class="eye-icon" onclick="togglePasswordVisibility()">
                </div>
                <input type="email" class="input-field" name="email" placeholder="Enter your email address" required>
                <button type="submit" class="verify-button">Send Verification Code</button>
            </form>
            <p class="login-text">
                Already have an account? <a href="login.php" class="login-link">Sign in</a>
            </p>
        </div>
    </div>
    <div id="loading-overlay" class="loading-overlay" style="display: none;">
        <div class="spinner"></div>
    </div>
    <script>
        function handleLogoClick() {
            window.location.href = 'index.php';
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

        function validateEmail() {
            const emailInput = document.querySelector('input[name="email"]');
            const email = emailInput.value;
            const domain = "@dhvsu.edu.ph";

            if (!email.endsWith(domain)) {
                emailInput.style.borderColor = "red";
                alert("Please use your @dhvsu.edu.ph email address.");
                return false;
            }
            emailInput.style.borderColor = "";
            return true;
        }

        async function validateForm(event) {
            event.preventDefault(); // Prevent default form submission

            let valid = true;
            const inputs = document.querySelectorAll('.input-field, .password-input');
            inputs.forEach(input => {
                if (input.value.trim() === "") {
                    input.style.borderColor = "red";
                    valid = false;
                } else {
                    input.style.borderColor = "";
                }
            });

            if (!validateEmail()) {
                valid = false;
            }

            if (!valid) return; // If not valid, stop the function

            // Show loading overlay
            document.getElementById('loading-overlay').style.display = 'flex';

            // Create FormData object
            const formData = new FormData(document.getElementById('registrationForm'));

            try {
                const response = await fetch('register1.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                document.getElementById('loading-overlay').style.display = 'none'; // Hide loading overlay

                if (result.error) {
                    document.querySelector('input[name="email"]').style.borderColor = "red";
                    alert(result.error);
                } else if (result.success) {
                    // Handle successful response
                    alert(result.success);
                    window.location.href = 'verification.php?email=' + encodeURIComponent(formData.get('email'));
                }
            } catch (error) {
                document.getElementById('loading-overlay').style.display = 'none'; // Hide loading overlay
                console.error('Error:', error);
                alert('An error occurred while processing your request. Please try again later.');
            }
        }

        document.getElementById('registrationForm').addEventListener('submit', validateForm);
    </script>
</body>
</html>
