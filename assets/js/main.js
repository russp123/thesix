document.addEventListener('DOMContentLoaded', function() {
    const projectsList = document.querySelector('.projects-list');
    const trendingList = document.querySelector('.trending-list');
    const projectOverlay = document.getElementById('projectOverlay');
    const closeOverlay = document.querySelector('.close-overlay');
    const overlayTitle = document.getElementById('overlayTitle');
    const overlayAuthor = document.getElementById('overlayAuthor');
    const overlayAbstract = document.getElementById('overlayAbstract');
    const overlayDescription = document.getElementById('overlayDescription');
    const overlayKeywords = document.getElementById('overlayKeywords');

    function createProjectItem(project) {
        const projectItem = document.createElement('div');
        projectItem.className = 'project-item';
        projectItem.innerHTML = `
            <div class="project-header">
                <img src="${project.avatar}" alt="User Avatar" class="user-avatar">
                <div class="user-info">
                    <div class="user-name">${project.author}</div>
                    <div class="post-time">${project.time}</div>
                </div>
            </div>
            <h2 class="project-title">${project.title}</h2>
            <p class="project-description">${project.description}</p>
            <div class="project-actions">
                <button class="like-button" data-liked="false">
                    <img src="like-icon.png" alt="Like Icon" class="like-icon">
                    <span class="like-count">${project.likes}</span>
                </button>
                <button class="bookmark-button" data-bookmarked="false">
                    <img src="bookmark-icon.png" alt="Bookmark Icon" class="bookmark-icon">
                    <span class="bookmark-count">${project.bookmarks}</span>
                </button>
            </div>
        `;

        projectItem.addEventListener('click', (e) => {
            if (!e.target.closest('.like-button') && !e.target.closest('.bookmark-button')) {
                showProjectOverlay(project);
            }
        });

        const likeButton = projectItem.querySelector('.like-button');
        const bookmarkButton = projectItem.querySelector('.bookmark-button');

        likeButton.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleLike(likeButton);
        });

        bookmarkButton.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleBookmark(bookmarkButton);
        });

        return projectItem;
    }

    function createTrendingItem(project, index) {
        const trendingItem = document.createElement('li');
        trendingItem.className = 'trending-item';
        trendingItem.innerHTML = `
            <span class="trending-number">${index + 1}.</span>
            <span class="trending-label">Trending</span>
            <h4 class="trending-title">${project.title}</h4>
            <div class="trending-views">
                <span class="view-count">${project.views}</span>
                <span>Views</span>
            </div>
        `;
        trendingItem.addEventListener('click', () => showProjectOverlay(project));
        return trendingItem;
    }

    function toggleLike(button) {
        const isLiked = button.getAttribute('data-liked') === 'true';
        const likeCount = button.querySelector('.like-count');
        const likeIcon = button.querySelector('.like-icon');

        if (isLiked) {
            button.setAttribute('data-liked', 'false');
            likeCount.textContent = parseInt(likeCount.textContent) - 1;
            likeIcon.src = 'like-icon.png';
        } else {
            button.setAttribute('data-liked', 'true');
            likeCount.textContent = parseInt(likeCount.textContent) + 1;
            likeIcon.src = 'like-icon-orange.png';
        }
    }

    function toggleBookmark(button) {
        const isBookmarked = button.getAttribute('data-bookmarked') === 'true';
        const bookmarkCount = button.querySelector('.bookmark-count');
        const bookmarkIcon = button.querySelector('.bookmark-icon');

        if (isBookmarked) {
            button.setAttribute('data-bookmarked', 'false');
            bookmarkCount.textContent = parseInt(bookmarkCount.textContent) - 1;
            bookmarkIcon.src = 'bookmark-icon.png';
        } else {
            button.setAttribute('data-bookmarked', 'true');
            bookmarkCount.textContent = parseInt(bookmarkCount.textContent) + 1;
            bookmarkIcon.src = 'bookmark-icon-orange.png';
        }
    }

    function showProjectOverlay(project) {
        overlayTitle.textContent = project.title;
        overlayAuthor.textContent = project.author;
        overlayAbstract.textContent = project.abstract;
        overlayDescription.textContent = project.description;
        overlayKeywords.textContent = project.keywords.join(', ');
        projectOverlay.style.display = 'flex';
    }

    closeOverlay.addEventListener('click', () => {
        projectOverlay.style.display = 'none';
    });

    const sampleProjects = [
        {
            avatar: 'avatar1.jpg',
            author: 'John Doe',
            time: '2h ago',
            title: 'Project 1',
            description: 'This is a sample project description.',
            likes: 10,
            bookmarks: 5,
            abstract: 'This is the abstract for Project 1.',
            keywords: ['keyword1', 'keyword2', 'keyword3'],
            views: 100
        },
        {
            avatar: 'avatar2.jpg',
            author: 'Jane Smith',
            time: '4h ago',
            title: 'Project 2',
            description: 'Another sample project description.',
            likes: 15,
            bookmarks: 8,
            abstract: 'This is the abstract for Project 2.',
            keywords: ['keyword4', 'keyword5', 'keyword6'],
            views: 150
        }
    ];

    sampleProjects.forEach(project => {
        projectsList.appendChild(createProjectItem(project));
    });

    sampleProjects.forEach((project, index) => {
        trendingList.appendChild(createTrendingItem(project, index));
    });
});