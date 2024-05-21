<?php include __DIR__ . '/../include/header.php'; ?>

<section class="container">
  <a href="/pets" class="text-warning fw-bold">Voltar</a>
  <div class="row mb-5">
    <div class="col m-auto pt-4">
      <img class="img-fluid" src="/assets/img/pets/<?= htmlspecialchars($pet['main_image']) ?>" alt="<?= htmlspecialchars($pet['pet_name']) ?>">
      <div class="mt-3">
        <?php foreach ($pet['images'] as $image): ?>
        <img class="me-2" src="/assets/img/pets/<?= htmlspecialchars($image['image']) ?>" alt="" style="max-width: 120px; object-fit: cover;">
        <?php endforeach; ?>
      </div>
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
      <a type="button" class="btn btn-warning text-dark nav-item fw-bolded fs-5 d-flex flex-column" href="/adoptions/create/<?= htmlspecialchars($pet['pet_id']) ?>">Quero adotar!</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../include/footer.php'; ?>
