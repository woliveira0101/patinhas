<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Pets</title>
</head>
<body>
    <h1>Listagem de Pets</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Idade</th>
                <th>Sexo</th>
                <th>Raça</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pets as $pet): ?>
                <tr>
                    <td><?= $pet['pet_name']; ?></td>
                    <td><?= $pet['type']; ?></td>
                    <td><?= $pet['age']; ?></td>
                    <td><?= $pet['gender']; ?></td>
                    <td><?= $pet['breed']; ?></td>
                    <td>
                        <a href="/pets/show/<?= $pet['pet_id']; ?>">Detalhes</a>
                        <a href="/pets/edit/<?= $pet['pet_id']; ?>">Atualizar</a>
                        <a href="/pets/delete/<?= $pet['pet_id']; ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>