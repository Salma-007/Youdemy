<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="/assets/css/styleyoudemy.css">
    <title>Youdemy </title>
</head>
<body>
    <nav class="navbar">
        <a href="/youdemy" class="logo">Youdemy</a>
        <div class="nav-buttons">
          <?php if($_SESSION['user_id']){  ?>
        <a href="/myCourses" class="nav-btn signin-btn">Mes cours</a>
        <a href="/logOut" class="nav-btn signup-btn">Se deconnecter</a>
            <?php } else {?>
            <a href="/signIn" class="nav-btn signin-btn">Se connecter</a>
            <a href="/signUp" class="nav-btn signup-btn">S'inscrire</a>
            <?php } ?>
        </div>
    </nav>

    <main class="main-content">
    <div class="categories">
    <button class="category-btn <?php echo !$categoryId ? 'active' : ''; ?>">Tous</button>
    <?php foreach($categories as $category): ?>
        <button class="category-btn <?php echo $category['id'] == $categoryId ? 'active' : ''; ?>" 
                data-category="<?php echo $category['id']; ?>">
            <?php echo htmlspecialchars($category['nom_categorie']); ?>
        </button>
    <?php endforeach; ?>
    <form method="GET" action="/youdemy" class="search-form">
        <input type="text" name="search" placeholder="Rechercher par titre..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">Rechercher</button>
    </form>

    </div>

        <div class="courses-grid">
            <?php foreach($courses as $course): ?>
                <article class="course-card" >
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
                            <?php if ($_SESSION['user_id']) { ?>
                              <a href='/enroll?id=<?php echo $course['id'];?>' class="course-price">s'inscrire</a>
                            <?php }  ?>
                            <!-- <a href='/singleCourse?id=<?php echo $course['id'];?>' class="course-price">voir</a> -->
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
        // Retirer la classe active de tous les boutons
        document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');

        const categoryId = this.dataset.category || '';
        window.location.href = `youdemy?category=${categoryId}&page=1`;
        });
        });

        // Gestion de la pagination
        function changePage(page) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('page', page);

            const searchTerm = document.querySelector('input[name="search"]').value;
            if (searchTerm) {
                urlParams.set('search', searchTerm);
            }
            window.location.href = '?' + urlParams.toString();
        }

    </script>
</body>
</html>