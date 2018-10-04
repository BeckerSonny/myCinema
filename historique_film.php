<?php
include 'includes/menu.php';
?>

<div class="div_body">
    <div class="container">
        <h2 class="row justify-content-center titre_2">Historique films</h2>
        <div class="row justify-content-center">
            <div class="filters row">
                <form action="" method="get">
                    <?php
                        echo create_input_hidden();
                    ?>
                    <label for="genre">Genres :</label>
                    <select name="genre">
                        <?php
                        $genre = $bdd->query('SELECT * FROM genre ORDER BY nom');
                        echo "<option value=\"\">Genre</option>";
                        while ($genres = $genre->fetch())
                        {
                            echo "<option value=\"" . $genres["id_genre"] . "\">" . ucfirst($genres['nom']) . "</option>";
                        }
                        ?>
                    </select>
                    <label for="distrib">Distributeurs :</label>
                    <select name="distrib">
                        <?php
                        $genre = $bdd->query('SELECT * FROM distrib ORDER BY nom');
                        echo "<option value=\"\">Distributeur</option>";
                        while ($genres = $genre->fetch())
                        {
                            echo "<option value=\"" . $genres["id_distrib"] . "\">" . ucfirst($genres['nom']) . "</option>";
                        }
                        ?>
                    </select>
                    <label for="limit_page">Nombres de résultats par page :</label>
                    <select name="limit_page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                    </select>
                    <input type="submit" value="Filtrer">
                </div>
                </form>
                <div class="w-100"></div>
                <form class="input_reset" action="" method="get">
                    <input type="submit" value ="Reset filtres et recherche">
                </form>
            <div class="w-100"></div>
            <div class="all_donnees">
                <?php
                    include 'includes/donnees_work_historique.php';
                ?>
            </div>
        </div>
        <nav aria-label="Pagination">
        <ul class="pagination justify-content-center">
            <?php
                include 'includes/pagination.php';
            ?>
        </ul>
        </nav>
    </div>
</div>
<?php
include 'includes/footer.php';
?>