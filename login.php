<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="login.css" rel="stylesheet">
</head>
<body>
<form method="post">
  <table class="loginTable">
     <tr>
      <th> LOGIN</th>
     </tr>
     <tr>
      <td>
        <label class="firstLabel">Username:</label>
        <input type="text" name="username" id="username"   />
      </td>
     </tr>
     <tr>
      <td><label>Password:</label>
        <input type="password" name="password" id="password"  /></td>
     </tr>
     <tr>
      <td>
         <input type="submit" name="submitBtnLogin" id="submitBtnLogin" value="Login" />
         <span class="loginMsg"><?php echo @$msg;?></span>
      </td>
     </tr>
  </table>
</form>
<p>Vous etes pas membre ?<a href="inscription.php">Inscrivez-vous</a></p>
</body>

</html>
<?php 
session_start();
include("config.php");
?>


<?php
if($_POST){
        $name = $_POST["username"];
try{
        $connect_db = new PDO('mysql:host=localhost:8889;dbname=PHPPerso', 'root', 'root');
        $requete_name = $connect_db->prepare('SELECT * FROM user WHERE name=?');
        $requete_name->execute([$_POST['username']]);
        $result_name = $requete_name->fetch();
        echo $result_name;

        $requete_password = $connect_db->prepare('SELECT * FROM user WHERE password=?');
        $requete_password->execute([$_POST['password']]);
        $result_password = $requete_password->fetch();
if($result_name && $result_password){
        
}else{ echo"Identifiant ou mot de passe incorrect";
 die();
        }

if ($result_name['type'] == 'admin') {
         header('location: admin.php');      
 }else{
        header('location: index.php');
         }
    
        

 }catch(PDOException $e){
        $e->getMessage();
    }
}
?>

