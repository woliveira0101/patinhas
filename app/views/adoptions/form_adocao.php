<?php include __DIR__ . '/../include/header.php'; ?>

<section class="container">
  <div class="row">
    <div class="col-8 col-md-10 mt-2 mb-3 mx-auto py-3 px-md-5 border rounded bg-body-tertiary" style="box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.3);">
      <h1 class="fw-bolded fs-3 text-warning text-center">Preencha o formulário para avaliarmos o pedido de adoção</h1>
      <form action="/adoptions/store" method="post">
        <?php foreach ($questions as $index => $question): ?>
        <div class="mx-1 mb-2">
          <label for="perguntaform<?= $index ?>" class="form-label"><?= $index + 1 ?>) <?= htmlspecialchars($question['question_content']) ?></label>
          <textarea class="form-control" id="perguntaform<?= $index ?>" name="answers[<?= $question['question_id'] ?>]" rows="2"></textarea>
        </div>
        <?php endforeach; ?>
        <div class="form-check my-4">
          <input class="form-check-input" type="checkbox" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            Declaro que estou ciente e decidido pela adoção, e concordo que os dados preenchidos acima sejam avaliados pelos tutores atuais do pet, prezando pela segurança e bem estar do mesmo.
          </label>
        </div>
        <button type="submit" class="btn btn-warning mx-1 my-3">Enviar</button>
      </form>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../include/footer.php'; ?>
