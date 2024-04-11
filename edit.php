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


// $id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_GET['id']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);


echo '<pre>' . print_r($_POST, true) . '</pre>';


$name = $row['name'] ?? "";
$surname = $row['surname'] ?? "";
$email = $row['email'] ?? "";
$age = $row['age'] ?? "";
$profession = $row['profession'] ?? "";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errors = [];
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'Email non valida';
    }

    if(strlen($name) < 2 || strlen($name) > 20){
        $errors['name'] = "Il nome utente deve contenere dalle 5 alle 15 lettere";
    }

    if($age === ""){
        $errors['age'] = "Aggiungere l'età";
    }
    
    if($errors === []){
        $stmt = $pdo->prepare("UPDATE users SET name = :name, surname = :surname, age = :age, email = :email, profession = :profession WHERE id = :id");
        $stmt->execute([
            'id' => $_GET['id'],
            'name' => $name,
            'surname' => $surname,
            'age' => $age,
            'email' => $email,
            'profession' => $profession,
        ]);
    }
    
    print_r($errors);
        
    };
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: #ddd594;">
    
<div class="container" style="margin-block: 10rem">
  <div class="row justify-content-center">
    <div class="col-5">
        <form action="" method="post" novalidate>
            <div class="row row-gap-2">
        <div class="col-12">
            <label for="name" class="form-label">Nome</label>
            <input type="text" value="<?php echo $name;?>" name="name" class="form-control <?= isset($errors['name']) ? 'is-invalid' : ''?>" id="name" >
            <?= $errors['name'] ?? "" ?>
        </div>

        <div class="col-12">
            <label for="surname" class="form-label">Cognome</label>
            <input type="text" value="<?php echo $surname;?>" name="surname" class="form-control <?= isset($errors['surname']) ? 'is-invalid' : ''?>" id="surname" >
            <?= $errors['surname'] ?? "" ?>
        </div>
        
        <div class="col-12">
            <label for="age" class="form-label">Età</label>
            <input type="number" name="age" value="<?php echo $age;?>" class="form-control <?= isset($errors['age']) ? 'is-invalid' : ''  ?>" id="age" aria-describedby="validationServer03Feedback" >
            <?= $errors['age'] ?? '' ?>
        </div>

        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" value="<?php echo $email;?>" class="form-control <?= isset($errors['email']) ? 'is-invalid' : "" ?>" id="email" >
            <?= $errors['email'] ?? ""?>
        </div>
        
        
        <div class="col-12">
            <label for="profession" class="form-label">Professione</label>
            <input type="text" value="<?php echo $profession;?>" name="profession" class="form-control <?= isset($errors['profession']) ? 'is-invalid' : ''?>" id="profession" >
            <?= $errors['profession'] ?? "" ?>
        </div>
        
        <div class="col-12 mt-3">
            <button class="btn btn-primary" type="submit">
            Modifica il tuo profilo
            </button>

            </div>
        </div>
        </form>     
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>