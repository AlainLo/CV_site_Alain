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

  //var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <?php 
            $sql = $pdoCV -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1' "); 
            $ligne_utilisateur = $sql -> fetch(); 
        ?>
        <title> Admin : <?= $ligne_utilisateur['prenom']; ?> <?= $ligne_utilisateur['nom']; ?></title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--personal css-->
        <link href="css/styleadmin.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="transparent">

    <!--nav en include -->
    <?php include('inc/navbar.php');?>
        <section>
          <div class="container">
            <h1>Admin du site cv d'<?php echo($ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom']); ?></h1>
            <h2>accueil Admin</h2>
            <div class="row">
                <div class="col-md-8">
                    <table class="table  table-hover table-condensed">
                    <h3>compétences acquises</h3>
                        <th> compétences </th><th> Niveau (en %) </th><th> suppression </th><th> modification </th>
                        <tr class="info">
                            <td> Photoshop </td>
                            <td> 40 </td>
                            <td><button type= "button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></td>
                            <td><button type= "button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button></td></tr>

                        <tr class="warning">
                            <td> PHP </td>
                            <td> 10 </td>
                            <td><button type= "button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></td>
                            <td><button type= "button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button></td>
                        </tr>

                        <tr class="success">
                            <td>Javascript</td>
                            <td>0</td>
                            <td><button type= "button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></td>
                            <td><button type= "button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button></td>
                        </tr>

                        <tr class="active">
                            <td>HTML5</td>
                            <td>30</td>
                            <td><button type= "button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></td>
                            <td><button type= "button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button></td>
                        </tr>

                        <tr class="bg-primary">
                            <td>CSS3</td>
                            <td>30</td>
                            <td><button type= "button" class="btn btn-danger"><span class="glyphicon glyphicon-trash">
                            </span></button></td>
                            <td><button type= "button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span>
                            </button></td>
                        </tr>

                        <tr class="warning">
                            <td>JQuery</td>
                            <td>10</td>
                            <td><button type= "button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                            </button></td>
                            <td><button type= "button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span>
                            </button></td>
                        </tr>

                        <tr class="danger">
                            <td>SEO</td>
                            <td>33</td>
                            <td><button type= "button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                            </button></td>
                            <td><button type= "button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span>
                            </button></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-4">
                    <h3>Insertion d'une compétence</h3>
                    <form="form-control">
                        <div class="form-group">
                            <label>ajouter une compétence</label>
                            <input type = "text" placeholder=" ajouter une compétence"></input>
                        </div>

                        <div class="form-group">
                            <label>ajouter le niveau</label>
                            <input type = "text" placeholder=" ajouter un niveau" class="box-shadow"></input>
                        </div>

                        <div class="form-group">
                            <button type= "button" class="btn btn-success btn-xs">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
                <p>texte</p>
                <hr>
                <?php
                      $sql = $pdoCV->query("SELECT * FROM t_competences");
                      $ligne_competence = $sql->fetch();
                ?>
        </section>

          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
          <!-- Include all compiled plugins (below), or include individual files as needed -->
          <script src="js/bootstrap.min.js"></script>

       <!--footer en include -->
    <?php include('inc/footer.php');?>   

</body>
</html>

