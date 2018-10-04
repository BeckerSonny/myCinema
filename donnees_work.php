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

if (!isset($_GET['page']))
{
    $_GET['page'] = 1;
}
$pages = pagination(create_query($bdd), $limit);
$new_limit = $_GET['page']*$limit;
$result = create_query($bdd);
while (($donnees = $result->fetch()) && $i < $new_limit)
{
    $i++;
    if ($i > $new_limit-$limit)
    {
        if ($donnees['annee_prod'] == 0)
        {
            $donnees['annee_prod'] = "Inconnue";
        }
        echo "<div class=\"affichage\"><div class=\"row align_left\">
        <p class=\"bold\">" . $i . " <i class=\"material-icons\">&#xe54d;</i>
         Titre : </p><p class=\"align_p\"> " . $donnees['titre'] . " </p></div>
        <div class=\"row align_right\"><p class=\"bold align_p\">  Genre : </p>
        <p class=\"align_p\">" . ucfirst($donnees['nom']) . "</p></div>
        <div class=\"row align_left\"><p class=\"bold\"> Année de prod : </p>
        <p class=\"align_left\">" . $donnees['annee_prod'] . "</p></div>
        <div class=\"resum\"><p class=\"bold\">Résumé : </p>" . $donnees['resum'] . "</div>
        </div><br />";
    }
}
