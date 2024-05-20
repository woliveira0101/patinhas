<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
<div class="main-container">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="text-center mb-4">Login</h2>
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_SESSION['error_message']); ?>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>
            <form action="/user/authenticate" method="post">
                <div class="mb-3">
                    <label for="login" class="form-label">Usuário:</label>
                    <input type="text" id="login" name="login" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
