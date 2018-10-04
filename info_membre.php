<?php
    include 'includes/menu.php';
?>
<div class="div_body">
    <div class="container">
        <h2 class="row justify-content-center titre_2">Information membre</h2>
        <div class="row justify-content-center">
            <div class="all_donnees">
                <?php
                    $result = create_query_info_membre($bdd);

                if ($result != false)
                {
                    while ($donnees = $result->fetch())
                    {
                        echo "<div class=\"affichage\"><div class=\"row align_left\">
                        <i class=\" align_fa fa fa-address-card-o\"></i>
<p class=\"bold align_left\">Nom : </p><p class=\"align_left\"> " . strtoupper($donnees[1]) . "</p>
<p class=\"bold align_left\">Prenom : </p><p class=\"align_left\">" . ucfirst($donnees['prenom']) . "</p>
<p class=\"bold align_left\">Id personnel : </p><p class=\"align_left\">" . $donnees['id_perso'] . "</p></div>
<div class=\"row align_left\"><p class=\"bold\">Abonnement : </p>
<p class=\"align_left\">" . ucfirst($donnees['nom']) . "</p><p class=\"align_left\">
<a class=\"link_historique_membre\" 
href=\"abonnement_membre.php?nom=
" . $_GET['nom'] . "&prenom=" . $_GET['prenom'] . "&id_perso=" . $donnees['id_perso'] . "\">
Changer l'abonnement</a></p></div>
<div class=\"row align_left\"><p class=\"bold\">Date de naissance : </p>
<p class=\"align_left\">".date("d/m/Y", strtotime($donnees['date_naissance']))."</p></div>
<div class=\"row align_left\"><p class=\"bold\">Ville : </p>
<p class=\"align_left\">" . $donnees['cpostal'] . " " . ucfirst(strtolower($donnees['ville'])) . "</p></div>
<div class=\"row align_left\"><p class=\"bold\">Email : </p><p class=\"align_left\">" . $donnees['email'] . "</div>
<div class=\"row align_left\"><a class=\"link_historique_membre\" href=\"historique_membre.php?nom=" . $_GET['nom'] . "
&prenom=" . $_GET['prenom'] . "&id_perso=" . $donnees['id_perso'] . "\">Voir l'historique</a>
<a class=\"link_historique_membre align_left\" href=\"ajout_historique_membre.php?nom=" . $_GET['nom'] . "
&prenom=" . $_GET['prenom'] . "&id_membre=" . $donnees['id_membre'] . "\">Ajouter un film vu</a></div>
</div><br />";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
    include 'includes/footer.php';
?>