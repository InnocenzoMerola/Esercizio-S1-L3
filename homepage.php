<?php 

include __DIR__ . '/includes/db.php';

$search = $_GET['search'] ?? '';

$stmt = $pdo->prepare('SELECT * FROM users WHERE name LIKE ?');
$stmt->execute([
    "%$search%"
]);

include __DIR__ . '/includes/initial.php'?>

    <div class="row justify-content-center">
        <div class="col-10">
            <h1 class="text-center mb-4">I nostri utenti</h1>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Età</th>
                <th scope="col">Email</th>
                <th scope="col">Professione</th>
                <th scope="col">Modifica</th>
                <th scope="col">Elimina</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stmt as $row) {?>
                    <tr>
                        <th scope="row"><?= $row["id"] ?></th>
                        <td><?= $row["name"] ?></td>
                        <td><?= $row['surname'] ?></td>
                        <td><?= $row['age'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['profession'] ?></td>
                        <td>                       
                            <a class="btn btn-info" class="text-white text-decoration-none" href="/IFOA-BackEnd/Esercizio%20S1-L3/edit.php?id=<?= $row['id'] ?>">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" class="text-white text-decoration-none" href="/IFOA-BackEnd/Esercizio%20S1-L3/delete.php?id=<?= $row['id'] ?>">Elimina</a>  
                        </td>
                    </tr>
                        <?php
                    }?> 
                        
            </tbody>
            </table>
        </div>
    </div>
<?php 
include __DIR__ . '/includes/end.php';