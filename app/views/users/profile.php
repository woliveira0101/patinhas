<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="/public/assets/css/default-style.css">
</head>
<body>
    <?php include __DIR__ . '/../include/header.php'; ?>

    <div class="profile-container">
        <h1>Perfil do Usuário</h1>

        <form action="/user/update/<?= htmlspecialchars($user['user_id']) ?>" method="post" enctype="multipart/form-data">
            <?php
            // Debugar
            // $dir = __DIR__ . '/../../uploads/';
            // $file = $dir . $user['image'];
            // echo $file;
            // if (file_exists($dir)) {
            //     echo "Directory exists.\n";
            //     if (is_readable($dir)) {
            //         echo "Directory is readable.\n";
            //         if (file_exists($file)) {
            //             echo "File exists.\n";
            //             if (is_readable($file)) {
            //                 echo "File is readable.\n";
            //             } else {
            //                 echo "File is not readable.\n";
            //             }
            //         } else {
            //             echo "File does not exist.\n";
            //         }
            //     } else {
            //         echo "Directory is not readable.\n";
            //     }
            // } else {
            //     echo "Directory does not exist.\n";
            // }
            //
            $imagePath = realpath(__DIR__ . '/../../uploads/' . $user['image']);
            //echo "Image path: $imagePath";
            if (isset($user['image']) && $user['image'] != null && file_exists($imagePath)): ?>
                <div class="user-image">
                    <img src="/uploads/<?= htmlspecialchars($user['image']) ?>" alt="Imagem do Usuário">
                </div>
            <?php else: ?>
                <div class="user-image">
                    <img src="/public/assets/img/default-profile.jpg" alt="Imagem Padrão do Usuário">
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
                <input type="text" name="type" id="type" value="<?= htmlspecialchars($user['type']) ?>">
            </div>

            <button type="submit">Salvar Alterações</button>
        </form>

        <br>
        <a href="/user/logout">Logout</a>
    </div>

    <?php include __DIR__ . '/../include/footer.php'; ?>
</body>
</html>
