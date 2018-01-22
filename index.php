<?php
require'connexion.php';

$sql = $pdoCV->query(" SELECT logo, titre_cv, accroche FROM t_titre_cv WHERE utilisateur_id ='1'"); 
//ORDER BY id_titre_cv DESC LIMIT 1
$ligne_titre_cv = $sql->fetch(PDO::FETCH_ASSOC);

$sql = $pdoCV->query(" SELECT prenom, nom, adresse, code_postal, email, site_web, telephone FROM t_utilisateurs WHERE id_utilisateur ='1'");
$ligne_utilisateurs = $sql->fetch(PDO::FETCH_ASSOC);

$sql = $pdoCV->query(" SELECT * FROM t_competences WHERE utilisateur_id ='1'");
$ligne_competences = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $pdoCV->query(" SELECT * FROM t_realisations WHERE utilisateur_id ='1' ");
$ligne_realisations = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $pdoCV->query(" SELECT * FROM t_experiences WHERE utilisateur_id ='1'");
$ligne_experiences = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $pdoCV->query(" SELECT * FROM t_formations WHERE utilisateur_id ='1'");
$ligne_formations = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $pdoCV->query(" SELECT * FROM t_reseaux WHERE utilisateur_id ='1'");
$ligne_reseaux = $sql->fetchAll(PDO::FETCH_ASSOC);
    
$sql = $pdoCV->query(" SELECT * FROM t_plus WHERE utilisateur_id ='1'");
$ligne_plus = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = $pdoCV->query(" SELECT * FROM t_loisirs WHERE utilisateur_id ='1'");
$ligne_loisirs = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="Alain LORTAL, développeur-intégrateur web, CV">
        <meta name="author" content="Alain LORTAL">
		
		<!--personal css-->
		<link href="css/stylepublic.css" rel="stylesheet">
        <!-- fonts for this site-->
        <link href="https://fonts.googleapis.com/css?family=Exo|Alegreya+Sans|Fira+Sans|Kanit+Sans:300,400,700,800" rel="stylesheet" type="text/css"> 
        
        <!-- extrait de code pour gérer les favicons : -->
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="img/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="img/favicons/manifest.json">
        <link rel="mask-icon" href="img/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
        <meta name="msapplication-TileColor" content="#00a8ff">
        <meta name="msapplication-config" content="img/favicons/browserconfig.xml">
	</head>
   
	<body class="wallpaper">
        <header>
            <h1>le site de Alain </h1>
            <?php include('navbar.php');?>  
        </header>
        <section class="base">
            <div class="page">
                <div class="main">
                    <div class= svg-container>
                        <object type="image/svg+xml" data="svg/a_propos_fond.svg" class="svg-content">
                        </object>
                    </div>
                </div> 
            </div>

            <div id="page_7" class="page ">
                <div class="main">
                    <div class= svg-container>
                        <object type="image/svg+xml" data="svg/plus.svg" class="svg-content">
                        </object>
                    </div>
                    <div class="svg-text">
                        <?php   require('form/Contact.class.php');
                        // on vérifie que le formulaire a été posté
                                if (!empty($_POST)) {
                                    // on éclate le $_POST en tableau qui permet d'accéder directement aux champs par des variables
                                    extract($_POST);

                                    $valid = (empty($co_nom) || empty($co_email) ||
                                    !filter_var($co_email, FILTER_VALIDATE_EMAIL) || empty($co_sujet) || empty($co_message)) ? false : true ; //écriture ternaire pour if / else
                                    // si tous les champs sont correctement renseignés
                                    if ($valid) {
                                        // on crée un nouvel objet (ou une instance) de la class Contact.class.php
                                        $contact = new Contact();
                                        // on utilise la méthode insertContact pour insérer en BDD
                                        $contact->insertContact($bdd, $co_nom, $co_email, $co_sujet, $co_message);
                                        unset($co_nom);
                                        unset($co_email);
                                        unset($co_sujet);
                                        unset($co_message);
                                    }
                                }
                        ?>
                            <div class="container">
                                <div>
                                    <div> 
                                        <div>
                                            <div>
                                                <img src="../img/imgcode.jpg" alt="code">
                                            </div>
                                            <div>
                                                <h2> <p>Contactez-moi </p></h2>

                                                <form action="#" method="POST">
                                                    <div>
                                                        <label for="nom"> Nom : </label>
                                                            <span class="error"><?php if (isset($erreurnom)) echo $erreurnom; ?></span>
                                                        <input type="text" name="co_nom" value="<?php if(isset($co_nom)) echo $co_nom; ?> "><br>
                                                    
                                                        <label for="email"> Email : </label>
                                                            <span class="error"><?php if (isset($erreuremail)) echo $erreuremail; ?></span>
                                                        <input id="email" type="text" name="co_email" value="<?php if (isset($co_email)) echo $co_email; ?>"><br>
                                                    
                                                        <label for="sujet"> Sujet : </label>
                                                            <span ><?php if (isset($erreursujet)) echo $erreursujet; ?></span>
                                                        <input type="text" name="co_sujet" value="<?php if (isset($co_sujet)) echo $co_sujet; ?>"><br>
                                                   
                                                        <label for="message"> Message : </label>
                                                            <span ><?php if (isset($erreurmessage)) echo $erreurmessage; ?></span>
                                                        <textarea name="co_message" cols="30" rows="5"><?php if (isset($co_message)) echo $co_message; ?></textarea><br>
                                                    </div>
                                                    <div>
                                                        <input type="submit" value="Envoyer" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div id="contact" class="onglet">
                        <p>Contact</p>
                    </div>
                </div>

                <div id="page_6" class="page">
                    <div class="main">
                        <div class= svg-container>
                            <object type="image/svg+xml" data="svg/loisirs.svg" class="svg-content">
                            </object>
                        </div>
                        <div class="svg-text">
                            <!-- form/index.php -->
                           <p>
                                <?php foreach($ligne_loisirs as $ligne_loisir) : ?>
                                    <span class="titre"><?= $ligne_loisir['loisir']; ?></span><br>
                                    <span class="titre"><?= $ligne_loisir['l_description']; ?></span><span class="marge"></span><br>
                                <?php endforeach; ?>
                            </p>
                        </div>
                    </div>
                    <div id="loisirs" class="onglet">
                            <p>Loisirs</p>
                    </div>
                </div>

                <div id="page_5" class="page">
                    <div class="main">
                        <div class= svg-container>
                            <object type="image/svg+xml" data="svg/formation.svg"  class="svg-content" >
                            </object>
                        </div>
                        <div class="svg-text">
                            <p>
                            <?php foreach($ligne_formations as $ligne_formation) : ?>
                                <span class="dates"><?= $ligne_formation['f_dates']; ?></span><br>
                                <span class="titre"><?= $ligne_formation['f_titre']; ?></span><span class="marge"></span>
                                <span class="soustitre"><?= $ligne_formation['f_soustitre']; ?></span><br>
                                <span class="description"><?= $ligne_formation['f_description']; ?></span><br>
                                <br>
                                <?php endforeach; ?>
                            </p>
                        </div> 
                    </div>
                    <div id="formation" class="onglet">
                        <p>Formation</p>
                    </div> 
                </div>

               <div id="page_4" class="page">
                    <div class="main">
                        <div class= svg-container>
                            <object type="image/svg+xml" data="svg/realisations.svg"  class="svg-content">
                            </object>
                        </div>
                        <div class="svg-text">
                            <p>
                                <?php foreach($ligne_realisations as $ligne_realisation) : ?>
                                <span class="dates"><?= $ligne_realisation['r_dates']; ?></span><br>
                                <span class="titre"><?= $ligne_realisation['r_titre']; ?></span><span class="marge"></span>
                                <span class="soustitre"><?= $ligne_realisation['r_soustitre']; ?></span>
                                <span class="description"><?= $ligne_realisation['r_description']; ?></span><br>
                                <?php endforeach; ?>
                            </p>
                        </div>
                    </div> 
                    <div id="realisations" class="onglet">                      
                        <p>Réalisations</p>
                    </div> 
                </div>
                
                <div id="page_3" class="page">
                    <div class="main">
                        <div class= svg-container>
                            <object type="image/svg+xml" data="svg/experiences.svg"  class="svg-content" >
                            </object>
                        </div>
                        <div class="svg-text">
                            <p>
                                <?php foreach($ligne_experiences as $ligne_experience) : ?>
                                    <span class="dates"><?= $ligne_experience['e_dates']; ?></span><br>
                                    <span class="titre"><?= $ligne_experience['e_titre']; ?></span><span class="marge"></span>
                                    <span class="soustitre"><?= $ligne_experience['e_soustitre']; ?></span>
                                    <span class="description"><?= $ligne_experience['e_description']; ?></span><br>
                                <?php endforeach; ?>
                            </p>
                        </div>
                    </div> 
                    <div id="experiences" class="onglet">
                        <p>Expériences</p>
                    </div>  
                </div>

            <div id="page_2" class="page active">
                <div class="main">
                        <div class= svg-container>
                            <object type="image/svg+xml" data="svg/competences.svg"  class="svg-content">
                            </object>
                        </div>
                        <div class="svg-text">
                            <p>
                                <?php foreach($ligne_competences as $ligne_competence) : ?>
                                    <span class="titre"><?= $ligne_competence['competence']; ?></span><br>
                                    <span class="titre"><?= $ligne_competence['c_niveau']; ?></span><span class="marge"></span><br>
                                <?php endforeach; ?>
                            </p>
                        </div>
                    </div> 
                <div id="competences" class="onglet">
                    <p>Compétences</p>
                </div>  
            </div>

            <div id="page_1" class="page active">
                <div class="main">
                    <div class= svg-container>
                        <object type="image/svg+xml" data="svg/a_propos.svg"  class="svg-content">
                        </object>
                    </div>
                     <div class="svg-text">
                        <p>
                            <?php foreach($ligne_utilisateurs as $key => $value) : ?>
                                <span class="<?= $key; ?>", ><?= $value; ?></span><br>
                            <?php endforeach; ?>
                        </p>
                    </div>
                    
                    <div class="svg-logo">
                        <p>
                            <?php foreach($ligne_reseaux as $ligne_reseau) : ?>
                                <span class="reseau"><a href="<?= $ligne_reseau['rs_lien']; ?>"><img src="<?= $ligne_reseau['rs_logo']; ?>"></a></span><br>
                                <br>
                            <?php endforeach; ?>
                        </p>
                    </div>
                    
                    <div class="svg-accroche">
                        <p>
                            
                            <?php foreach($ligne_titre_cv as $key => $value) : ?>
                                <span class="<?= $key; ?>", ><?= $value; ?></span><br>
                            <?php endforeach; ?>
                        </p>
                    </div>
                    
                    <div class="svg-download">
                        <p>
                            <a href="telechargements/webcv.pdf">Téléchargez le CV en version papier</a>
                        </p>
                    </div>
                </div>
                
                <div id="a-propos" class="onglet">
                    <p>à propos</p>
                </div>  
            </div>
                
            <div id="page_0" class="page">
                <div class="main">
                    <div class= svg-container>
                        <object type="image/svg+xml" data="svg/eclairage.svg"  class="svg-content">
                        </object>
                    </div>
                </div>
                
                <div id="eclairage" class="onglet">
                </div>  
            </div>
        </section>
        <script >var pages = document.getElementsByClassName("onglet")
            // console.log(pages)
            for(var i=0; i<pages.length; i++){
              pages[i].addEventListener("click",function(){
                console.log(this)
                for (var j=0; j<pages.length; j++){
                  // console.log(pages[j].parentNode)
                  pages[j].parentNode.classList.remove("active")
                }
               this.parentNode.classList.add("active")
              })
        }</script>
		<!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script><script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>    
		<?php include('footer.php');?>  
	</body>
</html>