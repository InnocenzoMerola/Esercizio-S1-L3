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

// $stmt = $pdo->query('SELECT * FROM users');


echo '<pre>' . print_r($_POST, true) . '</pre>';

$name = $_POST['name'] ?? "";
$surname = $_POST['surname'] ?? "";
$email = $_POST['email'] ?? "";
$age = $_POST['age'] ?? "";
$profession = $_POST['profession'] ?? "";


if($_SERVER['REQUEST_METHOD'] === 'POST'){


    $errors = [];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'Email non valida';
    }

    if(strlen($name) < 5 || strlen($name) > 15){
        $errors['username'] = "Il nome utente deve contenere dalle 5 alle 15 lettere";
    }
    


    if($age === ""){
        $errors['age'] = "Aggiungere l'età";
    }



    if($errors === []){
        $stmt = $pdo->prepare("INSERT INTO users (name, surname, age, email, profession) VALUES (:name; :surname, :age, :email, :profession)");
        $stmt->execute([
            'name' => $name,
            'surname' => $surname,
            'age' => $age,
            'email' => $email,
            'profession' => $profession,
        ]);
            
    };
}


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
    <label for="username" class="form-label">Nome</label>
    <input type="text" value="<?php echo $name;?>" name="username" class="form-control <?= isset($errors['username']) ? 'is-invalid' : ''?>" id="username" >
    <?= $errors['username'] ?? "" ?>
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
    <button class="btn btn-primary" type="submit">Crea il tuo profilo</button>

    </div>
</div>
</form>
</div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>