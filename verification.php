<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" href="assets/css/verificationstyle.css">
</head>
<body>
<div id="loading-overlay" class="loading-overlay">
    <div class="spinner"></div>
</div>

    <section class="email-verification-container">
        <div class="verification-card">
            <div class="card-content">
                <h2 class="verification-title">
                    <img src="assets/imgs/logo.png" alt="Logo" class="logo" onclick="handleLogoClick()">
                    <div class="title-container">
                        <div class="title">Verify e-mail address</div>
                        <div class="verification-instruction">Please enter the 4-digit code sent to your email</div>
                    </div>
                </h2>
                <form action="verify.php" method="POST">
                    <div class="code-input-container">
                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
                        <input type="hidden" name="action" value="verify">
                        <input type="text" id="code-input-1" name="code1" class="code-input" maxlength="1" aria-label="First digit" oninput="moveFocus(this, 'code-input-2')">
                        <input type="text" id="code-input-2" name="code2" class="code-input" maxlength="1" aria-label="Second digit" oninput="moveFocus(this, 'code-input-3', 'code-input-1')">
                        <input type="text" id="code-input-3" name="code3" class="code-input" maxlength="1" aria-label="Third digit" oninput="moveFocus(this, 'code-input-4', 'code-input-2')">
                        <input type="text" id="code-input-4" name="code4" class="code-input" maxlength="1" aria-label="Fourth digit" oninput="moveFocus(this, '', 'code-input-3')">

                    </div>
                    <button type="submit" class="verify-button">Verify</button>
                </form>

                <p class="resend-code">
                    Didn't receive a code? <a href="#" class="resend-link" onclick="resendCode()">Resend new code</a>
                </p>
            </div>
        </div>
    </section>

    <script>
    function moveFocus(currentInput, nextInputId, prevInputId) {
        const value = currentInput.value;

        // Move focus to the right
        if (value.length >= 1) {
            document.getElementById(nextInputId).focus();
        } 
        // Move focus to the left if the current input is being cleared
        else if (value.length === 0 && prevInputId) {
            document.getElementById(prevInputId).focus();
        }
    }

    function handleLogoClick() {
        window.location.href = 'index.php';
    }

    function resendCode() {
        const email = document.querySelector('input[name="email"]').value;
        const formData = new FormData();
        formData.append('email', email);
        formData.append('action', 'resend');

        fetch('verify.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form from submitting the traditional way

        const formData = new FormData(this);

        // Show loading overlay
        document.getElementById('loading-overlay').style.display = 'flex';

        fetch('verify.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Keep the loading overlay visible for a longer duration
            setTimeout(() => {
                document.getElementById('loading-overlay').style.display = 'none';
                
                if (data.status === 'error') {
                    showOverlay(data.message);
                } else if (data.status === 'success') {
                    window.location.href = 'login.php';
                }
            }, 3000); // Adjust the delay time here (in milliseconds)
        })
        .catch(error => {
            // Hide loading overlay
            document.getElementById('loading-overlay').style.display = 'none';
            console.error('Error:', error);
        });
    });

    function showOverlay(message) {
        const overlay = document.createElement('div');
        overlay.className = 'error-overlay';
        overlay.textContent = message;

        overlay.addEventListener('click', function() {
            document.body.removeChild(overlay);
        });

        document.body.appendChild(overlay);
    }
</script>



</body>
</html>
