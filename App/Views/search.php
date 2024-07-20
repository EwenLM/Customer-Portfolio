<h2>Recherche de client</h2>


<?php
if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    unset($_SESSION['results']);
} else {
    $results = [];
}
?>


<form action="./find" method="post">
    <input type="text" name="search" placeholder="Rechercher un utilisateur...">
    <input type="submit" value="Rechercher">
</form>


<h2>Résultats de la recherche</h2>


<?php if (empty($results)): ?>
    <p>Aucun client trouvé.</p>
<?php else: ?>
    <h3>Informations client</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Code Postal</th>
                <th>Ville</th>
                <th>Mobile</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $result) : ?>
                <tr>
                    <td><?= ($result['id_user']); ?></td>
                    <td><?= ($result['last_name']); ?></td>
                    <td><?= ($result['first_name']); ?></td>
                    <td><?= ($result['address']); ?></td>
                    <td><?= ($result['zip_code']); ?></td>
                    <td><?= ($result['city']); ?></td>
                    <td><?= ($result['mobile']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
     endif ?>

