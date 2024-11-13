<?php
// Démarre la session pour vérifier si l'utilisateur est connecté
session_start();

// Vérifie si l'utilisateur est connecté ; sinon, redirige vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php');  // Page de redirection si l'utilisateur n'est pas connecté
    exit();
}

require_once('../../../../models/adminService.php');
$adminService = new AdminService();
$professeurs = $adminService->getAllProfesseurs(); // Récupère la liste des professeurs
$salles = $adminService->getAllSalles();           // Récupère la liste des salles
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un cours</title>
    <style>
        /* Style général */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            padding: 20px;
            width: 90%;
        }

        h1 {
            color: #4caf50;
            font-size: 1.8em;
            text-align: center;
            margin-bottom: 1rem;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter un cours</h1>
        <form action="../../../../controllers/adminController.php?action=ajout" method="POST">
            <!-- Champ pour le libellé du cours -->
            <label for="libelle">Libellé du Cours :</label>
            <input type="text" name="libelle" id="libelle" required>

            <!-- Champ pour la date de début du cours -->
            <label for="dateDebut">Date de Début :</label>
            <input type="date" name="dateDebut" id="dateDebut" required>

            <!-- Champ pour la date de fin du cours -->
            <label for="dateFin">Date de Fin :</label>
            <input type="date" name="dateFin" id="dateFin" required>

            <!-- Menu déroulant pour sélectionner le professeur -->
            <label for="idProf">Professeur :</label>
            <select name="idProf" id="idProf" required>
                <?php foreach ($professeurs as $prof) { ?>
                    <option value="<?= htmlspecialchars($prof['id']) ?>">
                        <?= htmlspecialchars($prof['nom']) ?> <?= htmlspecialchars($prof['prenom']) ?>
                    </option>
                <?php } ?>
            </select>

            <!-- Menu déroulant pour sélectionner la salle -->
            <label for="idSalle">Salle :</label>
            <select name="idSalle" id="idSalle" required>
                <?php foreach ($salles as $salle) { ?>
                    <option value="<?= htmlspecialchars($salle['id']) ?>">
                        <?= htmlspecialchars($salle['nomSalle']) ?>
                    </option>
                <?php } ?>
            </select>

            <!-- Bouton pour soumettre le formulaire -->
            <button type="submit">Ajouter le Cours</button>
        </form>
    </div>
</body>
</html>
