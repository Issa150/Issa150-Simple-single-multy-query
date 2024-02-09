<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premier site en PHP : site avec la BDD entreprise">
    <meta name="author" content="Sahar ferchichi">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>CRUD - entreprise</title>
</head>

<body>
    <header>
        <div class="p-5 mb-4" style="background-color: #EEA545">
            <section class="container py-5">
                <h1 class="fw-bold">CRUD</h1>
                <p class="col-md-8 fs-4">Dans cette page on vas réaliser un CRUD complet, on va utiliser la BDD entreprise</p>

            </section>

        </div>
    </header>
    <main class="container">
        <?php
        function debug($var)
        {
            echo '<pre class= "border border-dark bg-light text-primary w-50 p-3 ">';
            var_dump($var);
            echo '</pre>';
        };


        ?>

        <h2 class="text-danger my=5">1- Connexion à la BDD</h2>


        <?php

        ////////////////////////////Connexion à la BDD//////////
        /**
         * *On vas utiliser l'extension PHP Data Object (PDO), elle définit une exellente interface pour acceder à une base de données depuis PHP et  d'executer des requetes SQL.
         * Pour  se connecter à la BDD avec PDO, il faut créer une instance de cet Objet (PDO) qui représente une connexion à la BDD, pour cela il faut se servir du constructeur de la clase
         * e constructeur demande certains paramétres
         */

        //$pdo = new PDO("mysql:host=localhost; dbname=entreprise;charset=utf8", "root", "");
        // On deéclare des constantes d'environnement qui vont contenir les informations à la connexion à la  BDD

        // Constante de serveur => Localhost
        define("DBHOST", "localhost");
        // Constante de l'utilisateur de la BDD du serveur local => root
        define('DBUSER', 'root');
        // Constante pour le mot passe de serveur en local => pas de mot passe
        define("DBPASS", "");
        //Constante pour le nom de la BDD
        define("DBNAME", "entreprise");

        // DSN (data Source Name)
        $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";

        try { // dans le try on va instancier PDO, c'est créer un objet de la class PDO

            $pdo = new PDO($dsn, DBUSER, DBPASS);



            // On définit le mode d'erreur de PDO sur Exeption
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


            // $methods = get_class_methods('PDO');

            // debug($methods);

            echo "Je suis conectée";
        } catch (PDOException $e) {   // PDDException est une classe qui représente une erreur émise pas PDO et $e c'est l'objet de la classe en question qui vas stocker cette erreur;

            die($e->getMessage()); // die permet  d'arrêter le PHP et d'afficher une erreur en utilisant  la methode getMessage  de l'objet $e


        } // le catch sera execute dés lors on auras un probléme dans le try



        ?>

        <h2 class="text-danger my-5">2- Requéte d'insertion</h2>

        <?php
        ////////////////// Requéte d'insertion ///////////////////////////////

        // On va insérer un employé en BDD : La méthode exec() éxecute une requête  SQL et re

        // $request = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire)VALUE('Assia', 'Bechichi', 'f' , 'informatique','2024-01-25', 3200)");

        // debug($request);

        // echo "Employe Assia est bien inserer dans la BDD";
        ?>


        <h2 class="text-danger my-5">3- Requete de suppression</h2>

        <?php
        /////////////////////Requete de suppression/////////////////////
        //supprimer Assia de la BB

        // $request = $pdo->exec("DELETE FROM employes WHERE prenom = 'Assia'");
        // echo "Employe Assia est bien suprime de la BDD entreprise";
        // 
        ?>
        <?php
        ///////////////Requete d'affichage///////////////

        // On va utiliser la méthode query() : au contraire d' exec(), query() est utilisé pour faire des requétes qui retournent un ou plusieurs résultats : SELECT. On peut aussi l'utiliser avec INSERT, DELETE, UPDATE

        /**
         * Valeur de retour ;
         *      succés : query() retourne un nouvel objet de la classe PDOStatement 
         *      echec : False 
         */

        ////////////// Récuperation et affichage d'une seul donnée de la BDD //////////////////

        // On va selectionner les informations de l'employé "Daniel"

        // $request = $pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel'");

        // debug($request);

        // debug($request->rowCount());


        // $employe = $request->fetch();
        // debug($employe);

        echo "////////////////// <br>";


        // $request2 = $pdo->query("SELECT * FROM employes WHERE id_employes = 417");

        // $employe2=  $request2->fetch();
        // echo $employe2["prenom"];

        //////////////////////////

        $request = $pdo->query("SELECT * FROM employes");
        // debug($request->rowCount());
        $employes = $request->fetch();
        echo '<div class="row">';
        while ($employes = $request->fetch()) {
            echo '<div class="col-sm-12 col-md-3">';
            echo "<div>id_employes : $employes[id_employes]</div>";
            echo "<div>Nom et Prénom : $employes[nom] $employes[prenom]</div>";
            echo "<div>Le service : $employes[service]</div>";
            echo "<div>le salaire : $employes[salaire]e</div>";
            echo "<hr>";
            echo '</div>';
        }
        echo '</div>';


        //////////////////////
        //Afichez la liste des differents service dans une liste, en en mettant un service en <li>

        $request = $pdo->query("SELECT DISTINCT service FROM employes");

        echo "<ol>";
        while ($services =  $request->fetch()) {
            echo "<li>le Service: $services[service] </li>";
        }
        echo "</ol>";
        ?>

        <?php
        $request = $pdo->query("SELECT DISTINCT salaire FROM employes ORDER BY salaire DESC");
        debug($request->rowCount());
        $salaires = $request->fetchAll();
        debug($salaires);

        echo "<ul>";
        foreach ($salaires as $key => $value) {
            echo "<li>$value[salaire]</li>";
            //echo "<li>{$salaires[$key]['salaire']}</li>";
        }
        echo "</ul>";



        // Vous affichez les employés femmes et qui gagnent un salaire supèrieur ou égal à 2000€

        $request = $pdo->query("SELECT * FROM employes WHERE sexe = 'f' AND salaire >= 2000");
        // debug($request->rowCount());
        $femmes = $request->fetchAll();
        echo "<ul>";
        foreach ($femmes as $personne) {
            echo "<li>$personne[prenom]: $personne[salaire]</li>";
        }
        echo "</ul>";



        // Afficheez les resultat de la requete dans une table HTML ddemoche a partire 2010-01-01
        $requete = $pdo->query("SELECT * FROM employes WHERE date_embauche >= '2010-01-01'");
        $donnes = $requete->fetch();

        echo "<table class='table w-50 m-auto table-success table-striped table-hover'>
        <thead class='table-header'>
        <tr >
            <th scope='col'>Id</th>
            <th scope='col'>prenome</th>
            <th scope='col'>nom</th>
            <th scope='col'>Sexe</th>
            <th scope='col'>Salaire</th>
        <th scope='col'>Date d'embauche</th>
      </tr>
    </thead>
    <tbody>";

        while ($donnes = $requete->fetch()) {
            $date = date('d-m-Y', strtotime($donnes["date_embauche"]));
            echo "<tr>
        <td>$donnes[id_employes]</td>
        <td>$donnes[prenom]</td>
        <td>$donnes[nom]</td>
        <td>" . (($donnes['sexe'] == 'f') ? 'Femmee' : 'Homme') . "</td>
        <td>$donnes[salaire]</td>
        <td>$date</td>
        </tr>";
        }


        echo "</tbody></table>";
        /////////////////////////////////////////////////////////

        //on va augmenter le salaire de Julien de 100$
        // $request = $pdo->exec("UPDATE employes SET salaire = salaire + 100 WHERE prenom = 'Julien'");
        // debug($request );
        echo "<p class='alert alert-secondary'> Le salaire de Julien est augmenté à 100$</p>";
        //////////////////////////////////////////////////////////////////////////////

        // On peut faire la même chose avec un query, On va diminuer le salaire l'employe qui  l'id 350 

        // $request = $pdo->query("UPDATE employes SET salaire = salaire - 200 WHERE id_employes = 350");
        // debug($request->rowCount());

        //////////////////////////////////////////////////////////////////////////////

        // Prepare 
        $request = $pdo->prepare("SELECT * employes WHERE prenom = :prenom");
        $prenom = "Damien";
        $request->bindParam(':prenom', $prenom);
        // "bind" accept pas une valeur fix! ça doit être une variable!

        ////////////////////////////////:
        $request = $pdo->prepare("SELECT * FROM employes WHERE prenom = :prenom AND nom = :nom");
        $request->execute(
            array(
                ':prenom' => 'Julien',
                ':nom' => 'Cottet'
            )
        );
        $empoye = $request->fetch();
        debug($empoye);
        ////////////////////////////////////////////////////////////////::
        // Autre façon
        $request = $pdo->prepare("SELECT * FROM employes WHERE sexe = ? AND service = ?");
        $sexe = 'f';
        $services = 'commercial';
        $request->execute(array($sexe, $services));
        $numRows = $request->rowCount();
        echo "Number of rows retrieved: " . $numRows;

        while($employe = $request->fetch()){
            echo "<p class='alert alert-success'>L'employé $employe[prenom] de sexe $employe[sexe] travaile dans le service commercial.</p>";
        }


        ////////////////////////////////////:
        echo "<h3 class='mt-5'>Insertion en utilisant les requêtes prépérées et les marqueurs</h3>";

        // $request = $pdo->prepare("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire)
        //                                         VALUES (:prenom, :nom, :sexe, :service,:date_embauche, :salaire)");
        // $request->execute(array(
        //         ':prenom'=>'Julius',
        //         ':nom'=>'TOLO',
        //         ':sexe'=>'m',
        //         ':service' =>'commercial',
        //         ':date_embauche' =>'2023-12-16',
        //         ':salaire' => 2450
        // ));

        // debug($employe = $request->fetch());
// Modification du salaire de l'employé Juluis
        $request = $pdo->prepare("UPDATE employes SET salaire = :salaire WHERE prenom = :prenom"); 
        $request->execute(
        array(
        ':prenom'=>'Julius',
        ':salaire'=> 21
        )
        );



        ?>
    </main>
    <footer style=" background-color : #EEA545;">
        <div class="container">
            <hr>
            <div class="row text-center">
                <div class="col-12">
                    <p> &copy; Entreprise - <?= date('Y') ?></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>