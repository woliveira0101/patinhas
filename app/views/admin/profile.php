
    <?php include __DIR__ . '/../include/header.php'; ?>

    <div class="main-content">
    <div class="profile-container">
        <h1>Perfil do Usuário</h1>

        <?php if (isset($user['image']) && $user['image'] != null): ?>
            <div class="user-image">
                <img src="/uploads/<?= htmlspecialchars($user['image']) ?>" alt="Imagem do Usuário">
            </div>
        <?php else: ?>
            <div class="user-image">
                <img src="/assets/img/profiles/default-profile.jpg" alt="Imagem Padrão do Usuário">
            </div>
        <?php endif; ?>

        <div class="user-details">
            <p><strong>Nome:</strong> <?= htmlspecialchars($user['user_name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Telefone:</strong> <?= htmlspecialchars($user['phone_number']) ?></p>
            <p><strong>Login:</strong> <?= htmlspecialchars($user['login']) ?></p>
            <p><strong>Tipo:</strong> <?= htmlspecialchars($user['type']) ?></p>
        </div>

        <a href="/user/edit/<?= htmlspecialchars($user['user_id']) ?>">Editar Perfil</a>
        <br>
        <a href="/admin/logout">Logout</a>
    </div>
</div>
    <?php include __DIR__ . '/../include/footer.php'; ?>
