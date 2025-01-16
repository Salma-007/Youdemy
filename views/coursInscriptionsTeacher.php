<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Youdemy
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />

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
            <h1>Inscriptions pour : Cours</h1>
            <button class="btn btn-primary" id="addCourseBtn">Back</button>
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
        
        <div class="container mt-5">
    <h2>Liste des étudiants inscrits dans le cours</h2>
    <table id="myTable" class="table table-striped">
      <thead>
        <tr>
          <th>N°</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Date d'inscription</th>
          <th>Statut</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>1</th>
          <td>Dupont</td>
          <td>Marie</td>
          <td>marie.dupont@email.com</td>
          <td>10/01/2025</td>
          <td>Inscrit</td>
        </tr>
        <tr>
          <th>2</th>
          <td>Lefevre</td>
          <td>Jean</td>
          <td>jean.lefevre@email.com</td>
          <td>12/01/2025</td>
          <td>Inscrit</td>
        </tr>
        <tr>
          <th>3</th>
          <td>Durand</td>
          <td>Pierre</td>
          <td>pierre.durand@email.com</td>
          <td>13/01/2025</td>
          <td>Inscrit</td>
        </tr>
        <tr>
          <th>4</th>
          <td>Petit</td>
          <td>Claire</td>
          <td>claire.petit@email.com</td>
          <td>14/01/2025</td>
          <td>Inscrit</td>
        </tr>
        <tr>
          <th>5</th>
          <td>Martin</td>
          <td>Luc</td>
          <td>luc.martin@email.com</td>
          <td>15/01/2025</td>
          <td>Inscrit</td>
        </tr>
      </tbody>
    </table>
  </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        });
    </script>
</body>
</html>