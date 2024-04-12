<?php

include __DIR__ . '/includes/db.php';



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

    if(strlen($name) < 2 || strlen($name) > 20){
        $errors['name'] = "Il nome utente deve contenere dalle 5 alle 15 lettere";
    }
    
    if($age === ""){
        $errors['age'] = "Aggiungere l'età";
    }

    if($errors === []){
        $stmt = $pdo->prepare("INSERT INTO users (name, surname, age, email, profession) VALUES (:name, :surname, :age, :email, :profession)");
        $stmt->execute([
            'name' => $name,
            'surname' => $surname,
            'age' => $age,
            'email' => $email,
            'profession' => $profession,
        ]);
           
        header("Location: /IFOA-BackEnd/Esercizio%20S1-L3/homepage.php");
        exit();
    };
    

}

include __DIR__ . '/includes/initial.php'?>


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
                Crea il tuo profilo  
            </button>
          </div>
        </div>
      </form> 
    </div>
  </div>
</div>
<?php 
include __DIR__ . '/includes/end.php';