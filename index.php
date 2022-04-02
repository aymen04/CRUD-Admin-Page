<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet">
</head>
<form method="post">
<label>Search</label>
<input type="text" name="search">
<input type="submit" name="submit2">
	
</form>

<header>

        <form method='post' action="index.php">
            <input type="submit" value="Logout" name="but_logout">
        </form>

</header>
    
        
        
  
<body>

<?php


if(!isset($_SESSION['username'])){
    echo"Bienvenue";
}


if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: login.php');
}

try{ 
        $bdd1 = new PDO('mysql:host=localhost:8889;dbname=PHPPerso', "root", "root"); ?>
   
        <table class="forproduct">
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Categorie</th>
        <th>Acheter</th>
 <?php


foreach($bdd1->query(("SELECT * FROM `categorie` INNER JOIN `product` ON `categorie`.`ca_id` = `product`.`pr_categorie`")) as $row){ ?>

    <tr>
        <td><?php echo $row['pr_id'];?></td>
        <td><?php echo $row['pr_name'];?></td>
        <td><?php echo $row['pr_price'];?></td>
        <td><?php echo $row['pr_categorie'];?></td>
         
    </tr>
   
<?php } ?>
</table>


<?php
    
    $bdd1 = null;

}   catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>

</body>
</html>

<?php

$con = new PDO("mysql:host=localhost:8889;dbname=PHPPerso",'root','root');

if (isset($_POST["submit2"])) {
	$str = $_POST["search"];
	$sth = $con->prepare("SELECT * FROM `product` WHERE pr_name = '$str'");

	$sth->setFetchMode(PDO:: FETCH_OBJ);
	$sth -> execute();

	if($row = $sth->fetch())
	{
		?>
		<br><br><br>
		<table>
			<tr>
				<th>Name</th>
				<th>Price</th>
			</tr>
			<tr>
				<td><?php echo $row['pr_name']; ?></td>
				<td><?php echo $row['pr_price'];?></td>
			</tr>

		</table>
<?php 
	}
		
		
		else{
			echo "Name Does not exist";
		}


}

?>