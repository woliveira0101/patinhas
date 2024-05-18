<h1>Minhas Adoções</h1>
<?php if (!empty($adoptions)): ?>
    <ul>
        <?php foreach ($adoptions as $adoption): ?>
            <li><?php echo htmlspecialchars($adoption['description']); ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Você não possui adoções.</p>
<?php endif; ?>
