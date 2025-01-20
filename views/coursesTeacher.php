<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="/assets/css/courseTeacherStyle.css">
    <title>
        Youdemy
    </title>

</head>
<body>
    <div class="container">
        <div class="dashboard-header">
            <h1>My Youdemy Courses</h1>
            <?php 
            // var_dump($_SESSION['confirmedTeacher']);
            if($_SESSION['confirmedTeacher'] === 1){ ?>
            <button class="btn btn-primary" id="addCourseBtn">Nouveau Cours</button>
            <?php } ?>
            <?php echo ' Weclome '.$_SESSION['nom'].'!'; ?>
            <a href="/logOut" class="btn btn-delete" id="addCourseBtn">Logout</a>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Cours</h3>
                <div class="stat-value" id="totalCourses"><?php  echo htmlspecialchars($getCountCourses);?></div>
            </div>
            <div class="stat-card">
                <h3>Total Étudiants</h3>
                <div class="stat-value" id="totalStudents"><?php  echo htmlspecialchars($getCountInscriptions);?></div>
            </div>
            <div class="stat-card">
                <h3>Nombre Categories</h3>
                <div class="stat-value" id="avgStudents"><?php  echo htmlspecialchars($getCountCategorie);?></div>
            </div>
        </div>
        <?php 
            // var_dump($_SESSION['confirmedTeacher']);
            if($_SESSION['confirmedTeacher'] === 1){ ?>
        <div class="form-container" id="courseForm">
            <h2>Ajouter un nouveau cours</h2>
            <?php
                    if (isset($_SESSION['error_course'])) {
                        echo '<div class="alert alert-danger text-center">' . $_SESSION['error_course'] . '</div>';
                        unset($_SESSION['error_course']); 
                    }
                  ?>
            <form action="/addCourse" method="POST" id="addCourseForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Titre</label>
                    <input type="text" name="titreCour" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Picture</label>
                    <input type="file" id="photo_input" accept="image/*" class="form-control input-square" name="photo_input">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="descriptionCour" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label>Type de contenu</label>
                    <select class="form-control" id="contentType" name ="contenuType" required>
                        <option value="">Sélectionner le type</option>
                        <option value="text">Document</option>
                        <option value="video">Video</option>
                    </select>
                </div>
                <div class="form-group content-input" id="textInput">
                    <label>Contenu texte</label>
                    <textarea class="form-control" name="TextContenu" rows="5"></textarea>
                </div>
                <div class="form-group content-input" id="videoInput">
                    <label>URL de la vidéo</label>
                    <input type="url" name="VideoContenu"  class="form-control">
                </div>
                <div class="form-group">
                    <label>Catégorie</label>
                    <select class="form-control" id="categorie" name="category_name" required>
                    <?php foreach ($getAllCategories as $categorie): ?>
                        <option value="<?= htmlspecialchars($categorie['id']) ?>"><?= htmlspecialchars($categorie['nom_categorie']) ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tags</label>
                    <select class="form-control" name="tags[]" multiple id="categorie" required>
                    <?php foreach ($getAllTags as $tag): ?>
                        <option  value="<?= htmlspecialchars($tag['id']) ?>"><?= htmlspecialchars($tag['nom_tag']) ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div style="text-align: right;">
                    <button type="button" class="btn" id="cancelBtn">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div> <?php } ?>
        <?php foreach($getAllCourses as $course): ?>
        <div class="courses-list" id="coursesList">
            <!-- Les cours -->
             
            <div class="course-card">
                <div class="course-header">
                    <h3><?php  echo htmlspecialchars($course['titre']);?></h3>
                    <div class="course-actions">
                            <button class="btn-edit" onclick="window.location.href='/updateCourse?id=<?php echo $course['id']; ?>'">Modifier</button>
                            <button class="btn-inscription" onclick="window.location.href='/coursInscriptionsTeacher?id=<?php echo $course['id']; ?>'">inscriptions</button>
                            <button class="btn-delete" onclick="window.location.href='/deleteCourse?id=<?php echo $course['id']; ?>'">Supprimer</button>
                        </div>
                    </div>
                    <p><?php  echo htmlspecialchars($course['description']);?></p>
                    <p><strong>Status:</strong> 
                    <span class="
                        <?php 
                            if ($course['status'] == 'pending') {
                                echo 'status-pending';
                            } elseif ($course['status'] == 'accepted') {
                                echo 'status-accepted';
                            } elseif ($course['status'] == 'deleted') {
                                echo 'status-deleted';
                            } 
                        ?>">
                        <?php echo htmlspecialchars($course['status']); ?>
                    </span>
                    </p>
                    <p><strong>Catégorie:</strong> <?php  echo htmlspecialchars($course['nom_categorie']);?></p>
                    <div class="tags-container">
                        <?php                  
                            $tags = explode(',', $course['tags']);
                            foreach($tags as $tag) :  ?>
                        <span class="tag"><?php  echo htmlspecialchars($tag);?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
        </div>
        <?php endforeach; ?>
        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addCourseBtn = document.getElementById('addCourseBtn');
            const courseForm = document.getElementById('courseForm');
            const cancelBtn = document.getElementById('cancelBtn');
            const contentType = document.getElementById('contentType');
            const textInput = document.getElementById('textInput');
            const videoInput = document.getElementById('videoInput');

            // Gestion de l'affichage du formulaire
            addCourseBtn.addEventListener('click', () => {
                courseForm.style.display = 'block';
            });

            cancelBtn.addEventListener('click', () => {
                courseForm.style.display = 'none';
            });

            contentType.addEventListener('change', (e) => {

                textInput.style.display = 'none';
                videoInput.style.display = 'none';

                if (e.target.value === 'text') {
                    textInput.style.display = 'block';
                } else if (e.target.value === 'video') {
                    videoInput.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>