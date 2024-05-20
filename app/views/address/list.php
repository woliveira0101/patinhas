<?php include __DIR__ . '/../include/header.php'; ?>

<div class="main-content">
    <div class="container">
        <h1>Meus Endereços</h1>
        <a href="/address/registration" class="btn btn-success mb-3">Adicionar Novo Endereço</a>
        <?php if (!empty($addresses)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>CEP</th>
                        <th>Rua</th>
                        <th>Número</th>
                        <th>Complemento</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($addresses as $address): ?>
                        <tr>
                            <td><?= htmlspecialchars($address['zip_code']) ?></td>
                            <td><?= htmlspecialchars($address['street_name']) ?></td>
                            <td><?= htmlspecialchars($address['address_number']) ?></td>
                            <td><?= htmlspecialchars($address['address_complement']) ?></td>
                            <td><?= htmlspecialchars($address['neighboorhood']) ?></td>
                            <td><?= htmlspecialchars($address['city_name']) ?></td>
                            <td><?= htmlspecialchars($address['state_name']) ?></td>
                            <td>
                                <a href="/address/edit/<?= $address['address_id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <form action="/address/delete/<?= $address['address_id'] ?>" method="post" style="display:inline-block" onsubmit="return confirm('Tem certeza que deseja excluir este endereço?');">
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Você ainda não cadastrou nenhum endereço.</p>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../include/footer.php'; ?>
