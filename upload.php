<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Research</title>
    <link rel="stylesheet" href="assets/css/uploadstyle.css">
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
            <section class="upload-form">
                <h1 class="form-title">Share your Research</h1>
                <p class="form-subtitle">
                    Easily upload your thesis and contribute to the growing knowledge base of
                    <span style="color: #fc773f;">Don Honorio Ventura State University.</span>
                </p>
                <form action="upload1.php" method="post" enctype="multipart/form-data">
                    <div class="upload-area" id="dropZone">
                        <input type="file" id="fileInput" name="pdfFile" accept=".pdf" style="display: none;" />
                        <button type="button" class="upload-button" onclick="document.getElementById('fileInput').click()">
                            Select Document To Upload
                        </button>
                        <p class="upload-text">or drag&drop file here</p>
                    </div>
                    <p class="file-types">Supported file types: pdfs ONLY</p>
                    <p class="agreement">
                        By uploading, you agree to our <a href="#" style="color: #a7a7a7;">Thesix Uploader Agreement</a><br />
                        You must own the copyright to any document you share on Thesix. You can read more about this in our
                        <a href="#" style="color: #a7a7a7;">Copyright FAQs.</a>
                    </p>

                    <div class="file-preview" id="filePreview">
                        <span id="fileName"></span>
                        <span class="remove-file" onclick="removeFile()">x</span>
                    </div>

                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-input" />
                    </div>
                    <div class="form-group">
                        <label for="abstract" class="form-label">Abstract</label>
                        <textarea id="abstract" name="abstract" class="form-input"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="authors" class="form-label">Author(s)</label>
                        <div class="authors-input">
                            <input type="text" id="authors" name="authors" class="form-input" />
                            <span class="authors-hint">Separate with commas if multiple</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-input"></textarea>
                    </div>
                    <div class="form-group">
                    <label for="academicYear" class="form-label">Academic Year</label>
                    <select id="academicYear" name="academicYear" class="academic-year">
                        <option value="" disabled selected>Select Year</option>
                        <?php
                        $currentYear = date("Y");
                        $startYear = $currentYear - 8; // Start 8 years ago
                        $endYear = 2024; // End year

                        for ($year = $startYear; $year <= $endYear; $year++) {
                            echo "<option value=\"$year\">$year</option>";
                        }
                        ?>
                    </select>
                </div>

                    <div class="form-actions">
                        <button type="button" class="cancel-button">Cancel</button>
                        <button type="submit" class="submit-button">Submit Document</button>
                    </div>
                </form>
            </section>
        </div>  

    </main>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const academicYearInput = document.getElementById('academicYear');
            
            function validateInput() {
                const value = academicYearInput.value;
                if (value.length > 4) {
                    academicYearInput.value = value.slice(0, 4);
                }
            }
            
            academicYearInput.addEventListener('input', validateInput);
            academicYearInput.addEventListener('blur', validateInput);
        });

        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('highlight');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('highlight');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('highlight');
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                handleFile(e.dataTransfer.files[0]);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length) {
                handleFile(e.target.files[0]);
            }
        });

        function handleFile(file) {
            if (file.type !== 'application/pdf') {
                alert('Please upload a PDF file only.');
                return;
            }
            fileName.textContent = file.name;
            filePreview.style.display = 'block';
        }

        function removeFile() {
            fileInput.value = ''; // Clear the file input
            fileName.textContent = '';
            filePreview.style.display = 'none';
        }

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
            window.location.href = 'profile.php';
        });

        document.getElementById('publish-project').addEventListener('click', function() {
            alert('Publish Project clicked');
        });

        document.getElementById('settings').addEventListener('click', function() {
            window.location.href = 'profile.php';
            alert('Settings clicked');
        });

        document.getElementById('sign-out').addEventListener('click', function() {
            window.location.href = 'index.php';
            alert('You have been logged out');
        });
    </script>
</div>
</body>
</html>
