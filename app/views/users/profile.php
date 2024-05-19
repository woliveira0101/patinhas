<?php include __DIR__ . '/../include/header.php'; ?>

    <div class="profile-container">
        <h1>Perfil do Usuário</h1>

        <form action="/user/update/<?= htmlspecialchars($user['user_id']) ?>" method="post" enctype="multipart/form-data">
            <?php
            $imagePath = realpath(__DIR__ . '/../../uploads/' . $user['image']);
            if (isset($user['image']) && $user['image'] != null && file_exists($imagePath)): ?>
                <div class="user-image">
                    <img src="/uploads/<?= htmlspecialchars($user['image']) ?>" alt="Imagem do Usuário" class="profile-img">
                </div>
            <?php else: ?>
                <div class="user-image">
                    <img src="/assets/img/default-profile.jpg" alt="Imagem Padrão do Usuário" class="profile-img">
                </div>
            <?php endif; ?>
            <div>
                <label for="image">Atualizar Imagem:</label>
                <input type="file" name="image" id="image">
            </div>

            <div class="user-details">
                <label for="user_name"><strong>Nome:</strong></label>
                <input type="text" name="user_name" id="user_name" value="<?= htmlspecialchars($user['user_name']) ?>">

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

            <button type="submit">Salvar Alterações</button>
        </form>

        <br>
        <a href="/user/logout">Logout</a>
    </div>

    <?php include __DIR__ . '/../include/footer.php'; ?>