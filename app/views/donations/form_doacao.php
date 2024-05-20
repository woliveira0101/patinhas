<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
<section class="container">
    <div class="row">
        <div class="col-8 col-md-10 mt-2 mb-3 mx-auto py-3 px-md-5 border rounded bg-body-tertiary"
            style="box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.3);">
            <h1 class="fw-bolded fs-3 text-warning text-center">Cadastre seu pet para doação</h1>
            <form action="/donation/store" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nomePet" class="form-label fw-bolded">Nome do Pet</label>
                    <input type="text" class="form-control" id="nomePet" name="nomePet">
                </div>
                <div class="mb-3">
                    <label for="descricaoPet" class="form-label fw-bolded">Breve descrição do Pet</label>
                    <textarea class="form-control" id="descricaoPet" name="descricaoPet" rows="2"></textarea>
                </div>
                <div class="row">
                    <div class="col ms-1 mb-1">
                        <label for="form_especie" class="form-label fw-bolded">Espécie</label>
                        <select class="form-select" id="form_especie" name="form_especie" aria-label="Default select example">
                            <option selected>Selecione</option>
                            <option value="cachorro">Cachorro</option>
                            <option value="gato">Gato</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                    <div class="col ms-1 mb-1">
                        <label for="form_sexo" class="form-label fw-bolded">Sexo</label>
                        <select class="form-select" id="form_sexo" name="form_sexo" aria-label="Default select example">
                            <option selected>Selecione</option>
                            <option value="macho">Macho</option>
                            <option value="femea">Fêmea</option>
                            <option value="nao sei">Não Sei</option>
                        </select>
                    </div>
                    <div class="col mb-3">
                        <label for="racaPet" class="form-label fw-bolded">Raça do Pet</label>
                        <input type="text" class="form-control" id="racaPet" name="racaPet">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="idadePet" class="form-label fw-bolded">Idade (anos)</label>
                        <input type="text" class="form-control d-inline" id="idadePet" name="idadePet">
                    </div>
                    <div class="col mb-3">
                        <label for="sizePet" class="form-label fw-bolded">Tamanho</label>
                        <select class="form-select" id="sizePet" name="sizePet">
                            <option selected>Selecione</option>
                            <option value="pequeno">Pequeno</option>
                            <option value="medio">Médio</option>
                            <option value="grande">Grande</option>
                        </select>
                    </div>
                    <div class="col mx-1 mb-1">
                        <label for="form_cidade" class="form-label fw-bolded">Cidade</label>
                        <input type="text" class="form-control" id="form_cidade" name="form_cidade">
                    </div>
                    <div class="col mx-1 mb-1">
                        <label for="form_estado" class="form-label fw-bolded">Estado</label>
                        <select class="form-select" id="form_estado" name="form_estado">
                            <option selected>Selecione</option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="colourPet" class="form-label fw-bolded">Cor do Pet</label>
                    <input type="text" class="form-control" id="colourPet" name="colourPet">
                </div>
                <div class="mb-3">
                    <label for="personalidadePet" class="form-label fw-bolded">Personalidade do Pet</label>
                    <input type="text" class="form-control" id="personalidadePet" name="personalidadePet">
                </div>
                <div class="mb-3">
                    <label for="necessidadesEspeciaisPet" class="form-label fw-bolded">Necessidades Especiais do Pet</label>
                    <input type="text" class="form-control" id="necessidadesEspeciaisPet" name="necessidadesEspeciaisPet">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="vaccinated" name="vaccinated">
                    <label class="form-check-label" for="vaccinated">Vacinado</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="castrated" name="castrated">
                    <label class="form-check-label" for="castrated">Castrado</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="vermifuged" name="vermifuged">
                    <label class="form-check-label" for="vermifuged">Vermifugado</label>
                </div>
                <div class="mb-3">
                    <label for="fotosPet" class="form-label">Anexe as fotos do seu Pet</label>
                    <input class="form-control" type="file" id="fotosPet" name="fotosPet[]" multiple>
                </div>
                <div class="form-check my-4">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Declaro que estou decidido pela doação, e concordo em avaliar com critério o perfil dos interessados na adoção deste animal de estimação.
                    </label>
                </div>
                <button type="submit" class="btn btn-warning mx-1 my-3">Cadastrar</button>
            </form>
        </div>
    </div>
</section>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
