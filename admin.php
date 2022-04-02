<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="admin.css" rel="stylesheet">
    <title>Admin</title> 
</head>
<body>

     <p>Utilisateurs enregistrés<p>


<table border="1">
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Email</td>
            <td>Date de création</td>
            <td>Supprimer</td>
        </tr>


<?php

$dbh = new PDO('mysql:host=localhost:8889;dbname=PHPPerso', 'root', 'root');

    foreach($dbh->query("SELECT * FROM user")as $row) { ?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['today'];?></td>

            <td>
            <form action ="admin.php" method="post">
                <input type ="hidden" name="id" value="<?php echo $row['id'] ?>">
                <input type ="hidden" name="what" value="user">
                <input type ="submit" name="delete" value="delete">
            </form>
            </td>

         </tr>


<?php } ?>
</table>

<br>
<br>


<main>
<h1>Ajouter un membre</h1>

         <form action="admin.php" method="post">
       
    <div>
            <label for="username">Name:</label>
            <input type="text" name="username" id="username" minlength=3 maxlength=10 require>
       
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" minlength=3 maxlength=10 require>
       
            <label for="password2">Password Confirmation:</label>
            <input type="password" name="password2" id="password_confirm" minlength=3 maxlength=10 require>
        
        
            <input type="submit" name="ajouter"></input>
    </div>
</main>

    <p><a href="ajouter.php" class="go-addproduct">Gérer les produits</a></p>
    <p><a href="index.php" class="go-homepage">Se diriger vers la page d'acceuil</a></p>

    
</body>
</html>



<?php

require_once('delete.php');
          
         //On récupère les valeurs entrées par l'utilisateur :
            $username=$_POST['username'];
            $email=$_POST['email'];
            $password=$_POST['password'];
         //On construit la date d'aujourd'hui
            $today = date("y-m-d");
            $db = new PDO('mysql:host=localhost:8889;dbname=PHPPerso', 'root', 'root'); 
         //On se connecte


if (isset($_POST['ajouter'])) {
           

try{
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

}else if (isset($_POST['delete'])) {
                delete($_POST['id'], 'user', 'id');
                
}else {
                echo "No input value is entered";
            }
 
                  
?>
        