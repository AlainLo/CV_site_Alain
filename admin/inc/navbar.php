<!-- Nav bar Bootstrap -->
  <nav class="navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--<a class="navbar-brand" href="index.php">Brand</a>-->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
         <li><a href="../index.php">Accueil</a></li>
         <li class="active"><a href="utilisateurs.php">Utilisateur<span class="sr-only">(current)</span></a></li>
       
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Parcours <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="titre.php">Titre</a></li>
            <li><a href="realisations.php">Réalisations</a></li>
            <li><a href="experiences.php">Expériences</a></li>
            <li><a href="Formations.php">Formations</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="competences.php">Compétences</a></li>
            <li><a href="plus.php">Plus</a></li>
            <li><a href="reseaux.php">Reseaux</a></li>
            <li><a href="loisirs.php">Loisirs</a></li>
             <!--<li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>-->
          </ul>
        </li>
      </ul>
      <!-- <form class="navbar-form navbar-right">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Rechercher">
        </div>
        <button type="submit" class="btn btn-default">Valider</button>
      </form>-->
     <ul class="nav navbar-nav navbar-right">
      <!-- <li><a href="#">xxxx</a></li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Déconnexion <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="sauthentifier.php?quitter=oui">déconnexion</a></li>
            
            <li role="separator" class="divider"></li>
            <li><a href="../index.php">site public</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- fin Nav bar Bootstrap-->