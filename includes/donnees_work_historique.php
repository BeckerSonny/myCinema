<?php
if (!isset($_GET['page']))
{
    $_GET['page'] = 1;
}
$i = 0;
$result = create_query_historique($bdd);


echo "<div class=\"row justify-content-center\"><p class=\"bold\">" . $result->rowcount() . " résultats.</p></div>";

if ($result != null)
{
    $new_limit = $_GET['page']*$limit;

    while (($donnees = $result->fetch()) && $i < $new_limit)
    {
        $i++;
        if ($i > $new_limit-$limit)
        {
            if ($donnees['annee_prod'] == 0)
            {
                $donnees['annee_prod'] = "Inconnue";
            }
            if ($donnees[6] === null)
            {
                $donnees[6] = "Non définie";
            }
            if ($donnees['nom'] === null)
            {
                $donnees['nom'] = "Non répertorié";
            }
            if ($page_actual != "ajout_historique_membre.php")
            {
                echo "<div class=\"affichage\"><div class=\"row align_left\"><p class=\"bold\">".$i."
                <i class=\"material-icons\">&#xe54d;</i> Titre : </p>
                <p class=\"align_p\"> " . $donnees['titre'] . " </p></div>
                <div class=\"row align_right\"><p class=\"bold align_p\">  Genre : </p>
                <p class=\"align_p\">" . ucfirst($donnees[6]) . "</p></div>
                <div class=\"row align_left\"><p class=\"bold\">  Distributeur : </p>
                <p class=\"align_left\">" . ucfirst($donnees['nom']) . "</p></div>
                <div class=\"row align_left\"><p class=\"bold\">  Diffusé du : </p>
                <p class=\"align_left\">" . date("d/m/Y", strtotime($donnees['date_debut_affiche'])) . "</p>
                <p class=\"bold align_left\">  au : </p>
                <p class=\"align_left\">" . date("d/m/Y", strtotime($donnees['date_fin_affiche'])) . "</p></div>
                <div class=\"row align_left\"><p class=\"bold\"> Année de prod : </p>
                <p class=\"align_left\">" . $donnees['annee_prod'] . "</p></div>
                <div class=\"resum\"><p class=\"bold\">Résumé : </p>" . $donnees['resum'] . "</div>
                </div><br />";
            }
            else
            {
                echo "<div class=\"affichage\"><div class=\"row align_left\">
                <p class=\"bold\">" . $i . " <i class=\"material-icons\">&#xe54d;</i> Titre : </p>
                <p class=\"align_p\"> " . $donnees['titre'] . " </p>
                <form action=\"\" method=\"get\">
                <input type=\"hidden\" name=\"id_film\" value=\"" . $donnees['id_film'] . "\" />
                <input type=\"hidden\" name=\"id_membre\" value=\"" . $_GET['id_membre'] . "\" />
                <input type=\"hidden\" name=\"nom\" value=\"" . $_GET['nom'] . "\" />
                <input type=\"hidden\" name=\"prenom\" value=\"" . $_GET['prenom'] . "\" />
                <div class=\"row align_left\"><p class=\"bold align_p\">Vu le :</p>
                <input class=\"align_left\" type=\"date\" name=\"date\">
                <p class=\"bold align_p\">Un avis ?</p> <input class=\"align_left\" type=\"name\" name=\"avis\">
                <input class=\"align_left ajout_button\" type=\"submit\" value=\"Ajouter le film\" /></div>
                </form></div>
                </div><br />";
            }
        }
    }
}
else
{
    echo "<div class=\"no_result\">Aucun résultat trouvé...</div>";
    $pages = 1;
}
