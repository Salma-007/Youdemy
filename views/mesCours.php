<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>Mes Cours - Youdemy</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
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

        /* Navbar */
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

        /* Styles spécifiques pour cette page */
        body {
            background-color: #f4f7fe;
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: #2d4059;
            margin-top: 80px; /* Ajouter un margin-top pour éviter que le contenu se cache derrière la navbar */
        }

        .course-section {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .course-section h2 {
            margin-bottom: 1.5rem;
            font-size: 1.6rem;
        }

        /* Carrousel */
        .course-carousel {
            display: flex;
            overflow-x: auto;
            gap: 1.5rem;
            scroll-behavior: smooth;
            padding-bottom: 1rem;
        }

        .course-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            width: 250px;
            padding: 1rem;
            transition: transform 0.3s ease;
            flex-shrink: 0; /* Empêche le redimensionnement des cartes */
            cursor: pointer;
            text-decoration: none; /* Supprimer les décorations de texte pour le lien */
        }

        .course-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: var(--radius);
        }

        .course-card:hover {
            transform: translateY(-5px);
        }

        .course-title {
            font-size: 1.2rem;
            margin: 0.5rem 0;
        }

        .course-meta {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .course-meta .status {
            font-weight: bold;
            color: var(--primary);
        }

        /* Pour l'affichage sur mobile */
        @media (max-width: 768px) {
            .course-carousel {
                padding-bottom: 0;
            }

            .course-card {
                width: 200px; /* Réduire la taille des cartes sur mobile */
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="/youdemy" class="logo">Youdemy</a>
        <div class="nav-buttons">
          <?php if($_SESSION['user_id']){  ?>
            <a href="/youdemy" class="nav-btn signin-btn">Acceuil</a>
            <a href="/logOut" class="nav-btn signup-btn">Se déconnecter</a>
          <?php } else { ?>
            <a href="/signIn" class="nav-btn signin-btn">Se connecter</a>
            <a href="/signUp" class="nav-btn signup-btn">S'inscrire</a>
          <?php } ?>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="course-section">
        <h2>Cours non terminés</h2>
        <div class="course-carousel">
            <?php foreach ($unfinishedCourses as $course): ?>
                <!-- Lien cliquable autour de chaque carte -->
                <a href="/singleCourse?id=<?php echo $course['id']; ?>" class="course-card">
                    <img src="<?php echo $course['picture'] ? '/assets/uploads/'.$course['picture'] : '/assets/default-course.jpg'; ?>" alt="Image du cours">
                    <h3 class="course-title"><?php echo htmlspecialchars($course['titre']); ?></h3>
                    <div class="course-meta">
                        <span class="status">En cours</span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <h2>Cours terminés</h2>
        <div class="course-carousel">
            <?php foreach ($finishedCourses as $course): ?>
                <!-- Lien cliquable autour de chaque carte -->
                <a href="/singleCourse?id=<?php echo $course['id']; ?>" class="course-card">
                    <img src="<?php echo $course['picture'] ? '/assets/uploads/'.$course['picture'] : '/assets/default-course.jpg'; ?>" alt="Image du cours">
                    <h3 class="course-title"><?php echo htmlspecialchars($course['titre']); ?></h3>
                    <div class="course-meta">
                        <span class="status">Terminé</span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>
