<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
    <div class="container">
        <h1>Editar Endereço</h1>
        <form action="/address/edit/<?= htmlspecialchars($address['address_id']) ?>" method="post">
            <div class="form-group">
                <label for="zip_code">CEP:</label>
                <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?= htmlspecialchars($address['zip_code']) ?>" required>
            </div>
            <div class="form-group">
                <label for="street_name">Rua:</label>
                <input type="text" class="form-control" id="street_name" name="street_name" value="<?= htmlspecialchars($address['street_name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="address_number">Número:</label>
                <input type="text" class="form-control" id="address_number" name="address_number" value="<?= htmlspecialchars($address['address_number']) ?>" required>
            </div>
            <div class="form-group">
                <label for="address_complement">Complemento:</label>
                <input type="text" class="form-control" id="address_complement" name="address_complement" value="<?= htmlspecialchars($address['address_complement']) ?>">
            </div>
            <div class="form-group">
                <label for="neighboorhood">Bairro:</label>
                <input type="text" class="form-control" id="neighboorhood" name="neighboorhood" value="<?= htmlspecialchars($address['neighboorhood']) ?>" required>
            </div>
            <div class="form-group">
                <label for="city_name">Cidade:</label>
                <input type="text" class="form-control" id="city_name" name="city_name" value="<?= htmlspecialchars($address['city_name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="state_name">Estado:</label>
                <select class="form-control" id="state_name" name="state_name" required>
                    <option value="">Selecione</option>
                    <option value="AC" <?= $address['state_name'] == 'AC' ? 'selected' : '' ?>>Acre</option>
                    <option value="AL" <?= $address['state_name'] == 'AL' ? 'selected' : '' ?>>Alagoas</option>
                    <option value="AP" <?= $address['state_name'] == 'AP' ? 'selected' : '' ?>>Amapá</option>
                    <option value="AM" <?= $address['state_name'] == 'AM' ? 'selected' : '' ?>>Amazonas</option>
                    <option value="BA" <?= $address['state_name'] == 'BA' ? 'selected' : '' ?>>Bahia</option>
                    <option value="CE" <?= $address['state_name'] == 'CE' ? 'selected' : '' ?>>Ceará</option>
                    <option value="DF" <?= $address['state_name'] == 'DF' ? 'selected' : '' ?>>Distrito Federal</option>
                    <option value="ES" <?= $address['state_name'] == 'ES' ? 'selected' : '' ?>>Espírito Santo</option>
                    <option value="GO" <?= $address['state_name'] == 'GO' ? 'selected' : '' ?>>Goiás</option>
                    <option value="MA" <?= $address['state_name'] == 'MA' ? 'selected' : '' ?>>Maranhão</option>
                    <option value="MT" <?= $address['state_name'] == 'MT' ? 'selected' : '' ?>>Mato Grosso</option>
                    <option value="MS" <?= $address['state_name'] == 'MS' ? 'selected' : '' ?>>Mato Grosso do Sul</option>
                    <option value="MG" <?= $address['state_name'] == 'MG' ? 'selected' : '' ?>>Minas Gerais</option>
                    <option value="PA" <?= $address['state_name'] == 'PA' ? 'selected' : '' ?>>Pará</option>
                    <option value="PB" <?= $address['state_name'] == 'PB' ? 'selected' : '' ?>>Paraíba</option>
                    <option value="PR" <?= $address['state_name'] == 'PR' ? 'selected' : '' ?>>Paraná</option>
                    <option value="PE" <?= $address['state_name'] == 'PE' ? 'selected' : '' ?>>Pernambuco</option>
                    <option value="PI" <?= $address['state_name'] == 'PI' ? 'selected' : '' ?>>Piauí</option>
                    <option value="RJ" <?= $address['state_name'] == 'RJ' ? 'selected' : '' ?>>Rio de Janeiro</option>
                    <option value="RN" <?= $address['state_name'] == 'RN' ? 'selected' : '' ?>>Rio Grande do Norte</option>
                    <option value="RS" <?= $address['state_name'] == 'RS' ? 'selected' : '' ?>>Rio Grande do Sul</option>
                    <option value="RO" <?= $address['state_name'] == 'RO' ? 'selected' : '' ?>>Rondônia</option>
                    <option value="RR" <?= $address['state_name'] == 'RR' ? 'selected' : '' ?>>Roraima</option>
                    <option value="SC" <?= $address['state_name'] == 'SC' ? 'selected' : '' ?>>Santa Catarina</option>
                    <option value="SP" <?= $address['state_name'] == 'SP' ? 'selected' : '' ?>>São Paulo</option>
                    <option value="SE" <?= $address['state_name'] == 'SE' ? 'selected' : '' ?>>Sergipe</option>
                    <option value="TO" <?= $address['state_name'] == 'TO' ? 'selected' : '' ?>>Tocantins</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="/address/list" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
