
<?php
session_start();
$cin = $_GET['cin'];
?>
<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bienvenue - eHealth</title>
        <!--<link rel="stylesheet" href="../css/reset.css">-->
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../css/loggedin.css">
        <link rel="stylesheet" media="all" href="../css/ordonnance.css">
    </head>

    <body>
        <?php
        // Connexion à la base de données
        try {
            //$bdd = new PDO('mysql:host=sql2.olympe.in;dbname=3pcqjpfr', '3pcqjpfr', 'Selmi11895480');
            $bdd = new PDO('mysql:host=localhost;dbname=ehealth', 'root', '');
        } catch (Exception $ex) {
            echo 'erreur';
        }
        //requette de selection
        $reponse = $bdd->query('SELECT * FROM patients WHERE cin=\'' . $_GET['cin'] . '\'') or die(print_r($bdd->errorInfo()));
        $donnee = $reponse->fetch();
        ?>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" rel='home' href="#" title="accueil ehealth">
                        <img class="logo" src="../images/ehealth.png">
                    </a>  </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dr. <?php echo $_SESSION['nom']; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Profil<span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
                                <li><a href="#">Support<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="pagesPHP/deconnecte.php">Deconnexion<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!--left menu-->
        <div class="col-md-3 col-xs-12 leftMenu">
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="#">
                            Mes Patients
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="#">
                            Calendrier (Coming Soon)
                        </a>
                    </li>
                    <li class="sidebar-brand">
                        <a href="#" class="active">
                            <?php echo $donnee['nom'] . "  " . $donnee['prenom'] ?>
                        </a>
                    </li>
                    <li>
                        <?php
                        echo "<a href=\"profil.php?cin=$cin\">Profil</a>";
                        ?>    
                    </li>
                    <li>
                        <?php
                        echo "<a href=\"historique.php?cin=$cin\">Historique</a>";
                        ?>
                    </li>
                    <li>
                        <a href="#" class="active">Ordonnance</a>        
                    </li>
                </ul>
            </div>
        </div>
        <form method="post"  action="pagesPHP/enregOrdonnance.php">
            <div class="col-md-6 col-xs-12 ordonnance">
                <div class="oordonnance">
                    <div class="row">
                        <div class="medinfo col-xs-7">
                            <h3>Dr. <?php echo $_SESSION['nom'] ?></h3>
                            <h4><?php echo $_SESSION['specialite'] ?></h4>
                            <h5><?php echo $_SESSION['adresse'] ?><br> Tél: <?php echo $_SESSION['tel'] ?></h5>
                        </div>
                    </div>
                    <div class="row ">
                        <br>
                        <div class="patientname col-xs-6" ><?php echo $donnee['nom'] . " " . $donnee['prenom'] ?></div>
                        <div class="date col-xs-6" ></div>
                    </div>
                    <div class="ordcontent">
                        <table>
                            <tr>
                                <td class="note">
                                    <p>ceci est une note qui peut parfois etre un peu longue, et quand meme la taille de ce champ s'adapte automatiquement</p>
                                <td>
                                    <div class="edit" ></div>
                                    <div class="remove"></div>
                            </tr>
                            <tr>
                                <td class="medicament">
                                    <p>ceci est un medicament</p>
                                <td>
                                    <div class="edit"></div>
                                    <div class="remove"></div>
                            </tr>
                        </table>
                    </div>

                    <div class="addingbuttons">
                        <div class="btn btn-success medicament" id="ajoutermedicament">+Medicament</div>
                        <div class="btn btn-success note" id="ajouternote">+Note</div>
                    </div>
                </div>
                <div class="finalisingbuttons">
                    <div class="btn btn-danger annuler"><a href="mespatients.php">Annuler</a></div>
                    <div class="btn btn-warning enregistrer"><a href="pagesPHP/enregOrdonnance.php"  type="submit">Enregistrer</a></div>
                    <div class="btn btn-warning imprimer" onclick="window.print()">Imprimer</div>
                </div>
                <!-- jQuery -->
            </div>
        </form>
            <!--<script src="../js/loggedin.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <!--Bootstrap Core JavaScript--> 
        <script src="../js/elastic.js"></script>
        <script src="../js/ordonnance.js"></script>
    </body>
</html>
