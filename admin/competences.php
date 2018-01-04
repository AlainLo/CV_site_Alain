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

if(isset($_POST ['competence'])){// insertion d'une compétence
	// si on a posté une nouvelle compétence
	if ($_POST['competence']!='' && $_POST['c_niveau']!=''){ //si on a posté une compétence qui n'est pas vide
			$competence= addslashes($_POST['competence']);
			$c_niveau= addslashes($_POST['c_niveau']);
			$pdoCV->exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$c_niveau', '1')");// mettre $id_utilisateur quand on l'aura dans la variable de session.
			header("location: competences.php");//pour revenir sur la page
			exit();
	} //ferme le "if n'est pas vide"
}// ferme le if(isset) du FORM

// suppression d'une compétence
if(isset($_GET ['id_competence'])){// on récupére la compétence par son id dans l'url
$efface = $_GET['id_competence'];
$sql = "DELETE FROM t_competences WHERE id_competence = '$efface' ";
$pdoCV->query($sql);// on peut aussi utiliser exec si on le souhaite
header("location: competences.php"); // pour revenir sur la page
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
						$sql = $pdoCV->prepare("SELECT * FROM t_competences WHERE utilisateur_id='1'");
						$sql->execute();
						$nbr_competences = $sql->rowCount();
						//$ligne_competence = $sql->fetch();
				?>
				<div class="row">
		        	<div class="col-md-8">
						<h2> il y a <?php echo $nbr_competences; ?> compétences</h2>
						<table class="table table-hover table-condensed">
							<tr>
								<th>Compétences</th>
								<th>Niveau</th>
								<th>Suppression</th>
								<th>Modification</th>
							</tr>
							<tr>
								<?php while ($ligne_competence = $sql->fetch()){ ?>
								<td><?php echo $ligne_competence['competence']; ?></td>
								<td><?php echo $ligne_competence['c_niveau']; ?></td>
								<td><a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?> "><button type= "button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a></td>
								<td><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?> "><button type= "button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button></a></td>
								<td></td>
							</tr>
							<?php } ?>
						</table>
					</div>
					<div class="col-md-4">
						<h2></h2>
		    			<table class="table table-hover table-condensed">
							<h3>Insertion d'une compétence</h3>
							<hr>
                            <form action="competences.php" method="post">
							    <div class="form-group">
									<label for="competence">Compétence</label>
									<input type="text" name="competence" id="competence" placeholder="Insérer une compétence" class="form-control">
							    </div>

							    <div class="form-group">
									<label for="niveau">Niveau</label>
									<input type="text" name="c_niveau" id="c_niveau" placeholder="Insérer le niveau" class="form-control">
							    </div>
                                
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

