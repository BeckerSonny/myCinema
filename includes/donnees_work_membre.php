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

$result = create_query_membre($bdd);

if ($result != false)
{
    echo "<div class=\"row justify-content-center\"><p class=\"bold\">" . $result->rowcount() . " résultats.</p></div>";
    $new_limit = $_GET['page']*$limit;

    while (($donnees = $result->fetch()) && $i < $new_limit)
    {
        $i++;
        if ($i > $new_limit-$limit)
        {
            echo "<a class=\"link_membre\"
            href=\"info_membre.php?nom=" . $donnees['nom'] . "&prenom=" . $donnees['prenom'] . "\">
            <div class=\"affichage affichage_membre row justify-content-center\">
            <p class=\"bold\">" . ucfirst($donnees['nom']) . "</p>
            <p class='align_left'>" . ucfirst($donnees['prenom']) . "</div>
            </a><br />";
        }
    }
}
elseif ($result == false)
{
    echo "<div class=\"no_result\">Entrez nom et/ou prenom dans la barre de recherche.</div>";
}
