<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
    <div class="container-fluid mt-2">
        <div class="row">
            <!-- Barra lateral de filtros -->
            <div class="col-md-3">
                <div class="bg-light p-3 rounded" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <h1 class="fs-5 text-warning mt-2">Animais</h1>
                    <form method="get" action="/pets">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="type[]" value="cachorro" id="flexCheckDog" <?= in_array('cachorro', $filters['type'] ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label text-secondary" for="flexCheckDog">Cães</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="type[]" value="gato" id="flexCheckCat" <?= in_array('gato', $filters['type'] ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label text-secondary" for="flexCheckCat">Gatos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="type[]" value="outro" id="flexCheckOther" <?= in_array('outro', $filters['type'] ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label text-secondary" for="flexCheckOther">Outros</label>
                        </div>

                        <h1 class="fs-5 text-warning mt-2">Sexo</h1>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="gender[]" value="macho" id="flexCheckMale" <?= in_array('macho', $filters['gender'] ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label text-secondary" for="flexCheckMale">Macho</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="gender[]" value="femea" id="flexCheckFemale" <?= in_array('femea', $filters['gender'] ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label text-secondary" for="flexCheckFemale">Fêmea</label>
                        </div>

                        <h1 class="fs-5 text-warning mt-2">Idade</h1>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="age[]" value="5" id="flexCheckAge5" <?= in_array('5', $filters['age'] ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label text-secondary" for="flexCheckAge5">Até 5 anos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="age[]" value="10" id="flexCheckAge10" <?= in_array('10', $filters['age'] ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label text-secondary" for="flexCheckAge10">Até 10 anos</label>
                        </div>

                        <h1 class="fs-5 text-warning mt-2">Porte</h1>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="size[]" value="pequeno" id="flexCheckSmall" <?= in_array('pequeno', $filters['size'] ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label text-secondary" for="flexCheckSmall">Pequeno(até 10kg)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="size[]" value="medio" id="flexCheckMedium" <?= in_array('medio', $filters['size'] ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label text-secondary" for="flexCheckMedium">Médio(até 25kg)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="size[]" value="grande" id="flexCheckLarge" <?= in_array('grande', $filters['size'] ?? []) ? 'checked' : '' ?>>
                            <label class="form-check-label text-secondary" for="flexCheckLarge">Grande(mais de 25kg)</label>
                        </div>

                        <button type="submit" class="btn btn-warning mt-3">Filtrar</button>
                    </form>
                </div>
            </div>

            <!-- Cards de pets -->
            <div class="col-md-9">
                <div class="row row-cols-auto g-2 justify-content-start">
                    <?php foreach ($pets as $pet): ?>
                        <div class="col my-2">
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
                                    <p class="card-text text-center p-3"><?= htmlspecialchars($pet['description']) ?></p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item text-center"><?= htmlspecialchars($pet['breed']) ?></li>
                                    <li class="list-group-item text-center"><?= htmlspecialchars($pet['age']) ?> anos</li>
                                    <li class="list-group-item text-center"><?= htmlspecialchars($pet['city']) ?> - <?= htmlspecialchars($pet['state']) ?></li>
                                </ul>
                                <div class="card-body d-flex justify-content-center">
                                    <a href="/pet/show/<?= htmlspecialchars($pet['pet_id']) ?>" class="card-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">Conhecer melhor!</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
