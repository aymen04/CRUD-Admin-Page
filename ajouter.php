<?php
require_once('config.php');?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="ajouter.css" rel="stylesheet">
    <title>Document</title>

</head>

<body>
<main>
      
    <form action="ajouter.php" method="post">
     <h1>Ajouter un produit</h1>

<div>

        <label for="name">Product name:</label>
        <input type="text" name="name" id="name" maxlength=100 required>
        
        <label for="price">Product price:</label>
        <input type="number" name="price" id="price"  maxlength=10 require>
       
        <label for="categorie">Product categorie:</label>
        <input type="number" name="categorie" id="categorie"  maxlength=1 require>
        
        <button type="submit" name="btadd" value="add product">Envoyer</button>
        
</div>

    </form>
</main>

    <table border="1">

        <tr>
            <td>ID</td>
            <td>Product name</td>
            <td>Product price</td>
            <td>Product categorie</td>
            <td>Supprimer</td>
        </tr>


<?php

    session_start();

    if(isset($_POST["btadd"])){
    
    
    try{

    
        $bdd1 = new PDO('mysql:host=localhost:8889;dbname=PHPPerso', "root", "root");
        $stmt1 = $bdd1->prepare("INSERT INTO `product` (`pr_name`, `pr_price`, `pr_categorie`) VALUES (:name, :price, :categorie)");
        $stmt1->bindValue(':name', $_POST["name"], PDO::PARAM_STR);
        $stmt1->bindValue(':price', $_POST["price"], PDO::PARAM_INT);
        $stmt1->bindValue(':categorie', $_POST["categorie"], PDO::PARAM_INT);
        $stmt1->execute(); }


    catch (PDOException $e) {
        echo "Connection failed : ". $e->getMessage();
      }

    
    } else {
        echo "erreur dans la requete SQL";
    }

    ?>

<?php


$dbh = new PDO('mysql:host=localhost:8889;dbname=PHPPerso', 'root', 'root');

    foreach($dbh->query("SELECT * FROM product")as $row) { ?>
        <tr>
             <td><?php echo $row['pr_id'];?></td>
             <td><?php echo $row['pr_name'];?></td>
             <td><?php echo $row['pr_price'];?></td>
             <td><?php echo $row['pr_categorie'];?></td>
             <td>

                <form action ="ajouter.php" method="post">
                    <input type ="text" name="pr_id" value="<?php echo $row['pr_id'] ?>">
                    <input type ="submit" name="delete" value="delete">

                </form>
            </td>
        </tr>


<?php } ?>


        <p><a href="admin.php" class="retour">Retour à la page MEMBRES </a></p> 

</body>
</html>

<?php

require_once('delete.php');

    if (isset($_POST['delete'])) {
        delete($_POST['pr_id'], 'product', 'pr_id');

    }else {
        echo 'nothing entered';
    }

?>


