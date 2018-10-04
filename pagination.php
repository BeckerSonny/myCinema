<?php
include 'includes/functions_pagination.php';

if (isset($_GET['genre']))
{
    $genre = "&genre=".$_GET['genre'];
}
else
{
    $genre = "";
}

if (!isset($_GET['page']))
{
    $_GET['page'] = 1;
}

if ($_GET['page'] < 2)
{
    $previous = $_GET['page'];
}
else
{
    $previous = $_GET['page']-1;
}

$min_p = affiche_min_pagination($_GET['page']);
$max_p = affiche_max_pagination($_GET['page'], $pages);

echo "<li class=\"page-item\"><a class=\"page-link\"
href=\"?page=" . $previous . "&limit_page=" . $limit,$genre . "\">Previous</a></li>";

pagi_early($min_p, $limit, $genre);
for ($j=$min_p; $j <= $max_p; $j++)
{
    if ($j == $_GET['page'])
    {
        echo "<li class=\"page-item\">
        <a class=\"page-link page-actual\" href=\"?page=" . $j . "&limit_page=" . $limit,$genre . "\">" . $j . "</a></li>";
    }
    else
    {
        echo "<li class=\"page-item\">
        <a class=\"page-link\" href=\"?page=" . $j . "&limit_page=" . $limit,$genre . "\">" . $j . "</a></li>";
    }
}

if ($_GET['page'] > $pages-1)
{
    $next = $_GET['page'];
}
else
{
    $next = $_GET['page']+1;
}

echo "<li class=\"page-item\">
<a class=\"page-link\" href=\"?page=" . $next . "&limit_page=" . $limit,$genre . "\">Next</a></li>";
