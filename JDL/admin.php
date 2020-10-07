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
            <div class="container">
                <a class="navbar-brand">Navbar</a>
                <button type="submit" class="btn btn-outline-primary" style="border-radius: 20px" data-toggle="modal"
                    data-target="#staticBackdrop">Ajouter un livre
                </button>
                <a href="edit.php" type="submit" class="btn btn-outline-primary" style="border-radius: 20px">Editer un livre
                </a>
            </div>
        </nav>
        <div class="row justify-content-center mt-5">
            <?php
				
                $db = new PDO("mysql:host=localhost;dbname=idl",'root','');

                $livres = $db->query('SELECT titre, auteur, genre FROM livre ORDER BY id DESC');

                
                if (isset($_GET['q']) && !empty($_GET['q'])) {
                    $q = htmlspecialchars($_GET['q']);
                    $livres = $db->query('SELECT titre, auteur, genre FROM livre WHERE titre LIKE "%'.$q.'%" ORDER BY id DESC');
                    if($livres->rowCount()== 0){
                        $livres = $db->query('SELECT titre, auteur, genre FROM livre WHERE CONCAT(titre, genre) LIKE "%'.$q.'%" ORDER BY id DESC');
                    }

                }
                ?>

            <?php if ($livres->rowCount() > 0) { ?>


            <?php while ($l = $livres->fetch()) { ?>



            <div class="col-md-3 mb-3 no-gutters">
                <div class="card" style="width: 15rem;">
                    <img src="livre.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5><?= $l['titre']?></h5>
                        <h6><?= $l['auteur']?></h6>

                        <p class="card-text">
                            <?= $l['genre']?>
                        </p>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php } else {?>

            <h5>Aucun resultat pour : <?= $q ?> </h5>
            <?php } ?>




        </div>


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
                                <button type="submit" name="submit" class="btn btn-success mt-3">Ajouter</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
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