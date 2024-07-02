<h2>Recherche de client</h2>

<form action="../user/find" method="post">
    <label for="userSearch">Saisir l'id ou le nom du client recherché</label>
    <input type="text" id="userSearch" name="search">
    <input type="submit" value="Rechercher">
</form>


<h2>Résultats de la recherche</h2>


<?php if (!empty($_SESSION['results'])) :
    $results = $_SESSION['results'] ?>
    <ul>
        <?php foreach ($results as $user) : ?>
            <li>ID: <?= $user['id']; ?></li>
            <hr>
            <li>Nom: <?=$user['lastname'];  ?></li>
            <hr>
            <li>Prénom: <?= $user['firstname']; ?></li>
            <hr>
            <li>Address:</Address> <?= $user['address']; ?></li>
            <li>Ville: <?= $user['city']; ?></li>
            <li>Code Postal: <?= $user['zip_code']; ?></li>

        <?php endforeach; ?>
    </ul>
<?php 
unset($_SESSION['results']);
else : ?>
    <p>Aucun résultat trouvé.</p>
<?php endif; ?>

