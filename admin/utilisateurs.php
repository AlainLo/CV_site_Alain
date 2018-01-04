<?php 

session_start();// à mettre dans toutes les pages de l'admin

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

if(!empty($_POST)){// insertion d'un utilisateur
	// si on a posté un nouvel utilisateur
	if ($_POST['adresse']!='' && $_POST['age']!='' && $_POST['avatar']!='' && $_POST['code_postal']!=''  && $_POST['commentaires']!=''  && $_POST['date_naissance']!='' && $_POST['email']!=''  && $_POST['etat-civil']!='' && $_POST['id_utilisateur']!='' && $_POST['mdp']!='' && $_POST['nom']!='' && $_POST['pays']!='' && $_POST['prenom']!='' && $_POST['pseudo']!='' && $_POST['sexe']!='' && $_POST['site_web']!='' && $_POST['telephone']!='' && $_POST['ville']!='' ){ //si on a posté un utilisateur qui n'est pas vide
			$adresse= addslashes($_POST['adresse']);
			$age= addslashes($_POST['age']);
			$avatar= addslashes($_POST['avatar']);
			$code_postal= addslashes($_POST['code_postal']);
            $commentaires= addslashes($_POST['commentaires']);
            $date_naissance= addslashes($_POST['date_naissance']);
            $email= addslashes($_POST['email']);
            $etat_civil= addslashes($_POST['etat_civil']);
            $id_utilisateur= addslashes($_POST['id_utilisateur']);
            $mdp= addslashes($_POST['mdp']);
            $nom= addslashes($_POST['nom']);
            $pays= addslashes($_POST['pays']);
            $prenom= addslashes($_POST['prenom']);
            $pseudo= addslashes($_POST['pseudo']);
            $sexe= addslashes($_POST['sexe']);
            $site_web= addslashes($_POST['site_web']);
            $telephone= addslashes($_POST['telephone']);
            $ville= addslashes($_POST['ville']);
			
			$pdoCV->exec(" INSERT INTO t_utilisateurs VALUES (NULL, '$adresse', '$age', '$avatar', '$commentaires', '$date_naissance','$email','$etat_civil','$mdp','$nom','$pays','$prenom','$pseudo','$sexe','$site_web','$telephone', '$ville','1')");// mettre $id_utilisateur quand on l'aura dans la variable de session.
		//	header("location: utilisateurs.php");//pour revenir sur la page
		//	exit();
	} //ferme le "if n'est pas vide"
}// ferme le if(isset) du FORM

// suppression d'un utilisateur
if(isset($_GET ['id_utilisateur'])){// on récupére l'expérience par son id dans l'url
$efface = $_GET['id_id_utilisateur'];
$sql = "DELETE FROM t_utilisateurs WHERE id_utilisateur = '$efface' ";
$pdoCV->query($sql);// on peut aussi utiliser exec si on le souhaite
header("location: utilisateurs.php"); // pour revenir sur la page
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
					$sql = $pdoCV->prepare("SELECT * FROM t_utilisateurs WHERE utilisateur_id='1'");
					$sql->execute();
					$nbr_utilisateurs = $sql->rowCount();
					//$ligne_experience = $sql->fetch();
			?>
			<div class="row">
				<h2> il y a <?php echo $nbr_utilisateurs; ?> utilisateurs</h2>
			    <div class="col-md-8">
					<table class="table  table-hover  table-condensed">
						<tr>
							<th>nom</th>
							<th>prenom</th>
                            <th>avatar</th>
                            <th>pseudo</th>
                            <th>etat_civil</th>
                            <th>date_naissance</th>
							<th>age</th>
                            <th>sexe</th>
                            <th>adresse</th>
                            <th>ville</th>
                            <th>code_postal</th>
                            <th>pays</th>
                            <th>telephone</th>
                            <th>email</th>
                            <th>site_web</th>
                            <th>commentaires</th>
							<th>description</th>
							<th>Supression</th>
							<th>Modification</th>
						</tr>
						<tr>
							<?php while ($ligne_experience = $sql->fetch()){ ?>
							<td><?php echo $ligne_utilisateur['nom']; ?></td>
							<td><?php echo $ligne_utilisateur['prenom']; ?></td>
							<td><?php echo $ligne_utilisateur['avatar']; ?></td>
							<td><?php echo $ligne_utilisateur['pseudo']; ?></td>
                            <td><?php echo $ligne_utilisateur['etat_civil']; ?></td>
                            <td><?php echo $ligne_utilisateur['date_naissance']; ?></td>
							<td><a href="utilisateurs.php?id_utilisateur=<?php echo $ligne_utilisateur['id_utilisateur']; ?> "><button type= "button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a></td>
							<td><a href="modif_utilisateur.php?id_utilisateur=<?php echo $ligne_utilisateur['id_utilisateur']; ?> "><button type= "button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button></a></td>
							<td></td>
						</tr>
						<?php } ?>
					</table>
				</div>
				<div class="col-md-4">
					<h2></h2>
					<table class="table  table-hover  table-condensed">
						<h3>Insertion d'un utilisateur</h3>
						<hr>
                            <form action="utilisateurs.php" method="post">
                                <div class="form-group">
									<label for="titre">Titre</label>
									<input type="text" name="titre" id="titre" placeholder="Insérer un nom" class="form-control">
                                </div>
							
							    <div class="form-group">
									   <label for="soustitre">Sous-Titre</label>
									   <input type="text" name="soustitre" id="prenom" placeholder="Insérer un prénom" class="form-control">
							    </div>

							    <div class="form-group">
									<label for="dates">Age</label>
									<input type="text" name="age" id="age" placeholder="Insérer des dates" class="form-control">
							    </div>

							    <div class="form-group">
                                    <label for="commentaires">Commentaires</label>
                                    <textarea name="commentaires" class="form-control" id="editor1"></textarea>
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

