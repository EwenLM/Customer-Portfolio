<?php require 'header.php';

$userSession = $_SESSION['userSession'];

?>


<section class="relative">
    <!-- Bannière pour les écrans desktop -->
    <img src="Assets/Images/banniere.png" alt="route" class="w-full hidden md:block  md:max-h-[150px]  object-cover">

    <!-- Titre centré dans la bannière -->
    <h1 class="text-white text-center text-5xl font-bold mb-4 absolute inset-0 flex items-center justify-center hidden md:flex">Mon profil</h1>

    <!-- Titre pour les écrans mobiles -->
    <h1 class="text-gdt text-center text-5xl mb-4 md:hidden">Mon profil</h1>
</section>


<div class="min-h-[700px] flex flex-col justify-center items-center relative">
    <div class="h-1/2 w-full bg-gdt absolute top-0"></div>
    <div class="h-1/2 w-full bg-white absolute bottom-0"></div>

    <div class="relative z-10 bg-white rounded-lg p-8 flex flex-col items-start mt-16">
        <div class="flex flex-row items-center mb-4">
            <ul class="text-lg items-center">
                <li>Nom : <?= $userSession['last_name'] ?></li>
                <hr class="border-t-2 border-gdt mb-2">
                <li>Prénom : <?= $userSession['first_name'] ?></li>
                <hr class="border-t-2 border-gdt mb-2">
                <li>Voiture(s) :
                    <ul>
                        <li></li>
                    </ul>
                </li>
                <hr class="border-t-2 border-gdt mb-2">
                <li>Téléphone : <?= $userSession['mobile']  ?></li>
                <hr class="border-t-2 border-gdt mb-2">
                <li>Ville : Vannes</li>
                <hr class="border-t-2 border-gdt mb-2">
                <li>E-mail : <?= $userSession['mail'] ?> </li>
                <hr class="border-t-2 border-gdt mb-2">
                <button onclick="toggleProfileModal()" class="bg-gdt text-white rounded-full px-4 py-2 mt-2 transition hover:bg-green-600 duration-200">Modifier
                    mon profil</button>
            </ul>
        </div>

        <div class="flex w-full mt-4 items-center">
            <form action="#" method="post" class="w-1/2">
                <input type="hidden" name="userId" value="">
                <input type="submit" name="action" value="Supprimer mon compte" class="bg-red-500 text-white rounded-full w-full h-10 flex items-center justify-center cursor-pointer transition hover:bg-red-700 duration-200">
            </form>
            <button onclick="toggleModal()" class="bg-gdt text-white px-4 py-2 rounded-full ml-4 w-1/2 transition hover:bg-green-600 duration-200">Ajouter ma
                voiture</button>
        </div>
    </div>
</div>

<!-- Boîte modale (initialement cachée) -->
<div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-20">
    <div class="bg-white p-8 rounded-lg z-30 max-h-[500px] w-1/2 overflow-auto">
        <form action="/car/add" method="post">
            <h2 class="text-xl mb-4">Ajouter une voiture</h2>
            <label for="model">Modèle :</label>
            <input type="text" id="model" name="model" class="border-2 border-gray-300 rounded-lg p-2 mb-4 w-full">
            <label for="marque">Marque :</label>
            <input type="text" id="marque" name="brand" class="border-2 border-gray-300 rounded-lg p-2 mb-4 w-full">
            <label for="place">Nombre de place :</label>
            <input type="number" min="0" id="place" name="number_seat" class="border-2 border-gray-300 rounded-lg p-2 mb-4 w-full">
            <label for="couleur">Couleur :</label>
            <input type="text" id="couleur" name="color" class="border-2 border-gray-300 rounded-lg p-2 mb-4 w-full">
            <div class="flex justify-end">
                <button type="button" onclick="toggleModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</button>
                <input type="submit" value="Ajouter" class="bg-gdt text-white px-4 py-2 rounded cursor-pointer transition hover:bg-green-600 duration-200">
            </div>
        </form>
    </div>
</div>


<div id="profileModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-20">
    <div class="bg-white p-8 rounded-lg z-30 overflow-auto max-h-[500px] w-1/2 border-gdt">
        <?php if (isset($_SESSION["idUser"])) :
            $idUser = $_SESSION['idUser'] ?>
            <form action="/user/<?= $idUser ?>/update" method="post">
            <?php endif; ?>

            <h2 class="text-xl mb-4">Modifier le profil</h2>

            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone" placeholder="<?php $_SESSION['mobile'] ?>" class="border-2 border-gray-300 rounded-lg p-2 mb-4 w-full">
            <label for="email">E-mail :</label>
            <input type="email" id="email" name="email" class="border-2 border-gray-300 rounded-lg p-2 mb-4 w-full">
            <label for="postal">Code postal :</label>
            <input type="text" id="postal" name="postal" class="border-2 border-gray-300 rounded-lg p-2 mb-4 w-full">
            <label for="ville">Ville :</label>
            <input type="text" id="ville" name="ville" class="border-2 border-gray-300 rounded-lg p-2 mb-4 w-full">

            <div class="flex justify-end">
                <button type="button" onclick="toggleProfileModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</button>
                <input type="submit" value="Enregistrer" class="bg-gdt text-white px-4 py-2 rounded cursor-pointer">
            </div>
            </form>
    </div>
</div>
<!-- Nouvelle section pour les trajets et l'historique -->
<div class="bg-gdt p-8 mt-8 w-full md:w-3/4 mx-auto rounded-lg">
    <div class="flex justify-around items-center mb-6">
        <h2 class="text-white text-3xl font-bold">Prochain Trajet</h2>
        <h2 class="text-white text-3xl font-bold">Historique</h2>
    </div>
    <div class="flex flex-wrap justify-between gap-4">
        <!-- Section Prochain trajet -->
        <div class="bg-white rounded-lg p-4 w-full md:w-[48%]">
            <div class="border-b-2 border-gdt mb-4">
                <p class="text-gray-800">Voyage</p>
            </div>
            <div class="border-b-2 border-gdt mb-4">
                <p class="text-gray-800">Heure de départ</p>
            </div>
            <div class="border-b-2 border-gdt mb-4">
                <p class="text-gray-800">Date</p>
            </div>
            <button onclick="toggleTripsModal()" class="bg-gdt text-white px-4 py-2 rounded-full cursor-pointer transition hover:bg-green-600 duration-200">Plus de trajets</button>
            <button onclick="toggleTripDetailsModal()" class="bg-gdt text-white px-4 py-2 rounded-full cursor-pointer transition hover:bg-green-600 duration-200">Détails</button>
        </div>

        <!-- Section Historique -->
        <div class="bg-white  rounded-lg p-4 w-full md:w-[48%] overflow-auto ">
            <table class="w-full">
                <tbody>
                    <tr class="border-b-2 border-gdt mb-4">
                        <td class="text-gray-800">Départ 1</td>
                        <td class="text-gray-800">Arrivée 1</td>
                        <td class="text-gray-800">Heure de départ</td>
                        <td class="text-gray-800">Heure d'arrivée</td>
                        <td class="text-gray-800">Date</td>
                    </tr>
                    <tr class="border-b-2 border-gdt mb-4">
                        <td class="text-gray-800">Départ 2</td>
                        <td class="text-gray-800">Arrivée 2</td>
                        <td class="text-gray-800">Heure de départ</td>
                        <td class="text-gray-800">Heure d'arrivée</td>
                        <td class="text-gray-800">Date</td>
                    </tr>
                    <tr class="border-b-2 border-gdt mb-4">
                        <td class="text-gray-800">Départ 3</td>
                        <td class="text-gray-800">Arrivée 3</td>
                        <td class="text-gray-800">Heure de départ</td>
                        <td class="text-gray-800">Heure d'arrivée</td>
                        <td class="text-gray-800">Date</td>
                    </tr>
                    <tr class="border-b-2 border-gdt mb-4">
                        <td class="text-gray-800">Départ 4</td>
                        <td class="text-gray-800">Arrivée 4</td>
                        <td class="text-gray-800">Heure de départ</td>
                        <td class="text-gray-800">Heure d'arrivée</td>
                        <td class="text-gray-800">Date</td>
                    </tr>
                </tbody>
            </table>
            <button onclick="toggleHistoryModal()" class="bg-gdt text-white px-4 py-2 mt-4 rounded-full cursor-pointer transition hover:bg-green-600 duration-200">Voir plus</button>
        </div>
    </div>
</div>


<!-- Modale pour "Plus de trajets" -->
<div id="tripsModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-20">
    <div class="bg-white p-8 rounded-lg w-3/4 lg:w-2/3 xl:w-1/2 z-30 max-h-[500px] overflow-auto">
        <h2 class="text-xl mb-4">Mes trajets</h2>
        <div class="border-b-4 border-gdt mb-4">
            <p class="text-gray-800">Voyage 1</p>
            <p class="text-gray-800">Heure de départ</p>
            <p class="text-gray-800 mb-2">Date</p>
            <!-- Bouton pour ouvrir la modale des détails du trajet -->
            <button onclick="toggleTripDetailsModal()" class="bg-gdt text-white px-4 py-2 mb-3 rounded-full cursor-pointer transition hover:bg-green-600 duration-200">Voir détails</button>
        </div>
        <div class="border-b-4 border-gdt mb-4">
            <p class="text-gray-800">Voyage 2</p>
            <p class="text-gray-800">Heure de départ</p>
            <p class="text-gray-800 mb-2">Date</p>
            <!-- Bouton pour ouvrir la modale des détails du trajet -->
            <button onclick="toggleTripDetailsModal()" class="bg-gdt text-white px-4 py-2 mb-3 rounded-full cursor-pointer transition hover:bg-green-600 duration-200">Voir détails</button>
        </div>
        <div class="border-b-4 border-gdt mb-4">
            <p class="text-gray-800">Voyage 3</p>
            <p class="text-gray-800">Heure de départ</p>
            <p class="text-gray-800 mb-2">Date</p>
            <!-- Bouton pour ouvrir la modale des détails du trajet -->
            <button onclick="toggleTripDetailsModal()" class="bg-gdt text-white px-4 py-2 mb-3 rounded-full cursor-pointer transition hover:bg-green-600 duration-200">Voir détails</button>
        </div>
        <div class="border-b-4 border-gdt mb-4">
            <p class="text-gray-800">Voyage 3</p>
            <p class="text-gray-800">Heure de départ</p>
            <p class="text-gray-800 mb-2">Date</p>
            <!-- Bouton pour ouvrir la modale des détails du trajet -->
            <button onclick="toggleTripDetailsModal()" class="bg-gdt text-white px-4 py-2 mb-3 rounded-full cursor-pointer transition hover:bg-green-600 duration-200">Voir détails</button>
        </div>
        <div class="border-b-4 border-gdt mb-4">
            <p class="text-gray-800">Voyage 3</p>
            <p class="text-gray-800">Heure de départ</p>
            <p class="text-gray-800 mb-2">Date</p>
            <!-- Bouton pour ouvrir la modale des détails du trajet -->
            <button onclick="toggleTripDetailsModal()" class="bg-gdt text-white px-4 py-2 mb-3 rounded-full cursor-pointer transition hover:bg-green-600 duration-200">Voir détails</button>
        </div>
        <div class="border-b-4 border-gdt mb-4">
            <p class="text-gray-800">Voyage 3</p>
            <p class="text-gray-800">Heure de départ</p>
            <p class="text-gray-800 mb-2">Date</p>
            <!-- Bouton pour ouvrir la modale des détails du trajet -->
            <button onclick="toggleTripDetailsModal()" class="bg-gdt text-white px-4 py-2 mb-3 rounded-full cursor-pointer transition hover:bg-green-600 duration-200">Voir détails</button>
        </div>
        <div class="flex justify-end">
            <button type="button" onclick="toggleTripsModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Fermer</button>
        </div>
    </div>
</div>

<!-- Modale pour "Voir plus" de l'historique -->
<div id="historyModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-20">
    <div class="bg-white p-8 rounded-lg w-3/4 lg:w-2/3 xl:w-1/2 z-30 max-h-[500px]">
        <h2 class="text-xl mb-4">Historique des trajets</h2>
        <table class="w-full">
            <tbody>
                <tr class="border-b-2 border-gdt mb-4">
                    <td class="text-gray-800">Départ 1</td>
                    <td class="text-gray-800">Arrivée 1</td>
                    <td class="text-gray-800">Heure de départ</td>
                    <td class="text-gray-800">Heure d'arrivée</td>
                    <td class="text-gray-800">Date</td>
                </tr>
                <tr class="border-b-2 border-gdt mb-4">
                    <td class="text-gray-800">Départ 2</td>
                    <td class="text-gray-800">Arrivée 2</td>
                    <td class="text-gray-800">Heure de départ</td>
                    <td class="text-gray-800">Heure d'arrivée</td>
                    <td class="text-gray-800">Date</td>
                </tr>
                <tr class="border-b-2 border-gdt mb-4">
                    <td class="text-gray-800">Départ 3</td>
                    <td class="text-gray-800">Arrivée 3</td>
                    <td class="text-gray-800">Heure de départ</td>
                    <td class="text-gray-800">Heure d'arrivée</td>
                    <td class="text-gray-800">Date</td>
                </tr>
                <tr class="border-b-2 border-gdt mb-4">
                    <td class="text-gray-800">Départ 4</td>
                    <td class="text-gray-800">Arrivée 4</td>
                    <td class="text-gray-800">Heure de départ</td>
                    <td class="text-gray-800">Heure d'arrivée</td>
                    <td class="text-gray-800">Date</td>
                </tr>
                <tr class="border-b-2 border-gdt mb-4">
                    <td class="text-gray-800">Départ 1</td>
                    <td class="text-gray-800">Arrivée 1</td>
                    <td class="text-gray-800">Heure de départ</td>
                    <td class="text-gray-800">Heure d'arrivée</td>
                    <td class="text-gray-800">Date</td>
                </tr>
                <tr class="border-b-2 border-gdt mb-4">
                    <td class="text-gray-800">Départ 2</td>
                    <td class="text-gray-800">Arrivée 2</td>
                    <td class="text-gray-800">Heure de départ</td>
                    <td class="text-gray-800">Heure d'arrivée</td>
                    <td class="text-gray-800">Date</td>
                </tr>
                <tr class="border-b-2 border-gdt mb-4">
                    <td class="text-gray-800">Départ 3</td>
                    <td class="text-gray-800">Arrivée 3</td>
                    <td class="text-gray-800">Heure de départ</td>
                    <td class="text-gray-800">Heure d'arrivée</td>
                    <td class="text-gray-800">Date</td>
                </tr>
                <tr class="border-b-2 border-gdt mb-4">
                    <td class="text-gray-800">Départ 4</td>
                    <td class="text-gray-800">Arrivée 4</td>
                    <td class="text-gray-800">Heure de départ</td>
                    <td class="text-gray-800">Heure d'arrivée</td>
                    <td class="text-gray-800">Date</td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-end mt-4">
            <button type="button" onclick="toggleHistoryModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Fermer</button>
        </div>
    </div>
</div>


<!-- Modale pour afficher les détails d'un trajet -->
<div id="tripDetailsModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-20">
    <div class="bg-white p-8 rounded-lg w-3/4 lg:w-2/3 xl:w-1/2 z-30 overflow-auto max-h-[500px] ">
        <h2 class="text-xl mb-4 text-center">Détails du trajet</h2>
        <div class="flex flex-col items-center mb-6">
            <h3 class="text-lg font-semibold mb-2">Mercredi 05 juin</h3>
            <p class="text-gray-800">8h15 - 2 rue Ampère, 56000 Vannes</p>
            <p class="text-gray-800">à</p>
            <p class="text-gray-800">8h20 - Greta, 56000 Vannes</p>
        </div>
        <div class="flex items-center mb-6">
            <div class="flex-shrink-0 mr-4 mb-5">
                <img src="Assets/Images/avatar.jpg" alt="Photo de la voiture" class="w-16 h-16 rounded-full">
            </div>
            <div>
                <p class="text-lg font-semibold">Boeraeve Antoine</p>
                <p class="text-gray-800">Dacia Sandero noir</p>
            </div>
        </div>
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Passagers</h3>
            <div class="flex items-center mb-2">
                <div class="flex-shrink-0 mr-4">
                    <img src="Assets/Images/avatar.jpg" alt="Photo du passager" class="w-12 h-12 rounded-full mr-5 mb-5">
                </div>
                <p class="text-gray-800">Nom et prénom du passager 1</p>
            </div>
            <div class="flex items-center mb-2">
                <div class="flex-shrink-0 mr-4">
                    <img src="Assets/Images/avatar.jpg" alt="Photo du passager" class="w-12 h-12 rounded-full mr-5 mb-5">
                </div>
                <p class="text-gray-800">Nom et prénom du passager 2</p>
            </div>
            <div class="flex items-center">
                <div class="flex-shrink-0 mr-4">
                    <img src="Assets/Images/avatar.jpg" alt="Photo du passager" class="w-12 h-12 rounded-full mr-5 mb-5">
                </div>
                <p class="text-gray-800">Nom et prénom du passager 3</p>
            </div>
        </div>
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Messages</h3>
            <div class="mb-2">
                <p class="text-gray-800">Message 1</p>
            </div>
            <hr class="border-2 border-gdt mb-2">
            <div class="mb-2">
                <p class="text-gray-800">Message 2</p>
            </div>
            <hr class="border-2 border-gdt mb-2">

        </div>
        <form>
            <textarea class="w-full h-24 border border-gray-300 rounded-lg mb-4" placeholder="Votre message"></textarea>
            <button type="submit" class="bg-gdt text-white px-4 py-2 rounded-full cursor-pointer transition hover:bg-green-600 duration-200">Envoyer</button>
        </form>
        <div class="flex justify-end mt-4">
            <button type="button" onclick="toggleTripDetailsModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Fermer</button>
        </div>
    </div>
</div>


<?php require RACINE . '/App/Views/Footer.php' ?>