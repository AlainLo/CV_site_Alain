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

// mise à jour du réseau
if(isset($_POST['reseau'])) {// par le nom du premier input
	$rs_logo = addslashes($_POST['rs_logo']);
	$rs_lien = addslashes($_POST['rs_lien']);
	$reseau_id = $_POST['reseau_id'];
	
	$pdoCV->exec(" UPDATE t_reseaux SET rs_logo='$rs_logo', rs_lien='$rs_lien' WHERE reseau_id ='$reseau_id' ");
	header('location: reseaux.php');
	exit();
}

//je récupère le réseau
$reseau_id = $_GET['reseau_id'];// par l'id et $_GET
$sql = $pdoCV->query(" SELECT * FROM t_reseaux WHERE reseau_id='$reseau_id' "); // la requête est égale à l'id
$ligne_reseau = $sql->fetch();

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
		<h2>Modification d'un réseau </h2>
		<!-- <?php echo $ligne_reseau['reseau']; ?> -->
		<div class="form-group">
			<form action="modif_reseau.php" method="post" class="form-horizontal">
				<label class= "control-label col-sm-2" for="rs_logo">Logo</label>
				<input type="text" name="rs_logo" value="<?php echo $ligne_reseau['rs_logo']; ?>">
				<label class= "control-label col-sm-2" for="lien">Lien</label>
				<input type="number" name="rs_lien" value="<?php echo $ligne_reseau['rs_lien']; ?>">
				<input hidden name="reseau_id" value="<?php echo $ligne_reseau['reseau_id']; ?>">
				<input type="submit" value="Mettre à jour">
			</form>
		</div>
		
	</body>
</html>

