<?php 
include __DIR__ . '/includes/db.php';

$search = $_GET['search'] ?? '';

$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 5;
$limit = $limit > 10 ? 2 : $limit;
$offset = ($page - 1) * $limit;

$stmt = $pdo->prepare('SELECT * FROM users WHERE name LIKE :search LIMIT :limit OFFSET :offset');
$stmt->execute([
   'search' => "%$search%",
   'offset' => $offset,
   'limit' => $limit,
]);
$utenti = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT COUNT(*) as num_users FROM users users WHERE name LIKE :search ');
$stmt->execute([
    'search' => "%$search%",
]);
$num_users = $stmt->fetch()['num_users'];
$tot_pages = ceil($num_users / $limit);


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
                <?php foreach ($utenti as $row) {?>
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
        
             <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page == $i ? 'active' : ''?>">
                    <a class="page-link" href="/IFOA-BackEnd/Esercizio%20S1-L3/homepage.php?page=<?= $page-1 ?><?=$search ? "&search=$search" : '' ?>">Previous</a>
                </li>
                   <?php
                        for ($i=1; $i <= $tot_pages; $i++) {?> 
                            <li class="page-item"><a class="page-link" href="/IFOA-BackEnd/Esercizio%20S1-L3/homepage.php?page=<?= $i ?><?=$search ? "&search=$search" : '' ?>"><?= $i ?></a></li><?php
                        }
                   ?>

                    <li class="page-item <?= $page == $tot_pages ? 'active' : ''?>">
                        <a class="page-link" href="/IFOA-BackEnd/Esercizio%20S1-L3/homepage.php?page=<?= $page+1 ?><?=$search ? "&search=$search" : '' ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
<?php 
include __DIR__ . '/includes/end.php';