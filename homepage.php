<?php 

$host = 'localhost';
$db = 'ifoa_office';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";


$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);

$stmt = $pdo->query('SELECT * FROM users');





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: #ddd594;">
<div class="container" style="margin-block: 10rem">
    <div class="row justify-content-center">
        <div class="col-10">
            <button class="btn btn-primary mb-2">
                <a class="text-white text-decoration-none" href="./create.php">Iscriviti</a>
            </button>
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
                            <button class="btn btn-info">
                                <a class="text-white text-decoration-none" href="http://localhost/IFOA-BackEnd/Esercizio%20S1-L3/edit.php?id=<?= $row['id'] ?>">Edit</a>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger">    
                                <a class="text-white text-decoration-none" href="http://localhost/IFOA-BackEnd/Esercizio%20S1-L3/delete.php?id=<?= $row['id'] ?>">Elimina</a>
                            </button>
                        </td>
                    </tr>
                        <?php
                    }?> 
                        
            </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>