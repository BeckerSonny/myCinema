<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=epitech_tp;charset=utf8', 'root', '123987');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo "<p class=\"bdd\">ECHEC Connection : " . $e->getMessage() . "<p>";
}
