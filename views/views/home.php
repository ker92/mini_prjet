
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
</head>
<body>
<h1>Bienvenue au Restaurant Administratif</h1>
<p>Découvrez nos menus et nos offres spéciales !</p>

<?php if (!isset($_SESSION['user'])): ?>
    <a href="?page=login">Se connecter</a>
    <a href="?page=register">S'inscrire</a>
<?php else: ?>
    <p>Bienvenue, <?= $_SESSION['user']['name']; ?>!</p>
    <a href="?page=logout">Déconnexion</a>
    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <a href="?page=admin">Accéder à l'administration</a>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>
<?php