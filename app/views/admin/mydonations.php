<h1>Minhas Doações</h1>
<?php if (!empty($donations)): ?>
    <ul>
        <?php foreach ($donations as $donation): ?>
            <li><?php echo htmlspecialchars($donation['description']); ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Você não possui doações.</p>
<?php endif; ?>
