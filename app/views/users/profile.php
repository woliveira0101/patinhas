<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h2>User Profile</h2>
    <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
    <p><strong>Phone Number:</strong> <?php echo $user['phone_number']; ?></p>
    <p><strong>Login:</strong> <?php echo $user['login']; ?></p>
    <!-- Outros campos do perfil do usuário -->
</body>
</html>
