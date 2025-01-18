<?php
// Récupération des cours de l'utilisateur (non terminés et terminés).
$userId = $_SESSION['user_id']; // Assurez-vous que l'utilisateur est authentifié.
$unfinishedCourses = getUnfinishedCourses($userId);
$finishedCourses = getFinishedCourses($userId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>Mes Cours - Youdemy</title>
    <style>
        /* Styles spécifiques pour cette page */
        body {
            background-color: #f4f7fe;
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: #2d4059;
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

        .course-carousel {
            display: flex;
            overflow-x: auto;
            gap: 1.5rem;
        }

        .course-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            width: 250px;
            padding: 1rem;
            transition: transform 0.3s ease;
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
    </style>
</head>
<body>
    <div class="course-section">
        <h2>Cours non terminés</h2>
        <div class="course-carousel">
            <?php foreach ($unfinishedCourses as $course): ?>
                <div class="course-card">
                    <img src="<?php echo $course['picture'] ? '/assets/uploads/'.$course['picture'] : '/assets/default-course.jpg'; ?>" alt="Image du cours">
                    <h3 class="course-title"><?php echo htmlspecialchars($course['titre']); ?></h3>
                    <div class="course-meta">
                        <span class="status">En cours</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <h2>Cours terminés</h2>
        <div class="course-carousel">
            <?php foreach ($finishedCourses as $course): ?>
                <div class="course-card">
                    <img src="<?php echo $course['picture'] ? '/assets/uploads/'.$course['picture'] : '/assets/default-course.jpg'; ?>" alt="Image du cours">
                    <h3 class="course-title"><?php echo htmlspecialchars($course['titre']); ?></h3>
                    <div class="course-meta">
                        <span class="status">Terminé</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>


