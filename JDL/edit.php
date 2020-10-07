<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Jardin de livres</title>
</head>

<body>
    <div class="containuer-fluid">
        <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand">Navbar</a>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" name="q" type="search" placeholder="Recherche..."
                        aria-label="Search" style="border-radius: 20px">
                    <button type="submit" class="btn btn-outline-primary" style="border-radius: 20px">Recherchez
                    </button>
                </form>
                <button type="submit" class="btn btn-outline-primary" style="border-radius: 20px" data-toggle="modal"
                    data-target="#staticBackdrop">Ajouter un livre
                </button>
        </nav>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Genre</label>
                                <input type="text" class="form-control" name="genre" id="" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="">Categorie</label>
                                <input type="text" class="form-control" name="categorie" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Auteur</label>
                                <input type="text" class="form-control" name="auteur" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Titre</label>
                                <input type="text" class="form-control" name="titre" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Editeur</label>
                                <input type="text" class="form-control" name="editeur" id="">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-success"
                            data-dismiss="modal">Ajouter</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md">
                <h1 class="text-center mb-5 mt-4">Les livres</h1>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Categorie</th>
                            <th scope="col">Auteur</th>
                            <th scope="col">titre</th>
                            <th scope="col">editeur</th>
                            <th scope="col">Mot clé 1</th>
                            <th scope="col">Mot clé 2</th>
                            <th scope="col">Mot clé 3</th>
                            <th scope="col">Mot clé 4</th>
                            <th class="text-center" colspan="2" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $db = new PDO("mysql:host=localhost;dbname=idl",'root','');

                                    
                            $reservations = $db->query("SELECT * FROM livre")->fetchAll();

                            foreach ($reservations as $reservation) { ?>
                        <tr>
                            <td><?php echo $reservation['id'] ?></td>
                            <td><?php echo $reservation['genre'] ?></td>
                            <td><?php echo $reservation['categorie'] ?></td>
                            <td><?php echo $reservation['auteur'] ?></td>
                            <td><?php echo $reservation['titre'] ?></td>
                            <td><?php echo $reservation['editeur'] ?></td>
                            <td><?php echo $reservation['motCle1'] ?></td>
                            <td><?php echo $reservation['motCle2'] ?></td>
                            <td><?php echo $reservation['motCle3'] ?></td>
                            <td><?php echo $reservation['motCle4'] ?></td>
                            <td>

                                <form action="" method="POST">
                                    <input name='<?php echo $reservation['id'] ?>' class="d-none">
                                    <button name="edit">Modifier</button>
                                </form>
                                <a class="" href="delete.php?id=<?php echo $reservation['id'] ?>">Supprimer</a>
                            </td>
                        </tr>
                        <?php } 
                         ?>
                    </tbody>
                </table>
            </div>


    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</body>

</html>


<?php

if(isset($_POST['submit']))
{

 $genre = $_POST['genre'];
$categorie = $_POST['categorie'];
$auteur = $_POST['auteur'];
$titre = $_POST['titre'];
$editeur = $_POST['editeur'];

$newlivre =[
'genre' => $genre,
'categorie' => $categorie,
'auteur' => $auteur,
'titre' => $titre,
'editeur' => $editeur,

];

$stmt = $db->prepare("INSERT INTO livre (genre, categorie, auteur, titre, editeur) VALUES (:genre, :categorie, :categorie, :auteur, :editeur)");
$stmt->execute($newlivre);
}



?>