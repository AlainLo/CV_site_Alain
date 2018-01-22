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
if(isset($_POST['titre_cv'])) {// par le nom du premier input
	$titre_cv = addslashes($_POST['titre_cv']);
	$accroche = addslashes($_POST['accroche']);
	$logo = addslashes($_POST['logo']);
	$id_titre_cv = $_POST['id_titre_cv'];
	
	$pdoCV->exec(" UPDATE t_titre_cv SET titre_cv='$titre_cv', accroche='$accroche', logo='$logo' WHERE id_titre_cv='$id_titre_cv' ");
	header('location: titre.php');
	exit();
}

//je récupère le titre
$id_titre_cv = $_GET['id_titre_cv'];// par l'id et $_GET
$sql = $pdoCV->query(" SELECT * FROM t_titre_cv WHERE id_titre_cv='$id_titre_cv' "); // la requête est égale à l'id
$ligne_titre_cv = $sql->fetch();

?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php 
		$sql = $pdoCV -> query("SELECT * FROM t_titre_cv WHERE id_utilisateur = '1' "); 
		$ligne_utilisateur = $sql-> fetch(); 
	?>
	<title> Admin : <?php echo $ligne_utilisateur['prenom']; ?></title>
    <!--CKEditor-->
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
</head>
	<body>
		<h2>Modification d'un titre </h2>
		<!-- <?php echo $ligne_titre_cv['t_titre_cv']; ?> -->
		<form action="modif_titre_cv.php" method="post">
			<label for="titre_cv">Titre</label>
			<input type="text" name="titre" value="<?php echo $ligne_titre_cv['titre']; ?>">
			<label for="accroche">Accroche</label>
            <textarea name="accroche"  class="form-control" id="editor1">
                <?php echo $ligne_titre_cv['accroche']; ?></textarea>
			<label for="logo">Logo</label>
			<input type="text" name="logo" value="<?php echo $ligne_titre_cv['logo']; ?>">
            <script>
                CKEDITOR.replace('editor1');
            </script>
			<input hidden name="id_titre_cv" value="<?php echo $ligne_titre_cv['id_titre_cv']; ?>">
			<input type="submit" value="Mettre à jour">
		</form>
	</body>
</html>

