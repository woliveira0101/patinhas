<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <link rel="stylesheet" href="/assets/css/default-style.css">
  
  <title>Patinhas e Corações</title>
</head>

<body style="padding-top: 100px;">
  <!-- Menu navegação superior -->
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
            <ul class="navbar-nav  align-items-center ms-auto fw-bolded fs-5">
                <li class="nav-item px-3">
                    <a class="nav-link active" aria-current="page" href="/">Início</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/animais">Quero adotar</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/donation/create">Quero doar</a>
                </li>
                <li class="nav-item px-2 btn-group">
                    <button type="button" class="btn btn-warning text-dark nav-item fw-bolded fs-5 dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['user_login'] ?? 'Login' ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-start">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li><a class="dropdown-item" href="/user/profile">Meus dados</a></li>
                            <li><a class="dropdown-item" href="/adoptions">Minhas adoções</a></li>
                            <li><a class="dropdown-item" href="/admin/mydonations">Minhas doações</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/user/logout">Logout</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="/user/login">Login</a></li>
                            <li><a class="dropdown-item" href="/user/register">Registrar</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
