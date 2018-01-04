<?php session_start();// à mettre dans toutes les pages de l'admin

require 'connexion.php'; 

  if(isset($_SESSION['connexion']) && $_SESSION['connexion'] =='connecté'){ // on établit que la variable de session est passée et contient bien le terme "connexion"
    $id_utilisateur=$_SESSION['id_utilisateur'];
    $prenom=$_SESSION['prenom'];
    $nom=$_SESSION['nom'];

    //echo $_SESSION['connexion'];
    //var_dump
  }else{
      //l'utilisateur n'est pas connecté 
      header('location: sauthentifier.php');
  }// ferme le else du if isset
?>
<?php 

// mise à jour du loisir
if(isset($_POST['loisir'])) {// par le nom du premier input
	$loisir = addslashes($_POST['loisir']);
	$id_loisir = $_POST['id_loisir'];
	
	$pdoCV->exec(" UPDATE t_loisirs SET loisir='$loisir', l_description='$l_description' WHERE id_loisir='$id_loisir' ");
	header('location: loisirs.php');
	exit();
}

//je récupère le loisir
$id_loisir = $_GET['id_loisir'];// par l'id et $_GET
$sql = $pdoCV->query(" SELECT * FROM t_loisirs WHERE id_loisir='$id_loisir' "); // la requête est égale à l'id
$ligne_loisir = $sql->fetch();

?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php 
		$sql = $pdoCV -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1' "); 
		$ligne_utilisateur = $sql-> fetch(); 
	?>
	<title> Admin : <?php echo $ligne_utilisateur['prenom']; ?></title>
</head>
	<body>
		<h2>Modification d'un loisir </h2>
		<!-- <?php echo $ligne_loisir['loisir']; ?> -->
		<form action="modif_loisir.php" method="post">
			<label for="loisir">Loisir</label>
			<input type="text" name="loisir" value="<?php echo $ligne_loisir['loisir']; ?>">
            <label for="l_description">Description Loisir</label>
			<input type="text" name="l_description" value="<?php echo $ligne_loisir['l_description']; ?>">
			<input hidden name="id_loisir" value="<?php echo $ligne_loisir['id_loisir']; ?>">
			<input type="submit" value="Mettre à jour">
		</form>
	</body>
</html>

