<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Youdemy
    </title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        :root {
            --primary-color: #4361ee;
            --secondary-color: #2d4059;
            --danger-color: #ef476f;
            --success-color: #06d6a0;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f4f7fe;
            color: var(--secondary-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header Styles */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1rem;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        }

        .dashboard-header h1 {
            font-size: 1.8rem;
            background: linear-gradient(120deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Button Styles */
        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        /* Stats Container */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--success-color));
        }

        .stat-card h3 {
            color: var(--gray-500);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--secondary-color);
        }

        /* Form Styles */
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            margin-bottom: 2rem;
            display: none;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid var(--gray-200);
            border-radius: var(--border-radius);
            font-size: 0.95rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        /* Courses List */
        .courses-list {
            display: grid;
            gap: 1.5rem;
        }

        .course-card {
            background: white;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            border-left: 4px solid var(--primary-color);
        }

        .course-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .course-header h3 {
            font-size: 1.2rem;
            color: var(--secondary-color);
        }

        .course-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-edit {
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
        }

        .btn-inscription {
            background-color: var(--secondary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
        }

        .btn-delete {
            background-color: var(--danger-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
        }

        .tags-container {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .tag {
            background-color: var(--gray-100);
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            color: var(--secondary-color);
            border: 1px solid var(--gray-300);
        }

        /* Content Type Toggle Styles */
        .content-input {
            display: none;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .dashboard-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .course-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .course-actions {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-header">
            <h1>Tableau de bord Enseignant</h1>
            <button class="btn btn-primary" id="addCourseBtn">+ Nouveau Cours</button>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Cours</h3>
                <div class="stat-value" id="totalCourses">0</div>
            </div>
            <div class="stat-card">
                <h3>Total Étudiants</h3>
                <div class="stat-value" id="totalStudents">12</div>
            </div>
            <div class="stat-card">
                <h3>Moyenne Étudiants/Cours</h3>
                <div class="stat-value" id="avgStudents">0</div>
            </div>
        </div>

        <div class="form-container" id="courseForm">
            <h2>Ajouter un nouveau cours</h2>
            <form action="/addCourse" method="POST" id="addCourseForm">
                <div class="form-group">
                    <label>Titre</label>
                    <input type="text" name="titreCour" class="form-control" required>
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
                    <textarea class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group content-input" id="videoInput">
                    <label>URL de la vidéo</label>
                    <input type="url" class="form-control">
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
                    <select class="form-control" multiple id="categorie" required>
                    <?php foreach ($getAllTags as $tag): ?>
                        <option  value="<?= htmlspecialchars($tag['id']) ?>"><?= htmlspecialchars($tag['nom_tag']) ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div style="text-align: right;">
                    <button type="button" class="btn" id="cancelBtn">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>

        <div class="courses-list" id="coursesList">
            <!-- Les cours seront ajoutés ici dynamiquement -->
            <div class="course-card">
                        <div class="course-header">
                            <h3>${course.title}</h3>
                            <div class="course-actions">
                                <button class="btn-edit">Modifier</button>
                                <button class="btn-inscription">inscriptions</button>
                                <button class="btn-delete">Supprimer</button>
                            </div>
                        </div>
                        <p>course description</p>
                        <p><strong>Type:</strong> coursetype</p>
                        <p><strong>Catégorie:</strong> courecategory</p>
                        <div class="tags-container">
                            <span class="tag">tag</span>
                        </div>
                    </div>
        </div>
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

            // Gestion du type de contenu
            contentType.addEventListener('change', (e) => {
                // Cacher d'abord tous les inputs de contenu
                textInput.style.display = 'none';
                videoInput.style.display = 'none';

                // Afficher l'input approprié selon le type sélectionné
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