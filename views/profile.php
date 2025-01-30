<?php include 'header.php'; ?>

<main class="profile-container">
    <?php if (isset($error)): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <section class="profile-info">
        <h2>Mon Profil</h2>
        <div class="user-details">
            <p><strong>Prénom:</strong> <?php echo htmlspecialchars($user['firstName']); ?></p>
            <p><strong>Nom:</strong> <?php echo htmlspecialchars($user['lastName']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Rôle:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
        </div>
    </section>

    <?php if ($isVendeur): ?>
        <section class="create-product">
            <h3>Créer un nouveau produit</h3>
            <form method="POST" action="index.php?action=profile" enctype="multipart/form-data" class="product-form">
                <div class="form-group">
                    <label for="name">Nom du produit :</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        minlength="3"
                        maxlength="100"
                        placeholder="Nom du produit">
                </div>

                <div class="form-group">
                    <label for="description">Description du produit :</label>
                    <textarea
                        id="description"
                        name="description"
                        required
                        minlength="10"
                        maxlength="1000"
                        rows="5"
                        placeholder="Décrivez votre produit en détail"></textarea>
                </div>

                <div class="form-group">
                    <label for="id_categorie">Catégorie du produit :</label>
                    <select id="id_categorie" name="id_categorie" required>
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="1">Sport</option>
                        <option value="2">Politique</option>
                        <option value="3">Tech</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Image du produit :</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/jpeg,image/png,image/gif"
                        required>
                    <small class="form-text">Formats acceptés : JPG, PNG, GIF. Taille maximale : 5 MB</small>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-primary">Créer le produit</button>
                    <button type="reset" class="btn-secondary">Réinitialiser</button>
                    <a href="index.php" class="btn-tertiary">Retour à l'accueil</a>
                </div>
            </form>
        </section>
    <?php else: ?>
        <div class="info-message">
            <p>Seuls les vendeurs peuvent créer des produits. Si vous souhaitez devenir vendeur, veuillez contacter l'administrateur.</p>
        </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>