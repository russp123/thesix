<?php

$host = 'localhost';
$db = 'pdf_uploads';
$user = 'pdf_uploads';
$pass = '123';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Retrieve the list of files
$stmt = $pdo->query('SELECT id, filename FROM pdf_files');
$files = $stmt->fetchAll();

// Retrieve the latest project details
$stmt = $pdo->query('SELECT * FROM pdf_files ORDER BY uploaded_at DESC');
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thesix Homepage</title>
    <link rel="stylesheet" href="assets/css/mainstyle.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <a href="main.php" class="logo">
                <img src="assets/imgs/logo.png" alt="Thesix Logo" />
                <span class="logo-text">Thesix</span>
            </a>
            <div class="search-box">
                <input type="text" placeholder="Search" />
                <img src="assets/imgs/search.png" alt="Search" />
            </div>
            <div class="icons">
                <a href="#"><img src="assets/imgs/headerbookmark.png" alt="Notifications" /></a>
                <a href="#"><img src="assets/imgs/withnotif.png" alt="Messages" /></a>
            </div>
            <a href="#" class="profile">
                <img src="assets/imgs/avatar.png" alt="Profile" class="profile-icon" />
            </a>
        </header>

        <main class="main-content">
            <div class="left-column">
                <a href="#" class="publish-box">
                    <div class="publish-input">
                        <img src="assets/imgs/avatar.png" alt="Publish" />
                        <span>Publish something new..</span>
                    </div>
                    <img src="assets/imgs/pdf.png" class="pdf" />
                    <button class="publish-button">Publish</button>
                </a>
                <div class="filter">
                    <span class="filter-text">Filter</span>
                    <div class="filter-icon"></div>
                </div>

                <?php if ($projects): ?>
    <?php foreach ($projects as $project): ?>
        <div class="project" data-id="<?= htmlspecialchars($project['id']) ?>">
            <div class="project-header">
                <img src="assets/imgs/avatar2.png" alt="Author" class="project-author-img" />
                <div class="project-author-info">
                    <span class="project-author-name"><?= htmlspecialchars($project['authors']) ?></span>
                    <span class="project-time"><?= htmlspecialchars($project['uploaded_at']) ?></span>
                </div>
            </div>
            <h2 class="project-title"><?= htmlspecialchars($project['title']) ?></h2>
            <p class="project-abstract"><?= htmlspecialchars($project['abstract']) ?></p>
            <div class="project-stats">
                <div class="stat likes" data-count="0">
                    <img src="assets/imgs/like.png" alt="Likes" class="like-icon" data-liked="false" />
                    <span class="like-count">0</span>
                </div>
                <div class="stat bookmarks" data-count="0">
                    <img src="assets/imgs/bookmark1.png" alt="Bookmarks" class="bookmark-icon" data-bookmarked="false" />
                    <span class="bookmark-count">0</span>
                </div>
            </div>
            <div class="view-project"></div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No project details found.</p>
<?php endif; ?>
            </div>
            <?php
// Retrieve the top trending projects
$stmt = $pdo->query('SELECT * FROM pdf_files ORDER BY likes DESC');
$trendingProjects = $stmt->fetchAll();
?>

<div class="right-column">
    <div class="trending">
        <h3 class="trending-title">Top Trending Projects</h3>
        <?php if ($trendingProjects): ?>
            <?php foreach ($trendingProjects as $index => $project): ?>
                <div class="trending-item">
                    <span class="trending-number"><?= $index + 1 ?>.</span>
                    <div class="trending-project-title"><?= htmlspecialchars($project['title']) ?></div>
                    <div class="trending-views">
                        <span><?= htmlspecialchars($project['likes']) ?> Likes</span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No trending projects found.</p>
        <?php endif; ?>
    </div>
</div>

        </main>
        <footer class="footer">
            <div class="footer-left">
                <a href="#">Privacy Policy</a>
                <a href="#">Cookie Policy</a>
                <a href="#">Terms of Service</a>
            </div>
            <div class="footer-right">
                <a href="#">Accessibility</a>
                <a href="#">Settings</a>
            </div>
        </footer>
    </div>

    <!-- MODAL FOR PROJECT DETAILS -->
    <div id="project-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <div class="modal-body">
                <div class="project-details">
<script>
                        document.querySelectorAll('.project').forEach(project => {
    project.addEventListener('click', function() {
        const projectId = this.getAttribute('data-id');

        fetch('fetch.php?id=' + projectId)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.querySelector('#project-modal .modal-body').innerHTML = '<p>No project details found.</p>';
                } else {
                    document.querySelector('#project-modal .modal-body').innerHTML = `
                        <h1 class="project-title">${data.title}</h1>
                        <div class="project-meta">
                            <img src="assets/imgs/avatar2.png" alt="Author Avatar" />
                            <div>
                                <div class="project-author">${data.authors}</div>
                                <div class="project-time">${data.uploaded_at}</div>
                            </div>
                        </div>
                        <div class="project-section">
                            <h2 class="section-title">Abstract</h2>
                            <p class="section-content">${data.abstract}</p>
                        </div>
                        <div class="project-section">
                            <h2 class="section-title">Description</h2>
                            <p class="section-content">${data.description}</p>
                        </div>
                        <div class="project-section">
                            <h2 class="section-title">Academic Year</h2>
                            <p class="section-content">${data.academicYear}</p>
                        </div>
                        <a href="open.php?id=${data.id}" class="project-link" target="_blank">${data.filename}</a>
                    `;
                }
                document.getElementById('project-modal').style.display = 'block';
            })
            .catch(error => {
                console.error('Error loading project details:', error);
                document.querySelector('#project-modal .modal-body').innerHTML = '<p>Error loading project details.</p>';
            });
    });
});

document.querySelector('.close-button').addEventListener('click', function() {
    document.getElementById('project-modal').style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target === document.getElementById('project-modal')) {
        document.getElementById('project-modal').style.display = 'none';
    }
}); </script>
    

     <!-- MODAL FOR PROFILE -->
     <div id="profile-modal" class="modal2 profile-modal">
        <div class="modal2-content profile-modal-content">
            <span class="close-profile-button">&times;</span>
            <div class="profile-modal-body">
                <img src="assets/imgs/avatar3.png" alt="Profile Avatar" class="profile-avatar" />
                <div class="profile-name">User Name</div>
                <div class="profile-action" id="view-bookmarks">View Bookmarks</div>
                <div class="profile-action" id="publish-project">Publish Project</div>
                <div class="profile-action" id="settings">Settings</div>
                <hr class="profile-divider">
                <div class="profile-action" id="sign-out">Sign Out</div>
            </div>
        </div>
    </div>

    <!-- WHOLE JAVASCRIPT SECTION BELOW -->
    <script>
        document.querySelectorAll('.project').forEach(project => {
            project.addEventListener('click', function() {
                window.location.href = '#project-details';
            });
        });

        document.querySelectorAll('.trending-item').forEach(item => {
            item.addEventListener('click', function() {
                window.location.href = '#trending-project-details';
            });
        });

        document.querySelectorAll('.publish-box').forEach(item => {
            item.addEventListener('click', function() {
                window.location.href = 'upload.php';
            });
        });

        document.querySelectorAll('.project').forEach(project => {
            project.addEventListener('click', function() {
                document.getElementById('project-modal').style.display = 'block';
            });
        });

        document.querySelector('.close-button').addEventListener('click', function() {
            document.getElementById('project-modal').style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target === document.getElementById('project-modal')) {
                document.getElementById('project-modal').style.display = 'none';
            }
        });

        document.querySelectorAll('.like-icon').forEach(img => {
    img.addEventListener('click', function(e) {
        e.stopPropagation();
        const projectId = this.closest('.project').getAttribute('data-id');
        const likeCountSpan = this.nextElementSibling;
        
        fetch('like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: projectId })
        })
        .then(response => response.json())
        .then(data => {
            likeCountSpan.innerText = data.likes;
            this.src = 'assets/imgs/liked.png';
            this.setAttribute('data-liked', 'true');
        })
        .catch(error => console.error('Error:', error));
    });
});


        document.querySelectorAll('.bookmark-icon').forEach(img => {
            img.addEventListener('click', function(e) {
                e.stopPropagation();
                let countSpan = this.nextElementSibling;
                let count = parseInt(countSpan.innerText);
                let bookmarked = this.getAttribute('data-bookmarked') === 'true';

                if (bookmarked) {
                    count--;
                    this.src = 'assets/imgs/bookmark1.png';
                } else {
                    count++;
                    this.src = 'assets/imgs/bookmarked.png';
                }

                this.setAttribute('data-bookmarked', !bookmarked);
                countSpan.innerText = count;
            });
        });

        /* Modal Overlay Javascripts here Deej */

        document.querySelectorAll('.project').forEach(project => {
            project.addEventListener('click', function() {
                const modal = document.getElementById('project-modal');
                if (modal) {
                    modal.style.display = 'block';
                }
            });
        });

        const closeButton = document.querySelector('.close-button');
        if (closeButton) {
            closeButton.addEventListener('click', function() {
                const modal = document.getElementById('project-modal');
                if (modal) {
                    modal.style.display = 'none';
                }
            });
        }

        window.addEventListener('click', function(event) {
            const modal = document.getElementById('project-modal');
            if (modal && event.target === modal) {
                modal.style.display = 'none';
            }
        });

        /* PROFILE MODAL JS */

        document.querySelector('.profile').addEventListener('click', function() {
            var profileModal = document.getElementById('profile-modal');
            profileModal.style.display = 'block';
            profileModal.style.top = (this.getBoundingClientRect().bottom + window.scrollY) + 'px';
            profileModal.style.right = (window.innerWidth - this.getBoundingClientRect().right) + 'px';
        });

        document.querySelector('.close-profile-button').addEventListener('click', function() {
            document.getElementById('profile-modal').style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target === document.getElementById('profile-modal')) {
                document.getElementById('profile-modal').style.display = 'none';
            }
        });

        document.getElementById('view-bookmarks').addEventListener('click', function() {
            // Handle view bookmarks action
            alert('View Bookmarks clicked');
        });

        document.getElementById('publish-project').addEventListener('click', function() {
            // Handle publish project action
            alert('Publish Project clicked');
        });

        document.getElementById('settings').addEventListener('click', function() {
            // Handle settings action
            alert('Settings clicked');
        });

        document.getElementById('sign-out').addEventListener('click', function() {
            // Handle sign out action
            window.location.href = 'index.php';
            alert('You have been logged out');
        });
    </script>
</body>
</html>
