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

// mise à jour de l'expérience
if(isset($_POST['e_titre'])) {// par le nom du premier input
	$e_titre = addslashes($_POST['e_titre']);
	$e_soustitre = addslashes($_POST['e_soustitre']);
	$e_dates = addslashes($_POST['e_dates']);
	$e_description = addslashes($_POST['e_description']);
	$id_experience = $_POST['id_experience'];
	
	$pdoCV->exec(" UPDATE t_experiences SET e_titre='$e_titre', e_soustitre='$e_soustitre', e_dates='$e_dates', e_description='$e_description' WHERE id_experience='$id_experience' ");
	header('location: experiences.php');
	exit();
}

//je récupère l'expérience'
$id_experience = $_GET['id_experience'];// par l'id et $_GET
$sql = $pdoCV->query(" SELECT * FROM t_experiences WHERE id_experience='$id_experience' "); // la requête est égale à l'id
$ligne_experience = $sql->fetch();

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
    <!--CKEditor-->
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
</head>
	<body>
		<h2>Modification d'une expérience </h2>
		<!-- <?php echo $ligne_experience['t_experiences']; ?> -->
		<form action="modif_experience.php" method="post">
			<label for="e_titre">Titre</label>
			<input type="text" name="e_titre" value="<?php echo $ligne_experience['e_titre']; ?>">
			<label for="e_soustitre">Sous-Titre</label>
			<input type="text" name="e_soustitre" value="<?php echo $ligne_experience['e_soustitre']; ?>">
			<label for="e_dates">Dates</label>
			<input type="text" name="e_dates" value="<?php echo $ligne_experience['e_dates']; ?>">
			<label for="e_description">Description</label>
			<textarea name="e_description"  class="form-control" id="editor1" ><?php echo $ligne_experience['e_description']; ?></textarea> 
            <script>
                CKEDITOR.replace('editor1');
            </script>
			<input hidden name="id_experience" value="<?php echo $ligne_experience['id_experience']; ?>">
			<input type="submit" value="Mettre à jour">
		</form>
	</body>
</html>

