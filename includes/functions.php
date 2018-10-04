<?php
if (isset($_GET['limit_page']))
{
    $limit = $_GET['limit_page'];
}
else
{
    $limit = 5;
}

//////////////////////////////////////////////////////////////////////////////////////
function create_link($limit)
{
    if (isset($_GET['page']))
    {
        $link = "&limit_page=" . $limit . "";
    }
    else
    {
        $link = "?limit_page=" . $limit . "";
    }
    if (isset($_GET['genre']))
    {
        $link .= "&genre=" . $_GET['genre'] . "";
    }
    if (isset($_GET['distrib']))
    {
        $link .= "&distrib=" . $_GET['distrib'] . "";
    }
    if (isset($_GET['search']))
    {
        $link .= "&search=" . $_GET['search'] . "";
    }
    if (isset($_GET['prenom']))
    {
        $link .= "&prenom=" . $_GET['prenom'] . "";
    }
    if (isset($_GET['nom']))
    {
        $link .= "&nom=" . $_GET['nom'] . "";
    }
    if (isset($_GET['id_perso']))
    {
        $link .= "&id_perso=" . $_GET['id_perso'] . "";
    }
    return $link;
}

//////////////////////////////////////////////////////////////////////////////////////
function create_input_hidden()
{
    $input = "";
    if (isset($_GET['search']))
    {
        $input .= "<input type=\"hidden\" name=\"search\" value=\"" . $_GET['search'] . "\"/>\n";
    }
    if (isset($_GET['prenom']))
    {
        $input .= "<input type=\"hidden\" name=\"prenom\" value=\"" . $_GET['prenom'] . "\"/>\n";
    }
    if (isset($_GET['nom']))
    {
        $input .= "<input type=\"hidden\" name=\"nom\" value=\"" . $_GET['nom'] . "\"/>\n";
    }
    if (isset($_GET['id_perso']))
    {
        $input .= "<input type=\"hidden\" name=\"id_perso\" value=\"" . $_GET['id_perso'] . "\"/>\n";
    }
    return $input;
}
