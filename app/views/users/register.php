<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
<div class="container register-container">
    <h2 class="text-center">Registrar</h2>
    <form action="/user/register" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Número de Telefone:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
        </div>
        <div class="mb-3">
            <label for="login" class="form-label">Login:</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipo:</label>
            <select class="form-select" id="type" name="type">
                <option value="doador">Doador</option>
                <option value="adotante">Adotante</option>
                <option value="ambos">Ambos</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Foto:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-success" name="register" value="Registrar">
        </div>
    </form>
    <div class="text-center mt-3">
        <button class="btn btn-primary" onclick="location.href='/user/register?address=true'">Adicionar Endereço</button>
    </div>
</div>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
