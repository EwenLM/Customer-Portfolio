<main>
<h2>Ajout de client</h2>

    <?php if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    } ?>

    <form action="./add" method="post">
        <label for="lastname">Nom</label>
        <input type="text" name="lastname">

        <label for="firstname">Prénom</label>
        <input type="text" name="firstname">

        <label for="address">Adresse</label>
        <input type="text" name="address">

        <label for="zip_code">Code Postal</label>
        <input type="text" name="zip_code">

        <label for="city">Ville</label>
        <input type="text" name="city">

        <label for="mobile">Mobile</label>
        <input type="text" name="mobile">

        <input type="submit" value="Ajouter" >
    </form>



</main>