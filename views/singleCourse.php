<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>Cours - <?php echo htmlspecialchars($course['titre']); ?></title>
    <link rel="stylesheet" href="/assets/css/SingleCoursestyle.css">

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
                    <div class="carousel">
                        <p><?php echo nl2br(htmlspecialchars($course['contenuDocument'])); ?></p>
                    </div>
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
                    <?php if ($_SESSION['user_id'] && $inscrit && $course['isFinished'] === 0) { ?>
                        <button type="submit" class="finish-btn">Terminer le cours</button>
                    <?php }  ?>
                </form>
            </div>

        </div>
    </main>
</body>
</html>
