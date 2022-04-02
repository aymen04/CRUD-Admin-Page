<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="inscription.css" rel="stylesheet">
    <title>Sign in</title>
</head>


<body>

<main>

<form action="inscription.php" method="post">

     <h1>Sign Up</h1>

     <div>
        <label for="username">Name:</label>
        <input type="text" name="username" id="username" minlength=3 maxlength=10 required>
    </div>

     <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
     </div>

     <div>
        <label for="password">Password:</label>
         <input type="password" name="password" id="password" minlength=6 maxlength=15 required>
     </div>

    <div>
        <label for="password2">Password Confirmation:</label>
        <input type="password" name="password2" id="password_confirm" minlength=6 maxlength=15 required>
    </div>
        
        <button type="submit" name="ajouter">Envoyer</button>
    </main>
</form>


        <p>Déja membre ? <a href="login.php">Connectez-vous</a></p>
 
</body>
</html>      

<?php
        
          
            //On récupère les valeurs entrées par l'utilisateur :
            $username=$_POST['username'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            //On construit la date d'aujourd'hui
            //strictement comme sql la construit
            $today = date("y-m-d");
            //On se connecte
            try{

                $db = new PDO('mysql:host=localhost:8889;dbname=PHPPerso', 'root', 'root'); 
                $sql = $db->prepare('INSERT INTO user(name, email, password,type,today) VALUES(:username, :email, :password,"Utilisateur", :today)'); 
                $sql->execute(array(
                    "username"=>$_POST['username'],
                    "email"=>$_POST['email'],
                    "password"=>$password,
                    "today"=>date("y-m-d")));
                  

            }
            catch(PDOException $e){
                 $e->getMessage();
            }
 
          
 
            // on ferme la connexion
            mysql_close();
        
        ?>