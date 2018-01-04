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
// gestion des contenus de la BDD

if(!empty($_POST)){// insertion d'un titre
	// si on a posté une nouveau titre
	if ($_POST['titre_cv']!='' && $_POST['accroche']!='' && $_POST['logo']!='' ){ //si on a posté une expérience qui n'est pas vide
			$titre_cv= addslashes($_POST['titre_cv']);
			$accroche= addslashes($_POST['accroche']);
			$logo= addslashes($_POST['logo']);
			$pdoCV->exec(" INSERT INTO t_titre_cv VALUES (NULL, '$titre_cv', '$accroche', '$logo','1')");// mettre $id_utilisateur quand on l'aura dans la variable de session.
		//	header("location: titre.php");//pour revenir sur la page
		//	exit();
	} //ferme le "if n'est pas vide"
}// ferme le if(isset) du FORM

// suppression d'un titre
if(isset($_GET ['id_titre_cv'])){// on récupére l'expérience par son id dans l'url
$efface = $_GET['id_titre_cv'];
$sql = "DELETE FROM t_titre_cv WHERE id_titre_cv = '$efface' ";
$pdoCV->query($sql);// on peut aussi utiliser exec si on le souhaite
header("location: titre.php"); // pour revenir sur la page
}// ferme le if(isset)
?>

<!Doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php 
		$sql = $pdoCV -> query("SELECT * FROM t_titre_cv WHERE id_titre_cv = '1' "); 
		$ligne_utilisateur = $sql -> fetch(PDO::FETCH_ASSOC); 
	?>
	<title> Admin : <?= $ligne_titre_cv['prenom']; ?> <?= $ligne_titre_cv['nom']; ?></title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<!--personal css-->
	<link href="css/styleadmin.css" rel="stylesheet">
     <!--CKEditor-->
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>

</head>
<html>
	<body>
		<!--nav en include -->
		<?php include('inc/navbar.php');?>
	<section>
      	<div class="container">
		<h1>Admin du site cv de <?php echo($ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom']); ?></h1>
		<!--<p>texte</p>-->
		<hr>
			<?php
					$sql = $pdoCV->prepare("SELECT * FROM t_titre_cv WHERE utilisateur_id='1'");
					$sql->execute();
					$nbr_titre_cv = $sql->rowCount();
					//$ligne_experience = $sql->fetch();
			?>
			<div class="row">
				<h2> il y a <?php echo $nbr_titre; ?> titres </h2>
			    <div class="col-md-8">
					<table class="table  table-hover  table-condensed">
						<tr>
							<th>titre</th>
							<th>accroche</th>
							<th>logo</th>	
							<th>Supression</th>
							<th>Modification</th>
						</tr>
						<tr>
							<?php while ($ligne_titre_cv = $sql->fetch()){ ?>
							<td><?php echo $ligne_titre_cv['titre_cv']; ?></td>
							<td><?php echo $ligne_titre_cv['accroche']; ?></td>
							<td><?php echo $ligne_titre_cv['logo']; ?></td>
							<td><a href="titre.php?id_titre_cv=<?php echo $ligne_titre_cv['id_titre_cv']; ?> "><button type= "button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a></td>
							<td><a href="modif_titre.php?id_experience=<?php echo $ligne_titre_cv['id_titre_cv']; ?> "><button type= "button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button></a></td>
							<td></td>
						</tr>
						<?php } ?>
					</table>
				</div>
				<div class="col-md-4">
					<h2></h2>
					<table class="table  table-hover  table-condensed">
						<h3>Insertion d'un titre</h3>
						<hr>
                            <form action="titre.php" method="post">
                                <div class="form-group">
									<label for="titre">Titre</label>
									<input type="text" name="titre" id="titre" placeholder="Insérer un titre" class="form-control">
                                </div>
							
							    <div class="form-group">
									   <label for="soustitre">Accroche</label>
									   <input type="text" name="accroche" id="accroche" placeholder="Insérer une accroche" class="form-control">
							    </div>

							    <div class="form-group">
									<label for="logo">Logo</label>
									<input type="text" name="logo" id="logo" placeholder="Insérer un logo" class="form-control">
							    </div>
                           
                                <script>
                                    CKEDITOR.replace('editor1');
                                </script>

							    <div>
									<input type="submit" value="Insérer">
							    </div>
                            </form>
					</table>	
				</div>
			</div>
		</div>
	</section>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
		<?php include('inc/footer.php');?>   
	</body>
</html>

