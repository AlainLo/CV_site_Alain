 <?php session_start();// à mettre dans toutes les pages de l'admin

require 'connexion.php'; 

if( isset($_POST) ) {
    echo 'C\'est post !';
    var_dump($_POST);
}
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

if(isset($_POST ['reseau'])){// insertion d'un réseau
	// si on a posté une nouveau réseau
	if ($_POST['rs_logo']!='' && $_POST['rs_lien']!=''){ //si on a posté un réseau qui n'est pas vide
			$rs_logo= addslashes($_POST['rs_logo']);
			$rs_lien= addslashes($_POST['rs_lien']);
			$pdoCV->exec(" INSERT INTO t_reseaux VALUES (NULL, '$rs_logo', '$rs_lien', '1')");// mettre $id_utilisateur quand on l'aura dans la variable de session.
			header("location: reseaux.php");//pour revenir sur la page
			exit();
	} //ferme le "if n'est pas vide"
}// ferme le if(isset) du FORM

// suppression d'un réseau
if(isset($_GET ['reseau_id'])){// on récupére le réseau par son id dans l'url
$efface = $_GET['reseau_id'];
$sql = "DELETE FROM t_reseaux WHERE reseau_id = '$efface' ";
$pdoCV->query($sql);// on peut aussi utiliser exec si on le souhaite
header("location: reseaux.php"); // pour revenir sur la page
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
						$sql = $pdoCV->prepare("SELECT * FROM t_reseaux WHERE utilisateur_id='1'");
						$sql->execute();
						$nbr_reseaux = $sql->rowCount();
						//$ligne_reseau = $sql->fetch();
				?>
				<div class="row">
		        	<div class="col-md-8">
						<h2> il y a <?php echo $nbr_reseaux; ?> réseaux</h2>
						<table class="table table-hover table-condensed">
							<tr>
								<th>Logo</th>
								<th>Lien</th>
								<th>Suppression</th>
								<th>Modification</th>
							</tr>
							<tr>
								<?php while ($ligne_reseau = $sql->fetch()){ ?>
								<td><?php echo $ligne_reseau['rs_logo']; ?></td>
								<td><?php echo $ligne_reseau['rs_lien']; ?></td>
								<td><a href="reseaux.php?reseau_id=<?php echo $ligne_reseau['reseau_id']; ?> "><button type= "button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a></td>
								<td><a href="modif_reseau.php?reseau_id=<?php echo $ligne_reseau['reseau_id']; ?> "><button type= "button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button></a></td>
								<td></td>
							</tr>
							<?php } ?>
						</table>
					</div>
					<div class="col-md-4">
						<h2></h2>
		    			<table class="table table-hover table-condensed">
							<h3>Insertion d'un réseau</h3>
							<hr>
                            <form action="reseaux.php" method="post">
							    <div class="form-group">
                                    <label for="rs_logo">Logo</label>
									<input type="text" name="rs_logo" id="rs_logo" placeholder="Insérer un logo" class="form-control">
							    </div>

                                <div class="form-group">
									<label for="lien">Lien</label>
									<input type="text" name="rs_lien" id="rs_lien" placeholder="Insérer un lien" class="form-control">
							    </div>
                                
							    <div>
                                    <input type="submit" name="reseau" value="Insérer">
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

