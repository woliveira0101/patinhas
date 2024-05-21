<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
    <div class="full-width-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col d-flex"
                    style="height: 450px; background-image: url(/assets/img/quero_adotar.png); background-position: center; background-size: cover;">
                    <a href="/pets" class="d-flex flex-column py-5 px-2 mb-auto ms-1 destaque-zoom"
                        style="text-decoration: none; font-size: 54px; text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.8);">
                        <span class="text-light">Quero</span>
                        <span class="text-light fw-bold">Adotar!</span>
                    </a>
                </div>
                <div class="col d-flex"
                    style="height: 450px; background-image: url(/assets/img/quero_doar.png); background-position: center; background-size: cover;">
                    <a href="/donation/create" class="d-flex flex-column py-5 px-4 justify-content-end mt-auto ms-auto destaque-zoom"
                        style="text-decoration: none; font-size: 54px; text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.85);">
                        <span class="text-light">Quero</span>
                        <span class="text-light fw-bold">Doar!</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="container text-center">
        <h1 class="text-center mt-4">Eles estão esperando por você!</h1>
        <!-- Cards -->
        <div class="pet-card-row">
            <?php foreach (array_slice($pets, 0, 4) as $pet): ?>
            <div class="card pet-card pet-card-fixed-height">
                <a href="/pet/show/<?= htmlspecialchars($pet['pet_id']) ?>">
                    <?php if (!empty($pet['images'])): ?>
                    <img src="/assets/img/pets/<?= htmlspecialchars($pet['images'][0]['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($pet['pet_name']) ?>">
                    <?php else: ?>
                    <img src="/assets/img/pets/default-pet.png" class="card-img-top" alt="Imagem não disponível">
                    <?php endif; ?>
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title text-center"><?= htmlspecialchars($pet['pet_name']) ?></h5>
                    <p class="card-text text-center p-2"><?= htmlspecialchars($pet['description']) ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center"><?= htmlspecialchars($pet['breed']) ?></li>
                    <li class="list-group-item text-center"><?= htmlspecialchars($pet['age']) ?> anos</li>
                    <li class="list-group-item text-center"><?= htmlspecialchars($pet['city']) ?> - <?= htmlspecialchars($pet['state']) ?></li>
                </ul>
                <div class="card-body d-flex justify-content-center">
                    <a href="/pet/show/<?= htmlspecialchars($pet['pet_id']) ?>" class="card-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">
                        Conhecer melhor!
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <a href="/pets" type="button" class="btn btn-warning btn-lg m-3 mb-5">Veja mais amiguinhos disponíveis</a>
        </div>
    </section>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
