<?php
include 'includes/functions_pagination.php';

if ($result != null)
{
    $pages = pagination($result, $limit);

    if ($pages > 1)
    {
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

        $action = create_link($limit);

        $min_p = affiche_min_pagination($_GET['page']);
        $max_p = affiche_max_pagination($_GET['page'], $pages);

        echo "<li class=\"page-item\">
        <a class=\"page-link\" href=\"?page=" . $previous, $action . "\">Previous
        </a></li>";

        $mini = pagi_early($min_p);

        if ($mini !== null)
        {
            for ($j=1; $j <= $mini; $j++)
            {
                echo "<li class=\"page-item\">
                    <a class=\"page-link\" href=\"?page=" . $j, $action . "\">" . $j . "
                    </a></li>";
            }
            if ($min_p > 4)
            {
                echo "<li class=\"page-item\"><p class=\"page-link\">...</p></li>";
            }
        }
        
        for ($j=$min_p; $j <= $max_p; $j++)
        {
            if ($j == $_GET['page'])
            {
                echo "<li class=\"page-item\">
                <a class=\"page-link page-actual\" href=\"?page=" . $j, $action . "\">" . $j . "
                </a></li>";
            }
            else
            {
                echo "<li class=\"page-item\">
                <a class=\"page-link\" href=\"?page=" . $j, $action . "\">" . $j . "
                </a></li>";
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
        $end = pagi_end($max_p, $pages);

        if ($end !== null)
        {
            for ($k=$end; $k <= $pages; $k++)
            {
                echo "<li class=\"page-item\">
                <a class=\"page-link\" href=\"?page=" . $k, $action . "\">" . $k . "
                </a></li>";
            }
        }
        
        echo "<li class=\"page-item\">
        <a class=\"page-link\" href=\"?page=" . $next, $action . "\">Next
        </a></li>";
    }
}
