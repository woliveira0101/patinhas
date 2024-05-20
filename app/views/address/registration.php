<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
<div class="container">
    <h2>Registrar Endereço</h2>
    <form action="/address/register" method="POST">
        <div class="mb-3">
            <label for="zip_code" class="form-label">CEP:</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" required>
        </div>
        <div class="mb-3">
            <label for="street_name" class="form-label">Rua:</label>
            <input type="text" class="form-control" id="street_name" name="street_name" required>
        </div>
        <div class="mb-3">
            <label for="address_number" class="form-label">Número:</label>
            <input type="text" class="form-control" id="address_number" name="address_number" required>
        </div>
        <div class="mb-3">
            <label for="address_complement" class="form-label">Complemento:</label>
            <input type="text" class="form-control" id="address_complement" name="address_complement">
        </div>
        <div class="mb-3">
            <label for="neighboorhood" class="form-label">Bairro:</label>
            <input type="text" class="form-control" id="neighboorhood" name="neighboorhood" required>
        </div>
        <div class="mb-3">
            <label for="city_name" class="form-label">Cidade:</label>
            <input type="text" class="form-control" id="city_name" name="city_name" required>
        </div>
        <div class="mb-3">
            <label for="state_name" class="form-label">Estado:</label>
            <select class="form-select" id="state_name" name="state_name" required>
                <option value="" selected>Selecione</option>
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
        <button type="submit" class="btn btn-primary">Registrar Endereço</button>
    </form>
</div>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
