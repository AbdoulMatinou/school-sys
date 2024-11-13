<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php');
    exit();
}

// Récupère l'ID de l'utilisateur
$userId = $_SESSION['user_id'];

// Inclure le service ou le contrôleur pour récupérer les cours inscrits
require_once('../../../models/etudiantService.php');

// Créer une instance du service et récupérer l'ID de l'étudiant
$etudiantService = new EtudiantService();
$etudiantId = $etudiantService->getEtudiantIdByUserId($userId);

if ($etudiantId) {
    // Récupérer les cours inscrits et les stocker dans la session
    $coursInscrits = $etudiantService->getCoursInscrits($etudiantId);
    $_SESSION['coursInscrits'] = $coursInscrits;
} else {
    $_SESSION['coursInscrits'] = [];
    $message = "Erreur : étudiant introuvable.";
}

$message = $_GET['message'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours</title>
    <style>
        /* Style général */
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Fond noir */
            color: #FFFFFF; /* Texte blanc */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 2rem;
            background-color: #1e1e1e; /* Fond gris foncé */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h1 {
            color: #4caf50; /* Vert */
            font-size: 2rem;
        }

        h2 {
            color: #81c784; /* Vert clair */
            font-size: 1.5rem;
            margin-top: 20px;
        }

        p, li {
            color: #FFFFFF;
            font-size: 1rem;
        }

        .message {
            color: #e57373; /* Rouge clair pour les erreurs */
            margin-bottom: 15px;
            font-weight: bold;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
            padding: 8px;
            background-color: #2e2e2e;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        a {
            color: #e57373;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9rem;
        }

        a:hover {
            text-decoration: underline;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 20px;
            color: #FFFFFF;
            text-align: left;
        }

        select, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 4px;
            border: none;
            font-size: 1rem;
        }

        select {
            background-color: #2e2e2e;
            color: #FFFFFF;
            border: 1px solid #4caf50;
        }

        select:focus {
            outline: none;
            border-color: #81c784;
        }

        button {
            background-color: #4caf50; /* Vert */
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #81c784; /* Vert clair */
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Mes Cours</h1>
        
        <?php if ($message) : ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <h2>Cours auxquels vous êtes inscrit :</h2>
        <ul>
            <?php foreach ($coursInscrits as $cours) : ?>
                <li>
                    <?php echo htmlspecialchars($cours['libelle']) . " (Du " . htmlspecialchars($cours['dateDebut']) . " au " . htmlspecialchars($cours['dateFin']) . ")"; ?>
                    <a href="../../../controllers/etudiantController.php?action=deleteParticipation&user_id=<?php echo $userId; ?>&cours_id=<?php echo $cours['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">Supprimer</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <h2>Inscription à un nouveau cours</h2>
        <form action="../../../controllers/etudiantController.php" method="get">
            <input type="hidden" name="action" value="inscrireCours">
            <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
            
            <label for="cours">Choisissez un cours :</label>
            <select name="coursId" id="cours">
                <?php
                // Récupère la liste de tous les cours pour permettre l'inscription
                require_once('../../../models/etudiantService.php');
                $etudiantService = new EtudiantService();
                $coursDisponibles = $etudiantService->getAllCours();
                foreach ($coursDisponibles as $cours) {
                    echo '<option value="' . htmlspecialchars($cours['id']) . '">' . htmlspecialchars($cours['libelle']) . '</option>';
                }
                ?>
            </select>
            <button type="submit">S'inscrire</button>
        </form>
    </div>

</body>
</html>
