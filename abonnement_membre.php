<?php
    include 'includes/menu.php';
?>
<div class="div_body">
    <div class="container">
        <h2 class="row justify-content-center titre_2">Changement d'abonnement
        <?php echo strtoupper($_GET['nom']) . " " . ucfirst($_GET['prenom']) ?></h2>
        <div class="row justify-content-center">
            <div class="all_donnees">
                <?php
                if (!isset($_POST['abo']))
                {
                    $result = create_query_info_membre($bdd);

                    if ($result != false)
                    {
                        while ($donnees = $result->fetch())
                        {
                            echo "<div class=\"affichage\"><div class=\"row align_left\">
                            <p class=\"bold\">Nom : </p><p class=\"align_left\"> ".strtoupper($donnees[1])."</p>
                                    <p class=\"bold align_left\">Prenom : </p>
                                    <p class=\"align_left\">" . ucfirst($donnees['prenom']) . "</p>
                                    <p class=\"bold align_left\">Id personnel : </p>
                                    <p class=\"align_left\">" . $donnees['id_perso'] . "</p></div>
                                    <div class=\"row align_left\"><p class=\"bold\">Abonnement actuel : </p>
                                    <p class=\"align_left\">" . ucfirst($donnees['nom']) . "</p>";
                        }
                    }
                    ?>
                        <div class="w-100"></div>
                        <p class="bold">Nouvel abonnement :</p>
                        <p class="align_left">
                            <form action="" method="post">
                                <select name="abo">
                                    <?php
                                    $abo = $bdd->query('SELECT * FROM abonnement ORDER BY nom');
                                    echo "<option value=\"\">Abonnement</option>";
                                    while ($abos = $abo->fetch())
                                    {
                                        echo "<option value=\"" . $abos["id_abo"] . "\">" . ucfirst($abos['nom']) . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="submit" value="Changer l'abonnement" />
                            </form>
                    </p></div>
                    </div><br />
                    <?php
                }
                else
                {
                    try
                    {
                        $bdd->query('UPDATE membre 
                        INNER JOIN fiche_personne AS fp ON fp.id_perso = membre.id_fiche_perso
                        SET id_abo='.$_POST['abo'].'
                        WHERE fp.id_perso='.$_GET['id_perso'].'
                        AND fp.nom = \''.$_GET['nom'].'\'
                        AND fp.prenom = \''.$_GET['prenom'].'\';');

                        $result = $bdd->query('SELECT nom FROM abonnement
                        WHERE id_abo = '.$_POST['abo'].';');
                        
                        while ($donnees = $result->fetch())
                        {
                            echo "<div class=\"affichage\"><div class=\"row justify-content-center\"><p class=\"\">
                            Nouvel abonnement pour " . ucfirst($_GET['prenom']) . "
                            </p><i class=\"align_fa align_left fa fa-long-arrow-right \"></i>
                            <p class=\"align_left\">" . ucfirst($donnees['nom']) . ".</p></div>
                            </div><br />";
                        }
                        $result->closeCursor();
                    }
                    catch (PDOException $e)
                    {
                        echo "<div class=\"affichage\"><div class=\"row align_left\">
                        <p class=\"\">" . $e->getMessage() . "</p></div>
                        </div><br />";
                    }
                }
                ?>
            <a class="link_historique_membre row justify-content-center"
                href="info_membre.php?nom=<?php echo $_GET['nom']; ?>&prenom=<?php echo $_GET['prenom']; ?>">
                Retour sur les informations du membre
            </a>
            </div>
        </div>
    </div>
</div>
<?php
    include 'includes/footer.php';
?>