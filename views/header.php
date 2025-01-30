<!DOCTYPE html>
<html lang="fr">

<head>
    <title>News</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav>
            <a href="index.php">
                <h1>News</h1>
            </a>
            <div class="nav-links">
                <a href="index.php?categorie=Clavier">Clavier</a>
                <a href="index.php?categorie=Souris">Souris</a>
                <a href="index.php?categorie=Casque">Casque</a>
            </div>
            <div class="user-icon">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="index.php?action=profile">Mon Profil</a>
                    <a href="index.php?action=logout">Déconnexion</a>
                <?php else: ?>
                    <a href="index.php?action=login">Connexion</a>
                    <a href="index.php?action=register">Inscription</a>
                <?php endif; ?>
                <img src="/images/icon/user-icon-svgrepo-com.svg" alt="user_log">
            </div>
        </nav>
    </header>