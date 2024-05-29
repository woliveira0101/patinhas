<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
    <section class="container">
        <a href="/pets" class="text-warning fw-bold">Voltar</a>
        <div class="row mb-5">
            <div class="col m-auto pt-4">
                <?php if (!empty($pet['images'])): ?>
                    <div id="petImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($pet['images'] as $index => $image): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img src="/assets/img/pets/<?= htmlspecialchars($image['image']) ?>" class="d-block w-100 img-fluid" style="max-height: 400px; object-fit: cover; object-position: center;" alt="<?= htmlspecialchars($pet['pet_name']) ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#petImagesCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#petImagesCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="mt-3">
                        <div class="row">
                            <?php foreach ($pet['images'] as $index => $image): ?>
                                <div class="col-3">
                                    <img src="/assets/img/pets/<?= htmlspecialchars($image['image']) ?>" class="img-thumbnail" style="max-height: 100px; cursor: pointer; object-fit: cover; object-position: center;" data-bs-target="#petImagesCarousel" data-bs-slide-to="<?= $index ?>" <?= $index === 0 ? 'class="active"' : '' ?>>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p>Nenhuma foto encontrada</p>
                <?php endif; ?>
            </div>
            <div class="col pt-4">
                <h1 class="fs-3 mb-auto p-4 text-center"><?= htmlspecialchars($pet['pet_name']) ?></h1>
                <p class="fs-5 mb-auto p-4"><?= htmlspecialchars($pet['description']) ?></p>
                <ul class="p-5">
                    <li>Raça: <?= htmlspecialchars($pet['breed']) ?></li>
                    <li>Sexo: <?= htmlspecialchars($pet['gender']) ?></li>
                    <li>Idade: <?= htmlspecialchars($pet['age']) ?> anos</li>
                    <li>Personalidade: <?= htmlspecialchars($pet['personality']) ?></li>
                    <li>Necessidades Especiais: <?= htmlspecialchars($pet['special_care']) ?></li>
                    <li>Porte: <?= htmlspecialchars($pet['size']) ?></li>
                    <li>Cidade: <?= htmlspecialchars($pet['city']) ?> - <?= htmlspecialchars($pet['state']) ?></li>
                </ul>
                <a type="button" id="adoptPetLink" class="btn btn-warning text-dark nav-item fw-bolded fs-5 d-flex flex-column" href="/adoption/request/<?= htmlspecialchars($pet['pet_id']) ?>">Quero adotar!</a>
            </div>
        </div>
    </section>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
