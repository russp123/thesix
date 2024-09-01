<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thesix Project Section</title>
    <link rel="stylesheet" href="sample.css">
      
</head>
<body>
    <div class="container">
        <div class="content">
            <header class="header">
                <nav class="nav">
                    <div class="logo">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/130749a1c667eb81ec0b1fd392d22e9acf330240d39c70967f674912fffa0bf6?apiKey=c4afa6d0e3794074ae5ff160b01facdd&" alt="Thesix Logo" />
                        <span>Thesix</span>
                    </div>
                    <div class="search-bar">
                        <input type="text" class="search-input" placeholder="Search" />
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/fa11f382fb3574cfcdb390ad9a047fe28f4741f7802e12554c97e87449d555b0?apiKey=c4afa6d0e3794074ae5ff160b01facdd&" alt="Search Icon" />
                    </div>
                    <div class="user-actions">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/030840a1c80f7ef904e40a559c850de48de704b7e2cb665c370bdde1fca841d7?apiKey=c4afa6d0e3794074ae5ff160b01facdd&" alt="Notification" />
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/03747458954327d22fad9faa025033fe18963d442d49c4aa6d7a250641540c9a?apiKey=c4afa6d0e3794074ae5ff160b01facdd&" alt="User Profile" />
                    </div>
                </nav>
                <aside class="sidebar">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/1cc69b37ef5e67f666d75aa0a3ee5a797dae3f3cf17325aecd705a0da100fdd7?apiKey=c4afa6d0e3794074ae5ff160b01facdd&" alt="Sidebar Icon" />
                </aside>
            </header>
            <main class="main-content">
                <div class="project-column">
                    <div class="publish-box">
                        <input type="text" class="publish-input" placeholder="Publish something new.." />
                        <button class="publish-button">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/f96d4626d9d09b8c860179793da5d930d2d6f111a206188c2923786a8aedb40a?apiKey=c4afa6d0e3794074ae5ff160b01facdd&" alt="Publish Icon" />
                            Publish
                        </button>
                    </div>
                    <div class="project-details">
                        <h1 class="project-title">{{project.title}}</h1>
                        <div class="project-meta">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/fef960daf2571a09c7f6a28ff73e5be4ece1b9cc03f9114ca81f7da5e2e2ef58?apiKey=c4afa6d0e3794074ae5ff160b01facdd&" alt="Author Avatar" />
                            <div>
                                <div class="project-author">{{project.author}}</div>
                                <div class="project-time">{{project.time}}</div>
                            </div>
                        </div>
                        <div class="project-section">
                            <h2 class="section-title">Abstract</h2>
                            <p class="section-content">{{project.abstract}}</p>
                        </div>
                        <div class="project-section">
                            <h2 class="section-title">Description</h2>
                            <p class="section-content">{{project.description}}</p>
                        </div>
                        <div class="project-section">
                            <h2 class="section-title">Keywords</h2>
                            <p class="section-content">{{project.keywords}}</p>
                        </div>
                        <div class="view-project">View Full Project</div>
                        <a href="{{project.link}}" class="project-link">{{project.link}}</a>
                    </div>
                </div>
                <div class="sidebar-column">
                    <div class="sidebar-content">
                        <!-- Sidebar content placeholder -->
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>