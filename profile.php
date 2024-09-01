<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Section</title>
    <link rel="stylesheet" href="profilestyle.css">
    <link rel="stylesheet" href="uploadstyle.css"> <!-- Including upload style -->
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
      <div class="profile-info">
        <div class="profile-columns">
          <div class="profile-left-column">
            <div class="profile-image-container">
              <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/2e0e4f06cb2e0df496a8f2618eba2e02eaa7e306769f729d89f8b8dbc18b87db?placeholderIfAbsent=true&apiKey=c4afa6d0e3794074ae5ff160b01facdd" alt="Russel A. Pineda Profile Picture" class="profile-picture" />
              <button class="btn bookmarked-papers-btn">Bookmarked Papers</button> <!-- Using common class 'btn' -->
            </div>
          </div>
          <div class="profile-right-column">
            <div class="profile-details">
              <h2 class="profile-name">Russel A. Pineda</h2>
              <p class="profile-id">2021xxxxxx</p>
              <button class="btn edit-profile-btn">Edit Profile</button> <!-- Using common class 'btn' -->
            </div>
          </div>
        </div>
      </div>
      <hr class="divider" />
      <article class="paper-container">
        <header class="paper-header">
          <div class="author-info">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/fef960daf2571a09c7f6a28ff73e5be4ece1b9cc03f9114ca81f7da5e2e2ef58?placeholderIfAbsent=true&apiKey=c4afa6d0e3794074ae5ff160b01facdd" alt="Russel A. Pineda" class="author-image" />
            <div class="author-details">
              <p class="author-name">Pineda, Russel A. (2024)</p>
              <p class="post-time">14s</p>
            </div>
          </div>
          <div class="likes-container">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/bac5d3d1ff86ac55bd8790b90ec401661709894119394f290649452edb01e381?placeholderIfAbsent=true&apiKey=c4afa6d0e3794074ae5ff160b01facdd" alt="Likes" class="likes-icon" />
            <span>54</span>
          </div>
          <div class="comments-container">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/73d9703f9a9f890e6f29dc84d63e61297525a68554ba13ccff429f7a6878a358?placeholderIfAbsent=true&apiKey=c4afa6d0e3794074ae5ff160b01facdd" alt="Comments" class="comments-icon" />
            <span>2</span>
          </div>
        </header>
        <h3 class="paper-title">Cop or Drop: An Analysis of the Influence of Social Media Marketing on Sneakerheads' Attitudes and Perceptions Among Resellers and Consumers of Rhand Rhelle.</h3>
      </article>
    </main>
  </div>
</section>

</body>
</html>
