<?php
// Démarre la session pour vérifier si l'utilisateur est déjà connecté
session_start();

// Si l'utilisateur est déjà connecté, redirigez-le vers la page d'accueil ou le tableau de bord
if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php');  // ou la page où vous voulez rediriger l'utilisateur
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin</title>
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
            max-width: 500px;
            width: 90%;
            padding: 2rem;
            background-color: #1e1e1e; /* Fond gris foncé */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h1 {
            color: #4caf50; /* Vert */
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            margin: 15px 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #4caf50; /* Vert */
            font-size: 1.2rem;
            font-weight: bold;
            padding: 10px 20px;
            display: block;
            background-color: #2e2e2e;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #81c784; /* Vert clair */
            color: #FFFFFF;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tableau de bord de l'Admin</h1>
        <nav>
            <ul>
                <li><a href="../../../controllers/adminController.php?action=form">Ajouter un Cours</a></li>
                <li><a href="../../../controllers/adminController.php?action=liste">Voir les Cours</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
