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


// echo '<ul>';
// foreach ($stmt as $row)
// {
//     echo "<li>$row[name]</li>
//     <div class=container mt-5>
//     <div class=row justify-content-center>
//         <div class=col-10>
//             <button>
//                 <a href=./create.php>Iscriviti</a>
//             </button>
//     <table class=table>
//             <thead>
//                 <tr>
//                 <th scope=col>#</th>
//                 <th scope=col>Nome</th>
//                 <th scope=col>Cognome</th>
//                 <th scope=col>Età</th>
//                 <th scope=col>Email</th>

//                 <th scope=col>Professione</th>
//                 </tr>
//             </thead>
//             <tbody>
//                 <tr>
                    
        
//                 <th scope=row>$row[id] </th>
//                 <td>$row[name] </td>
//                 <td>$row[surname] </td>
//                 <td>$row[age] </td>
//                 <td>$row[email] </td>
               
//                 <td>$row[profession] </td>
//                 <td><button class=btn btn-info>
//                 <a href=>Edit</a>
//             </button></td>
//             <td><button class=btn btn-danger>
//                 <a href=>Elimina</a>
//             </button></td>

//                 </tr>
//             </tbody>
//             </table>
//             </div>
//             </div>
//         </div>
//     ";
// }
// echo '</ul>';

// $id = 1;
// $id = $_GET['id'];
// $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
// $stmt->execute([$id]);
// $row = $stmt->fetch(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-10">
            <button>
                <a href="./create.php">Iscriviti</a>
            </button>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Email</th>
                <th scope="col">Professione</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($stmt as $row) {?>
                        <th scope="row"><?= $row["id"] ?></th>
                        <td><?= $row["name"] ?></td>
                        <td><?= $row['surname'] ?></td>
                        <td><?= $row['age'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['profession'] ?></td>
                        <?php
                    }?> 
                    <td><button class="btn btn-info">
                            <a href="">Edit</a>
                        </button></td>
                        <td><button class="btn btn-danger">
                            <a href="">Elimina</a>
                        </button></td>

                </tr>
            </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>