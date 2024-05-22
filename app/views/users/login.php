<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
        <section class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-3 mt-5">
                    <h2 class="text-center">Login</h2>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form method="post" action="/user/authenticate">
                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" class="form-control" id="login" name="login" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="/user/register" class="btn btn-secondary btn-block">Registrar</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php include __DIR__ . '/../include/footer.php'; ?>
