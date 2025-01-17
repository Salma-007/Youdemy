<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>Youdemy</title>
    <style>
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
        }

        body {
            background-color: #f4f7fe;
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: var(--secondary-color);
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
        }

        .edit-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-300);
        }

        .edit-form {
            background: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
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

        .current-image {
            margin-top: 0.5rem;
            padding: 0.5rem;
            background: var(--gray-100);
            border-radius: var(--border-radius);
        }

        .buttons-container {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-secondary {
            background-color: var(--gray-200);
            color: var(--secondary-color);
        }

        .content-toggle {
            display: none;
        }

        .content-toggle.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="edit-header">
            <h1>Modifier le cours</h1>
            <a href="/coursesTeacher" class="btn btn-secondary">Retour aux cours</a>
        </div>

        <div class="edit-form">
            <form action="/updateCourseAction" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="courseId" value="<?php echo htmlspecialchars($courseData['id']); ?>">
                
                <div class="form-group">
                    <label>Titre du cours</label>
                    <input type="text" name="titreCour" class="form-control" required
                        value="<?php echo htmlspecialchars($courseData['titre']); ?>">
                </div>
                <div class="form-group">
                    <label>Image du cours</label>
                    <input type="file" name="photo_input" class="form-control" accept="image/*">
                    <?php if ($courseData['picture']): ?>
                    <div class="current-image">
                        <p>Couverture actuelle : <?php echo htmlspecialchars($courseData['picture']); ?></p>
                        <img src="/assets/uploads/<?php echo htmlspecialchars($courseData['picture']); ?>" 
                             alt="Current course image" style="max-width: 200px;">
                    </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="descriptionCour" class="form-control" rows="4" required><?php 
                        echo htmlspecialchars($courseData['description']); 
                    ?></textarea>
                </div>

                <div class="form-group">
                    <label>Type de contenu</label>
                    <select name="contenuType" class="form-control" required id="contentTypeSelect">
                    <option value="text" <?php echo $courseData['contenuDocument'] !== null ? 'selected' : ''; ?>>
                        Document
                    </option>
                    <option value="video" <?php echo $courseData['contenuVideo'] !== null ? 'selected' : ''; ?>>
                        Vidéo
                    </option>

                    </select>
                </div>
                <div id="textContent" class="content-toggle <?php echo $courseData['contenuDocument'] !== null ? 'active' : ''; ?>">
                    <div class="form-group">
                        <label>Contenu texte</label>
                        <textarea name="TextContenu" class="form-control" rows="6"><?php 
                            echo $courseData['contenuDocument'] !== null ? htmlspecialchars($courseData['contenuDocument']) : ''; 
                        ?></textarea>
                    </div>
                </div>

                <div id="videoContent" class="content-toggle <?php echo $courseData['contenuVideo'] !== null ? 'active' : ''; ?>">
                    <div class="form-group">
                        <label>URL de la vidéo</label>
                        <input type="url" name="VideoContenu" class="form-control"
                            value="<?php echo $courseData['contenuVideo'] !== null ? htmlspecialchars($courseData['contenuVideo']) : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Catégorie</label>
                    <select name="category_name" class="form-control" required>
                        <?php foreach ($getAllCategories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['id']); ?>"
                                    <?php echo $courseData['categorie_id'] == $category['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['nom_categorie']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tags</label>
                    <select name="tags[]" class="form-control" multiple required>
                        <?php 
                        $selectedTags = explode(',', $courseData['tags']);
                        foreach ($getAllTags as $tag): 
                        ?>
                            <option value="<?php echo htmlspecialchars($tag['id']); ?>"
                                    <?php echo in_array($tag['id'], $selectedTags) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($tag['nom_tag']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="buttons-container">
                    <a href="/coursesTeacher" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('contentTypeSelect').addEventListener('change', function() {
            const textContent = document.getElementById('textContent');
            const videoContent = document.getElementById('videoContent');
            
            if (this.value === 'text') {
                textContent.classList.add('active');
                videoContent.classList.remove('active');
            } else {
                textContent.classList.remove('active');
                videoContent.classList.add('active');
            }
        });
    </script>
</body>
</html>