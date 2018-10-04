<?php
if (isset($_GET['limit_page']))
{
    $limit = $_GET['limit_page'];
}
else
{
    $limit = 5;
}
if (!isset($_GET['page']))
{
    $_GET['page'] = 1;
}
$i = 0;
$result = create_query_historique_membre($bdd);

echo "<div class=\"row justify-content-center\"><p class=\"bold\">" . $result->rowcount() . " résultats.</p></div>";

if ($result->rowcount() != 0)
{
    $new_limit = $_GET['page']*$limit;

    while (($donnees = $result->fetch()) && $i < $new_limit)
    {
        $i++;
        if ($i > $new_limit-$limit)
        {
            if ($donnees['avis'] === null || $donnees['avis'] === "")
            {
                    $donnees['avis'] = "Non comuniqué";
            }
            else
            {
                $donnees['avis'] = "\" " . $donnees['avis'] . "\" ";
            }
            echo "<div class=\"affichage\"><div class=\"row align_left\">
            <p class=\"bold\">" . $i . " <i class=\"material-icons\">&#xe54d;</i>
            Titre : </p><p class=\"align_p\"> " . $donnees['titre'] . " </p></div>
            <div class=\"row align_right\"><p class=\"bold align_p\">  Vu le : </p>
            <p class=\"align_p\">" . date("d/m/Y", strtotime($donnees['date'])) . "</p></div>
            <div class=\"row align_left\"><p class=\"bold align_p\">  Genre : </p>
            <p class=\"align_p\">" . ucfirst($donnees['nom']) . "</p></div>
            <div class=\"row align_left\"><p class=\"align_p\"><b>Avis :</b> " . $donnees['avis'] . "</p></div>
            </div><br />";
        }
    }
}
else
{
    echo "<div class=\"no_result\">Aucun résultat trouvé...</div>";
    $pages = 1;
}
