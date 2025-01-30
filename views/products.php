<?php include 'header.php'; ?>

<main>
    <section class="products-container">
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (!empty($products)): ?>
            <div class="products-grid">
                <?php foreach ($products as $product): ?>
                    <article class="product-card">
                        <img
                            src="images/<?php echo htmlspecialchars($product['image']); ?>"
                            alt="<?php echo htmlspecialchars($product['name']); ?>"
                            class="product-image">
                        <div class="product-content">
                            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                            <p class="product-description">
                                <?php echo htmlspecialchars($product['description']); ?>
                            </p>
                            <p class="product-date">
                                Publié le <?php echo htmlspecialchars(date('d/m/Y', strtotime($product['date_creation']))); ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-products">Aucun article disponible pour le moment.</p>
        <?php endif; ?>
    </section>
</main>

<?php include 'footer.php'; ?>