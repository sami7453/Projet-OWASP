<?php include 'header.php'; ?>

<div class="modal-overlay">
    <div class="modal-content">
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=register">
            <label for="firstName">Prénom:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Nom:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Rôle:</label>
            <div>
                <input type="radio" id="role_client" name="role" value="client" required>
                <label for="role_client">Client</label>
            </div>
            <div>
                <input type="radio" id="role_vendeur" name="role" value="vendeur" required>
                <label for="role_vendeur">Vendeur</label>
            </div>

            <button type="submit">S'inscrire</button>
        </form>

        <div class="form-footer">
            <p>Déjà inscrit ? <a href="index.php?action=login">Se connecter</a></p>
            <form action="index.php" method="GET">
                <button type="submit" class="retour">Retour à l'accueil</button>
            </form>
        </div>
    </div>
</div>