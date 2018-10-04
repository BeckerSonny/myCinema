<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    include 'includes/functions_query.php'
    ?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My cinema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<script src="main.js"></script>-->
    
</head>
<body>
<div class="banner_titre">
    <?php
    include 'includes/bdd.php';
    include 'includes/functions.php';
    ?>
    <nav class="navbar navbar-dark bg-dark row justify-content-center nav_menu">
        <img class="logo offset-2" src="images/logo.png" alt="Logo"/>
        <h1 class="titre">My cinema</h1>
        <div class="col-5 offset-1">    
            <div class= "search_bar">
            <?php
            $page_actual =
                substr(
                    $_SERVER['REQUEST_URI'],
                    strrpos($_SERVER['REQUEST_URI'], "/") + 1,
                    strlen($_SERVER['REQUEST_URI'])
                );
            $page_actual = substr($page_actual, 0, strrpos($page_actual, "?"));
            if ($page_actual == "info_membre.php" ||
            $page_actual == "historique_membre.php" || $page_actual == "abonnement_membre.php")
            {
                $action = "membres.php";
            }
            else
            {
                $action = "";
            }
            echo "<form class=\"form-inline form_search\" action=\"".$action."\" method=\"get\">";
            if ($page_actual == "ajout_historique_membre.php")
            {
                echo "<input type=\"hidden\" name=\"nom\" value=" . $_GET['nom'] . " />
                <input type=\"hidden\" name=\"prenom\" value=" . $_GET['prenom'] . " />
                <input type=\"hidden\" name=\"id_membre\" value=" . $_GET['id_membre'] . " />";
            }
            ?>
                <input class="form-control mr-sm-2 recherche"
                type="search" name="search" placeholder="Recherche..." aria-label="Search">
                <button class="btn btn-dark my-2 my-sm-0" type="submit">Recherche</button>
            </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <nav class="row justify-content-center">
            <ul class="nav">
                <li class="nav-item nav-li">
                    <a class="nav-link links" href="index.php">Home</a>
                </li>
                <li class="nav-item nav-li">
                    <a class="nav-link links" href="a_l_affiche.php">À l'affiche</a>
                </li>
                <li class="nav-item nav-li">
                    <a class="nav-link links" href="membres.php">Membres</a>
                </li>
                <li class="nav-item nav-li">
                    <a class="nav-link links" href="historique_film.php">Historique</a>
                </li>
            </ul>
        </nav>
    </div>
</div>