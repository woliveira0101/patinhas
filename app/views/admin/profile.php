<h1>Meu Perfil</h1>
<?php if (!empty($user)): ?>
    <form action="/admin/updateProfile" method="POST" enctype="multipart/form-data">
        <label for="user_name">Nome:</label>
        <input type="text" id="user_name" name="user_name" value="<?php echo htmlspecialchars($user['user_name']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="phone_number">Telefone:</label>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>

        <label for="image">Imagem:</label>
        <input type="file" id="image" name="image">

        <button type="submit">Atualizar Perfil</button>
    </form>
<?php else: ?>
    <p>Usuário não encontrado.</p>
<?php endif; ?>
