<!-- form/index.php -->
<?php
require('connexion.php')
// on récupère la classe contact

require('form/Contact.class.php');

// on vérifie que le formulaire a été posté
if (!empty($_POST)) {
	// on éclate le $_POST en tableau qui permet d'accéder directement aux champs par des variables
    extract($_POST);

    $valid = (empty($co_nom) || empty($co_email) ||
    !filter_var($co_email, FILTER_VALIDATE_EMAIL) || empty($co_sujet) || empty($co_message)) ? false : true ; //écriture ternaire pour if / else
    
    
    // si tous les champs sont correctement renseignés
    if ($valid) {
        // on crée u nouvel objet (ou une instance ) de la class Contact.class.php
        $contact = new Contact();
        // on utilise la  méthode insertContact our insérer en BDD
        $contact->insertContact($co_nom, $co_email, $co_sujet, $co_message);
        
        unset($co_nom);
        unset($co_email);
        unset($co_sujet);
        unset($co_message);
            
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!--responsive viewport meta tag-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Formulaire de contact</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css"/>
    </head>

    <body>
        <div class="container">
            <div class="card">
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-md-4">
                            <img src="../img/imgcode.jpg" alt="code" >
                        </div>
                        <div class="col-md-6 offset-2">
                           <h2 id="contact"> <p>Contactez-moi </p></h2>
                            
                            <form action=index.php method="POST">
                                <div class="form-group">
                                    <label for="nom"> Nom : </label>
                                        <span class="error"><?php if (isset($erreurnom)) echo $erreurnom; ?></span>
                                    <input class="form-control" type="text" name="co_nom" value="<?php if(isset($co_nom)) echo $co_nom; ?> ">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email :</label>
                                        <span class="error"><?php if (isset($erreuremail)) echo $erreuremail; ?></span>
                                    <input id="email" class="form-control" type="text" name="co_email" value="<?php if (isset($co_email)) echo $co_email; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="sujet">Sujet :</label>
                                        <span class="error"><?php if (isset($erreursujet)) echo $erreursujet; ?></span>
                                    <input class="form-control" type="text" name="co_sujet" value="<?php if (isset($co_sujet)) echo $co_sujet; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="message">Message :</label>
                                        <span class="error"><?php if (isset($erreurmessage)) echo $erreurmessage; ?></span>
                                    <textarea class="form-control" name="co_message"><?php if (isset($co_message)) echo $co_message; ?></textarea>
                                </div>

                                <input type="submit" class="btn btn-outline-info btn-block btnsubmit" value="Envoyer" />
                            </form><!-- /form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
    <!-- JS for Bootstrap -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>    
    </body>
