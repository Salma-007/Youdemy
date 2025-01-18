<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>Cours - <?php echo htmlspecialchars($course['titre']); ?></title>
    <style>
        /* Reset et styles généraux */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background: #4361ee;
            padding: 1rem 5%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .nav-buttons a {
            color: white;
            font-weight: bold;
            margin-left: 1rem;
            text-decoration: none;
        }

        .nav-buttons a:hover {
            color: #00d4ff;
        }

        .main-content {
            margin-top: 80px;
            padding: 2rem 5%;
        }

        .tags-container {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .tag {
            background-color: 	rgb(160,160,160);
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            color: white;
            border: 1px solid var(--gray-300);
        }

        /* Contenu du cours */
        .course-content {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: 0 auto;
        }

        .course-title {
            font-size: 2.5rem;
            color: #4361ee;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .course-description {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .course-video iframe {
            width: 100%;
            height: 500px;
            border-radius: 8px;
        }

        .course-document {
            margin-top: 2rem;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            white-space: pre-wrap; /* Gère le texte formaté */
            word-wrap: break-word;
        }

        .finish-btn, .back-btn {
            background-color: #4361ee;
            color: white;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            text-align: center;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: auto;
        }

        .finish-btn:hover, .back-btn:hover {
            background-color: #00d4ff;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .tags, .category {
            margin-top: 2rem;
            font-size: 1.1rem;
            color: #555;
        }

        .tags span, .category span {
            font-weight: bold;
            color: #4361ee;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }

            .course-title {
                font-size: 2rem;
            }

            .finish-btn, .back-btn {
                font-size: 1rem;
                padding: 0.8rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="/youdemy" class="logo">Youdemy</a>
        <div class="nav-buttons">
          <?php if ($_SESSION['user_id']) { ?>
            <a href="/myCourses" class="nav-btn">Mes Cours</a>
            <a href="/logOut" class="nav-btn">Se Déconnecter</a>
          <?php } else { ?>
            <a href="/signIn" class="nav-btn">Se Connecter</a>
            <a href="/signUp" class="nav-btn">S'inscrire</a>
          <?php } ?>
        </div>
    </nav>

    <main class="main-content">
        <div class="course-content">
            <h1 class="course-title"><?php echo htmlspecialchars($course['titre']); ?></h1>
            <p class="course-description"><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>

            <!-- Affichage de la vidéo YouTube -->
            <?php if ($course['contenuVideo']) {
                preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/]+\/\S+|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $course['contenuVideo'], $matches);
                $videoId = isset($matches[1]) ? $matches[1] : null;

                if ($videoId) {
                    echo '<div class="course-video">';
                    echo '<iframe src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>';
                    echo '</div>';
                } else {
                    echo '<p>La vidéo ne peut pas être affichée. URL invalide.</p>';
                }
            } ?>

            <!-- Affichage du document texte -->
            <?php if ($course['contenuDocument']) { ?>
                <div class="course-document">
                    <h3>Document du cours :</h3>
                    <p><?php echo nl2br(htmlspecialchars($course['contenuDocument'])); ?></p>
                </div>
            <?php } ?>

            <!-- Catégorie et Tags -->
            <div class="category">
                <p>Catégorie : <span><?php echo htmlspecialchars($course['categorie_id']); ?></span></p>
            </div>

            <div class="tags-container">
                <?php                  
                    $tags = explode(',', $course['tags']);
                    foreach($tags as $tag) :  ?>
                <span class="tag"><?php  echo htmlspecialchars($tag);?></span>
                <?php endforeach; ?>
            </div>

            <!-- Boutons "Retour" et "Terminer" -->
            <div class="button-container">
                <button class="back-btn" onclick="window.history.back();">Retour</button>
                <form action="/markCourseAsFinished?id=<?php echo $course['id'];?>" method="POST">
                    <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>" />
                    <?php if ($_SESSION['user_id'] && $inscrit) { ?>
                        <button type="submit" class="finish-btn">Terminer le cours</button>
                    <?php }  ?>
                </form>
            </div>

        </div>
    </main>
</body>
</html>
