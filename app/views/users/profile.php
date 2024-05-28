<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
    <div class="profile-container">
        <h1>Perfil do Usuário</h1>
        <form action="/user/update/<?= htmlspecialchars($user['user_id']) ?>" method="post" enctype="multipart/form-data">
            <?php
            $imagePath = __DIR__ . '/../../../public/assets/img/profiles/' . $user['image'];
            $webImagePath = '/assets/img/profiles/' . $user['image'];
            if (isset($user['image']) && $user['image'] != null && file_exists($imagePath)): ?>
                <div class="user-image">
                    <img src="<?= htmlspecialchars($webImagePath) ?>" alt="Imagem do Usuário" class="profile-img">
                </div>
            <?php else: ?>
                <div class="user-image">
                    <img src="/assets/img/profiles/default-profile.jpg" alt="Imagem Padrão do Usuário" class="profile-img">
                </div>
            <?php endif; ?>
            <div>
                <label for="image">Atualizar Imagem:</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="user-details">
                <label for="name"><strong>Nome:</strong></label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']) ?>">
                <label for="email"><strong>Email:</strong></label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>">
                <label for="phone_number"><strong>Telefone:</strong></label>
                <input type="text" name="phone_number" id="phone_number" value="<?= htmlspecialchars($user['phone_number']) ?>">
                <label for="login"><strong>Login:</strong></label>
                <input type="text" name="login" id="login" value="<?= htmlspecialchars($user['login']) ?>" disabled>
                <label for="type"><strong>Tipo:</strong></label>
                <select name="type" id="type">
                    <option value="doador" <?= $user['type'] == 'doador' ? 'selected' : '' ?>>Doador</option>
                    <option value="adotante" <?= $user['type'] == 'adotante' ? 'selected' : '' ?>>Adotante</option>
                    <option value="ambos" <?= $user['type'] == 'ambos' ? 'selected' : '' ?>>Ambos</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100 mb-3">Salvar Alterações</button>
        </form>
        <div class="btn-container">
            <button type="button" class="btn btn-secondary me-2 w-100 mb-3" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Alterar Senha</button>
            <a href="/address/list" class="btn btn-secondary w-100">Meus Endereços</a>
        </div>
    </div>
</div>

<!-- Modal para alterar senha -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Alterar Senha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Senha Atual</label>
                        <input type="password" class="form-control" id="currentPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" id="newPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Confirmar Nova Senha</label>
                        <input type="password" class="form-control" id="confirmNewPassword" required>
                    </div>
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
