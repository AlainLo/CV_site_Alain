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

if(isset($_POST ['loisir'])){// insertion d'un loisir
	// si on a posté un nouveau loisir
	if ($_POST['loisir']!=''){ //si on a posté un loisir qui n'est pas vide
			$loisir= addslashes($_POST['loisir']);
            $l_description= addslashes($_POST['l_description']);
			$pdoCV->exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '1')");// mettre $id_utilisateur quand on l'aura dans la variable de session.
			header("location: loisirs.php");//pour revenir sur la page
			exit();
	} //ferme le "if n'est pas vide"
}// ferme le if(isset) du FORM

// suppression d'un loisir
if(isset($_GET ['id_loisir'])){// on récupére le loisir par son id dans l'url
$efface = $_GET['id_loisir'];
$sql = "DELETE FROM t_loisirs WHERE id_loisir = '$efface' ";
$pdoCV->query($sql);// on peut aussi utiliser exec si on le souhaite
header("location: loisirs.php"); // pour revenir sur la page
}// ferme le if(isset)
?>

<!Doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php 
		$sql = $pdoCV -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1' "); 
		$ligne_utilisateur = $sql -> fetch(PDO::FETCH_ASSOC); 
	?>
	<title> Admin : <?= $ligne_utilisateur['prenom']; ?> <?= $ligne_utilisateur['nom']; ?></title>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<!--personal css-->
	<link href="css/styleadmin.css" rel="stylesheet">

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
					$sql = $pdoCV->prepare("SELECT * FROM t_loisirs WHERE utilisateur_id='1'");
					$sql->execute();
					$nbr_loisirs = $sql->rowCount();
					//$ligne_loisir = $sql->fetch();
			?>
			<div class="row">
				    <div class="col-md-8">
						<h2> il y a <?php echo $nbr_loisirs; ?> loisirs</h2>
						<table class="table  table-hover table-condensed">
							<tr>
								<th>loisirs</th>
								<th>Suppression</th>
								<th>Modification</th>
							</tr>
							<tr>
								<?php while ($ligne_loisir = $sql->fetch()){ ?>
								<td><?php echo $ligne_loisir['loisir']; ?></td>
								<td><a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?> "><button type= "button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a></td>
								<td><a href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?> "><button type= "button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button></a></td>
								<td></td>
							</tr>
							<?php } ?>
						</table>
					</div>
					<div class="col-md-4">
						<h2> </h2>
						<table class="table  table-hover table-condensed">
						<h3>Insertion d'un loisir</h3>
						<hr>
							<div class="form-group">
								<form action="loisirs.php" method="post">
									<label for="loisir">Loisir</label>
									<input type="text" name="loisir" id="loisir" placeholder="Insérer un loisir" class="form-control">
                                    <label for="l_description">Loisir</label>
									<input type="textarea" name="l_description" id="l_description" placeholder="détailler un loisir" class="form-control">
							</div>

							<div>
									<input type="submit" value="Insérer">
								</form>
							</div>	
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

