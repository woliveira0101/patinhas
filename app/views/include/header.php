<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/default-style.css">
  
  <title>Patinhas e Corações</title>
</head>

<body>
<nav class="navbar fixed-top navbar-expand-md bg-body-tertiary" style="box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.3);">
    <div class="container-fluid">
        <a class="navbar-brand ms-3" href="/">
            <img style="max-width: 70px;" src="/assets/img/logo.png">
        </a>
        <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center ms-auto fw-bolded fs-5">
                <li class="nav-item px-3">
                    <a class="nav-link active" aria-current="page" href="/">Início</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/pets">Quero adotar</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/donations/create">Quero doar</a>
                </li>
                <li class="nav-item px-2 btn-group">
                    <?php if (isset($_SESSION['user_login'])): ?>
                        <button type="button" class="btn btn-warning text-dark nav-item fw-bolded fs-5 dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <?= htmlspecialchars($_SESSION['user_login']) ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/user/profile">Meus dados</a></li>
                            <li><a class="dropdown-item" href="/admin/myadoptions">Minhas adoções</a></li>
                            <li><a class="dropdown-item" href="/admin/mydonations">Minhas doações</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/user/logout">Logout</a></li>
                        </ul>
                    <?php else: ?>
                        <a href="/user/login" class="btn btn-warning text-dark nav-item fw-bolded fs-5">Login</a>
                        <li><a class="dropdown-item" href="/user/register">Registrar</a></li>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
