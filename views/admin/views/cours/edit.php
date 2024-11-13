<?php
// Démarre la session pour vérifier si l'utilisateur est connecté
session_start();

// Vérifie si l'utilisateur est connecté ; sinon, redirige vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php');
    exit();
}

require_once('../../../../models/adminService.php');
$adminService = new adminService();

// Récupère l'ID du cours à partir des paramètres de la requête
$id = $_GET['id'] ?? null;

// Récupère les informations du cours, des professeurs, et des salles
$cours = $adminService->getCoursById($id);
$professeurs = $adminService->getAllProfesseurs();
$salles = $adminService->getAllSalles();

// Si le cours n'existe pas, redirige vers la liste des cours avec un message d'erreur
if (!$cours) {
    header('Location: liste.php?error=Cours non trouvé');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un cours</title>
    <link rel="stylesheet" href="styles.css"> <!-- Fichier CSS pour le style -->
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
        <h1>Modifier un cours</h1>

        <!-- Formulaire de modification du cours -->
        <form action="../../../../controllers/adminController.php" method="POST">
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="id" value="<?= htmlspecialchars($cours['id']) ?>">

            <label for="libelle">Libellé du cours :</label>
            <input type="text" name="libelle" id="libelle" value="<?= htmlspecialchars($cours['libelle']) ?>" required>

            <label for="dateDebut">Date de début :</label>
            <input type="date" name="dateDebut" id="dateDebut" value="<?= htmlspecialchars($cours['dateDebut']) ?>" required>

            <label for="dateFin">Date de fin :</label>
            <input type="date" name="dateFin" id="dateFin" value="<?= htmlspecialchars($cours['dateFin']) ?>" required>

            <label for="idProf">Professeur :</label>
            <select name="idProf" id="idProf" required>
                <?php foreach ($professeurs as $prof) { ?>
                    <option value="<?= htmlspecialchars($prof['id']) ?>" <?= $cours['idProf'] == $prof['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($prof['nom']) . ' ' . htmlspecialchars($prof['prenom']) ?>
                    </option>
                <?php } ?>
            </select>

            <label for="idSalle">Salle :</label>
            <select name="idSalle" id="idSalle" required>
                <?php foreach ($salles as $salle) { ?>
                    <option value="<?= htmlspecialchars($salle['id']) ?>" <?= $cours['idSalle'] == $salle['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($salle['nomSalle']) ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit">Enregistrer les modifications</button>
        </form>
    </div>
</body>
</html>
