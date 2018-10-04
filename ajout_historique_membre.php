<?php
    include 'includes/menu.php';
?>
<div class="div_body">
    <div class="container">
        <h2 class="row justify-content-center titre_2">Ajout d'historique pour
        <?php echo strtoupper($_GET['nom']) . " " . ucfirst($_GET['prenom']) ?></h2>
        <div class="row justify-content-center">
            <div class="all_donnees">
            <a class="link_historique_membre row justify-content-center"
                href="info_membre.php?nom=<?php echo $_GET['nom']; ?>&prenom=<?php echo $_GET['prenom']; ?>">
                Retour sur les informations du membre
            </a>
                <?php
                if (!isset($_GET['search']) && !isset($_GET['id_film']))
                {
                    ?>
                        <div class="w-100">
                        </div>
                        <div class="row justify-content-center">
                        <p class="no_result">Entrez le titre du film à ajouter dans la barre de recherche.</p>
                        </div>
                    <?php
                }
                elseif (isset($_GET['search']))
                {
                    include 'includes/donnees_work_historique.php';
                } 
                elseif (isset($_GET['id_film'])) 
                {
                    if ($_GET['avis'] == "")
                    {
                        $_GET['avis'] = null;
                    }
                    $verif = $bdd->query('SELECT * FROM historique_membre AS hm
                    WHERE hm.id_membre = ' . $_GET['id_membre'] . ';');

                    while ($donnees = $verif->fetch())
                    {
                        if($_GET['id_film'] == $donnees['id_film'] && $_GET['date'] == substr($donnees['date'], 0, 10))
                        {
                            $answer = false;
                        }
                        else
                        {
                            $answer = true;
                        }
                    }
                    $verif->closeCursor();
                    $result = $bdd->query('SELECT titre FROM film WHERE id_film = ' . $_GET['id_film'] . ';');
                    
                    if ($answer === true)
                    {
                        $bdd->query('INSERT INTO historique_membre (id_membre, id_film, date, avis)
                        VALUES (' . $_GET['id_membre'] . ', ' . $_GET['id_film'] . ',
                        \'' . $_GET['date'] . '\', \'' . $_GET['avis'] . '\')');
                    }
                    while ($donnees = $result->fetch())
                    {
                        if ($answer === true)
                        {
                            echo "<div class=\"row justify-content-center affichage\">\"" . $donnees['titre'] . "
                            \" ajouté à l'historique de " . strtoupper($_GET['nom']) .
                            " " . ucfirst($_GET['prenom']) . ".</div>";
                        }
                        elseif ($answer === false)
                        {
                            echo "<div class=\"row justify-content-center affichage\">Le film \"" . $donnees['titre'] . "
                            \" <p class=\"align_space bold\"> à déjà était vu le "
                            . date("d/m/Y", strtotime($_GET['date'])) . " par </p>
                            <p class=\"align_space\">" . strtoupper($_GET['nom']) . " "
                            . ucfirst($_GET['prenom']) . ".</p></div>";
                        }
                    }
                }
                ?>
            </div>
        </div>
        <nav aria-label="Pagination">
        <ul class="pagination justify-content-center">
            <?php
            if (isset($_GET['search']))
            {
                include 'includes/pagination.php';
            }
            ?>
        </ul>
        </nav>
    </div>
</div>
<?php
    include 'includes/footer.php';
?>