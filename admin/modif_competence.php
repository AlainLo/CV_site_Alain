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

// mise à jour de la compétence
if(isset($_POST['competence'])) {// par le nom du premier input
	$competence = addslashes($_POST['competence']);
	$c_niveau = addslashes($_POST['c_niveau']);
	$id_competence = $_POST['id_competence'];
	
	$pdoCV->exec(" UPDATE t_competences SET competence='$competence', c_niveau='$c_niveau' WHERE id_competence='$id_competence' ");
	header('location: competences.php');
	exit();
}

//je récupère la compétence
$id_competence = $_GET['id_competence'];// par l'id et $_GET
$sql = $pdoCV->query(" SELECT * FROM t_competences WHERE id_competence='$id_competence' "); // la requête est égale à l'id
$ligne_competence = $sql->fetch();

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
		<h2>Modification d'une compétence </h2>
		<!-- <?php echo $ligne_competence['competence']; ?> -->
		<div class="form-group">
			<form action="modif_competence.php" method="post" class="form-horizontal">
				<label class= "control-label col-sm-2" for="competence">Compétence</label>
				<input type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>">
				<label class= "control-label col-sm-2" for="niveau">Niveau</label>
				<input type="number" name="c_niveau" value="<?php echo $ligne_competence['c_niveau']; ?>">
				<input hidden name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
				<input type="submit" value="Mettre à jour">
			</form>
		</div>
		
	</body>
</html>

