<?php include 'header.php'; ?>

<div class="modal-overlay">
    <div class="modal-content">
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=login">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Connexion</button>
        </form>

        <div class="form-footer">
            <p>Pas encore inscrit ? <a href="index.php?action=register">S'inscrire</a></p>
            <form action="index.php" method="GET">
                <button type="submit" class="retour">Retour à l'accueil</button>
            </form>
        </div>
    </div>
</div>