<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
</head>

<body>
    <h2>Registrar</h2>
    <form action="/user/register" method="POST" enctype="multipart/form-data">
        <label for="user_name">Name:</label><br>
        <input type="text" id="user_name" name="user_name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone_number">Phone Number:</label><br>
        <input type="text" id="phone_number" name="phone_number" required><br><br>

        <label for="login">Login:</label><br>
        <input type="text" id="login" name="login" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="type">Type:</label><br>
        <select id="type" name="type">
            <option value="doador">Doador</option>
            <option value="adotante">Adotante</option>
            <option value="ambos">Ambos</option>
        </select><br><br>

        <label for="image">Foto:</label><br>
        <input type="file" id="image" name="image"><br><br>

        <input type="submit" name="register" value="Register">
    </form>
</body>

</html>
