<?php
// Démarre la session pour vérifier si l'utilisateur est connecté
session_start();

// Vérifie si l'utilisateur est connecté ; sinon, redirige vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php');  // Page de redirection si l'utilisateur n'est pas connecté
    exit();
}

require_once('../../../../models/adminService.php');
$adminService = new adminService();
$cours = $adminService->getAllCours(); // Récupère la liste des cours avec les informations de la salle et du professeur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Cours</title>
    <style>
        /* Style général */
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Fond noir */
            color: #FFFFFF; /* Texte blanc */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 90%;
            margin: 2rem;
            background-color: #1e1e1e; /* Fond gris foncé */
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        h1 {
            color: #4caf50; /* Vert */
            text-align: center;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        th {
            background-color: #2e2e2e;
            color: #4caf50; /* Vert */
        }

        tr:hover {
            background-color: #333; /* Survol des lignes */
        }

        a {
            color: #4caf50; /* Vert pour les liens */
            text-decoration: none;
        }

        a:hover {
            color: #81c784; /* Vert clair au survol */
            text-decoration: underline;
        }

        /* Boutons d'action */
        .action-buttons a {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des Cours</h1>
        
        <!-- Tableau affichant les cours -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libellé</th>
                    <th>Date de Début</th>
                    <th>Date de Fin</th>
                    <th>Professeur</th>
                    <th>Salle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cours as $course) { ?>
                    <tr>
                        <td><?= htmlspecialchars($course['id']) ?></td>
                        <td><?= htmlspecialchars($course['libelle']) ?></td>
                        <td><?= htmlspecialchars($course['dateDebut']) ?></td>
                        <td><?= htmlspecialchars($course['dateFin']) ?></td>
                        <td><?= htmlspecialchars($course['nomProf'] . ' ' . $course['prenomProf']) ?></td>
                        <td><?= htmlspecialchars($course['nomSalle']) ?></td>
                        <td class="action-buttons">
                            <a href="../../../../controllers/adminController.php?action=editForm&id=<?= $course['id'] ?>">Modifier</a> |
                            <a href="../../../../controllers/adminController.php?action=delete&id=<?= $course['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
