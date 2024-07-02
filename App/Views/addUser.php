<?php require 'header.php'; ?>


<form action="../user/add" method="post">

    <h3>Ajout de client</h3>
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="last_name" >
    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="first_name" >
    <label for="telephone">Adresse</label>
    <input type="text" id="adresse" name="address" >
    <label for="zip_code">Code Postal</label>
    <input type="text" id="zip_code" name="zip_code" >
    <label for="city">Ville</label>
    <input type="text" id="city" name="city" >
    <label for="telephone">Téléphone</label>
    <input type="text" id="telephone" name="mobile" >

    <input type="submit" value="Ajouter" >

</form>

<ul>
    <li><a href="./users">Consulter les fiches clients</a></li>
    <li><a href="./user/search">Rechercher un client</a></li>
    <li><a href="./user/add">Ajouter un client</a></li>
    <li><a href="../home">Retour à la page d'accueil</a></li>
</ul>


<?php
require 'footer.php';
?>