<?php
function pagination($result, $limit)
{
    $pages = $result->rowcount()/$limit;
    if (!is_int($pages))
    {
        $pages = ceil($pages);
    }
    return $pages;
}

////////////////////////////////////////////////////////////////////////////
function affiche_min_pagination($page_actuel)
{
    if ($page_actuel > 3)
    {
        return $page_actuel - 3;
    }
    elseif ($page_actuel == 3)
    {
        return $page_actuel - 2;
    }
    elseif ($page_actuel == 2)
    {
        return $page_actuel - 1;
    }
    else
    {
        return $page_actuel;
    }
}

////////////////////////////////////////////////////////////////////////////
function affiche_max_pagination($page_actuel, $max_pages)
{
    if ($page_actuel < $max_pages - 2)
    {
        return $page_actuel + 3;
    }
    elseif ($page_actuel == $max_pages - 2)
    {
        return $page_actuel + 2;
    }
    elseif ($page_actuel == $max_pages - 1)
    {
        return $page_actuel + 1;
    }
    else
    {
        return $page_actuel;
    }
}

////////////////////////////////////////////////////////////////////////////
function pagi_early($min_p)
{
    if ($min_p > 1)
    {
        if ($min_p > 4)
        {
            $mini = 3;
        }
        else
        {
            $mini = $min_p-1;
        }
        return $mini;
    }
    return null;
}

////////////////////////////////////////////////////////////////////////////
function pagi_end($max_p, $total_pages)
{
    if ($max_p < $total_pages)
    {
        if ($max_p < $total_pages - 3)
        {
            echo "<li class=\"page-item\"><p class=\"page-link\">...</p></li>";
        }
        if ($total_pages == 5)
        {
            $tmp = $total_pages;
        }
        elseif ($total_pages == 4)
        {
            $tmp = $total_pages-1;
        }
        else
        {
            $tmp = $total_pages-2;
        }
        return $tmp;
    }
    return null;
}
