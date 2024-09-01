<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verified</title>
    <link rel="stylesheet" href="assets/css/congratsstyle.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <button class="image-button">
                <img src="assets/imgs/logo.png" alt="Congratulations icon">
            </button>
            <h1 class="title">Congratulations!</h1>
            <p class="message">
                Your e-mail has been verified, you will be redirected<br>
                to the startup in a moment
            </p>  
           <button class="cta-button" onclick="enter()">Enter your startup information</button>
        </div>
    </div>
    <script>

     function enter() {
            window.location.href = 'login.php'; 
            console.log('enter is clicked');
        }


    </script>
</body>
</html>