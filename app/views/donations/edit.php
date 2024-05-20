<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
    <div class="container">
        <h1>Editar Doação</h1>
        <form action="/donation/update/<?= htmlspecialchars($donation['donation_id']) ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nomePet" class="form-label fw-bolded">Nome do Pet</label>
                <input type="text" class="form-control" id="nomePet" name="nomePet" value="<?= htmlspecialchars($donation['pet_name'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="descricaoPet" class="form-label fw-bolded">Breve descrição do Pet</label>
                <textarea class="form-control" id="descricaoPet" name="descricaoPet" rows="2"><?= htmlspecialchars($donation['description'] ?? '') ?></textarea>
            </div>
            <div class="row">
                <div class="col ms-1 mb-1">
                    <label for="form_especie" class="form-label fw-bolded">Espécie</label>
                    <select class="form-select" id="form_especie" name="form_especie">
                        <option value="cachorro" <?= ($donation['type'] ?? '') == 'cachorro' ? 'selected' : '' ?>>Cachorro</option>
                        <option value="gato" <?= ($donation['type'] ?? '') == 'gato' ? 'selected' : '' ?>>Gato</option>
                        <option value="outro" <?= ($donation['type'] ?? '') == 'outro' ? 'selected' : '' ?>>Outro</option>
                    </select>
                </div>
                <div class="col ms-1 mb-1">
                    <label for="form_sexo" class="form-label fw-bolded">Sexo</label>
                    <select class="form-select" id="form_sexo" name="form_sexo">
                        <option value="macho" <?= ($donation['gender'] ?? '') == 'macho' ? 'selected' : '' ?>>Macho</option>
                        <option value="femea" <?= ($donation['gender'] ?? '') == 'femea' ? 'selected' : '' ?>>Fêmea</option>
                        <option value="nao sei" <?= ($donation['gender'] ?? '') == 'nao sei' ? 'selected' : '' ?>>Não Sei</option>
                    </select>
                </div>
                <div class="col mb-3">
                    <label for="racaPet" class="form-label fw-bolded">Raça do Pet</label>
                    <input type="text" class="form-control" id="racaPet" name="racaPet" value="<?= htmlspecialchars($donation['breed'] ?? '') ?>">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="idadePet" class="form-label fw-bolded">Idade (anos)</label>
                    <input type="text" class="form-control d-inline" id="idadePet" name="idadePet" value="<?= htmlspecialchars($donation['age'] ?? '') ?>">
                </div>
                <div class="col mb-3">
                    <label for="sizePet" class="form-label fw-bolded">Tamanho</label>
                    <select class="form-select" id="sizePet" name="sizePet">
                        <option value="pequeno" <?= ($donation['size'] ?? '') == 'pequeno' ? 'selected' : '' ?>>Pequeno</option>
                        <option value="medio" <?= ($donation['size'] ?? '') == 'medio' ? 'selected' : '' ?>>Médio</option>
                        <option value="grande" <?= ($donation['size'] ?? '') == 'grande' ? 'selected' : '' ?>>Grande</option>
                    </select>
                </div>
                <div class="col mx-1 mb-1">
                    <label for="form_cidade" class="form-label fw-bolded">Cidade</label>
                    <input type="text" class="form-control" id="form_cidade" name="form_cidade" value="<?= htmlspecialchars($donation['city'] ?? '') ?>">
                </div>
                <div class="col mx-1 mb-1">
                    <label for="form_estado" class="form-label fw-bolded">Estado</label>
                    <select class="form-select" id="form_estado" name="form_estado">
                        <option value="AC" <?= ($donation['state'] ?? '') == 'AC' ? 'selected' : '' ?>>AC</option>
                        <option value="AL" <?= ($donation['state'] ?? '') == 'AL' ? 'selected' : '' ?>>AL</option>
                        <option value="AP" <?= ($donation['state'] ?? '') == 'AP' ? 'selected' : '' ?>>AP</option>
                        <option value="AM" <?= ($donation['state'] ?? '') == 'AM' ? 'selected' : '' ?>>AM</option>
                        <option value="BA" <?= ($donation['state'] ?? '') == 'BA' ? 'selected' : '' ?>>BA</option>
                        <option value="CE" <?= ($donation['state'] ?? '') == 'CE' ? 'selected' : '' ?>>CE</option>
                        <option value="DF" <?= ($donation['state'] ?? '') == 'DF' ? 'selected' : '' ?>>DF</option>
                        <option value="ES" <?= ($donation['state'] ?? '') == 'ES' ? 'selected' : '' ?>>ES</option>
                        <option value="GO" <?= ($donation['state'] ?? '') == 'GO' ? 'selected' : '' ?>>GO</option>
                        <option value="MA" <?= ($donation['state'] ?? '') == 'MA' ? 'selected' : '' ?>>MA</option>
                        <option value="MT" <?= ($donation['state'] ?? '') == 'MT' ? 'selected' : '' ?>>MT</option>
                        <option value="MS" <?= ($donation['state'] ?? '') == 'MS' ? 'selected' : '' ?>>MS</option>
                        <option value="MG" <?= ($donation['state'] ?? '') == 'MG' ? 'selected' : '' ?>>MG</option>
                        <option value="PA" <?= ($donation['state'] ?? '') == 'PA' ? 'selected' : '' ?>>PA</option>
                        <option value="PB" <?= ($donation['state'] ?? '') == 'PB' ? 'selected' : '' ?>>PB</option>
                        <option value="PR" <?= ($donation['state'] ?? '') == 'PR' ? 'selected' : '' ?>>PR</option>
                        <option value="PE" <?= ($donation['state'] ?? '') == 'PE' ? 'selected' : '' ?>>PE</option>
                        <option value="PI" <?= ($donation['state'] ?? '') == 'PI' ? 'selected' : '' ?>>PI</option>
                        <option value="RJ" <?= ($donation['state'] ?? '') == 'RJ' ? 'selected' : '' ?>>RJ</option>
                        <option value="RN" <?= ($donation['state'] ?? '') == 'RN' ? 'selected' : '' ?>>RN</option>
                        <option value="RS" <?= ($donation['state'] ?? '') == 'RS' ? 'selected' : '' ?>>RS</option>
                        <option value="RO" <?= ($donation['state'] ?? '') == 'RO' ? 'selected' : '' ?>>RO</option>
                        <option value="RR" <?= ($donation['state'] ?? '') == 'RR' ? 'selected' : '' ?>>RR</option>
                        <option value="SC" <?= ($donation['state'] ?? '') == 'SC' ? 'selected' : '' ?>>SC</option>
                        <option value="SP" <?= ($donation['state'] ?? '') == 'SP' ? 'selected' : '' ?>>SP</option>
                        <option value="SE" <?= ($donation['state'] ?? '') == 'SE' ? 'selected' : '' ?>>SE</option>
                        <option value="TO" <?= ($donation['state'] ?? '') == 'TO' ? 'selected' : '' ?>>TO</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="colourPet" class="form-label fw-bolded">Cor do Pet</label>
                <input type="text" class="form-control" id="colourPet" name="colourPet" value="<?= htmlspecialchars($donation['colour'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="personalidadePet" class="form-label fw-bolded">Personalidade do Pet</label>
                <input type="text" class="form-control" id="personalidadePet" name="personalidadePet" value="<?= htmlspecialchars($donation['personality'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="necessidadesEspeciaisPet" class="form-label fw-bolded">Necessidades Especiais do Pet</label>
                <input type="text" class="form-control" id="necessidadesEspeciaisPet" name="necessidadesEspeciaisPet" value="<?= htmlspecialchars($donation['special_care'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="vaccinated" class="form-label fw-bolded">Vacinado:</label>
                <input type="checkbox" id="vaccinated" name="vaccinated" <?= ($donation['vaccinated'] ?? 0) ? 'checked' : '' ?>>
            </div>
            <div class="mb-3">
                <label for="castrated" class="form-label fw-bolded">Castrado:</label>
                <input type="checkbox" id="castrated" name="castrated" <?= ($donation['castrated'] ?? 0) ? 'checked' : '' ?>>
            </div>
            <div class="mb-3">
                <label for="vermifuged" class="form-label fw-bolded">Vermifugado:</label>
                <input type="checkbox" id="vermifuged" name="vermifuged" <?= ($donation['vermifuged'] ?? 0) ? 'checked' : '' ?>>
            </div>
            <div class="mb-3">
                <label for="fotosPet" class="form-label">Anexe as fotos do seu Pet</label>
                <input class="form-control" type="file" id="fotosPet" name="fotosPet[]" multiple>
            </div>

            <!-- Display existing pet images -->
            <?php if (!empty($donation['images'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-bolded">Fotos atuais do Pet:</label>
                    <div class="row">
                        <?php foreach ($donation['images'] as $image): ?>
                            <div class="col-3 mb-3">
                                <img src="/assets/img/pets/<?= htmlspecialchars($image['image']) ?>" alt="Pet Image" class="img-thumbnail">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="delete_images[]" value="<?= $image['image_id'] ?>" id="deleteImage<?= $image['image_id'] ?>">
                                    <label class="form-check-label" for="deleteImage<?= $image['image_id'] ?>">Excluir</label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <p>Nenhuma foto encontrada.</p>
            <?php endif; ?>

            <!-- Preview for new images -->
            <div id="imagePreview" class="row"></div>

            <button type="submit" class="btn btn-warning mx-1 my-3">Salvar Alterações</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('fotosPet').addEventListener('change', function() {
        const previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = ''; // Clear previous previews
        Array.from(this.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const colDiv = document.createElement('div');
                colDiv.classList.add('col-3', 'mb-3');
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail');
                colDiv.appendChild(img);
                previewContainer.appendChild(colDiv);
            };
            reader.readAsDataURL(file);
        });
    });
</script>

<?php include __DIR__ . '/../include/footer.php'; ?>

