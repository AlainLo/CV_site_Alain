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

// mise à jour du plus
if(isset($_POST['p_titre'])) {// par le nom du premier input
	$p_titre = addslashes($_POST['p_titre']);
	$p_soustitre = addslashes($_POST['p_soustitre']);
	$p_dates = addslashes($_POST['p_dates']);
	$p_description = addslashes($_POST['p_description']);
	$id_plus = $_POST['id_plus'];
	
	$pdoCV->exec(" UPDATE t_plus SET p_titre='$p_titre', p_soustitre='$p_soustitre', p_dates='$p_dates', p_description='$p_description' WHERE id_plus='$id_plus' ");
	header('location: plus.php');
	exit();
}

//je récupère le plus
$id_plus = $_GET['id_plus'];// par l'id et $_GET
$sql = $pdoCV->query(" SELECT * FROM t_plus WHERE id_plus='$id_plus' "); // la requête est égale à l'id
$ligne_plus = $sql->fetch();

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
		<h2>Modification d'un plus </h2>
		<!-- <?php echo $ligne_plus['t_plus']; ?> -->
		<form action="modif_plus.php" method="post">
			<label for="p_titre">Titre</label>
			<input type="text" name="p_titre" value="<?php echo $ligne_plus['p_titre']; ?>">
			<label for="p_soustitre">Sous-Titre</label>
			<input type="text" name="p_soustitre" value="<?php echo $ligne_plus['p_soustitre']; ?>">
			<label for="p_dates">Dates</label>
			<input type="text" name="p_dates" value="<?php echo $ligne_plus['p_dates']; ?>">
			<label for="p_description">Description</label>
			<textarea name="p_description"  class="form-control" id="editor1" ><?php echo $ligne_plus['p_description']; ?></textarea> 
            <script>
                CKEDITOR.replace('editor1');
            </script>
			<input hidden name="id_plus" value="<?php echo $ligne_plus['id_plus']; ?>">
			<input type="submit" value="Mettre à jour">
		</form>
	</body>
</html>

