<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>Youdemy </title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        :root {
            --primary: #4361ee;
            --secondary: #3f3d56;
            --accent: #00d4ff;
            --text: #2d4059;
            --light: #f8f9fa;
            --gray: #6c757d;
            --border: #dee2e6;
            --shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            --radius: 8px;
        }

        body {
            background-color: #f4f7fe;
            color: var(--text);
            line-height: 1.6;
        }

        /* Navigation */
        .navbar {
            background: white;
            padding: 1rem 5%;
            box-shadow: var(--shadow);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            background: linear-gradient(45deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-btn {
            padding: 0.6rem 1.5rem;
            border-radius: var(--radius);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .signin-btn {
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .signin-btn:hover {
            background: var(--primary);
            color: white;
        }

        .signup-btn {
            background: var(--primary);
            color: white;
        }

        .signup-btn:hover {
            background: var(--accent);
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
            padding: 2rem 5%;
        }

        /* Categories */
        .categories {
            display: flex;
            gap: 1rem;
            margin: 2rem 0;
            overflow-x: auto;
            padding-bottom: 1rem;
        }

        .category-btn {
            padding: 0.6rem 1.2rem;
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text);
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        .category-btn:hover,
        .category-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Courses Grid */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .course-card {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
        }

        .course-image {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .course-content {
            padding: 1.5rem;
        }

        .course-category {
            color: var(--primary);
            font-size: 0.85rem;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .course-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: var(--text);
        }

        .course-description {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .course-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
        }

        .course-author {
            color: var(--gray);
            font-size: 0.85rem;
        }

        .course-price {
            color: var(--primary);
            font-weight: 600;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin: 2rem 0;
        }

        .page-btn {
            padding: 0.5rem 1rem;
            border: 1px solid var(--border);
            background: white;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .page-btn:hover,
        .page-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .logo {
                font-size: 1.5rem;
            }

            .nav-btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .main-content {
                padding: 1rem;
            }

            .courses-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="/" class="logo">Youdemy</a>
        <div class="nav-buttons">
            <a href="/signIn" class="nav-btn signin-btn">Se connecter</a>
            <a href="/signUp" class="nav-btn signup-btn">S'inscrire</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="categories">
            <button class="category-btn active">Tous</button>
            <?php foreach($categories as $category): ?>
                <button class="category-btn" data-category="<?php echo $category['id']; ?>">
                    <?php echo htmlspecialchars($category['nom_categorie']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="courses-grid">
            <?php foreach($courses as $course): ?>
                <article class="course-card">
                    <img src="<?php echo $course['picture'] ? '/assets/uploads/'.$course['picture'] : '/assets/default-course.jpg'; ?>" 
                         alt="<?php echo htmlspecialchars($course['titre']); ?>" 
                         class="course-image">
                    <div class="course-content">
                        <div class="course-category"><?php echo htmlspecialchars($course['nom_categorie']); ?></div>
                        <h3 class="course-title"><?php echo htmlspecialchars($course['titre']); ?></h3>
                        <p class="course-description">
                            <?php echo substr(htmlspecialchars($course['description']), 0, 100) . '...'; ?>
                        </p>
                        <div class="course-meta">
                            <span class="course-author">Par: <?php echo htmlspecialchars($course['enseignant']); ?></span>
                            <a class="course-price">Enroll</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="pagination">
            <?php if($currentPage > 1): ?>
                <button class="page-btn" onclick="changePage(<?php echo $currentPage - 1; ?>)">Précédent</button>
            <?php endif; ?>

            <?php for($i = 1; $i <= $totalPages; $i++): ?>
                <button class="page-btn <?php echo $i === $currentPage ? 'active' : ''; ?>" 
                        onclick="changePage(<?php echo $i; ?>)">
                    <?php echo $i; ?>
                </button>
            <?php endfor; ?>

            <?php if($currentPage < $totalPages): ?>
                <button class="page-btn" onclick="changePage(<?php echo $currentPage + 1; ?>)">Suivant</button>
            <?php endif; ?>
        </div>
    </main>

    <script>
        // Gestion des catégories
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const categoryId = this.dataset.category;
                window.location.href = `/?category=${categoryId}&page=1`;
            });
        });

        // Gestion de la pagination
        function changePage(page) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('page', page);
            window.location.href = '?' + urlParams.toString();
        }
    </script>
</body>
</html>