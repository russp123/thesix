<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thesix - One Thesis at a Time</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="main-container">

        <div class="content-wrapper">

                <div class="hero-content">
                    <img src="assets/imgs/bg1.png" alt="Background" class="hero-background">
                    <div class="hero-text">
                        <h1 class="hero-title">One thesis at a time</h1>
                        <p class="hero-description">
                            Explore the valuable knowledge and research of scholars from Don Honorio Ventura State University, understanding their work one thesis at a time.
                        </p>
                      
                      
                        <div class="cta-container">
                     
                            <div class="cta-buttons">
                            <a href="login.php"> <button class="cta-button login">Log in</button> </a>
                            <a href="register.php"> <button class="cta-button signup">Sign up</button> </a>
                            </div>
                        </div>
                </div>
            </div>
            <div class="features-section">

    <p class="feature-description">
    <span class="highlight"> A dynamic and accessible platform<br> </span> 
    that enhances the management and visibility<br>
    of capstone/thesis projects.
</p>
    
    <div class="feature-showcase">
    <img src="assets/imgs/showbg.png" alt="Showcase Background" class="showcase-background">     </div> 
    <div class="feature-image">
        <img src="assets/imgs/showimg1.png" alt="THESIX platform preview" class="info-image">
        <img src="assets/imgs/showimg2.png" alt="THESIX platform preview" class="info-image">

</div>

    <div class="feature-details">
        <div class="feature-text">
            <p>
            <span class="highlight">THESIX is a centralized, web-based repository </span> that simplifies the storage, access, and management of capstone and thesis projects with features like online manuscript storage, bookmarking, personal archives, and a duplication checker.
            </p>
        </div>
    </div>
</div>

                </div>
                <div class="fact-section">
                    <div class="fact-content">
                        <span class="fact-label">Did you know?</span>
                        <h3 class="fact-title">67% worldwide</h3>
                        <p class="fact-description">
                            the number of internet users has been growing exponentially, approximately 67 percent of the world's population, or 5.4 billion people, is now online.
                        </p>
                    </div>
                </div>

            <div class="access">
                <h2 class="access-title">Access everything</h2>
                <p class="access-description">
                    Explore a comprehensive collection of academic research and theses, all available for free on Thesix.
                </p>


                                <!-- Loading Spinner HTML -->
                <div id="loading-overlay" class="loading-overlay">
                    <div class="spinner"></div>
                </div>

                <div class="access-cta">
                <a href="login.php">   <button class="cta-button login">Log in</button> </a>
                <a href="register.php">   <button class="cta-button signup">Sign up</button> </a>
                </div>
                </div>
                
                <div  class="bottom">
                <img src="assets/imgs/books.png" alt="THESIX books" class="books">
                </div>
            </div>
        </div>
    </div>



    <script> 

document.addEventListener('DOMContentLoaded', function () {
    const loadingOverlay = document.getElementById('loading-overlay');
    const buttons = document.querySelectorAll('.cta-button');

    buttons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default action if necessary

            loadingOverlay.style.display = 'flex'; // Show the spinner

            // Use setTimeout to ensure overlay is hidden before redirection
            setTimeout(() => {
                // Hide the loading overlay before redirecting
                loadingOverlay.style.display = 'none';
                
                // Redirect to the URL specified in the button's parent element's href attribute
                window.location.href = button.parentElement.getAttribute('href');
            }, 200); // Adjust the delay as needed
        });
    });
});



    </script>
</body>
</html>

