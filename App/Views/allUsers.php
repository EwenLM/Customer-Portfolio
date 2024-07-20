<main>

<?php
if (isset($_SESSION['users'])) {
    $users = $_SESSION['users'];
    
} else {
}
?>
<?php if (empty($users)): ?>
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
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= ($user['id_user']); ?></td>
                    <td><?= ($user['lastname']); ?></td>
                    <td><?= ($user['firstname']); ?></td>
                    <td><?= ($user['address']); ?></td>
                    <td><?= ($user['zip_code']); ?></td>
                    <td><?= ($user['city']); ?></td>
                    <td><?= ($user['mobile']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
     endif ?>

</main>