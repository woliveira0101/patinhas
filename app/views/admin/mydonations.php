<?php include __DIR__ . '/../include/header.php'; ?>

<!-- Flash Messages -->
<?php if ($flashMessage = $this->getFlash('success')): ?>
    <div class="alert alert-success"><?= htmlspecialchars($flashMessage) ?></div>
<?php elseif ($flashMessage = $this->getFlash('error')): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($flashMessage) ?></div>
<?php endif; ?>
<div class="main-content">
<section class="container">
    <div class="row">
        <div class="col-8 col-md-10 mt-2 mb-3 mx-auto py-3 px-md-5">
            <h1 class="fw-bolded fs-3 text-warning text-center">MINHAS DOAÇÕES</h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Data do Cadastro</th>
                        <th>Nome do Animal</th>
                        <th>Tipo de Animal</th>
                        <th>Raça do Animal</th>
                        <th>Status do Pedido de Adoção</th>
                        <th>Ver Pedidos de Adoção</th>
                        <th>Excluir Doação</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($donations as $donation): ?>
                    <tr>
                        <td><?= htmlspecialchars($donation['donation_date']) ?></td>
                        <td><a href="animal_detalhes.html" class="text-dark" target="_blank"><?= htmlspecialchars($donation['pet_name']) ?></a></td>
                        <td><?= htmlspecialchars($donation['type']) ?></td>
                        <td><?= htmlspecialchars($donation['breed']) ?></td>
                        <td><?= htmlspecialchars($donation['status'] ?? 'Em análise') ?></td>
                        <td><a type="button" class="btn btn-warning text-dark btn-sm" href="visualiza_ped_adocao.html">Ver Pedidos</a></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteDonation(<?= $donation['donation_id'] ?>)">Excluir</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
</div>
<?php include __DIR__ . '/../include/footer.php'; ?>

<script>
function deleteDonation(donationId) {
    if (confirm('Você tem certeza que deseja excluir esta doação?')) {
        fetch('/donation/delete/' + donationId, {
            method: 'DELETE'
        }).then(response => {
            if (response.ok) {
                window.location.reload();
            } else {
                response.json().then(data => {
                    alert('Erro ao excluir a doação: ' + data.status);
                });
            }
        }).catch(error => {
            alert('Erro ao excluir a doação: ' + error);
        });
    }
}
</script>
