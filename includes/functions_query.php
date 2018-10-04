<?php

function create_query_historique($bdd)
{
    $query = ' SELECT film.titre, film.resum, film.date_debut_affiche,
    film.date_fin_affiche, film.annee_prod, film.id_film,
    genre.nom, distrib.nom FROM film
    LEFT JOIN distrib ON film.id_distrib = distrib.id_distrib
    LEFT JOIN genre ON film.id_genre = genre.id_genre';

    if (isset($_GET['genre']) && isset($_GET['distrib']))
    {
        $query .= query_historique_conditions();
    }
    if (isset($_GET['search']) && $_GET['search'] != "")
    {
        if ((isset($_GET['genre']) && $_GET['genre'] != "" )||(isset($_GET['distrib']) && $_GET['distrib'] != ""))
        {
            $query .= ' AND film.titre LIKE \'%' . $_GET['search'] . '%\'';
        }
        else
        {
            $query .= ' WHERE film.titre LIKE \'%' . $_GET['search'] . '%\'';
        }
    }
    $query .= ' ORDER BY film.titre;';
    return $bdd->query($query);
}

////////////////////////////////////////////////////////////////////////////
function query_historique_conditions()
{
    if ($_GET['genre'] != "" && $_GET['distrib'] != "")
    {
        return ' WHERE film.id_distrib = ' . $_GET['distrib'] . '
        AND film.id_genre = ' . $_GET['genre'];
    }
    elseif ($_GET['genre'] != "")
    {
        return ' WHERE film.id_genre = ' . $_GET['genre'];
    }
    elseif ($_GET['distrib'] != "")
    {
        return ' WHERE film.id_distrib = ' . $_GET['distrib'];
    }
    else
    {
        return "";
    }
}
////////////////////////////////////////////////////////////////////////////
function create_query_membre($bdd)
{
    if (isset($_GET['search']))
    {
        if (strpos($_GET['search'], " ") !== false)
        {
            $arr = explode(" ", $_GET['search']);
        
            return $bdd->query('SELECT * FROM fiche_personne
            WHERE nom LIKE \'%' . $arr[0] . '%\'
            OR prenom LIKE \'%' . $arr[1] . '%\'
            ORDER BY nom');
        }
    
        else
        {
            return $bdd->query('SELECT * FROM fiche_personne
            WHERE nom LIKE \'%' . $_GET['search'] . '%\'
            OR prenom LIKE \'%' . $_GET['search'] . '%\'
            ORDER BY nom');
        }
    }
}

////////////////////////////////////////////////////////////////////////////
function create_query_info_membre($bdd)
{
    if (isset($_GET['prenom']) && isset($_GET['nom']))
    {
        return $bdd->query('SELECT * FROM fiche_personne AS fp
        INNER JOIN membre ON fp.id_perso = membre.id_fiche_perso
        INNER JOIN abonnement ON membre.id_abo = abonnement.id_abo
        WHERE fp.nom = \'' . $_GET['nom'] . '\'
        AND fp.prenom = \'' . $_GET['prenom'] . '\';');
    }
    else
    {
        return false;
    }
}

////////////////////////////////////////////////////////////////////////////
function create_query_historique_membre($bdd)
{
    $query = 'SELECT film.titre, genre.nom, hm.date, hm.avis FROM film
    INNER JOIN genre ON film.id_genre = genre.id_genre
    INNER JOIN historique_membre AS hm ON film.id_film = hm.id_film
    INNER JOIN membre ON hm.id_membre = membre.id_membre
    INNER JOIN fiche_personne AS fp ON membre.id_fiche_perso = fp.id_perso
    WHERE fp.id_perso = \'' . $_GET['id_perso'] . '\'';
    
    if (isset($GET['genre']))
    {
        $query.=' AND film.genre = ' . $_GET['genre'];
    }
    $query .= ' ORDER BY hm.date DESC;';
    return $bdd->query($query);
}
