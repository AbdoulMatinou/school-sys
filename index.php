<?php
// Démarre la session pour vérifier si l'utilisateur est déjà connecté
session_start();

// Si l'utilisateur est déjà connecté, redirige vers la page d'accueil ou le tableau de bord
if (!isset($_SESSION['user_id'])) {
    header('Location: views/login.php');  // ou la page où vous voulez rediriger l'utilisateur
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        /* Style de base */
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Fond noir */
            color: #FFFFFF; /* Texte blanc */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            background-color: #1e1e1e; /* Fond gris foncé */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h2 {
            color: #4caf50; /* Vert */
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
            color: #FFFFFF; /* Texte blanc */
            text-align: left;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 4px;
            border: 1px solid #4caf50;
            background-color: #2e2e2e;
            color: #FFFFFF; /* Texte blanc */
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #81c784; /* Vert plus clair au focus */
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            background-color: #4caf50; /* Vert */
            color: white;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #81c784; /* Vert clair */
        }

        /* Message d'erreur */
        .error {
            color: #e57373; /* Rouge clair */
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Connexion</h2>
        <?php if (isset($_GET['error'])): ?>
            <p class="error">Nom d'utilisateur ou mot de passe incorrect</p>
        <?php endif; ?>
        <form action="controllers/authController.php" method="post">
            <input type="hidden" name="action" value="login">
            
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Connexion</button>
        </form>
    </div>

</body>
</html>
